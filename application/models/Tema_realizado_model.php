<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Tema_realizado_model extends CI_Model {

    public $datos_tema = null;

    public function __construct() {
        parent::__construct();
        $this->load->Database('default');
    }

    public function obtiene_total_cursos($estudiante) {
        $this->db->select('COUNT(curso_id) as total_c');
        $this->db->where('users_id', $estudiante);
        // $this->db->order_by('total_c', 'desc');
        $query = $this->db->get('inscripcion');
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return NULL;
        }
    }

    public function obtiene_total_temas($curso) {
        $this->db->select('COUNT(curso_id) as total_t');
        $this->db->where('curso_id', $curso);
        $query = $this->db->get('tema');
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return NULL;
        }
    }

    public function calcula_avance_curso($estudiante) {

        $this->db->distinct();
        $this->db->select('SUM(avance) as avance', FALSE);
        $this->db->from('reg_contenido');
        $this->db->where('reg_contenido.users_id', $estudiante);
        $this->db->join('contenido', 'contenido.id=reg_contenido.contenido_id', 'inner');
        //$this->db->join('subtema', 'subtema.id=contenido.subtema_id', 'inner');
        //$this->db->join('subsubtema', 'subsubtema.subtema_id=subsubtema.id');
        // $this->db->join('tema', 'tema.id=subtema.tema_id');
        //$this->db->join('curso', 'curso.id=tema.id');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return NULL;
        }
    }

    public function verifica_existencia_tema($datos_tema) {
        $this->db->where('curso_id ', $datos_tema['curso_id']);
        $this->db->where('numeroTema ', $datos_tema['numeroTema']);
        $this->db->where('nombre ', $datos_tema['nombre']);
        $this->db->where('descripcion  ', $datos_tema['descripcion']);
        $query = $this->db->get('tema');
        if ($query->num_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function obtiene_temas($curso) {
        $this->db->select('id,nombre');
        $this->db->where('curso_id', $curso);
        $query = $this->db->get('tema');
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return NULL;
        }
    }

}
