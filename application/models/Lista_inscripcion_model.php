<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Lista_inscripcion_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function verifica_no_inscrito($datos_inscripcion) {
        $this->db->where('curso_id', $datos_inscripcion['curso_id']);
        $this->db->where('users_id', $datos_inscripcion['users_id']);
      //  $this->db->where('activo', 1);
        $query = $this->db->get('inscripcion');
        if ($query->num_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function guarda_cambios($datos_inscripcion) {
        $this->db->insert('inscripcion', $datos_inscripcion);
        return $this->db->insert_id();
    }

    function obtiene_lista_inscripcion() {
        $this->db->select('users_id, username');
        $this->db->from('inscripcion');
        $this->db->join('users', 'users.id=inscripcion.users_id');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return NULL;
        }
    }

    function obtiene_mis_cursos($id) {
        $this->db->select('inscripcion.curso_id, curso.nombre');
        $this->db->from('inscripcion');
        $this->db->where('users_id', $id);
        $this->db->where('activo', 1);
        $this->db->join('curso', 'curso.id=inscripcion.curso_id');
        $this->db->join('users', 'users.id=inscripcion.users_id');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return NULL;
        }
    }

    public function verifica_activo($datos) {
     //   $this->db->from('inscripcion');
        $this->db->where('users_id', $datos['users_id']);
        $this->db->where('curso_id', $datos['curso_id']);
        $this->db->where('activo', $datos['activo']);
        $this->db->join('curso', 'curso.id=inscripcion.curso_id');
        $this->db->join('users', 'users.id=inscripcion.users_id');
        $query = $this->db->get('inscripcion');
        if ($query->num_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

}
