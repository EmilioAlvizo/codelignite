<?php
// application/models/Tabla1_model.php
defined('BASEPATH') or exit('No direct script access allowed');

class Tabla1_model extends CI_Model
{

    protected $table = 'tabla_1';
    protected $primaryKey = 'numero';

    public function __construct()
    {
        parent::__construct();
    }

    // CREATE - Insertar nuevo registro
    public function insertar($datos)
    {
        return $this->db
            ->insert($this->table, $datos);
    }

    // READ - Obtener todos los registros
    public function obtener_todos()
    {
        return $this->db
            ->get($this->table)
            ->result();
    }

    // READ - Obtener un registro por numero
    public function obtener_por_id($id)
    {
        return $this->db
            ->where($this->primaryKey, $id)
            ->get($this->table)
            ->row();
    }

    // UPDATE - Actualizar registro
    public function actualizar($id, $datos)
    {
        return $this->db
            ->where($this->primaryKey, $id)
            ->update($this->table, $datos);
    }

    // DELETE - Eliminar registro
    public function eliminar($id)
    {
        return $this->db
            ->where($this->primaryKey, $id)
            ->delete($this->table);
    }

    // ── Server-side processing ──────────────────────────────────────────────

    // Columnas que DataTables puede buscar/ordenar
    private $columnas = [
        'numero',
        'edad',
        'cantidad',
        'poblacion',
        'precio',
        'porcentaje',
        'temperatura',
        'saldo',
        'nombre',
        'descripcion',
        'codigo',
        'notas',
        'fecha_registro',
        'fecha_nacimiento',
        'hora_entrada',
        'fecha_mod',
        'activo',
        'uuid'
        // archivo (varbinary) se omite del filtro de texto
    ];

    public function contar_total()
    {
        return $this->db->count_all('tabla_1');
    }

    public function contar_filtrado($busqueda)
    {
        if ($busqueda !== '') {
            $this->_aplicar_busqueda($busqueda);
        }
        $this->db->from('tabla_1');
        return $this->db->count_all_results();
    }

    public function obtener_pagina($start, $length, $busqueda, $orden_col, $orden_dir)
    {
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

    private function _aplicar_busqueda($busqueda)
    {
        // Columnas de texto donde tiene sentido buscar
        $cols_texto = ['nombre', 'descripcion', 'codigo', 'notas', 'uuid'];

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
