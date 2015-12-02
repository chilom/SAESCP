<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Tema_controller extends CI_Controller {

    public $datos = array();

    public function __construct() {
        parent::__construct();
        $this->load->library(array('session', 'ion_auth'));
        $this->load->model(array('contenido_model', 'subtema_model', 'subsubtema_model', 'tema_model'));
        $this->load->helper(array('url', 'form', 'language'));
        $this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));
        $this->lang->load('auth');
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/', 'refresh');
        }
    }

    public function index() {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/', 'refresh');
        } else {
            $this->muestra_pantalla_tema();
        }
    }

    public function muestra_tema($tema) {
        $this->session->set_userdata('tema', $tema);
        $this->muestra_pantalla_tema();
    }

    public function muestra_pantalla_tema() {
        $title['title'] = 'estudiante: temas';
        $data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
        $data['encabezado_html'] = $this->load->view('pagina/encabezado_html', $title, true);
        $data['encabezado_pagina'] = $this->load->view('pagina/encabezado_pagina', '', true);
        $usuario['usuario'] = $this->load->view('pagina/usuario', '', true);
        $data['menu'] = $this->load->view('pagina/menu_estudiante', $usuario, true);
        $tema = $this->tema_model->obtiene_nombre_tema($this->session->userdata('tema'));
        $data['tema'] = $tema->nombret;
        $data['subtemas'] = $this->subtema_model->obtiene_subtema($this->session->userdata('tema'));
        $data['contenido_tema']=$this->contenido_model->obtiene_contenido_tema($this->session->userdata('tema'));
        $data['pie_pagina'] = $this->load->view('pagina/pie_pagina', '', true);
        $this->load->view('tema', $data);
    }

    public function muestra_subtema($stema) {
        $this->session->set_userdata('subtema', $stema);
        $this->muestra_pantalla_subtema();
    }

    public function muestra_pantalla_subtema() {
        $title['title'] = 'estudiante: subtemas';
        $data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
        $data['encabezado_html'] = $this->load->view('pagina/encabezado_html', $title, true);
        $data['encabezado_pagina'] = $this->load->view('pagina/encabezado_pagina', '', true);
        $usuario['usuario'] = $this->load->view('pagina/usuario', '', true);
        $data['menu'] = $this->load->view('pagina/menu_estudiante', $usuario, true);
        $subtema = $this->subtema_model->obtiene_nombre($this->session->userdata('subtema'));
        $data['subtema'] = $subtema->nombre;
        $data['subsubtemas'] = $this->subsubtema_model->obtiene_subsubtema($this->session->userdata('subtema'));
        $data['pie_pagina'] = $this->load->view('pagina/pie_pagina', '', true);
        $this->load->view('subtema', $data);
    }

    public function muestra_subsubtema($sstema) {
        $this->session->set_userdata('subsubtema', $sstema);
        $this->muestra_pantalla_subsubtema();
    }

    public function muestra_pantalla_subsubtema() {
        $title['title'] = 'estudiante: subsubtemas';
        $data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
        $data['encabezado_html'] = $this->load->view('pagina/encabezado_html', $title, true);
        $data['encabezado_pagina'] = $this->load->view('pagina/encabezado_pagina', '', true);
        $usuario['usuario'] = $this->load->view('pagina/usuario', '', true);
        $data['menu'] = $this->load->view('pagina/menu_estudiante', $usuario, true);
        $subsubtema = $this->subsubtema_model->obtiene_nombre($this->session->userdata('subsubtema'));
        $data['id_ss'] = $this->session->userdata('subsubtema');
        $data['subsubtema'] = $subsubtema->nombre;
        $data['contenido_ss'] = $this->contenido_model->obtiene_contenido_ss($this->session->userdata('subsubtema'));
        $data['pie_pagina'] = $this->load->view('pagina/pie_pagina', '', true);
        $this->load->view('subsubtema', $data);
    }

}
