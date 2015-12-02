<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Avance_controller extends CI_Controller {

    public $datos = array();

    public function __construct() {
        parent::__construct();
        $this->load->library(array('session'));
        $this->load->model(array('tema_realizado_model'));
        $this->load->helper(array('url', 'form'));
    }

    public function index() {
    }
    
    public function calcula_avance_curso($estudiante){
        //$estudiante=$this->session->userdata('users_id');
        $avance_cursos=$this->tema_realizado_model->calcula_avance_curso($estudiante);
        echo json_encode($avance_cursos);
    }
    
    public function llena_avance_curso(){
        
    }

    public function muestra_pantalla_avance() {
          $this->data['usuario']=$this->load->view('pagina/usuario','',true);
        $this->data['menu'] =$this->load->view('pagina/menu_estudiante','',true); //$menu->show_menu(3);
        $title['title'] = '[estudiante]: seguimiento actividades';
        $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
        $this->data['encabezado_html'] = $this->load->view('pagina/encabezado_html', $title, true);
        $this->data['encabezado_pagina'] = $this->load->view('pagina/encabezado_pagina', '', true);
        $this->data['pie_pagina'] = $this->load->view('pagina/pie_pagina', '', true);
        $this->load->view('avance', $this->data);
    }

 

  

}
