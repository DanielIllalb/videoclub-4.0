<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>main.php</title>
</head>
<body>
    <?php 

        session_start();
        
        // Verifica si el usuario está autenticado antes de mostrar la página principal
        if(!isset($_SESSION['username'])){
            header('Location: login.php');
            exit;
        }
        
        echo "<h1>Bienvenido $_SESSION[username]</h1>";
    ?>

        <h2>listado de clientes</h2>
        <?php
            
        ?>
        <h2>listado de soportes</h2>
        <?php
        ?>
        <a href="index.php">Cerrar sesión</a>
</body>
</html>
