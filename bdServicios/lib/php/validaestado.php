<?php

require_once __DIR__ . "/BAD_REQUEST.php";
require_once __DIR__ . "/ProblemDetails.php";

function validaEstado(false|string $estado)
{

 if ($estado === false)
  throw new ProblemDetails(
   status: BAD_REQUEST,
   title: "Falta el estado de reserva.",
   type: "/error/faltaestado.html",
   detail: "La solicitud no tiene el valor de estado de la reserva."
  );

 $trimEstado = trim($estado);

 if ($trimEstado === "")
  throw new ProblemDetails(
   status: BAD_REQUEST,
   title: "Estado en blanco.",
   type: "/error/estadoenblacno.html",
   detail: "Pon texto en el campo estado.",
  );

 return $trimEstado;
}
