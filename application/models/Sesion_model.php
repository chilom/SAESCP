<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Sesion_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function cierra_sesion() {
        $this->session->sess_destroy();
        redirect('/');
    }

    public function registra_ultima_actividad($datos) {
        $this->db->insert('actividad_estudiante', $datos);
        return $this->db->insert_id();
    }

    public function obtiene_informacion_sesion($usuario) {
        
    }

    public function registra_informacion_inicio_sesion($datos) {
        $this->db->insert('reg_sesion', $datos);
        return $this->db->insert_id();
    }

    public function registra_informacion_fin_sesion($datos) {
        $this->db->select('id');
        $this->db->where('users_id', $datos['users_id']);
        $id = $this->db->get('reg_sesion')->row();
        $data = array(
            'fin' => $datos['fin'],
        );
        $this->db->where('users_id', $datos['users_id']);
        $this->db->update('reg_sesion', $data);
    }

}
