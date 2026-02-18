<?php
// application/controllers/Tabla1.php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tabla1 extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Tabla1_model');
        $this->load->helper('url');
    }

    // Endpoint Ajax para DataTables
    public function ajax_lista() {
        // Parámetros que envía DataTables automáticamente
        $draw      = intval($this->input->get('draw'));
        $start     = intval($this->input->get('start'));
        $length    = intval($this->input->get('length'));
        $busqueda  = $this->input->get('search')['value'] ?? '';
        $orden_col = intval($this->input->get('order')[0]['column'] ?? 0);
        $orden_dir = $this->input->get('order')[0]['dir'] ?? 'asc';

        $total     = $this->Tabla1_model->contar_total();
        $filtrado  = $this->Tabla1_model->contar_filtrado($busqueda);
        $registros = $this->Tabla1_model->obtener_pagina($start, $length, $busqueda, $orden_col, $orden_dir);

        $data = array();
        foreach ($registros as $row) {
            $data[] = array(
                $row->numero,
                $row->edad,
                $row->cantidad,
                $row->poblacion,
                number_format($row->precio, 2),
                $row->porcentaje,
                $row->temperatura,
                number_format($row->saldo, 2),
                $row->nombre,
                $row->descripcion,
                $row->codigo,
                $row->notas,
                $row->fecha_registro,
                $row->fecha_nacimiento,
                $row->hora_entrada,
                $row->fecha_mod,
                $row->activo ? 'Sí' : 'No',
                $row->uuid,
                // Botones de acción
                '<a href="'.site_url('tabla1/editar/'.$row->numero).'" 
                    class="btn btn-xs btn-warning">Editar</a> 
                 <a href="'.site_url('tabla1/eliminar/'.$row->numero).'" 
                    class="btn btn-xs btn-danger"
                    onclick="return confirm(\'¿Eliminar?\')">Eliminar</a>'
            );
        }

        echo json_encode([
            'draw'            => $draw,
            'recordsTotal'    => $total,
            'recordsFiltered' => $filtrado,
            'data'            => $data
        ]);
    }

    /* public function ajax_lista() {
        $registros = $this->Tabla1_model->obtener_todos();

        $data = array();
        foreach ($registros as $row) {
            $data[] = array(
                $row->numero,
                $row->edad,
                $row->cantidad,
                $row->poblacion,
                number_format($row->precio, 2),
                $row->porcentaje,
                $row->temperatura,
                number_format($row->saldo, 2),
                $row->nombre,
                $row->descripcion,
                $row->codigo,
                $row->notas,
                $row->fecha_registro,
                $row->fecha_nacimiento,
                $row->hora_entrada,
                $row->fecha_mod,
                $row->activo ? 'Sí' : 'No',
                $row->uuid,
                // Botones de acción
                '<a href="'.site_url('tabla1/editar/'.$row->numero).'" 
                    class="btn btn-xs btn-warning">Editar</a> 
                 <a href="'.site_url('tabla1/eliminar/'.$row->numero).'" 
                    class="btn btn-xs btn-danger"
                    onclick="return confirm(\'¿Eliminar?\')">Eliminar</a>'
            );
        }

        echo json_encode(array('data' => $data));
    } */
    
    // Listar todos los registros
    public function index() {
        //$data['registros'] = $this->Tabla1_model->obtener_todos();
        //$this->load->view('tabla1/lista', $data);
        $this->load->view('tabla1/lista');
    }

    // Guardar nuevo registro
    public function guardar() {
        $datos = array(
            'edad' => $this->input->post('edad'),
            'cantidad' => $this->input->post('cantidad'),
            'poblacion' => $this->input->post('poblacion'),
            //'precio' => $this->input->post('precio'),
            'porcentaje' => $this->input->post('porcentaje'),
            'temperatura' => $this->input->post('temperatura'),
            'saldo' => $this->input->post('saldo'),
            'nombre' => $this->input->post('nombre'),
            //'descripcion' => $this->input->post('descripcion'),
            //'codigo' => $this->input->post('codigo'),
            //'notas' => $this->input->post('notas'),

        );

        if ($this->Tabla1_model->insertar($datos)) {
            redirect('tabla1');
        } else {
            echo "Error al guardar";
        }
    }

    // Actualizar registro
    public function actualizar() {
        $numero = $this->input->post('numero');
        $datos = array(
            'edad' => $this->input->post('edad'),
            'cantidad' => $this->input->post('cantidad'),
            'poblacion' => $this->input->post('poblacion'),
            //'precio' => $this->input->post('precio'),
            'porcentaje' => $this->input->post('porcentaje'),
            'temperatura' => $this->input->post('temperatura'),
            'saldo' => $this->input->post('saldo'),
            'nombre' => $this->input->post('nombre'),
            'descripcion' => $this->input->post('descripcion'),
            'codigo' => $this->input->post('codigo'),
            'notas' => $this->input->post('notas'),
            'fecha_registro' => $this->input->post('fecha_registro'),
            'fecha_nacimiento' => $this->input->post('fecha_nacimiento'),
            'hora_entrada' => $this->input->post('hora_entrada'),
            'fecha_mod' => $this->input->post('fecha_mod'),
            'activo' => $this->input->post('activo'),


        );

        if ($this->Tabla1_model->actualizar($numero, $datos)) {
            redirect('tabla1');
        } else {
            echo "Error al actualizar";
        }
    }

    public function eliminar($numero) {
        if ($this->Tabla1_model->eliminar($numero)) {
            redirect('tabla1');
        }   else {
            echo "error al eliminar";
        }
    }

    // Mostrar formulario de creación
    public function crear() {
        $this->load->view('tabla1/formulario');
    }

    // Mostrar formulario de edición
    public function editar($numero) {
        $data['registro'] = $this->Tabla1_model->obtener_por_id($numero);
        $this->load->view('tabla1/formulario_editar', $data);
    }

    

   
}