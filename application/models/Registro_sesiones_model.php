<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Registro_sesiones_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function guarda_fecha($datos) {
        // $id_sesion=$this->db->where('identificador', $id)->limit(1)->get('sesion');
        $datos_insertar = array(
            'fecha_inicio' => $datos['fecha'],
            'sesion_session_id' => $datos['id_sesion'], //'016e51a1180020fe51c161d9615b62e4' ,
            'usuario_id_usuario' => $datos['id_usuario']
        );
        $this->db->insert('registro_sesion', $datos_insertar);
        return $this->db->insert_id();
    }

    public function guarda_fecha_fin($datos, $id) {
        $datos_insertar = array(
            'fecha_fin' => $datos['fecha'],
        );
        $this->db->where('sesion_session_id', $id['id_s']);
        $this->db->where('usuario_id_usuario', $id['id_u']);
        $idr=  $this->db->get('registro_sesion');
        $idres=  $idr->result();
        $this->db->where('id_registro_sesion', $idres->id_registro_sesion);
        $this->db->insert('registro_sesion', $datos_insertar);
        

        return $this->db->insert_id();
    }

}
