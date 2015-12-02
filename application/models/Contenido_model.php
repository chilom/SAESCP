<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Contenido_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->Database('default');
    }

    public function verifica_si_lectura_termino($id) {
        $this->db->where('contenido_id', $id);
        $this->db->where('terminado', '1');
        $existe = $this->db->get('reg_contenido');
        if ($existe->num_rows() > 0) {
            return '1';
        } else {

            return null;
        }
    }

    public function registra_inicio_lectura_contenido($datos) {
        $this->db->where('comenzado', $datos['comenzado']);
        $this->db->where('users_id', $datos['users_id']);
        $this->db->where('contenido_id', $datos['contenido_id']);
        $existe = $this->db->get('reg_contenido');
        if ($existe->num_rows() > 0) {
            //$this->db->where('users_id', $datos['users_id']);
            //$this->db->where('contenido_id', $datos['contenido_id']);
            return null; //$this->db->update('reg_contenido', $datos);
        } else {
            $this->db->insert('reg_contenido', $datos);
            return $this->db->insert_id();
        }
    }

    public function registra_fin_lectura_contenido($datos) {
        $this->db->where('users_id', $datos['users_id']);
        $this->db->where('contenido_id', $datos['contenido_id']);
        $this->db->where('comenzado', '1');
        $this->db->where('terminado', '0');
        return $this->db->update('reg_contenido', $datos);
    }

    public function obtiene_contenido_tema($tema) {
        $this->db->select('id,url,nombre');
        $this->db->where('tema_id ', $tema);
        $query = $this->db->get('contenido');
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return null;
        }
    }

    public function obtiene_contenido($subtema) {
        $this->db->select('id,url,nombre');
        $this->db->where('subtema_id ', $subtema);

        $query = $this->db->get('contenido');
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return null;
        }
    }

    public function obtiene_contenido_ss($subsubtema) {
        $this->db->select('id,url,nombre');
        $this->db->where('subsubtema_id ', $subsubtema);

        $query = $this->db->get('contenido');
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return null;
        }
    }

    public function crea_contenido($datos_contenido) {
        $this->db->insert('contenido', $datos_contenido);
        return $this->db->insert_id();
    }

    public function verifica_existencia_contenido($datos_contenido) {
        //   $this->db->where('tema_id ', $datos_contenido['tema_id']);
        //$this->db->or_where('subtema_id ', $datos_contenido['subtema_id']);
        // $this->db->or_where('subsubtema_id', $datos_contenido['subsubtema_id']);
        $this->db->where('nombre', $datos_contenido['nombre']);
        $this->db->where('url ', $datos_contenido['url']);
        $this->db->where('tipo ', $datos_contenido['tipo']);
        $query = $this->db->get('contenido');
        if ($query->num_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function eliminar($id) {
        $id = intval($id);
        $this->db->delete('curso', array('identificador' => $id));
    }

    public function obtenXid($id) {
        $query = $this->db->where('identificador', $id)->limit(1)->get('curso');
        if ($query->num_rows() >= 1) {
            return $query->result();
        } else {
            return array();
        }
    }

    public function actualizar() {
        $data = array(
            'nombre' => $this->input->post('nombreCN', true)
        );
        $this->db->update('curso', $data, array('identificador' => $this->input->post('identificador', true)));
    }

    public function crear() {
        $data = array(
            'nombre' => $this->input->post('nombreC', true),
        );
        $this->db->insert('curso', $data);
        return $this->db->insert_id();
    }

    public function existe_curso($nombre) {
        $this->db->where('nombre', $nombre);
        $query = $this->db->get('curso');
        if ($query->num_rows() >= 1) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function obten_id_curso($nombre) {
        $this->db->from('curso');
        $this->db->join('tema', 'tema.curso_idcurso =curso.idcurso');
        $this->db->where('curso.nombre', $nombre);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $id = $query->row();
            return $id->idcurso;
        } else {
            return NULL;
        }
    }

}
