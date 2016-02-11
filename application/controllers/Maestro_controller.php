<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Maestro_controller extends CI_Controller {

    public $datos = array();

    public function __construct() {
        parent::__construct();
        $this->load->library(array('session', 'ion_auth'));

        $this->load->model(array('curso_model', 'lista_inscripcion_model'));
        $this->load->helper(array('url', 'form'));
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/', 'refresh');
        }
    }

    public function index() {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/', 'refresh');
        } else {
            $this->obtiene_cursos();
        }
    }

    function cek_before_delete($primary_key) {
        $this->db->db_debug = false; // IMPORTANT! (to make temporary disable debug)
        $this->db->trans_begin();
        $this->db->where('id', $primary_key);
        $this->db->delete('curso');
        $num_rows = $this->db->affected_rows();
        $this->db->trans_rollback();
        if ($num_rows > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function obtiene_cursos() {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/', 'refresh');
        } else {
            try {
                $crud = new grocery_CRUD();
                $crud->set_table('curso');
                $crud->set_subject('Curso');
                $crud->set_theme('datatables');
                $crud->set_language('spanish');
                $crud->columns('id', 'nrc', 'nombre', 'descripcion');
                $crud->unset_columns('activo');
                $crud->unset_read();
                $crud->unset_export();
                $crud->display_as('id', 'Id');
                $crud->display_as('nrc', 'Nrc ');
                $crud->display_as('nombre', 'Curso');
                $crud->field_type('id', 'hidden');
                $crud->fields('id', 'nrc', 'nombre', 'descripcion');
                $crud->required_fields('nombre', 'nrc', 'descripcion');
                $crud->set_rules('nombre', 'Nombre de curso', 'trim|min_length[9]|max_length[50]|required');
                $crud->set_rules('nrc', 'Nrc ', 'trim|min_length[5]|max_length[5]|required');
                $crud->set_rules('descripcion', 'Descripcion', 'trim|min_length[10]|max_length[255]|required');
                $crud->set_lang_string('delete_error_message', 'No se puede eliminar este curso. El curso ya contiene informacion considerable para la correcta operación de la herramienta.');
                $crud->callback_before_delete(array($this, 'cek_before_delete'));
                $output = $crud->render();
                $title['title'] = "Maestro: administrar cursos";
                $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
                $this->data['header_html'] = $this->load->view('pagina/encabezado_html', $title, true);
                $menu['menu'] = $this->load->view('pagina/menu_maestro', '', true);
                $this->data['header'] = $this->load->view('pagina/encabezado_pagina', $menu, true);
                $this->data['footer'] = $this->load->view('pagina/pie_pagina', '', true);
                $this->data['output'] = $output;

                $this->load->view('maestro', $this->data);
            } catch (Exception $e) {
                /* Si algo sale mal cachamos el error y lo mostramos */
                show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
            }
        }
    }

    public function llena_lista_estudiantes() {

        try {
            $crud = new grocery_CRUD();
            $crud->set_theme('datatables');
            $crud->set_table('inscripcion');
            $crud->set_relation('users_id', 'users', 'username');
            $crud->set_relation('curso_id', 'curso', 'nombre');

            $crud->unset_add();
            // $crud->unset_export();
            $crud->unset_read();
            // $crud->unset_bootstrap();

            $crud->set_language('spanish');
            $crud->unset_columns('id');
            $crud->columns('id', 'curso_id', 'users_id', 'activo');
            $crud->display_as('id', 'Id');
            $crud->display_as('curso_id', 'Curso');
            $crud->display_as('users_id', 'Usuario ');
            $crud->display_as('activo', 'Acceso');
            $crud->field_type('activo', 'true_false');
            $crud->field_type('id', 'readonly');
            $crud->field_type('curso_id', 'readonly');
            $crud->field_type('users_id', 'readonly');
            $crud->required_fields('inscrito');
            $output = $crud->render();

            $title['title'] = 'maestro: inscripciones';
            $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
            $this->data['header_html'] = $this->load->view('pagina/encabezado_html', $title, true);
            $menu['menu'] = $this->load->view('pagina/menu_maestro', '', true);
            $this->data['header'] = $this->load->view('pagina/encabezado_pagina', $menu, true);
            $this->data['footer'] = $this->load->view('pagina/pie_pagina', '', true);
            $this->data['output'] = $output;
            $usuario['usuario'] = $this->load->view('pagina/usuario', '', true);
            $this->load->view('inscripcion', $this->data);
        } catch (Exception $e) {
            /* Si algo sale mal cachamos el error y lo mostramos */
            //   show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }

    public function muestra_pantalla_inscripcion() {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/', 'refresh');
        } else {
            redirect("maestro_controller/llena_lista_estudiantes");
        }
        /*   $this->load->library('Menu');
          $menu = new Menu;
          $this->data['menu'] = $menu->show_menu(2);
          $this->data['titulo'] = '[maestro]';
          $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
          $this->data['header_html'] = $this->load->view('pagina/encabezado_html', '', true);
          $this->data['header'] = $this->load->view('pagina/encabezado_pagina', '', true);
          //  $this->data['menu_principal'] = $this->load->view('pagina/menu_principal', '', true);
          $this->data['footer'] = $this->load->view('pagina/pie_pagina', '', true);
          //  $this->data['output'] = $output;
          $this->load->view('inscripcion', $this->data); */
    }

    /*  public function obtiene_lista_inscripcion() {
      $lista_inscripcion = $this->lista_inscripcion_model->obtiene_lista_inscripcion();
      return $lista_inscripcion;
      } */

    public function obtiene_cursos_del_estudiante($id) {
        $cursos_estudiante = $this->lista_inscripcion_model->obtiene_cursos_del_estudiante($id);
        return $cursos_estudiante;
    }

    public function muestra_tabla_cursos_estudiante($id) {
        echo json_encode($this->obtiene_cursos_del_estudiante($id));
    }

    public function muestra_msj_sin_informacion() {
        
    }

    public function muestra_msj_bd() {
        
    }

    public function activa_desactiva_acceso_curso() {
        
    }

    public function cierra_sesion() {
        
    }

}
