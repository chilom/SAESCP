<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Administrador_controller extends CI_Controller {

    public $datos = array();

    public function __construct() {
        parent::__construct();
        $this->load->library(array('session','ion_auth'));

        $this->load->model(array('curso_model', 'lista_inscripcion_model'));
        $this->load->helper(array('url', 'form'));
    }

    public function index() {
        if(!$this->ion_auth->logged_in()){
            redirect('auth/','refresh');
        }else{
            $this->muestra_pantalla_administrar(); 
        }
    }
    public function muestra_pantalla_administrar(){
        redirect('administrador_controller/muestra_tabla_usuarios','refresh');
    }

    public function muestra_tabla_usuarios() {
         if(!$this->ion_auth->logged_in()){
            redirect('auth/','refresh');
        }else{
        try {
            $crud = new grocery_CRUD();
            $crud->set_table('users');
            $crud->set_subject('Usuario');
            $crud->set_theme('flexigrid');
            $crud->set_language('spanish');
            $crud->unset_add();
            $crud->unset_read();         
            $crud->columns('id', 'username', 'password', 'nombre', 'email', 'active');
            $crud->unset_columns('id','password','email','nombre');
            $crud->unset_fields('id','password', 'email','created_on','ip_address','salt','activation_code', 'forgotten_password_code','forgotten_password_time','remember_code','last_login');            
            $crud->display_as('id', 'Id');
            $crud->display_as('username', 'Usuario ');
            $crud->display_as('nombre', 'Nombre');
            $crud->display_as('password', 'Contraseña');
            $crud->display_as('email', 'Correo electronico');
            $crud->display_as('active', 'Activo');
            $crud->field_type('active', 'true_false');
            $crud->field_type('id', 'hidden');
            $crud->field_type('username', 'readonly');
            $crud->field_type('nombre', 'readonly');
            $crud->field_type('email', 'readonly');
            $crud->fields('username','nombre', 'active');
            $crud->required_fields('active');           
            $output = $crud->render();           
            //$this->data['menu'] = $menu->show_menu(2);
            $title['title'] = "Administrador: activacion";
                 $usuario['usuario'] = $this->load->view('pagina/usuario', '', true);
            $this->data['menu'] = $this->load->view('pagina/menu_admin', $usuario, true);
            $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
            $this->data['header_html'] = $this->load->view('pagina/encabezado_html', $title, true);
            $this->data['header'] = $this->load->view('pagina/encabezado_pagina', '', true);
            $this->data['footer'] = $this->load->view('pagina/pie_pagina', '', true);
            $this->data['output'] = $output;
            //$this->load->view('maestro',$this->$data);
            $this->load->view('administrar', $this->data);
            // echo json_encode($output); 
        } catch (Exception $e) {
            /* Si algo sale mal cachamos el error y lo mostramos */
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
        }
    }

    public function llena_tabla() {
        try {
            $crud = new grocery_CRUD();
            $crud->set_theme('flexigrid');
            $crud->set_table('inscripcion');
            $crud->set_relation('users_id', 'users', 'username');
            $crud->set_relation('curso_id', 'curso', 'nombre');

            $crud->unset_add();
            // $crud->unset_export();
            $crud->unset_read();
            // $crud->unset_bootstrap();

            $crud->set_language('spanish');
            $crud->columns('id', 'users_id', 'curso_id', 'activo');
            $crud->display_as('id', 'Id');
            $crud->display_as('curso_id', 'Curso');
            $crud->display_as('users_id', 'Usuario ');
            $crud->display_as('activo', 'Inscripcion');

            $crud->field_type('activo', 'true_false');
            $crud->field_type('id', 'readonly');
            $crud->field_type('curso_id', 'readonly');
            $crud->field_type('users_id', 'readonly');

            $crud->required_fields('inscrito');

            $output = $crud->render();
            $this->load->library('Menu');
            $menu = new Menu;
            $this->data['menu'] = $menu->show_menu(2);
            $this->data['titulo'] = '[maestro]';
            $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
            $this->data['header_html'] = $this->load->view('pagina/encabezado_html', '', true);
            $this->data['header'] = $this->load->view('pagina/encabezado_pagina', '', true);
            $this->data['footer'] = $this->load->view('pagina/pie_pagina', '', true);
            $this->data['output'] = $output;
            $this->load->view('inscripcion', $this->data);
        } catch (Exception $e) {
            /* Si algo sale mal cachamos el error y lo mostramos */
            //   show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }

    public function muestra_pantalla_inscripcion() {
        redirect("maestro/llena_tabla");
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

    public function llena_lista_estudiantes() {
        echo json_encode($this->obtiene_lista_inscripcion());
    }

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
