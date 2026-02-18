<?php
// application/models/Tabla1_model.php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tabla1_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    // CREATE - Insertar nuevo registro
    public function insertar($datos) {
        return $this->db->insert('tabla_1', $datos);
    }

    // READ - Obtener todos los registros
    public function obtener_todos() {
        $query = $this->db->get('tabla_1');
        return $query->result();
    }

    // READ - Obtener un registro por numero
    public function obtener_por_id($numero) {
        $this->db->where('numero', $numero);
        $query = $this->db->get('tabla_1');
        return $query->row();
    }

    // UPDATE - Actualizar registro
    public function actualizar($numero, $datos) {
        $this->db->where('numero', $numero);
        return $this->db->update('tabla_1', $datos);
    }

    // DELETE - Eliminar registro
    public function eliminar($numero) {
        $this->db->where('numero', $numero);
        return $this->db->delete('tabla_1');
    }

    // ── Server-side processing ──────────────────────────────────────────────

    // Columnas que DataTables puede buscar/ordenar
    private $columnas = [
        'numero','edad','cantidad','poblacion','precio',
        'porcentaje','temperatura','saldo','nombre','descripcion',
        'codigo','notas','fecha_registro','fecha_nacimiento',
        'hora_entrada','fecha_mod','activo','uuid'
        // archivo (varbinary) se omite del filtro de texto
    ];

    public function contar_total() {
        return $this->db->count_all('tabla_1');
    }

    public function contar_filtrado($busqueda) {
        if ($busqueda !== '') {
            $this->_aplicar_busqueda($busqueda);
        }
        $this->db->from('tabla_1');
        return $this->db->count_all_results();
    }

    public function obtener_pagina($start, $length, $busqueda, $orden_col, $orden_dir) {
        // Búsqueda global
        if ($busqueda !== '') {
            $this->_aplicar_busqueda($busqueda);
        }

        // Ordenamiento (validar que la columna exista para evitar SQL injection)
        if (isset($this->columnas[$orden_col])) {
            $dir = ($orden_dir === 'desc') ? 'DESC' : 'ASC';
            $this->db->order_by($this->columnas[$orden_col], $dir);
        }

        $this->db->limit($length, $start);
        $query = $this->db->get('tabla_1');
        return $query->result();
    }

    private function _aplicar_busqueda($busqueda) {
        // Columnas de texto donde tiene sentido buscar
        $cols_texto = ['nombre','descripcion','codigo','notas','uuid'];

        $this->db->group_start();
        foreach ($cols_texto as $i => $col) {
            if ($i === 0) {
                $this->db->like($col, $busqueda);
            } else {
                $this->db->or_like($col, $busqueda);
            }
        }
        $this->db->group_end();
    }
}