<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>main.php</title>
    <style>
        tr, th, td {
            border: 1px solid black;
        }
    </style>
</head>
<body>
    <?php 
        require_once('../Conexion/conexion.php');
        
        session_start();
        $usuario = $_SESSION['usuario'];
        $sql = 'SELECT * FROM usuario WHERE Usuario = :usuario';
        $consulta = $conexion->prepare($sql);
        $consulta -> bindParam(':usuario',$usuario);
        $consulta -> setFetchMode(PDO::FETCH_ASSOC);
    ?>
    <h1>Bienvenido</h1>
    
    <h2>Datos Personales</h2>
        <table>
            <tr>
                <th>Id</th>
                <th>Usuario</th>
                <th>Contraseña</th>
            </tr>
        <?php
            if($consulta -> execute()){
                while($Usuario = $consulta -> fetch()){
                    echo "<tr>
                            <td>{$Usuario['id']}</td>
                            <td>{$Usuario['Usuario']}</td>
                            <td>{$Usuario['Contraseña']}</td>
                        </tr>";
                }
            }
        ?>
        </table>

    <h2>Historial productos Alquilados</h2>
    <table>
        <tr>
            <th>Titulo Producto</th>
            <th>Tipo Soporte</th>
            <th>Precio</th>
            <th>Fecha de Alquiler</th>
            <th>Numero Cliente</th>
        </tr>

        <?php
        $sql = 'SELECT DISTINCT * FROM alquileres 
        WHERE NumeroCliente = (SELECT id FROM usuario WHERE Usuario = :usuario)
        ORDER BY fecha_alquiler DESC';
        $consultaAlquiler = $conexion -> prepare($sql);
        $consultaAlquiler -> bindParam(':usuario',$usuario);

        if($consultaAlquiler -> execute()){
            while($alquiler = $consultaAlquiler -> fetch()){
                echo "<tr>
                        <td>{$alquiler['Titulo Producto']}</td>
                        <td>{$alquiler['Tipo Soporte']}</td>
                        <td>{$alquiler['Precio']}</td>
                        <td>{$alquiler['fecha_alquiler']}</td>
                        <td>{$alquiler['NumeroCliente']}</td>
                    </tr>";
                
                $_SESSION['TipoSoporte'] = $alquiler['Tipo Soporte'];    
            }
        }else{
            echo "No existe todavia un historial de productos alquilados";
        }
    ?>
    </table>
    
    <h2>Productos Alquilados Actualmente</h2>
        <table>
            <tr>
                <th>Titulo Soporte</th>
                <th>Numero Soporte</th>
                <th>Precio</th>
            </tr>

            <?php 
                $sql = 'SELECT `Titulo Soporte`,`Numero Soporte`,Precio  FROM soporte 
                WHERE idUsuario = (SELECT id FROM usuario WHERE usuario = :usuario)';
                $consultaProductAlquilado = $conexion -> prepare($sql);
                $consultaProductAlquilado -> bindParam(':usuario',$usuario);

                if ($consultaProductAlquilado->execute()) {
                    while ($productoAlquilado = $consultaProductAlquilado->fetch()) {
                echo "<tr>
                    <td>{$productoAlquilado['Titulo Soporte']}</td>
                    <td>{$productoAlquilado['Numero Soporte']}</td>
                    <td>{$productoAlquilado['Precio']}</td>
                    <td>
                        <form method='post' action='main.php'>
                            <input type='hidden' name='numeroSoporte' value='{$productoAlquilado['Numero Soporte']}'>
                            <input type='hidden' name='tituloSoporte' value='{$productoAlquilado['Titulo Soporte']}'>
                            <input type='hidden' name='precioSoporte' value='{$productoAlquilado['Precio']}'>
                            <input type='hidden' name='tipoSoporte' value='{$_SESSION['TipoSoporte']}'>
                            <input type='submit' name='submit' value='Devolver Producto'>
                        </form>
                    </td>
                    </tr>";
    }
}

if (isset($_POST['submit'])) {
    $numeroSoporteDevolver = $_POST['numeroSoporte'];
    $tituloSoporte = $_POST['tituloSoporte'];
    $precioSoporte = $_POST['precioSoporte'];
    $tipoSoporte = $_POST['tipoSoporte'];

    $sqlDevolver = "UPDATE soporte
                    SET idUsuario = 0,Alquilado = 'No'
                    WHERE idUsuario = (SELECT id FROM usuario WHERE Usuario = :usuario)
                    AND `Numero Soporte` = :numeroSoporte";
    
    $sentenciaUpdate = $conexion->prepare($sqlDevolver);
    $sentenciaUpdate->bindParam(':usuario', $usuario);
    $sentenciaUpdate->bindParam(':numeroSoporte', $numeroSoporteDevolver);

    $sentenciaUpdate-> execute();  

    $sqlInsertAlquiler = "INSERT INTO alquileres (`Titulo Producto`, `Tipo Soporte`, `Precio`, `fecha_alquiler`, `NumeroCliente`)
                          VALUES (:tituloSoporte, :tipoSoporte, :precioSoporte, NOW(), (SELECT id FROM usuario WHERE Usuario = :usuario))";
    
    $consultaInsertAlquiler = $conexion->prepare($sqlInsertAlquiler);
    $consultaInsertAlquiler->bindParam(':tituloSoporte', $tituloSoporte);
    $consultaInsertAlquiler->bindParam(':precioSoporte', $precioSoporte);
    $consultaInsertAlquiler->bindParam(':tipoSoporte',$tipoSoporte);
    $consultaInsertAlquiler->bindParam(':usuario', $usuario);

    $consultaInsertAlquiler->execute();
}
    ?>
        </table>

    <a href="listadoVideoclub.php">Mostrar lista de Productos del videoclub</a>

    <form method="post" action="<?=$_SERVER['PHP_SELF']?>">
        <input type="submit" name="logout" value="Cerrar Sesion">
    </form>

   <?php 
        if(isset($_POST['logout'])){
            $_SESSION = array();
            session_destroy();
            header('Location: ../Vista/index.php');
            exit();
        }
   ?> 
</body>
</html>
