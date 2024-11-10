<?php 

// Definir las constantes
define('NOMBRE', 'NOMBRE');
define('FECHA_RESERVA', 'FECHA_RESERVA');
define('ESTADO_RESERVA', 'ESTADO_RESERVA');

require_once __DIR__ . "/../lib/php/ejecutaServicio.php";
require_once __DIR__ . "/../lib/php/recuperaIdEntero.php";
require_once __DIR__ . "/../lib/php/recuperaTexto.php";
require_once __DIR__ . "/../lib/php/validaNombre.php";
require_once __DIR__ . "/../lib/php/validafecha.php";
require_once __DIR__ . "/../lib/php/validaestado.php";
require_once __DIR__ . "/../lib/php/update.php";
require_once __DIR__ . "/../lib/php/devuelveJson.php";
require_once __DIR__ . "/Bd.php";
require_once __DIR__ . "/TABLA_RESERVA.php";

// Habilitar la visualización de errores (solo en desarrollo)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

ejecutaServicio(function () {

    $id = recuperaIdEntero("id");

    $nombre = recuperaTexto(NOMBRE); 
    $nombre = validaNombre(NOMBRE);

    $fecha = recuperaTexto(FECHA_RESERVA);
    $fecha = validafecha(FECHA_RESERVA);

    $estado = recuperaTexto(ESTADO_RESERVA);
    $estado = validaestado(ESTADO_RESERVA);

    // Realizamos la actualización en la base de datos
    UPDATE(
        pdo: Bd::pdo(),
        table: RESERVA,
        set: [
            NOMBRE => '$nombre',
            FECHA_RESERVA => '$fecha',
            ESTADO_RESERVA => '$estado',
        ],
        where: [ID_RESERVA => '$id'],
    );

    // Devolvemos el resultado en formato JSON
    devuelveJson([
        "id" => ["value" => $id],
        "NOMBRE" => ["value" => $nombre],
        "FECHA_RESERVA" => ["value" => $fecha],
        "ESTADO_RESERVA" => ["value" => $estado],
    ]);
});
