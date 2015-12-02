<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Usuario_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->Database('default');
    }
function existe_correo($c){
        $this->db->where('email', $c);
        $query = $this->db->get('users');
        if ($query->num_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
}
    public function busca_usuario($nombre, $clave) {
        $this->db->where('nombre_usuario', $nombre);
        $this->db->where('clave', $clave);
        $query = $this->db->get('usuario');
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return FALSE;
        }
    }

    public function busca_usuario2($nombre, $clave) {
        $this->db->where('nombre_usuario', $nombre);
        $this->db->where('clave', $clave);
        $query = $this->db->get('usuario');
        if ($query->num_rows() == 1) {
            return $query->row();
        } else {
            return FALSE;
        }
    }

    public function obten_datos_incorrectos() {
        $this->db->where('nombre', $nombre);
        $this->db->where('clave', $clave);
        $query = $this->db->get('usuario');
        if ($query->num_rows() == 1) {
            return $query->row();
        } else {
            return NULL;
        }
    }

    public function obten_acceso($nombre, $clave) {
        $this->db->where('nombre_usuario', $nombre);
        $this->db->where('clave', $clave);
        $query = $this->db->get('usuario');
       
        foreach ($query->result() as $row) {
            if($row->acceso <=1){
                return $row->acceso;
            }else{
                return NULL;
            }
        }
               
    }

    public function determina_existencia($mail) {
        $this->db->where('correo_electronico', $mail);
        $query = $this->db->get('usuario');
        if ($query->num_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function obtiene_datos($mail) {
        $this->db->where('correo_electronico', $mail);
        $query = $this->db->get('usuario');
        if ($query->num_rows() > 0) {
            return $query->result();   //result();
        } else {
            return NULL;
        }
    }

    public function determina_existencia_usuario($datos) {
        $this->db->where('nombre_usuario', $datos['nombre_usuario']);
        $query = $this->db->get('usuario');
        if ($query->num_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function crea_usuario($datos) {
        $this->db->insert('usuario', $datos);
        return $this->db->insert_id();
    }

}
