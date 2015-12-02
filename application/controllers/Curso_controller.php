<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Curso_controller extends CI_Controller {

    public $datos = array();

    public function __construct() {
        parent::__construct();
        $this->load->library(array('session', 'ion_auth'));
        $this->load->model(array('lista_inscripcion_model', 'temario_model'));
        $this->load->helper(array('url', 'form'));
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/', 'refresh');
        }
    }

    public function index() {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/', 'refresh');
        } else {
            $this->muestra_pantalla_curso();
        }
//$this->muestra_pantalla_curso();
    }

    public function llena_mis_cursos($id) {
        $this->load->model('curso_model');
        $existen_cursos = $this->curso_model->verifica_existencia_cursos();
        $mis_cursos = $this->lista_inscripcion_model->obtiene_mis_cursos($id);
        return $mis_cursos;
        // en caso de usar ajax
        /*  if ($existen_cursos == false) {
          echo json_encode('no inscrito');
          } else {
          echo json_encode($mis_cursos);
          } */
    }

    public function llena_temario($curso) {
        $this->session->set_userdata('curso', $curso);
        $this->muestra_pantalla_curso();
    }

    public function muestra_pantalla_curso() {
        $title['title'] = 'estudiante: mis cursos';
        $data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
        $data['encabezado_html'] = $this->load->view('pagina/encabezado_html', $title, true);
        $data['encabezado_pagina'] = $this->load->view('pagina/encabezado_pagina', '', true);
        $usuario['usuario'] = $this->load->view('pagina/usuario', '', true);
        $data['menu'] = $this->load->view('pagina/menu_estudiante', $usuario, true);
        $curso = $this->temario_model->obten_nombre_curso($this->session->userdata('curso'));
        $data['curso'] = $curso->nombrec;
        $tem = $this->temario_model->obtiene_tema($this->session->userdata('curso'));
        $stem = $this->temario_model->obtiene_subtema($this->session->userdata('curso'));
        $sstem = $this->temario_model->obtiene_ssubtema($this->session->userdata('curso'));
        $data['temas'] = $tem;
        if ($data['temas'] != null) {
            foreach ($data['temas'] as $k => $tema) {
                $data['temas'][$k]->subtemas = $this->temario_model->obtiene_subtema2($tema->idt);
            }
            foreach ($data['temas'] as $k => $subtema) {
                $data['temas'][$k]->subsubtemas = $this->temario_model->obtiene_ssubtema2($subtema->idt);
            }
        }
        $data['pie_pagina'] = $this->load->view('pagina/pie_pagina', '', true);
        $this->load->view('curso', $data);
    }

    public function llena_temario_curso($curso) {
        $temario = $this->temario_model->obtiene_temas($curso);
        echo json_encode($temario);
    }

    public function llena_temario_subtemas($tema) {
        $subtemas = $this->temario_model->obtiene_subtemas($tema);
        echo json_encode($subtemas);
    }

    public function llena_temario_subsubtemas($subtema) {
        $subsubtemas = $this->temario_model->obtiene_subsubtemas($subtema);
        echo json_encode($subsubtemas);
    }

    public function llena_lista_desplegable_subsubtemas($id) {
        $this->load->model('subsubtema_model');
        $subsubtemas = $this->subsubtema_model->obtiene_subsubtemas($id);
        echo json_encode($subsubtemas);
    }

    public function muestra_msj_sin_cursos() {
        
    }

    public function muestra_msj_sin_temario() {
        
    }

    public function muestra_msj_requeridos_contenido() {
        
    }

    public function muestra_msj_url_sin_formato() {
        
    }

    public function muestra_msj_contenido_existe() {
        
    }

}
