<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Temario_controller extends CI_Controller {

    public $resultado = FALSE;
    public $cursos;

    public function __construct() {
        parent::__construct();
        $this->load->model(array('curso_model', 'tema_model', 'subtema_model', 'subsubtema_model'));
        $this->load->helper(array('url', 'form'));
        $this->load->library(array('ion_auth', 'form_validation'));
        $this->load->helper(array('url', 'language'));
        $this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));
        $this->lang->load('auth');
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/', 'refresh');
        }
    }

    public function index() {
        $this->muestra_pantalla_temario();
    }

    public function muestra_pantalla_temario() {
        $data['message'] = $this->session->flashdata('message');
        $data['message_s'] = $this->session->flashdata('message_s');
        $data['message_ss'] = $this->session->flashdata('message_ss');
        $title['title'] = 'maestro: registro de temario';
        $data['encabezado_html'] = $this->load->view('pagina/encabezado_html', $title, true);
        $menu['menu'] = $this->load->view('pagina/menu_maestro', '', true);
        $data['encabezado_pagina'] = $this->load->view('pagina/encabezado_pagina', $menu, true);
        $data['pie_pagina'] = $this->load->view('pagina/pie_pagina', '', true);
        $this->load->view('temario', $data);
    }

    public function llena_lista_desplegable_cursos() {
        $cursos = $this->curso_model->obtiene_cursos();
        echo json_encode($cursos);
    }

    public function introduce_datos_tema() {
        /* $curso = $this->input->post('cursos');
          $idcurso = $this->curso_model->obten_id_curso($curso); */
        $datos_tema['curso_id'] = $this->input->post('cursos_tema');
        $datos_tema['numero'] = $this->input->post('numero_tema');
        $datos_tema['nombre'] = $this->input->post('nombre_tema');
        $datos_tema['descripcion'] = $this->input->post('desc_tema');
        return $datos_tema;
    }

    public function valida_entradas_tema() {
        $datos_tema = $this->introduce_datos_tema();
        $this->form_validation->set_rules('cursos_tema', 'Curso', 'required');
        $this->form_validation->set_rules('numero_tema', 'Numero', 'required');
        $this->form_validation->set_rules('nombre_tema', 'Nombre', 'required|trim');
        $this->form_validation->set_rules('desc_tema', 'Descripcion', 'required|trim');
        $this->form_validation->set_message('required', '%s es un campo requerido');
        $this->form_validation->set_message('min_length', '%s debe tener minimo %s carácteres.');
        $this->form_validation->set_message('max_length', '%s debe tener maximo %s carácteres.');
        $this->form_validation->set_message('is_unique', '%s ya existe.');
        if ($this->form_validation->run()) {
            if ($this->tema_model->verifica_existencia_tema($datos_tema) == FALSE) {

                $this->tema_model->crea_tema($datos_tema);
                $this->session->set_flashdata('message', '<div class="text-left  alert alert-success">'
                        . '<a class="  close  " data-dismiss="alert" >X</a>'
                        . '<i class="glyphicon glyphicon-info-sign"></i>&nbsp;&nbsp;&nbsp;'
                        . 'El tema "' . $datos_tema['numero'] . '" ha sido creado.</div>');
                redirect('temario_controller/muestra_pantalla_temario', 'refresh');
            } else {
                $this->session->set_flashdata('message', '<div class="text-left  alert alert-success">'
                        . '<a class="  close  " data-dismiss="alert" >X</a>'
                        . '<i class="glyphicon glyphicon-info-sign"></i>&nbsp;&nbsp;&nbsp;'
                        . 'El tema "' . $datos_tema['numero'] . '" ya existe.</div>'); // Puedes registrar este tema con descripcion diferente');
                $this->muestra_pantalla_temario();
            }
        } else {
            $this->session->set_flashdata('message', validation_errors());
            //redirect('temario_controller/muestra_pantalla_temario');
            $this->muestra_pantalla_temario();
        }
    }

    public function llena_lista_desplegable_temas($id) {
        $temas = $this->tema_model->obtiene_temas($id);
        echo json_encode($temas);
    }

    public function introduce_datos_subtema() {
        $datos_stema['tema_id'] = $this->input->post('temas');
        $datos_stema['numero'] = $this->input->post('numero_subtema');
        $datos_stema['nombre'] = $this->input->post('nombre_stema');
        $datos_stema['descripcion'] = $this->input->post('desc_stema');
        return $datos_stema;
    }

    public function valida_entradas_subtema() {
        $datos_s = $this->introduce_datos_subtema();
        $this->form_validation->set_rules('temas', 'Tema', 'required');
        $this->form_validation->set_rules('numero_subtema', 'Número', 'required');
        $this->form_validation->set_rules('nombre_stema', 'Nombre', 'required|trim');
        $this->form_validation->set_rules('desc_stema', 'Descripción', 'required|trim');
        $this->form_validation->set_message('required', '%s es campo requerido.');
        $this->form_validation->set_message('min_length', '%s debe tener minimo %s carácteres.');
        if ($this->form_validation->run()) {
            if (!$this->subtema_model->verifica_existencia_subtema($datos_s)) {
                $this->subtema_model->crea_subtema($datos_s);
                $this->session->set_flashdata('message_s', '<div class="text-left  alert alert-success">'
                        . '<a class="  close  " data-dismiss="alert" >X</a>'
                        . '<i class="glyphicon glyphicon-info-sign"></i>&nbsp;&nbsp;&nbsp;'
                        . 'El subtema "' . $this->input->post('nombre_stema') . '" ha sido creado</div>');
                redirect('temario_controller/muestra_pantalla_temario', 'refresh');
            } else {
                $this->session->set_flashdata('message_s', '<div class="text-left  alert alert-success">'
                        . '<a class="  close  " data-dismiss="alert" >X</a>'
                        . '<i class="glyphicon glyphicon-info-sign"></i>&nbsp;&nbsp;&nbsp;'
                        . 'El subtema "' . $this->input->post('nombre_stema') . '" ya existe</div>'); // Puedes registrar este subtema con descripcion diferente');
                $this->muestra_pantalla_temario();
            }
        } else {
            $this->session->set_flashdata('message_s', validation_errors());
            $this->muestra_pantalla_temario();

//redirect('temario_controller/muestra_pantalla_temario', 'refresh');
        }
    }

    public function llena_lista_desplegable_subtemas($id) {
        $subtemas = $this->subtema_model->obtiene_subtemas($id);
        echo json_encode($subtemas);
    }

    public function introduce_datos_subsubtema() {
        $datos_sstema['subtema_id'] = $this->input->post('subtemas');
        $datos_sstema['numero'] = $this->input->post('numero_ssubtema');
        $datos_sstema['nombre'] = $this->input->post('nombre_sstema');
        $datos_sstema['descripcion'] = $this->input->post('desc_sstema');
        return $datos_sstema;
    }

    public function valida_entradas_subsubtema() {
        $datos_ss = $this->introduce_datos_subsubtema();
        $this->form_validation->set_rules('subtemas', 'Subtema', 'required');
        $this->form_validation->set_rules('numero_ssubtema', 'Número', 'required');
        $this->form_validation->set_rules('nombre_sstema', 'Nombre', 'required|trim');
        $this->form_validation->set_rules('desc_sstema', 'Descripción', 'required|trim');
        $this->form_validation->set_message('required', '%s en un campo requerido.');
        $this->form_validation->set_message('min_length', '%s debe tener minimo %s carácteres.');
        $this->form_validation->set_message('max_length', '%s debe tener maximo %s carácteres.');
        if ($this->form_validation->run()) {
            if (!$this->subsubtema_model->verifica_existencia_subsubtema($datos_ss)) {
                $this->subsubtema_model->crea_subsubtema($datos_ss); //
                $this->session->set_flashdata('message_ss', '<div class="text-left  alert alert-success">'
                        . '<a class="  close  " data-dismiss="alert" >X</a>'
                        . '<i class="glyphicon glyphicon-info-sign"></i>&nbsp;&nbsp;&nbsp;'
                        . 'El subsubtema "' . $this->input->post('nombre_sstema') . '" ha sido creado</div>');
                redirect('temario_controller/muestra_pantalla_temario', 'refresh');
            } else {
                $this->session->set_flashdata('message_ss', '<div class="text-left  alert alert-success">'
                        . '<a class="  close  " data-dismiss="alert" >X</a>'
                        . '<i class="glyphicon glyphicon-info-sign"></i>&nbsp;&nbsp;&nbsp;'
                        . 'El subsubtema "' . $this->input->post('nombre_sstema') . '" ya existe</div>'); // Puedes registrar este subtema con descripcion diferente');
                $this->muestra_pantalla_temario();
            }
        } else {
//   $this->index();     
            $this->session->set_flashdata('message_ss', validation_errors());
            $this->muestra_pantalla_temario();
            //redirect('temario_controller/muestra_pantalla_temario', 'refresh');
        }
    }

}
