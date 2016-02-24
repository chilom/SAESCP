<?php

defined('BASEPATH') OR exit('No direct script access allowed');
class Auth extends CI_Controller {

    private $nombre_clave = null;
    private $datos = null;

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->model(array('sesion_model', 'lista_inscripcion_model'));
        $this->load->library(array('ion_auth', 'form_validation'));
        $this->load->helper(array('url', 'language'));
        $this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));
        $this->lang->load('auth');
    }

    public function index() {
        if (!$this->ion_auth->logged_in()) {
            // redirect them to the login page || redireccion a la pantalla autenticacion
            $this->muestra_pantalla_autenticacion();
        } elseif (!$this->ion_auth->is_admin()) { //verifica si es administrador
            if ($this->ion_auth->in_group('estudiante')) { // verifica si estudiante
                $this->muestra_pantalla_estudiante();
            } elseif ($this->ion_auth->in_group('maestro')) { // verifica si es maestro
                $this->muestra_pantalla_maestro();
            }
        } else {
            $this->muestra_pantalla_administrador();
        }
    }

//###### Funciones originales de libreria Ion Auth#################################################
//####################################################################################
    // log the user in
    function login() {
        $this->data['title'] = "Login";

        //validate form input
        $this->form_validation->set_rules('identity', 'Identity', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == true) {
            // check to see if the user is logging in
            // check for "remember me"
            $remember = (bool) $this->input->post('remember');

            if ($this->ion_auth->login($this->input->post('identity'), $this->input->post('password'), $remember)) {
                //if the login is successful
                //redirect them back to the home page
                $this->session->set_flashdata('message', $this->ion_auth->messages());
                redirect('/', 'refresh');
            } else {
                // if the login was un-successful
                // redirect them back to the login page
                $this->session->set_flashdata('message', $this->ion_auth->errors());
                redirect('auth/login', 'refresh'); // use redirects instead of loading views for compatibility with MY_Controller libraries
            }
        } else {
            // the user is not logging in so display the login page
            // set the flash data error message if there is one
            $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

            $this->data['identity'] = array('name' => 'identity',
                'id' => 'identity',
                'type' => 'text',
                'value' => $this->form_validation->set_value('identity'),
            );
            $this->data['password'] = array('name' => 'password',
                'id' => 'password',
                'type' => 'password',
            );

            $this->_render_page('auth/login', $this->data);
        }
    }

    // log the user out
    function logout() {
        $this->load->model('sesion_model');
        if ($this->ion_auth->in_group('estudiante')) {
            $datos['users_id'] = $this->session->userdata('user_id');
            // $datos['sesion_id'] = session_id();
            //$datos['inicio'] = date('Y-m-d H:i:s');
      /*      $datos['fin'] = date('Y-m-d H:i:s');
            $this->sesion_model->registra_informacion_fin_sesion($datos);
            $datos_act['users_id'] = $this->session->userdata('user_id');
            $datos_act['curso_id'] = $this->session->userdata('curso_id');
            $datos_act['tema_id'] = $this->session->userdata('');
            $datos_act['subtema_id'] = $this->session->userdata('subtema');
            $datos_act['subsubtema_id'] = $this->session->userdata('subsubtema');
            $datos_act['actividad_id'] = $this->session->userdata('');
            $datos_act['evaluacion_id'] = $this->session->userdata('');
            $this->sesion_model->registra_ultima_actividad($datos_act);*/
        }

        // log the user out
        $logout = $this->ion_auth->logout();

        // redirect them to the login page
        //$this->index();        
        redirect('auth/', 'refresh');
    }

    // change password
    function change_password() {
        $this->form_validation->set_rules('old', $this->lang->line('change_password_validation_old_password_label'), 'required');
        $this->form_validation->set_rules('new', $this->lang->line('change_password_validation_new_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[new_confirm]');
        $this->form_validation->set_rules('new_confirm', $this->lang->line('change_password_validation_new_password_confirm_label'), 'required');

        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $user = $this->ion_auth->user()->row();

        if ($this->form_validation->run() == false) {
            // display the form
            // set the flash data error message if there is one
            $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

            $this->data['min_password_length'] = $this->config->item('min_password_length', 'ion_auth');
            $this->data['old_password'] = array(
                'name' => 'old',
                'id' => 'old',
                'type' => 'password',
            );
            $this->data['new_password'] = array(
                'name' => 'new',
                'id' => 'new',
                'type' => 'password',
                'pattern' => '^.{' . $this->data['min_password_length'] . '}.*$',
            );
            $this->data['new_password_confirm'] = array(
                'name' => 'new_confirm',
                'id' => 'new_confirm',
                'type' => 'password',
                'pattern' => '^.{' . $this->data['min_password_length'] . '}.*$',
            );
            $this->data['user_id'] = array(
                'name' => 'user_id',
                'id' => 'user_id',
                'type' => 'hidden',
                'value' => $user->id,
            );

            // render
            $this->_render_page('auth/change_password', $this->data);
        } else {
            $identity = $this->session->userdata('identity');

            $change = $this->ion_auth->change_password($identity, $this->input->post('old'), $this->input->post('new'));

            if ($change) {
                //if the password was successfully changed
                $this->session->set_flashdata('message', $this->ion_auth->messages());
                $this->logout();
            } else {
                $this->session->set_flashdata('message', $this->ion_auth->errors());
                redirect('auth/change_password', 'refresh');
            }
        }
    }

    // forgot password
    function forgot_password() {
        // setting validation rules by checking wheather identity is username or email
        if ($this->config->item('identity', 'ion_auth') != 'email') {
            $this->form_validation->set_rules('email', $this->lang->line('forgot_password_identity_label'), 'required');
        } else {
            $this->form_validation->set_rules('email', $this->lang->line('forgot_password_validation_email_label'), 'required|valid_email');
        }
        if ($this->form_validation->run() == false) {
            // setup the input
            $this->data['email'] = array('name' => 'email',
                'id' => 'email',
            );
            if ($this->config->item('identity', 'ion_auth') != 'email') {
                $this->data['identity_label'] = $this->lang->line('forgot_password_identity_label');
            } else {
                $this->data['identity_label'] = $this->lang->line('forgot_password_email_identity_label');
            }
            // set any errors and display the form
            $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
            $title['title'] = "Recuperar datos de acceso";
            $this->data['header_html'] = $this->load->view('pagina/encabezado_html', $title, true);
            $menu['menu'] = $this->load->view('pagina/menu', '', true);
            $this->data['header'] = $this->load->view('pagina/encabezado_pagina', $menu, true);
            $this->data['footer'] = $this->load->view('pagina/pie_pagina', '', true);
            $this->load->view('auth/recuperar', $this->data);
        } else {
            $identity_column = $this->config->item('identity ', 'ion_auth');
            $identity = $this->ion_auth->where($identity_column, $this->input->post(' email'))->users()->row();
            if (empty($identity)) {
                if ($this->config->item('identity ', 'ion_auth') != 'email') {
                    $this->ion_auth->set_error('forgot_password_identity_not_found');
                } else {
                    $this->ion_auth->set_error('forgot_password_email_not_found');
                }
                $this->session->set_flashdata('message ', $this->ion_auth->errors());
                redirect("auth/forgot_password", ' refresh');
            }
            // run the forgotten password method to email an activation code to the user
            $forgotten = $this->ion_auth->forgotten_password($identity->{$this->config->item('identity ', 'ion_auth')});
            if ($forgotten) {
                // if there were no errors
                $this->session->set_flashdata('message ', $this->ion_auth->messages());
                redirect("auth/busca_usuario", ' refresh'); //we should display a confirmation page here instead of the login page
            } else {
                $this->session->set_flashdata('message ', $this->ion_auth->errors());
                redirect("auth/forgot_password", ' refresh

            ');
            }
        }
    }

    // reset password - final step for forgotten password
    public function reset_password($code = NULL) {
        if (!$code) {
            show_404();
        }
        $user = $this->ion_auth->forgotten_password_check($code);
        if ($user) {
            // if the code is valid then display the password reset form
            $this->form_validation->set_rules('new', 'nueva contraseña  ', 'required|min_length[9]|max_length[30]|matches[new_confirm]');
            $this->form_validation->set_rules('new_confirm ', 'confirmar nueva contraseña ', 'required|min_length[9]|max_length[30]');
            if ($this->form_validation->run() == false) {
                // display the form
                // set the flash data error message if there is one
                $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
                $this->data['min_password_length'] = $this->config->item('min_password_length', 'ion_auth');
                $this->data['new_password'] = array(
                    'name' => 'new',
                    'id' => 'new',
                    'placeholder' => 'Nueva contraseña',
                    'type' => 'password',
                    'required' => 'true',
                    'class' => 'form-control ',
                    'title' => 'Ejemplo: ********. (9 a 30 caracteres).', //añadido
                    'pattern' => ".{9,30}"
                );
                $this->data['new_password_confirm'] = array(
                    'name' => 'new_confirm',
                    'id' => 'new_confirm',
                    'placeholder' => 'Confirmar nueva contraseña',
                    'type' => 'password',
                    'class' => 'form-control',
                    'required' => 'true',
                    'title' => 'Ejemplo: ********. (9 a 30 caracteres).', //añadido
                    'pattern' => ".{9,30}"
                );
                $this->data['user_id'] = array(
                    'name' => 'user_id',
                    'id' => 'user_id',
                    'type' => 'hidden',
                    'value' => $user->id,
                );
                $this->data['csrf'] = $this->_get_csrf_nonce();
                $this->data['code'] = $code;
                $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
                $title['title'] = "Modificar contraseña";
                $this->data['encabezado_html'] = $this->load->view('pagina/encabezado_html', $title, true);
                $this->data['encabezado_pagina'] = $this->load->view('pagina/encabezado_pagina', '', true);
                $this->data['pie_pagina'] = $this->load->view('pagina/pie_pagina', '', true);
                // render
                $this->_render_page('auth/reset_password', $this->data);
                // $this->load->view('auth/reset_password',  $this->data);
            } else {
                // do we have a valid request?$this->_valid_csrf_nonce() === FALSE || 
                if ($user->id != $this->input->post('user_id')) {
                    // something fishy might be up
                    $this->ion_auth->clear_forgotten_password_code($code);
                    show_error($this->lang->line('error_csrf'));
                } else {
                    // finally change the password
                    $identity = $user->{$this->config->item('identity', 'ion_auth')};
                    $change = $this->ion_auth->reset_password($identity, $this->input->post('new'));
                    if ($change) {
                        // if the password was successfully changed
                        $this->session->set_flashdata('message', $this->ion_auth->messages());
                        redirect("auth/busca_usuario", 'refresh');
                    } else {
                        $this->session->set_flashdata('message', $this->ion_auth->errors());
                        //redirect('auth/reset_password/' . $code, 'refresh');
                        $this->valida_entradas_recuperar_datos();
                    }
                }
            }
        } else {
            // if the code is invalid then send them back to the forgot password page
            $this->session->set_flashdata('message', $this->ion_auth->errors());
            $this->forgot_password();
            //redirect("auth/forgot_password", 'refresh');
        }
    }

    // activate the user
    function activate($id, $code = false) {
        if ($code !== false) {
            $activation = $this->ion_auth->activate($id, $code);
        } else if ($this->ion_auth->is_admin()) {
            $activation = $this->ion_auth->activate($id);
        }

        if ($activation) {
            // redirect them to the auth page
            $this->session->set_flashdata('message', $this->ion_auth->messages());
            redirect("auth", 'refresh');
        } else {
            // redirect them to the forgot password page
            $this->session->set_flashdata('message', $this->ion_auth->errors());
            redirect("auth/forgot_password", 'refresh');
        }
    }

    // deactivate the user
    function deactivate($id = NULL) {
        if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin()) {
            // redirect them to the home page because they must be an administrator to view this
            return show_error('You must be an administrator to view this page.');
        }

        $id = (int) $id;

        $this->load->library('form_validation');
        $this->form_validation->set_rules('confirm', $this->lang->line('deactivate_validation_confirm_label'), 'required');
        $this->form_validation->set_rules('id', $this->lang->line('deactivate_validation_user_id_label'), 'required|alpha_numeric');

        if ($this->form_validation->run() == FALSE) {
            // insert csrf check

            $this->data['csrf'] = $this->_get_csrf_nonce();
            $this->data['user'] = $this->ion_auth->user($id)->row();

            $this->_render_page('auth/deactivate_user', $this->data);
        } else {
            // do we really want to deactivate?
            if ($this->input->post('confirm') == 'yes') {
                // do we have a valid request?
                if ($this->_valid_csrf_nonce() === FALSE || $id != $this->input->post('id')) {
                    show_error($this->lang->line('error_csrf'));
                }

                // do we have the right userlevel?
                if ($this->ion_auth->logged_in() && $this->ion_auth->is_admin()) {
                    $this->ion_auth->deactivate($id);
                }
            }

            // redirect them back to the auth page
            redirect('auth', 'refresh');
        }
    }

    // create a new user
    function create_user() {
        $this->data['title'] = "Create User";

        if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin()) {
            redirect('auth', 'refresh');
        }

        $tables = $this->config->item('tables', 'ion_auth');

        // validate form input
        $this->form_validation->set_rules('first_name', $this->lang->line('create_user_validation_fname_label'), 'required');
        $this->form_validation->set_rules('last_name', $this->lang->line('create_user_validation_lname_label'), 'required');
        $this->form_validation->set_rules('email', $this->lang->line('create_user_validation_email_label'), 'required|valid_email|is_unique[' . $tables['users'] . '.email]');
        $this->form_validation->set_rules('phone', $this->lang->line('create_user_validation_phone_label'), 'required');
        $this->form_validation->set_rules('company', $this->lang->line('create_user_validation_company_label'), 'required');
        $this->form_validation->set_rules('password', $this->lang->line('create_user_validation_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]');
        $this->form_validation->set_rules('password_confirm', $this->lang->line('create_user_validation_password_confirm_label'), 'required');

        if ($this->form_validation->run() == true) {
            $username = strtolower($this->input->post('first_name')) . ' ' . strtolower($this->input->post('last_name'));
            $email = strtolower($this->input->post('email'));
            $password = $this->input->post('password');

            $additional_data = array(
                'first_name' => $this->input->post('first_name'),
                'last_name' => $this->input->post('last_name'),
                'company' => $this->input->post('company'),
                'phone' => $this->input->post('phone'),
            );
        }
        if ($this->form_validation->run() == true && $this->ion_auth->register($username, $password, $email, $additional_data)) {
            // check to see if we are creating the user
            // redirect them back to the admin page
            $this->session->set_flashdata('message', $this->ion_auth->messages());
            redirect("auth", 'refresh');
        } else {
            // display the create user form
            // set the flash data error message if there is one
            $this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

            $this->data['first_name'] = array(
                'name' => 'first_name',
                'id' => 'first_name',
                'type' => 'text',
                'value' => $this->form_validation->set_value('first_name'),
            );
            $this->data['last_name'] = array(
                'name' => 'last_name',
                'id' => 'last_name',
                'type' => 'text',
                'value' => $this->form_validation->set_value('last_name'),
            );
            $this->data['email'] = array(
                'name' => 'email',
                'id' => 'email',
                'type' => 'text',
                'value' => $this->form_validation->set_value('email'),
            );
            $this->data['company'] = array(
                'name' => 'company',
                'id' => 'company',
                'type' => 'text',
                'value' => $this->form_validation->set_value('company'),
            );
            $this->data['phone'] = array(
                'name' => 'phone',
                'id' => 'phone',
                'type' => 'text',
                'value' => $this->form_validation->set_value('phone'),
            );
            $this->data['password'] = array(
                'name' => 'password',
                'id' => 'password',
                'type' => 'password',
                'value' => $this->form_validation->set_value('password'),
            );
            $this->data['password_confirm'] = array(
                'name' => 'password_confirm',
                'id' => 'password_confirm',
                'type' => 'password',
                'value' => $this->form_validation->set_value('password_confirm'),
            );

            $this->_render_page('auth/create_user', $this->data);
        }
    }

    // edit a user
    function edit_user($id) {
        $this->data['title'] = "Edit User";

        if (!$this->ion_auth->logged_in() || (!$this->ion_auth->is_admin() && !($this->ion_auth->user()->row()->id == $id))) {
            redirect('auth', 'refresh');
        }

        $user = $this->ion_auth->user($id)->row();
        $groups = $this->ion_auth->groups()->result_array();
        $currentGroups = $this->ion_auth->get_users_groups($id)->result();

        // validate form input
        $this->form_validation->set_rules('first_name', $this->lang->line('edit_user_validation_fname_label'), 'required');
        $this->form_validation->set_rules('last_name', $this->lang->line('edit_user_validation_lname_label'), 'required');
        $this->form_validation->set_rules('phone', $this->lang->line('edit_user_validation_phone_label'), 'required');
        $this->form_validation->set_rules('company', $this->lang->line('edit_user_validation_company_label'), 'required');

        if (isset($_POST) && !empty($_POST)) {
            // do we have a valid request?
            if ($this->_valid_csrf_nonce() === FALSE || $id != $this->input->post('id')) {
                show_error($this->lang->line('error_csrf'));
            }

            // update the password if it was posted
            if ($this->input->post('password')) {
                $this->form_validation->set_rules('password', $this->lang->line('edit_user_validation_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]');
                $this->form_validation->set_rules('password_confirm', $this->lang->line('edit_user_validation_password_confirm_label'), 'required');
            }

            if ($this->form_validation->run() === TRUE) {
                $data = array(
                    'first_name' => $this->input->post('first_name'),
                    'last_name' => $this->input->post('last_name'),
                    'company' => $this->input->post('company'),
                    'phone' => $this->input->post('phone'),
                );

                // update the password if it was posted
                if ($this->input->post('password')) {
                    $data['password'] = $this->input->post('password');
                }



                // Only allow updating groups if user is admin
                if ($this->ion_auth->is_admin()) {
                    //Update the groups user belongs to
                    $groupData = $this->input->post('groups');

                    if (isset($groupData) && !empty($groupData)) {

                        $this->ion_auth->remove_from_group('', $id);

                        foreach ($groupData as $grp) {
                            $this->ion_auth->add_to_group($grp, $id);
                        }
                    }
                }
                // check to see if we are updating the user
                if ($this->ion_auth->update($user->id, $data)) {
                    // redirect them back to the admin page if admin, or to the base url if non admin
                    $this->session->set_flashdata('message', $this->ion_auth->messages());
                    if ($this->ion_auth->is_admin()) {
                        redirect('auth', 'refresh');
                    } else {
                        redirect('/', 'refresh');
                    }
                } else {
                    // redirect them back to the admin page if admin, or to the base url if non admin
                    $this->session->set_flashdata('message', $this->ion_auth->errors());
                    if ($this->ion_auth->is_admin()) {
                        redirect('auth', 'refresh');
                    } else {
                        redirect('/', 'refresh');
                    }
                }
            }
        }

        // display the edit user form
        $this->data['csrf'] = $this->_get_csrf_nonce();

        // set the flash data error message if there is one
        $this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

        // pass the user to the view
        $this->data['user'] = $user;
        $this->data['groups'] = $groups;
        $this->data['currentGroups'] = $currentGroups;

        $this->data['first_name'] = array(
            'name' => 'first_name',
            'id' => 'first_name',
            'type' => 'text',
            'value' => $this->form_validation->set_value('first_name', $user->first_name),
        );
        $this->data['last_name'] = array(
            'name' => 'last_name',
            'id' => 'last_name',
            'type' => 'text',
            'value' => $this->form_validation->set_value('last_name', $user->last_name),
        );
        $this->data['company'] = array(
            'name' => 'company',
            'id' => 'company',
            'type' => 'text',
            'value' => $this->form_validation->set_value('company', $user->company),
        );
        $this->data['phone'] = array(
            'name' => 'phone',
            'id' => 'phone',
            'type' => 'text',
            'value' => $this->form_validation->set_value('phone', $user->phone),
        );
        $this->data['password'] = array(
            'name' => 'password',
            'id' => 'password',
            'type' => 'password'
        );
        $this->data['password_confirm'] = array(
            'name' => 'password_confirm',
            'id' => 'password_confirm',
            'type' => 'password'
        );

        $this->_render_page('auth/edit_user', $this->data);
    }

    // create a new group
    function create_group() {
        $this->data['title'] = $this->lang->line('create_group_title');

        if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin()) {
            redirect('auth', 'refresh');
        }

        // validate form input
        $this->form_validation->set_rules('group_name', $this->lang->line('create_group_validation_name_label'), 'required|alpha_dash');

        if ($this->form_validation->run() == TRUE) {
            $new_group_id = $this->ion_auth->create_group($this->input->post('group_name'), $this->input->post('description'));
            if ($new_group_id) {
                // check to see if we are creating the group
                // redirect them back to the admin page
                $this->session->set_flashdata('message', $this->ion_auth->messages());
                redirect("auth", 'refresh');
            }
        } else {
            // display the create group form
            // set the flash data error message if there is one
            $this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

            $this->data['group_name'] = array(
                'name' => 'group_name',
                'id' => 'group_name',
                'type' => 'text',
                'value' => $this->form_validation->set_value('group_name'),
            );
            $this->data['description'] = array(
                'name' => 'description',
                'id' => 'description',
                'type' => 'text',
                'value' => $this->form_validation->set_value('description'),
            );

            $this->_render_page('auth/create_group', $this->data);
        }
    }

    // edit a group
    function edit_group($id) {
        // bail if no group id given
        if (!$id || empty($id)) {
            redirect('auth', 'refresh');
        }

        $this->data['title'] = $this->lang->line('edit_group_title');

        if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin()) {
            redirect('auth', 'refresh');
        }

        $group = $this->ion_auth->group($id)->row();

        // validate form input
        $this->form_validation->set_rules('group_name', $this->lang->line('edit_group_validation_name_label'), 'required|alpha_dash');

        if (isset($_POST) && !empty($_POST)) {
            if ($this->form_validation->run() === TRUE) {
                $group_update = $this->ion_auth->update_group($id, $_POST['group_name'], $_POST['group_description']);

                if ($group_update) {
                    $this->session->set_flashdata('message', $this->lang->line('edit_group_saved'));
                } else {
                    $this->session->set_flashdata('message', $this->ion_auth->errors());
                }
                redirect("auth", 'refresh');
            }
        }

        // set the flash data error message if there is one
        $this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

        // pass the user to the view
        $this->data['group'] = $group;

        $readonly = $this->config->item('admin_group', 'ion_auth') === $group->name ? 'readonly' : '';

        $this->data['group_name'] = array(
            'name' => 'group_name',
            'id' => 'group_name',
            'type' => 'text',
            'value' => $this->form_validation->set_value('group_name', $group->name),
            $readonly => $readonly,
        );
        $this->data['group_description'] = array(
            'name' => 'group_description',
            'id' => 'group_description',
            'type' => 'text',
            'value' => $this->form_validation->set_value('group_description', $group->description),
        );

        $this->_render_page('auth/edit_group', $this->data);
    }

    function _get_csrf_nonce() {
        $this->load->helper('string');
        $key = random_string('alnum', 8);
        $value = random_string('alnum', 20);
        $this->session->set_flashdata('csrfkey', $key);
        $this->session->set_flashdata('csrfvalue', $value);

        return array($key => $value);
    }

    function _valid_csrf_nonce() {
        if ($this->input->post($this->session->flashdata('csrfkey')) !== FALSE &&
                $this->input->post($this->session->flashdata('csrfkey')) == $this->session->flashdata('csrfvalue')) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function _render_page($view, $data = null, $returnhtml = false) {//I think this makes more sense
        $this->viewdata = (empty($data)) ? $this->data : $data;

        $view_html = $this->load->view($view, $this->viewdata, $returnhtml);

        if ($returnhtml)
            return $view_html; //This will return html on 3rd argument being true
    }

//################################################################################################################
//####################
    //  Metodos agregados ############################

    public function muestra_pantalla_autenticacion() {
        // set the flash data error message if there is one
        $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
        $this->data['identity'] = array(
            'name' => 'identity', 'id' => 'identity', 'type' => 'text',
            //'value' => $this->form_validation->set_value('identity'),
            'placeholder' => 'Usuario', //añadido
            'class' => 'text-justified form-control', //añadido
            'required' => 'true', //añadido
            'autofocus' => 'true',
            'pattern' => ".{9,30}", 'title' => "Ejemplo: maestro de algoritmos o so9011559. (9 a 30 caracteres)"
        );
        $this->data['password'] = array(
            'name' => 'password', 'id' => 'password', 'type' => 'password',
            'placeholder' => 'Contraseña', //añadido
            //'value' => $this->form_validation->set_value('password'),
            'class' => 'text-justified form-control', //añadido
            'required' => 'true', //añadido,
            'autofocus' => 'true',
            'pattern' => ".{9,30}", 'title' => "Ejemplo: ******** . (9 a 30 caracteres) "
        );
        $title['title'] = 'SAESC P: Inicio de sesión';
        $this->data['header_html'] = $this->load->view('pagina/encabezado_html', $title, true);
        $menu['menu'] = $this->load->view('pagina/menu_autenticacion', '', true);
        $this->data['header'] = $this->load->view('pagina/encabezado_pagina', $menu, true);
        $this->data['footer'] = $this->load->view('pagina/pie_pagina', '', true);
        //renderizacion de  la pagina autenticacion
        $this->_render_page('auth/autenticacion', $this->data);
    }

    public function ingresa_nombre_clave() {
        $nombre_clave['remember'] = (bool) $this->input->post('remember');
        $nombre_clave['identity'] = $this->input->post('identity');
        $nombre_clave['password'] = $this->input->post('password');
        return $nombre_clave;
    }

    public function verifica_si_sesion_expiro() {
        if ($this->session->userdata('user_id') == "") {
            //$this->logout();   
            redirect('auth', 'refresh');

            echo json_encode(true);
        } else {
            echo json_encode(false);
        }
    }

    public function verifica_campos_completos($datos) {
        if (!empty($datos['identity']) && !empty($datos['password'])) {
            return true;
        } else {
            return false;
        }
    }

    public function busca_usuario() {
        $nombre_clave = $this->ingresa_nombre_clave();
        if ($this->verifica_campos_completos($nombre_clave) == true) {
            $this->form_validation->set_rules('identity', 'Usuario', 'required|min_length[9]|max_length[30]');
            $this->form_validation->set_rules('password', 'Contraseña', 'required|min_length[9]|max_length[30]');
            $this->form_validation->set_message('required', '%s es un campo requerido');
            if ($this->form_validation->run() == true) {
                if ($this->ion_auth->login($nombre_clave['identity'], $nombre_clave['password'], $nombre_clave['remember'])) {
                    //if the login is successful
                    //redirect them back to the home page. Despliegue de pantalla administrador, maestro o estudiante
                    if ($this->ion_auth->in_group('estudiante')) {
                        $datos['users_id'] = $this->session->userdata('user_id');
                        // $datos['sesion_id'] = $_GET['session_id'];
                        $datos['inicio'] = date('Y-m-d H: i: s');
                        $this->sesion_model->registra_informacion_inicio_sesion($datos);
                    }
                    $this->session->set_flashdata('message', $this->ion_auth->messages());
                    redirect('/', 'refresh');
                } else {
                    // if the login was un-successful
                    // redirect them back to the login page
                    $this->session->set_flashdata('message', (validation_errors()) ? validation_errors() : $this->ion_auth->errors());
                    $this->muestra_pantalla_autenticacion();

                    //redirect('auth/muestra_pantalla_autenticacion', 'refresh'); // use redirects instead of loading views for compatibility with MY_Controller libraries
                }
            } else {
                // if the login was un-successful
                // redirect them back to the login page
                $this->session->set_flashdata('message', $this->ion_auth->errors());
                $this->muestra_pantalla_autenticacion();

                //  redirect('auth/muestra_pantalla_autenticacion', 'refresh'); // use redirects instead of loading views for compatibility with MY_Controller libraries
            }
        } else {
            $this->session->set_flashdata('message', '<div class = "text-  alert alert-success">'
                    . '<a class = "  close  " data-dismiss = "alert" >X</a>'
                    . '<i class = "glyphicon glyphicon-exclamation-sign" style = "transform:scale(1.5);"></i>&nbsp;
                    &nbsp;
                    &nbsp;
                    '
                    . 'Datos de acceso incompletos.</div>');
            $this->muestra_pantalla_autenticacion();
        }
        /* $this->form_validation->set_rules('identity', 'Usuario', 'required');
          $this->form_validation->set_rules('password', 'Contraseña', 'required');
          $this->form_validation->set_message('required', '%s es un campo requerido');
          if ($this->form_validation->run() == true) {
          // check to see if the user is logging in
          if ($this->ion_auth->login($nombre_clave['identity'], $nombre_clave['password'], $nombre_clave['remember'])) {
          //if the login is successful
          //redirect them back to the home page. Despliegue de pantalla administrador, maestro o estudiante
          if ($this->ion_auth->in_group('estudiante')) {
          $datos['users_id'] = $this->session->userdata('user_id');
          // $datos['sesion_id'] = $_GET['session_id'];
          $datos['inicio'] = date('Y-m-d H: i: s');
          $this->sesion_model->registra_informacion_inicio_sesion($datos);
          }
          $this->session->set_flashdata('message', $this->ion_auth->messages());
          redirect('/', 'refresh');
          } else {
          // if the login was un-successful
          // redirect them back to the login page
          $this->session->set_flashdata('message', $this->ion_auth->errors());
          redirect('auth/muestra_pantalla_autenticacion', 'refresh'); // use redirects instead of loading views for compatibility with MY_Controller libraries
          }
          } else {
          $this->session->set_flashdata('message', $this->ion_auth->errors());
          $this->muestra_pantalla_autenticacion();
          //redirect("auth/muestra_pantalla_autenticacion");
          } */
    }

    public function muestra_pantalla_administrador() {
        $usuario['usuario'] = $this->load->view('pagina/usuario', '', true);
        $this->data['menu'] = $this->load->view('pagina/menu_admin', $usuario, true);
        $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
        //list the users  lista de usuarios
        $this->data['users'] = $this->ion_auth->users()->result();
        foreach ($this->data['users'] as $k => $user) {
            $this->data['users'][$k]->groups = $this->ion_auth->get_users_groups($user->id)->result();
        }
        $title['title'] = "Administrador: usuarios";
        $this->data['header_html'] = $this->load->view('pagina/encabezado_html', $title, true);
        $this->data['header'] = $this->load->view('pagina/encabezado_pagina', '', true);
        $this->data['footer'] = $this->load->view('pagina/pie_pagina', '', true);
        //renderizacion de  la pagina autenticacion
        $this->_render_page('auth/administrador', $this->data);
        // redirect('administrador_controller/obtiene_usuarios','refresh');
    }

    public function muestra_pantalla_maestro() {
        /* $this->load->library('menu');
          $menu = new Menu;
          $this->data['header_html'] = $this->load->view('pagina/encabezado_html', '', true);
          $this->data['header'] = $this->load->view('pagina/encabezado_pagina', '', true);
          $this->data['menu'] = $menu->show_menu(2);
          $this->data['footer'] = $this->load->view('pagina/pie_pagina', '', true);
          $this->data['title'] = "Inicio de sesion";
          //renderizacion de  la pagina autenticacion
          $this->_render_page('maestro', $this->data); */
        redirect('maestro_controller/obtiene_cursos');
    }

    public function muestra_pantalla_estudiante() {
        $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
        $title['title'] = "Estudiante";
        $this->data['header_html'] = $this->load->view('pagina/encabezado_html', $title, true);
        $menu['menu'] = $this->load->view('pagina/menu_estudiante','', true);
        $this->data['header'] = $this->load->view('pagina/encabezado_pagina', $menu, true);
        $this->data['mis_cursos'] = $this->lista_inscripcion_model->obtiene_mis_cursos($this->session->userdata('user_id'));
        $this->data['footer'] = $this->load->view('pagina/pie_pagina', '', true);
        //renderizacion de  la pagina autenticacion
        $this->_render_page('estudiante', $this->data);
    }

    public function muestra_pantalla_registrar() {
        $this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));
        $this->data['username'] = array(
            'name' => 'username', 'id' => 'username', 'type' => 'text',
            'value' => $this->form_validation->set_value('username'),
            'class' => 'text-center form-control', //añadido
            'placeholder' => 'Nombre de usuario', //añadido
            'required' => 'true', //añadido
            'autofocus' >= "autofocus", //añadido,
            'pattern' => ".{9,30}", 'title' => "Ejemplo: maestro de algoritmos o so9011559. (9 a 30 caracteres) "
        );
        $this->data['nombre'] = array(
            'name' => 'nombre', 'id' => 'Nombre', 'type' => 'text',
            'value' => $this->form_validation->set_value('nombre'),
            'class' => 'text-center form-control', //añadido
            'placeholder' => 'Nombre a mostrar', //añadido
            'required' => 'true', //añadido
            'autofocus' >= "autofocus", //añadido
            'pattern' => ".{9,50}", 'title' => "Ejemplo: mi nombre. (9 a 50  caracteres)"
        );
        $this->data['email'] = array(
            'name' => 'email', 'id' => 'email', 'type' => 'email',
            'value' => $this->form_validation->set_value('email'),
            'class' => 'text-center form-control', //añadido
            'placeholder' => 'Correo electronico', //añadido
            'required' => 'true', //añadido
            'autofocus' >= "autofocus", //añadido
            'title' => 'Ejemplo: ejemplo@dominio.com', //añadido
            'pattern' => "[A-Za-z0-9._%+-]+@[a-z0-9.-]+\.[A-Za-z]{3,10}$"
        );
        $this->data['password'] = array(
            'name' => 'password', 'id' => 'password', 'type' => 'password',
            'value' => $this->form_validation->set_value('password'),
            'class' => 'text-center form-control', //añadido
            'placeholder' => 'contraseña', //añadido
            'required' => 'true', //añadido
            'autofocus' >= "autofocus", //añadido
            'title' => 'Ejemplo: ********. (9 a 30 caracteres)', //añadido
            'pattern' => ".{9,30}"
        );
        $this->data['password_confirm'] = array(
            'name' => 'password_confirm', 'id' => 'password_confirm', 'type' => 'password',
            'value' => $this->form_validation->set_value('password_confirm'),
            'class' => 'text-center form-control', //añadido
            'placeholder' => 'confirmar contraseña', //añadido
            'required' => 'true', //añadido
            'autofocus' >= "autofocus", //añadido
            'title' => 'Ejemplo: ********. (9 a 30 caracteres) ', //añadido
            'pattern' => ".{9,30}"
        );
        $title['title'] = "Registar datos de usuario";
        $this->data['header_html'] = $this->load->view('pagina/encabezado_html', $title, true);
        $menu['menu'] = $this->load->view('pagina/menu', '', true);
        $this->data['header'] = $this->load->view('pagina/encabezado_pagina', $menu, true);
        $this->data['footer'] = $this->load->view('pagina/pie_pagina', '', true);
        $this->_render_page('auth/registrar', $this->data);
    }

    public function muestra_msj_requeridos() {
        
    }

    public function muestra_msj_incorrectos() {
        
    }

    public function muestra_msj_no_activo() {
        
    }

    public function ingresa_datos_registrar() {
        $datos['username'] = $this->input->post('username');
        $datos['nombre'] = $this->input->post('nombre');
        $datos['email'] = $this->input->post('email');
        $datos['password'] = $this->input->post('password');
        $datos['password_confirm'] = $this->input->post('password_confirm');
        $datos['group'] = 0;
        $rol1 = $this->input->post('estudiante');
        $rol2 = $this->input->post('maestro');
        if ($rol1 == 2) {
            $datos['group'] = array($rol1);
        } elseif ($rol2 == 3) {
            $datos['group'] = array($rol2);
        }
        return $datos;
    }

    public function valida_entradas() {
        $tables = $this->config->item('tables', 'ion_auth');
        //validate form input
        $this->form_validation->set_rules('username', 'usuario', 'required|min_length[9]|max_length[30]');
        $this->form_validation->set_rules('nombre', 'nombre', 'required|min_length[9]|max_length[50]');
        $this->form_validation->set_rules('email', 'email', 'required|valid_email|min_length[10]|max_length[60]'); //|callback_existecorreo
        $this->form_validation->set_rules('password', 'contraseña', 'required|matches[password_confirm]|min_length[9]|max_length[20]');
        $this->form_validation->set_rules('password_confirm', 'confirmar contraseña', 'required|min_length[9]|max_length[20]');
        // $this->form_validation->set_rules('required', '%s es requerido');
        if ($this->form_validation->run() == true) {
            $datos = $this->ingresa_datos_registrar();
        }
        if ($this->form_validation->run() == true && $this->ion_auth->register($datos['username'], $datos['password'], $datos['email'], $datos['nombre'], $datos['group'])) {
            //check to see if we are creating the user
            //redirect them back to the admin page
            $this->session->set_flashdata('message', $this->ion_auth->messages());
            $this->index();
//redirect("/", 'refresh');
        } else {
            $this->muestra_pantalla_registrar();
        }
    }

    public function muestra_pantalla_recuperar() {
        $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
        $title['title'] = "Recuperar datos de acceso";
        $this->data['header_html'] = $this->load->view('pagina/encabezado_html', $title, true);
        $menu['menu'] = $this->load->view('pagina/menu', '', true);
        $this->data['header'] = $this->load->view('pagina/encabezado_pagina', $menu, true);
        $this->data['footer'] = $this->load->view('pagina/pie_pagina', '', true);
        $this->_render_page('auth/recuperar', $this->data);
    }

    public function ingresa_usuario() {
        
    }

    public function valida_entradas_recuperar_datos() {
        if ($this->config->item('identity', 'ion_auth') != 'email') {
            $this->form_validation->set_rules('identity', $this->lang->line('forgot_password_identity_label'), 'required');
        } else {
            $this->form_validation->set_rules('email', $this->lang->line('forgot_password_validation_email_label'), 'required|valid_email');
        }
        if ($this->form_validation->run() == false) {
            // setup the input
            $this->data['email'] = array('name' => 'email',
                'id' => 'email');
            if ($this->config->item('identity', 'ion_auth') != 'email') {
                $this->data['identity_label'] = $this->lang->line('forgot_password_identity_label');
            } else {
                $this->data['identity_label'] = $this->lang->line('forgot_password_email_identity_label');
            }
            // set any errors and display the form
            $this->muestra_pantalla_recuperar();
        } else {
            $identity_column = $this->config->item('identity', 'ion_auth');
            $identity = $this->ion_auth->where($identity_column, $this->input->post('identity'))->users()->row();
            if (empty($identity)) {
                if ($this->config->item('identity', 'ion_auth') != 'email') {
                    $this->ion_auth->set_error('forgot_password_identity_not_found');
                } else {
                    $this->ion_auth->set_error('forgot_password_email_not_found');
                }
                $this->session->set_flashdata('message', $this->ion_auth->errors());
                //redirect("auth/forgot_password", 'refresh');
                redirect("auth/determina_existencia_usuario", 'refresh');
            }
            // run the forgotten password method to email an activation code to the user
            $forgotten = $this->ion_auth->forgotten_password($identity->{$this->config->item('identity', 'ion_auth')});
            if ($forgotten) {
                // if there were no errors
                redirect('auth/muestra_pantalla_autenticacion', 'refresh');
            } else {
                $this->session->set_flashdata('message', $this->ion_auth->errors());
                //redirect("auth/forgot_password", 'refresh');
                redirect("auth/determina_existencia_usuario", 'refresh');
            }
        }
    }

    public function desactiva($id = NULL) {
        if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin()) {
            // redirect them to the home page because they must be an administrator to view this
            return show_error('No tienes permisos suficientes para realizar esta accion.');
        }

        $id = (int) $id;

        $this->load->library('form_validation');
        $this->form_validation->set_rules('confirm', $this->lang->line('deactivate_validation_confirm_label'), 'required');
        $this->form_validation->set_rules('id', $this->lang->line('deactivate_validation_user_id_label'), 'required|alpha_numeric');

        if ($this->form_validation->run() == FALSE) {
            // insert csrf check
            $this->data['csrf'] = $this->_get_csrf_nonce();
            $this->data['user'] = $this->ion_auth->user($id)->row();

            //$this->data['header_html'] = $this->load->view('pagina/encabezado_html', '', true);
            // $this->data['header'] = $this->load->view('pagina/encabezado_pagina', '', true);
            // $this->data['menu'] = $this->load->view('pagina/menu', '', true);
            // $this->data['footer'] = $this->load->view('pagina/pie_pagina', '', true);
            $this->_render_page('auth/desactivar', $this->data);
        } else {
            // do we really want to deactivate?
            if ($this->input->post('confirm') == 'yes') {
                // do we have a valid request?
                if ($this->_valid_csrf_nonce() === FALSE || $id != $this->input->post('id')) {
                    show_error($this->lang->line('error_csrf'));
                }

                // do we have the right userlevel?
                if ($this->ion_auth->logged_in() && $this->ion_auth->is_admin()) {
                    $this->ion_auth->deactivate($id);
                }
            }

            // redirect them back to the auth page
            redirect('auth', 'refresh');
        }
    }

    public function editar_usuario($id) {
        if (!$this->ion_auth->logged_in() || (!$this->ion_auth->is_admin() && !($this->ion_auth->user()->row()->id == $id))) {
            redirect('auth', 'refresh');
        }
        $user = $this->ion_auth->user($id)->row();
        $groups = $this->ion_auth->groups()->result_array();
        $currentGroups = $this->ion_auth->get_users_groups($id)->result();
        // validate form input
        $this->form_validation->set_rules('username', 'Usuario', 'required');
        $this->form_validation->set_rules('nombre', 'Nombre', 'required');
        $this->form_validation->set_rules('email', 'Correo electronico', 'required');
        $this->form_validation->set_rules('password', 'Contraseña', 'required');
        $this->form_validation->set_rules('password_confirm', 'Confirmar contraseña', 'required');
        if (isset($_POST) && !empty($_POST)) {
            // do we have a valid request?
            if ($this->_valid_csrf_nonce() === FALSE || $id != $this->input->post('id')) {
                show_error($this->lang->line('error_csrf'));
            }
            // update the password if it was posted
            if ($this->input->post('password')) {
                $this->form_validation->set_rules('password', $this->lang->line('edit_user_validation_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]');
                $this->form_validation->set_rules('password_confirm', $this->lang->line('edit_user_validation_password_confirm_label'), 'required');
            }
            if ($this->form_validation->run() === TRUE) {
                $data = array(
                    'username' => $this->input->post('username'),
                    'nombre' => $this->input->post('nombre'),
                    'email' => $this->input->post('email'),
                    'password' => $this->input->post('password'),
                );
                // update the password if it was posted
                if ($this->input->post('password')) {
                    $data['password'] = $this->input->post('password');
                }
                // Only allow updating groups if user is admin
                if ($this->ion_auth->is_admin()) {
                    //Update the groups user belongs to
                    $groupData = $this->input->post('groups');
                    if (isset($groupData) && !empty($groupData)) {
                        $this->ion_auth->remove_from_group('', $id);
                        foreach ($groupData as $grp) {
                            $this->ion_auth->add_to_group($grp, $id);
                        }
                    }
                }
                // check to see if we are updating the user
                if ($this->ion_auth->update($user->id, $data)) {
                    // redirect them back to the admin page if admin, or to the base url if non admin
                    $this->session->set_flashdata('message', $this->ion_auth->messages());
                    if ($this->ion_auth->is_admin()) {
                        redirect('auth', 'refresh');
                    } else {
                        redirect('/', 'refresh');
                    }
                } else {
                    // redirect them back to the admin page if admin, or to the base url if non admin
                    $this->session->set_flashdata('message', $this->ion_auth->errors());
                    if ($this->ion_auth->is_admin()) {
                        redirect('auth', 'refresh');
                    } else {
                        redirect('/', 'refresh');
                    }
                }
            }
        }

        // display the edit user form
        $this->data['csrf'] = $this->_get_csrf_nonce();
        // set the flash data error message if there is one
        $this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));
        // pass the user to the view
        $this->data['user'] = $user;
        $this->data['groups'] = $groups;
        $this->data['currentGroups'] = $currentGroups;
        $this->data['username'] = array(
            'name' => 'username',
            'id' => 'username',
            'type' => 'text',
            'value' => $this->form_validation->set_value('username'),
        );
        $this->data['nombre'] = array(
            'name' => 'nombre',
            'id' => 'nombre',
            'type' => 'text',
            'value' => $this->form_validation->set_value('nombre'),
        );
        $this->data['email'] = array(
            'name' => 'email',
            'id' => 'email',
            'type' => 'text',
            'value' => $this->form_validation->set_value('email'),
        );
        $this->data['password'] = array(
            'name' => 'password',
            'id' => 'password',
            'type' => 'text',
            'value' => $this->form_validation->set_value('password'),
        );

        $this->data['password_confirm'] = array(
            'name' => 'password_confirm',
            'id' => 'password_confirm',
            'type' => 'password'
        );

        $this->_render_page('auth/edit_user', $this->data);
    }

    public function muestra_pantalla_editar($id) {
        if (!$this->ion_auth->logged_in() || (!$this->ion_auth->is_admin() && !($this->ion_auth->user()->row()->id == $id))) {
            redirect('auth', 'refresh');
        }
        $user = $this->ion_auth->user($id)->row();
        $groups = $this->ion_auth->groups()->result_array();
        $currentGroups = $this->ion_auth->get_users_groups($id)->result();
        // validate form input
        $this->form_validation->set_rules('username', 'usuario', 'required|min_length[8]|max_length[60]');
        $this->form_validation->set_rules('nombre', 'nombre', 'required|min_length[8]|max_length[60]');
        $this->form_validation->set_rules('email', 'correo electronico', 'required|valid_email|min_length[10]|max_length[60]');
        $this->form_validation->set_rules('password', 'contraseña', 'required|matches[password_confirm]|min_length[8]|max_length[60]');
        $this->form_validation->set_rules('password_confirm', 'confirmar contraseña', 'required|min_length[8]|max_length[60]');
        if (isset($_POST) && !empty($_POST)) {
            // do we have a valid request?
            // if ($this->_valid_csrf_nonce() === FALSE || $id != $this->input->post('id')) {
            //   show_error($this->lang->line('error_csrf'));
            //   }
            // update the password if it was posted
            if ($this->input->post('password')) {
                $this->form_validation->set_rules('password', $this->lang->line('edit_user_validation_password_label'), 'required|min_length[8]|max_length[30]|matches[password_confirm]');
                $this->form_validation->set_rules('password_confirm', $this->lang->line('edit_user_validation_password_confirm_label'), 'required|min_length[8]|max_length[30]');
            }
            if ($this->form_validation->run() === TRUE) {
                $data = array(
                    'username' => $this->input->post('username'),
                    'nombre' => $this->input->post('nombre'),
                    'email' => $this->input->post('email'),
                );
                // update the password if it was posted
                if ($this->input->post('password')) {
                    $data['password'] = $this->input->post('password');
                }
                // Only allow updating groups if user is admin
                if ($this->ion_auth->is_admin()) {
                    //Update the groups user belongs to
                    $groupData = $this->input->post('groups');
                    if (isset($groupData) && !empty($groupData)) {
                        $this->ion_auth->remove_from_group('', $id);
                        foreach ($groupData as $grp) {
                            $this->ion_auth->add_to_group($grp, $id);
                        }
                    }
                }
                // check to see if we are updating the user
                if ($this->ion_auth->update($user->id, $data)) {
                    // redirect them back to the admin page if admin, or to the base url if non admin
                    $this->session->set_flashdata('message', $this->ion_auth->messages());
                    if ($this->ion_auth->is_admin()) {
                        //$this->muestra_pantalla_administrador();
                        redirect('auth', 'refresh');
                    } else {
                        redirect('/', 'refresh');
                    }
                } else {
                    // redirect them back to the admin page if admin, or to the base url if non admin
                    $this->session->set_flashdata('message', $this->ion_auth->errors());
                    if ($this->ion_auth->is_admin()) {
                        $this->muestra_pantalla_administrador();
                        //  redirect('auth/muestra_pantalla_administrador', 'refresh');
                    } else {
                        redirect('/', 'refresh');
                    }
                }
            }
        }
        // display the edit user form
        $this->data['csrf'] = $this->_get_csrf_nonce();
        // set the flash data error message if there is one
        $this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));
        // pass the user to the view
        $this->data['user'] = $user;
        $this->data['groups'] = $groups;
        $this->data['currentGroups'] = $currentGroups;
        $this->data['username'] = array(
            'name' => 'username', 'id' => 'username', 'type' => 'text',
            'value' => $this->form_validation->set_value('username', $user->username),
            'class' => 'text-center form-control', //añadido
            'placeholder' => 'usuario', //añadido
            'required' => 'true', //añadido
            'autofocus' >= "autofocus", //añadido
            'pattern' => ".{8,30}", 'title' => "8 a 30 caracteres (ejemplo: maestro de algoritmos o so9011559) "
        );
        $this->data['nombre'] = array(
            'name' => 'nombre', 'id' => 'Nombre', 'type' => 'text',
            'value' => $this->form_validation->set_value('nombre', $user->nombre),
            'class' => 'text-center form-control', //añadido
            'placeholder' => 'Nombre a mostrar', //añadido
            'required' => 'true', //añadido
            'autofocus' >= "autofocus", //añadido
            'pattern' => ".{8,30}", 'title' => "8 a 30 caracteres (ejemplo:mtr algoritmos o estudiante) "
        );
        $this->data['email'] = array(
            'name' => 'email', 'id' => 'email', 'type' => 'email',
            'value' => $this->form_validation->set_value('email', $user->email),
            'class' => 'text-center form-control', //añadido
            'placeholder' => 'Correo electronico', //añadido
            'required' => 'true', //añadido
            'autofocus' >= "autofocus", //añadido
            'title' => 'ejemplo: ejemplo@dominio.com', //añadido
            'pattern' => "[A-Za-z0-9._%+-]+@[a-z0-9.-]+\.[A-Za-z]{3,10}$"
        );
        $this->data['password'] = array(
            'name' => 'password', 'id' => 'password', 'type' => 'password',
            'value' => $this->form_validation->set_value('password'),
            'class' => 'text-center form-control', //añadido
            'placeholder' => 'contraseña', //añadido
            'required' => 'true', //añadido
            'autofocus' >= "autofocus", //añadido
            'pattern' => ".{8,30}", 'title' => "8 a 30 caracteres (ejemplo:********) "
        );
        $this->data['password_confirm'] = array(
            'name' => 'password_confirm', 'id' => 'password_confirm', 'type' => 'password',
            'value' => $this->form_validation->set_value('password_confirm'),
            'class' => 'text-center form-control', //añadido
            'placeholder' => 'repite contraseña', //añadido
            'required' => 'true', //añadido
            'autofocus' >= "autofocus", //añadido
            'pattern' => ".{8,30}", 'title' => "8 a 30 caracteres (ejemplo:********) "
        );
        $usuario['usuario'] = $this->load->view('pagina/usuario', '', true);
        $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
        //list the users  lista de usuarios
        $this->data['users'] = $this->ion_auth->users()->result();

        $title['title'] = "Administrador: usuarios";
        $this->data['header_html'] = $this->load->view('pagina/encabezado_html', $title, true);
        $menu['menu'] = $this->load->view('pagina/menu_admin', '', true);
        $this->data['header'] = $this->load->view('pagina/encabezado_pagina', $menu, true);
        $this->data['footer'] = $this->load->view('pagina/pie_pagina', '', true);
        //renderizacion de  la pagina autenticacion
        $this->_render_page('auth/editar', $this->data);
    }

    function determina_existencia_usuario() {
        // setting validation rules by checking wheather identity is username or email
        //if ($this->config->item('identity', 'ion_auth') != 'email') {
        $this->form_validation->set_rules('email', $this->lang->line('forgot_password_identity_label'), 'required');
        // } else {
        //   $this->form_validation->set_rules('email', $this->lang->line('forgot_password_validation_email_label'), 'required|valid_email');
        // }
        if ($this->form_validation->run() == false) {
            // setup the input
            $this->data['email'] = array('name' => 'email',
                'id' => 'email',
            );
            //  if ($this->config->item('identity', 'ion_auth') != 'email') {
            $this->data['identity_label'] = $this->lang->line('forgot_password_identity_label');
            //   } else {
            //     $this->data['identity_label'] = $this->lang->line('forgot_password_email_identity_label');
            //  }
            // set any errors and display the form
            $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
            $this->muestra_pantalla_recuperar();
//  $this->_render_page('auth/re', $this->data);
        } else {
            $identity_column = $this->config->item('identity', 'ion_auth');
            $identity = $this->ion_auth->where($identity_column, $this->input->post('email'))->users()->row();

            if (empty($identity)) {

                // if ($this->config->item('identity', 'ion_auth') != 'email') {
                $this->ion_auth->set_error('forgot_password_identity_not_found');
                // } else {
                //     $this->ion_auth->set_error('forgot_password_email_not_found');
                // }

                $this->session->set_flashdata('message', $this->ion_auth->errors());
                redirect("auth/muestra_pantalla_recuperar", 'refresh');
            }

            // run the forgotten password method to email an activation code to the user
            $forgotten = $this->ion_auth->forgotten_password($identity->{$this->config->item('identity', 'ion_auth')});

            if ($forgotten) {
                // if there were no errors
                $this->session->set_flashdata('message', $this->ion_auth->messages());
                redirect("auth/", 'refresh'); //we should display a confirmation page here instead of the login page
            } else {
                $this->session->set_flashdata('message', $this->ion_auth->errors());
                redirect("auth/muestra_pantalla_recuperar", 'refresh   

               

             

                 

                  

              

               

            

              

             

            

                

            

                

                  

             

                  

                 

               ');
            }
        }
    }

    //#################### Fin de metodos agregados laa libreria Ion auth ############################
################################################################################################################
}
