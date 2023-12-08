<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>login.php</title>
</head>
<body>
<?php

    if(isset($_POST['submit'])){
        session_start();

        // Inicialización de las variables de sesión que guardan el nombre y contraseña del usuario;
        $_SESSION['usuarioyPaswd'] = 'usuario';

        // Inicialización de las variables de sesión que guardan el nombre y contraseña del admin;
        $_SESSION['usuAdminyPasswd'] = 'admin';

        // Valores cogidos del formulario index.php
        $usuario = $_POST['username'];
        $paswd = $_POST['contrasenia'];


        if($_SESSION['usuarioyPaswd'] == $usuario && $_SESSION['usuarioyPaswd'] == $paswd ||
           $_SESSION['usuAdminyPasswd'] == $usuario && $_SESSION['usuAdminyPasswd'] == $paswd){
            
            $_SESSION['username'] = $usuario;
            header('Location: main.php');
            exit;
        }else{
            echo '<h1>Error, Usuario o Contraseña incorrectos</h1>';
        }
    }

?>  
</body>
</html>
