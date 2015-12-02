
<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Actividad_no_realizada_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->Database('default');
    }

    public function obtiene_actividades_no_realizadas() {
        $this->db->where('terminada',0);
        $query = $this->db->get('actividad');
        if ($query->num_rows() > 0) {

           return $query->result();
        } else {
            return NULL;
        }
    }
    
}