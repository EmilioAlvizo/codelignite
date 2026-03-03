<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tabla3_model extends CI_Model {

    private $table = "clientes_con_deudas";

    private $columnas = [
        'cliente_id',
        'nombre',
        'saldo',
        'estado',
        'fcaptura'
    ];

    public function __construct(){
        parent::__construct();
    }

    // obtener todos
    public function obtener_todos(){
        return $this->db->get($this->table)->result();
    }

    /*// obtener uno
    public function obtener_por_id($id){

        return $this->db
            ->where('cliente_id',$id)
            ->get($this->table)
            ->row();
    }

     // insertar
    public function insertar($datos){
        return $this->db->insert($this->table,$datos);
    }

    // actualizar
    public function actualizar($id,$datos){

        return $this->db
            ->where('cliente_id',$id)
            ->update($this->table,$datos);
    }

    // eliminar
    public function eliminar($id){

        return $this->db
            ->where('cliente_id',$id)
            ->delete($this->table);
    }
 */
    // contar total
    public function contar_total(){

        return $this->db->count_all($this->table);
    }

    // contar filtrado
    public function contar_filtrado($busqueda){

        $this->db->from($this->table);

        if($busqueda!=''){
            $this->_busqueda($busqueda);
        }

        return $this->db->count_all_results();
    }

    // obtener pagina
    public function obtener_pagina($start,$length,$busqueda,$orden_col,$orden_dir){

        if($busqueda!=''){
            $this->_busqueda($busqueda);
        }

        if(isset($this->columnas[$orden_col])){
            $this->db->order_by($this->columnas[$orden_col],$orden_dir);
        }

        $this->db->limit($length,$start);

        return $this->db->get($this->table)->result();
    }

    private function _busqueda($busqueda){

        $this->db->group_start();

        $this->db->like('nombre',$busqueda);
        $this->db->or_like('estado',$busqueda);

        $this->db->group_end();
    }

}