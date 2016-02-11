<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Estudiante_controller extends CI_Controller {

    public $datos = array();

    public function __construct() {
        parent::__construct();
        $this->load->library(array('session', 'form_validation', 'ion_auth'));
        $this->load->model(array('lista_inscripcion_model', 'curso_model'));
        $this->load->helper(array('url', 'language'));
        $this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));
        $this->lang->load('auth');
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/');
        }
    }

    public function index() {
        if (!$this->ion_auth->is_logged_in()) {
            redirect('auth/');
        } else {
            $this->muestra_pantalla_inscribir();
        }
    }

    public function muestra_pantalla_inscribir() {
        $title['title'] = "Estudiante: inscripciones";
        $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
        $this->data['header_html'] = $this->load->view('pagina/encabezado_html', $title, true);
        $menu['menu'] = $this->load->view('pagina/menu_estudiante', '', true);
        $this->data['header'] = $this->load->view('pagina/encabezado_pagina', $menu, true);
        $this->data['footer'] = $this->load->view('pagina/pie_pagina', '', true);
        //renderizacion de  la pagina autenticacion
        $this->load->view('inscribir', $this->data);
    }

    public function llena_lista_desplegable_cursos() {
        $cursos = $this->curso_model->obtiene_cursos();
        echo json_encode($cursos);
    }

    public function selecciona_cursos() {
        $datos['curso_id'] = $this->input->post('curso_inscribir');
        $datos['users_id'] = $this->input->post('user_id');
        return $datos;
    }

    public function verifica_no_inscrito() {
        $datos_inscripcion = $this->selecciona_cursos();
        $this->form_validation->set_rules('curso_inscribir', 'Curso', 'required');     
        //lanzamos mensajes de error si es que los hay
        if ($this->form_validation->run()) {
            //verifica si esta inscrito
            if (!$this->lista_inscripcion_model->verifica_no_inscrito($datos_inscripcion)) {
                //si no esta inscrito crea el registri de inscripcion
                $this->lista_inscripcion_model->guarda_cambios($datos_inscripcion);
                $this->session->set_flashdata('message', '<div class="text-left  alert alert-success">'
                        . '<a class="  close  " data-dismiss="alert" >X</a>'
                        . '<i class="glyphicon glyphicon-info-sign"></i>&nbsp;&nbsp;&nbsp;'
                        . 'Has quedado inscrito al curso. Espera a que el maestro active el acceso.</div>');
                redirect('estudiante_controller/muestra_pantalla_inscribir', 'refresh');
            } else {
                $this->session->set_flashdata('message', '<div class="text-left  alert alert-success">'
                        . '<a class="  close  " data-dismiss="alert" >X</a>'
                        . '<i class="glyphicon glyphicon-info-sign"></i>&nbsp;&nbsp;&nbsp;'
                        . 'Ya estas inscrito en este curso. Elige otro curso.</div>');
                $this->muestra_pantalla_inscribir();
            }
        } else {
            $this->session->set_flashdata('message', validation_errors()); // Puedes registrar este tema con descripcion diferente');
            redirect('estudiante_controller/muestra_pantalla_inscribir');
        }
    }

    public function muestra_msj_BD() {
        
    }

    public function verifica_si_sesion_inactiva() {
        
    }

    public function inicia_reloj_logico() {
        if (!$this->ion_auth->logged_in()) {
            echo json_encode('0');
        } else {
            echo json_encode('1');
        }
        /* $h=0;  $m=0;   $s=0;
          $reloj='';
          for($i=0;$i<0;$i++){
          $s=$s+$i;
          if($s==60){
          $m=$m+1;
          if($m==60){
          $h=$h+1;
          }
          }

          $reloj=$h.':'.$m.':'.$s;

          }
          $reloj=$h.':'.$m.':'.$s; */

        //$reloj = date('h:i:s');
        // $reloj = date(0);
        //  echo json_encode($reloj);
    }

}
