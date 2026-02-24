<?php
if (!function_exists('limpiar_dato')) {
    function limpiar_dato($valor)
    {
        return ($valor === '' || $valor === null) ? null : $valor;
    }

    function formato_fecha($valor)
    {
        if ($valor) {
            $valor = str_replace('T', ' ', $valor);
            // Convertir a objeto DateTime y formatear
            $dt = DateTime::createFromFormat('Y-m-d H:i', $valor);
            if ($dt) {
                return $dt->format('Y-m-d\TH:i:s');
            } 
        }
        return null;
    }
}
