
<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Subsubtema_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->Database('default');
    }
    public function obtiene_nombre($subsubtema){
        $this->db->select('nombre');
        $this->db->where('subsubtema.id', $subsubtema);
        $query = $this->db->get('subsubtema');
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return null;
        }
    }

    function crea_subsubtema($datos_sstema) {
        $this->db->insert('subsubtema', $datos_sstema);
        return $this->db->insert_id();
    }

    function verifica_existencia_subsubtema($subsubtema) {
        $this->db->where('subtema_id', $subsubtema['subtema_id']);
        $this->db->where('numero ', $subsubtema['numero']);
        $this->db->where('nombre ', $subsubtema['nombre']);
        //  $this->db->where('descripcion  ', $subsubtema['descripcion']);
        $query = $this->db->get('subsubtema');
        if ($query->num_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function obtiene_subsubtema($subtema) {
       // $this->db->distinct();
        /* SELECT  
          tema.numero AS nt,tema.nombre AS nombtet,
          subtema.numero AS ns,subtema.nombre AS nombres,
          subsubtema.numero AS nss,subsubtema.nombre  AS nombress
          FROM tema
          INNER JOIN subtema ON subtema.tema_id=tema.id
          LEFT JOIN subsubtema ON subsubtema.subtema_id=subtema.id

          ORDER BY(tema.numero) */

        $this->db->select('curso.nombre , tema.id AS idt,tema.numero AS nt,
            subtema.numero AS ns,tema.nombre AS nombret,subsubtema.id AS idss,
            subsubtema.numero AS nss,subsubtema.nombre  AS nombress');
       // $this->db->from('tema');
        $this->db->where('subsubtema.subtema_id', $subtema);
        $this->db->join('curso', 'curso.id=tema.curso_id', 'left');
        $this->db->join('subtema', 'subtema.tema_id=tema.id', 'left');
        $this->db->join('subsubtema', 'subsubtema.subtema_id=subtema.id', 'left');
        $this->db->order_by('subsubtema.numero');
        // $this->db->group_by('subtema.numero');        
        $query = $this->db->get('tema');
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return NULL;
        }
    }

    public function obtiene_subsubtemas($id) {
        $this->db->select('id,nombre');
        $this->db->where('subtema_id', $id);
        $query = $this->db->get('subsubtema');
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return NULL;
        }
    }

}
