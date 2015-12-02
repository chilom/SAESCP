<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Autenticacion extends CI_Controller {

    public $datos = array();

    //public $tables = array();
    public function __construct() {
        parent::__construct();
        $this->load->library(array('session', 'form_validation'));
        $this->load->model(array('usuario_model', 'registro_sesiones_model'));
        $this->load->helper(array('url', 'language'));
// $this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));
        $this->lang->load('auth');
        $this->load->library(array('ion_auth', 'form_validation'));
        $tables = $this->config->item('tables', 'ion_auth');
    }

    public function index() {
        if ($this->session->userdata('activo') == 1) {
            switch ($this->session->userdata('perfil')) {
                case '': $this->muestra_pantalla_autenticacion();
                    break;
                case 'administrador': $this->muestra_pantalla_administrador();
                    break;
                case 'maestro': $this->muestra_pantalla_maestro();
                    break;
                case 'estudiante': $this->muestra_pantalla_estudiante();
                    break;
                default: $this->muestra_pantalla_autenticacion();
                    break;
            }
        } else if ($this->session->userdata('activo') == 0) {
            $this->muestra_pantalla_autenticacion();
        }
    }  

    function _render_page($view, $data = null, $render = false) {
        $this->viewdata = (empty($data)) ? $this->data : $data;
        $view_html = $this->load->view($view, $this->viewdata, $render);
        if (!$render)
            return $view_html;
    }
   
    public function ingresa_nombre_clave() {
        $datos['nombre'] = $this->input->post('txtnombre', TRUE);
        $datos['clave'] = $this->input->post('txtclave', TRUE);
        return $datos;
    }

    public function busca_usuario() {
//$ci = & get_instance();
        $datos = $this->ingresa_nombre_clave();
        $this->form_validation->set_rules('txtnombre', 'Nombre ', 'required|trim|min_length[4]|max_length[9]|callback_muestramsjincorrectos'); //|callback_muestraMsjNoExisten'
        $this->form_validation->set_rules('txtclave', 'Clave', 'required|trim|min_length[4]|max_length[9]|callback_muestramsjnoactivo|xss_clean');
        $this->form_validation->set_message('required', '%s es un campo requerido.');
        $this->form_validation->set_message('min_length', '%s debe tener minimo %s carácteres.');
        $this->form_validation->set_message('max_length', '%s debe tener maximo %s carácteres.');
        $this->form_validation->set_error_delimiters('<div class="msj  alert-danger" style="margin:1%;">', '</div>');
//lanzamos mensajes de error si es que los hay
        $existe = $this->usuario_model->busca_usuario($datos['nombre'], $datos['clave']);
        if ($this->form_validation->run($this) == FALSE) {
            $this->index();
        } else {
            if ($existe) {
                $datosUsuario = array(
                    'idu' => $existe->id_usuario,
                    'perfil' => $existe->perfil,
                    'usuario' => $existe->nombre_usuario,
                    'activo' => $existe->acceso
                );
                /*    $datos_insertar['fecha'] = now();
                  $datos_insertar['id_sesion'] = $this->session->userdata('session_id');
                  $datos_insertar['id_usuario'] = $datosUsuario['idu'];
                  $this->registro_sesiones_model->guarda_fecha($datos_insertar);
                  // $this->registra_fecha(); */
//   $ci->session->set_userdata($datosUsuario);
                $this->index();
            }
        }
    }

    public function muestramsjnoactivo() {
        $u = $this->ingresa_nombre_clave();
        $acceso = $this->usuario_model->obten_acceso($u['nombre'], $u['clave']);
// $acceso = $usuario->acceso;
        if ($acceso == 0 && $acceso != NULL) {
//if (($u['nombre'] != $nombre OR $u['clave'] != $clave) OR ( $u['nombre'] != $nombre && $u['clave'] != $clave)) {
            $this->form_validation->set_message('muestramsjnoactivo', 'Contacta al administrador del sitio para activar tu cuenta.');
            return FALSE;
        } else {
            return TRUE;
        }
        /*  $res = $this->usuario_model->obten_acceso($u['clave'] ,$u['nombre']);       
          $resultado='';$mensaje='';
          if($res==NULL){
          $resultado=1;
          }else if ($res == 0) {
          $resultado=2;
          } else if($res==1){
          $resultado=3;
          }
          if($resultado==1){ $mensaje= 'El usuario con esta informacion no existe. Puede registrarse en la opción registrarme o recuperar su cuenta en la opcion recuperar cuenta.';}
          if($resultado==2){ $mensaje='Contacta al administrador del sitio para que active tu cuenta de acceso.';}

          if($resultado==3){
          return TRUE;
          }else{
          $this->form_validation->set_message('muestramsjnoactivo',$mensaje );
          return FALSE;
          } */
    }

    public function muestramsjincorrectos() {
        $u = $this->ingresa_nombre_clave();
        $existe_acceso = $this->usuario_model->busca_usuario($u['nombre'], $u['clave']);
        if ($existe_acceso == NULL) {
            $this->form_validation->set_message('muestramsjincorrectos', 'El usuario con esta informacion no existe. Puede registrarse en la opción registrarme o recuperar su cuenta en la opcion recuperar cuenta.');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function muestra_pantalla_autenticacion() {
// $data['token'] = $this->token();
        $data['titulo'] = 'autenticacion';
        $data['vista'] = 'autenticacion';
        $this->load->view('plantilla/plantilla1', $data);
    }

    public function muestra_pantalla_maestro() {
//$data['token'] = $this->token();
        /*   $this->load->library('Menu');
          $menu = new Menu;
          $data['menu'] = $menu->show_menu(2);
          $data['titulo'] = '[maestro]';
          $data['vista'] = 'maestro';
          $this->load->view('plantilla/plantilla1', $data);
          //redirect(base_url().'maestro'); */
        redirect('maestro/muestra_tabla_cursos');
    }

    public function usuarios() {
        try {
            $crud = new grocery_CRUD();
            $crud->set_theme('flexigrid');
            $crud->set_table('usuario');
            $crud->set_subject('Usuario');
            $crud->set_language('spanish');
            $crud->columns('id_usuario', 'nombre_usuario', 'nombre_completo', 'correo_electronico', 'clave', 'perfil', 'acceso');
//   $crud->unset_columns('acceso');
            $crud->field_type('perfil', 'dropdown', array('administrador' => 'administrador', 'maestro' => 'maestro', 'estudiante' => 'estudiante'));
            $crud->field_type('clave', 'password');
            $crud->field_type('acceso', 'true_false');
            $crud->display_as('id_usuario', 'Id');
            $crud->display_as('nombre_usuario', 'Usuario');
            $crud->display_as('nombre_completo', 'Nombre ');
            $crud->display_as('correo_electronico', 'E-mail');

// $crud->field_type('acceso', 'hidden');
            $crud->field_type('id_usuario', 'hidden');
            $crud->fields('id_usuario', 'nombre_usuario', 'nombre_completo', 'correo_electronico', 'clave', 'perfil', 'acceso');
            $crud->required_fields('nombre_completo', 'correo_electronico', 'clave', 'perfil');
//$crud->columns('id', 'nombre de usuario','nombre' ,'correo electronico', 'clave','perfil');
//$crud->set_rules('nombre_usuario', 'nombre de usuario', 'trim|min_length[4]|max_length[9]|required|is_unique[usuario.nombre_usuario]');
            $crud->set_rules('nombre_completo', 'nombre ', 'trim|min_length[4]|max_length[45]|required');
            $crud->set_rules('correo_electronico', 'correo electronico', 'trim|valid_email|min_length[10]|max_length[50]');
            $crud->set_rules('clave', 'clave', 'trim|required|min_length[4]|max_length[255]');
            $crud->form_validation()->set_message('required', "%s  no puede estar vacio,");
            $crud->form_validation()->set_message('min_length', "%s  minimo debe contener 4 caracteres.");
            $crud->form_validation()->set_message('max_length', "%s  excede maximo. ");
            $crud->form_validation()->set_message('valid_email', "%s  formato incorrecto para un email. ");
            $crud->form_validation()->set_message('is_unique', "%s   ya existe.");
//  $this->form_validation->set_error_delimiters('<div class="msj  alert-danger" style="margin:1%;">', '</div>');


            $output = $crud->render();
            $this->load->library('Menu');
            $menu = new Menu;
            $data['menu'] = $menu->show_menu(1);
            $data['titulo'] = '[administrar usuarios]';
            $data['vista'] = 'administrador';
            $data['output'] = $output;
            $this->load->view('plantilla/plantilla2', $data);
        } catch (Exception $e) {
            /* Si algo sale mal cachamos el error y lo mostramos */
// show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }

    public function muestra_pantalla_administrador() {
        redirect("autenticacion/usuarios");
    }

    public function muestra_pantalla_estudiante() {
// $data['token'] = $this->token();
        $menu = new Menu;
        $data['menu'] = $menu->show_menu(3);
        $data['titulo'] = '[estudiante]';
// $data['idusuario'] = $this->session->userdata('idu');
//$data['usuario'] = $this->session->userdata('usuario');

        $data['vista'] = 'estudiante';
        $this->load->view('plantilla/plantilla2', $data);
//redirect(base_url().'estudiante');
    }

    public function salir() {
        /*  $datos_insertar['fecha'] = now();
          $id['id_s']=  $this->session->userdata('session_id');
          $id['id_u']=$this->session->userdata('session_id');
          $this->registro_sesiones_model->guarda_fecha_fin($datos_insertar,$id); */
        $this->session->sess_destroy();
        $this->index();
    }

    /*  public function determina_existencia() {
      $mail = $this->input->post('mail_recuperar');
      $this->form_validation->set_rules('mail_recuperar', 'E-mail ', 'required|min_length[10]|max_length[255]|is_unique[contenido.url]|xss_clean');
      //$this->form_validation->set_rules('tipo_contenido', 'tipo de contenido', 'required|xss_clean');
      //$this->form_validation->set_rules('desc_tema', 'descripcion de tema', 'required|trim|min_length[4]|max_length[255]|xss_clean');
      $this->form_validation->set_message('required', '%s en blanco.');
      $this->form_validation->set_message('min_length', '%s debe tener minimo %s carácteres.');
      $this->form_validation->set_message('max_length', '%s debe tener maximo %s carácteres.');
      $this->form_validation->set_message('is_unique', '%s ya existe.');
      //    $this->form_validation->set_message('valid_mail', '%s no tiene formato correcto.');
      $this->form_validation->set_error_delimiters('<div class="alert-danger" style="margin:1%;">', '</div>');
      //lanzamos mensajes de error si es que los hay
      // $existe = $this->usuario_model->busca_usuario($datos['nombre'], $datos['clave']);
      if ($this->form_validation->run() == TRUE) {
      $existe = $this->usuario_model->determina_existencia($mail);
      if ($existe) {
      $this->envia_datos($mail);
      } else {
      echo '<div class="row">
      <div class="col-md-3"></div>

      <div class="col-md-8 alert alert-success" style="width:50%;height:10%;text-align:center">
      <span class="input-group-addon">
      <span class="glyphicon glyphicon-saved">Contenido creado.</span>
      </span>
      </div>
      <div class="col-md-2"></div>
      </div>';
      $this->index();
      }
      } else {
      $this->index();
      }
      } */

    public function ingresa_correo() {
        $mail = $this->input->post('mail_recuperar');
        return $mail;
    }

    public function determina_existencia() {
        $mail = $this->ingresa_correo();
        $existe = $this->usuario_model->determina_existencia($mail);
//if ($mail != '') {
        if ($existe) {
//$datos=  $this->usuario_model->obtiene_datos();
// $this->envia_datos($mail);
            echo json_encode('Datos de acceso enviados.');
        } else {
            echo json_encode('Este correo no existe.');
        }
//  } else {
//    echo json_encode('Correo electronico requerido.');
//}
    }

    public function envia_datos($mail) {
        $configGmail = array(
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.gmail.com',
            'smtp_port' => 465,
            'smtp_user' => 'ishokom@gmail.com',
            'smtp_pass' => 'megustatuculito',
            'mailtype' => 'html',
            'charset' => 'utf-8',
            'newline' => "\r\n"
        );
        $this->email->initialize($configGmail);
        $this->email->from('ishokom@gmail.com', 'admin');
        $this->email->to($mail);
        $this->email->subject("tus datos de usuario");
        $this->email->message("Hola");
        $this->email->send();
        echo json_encode('Datos de usuario enviados !');
    }

    public function ingresa_datos() {
        $datos = array(
            'nombre_usuario' => $this->input->post('nombreR'),
            'nombre_completo' => $this->input->post('nombrecR'),
            'clave' => $this->input->post('claveR'),
            'perfil' => $this->input->post('perfilR'),
            'correo_electronico' => $this->input->post('ceR')
        );
        return $datos;
    }

    /*   public function verifica_claves() {
      $datos = $this->ingresa_datos();
      $existe = $this->usuario_model->determina_existencia_usuario($datos);
      //if ($mail != '') {
      if ($existe == TRUE) {
      echo json_encode('0'); // json_encode('Este nombre de usuario ya existe en el sistema. Pruebe con uno diferente');
      } else {
      $this->usuario_model->crea_usuario($datos);
      echo json_encode('1'); //json_encode('Te has registrado. Ahora contacta al administrador del sitio para que active tu cuenta.');
      }
      //  } else {
      //    echo json_encode('Correo electronico requerido.');
      //}
      } */
}
