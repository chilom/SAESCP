<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Tema_model extends CI_Model {

    public $datos_tema = null;

    public function __construct() {
        parent::__construct();
        $this->load->Database('default');
    }

    public function obtiene_nombre_tema($id) {
        $this->db->distinct();
        $this->db->select('tema.nombre AS nombret');
        $this->db->where('tema.id', $id);
        // $this->db->join('curso', 'curso.id=tema.curso_id', 'left');
        // $this->db->join('subtema', 'subtema.tema_id=tema.id', 'left');
        // $this->db->join('subsubtema', 'subsubtema.subtema_id=subtema.id','left');
        $query = $this->db->get('tema');
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return NULL;
        }
    }

    public function obtiene_nombre_tema_s($id) {
        $this->db->distinct();
        $this->db->select('tema.nombre AS nombret');
        $this->db->where('subtema.id', $id);
        // $this->db->join('curso', 'curso.id=tema.curso_id', 'left');
         $this->db->join('subtema', 'subtema.tema_id=tema.id', 'left');
        // $this->db->join('subsubtema', 'subsubtema.subtema_id=subtema.id','left');
        $query = $this->db->get('tema');
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return NULL;
        }
    }

    public function crea_tema($datos_tema) {
        //  if(!empty($datos)){
        $this->db->insert('tema', $datos_tema);
        return $this->db->insert_id();
        // }else{
        //    return 0;
        // }
    }

    public function verifica_existencia_tema($datos_tema) {
        $this->db->where('curso_id', $datos_tema['curso_id']);
        $this->db->where('numero', $datos_tema['numero']);
      //  $this->db->where('nombre ', $datos_tema['nombre']);
        //$this->db->or_where('descripcion  ', $datos_tema['descripcion']);
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
