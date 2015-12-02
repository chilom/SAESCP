<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Actividades_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->Database('default');
    }
    public function verifica_si_actividad_termino($id) {
        $this->db->where('actividad_id', $id);
        $this->db->where('terminada', '1');
        $existe = $this->db->get('reg_actividad');
        if ($existe->num_rows() > 0) {
            return '1';
        } else {

            return null;
        }
    }

    public function registra_fin_actividad($datos) {
        $this->db->where('users_id', $datos['users_id']);
        $this->db->where('actividad_id', $datos['actividad_id']);
        $this->db->where('comenzada', '1');
        $this->db->where('terminada', '0');
        return $this->db->update('reg_actividad', $datos);
    }

    public function registra_inicio_actividad($datos) {
        $this->db->where('comenzada', $datos['comenzada']);
        $this->db->where('users_id', $datos['users_id']);
        $this->db->where('actividad_id', $datos['actividad_id']);
        $existe = $this->db->get('reg_actividad');
        if ($existe->num_rows() > 0) {
            //$this->db->where('users_id', $datos['users_id']);
            //$this->db->where('contenido_id', $datos['contenido_id']);
            return null; //$this->db->update('reg_contenido', $datos);
        } else {
            $this->db->insert('reg_actividad', $datos);
            return $this->db->insert_id();
        }
    }

    public function crea_actividad($datos) {
        $this->db->insert('actividad', $datos);
        return $this->db->insert_id();
    }

    public function verifica_existencia($actividad) {
        $this->db->where('subtema_id ', $actividad['subtema_id']);
        $this->db->where('subsubtema_id ', $actividad['subsubtema_id']);
        $this->db->where('url ', $actividad['url']);
        $this->db->where('nombre_actividad ', $actividad['nombre_actividad']);
        $query = $this->db->get('actividad');
        if ($query->num_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function obtiene_actividades_subsubtema($subsubtema) {
        //$id = $this->db->select('id')->where('nombre', $subsubtema)->get('subsubtema');
        $this->db->where('subsubtema_id ', $subsubtema);
        $query = $this->db->get('actividad');
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return null;
        }
    }

    public function obtiene_actividades_tema($subsubtema) {
        //$id = $this->db->select('id')->where('nombre', $subsubtema)->get('subsubtema');
        $this->db->where('tema_id ', $subsubtema);
        $this->db->where('subtema_id ', null);
        $this->db->where('subsubtema_id ', null);
        $query = $this->db->get('actividad');
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return null;
        }
    }

}
