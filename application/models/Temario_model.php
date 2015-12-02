<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Temario_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        //$this->load->Database('default');
    }

    public function obten_nombre_curso($curso) {
        $this->db->select('curso.nombre AS nombrec');
        $this->db->where('id', $curso);
        $query = $this->db->get('curso');
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return null;
        }
    }

    public function obtiene_tema($curso) {
        $this->db->distinct();
        /* SELECT  
          tema.numero AS nt,tema.nombre AS nombtet,
          subtema.numero AS ns,subtema.nombre AS nombres,
          subsubtema.numero AS nss,subsubtema.nombre  AS nombress
          FROM tema
          INNER JOIN subtema ON subtema.tema_id=tema.id
          LEFT JOIN subsubtema ON subsubtema.subtema_id=subtema.id

          ORDER BY(tema.numero) */
        $this->db->select('curso.nombre , tema.id AS idt,tema.numero AS nt,tema.nombre AS nombret'); //,
//subtema.numero AS ns,subtema.nombre AS nombres,
//subsubtema.numero AS nss,subsubtema.nombre  AS nombress');
        $this->db->from('tema');
        $this->db->where('tema.curso_id', $curso);
        $this->db->join('curso', 'curso.id=tema.curso_id', 'left');
        // $this->db->join('subtema', 'subtema.tema_id=tema.id', 'left');
        // $this->db->join('subsubtema', 'subsubtema.subtema_id=subtema.id','left');
        $this->db->order_by('tema.numero');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return NULL;
        }
    }

    public function obtiene_subtema2($tema) {
        $this->db->distinct();
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
        $this->db->join('curso', 'curso.id=tema.curso_id', 'inner');
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

    public function obtiene_ssubtema2($subtema) {
        $this->db->distinct();
        /* SELECT  
          tema.numero AS nt,tema.nombre AS nombtet,
          subtema.numero AS ns,subtema.nombre AS nombres,
          subsubtema.numero AS nss,subsubtema.nombre  AS nombress
          FROM tema
          INNER JOIN subtema ON subtema.tema_id=tema.id
          LEFT JOIN subsubtema ON subsubtema.subtema_id=subtema.id

          ORDER BY(tema.numero) */

        $this->db->select('tema.id AS idt,tema.numero AS nt,
subtema.numero AS ns, subsubtema.id As idss,
subsubtema.numero AS nss,subsubtema.nombre  AS nombress');
        $this->db->from('tema');
        $this->db->where('tema.id', $subtema);
        $this->db->join('curso', 'curso.id=tema.curso_id', 'left');
        $this->db->join('subtema', 'subtema.tema_id=tema.id', 'left');
        $this->db->join('subsubtema', 'subsubtema.subtema_id=subtema.id', 'left');
        $this->db->order_by('tema.numero,subtema.numero,subsubtema.numero');
        // $this->db->group_by('subtema.numero');        
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return NULL;
        }
    }

    public function obtiene_subtema($curso) {
        $this->db->distinct();
        /* SELECT  
          tema.numero AS nt,tema.nombre AS nombtet,
          subtema.numero AS ns,subtema.nombre AS nombres,
          subsubtema.numero AS nss,subsubtema.nombre  AS nombress
          FROM tema
          INNER JOIN subtema ON subtema.tema_id=tema.id
          LEFT JOIN subsubtema ON subsubtema.subtema_id=subtema.id

          ORDER BY(tema.numero) */
        $this->db->select('curso.nombre ,tema.id AS idt, tema.numero AS nt,tema.nombre AS nombret,
        subtema.id AS ids,subtema.numero AS ns,subtema.nombre AS nombres');
//subsubtema.numero AS nss,subsubtema.nombre  AS nombress');
        $this->db->from('tema');
        $this->db->where('tema.curso_id', $curso);
        $this->db->join('curso', 'curso.id=tema.curso_id', 'inner');
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

    public function obtiene_ssubtema($curso) {
        $this->db->distinct();
        /* SELECT  
          tema.numero AS nt,tema.nombre AS nombtet,
          subtema.numero AS ns,subtema.nombre AS nombres,
          subsubtema.numero AS nss,subsubtema.nombre  AS nombress
          FROM tema
          INNER JOIN subtema ON subtema.tema_id=tema.id
          LEFT JOIN subsubtema ON subsubtema.subtema_id=subtema.id

          ORDER BY(tema.numero) */

        $this->db->select('curso.nombre , tema.id AS idt,tema.numero AS nt,
subtema.numero AS ns, subsubtema.id As idss,
subsubtema.numero AS nss,subsubtema.nombre  AS nombress');
        $this->db->from('tema');
        $this->db->where('tema.curso_id', $curso);
        $this->db->join('curso', 'curso.id=tema.curso_id', 'left');
        $this->db->join('subtema', 'subtema.tema_id=tema.id', 'left');
        $this->db->join('subsubtema', 'subsubtema.subtema_id=subtema.id', 'left');
        $this->db->order_by('subsubtema.numero');
        // $this->db->group_by('subtema.numero');        
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return NULL;
        }
    }

    public function obtiene_temas($id) {
        $this->db->select('tema.id AS idt,tema.numero AS ntema,tema.descripcion AS dtema, tema.nombre AS nombret,curso.nombre AS nombrec');
        $this->db->order_by('ntema');
        $this->db->where('tema.curso_id', $id);
        $this->db->join('curso', 'curso.id=tema.curso_id', 'inner');
        $query = $this->db->get('tema');
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return NULL;
        }
    }

    public function obtiene_subtemas($id) {
        $this->db->select('tema.numero AS ntema,subtema.id AS ids, subtema.numero AS nsubtema'
                . ',subtema.nombre AS snombre,subtema.descripcion AS dsubtema');
        $this->db->from('subtema');
        $this->db->where('subtema.tema_id', $id);
        $this->db->join('tema', 'tema.id=subtema.tema_id');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return NULL;
        }
    }

    public function obtiene_subsubtemas($id) {
        $this->db->distinct();
        $this->db->select('tema.numero AS ntema,subtema.numero AS nsubtema'
                . ',subsubtema.id AS idss, subsubtema.numero AS ssnumero,'
                . 'subsubtema.nombre AS ssnombre, subsubtema.descripcion AS ssdescripcion ');
        $this->db->from('subsubtema');
        $this->db->where('subsubtema.subtema_id', $id);
        $this->db->join('subtema', 'subtema.id=subsubtema.subtema_id');
        $this->db->join('tema', 'tema.id=subtema.tema_id');

        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return NULL;
        }
    }

}
