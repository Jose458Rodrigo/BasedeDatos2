<?php

require_once __DIR__ . "/../lib/php/ejecutaServicio.php";
require_once __DIR__ . "/../lib/php/select.php";
require_once __DIR__ . "/../lib/php/devuelveJson.php";
require_once __DIR__ . "/Bd.php";
require_once __DIR__ . "/TABLA_RESERVA.php";

ejecutaServicio(function () {

 $lista = select(pdo: Bd::pdo(),  from: RESERVA,  orderBy: NOMBRE);

 $render = "";
 foreach ($lista as $modelo) {
  $encodeId = urlencode($modelo[ID_RESERVA]);
  $id = htmlentities($encodeId);
  $nombre = htmlentities($modelo[NOMBRE]);
  $fecha = htmlentities($modelo[FECHA_RESERVA]);
  $estado = htmlentities($modelo[ESTADO_RESERVA]);
  $render .=
   "<li>
     <p>
      <a href='modifica.html?id=$id'>$nombre<br>
                                    <br>$fecha<br>
                                    <br>$estado<br></a>
     </p>
    </li>";
 }

 devuelveJson(["lista" => ["innerHTML" => $render]]);
});
