<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @property Tabla3_model $Tabla3_model
 */
class Tabla3 extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('Tabla3_model');
        $this->load->helper(['url']);
    }

    public function index(){
        $this->load->view('Tabla3/lista');
    }

    // DataTables AJAX
    public function ajax_lista(){

        $draw   = intval($this->input->get('draw'));
        $start  = intval($this->input->get('start'));
        $length = intval($this->input->get('length'));

        $busqueda = $this->input->get('search')['value'] ?? '';

        $orden_col = intval($this->input->get('order')[0]['column'] ?? 0);
        $orden_dir = $this->input->get('order')[0]['dir'] ?? 'asc';

        $total     = $this->Tabla3_model->contar_total();
        $filtrado  = $this->Tabla3_model->contar_filtrado($busqueda);
        $registros = $this->Tabla3_model->obtener_pagina($start,$length,$busqueda,$orden_col,$orden_dir);

        $data = [];

        foreach ($registros as $row){

            $data[] = [
                'cliente_id' => $row->cliente_id,
                'nombre'     => $row->nombre,
                'saldo'      => $row->saldo,
                'estado'     => $row->estado,
                'fcaptura'   => $row->fcaptura,
                /* 'acciones' =>
                    '<button class="btn btn-warning btn-sm btn-editar" data-id="'.$row->cliente_id.'">Editar</button>
                     <button class="btn btn-danger btn-sm btn-eliminar" data-id="'.$row->cliente_id.'">Eliminar</button>'
             */];
        }

        echo json_encode([
            "draw" => $draw,
            "recordsTotal" => $total,
            "recordsFiltered" => $filtrado,
            "data" => $data
        ]);
    }

    /*// obtener registro
    public function obtener($id){
        $data = $this->Tabla3_model->obtener_por_id($id);
        echo json_encode($data);
    }

     // guardar
    public function guardar(){

        $datos = [
            'nombre' => $this->input->post('nombre'),
            'saldo'  => $this->input->post('saldo')
        ];

        $this->Tabla3_model->insertar($datos);

        echo json_encode(['status'=>'success']);
    }

    // actualizar
    public function actualizar(){

        $id = $this->input->post('cliente_id');

        $datos = [
            'nombre' => $this->input->post('nombre'),
            'saldo'  => $this->input->post('saldo')
        ];

        $this->Tabla3_model->actualizar($id,$datos);

        echo json_encode(['status'=>'success']);
    }

    // eliminar
    public function eliminar($id){

        $this->Tabla3_model->eliminar($id);

        echo json_encode(['status'=>'success']);
    } */

}