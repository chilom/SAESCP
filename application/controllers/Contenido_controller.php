<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Contenido_controller extends CI_Controller {

    public $datos = array();

    public function __construct() {
        parent::__construct();
        $this->load->library(array('session', 'ion_auth'));
        $this->load->model(array('contenido_model'));
        $this->load->helper(array('url', 'form', 'language'));
        $this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));
        $this->lang->load('auth');
        // if (!$this->ion_auth->logged_in()) {
        //    redirect('auth/', 'refresh');
        //  }
    }

    public function index() {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/', 'refresh');
        } else {
            $this->muestra_pantalla_contenido();
        }
    }

    public function muestra_pantalla_contenido() {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/', 'refresh');
        } else {
            $title['title'] = 'maestro: registrar contenido';
            $data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
            $data['encabezado_html'] = $this->load->view('pagina/encabezado_html', $title, true);
            $data['encabezado_pagina'] = $this->load->view('pagina/encabezado_pagina', '', true);
            $usuario['usuario'] = $this->load->view('pagina/usuario', '', true);
            $data['menu'] = $this->load->view('pagina/menu_maestro', $usuario, true);
            $data['pie_pagina'] = $this->load->view('pagina/pie_pagina', '', true);
            $this->load->view('contenido', $data);
        }
    }

    public function llena_lista_desplegable_subsubtemas($id) {
        $this->load->model('subsubtema_model');
        $subsubtemas = $this->subsubtema_model->obtiene_subsubtemas($id);
        echo json_encode($subsubtemas);
    }

    public function introduce_datos_contenido() {
        $entradas['tema_id'] = $this->input->post('temas_cont');
        $entradas['subtema_id'] = $this->input->post('stemas_cont');
        if (empty($this->input->post('stemas_cont'))) {
            $entradas['subtema_id'] = NULL;
        } else {
            $entradas['subtema_id'] = $this->input->post('stemas_cont');
        }
        if (empty($this->input->post('sstemas_cont'))) {
            $entradas['subsubtema_id'] = NULL;
        } else {
            $entradas['subsubtema_id'] = $this->input->post('sstemas_cont');
        }
        $entradas['nombre'] = $this->input->post('nombre_contenido');
        $entradas['url'] = $this->input->post('url_contenido');
        $entradas['tipo'] = $this->input->post('tipo_contenido');
        return $entradas;
    }

    public function valida_entradas_contenido() {
        $datos = $this->introduce_datos_contenido();
        $this->form_validation->set_rules('nombre_contenido', 'Nombre', 'required');
        $this->form_validation->set_rules('temas_cont', 'Tema', 'required');
        //  $this->form_validation->set_rules('stemas_cont', 'Subtema', 'required');
        //$this->form_validation->set_rules('sstemas_cont', 'Subsubtema', '');
        $this->form_validation->set_rules('url_contenido', 'URL de contenido', 'required|valid_url_format|url_exists');
        $this->form_validation->set_rules('tipo_contenido', 'Tipo de contenido', 'required');
        $this->form_validation->set_message('required', '%s en blanco.');
        $this->form_validation->set_message('min_length', '%s debe tener minimo %s carácteres.');
        $this->form_validation->set_message('max_length', '%s debe tener maximo %s carácteres.');
        if ($this->form_validation->run()) {
            if (!$this->contenido_model->verifica_existencia_contenido($datos)) {
                $this->contenido_model->crea_contenido($datos);
                $this->session->set_flashdata('message', '<div class="text-left  alert alert-success">'
                        . '<a class="  close  " data-dismiss="alert" >X</a>'
                        . '<i class="glyphicon glyphicon-info-sign"></i>&nbsp;&nbsp;&nbsp;'
                        . 'El contenido "' . $this->input->post('nombre_contenido') . '" ha sido creado.</div>');
                redirect('contenido_controller/');
            } else {
                $this->session->set_flashdata('message', '<div class="text-left  alert alert-success">'
                        . '<a class="  close  " data-dismiss="alert" >X</a>'
                        . '<i class="glyphicon glyphicon-info-sign"></i>&nbsp;&nbsp;&nbsp;'
                        . 'El contenido "' . $this->input->post('nombre_contenido') . '" ya existe.</div>'); // Puedes registrar este tema con descripcion diferente');
                redirect('contenido_controller/');
            }
        } else {
            $this->session->set_flashdata('message', validation_errors());
            redirect('contenido_controller/');
        }
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

    public function muestra_contenido_subtema($subtema) {
        $contenido = $this->contenido_model->obtiene_contenido($subtema);
        echo json_encode($contenido);
    }

    public function muestra_contenido_subsubtema($subsubtema) {
        $contenido = $this->contenido_model->obtiene_contenido_ss($subsubtema);
        echo json_encode($contenido);
    }

    public function registra_inicio_lectura_contenido($id) {
        $datos['users_id'] = $this->session->userdata('user_id');
        $datos['contenido_id'] = $id;
        $datos['inicio'] = date('Y-m-d H:i:s');
        $datos['comenzado'] = '1';
        $this->session->set_userdata('contenido_lectura', $id);
        $inicio_lectura = $this->contenido_model->registra_inicio_lectura_contenido($datos);
        echo json_encode($inicio_lectura);
    }

    public function registra_fin_lectura_contenido($id) {
        $datos['users_id'] = $this->session->userdata('user_id');
        $datos['contenido_id'] = $id;
        $datos['terminado'] = '1';
        $datos['fin'] = date('Y-m-d H:i:s');
        $fin_lectura = $this->contenido_model->registra_fin_lectura_contenido($datos);
        echo json_encode($fin_lectura);
    }
    public function verifica_si_lectura_terminada($id){
        echo json_encode($this->contenido_model->verifica_si_lectura_termino($id));
    }

}
