<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Actividades_controller extends CI_Controller {

    public $datos = array();

    public function __construct() {
        parent::__construct();
        $this->load->library(array('session', 'ion_auth'));
        $this->load->model(array('actividades_model'));
        $this->load->helper(array('url', 'form', 'language'));
        $this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));
        $this->lang->load('auth');
        // if (!$this->ion_auth->logged_in()) {
        //    redirect('auth/', 'refresh');
        // }
    }

    public function index() {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/', 'refresh');
        } else {
            $this->muestra_pantalla_actividades();
        }
    }

    public function obtiene_cursos() {
        $cursos = $this->curso_model->obtiene_cursos();
    }

    public function muestra_pantalla_actividades() {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/', 'refresh');
        } else {
            $data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
            $data['operacion_terminada'] = $this->session->flashdata('operacion_terminada');
            $title['title'] = 'maestro: registrar actividad';
            $data['encabezado_html'] = $this->load->view('pagina/encabezado_html', $title, true);
            $menu['menu'] = $this->load->view('pagina/menu_maestro', '', true);
            $data['encabezado_pagina'] = $this->load->view('pagina/encabezado_pagina', $menu, true);
            $data['pie_pagina'] = $this->load->view('pagina/pie_pagina', '', true);
            $this->load->view('actividades', $data);
        }
    }

    public function selecciona_introduce_entradas() {
        //$entradas['subtema_id'] = $this->input->post('stemas_act');
        if (empty($this->input->post('stemas_act'))) {
            $entradas['subtema_id'] = NULL;
        } else {
            $entradas['subtema_id'] = $this->input->post('stemas_act');
        }
        if (empty($this->input->post('sstemas_act'))) {
            $entradas['subsubtema_id'] = NULL;
        } else {
            $entradas['subsubtema_id'] = $this->input->post('sstemas_act');
        }
        $entradas['tema_id'] = $this->input->post('temas_act');
        $entradas['url'] = $this->input->post('url_actividad');
        $entradas['nombre_actividad'] = $this->input->post('nombre_actividad');
        return $entradas;
    }

    public function valida_entradas_actividad() {
        $datos = $this->selecciona_introduce_entradas();
        $this->form_validation->set_rules('temas_act', 'Tema', 'required');
        //$this->form_validation->set_rules('sstemas_act', 'Subsubtema', '');
        $this->form_validation->set_rules('url_actividad', 'URL de actividad', 'required|valid_url_format|url_exists');
        $this->form_validation->set_rules('nombre_actividad', 'Nombre de actividad', 'required');
        $this->form_validation->set_message('required', '%s es un campo requerido.');
        $this->form_validation->set_message('min_length', '%s debe tener minimo %s carácteres.');
        $this->form_validation->set_message('max_length', '%s debe tener maximo %s carácteres.');
        $this->form_validation->set_message('is_unique', '%s ya existe.');
        if ($this->form_validation->run()) {
            if (!$this->actividades_model->verifica_existencia($datos)) {
                $this->actividades_model->crea_actividad($datos);
                $this->session->set_flashdata('message', '<div class="text-left  alert alert-success">'
                        . '<a class="  close  " data-dismiss="alert" >X</a>'
                        . '<i class="glyphicon glyphicon-info-sign"></i>&nbsp;&nbsp;&nbsp;'
                        . 'La actividad "' . $this->input->post('nombre_actividad') . '" ha sido creada.</div>');
                redirect('actividades_controller/muestra_pantalla_actividades', 'refresh');
            } else {
                $this->session->set_flashdata('message', '<div class="text-left  alert alert-success">'
                        . '<a class="  close  " data-dismiss="alert" >X</a>'
                        . '<i class="glyphicon glyphicon-info-sign"></i>&nbsp;&nbsp;&nbsp;'
                        . 'La actividad "' . $this->input->post('nombre_actividad') . '"  ya existe.</div>');
                $this->muestra_pantalla_actividades();
            }
        } else {
            $this->session->set_flashdata('message', validation_errors());
            redirect('actividades_controller/muestra_pantalla_actividades', 'refresh');
        }
    }

    public function obtiene_actividades_tema() {
        $tema = $this->session->userdata('tema');
        $actividades_t = $this->actividades_model->obtiene_actividades_tema($tema);
        echo json_encode($actividades_t);
    }

    public function obtiene_actividades_subsubtema($subsubtema) {
        $subsubtema = $this->session->userdata('subsubtema');
        $actividades_ss = $this->actividades_model->obtiene_actividades_subsubtema($subsubtema);
        echo json_encode($actividades_ss);
    }

    public function registra_inicio_actividad($id) {
        $datos['users_id'] = $this->session->userdata('user_id');
        $datos['actividad_id'] = $id;
        $datos['inicio'] = date('Y-m-d H:i:s');
        $datos['comenzada'] = '1';
        $this->session->set_userdata('actividad', $id);
        $inicio_actividad = $this->actividades_model->registra_inicio_actividad($datos);
        echo json_encode($inicio_actividad);
    }

    public function registra_fin_actividad() {
        $datos['users_id'] = $this->session->userdata('user_id');
        $datos['actividad_id'] = $this->session->userdata('actividad');
        $datos['fin'] = date('Y-m-d H:i:s');
        $datos['terminada'] = '1';
        $inicio_actividad = $this->actividades_model->registra_fin_actividad($datos);
        echo json_encode($inicio_actividad);
    }

    public function verifica_si_actividad_terminada($id) {
        echo json_encode($this->actividades_model->verifica_si_actividad_termino($id));
    }

}
