<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>login.php</title>
</head>
<body>
<?php

require_once('../Conexion/conexion.php');

// obtencion de los datos del formulario
if(isset($_POST['submit'])){
    session_start();

    $usuario = $_POST['Usuario'];
    $contrasenia = $_POST['Contrasenia'];

$sql = "SELECT * FROM usuario WHERE Usuario = :usuario";
$consulta = $conexion -> prepare($sql);
$consulta->bindParam(':usuario',$usuario);
$consulta -> execute();


// verificar si se ha encontrado el usuario

if($consulta -> rowCount() > 0){
    $fila = $consulta->fetch(PDO::FETCH_ASSOC);
    // Verificar si la contraseña ingresada coincide con la de la bd

    if ($contrasenia == $fila['Contraseña']) {
        $_SESSION['usuario'] = $usuario;
        header('Location: main.php');
    } else {
        echo "Contraseña incorrecta";
    }
    } else {
        echo 'El usuario no existe';
    }
}
    
?>  
</body>
</html>
