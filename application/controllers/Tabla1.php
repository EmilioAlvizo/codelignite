<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tabla1 extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Tabla1_model');
        $this->load->helper('url');
    }

    // Listar todos los registros
    public function index() {
        $data['registros'] = $this->Tabla1_model->obtener_todos();
        $this->load->view('tabla1/lista', $data);
    }

    // Mostrar formulario de creación
    public function crear() {
        $this->load->view('tabla1/formulario');
    }

    // Guardar nuevo registro
    public function guardar() {
        $datos = array(
            'numero' => $this->input->post('numero'),
            'objeto' => $this->input->post('objeto'),
            'valor' => $this->input->post('valor'),
            'fecha' => date('Y-m-d H:i:s')
        );

        if ($this->Tabla1_model->insertar($datos)) {
            redirect('tabla1');
        } else {
            echo "Error al guardar";
        }
    }

    // Mostrar formulario de edición
    public function editar($numero) {
        $data['registro'] = $this->Tabla1_model->obtener_por_id($numero);
        $this->load->view('tabla1/formulario_editar', $data);
    }

    // Actualizar registro
    public function actualizar() {
        $numero = $this->input->post('numero');
        $datos = array(
            'objeto' => $this->input->post('objeto'),
            'valor' => $this->input->post('valor'),
            'fecha' => date('Y-m-d H:i:s')
        );

        if ($this->Tabla1_model->actualizar($numero, $datos)) {
            redirect('tabla1');
        } else {
            echo "Error al actualizar";
        }
    }

    // Eliminar registro
    public function eliminar($numero) {
        if ($this->Tabla1_model->eliminar($numero)) {
            redirect('tabla1');
        } else {
            echo "Error al eliminar";
        }
    }
}