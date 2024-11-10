<?php

require_once __DIR__ . "/BAD_REQUEST.php";
require_once __DIR__ . "/ProblemDetails.php";

function validaFecha(?date $fecha)
{
  if ($fecha === null) {
    throw new ProblemDetails(
      status: BAD_REQUEST,
      title: "Falta la fecha de reserva.",
      type: "/error/faltafecha.html",
      detail: "La solicitud no tiene el valor de fecha de reserva."
    );
  }

  $trimFecha = trim($fecha);

  if ($trimFecha === "") {
    throw new ProblemDetails(
      status: BAD_REQUEST,
      title: "Fecha de reserva en blanco.",
      type: "/error/fechaenblanco.html",
      detail: "Pon texto en el campo de Fecha de reserva."
    );
  }

  return $trimFecha;
}
