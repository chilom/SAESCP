<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Seguimiento_controller extends CI_Controller {

    public $datos = array();

    function __construct() {
        parent::__construct();
        $this->load->library(array('session'));

        $this->load->model(array('curso_model', 'lista_inscripcion_model'));
        $this->load->helper(array('url', 'form'));
    }

    function index() {
        if ($this->ion_auth->logged_in()) {
            $this->muestra_pantalla_seguimiento();
        } else{
          redirect('auth/','refresh');
        }
    }

    function muestra_pantalla_seguimiento() {
       // $this->load->library('Menu');
       // $menu = new Menu;
        $this->data['usuario']=$this->load->view('pagina/usuario','',true);
        $this->data['menu'] =$this->load->view('pagina/menu_estudiante','',true); //$menu->show_menu(3);
        $title['title'] = '[estudiante]: seguimiento actividades';
        $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
        $this->data['encabezado_html'] = $this->load->view('pagina/encabezado_html', $title, true);
        $this->data['encabezado_pagina'] = $this->load->view('pagina/encabezado_pagina', '', true);
        $this->data['pie_pagina'] = $this->load->view('pagina/pie_pagina', '', true);
        $this->load->view('seguimiento', $this->data);
    }

    function obtiene_actividades_realizadas() {
        $this->load->model('actividad_realizada_model');
        $actividades_realizadas = $this->actividad_realizada_model->obtiene_actividades_realizadas();
        return $actividades_realizadas;
    }

    function llena_actividades_realizadas() {
        echo json_encode($this->obtiene_actividades_realizadas());
    }

    function obtiene_actividades_no_realizadas() {
        $this->load->model('actividad_no_realizada_model');
        $actividades_no_realizadas = $this->actividad_no_realizada_model->obtiene_actividades_no_realizadas();
        return $actividades_no_realizadas;
    }

    function llena_actividades_no_realizadas() {
        echo json_encode($this->obtiene_actividades_no_realizadas());
    }

}
