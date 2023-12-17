<?php 
   namespace Conexion;

   class MiConexion extends \PDO {
      public function __construct($dsn, $username, $password, $options = []) {
          parent::__construct($dsn, $username, $password, $options);
      }
  }

  try {
   $conexion = new MiConexion('mysql:host=localhost;dbname=videoclub', 'root', 'password');
   $conexion->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
} catch (\PDOException $e) {
   echo "Falló la conexión: " . $e->getMessage();
}

?>