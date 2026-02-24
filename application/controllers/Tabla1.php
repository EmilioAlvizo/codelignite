<?php
// application/controllers/Tabla1.php
defined('BASEPATH') OR exit('No direct script access allowed');

/* namespace App\Controllers;

use App\Models\ */

class Tabla1 extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Tabla1_model');
        $this->load->helper(['url', 'data']);
    }

    public function obtener($numero) {
        $registro = $this->Tabla1_model->obtener_por_id($numero);
        echo json_encode($registro);
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
                '<button class="btn btn-xs btn-warning btn-editar" data-id="'.$row->numero.'">Editar</button> 
                <button class="btn btn-xs btn-danger btn-eliminar" data-id="'.$row->numero.'">Eliminar</button>'
            );
        }

        echo json_encode([
            'draw'            => $draw,
            'recordsTotal'    => $total,
            'recordsFiltered' => $filtrado,
            'data'            => $data
        ]);
    }
    
    // Listar todos los registros
    public function index() {
        //$data['registros'] = $this->Tabla1_model->obtener_todos();
        //$this->load->view('tabla1/lista', $data);
        $this->load->view('tabla1/lista');
    }

    // Guardar nuevo registro
    public function guardar() {
        if ($this->Tabla1_model->insertar($this->obtener_datos_formulario())) {
            //redirect('tabla1');
            echo json_encode(['status' => 'success']);
        } else {
            echo "Error al guardar";
            echo json_encode(['status' => 'error']);
        }
    }

    // Actualizar registro
    public function actualizar() {
        $numero = $this->input->post('numero');

        // Imprimir para debug
        /* echo "Número recibido: " . $numero . "<br>";
        echo "POST completo: ";
        print_r($_POST); */
        //die(); // detener ejecución aquí

        if ($this->Tabla1_model->actualizar($numero, $this->obtener_datos_formulario())) {
            echo json_encode(['status' => 'success']);           
            //redirect('tabla1');
        } else {
            echo json_encode(['status' => 'error']);
        }
    }

    public function eliminar($numero) {
        if ($this->Tabla1_model->eliminar($numero)) {
            echo "<script>tabla.ajax.reload(null, false);</script>";
            //redirect('tabla1');
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

    public function obtener_datos_formulario() {
        return array(
            'edad' => limpiar_dato($this->input->post('edad')),
            'cantidad' => limpiar_dato($this->input->post('cantidad')),
            'poblacion' => limpiar_dato($this->input->post('poblacion')),
            //'precio' => $this->input->post('precio'),
            'porcentaje' => limpiar_dato($this->input->post('porcentaje')),
            'temperatura' => limpiar_dato($this->input->post('temperatura')),
            'saldo' => limpiar_dato($this->input->post('saldo')),
            'nombre' => limpiar_dato($this->input->post('nombre')),
            'descripcion' => limpiar_dato($this->input->post('descripcion')),
            'codigo' => limpiar_dato($this->input->post('codigo')),
            'notas' => limpiar_dato($this->input->post('notas')),
            'fecha_registro' => limpiar_dato(formato_fecha($this->input->post('fecha_registro'))),
            'fecha_nacimiento' => limpiar_dato($this->input->post('fecha_nacimiento')),
            'hora_entrada' => limpiar_dato($this->input->post('hora_entrada')),
            'fecha_mod' => limpiar_dato($this->input->post('fecha_mod')),
            'activo' => limpiar_dato($this->input->post('activo')),
        );
    }
}