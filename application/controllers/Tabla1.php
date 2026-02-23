<?php
// application/controllers/Tabla1.php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tabla1 extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Tabla1_model');
        $this->load->helper(['url', 'data', 'security']);
    }

    public function obtener($numero) {
        $numero = (int) $numero;
        if ($numero <= 0) {
            return $this->responder_json(['status' => 'error', 'message' => 'ID invalido'], 400);
        }

        $registro = $this->Tabla1_model->obtener_por_id($numero);
        if (!$registro) {
            return $this->responder_json(['status' => 'error', 'message' => 'Registro no encontrado'], 404);
        }

        return $this->responder_json([
            'status' => 'success',
            'data' => $registro
        ]);
    }

    // Endpoint Ajax para DataTables
    public function ajax_lista() {
        // Parametros que envia DataTables automaticamente
        $draw = (int) $this->input->get('draw');
        $start = (int) $this->input->get('start');
        $length = (int) $this->input->get('length');

        $searchRaw = $this->input->get('search');
        $busqueda = is_array($searchRaw) ? ($searchRaw['value'] ?? '') : '';

        $orderRaw = $this->input->get('order');
        $orden_col = (int) (($orderRaw[0]['column'] ?? 0));
        $orden_dir = $orderRaw[0]['dir'] ?? 'asc';

        if ($start < 0) {
            $start = 0;
        }
        if ($length < 1 || $length > 100) {
            $length = 10;
        }

        $total = $this->Tabla1_model->contar_total();
        $filtrado = $this->Tabla1_model->contar_filtrado($busqueda);
        $registros = $this->Tabla1_model->obtener_pagina($start, $length, $busqueda, $orden_col, $orden_dir);

        $data = array();
        foreach ($registros as $row) {
            $numero = (int) $row->numero;
            $data[] = array(
                'numero' => $numero,
                'edad' => html_escape((string) $row->edad),
                'cantidad' => html_escape((string) $row->cantidad),
                'poblacion' => html_escape((string) $row->poblacion),
                'precio' => number_format($row->precio, 2),
                'porcentaje' => html_escape((string) $row->porcentaje),
                'temperatura' => html_escape((string) $row->temperatura),
                'saldo' => number_format($row->saldo, 2),
                'nombre' => html_escape((string) $row->nombre),
                'descripcion' => html_escape((string) $row->descripcion),
                'codigo' => html_escape((string) $row->codigo),
                'notas' => html_escape((string) $row->notas),
                'fecha_registro' => html_escape((string) $row->fecha_registro),
                'fecha_nacimiento' => html_escape((string) $row->fecha_nacimiento),
                'hora_entrada' => html_escape((string) $row->hora_entrada),
                'fecha_mod' => html_escape((string) $row->fecha_mod),
                'activo' => $row->activo ? 'Si' : 'No',
                'uuid' => html_escape((string) $row->uuid),
                'acciones' => '<button class="btn btn-xs btn-warning btn-editar" data-id="' . $numero . '">Editar</button> '
                    . '<button class="btn btn-xs btn-danger btn-eliminar" data-id="' . $numero . '">Eliminar</button>'
            );
        }

        return $this->responder_json([
            'draw' => $draw,
            'recordsTotal' => $total,
            'recordsFiltered' => $filtrado,
            'data' => $data
        ]);
    }

    // Listar todos los registros
    public function index() {
        $this->load->view('tabla1/lista');
    }

    // Guardar nuevo registro
    public function guardar() {
        if (!$this->es_post()) {
            return $this->responder_json(['status' => 'error', 'message' => 'Metodo no permitido'], 405);
        }

        $errores = $this->validar_datos_formulario(false);
        if (!empty($errores)) {
            return $this->responder_json(['status' => 'error', 'errors' => $errores], 422);
        }

        if ($this->Tabla1_model->insertar($this->obtener_datos_formulario())) {
            return $this->responder_json(['status' => 'success', 'message' => 'Registro guardado']);
        }

        return $this->responder_json(['status' => 'error', 'message' => 'Error al guardar'], 500);
    }

    // Actualizar registro
    public function actualizar() {
        if (!$this->es_post()) {
            return $this->responder_json(['status' => 'error', 'message' => 'Metodo no permitido'], 405);
        }

        $errores = $this->validar_datos_formulario(true);
        if (!empty($errores)) {
            return $this->responder_json(['status' => 'error', 'errors' => $errores], 422);
        }

        $numero = (int) $this->input->post('numero', TRUE);
        if ($this->Tabla1_model->actualizar($numero, $this->obtener_datos_formulario())) {
            return $this->responder_json(['status' => 'success', 'message' => 'Registro actualizado']);
        }

        return $this->responder_json(['status' => 'error', 'message' => 'Error al actualizar'], 500);
    }

    public function eliminar($numero) {
        if (!$this->es_post()) {
            return $this->responder_json(['status' => 'error', 'message' => 'Metodo no permitido'], 405);
        }

        $numero = (int) $numero;
        if ($numero <= 0) {
            return $this->responder_json(['status' => 'error', 'message' => 'ID invalido'], 400);
        }

        if ($this->Tabla1_model->eliminar($numero)) {
            return $this->responder_json(['status' => 'success', 'message' => 'Registro eliminado']);
        }

        return $this->responder_json(['status' => 'error', 'message' => 'Error al eliminar'], 500);
    }

    // Mostrar formulario de creacion
    public function crear() {
        $this->load->view('tabla1/formulario');
    }

    // Mostrar formulario de edicion
    public function editar($numero) {
        $data['registro'] = $this->Tabla1_model->obtener_por_id($numero);
        $this->load->view('tabla1/formulario_editar', $data);
    }

    private function es_post() {
        return strtolower($this->input->method()) === 'post';
    }

    private function responder_json(array $data, $status = 200) {
        $data['csrf_hash'] = $this->security->get_csrf_hash();
        return $this->output
            ->set_status_header($status)
            ->set_content_type('application/json', 'utf-8')
            ->set_output(json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
    }

    private function obtener_datos_formulario() {
        return array(
            'edad' => limpiar_dato($this->input->post('edad', TRUE)),
            'cantidad' => limpiar_dato($this->input->post('cantidad', TRUE)),
            'poblacion' => limpiar_dato($this->input->post('poblacion', TRUE)),
            //'precio' => $this->input->post('precio', TRUE),
            'porcentaje' => limpiar_dato($this->input->post('porcentaje', TRUE)),
            'temperatura' => limpiar_dato($this->input->post('temperatura', TRUE)),
            'saldo' => limpiar_dato($this->input->post('saldo', TRUE)),
            'nombre' => limpiar_dato($this->input->post('nombre', TRUE)),
            'descripcion' => limpiar_dato($this->input->post('descripcion', TRUE)),
            'codigo' => limpiar_dato($this->input->post('codigo', TRUE)),
            'notas' => limpiar_dato($this->input->post('notas', TRUE)),
            'fecha_registro' => limpiar_dato(formato_fecha($this->input->post('fecha_registro', TRUE))),
            'fecha_nacimiento' => limpiar_dato($this->input->post('fecha_nacimiento', TRUE)),
            'hora_entrada' => limpiar_dato($this->input->post('hora_entrada', TRUE)),
            'fecha_mod' => limpiar_dato($this->input->post('fecha_mod', TRUE)),
            'activo' => limpiar_dato($this->input->post('activo', TRUE)),
        );
    }

    private function validar_datos_formulario($incluyeNumero) {
        $errores = array();

        if ($incluyeNumero) {
            $numero = $this->input->post('numero', TRUE);
            if ($numero === null || $numero === '' || !ctype_digit((string) $numero) || (int) $numero <= 0) {
                $errores['numero'] = 'Numero invalido';
            }
        }

        $edad = $this->input->post('edad', TRUE);
        if ($edad === null || $edad === '' || !ctype_digit((string) $edad) || (int) $edad <= 0) {
            $errores['edad'] = 'Edad debe ser un entero mayor a 0';
        }

        $camposNumericos = array('cantidad', 'poblacion', 'porcentaje', 'temperatura', 'saldo');
        foreach ($camposNumericos as $campo) {
            $valor = $this->input->post($campo, TRUE);
            if ($valor !== null && $valor !== '' && !is_numeric($valor)) {
                $errores[$campo] = 'Valor numerico invalido';
            }
        }

        $nombre = (string) $this->input->post('nombre', TRUE);
        if ($nombre !== '' && strlen($nombre) > 100) {
            $errores['nombre'] = 'Nombre excede 100 caracteres';
        }

        $codigo = (string) $this->input->post('codigo', TRUE);
        if ($codigo !== '' && strlen($codigo) > 10) {
            $errores['codigo'] = 'Codigo excede 10 caracteres';
        }

        $activo = $this->input->post('activo', TRUE);
        if ($activo !== null && $activo !== '' && !in_array((string) $activo, array('0', '1'), true)) {
            $errores['activo'] = 'Activo debe ser 0 o 1';
        }

        $fechaRegistro = $this->input->post('fecha_registro', TRUE);
        if ($fechaRegistro !== null && $fechaRegistro !== '' && !preg_match('/^\d{4}-\d{2}-\d{2}T\d{2}:\d{2}$/', $fechaRegistro)) {
            $errores['fecha_registro'] = 'Formato invalido (YYYY-MM-DDTHH:MM)';
        }

        $fechaNacimiento = $this->input->post('fecha_nacimiento', TRUE);
        if ($fechaNacimiento !== null && $fechaNacimiento !== '' && !preg_match('/^\d{4}-\d{2}-\d{2}$/', $fechaNacimiento)) {
            $errores['fecha_nacimiento'] = 'Formato invalido (YYYY-MM-DD)';
        }

        $horaEntrada = $this->input->post('hora_entrada', TRUE);
        if ($horaEntrada !== null && $horaEntrada !== '' && !preg_match('/^\d{2}:\d{2}(:\d{2})?$/', $horaEntrada)) {
            $errores['hora_entrada'] = 'Formato invalido (HH:MM)';
        }

        $fechaMod = $this->input->post('fecha_mod', TRUE);
        if ($fechaMod !== null && $fechaMod !== '' && !preg_match('/^\d{4}-\d{2}-\d{2}$/', $fechaMod)) {
            $errores['fecha_mod'] = 'Formato invalido (YYYY-MM-DD)';
        }

        return $errores;
    }
}
