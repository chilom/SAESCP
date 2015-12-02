<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Curso_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->Database('default');
    }

    /* public function obtiene_cursos() {
      $query = $this->db->get('curso');
      $arrDatos[''] = '-Selecciona curso-';
      if ($query->num_rows() > 0) {
      foreach ($query->result() as $row) {
      $arrDatos[htmlspecialchars($row->id, ENT_QUOTES)] = htmlspecialchars($row->nombre, ENT_QUOTES);
      };
      return $arrDatos;
      } else {
      return NULL;
      }
      } */

    public function obtiene_cursos() {
        $this->db->select('id,nombre');
        $query = $this->db->get('curso');
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return NULL;
        }
    }

    public function obtiene_x_id($id) {
        /* SELECT 	curso.nombre	FROM curso
          JOIN inscripcion ON inscripcion.curso_idcurso=curso.idcurso
          JOIN usuario ON inscripcion.usuario_id_usuario=usuario.id_usuario
          WHERE  inscripcion.usuario_id_usuario=3;         /*
         */
        //$this->db->distinct();
        $this->db->from('curso');
        $this->db->join('inscripcion', 'inscripcion.curso_idcurso=curso.idcurso');
        $this->db->join('usuario', 'inscripcion.usuario_id_usuario=usuario.id_usuario');
        $this->db->where('inscripcion.usuario_id_usuario', $id);
        $this->db->where('inscripcion.inscrito', '1');
        // $this->db->group_by('curso.nombre');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return NULL;
        }
    }
	 public function verifica_existencia_cursos(){
	 $this->db->from('curso');
	         $query = $this->db->get();
			 if($query->num_rows()>0){
			 return true;
			 }else{return false;}

	 }

}
