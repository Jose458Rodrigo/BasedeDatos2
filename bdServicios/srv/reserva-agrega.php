<?php

require_once __DIR__ . "/../lib/php/ejecutaServicio.php";
require_once __DIR__ . "/../lib/php/recuperaTexto.php";
require_once __DIR__ . "/../lib/php/validaNombre.php";
require_once __DIR__ . "/../lib/php/validafecha.php";
require_once __DIR__ . "/../lib/php/validaestado.php";
require_once __DIR__ . "/../lib/php/insert.php";
require_once __DIR__ . "/../lib/php/devuelveCreated.php";
require_once __DIR__ . "/Bd.php";

// Cambiar a TABLA_RESERVA.php si tienes una estructura similar para la entidad RESERVA
require_once __DIR__ . "/TABLA_RESERVA.php";

ejecutaServicio(function () {

    $nombre = recuperaTexto("nombre");
    $nombre = validaNombre($nombre);

    // Recupera los datos adicionales de fecha y estado
    $fecha = recuperaTexto("fecha");  // Supón que este dato se envía al servicio
    $fecha = validafecha($fecha); 
    

    $estado = recuperaTexto("estado");  // Supón que este dato también se envía
    $estado = validaestado($estado);  // Added missing semicolon

    $pdo = Bd::pdo();
    insert(pdo: $pdo, into: 'RESERVA', values: [
        'NOMBRE' => $nombre,
        'FECHA_RESERVA' => $fecha,
        'ESTADO_RESERVA' => $estado
    ]);

    $id = $pdo->lastInsertId();
    $encodeId = urlencode($id);
    devuelveCreated("/srv/reserva.php?id=$encodeId", [
        "id" => ["value" => $id],
        "nombre" => ["value" => $nombre],
        "fecha" => ["value" => $fecha],
        "estado" => ["value" => $estado],
    ]);
});
?>
