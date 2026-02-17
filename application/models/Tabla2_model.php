<?php
// application/models/Tabla2_model.php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tabla2_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    // CREATE - Insertar nuevo registro
    public function insertar($datos) {
        return $this->db->insert('tabla_2', $datos);
    }

    // READ - Obtener todos los registros
    public function obtener_todos() {
        $query = $this->db->get('tabla_2');
        return $query->result();
    }

    // READ - Obtener un registro por numero
    public function obtener_por_id($numero) {
        $this->db->where('numero', $numero);
        $query = $this->db->get('tabla_2');
        return $query->row();
    }

    // UPDATE - Actualizar registro
    public function actualizar($numero, $datos) {
        $this->db->where('numero', $numero);
        return $this->db->update('tabla_2', $datos);
    }

    // DELETE - Eliminar registro
    public function eliminar($numero) {
        $this->db->where('numero', $numero);
        return $this->db->delete('tabla_2');
    }
}