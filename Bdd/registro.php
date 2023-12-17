<?php
require_once('../Conexion/conexion.php');
// obtencion de los datos del formulario
if (isset($_POST['submit'])) {
   
    session_start();

    $usuario = $_POST['NuevoUsuario'];
    $contrasenia = $_POST['NuevaContrasenia'];




    $sql = "SELECT * FROM usuario WHERE Usuario = :usuario";
    $consulta = $conexion->prepare($sql);
    $consulta->bindParam(':usuario', $usuario);
    $consulta->execute();

    // verificar si se ha encontrado el usuario
    if (!$consulta->rowCount() > 0) {
        $hashedPassword = password_hash($contrasenia, PASSWORD_DEFAULT);

        $sqlInsert = "INSERT INTO usuario(Usuario, Contraseña) VALUES(:usuario, :contrasenia)";
        $sentencia = $conexion->prepare($sqlInsert);

        $sentencia->bindParam(':usuario', $usuario);
        $sentencia->bindParam(':contrasenia', $hashedPassword);

        if ($sentencia->execute()) {
            $_SESSION['usuario'] = $usuario;
            header('Location: main.php');
        } else {
            echo "No se pudo registrar al usuario";
        }
    } else {
        echo "El usuario ya existe";
    }

    // Cerrar la conexión
    $conexion = null;
}

?>
