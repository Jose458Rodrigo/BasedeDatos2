<?php

class Bd
{
 private static ?PDO $pdo = null;

 static function pdo(): PDO
 {
  if (self::$pdo === null) {

   self::$pdo = new PDO(
    // Cadena de conexión para MySQL en InfinityFree
    "mysql:host=sql306.infinityfree.com;dbname=if0_37685581_reserva",
    // Usuario
    "if0_37685581",
    // Contraseña
    "bLG8LlEP5XTmQ",
    // Opciones: pdos no persistentes y lanza excepciones.
    [PDO::ATTR_PERSISTENT => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
   );

   // Creación de la tabla en MySQL
   self::$pdo->exec(
    "CREATE TABLE IF NOT EXISTS RESERVA (
      ID_RESERVA INT AUTO_INCREMENT,
      NOMBRE VARCHAR(255) NOT NULL,
      FECHA_RESERVA DATE NOT NULL,
      ESTADO_RESERVA VARCHAR(50) NOT NULL,
      PRIMARY KEY (ID_RESERVA),
      UNIQUE KEY NOMBRE_UNQ (NOMBRE),
      CHECK (LENGTH(NOMBRE) > 0)
     ) ENGINE=InnoDB"
   );
  }

  return self::$pdo;
 }
}

?>
