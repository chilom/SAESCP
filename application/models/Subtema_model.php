<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Subtema_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->Database('default');
    }

    public function obtiene_nombre($subtema) {
        $this->db->select('nombre');
        $this->db->where('subtema.id', $subtema);
        $query = $this->db->get('subtema');
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return null;
        }
    }

    public function crea_subtema($datos_stema) {
        $this->db->insert('subtema', $datos_stema);
        return $this->db->insert_id();
    }

    public function verifica_existencia_subtema($subtema) {
        $this->db->where('tema_id', $subtema['tema_id']);
        $this->db->where('numero ', $subtema['numero']);
         $this->db->where('nombre ', $subtema['nombre']);
        // $this->db->where('descripcion  ', $subtema['descripcion']);
        $query = $this->db->get('subtema');
        if ($query->num_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function obtiene_subtemas($id) {
        $this->db->select('id,numero,nombre');
        $this->db->where('tema_id', $id);
        $query = $this->db->get('subtema');
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return NULL;
        }
    }

    public function obtiene_subtema($tema) {
        // $this->db->distinct();
        /* SELECT  
          tema.numero AS nt,tema.nombre AS nombtet,
          subtema.numero AS ns,subtema.nombre AS nombres,
          subsubtema.numero AS nss,subsubtema.nombre  AS nombress
          FROM tema
          INNER JOIN subtema ON subtema.tema_id=tema.id
          LEFT JOIN subsubtema ON subsubtema.subtema_id=subtema.id

          ORDER BY(tema.numero) */
        $this->db->select('tema.id AS idt, tema.numero AS nt,tema.nombre AS nombret,
            subtema.id AS ids,subtema.numero AS ns,subtema.nombre AS nombres');
//subsubtema.numero AS nss,subsubtema.nombre  AS nombress');
        $this->db->from('tema');
        $this->db->where('subtema.tema_id', $tema);
        //    $this->db->join('curso', 'curso.id=tema.curso_id', 'left');
        $this->db->join('subtema', 'subtema.tema_id=tema.id', 'inner');
        //   $this->db->join('subsubtema', 'subsubtema.subtema_id=subtema.id','left');
        $this->db->order_by('tema.numero,subtema.numero');
        // $this->db->group_by('subtema.numero');        
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return NULL;
        }
    }

}
