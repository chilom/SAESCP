<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Autenticacion_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function guarda_estado($id_usuario) {
        $this->load->library('session');
        $my_session_id = $_GET['session_id']; //gets the session ID successfully
        $this->session->userdata('session_id', $my_session_id);
        $fecha = ''; //date('D, d M Y H:i:s');
        $data = array(
            'users_id' => $id_usuario,
            'sesion_id' => $this->session->userdata('session_id'), //  $this->db->select('id')->get('sesion', 1)->result(),
//$this->session->userdata('id_sesion'),//'f6dd771fe6eb6262e9bd84e3bf19fed0d07ff076',
            'inicio' => date('Y-m-d H:i:s', now())
        );
echo ($this->session->userdata);
       // $this->db->insert('registro_sesion', $data);
    }

}
