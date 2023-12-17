<?php
require_once('../Conexion/conexion.php');

session_start();
$usuario = $_SESSION['usuario'];
$sql = "SELECT * FROM soporte";

$consulta = $conexion->prepare($sql);

$consulta->setFetchMode(PDO::FETCH_ASSOC);
$consulta->execute();

if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['Alquilar'])){
    $numeroSoporte = $_POST['numeroSoporte'];

    $sqlAlquiler = 'UPDATE soporte SET IdUsuario = 
    (SELECT id FROM usuario WHERE Usuario = :usuario),Alquilado = "Si"
    WHERE `Numero Soporte` = :numeroSoporte';

    $consulta2 = $conexion -> prepare($sqlAlquiler);
    $consulta2 -> bindParam(':usuario',$usuario);
    $consulta2 -> bindParam(':numeroSoporte',$numeroSoporte);

    $consulta2 -> execute();

    

}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Lista de Productos</title>
    <style>
        tr, th, td {
            border: 1px solid black;
        }
    </style>
</head>
<body>
    <h1>Listado de productos</h1>

    <table>
        <tr>
            <th>Nombre</th>
            <th>Numero</th>
            <th>Precio</th>
            <th>Alquilado</th>
        </tr>

        <?php
        while ($soporte = $consulta->fetch()) {
            echo "<tr>
                    <td>{$soporte['Titulo Soporte']}</td>
                    <td>{$soporte['Numero Soporte']}</td>
                    <td>{$soporte['Precio']}</td>
                    <td>{$soporte['Alquilado']}</td>";

                    if ($soporte['Alquilado'] == 'No') {
                        echo "<td><form method='post' action='".$_SERVER['PHP_SELF'] . "'>
                                <input type='hidden' name='numeroSoporte' value='{$soporte['Numero Soporte']}'>
                                <input type='submit' name='Alquilar' value='Alquilar'>
                            </form></td>";
                    }
            echo "</tr>";
                
    }
        ?>
    </table>
    <br><br>

    <form method="post" action="<?=$_SERVER['PHP_SELF']?>">
        <label for="NombreProducto">Buscar Producto:
            <input type="text" name="productName" id="productName">
        </label>

        <input type="submit" name="submit" value="Buscar">
    </form>
    <br><br>

    <table>
        <?php 
            if (isset($_POST['submit'])) {
                $nombreProducto = $_POST['productName'];

                $sqlTitulo = 'SELECT * FROM soporte WHERE `Titulo Soporte`=:nombreProducto';
                $sentencia2 = $conexion->prepare($sqlTitulo);
                $sentencia2->bindParam(":nombreProducto", $nombreProducto);

                if ($sentencia2->execute()) {
                    if ($sentencia2->rowCount() > 0) {
                        echo "
                            <h2>Producto:</h2>
                            <table>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Numero</th>
                                    <th>Precio</th>
                                </tr>";
                        while ($soporte = $sentencia2->fetch()) {
                            echo "
                                <tr>
                                    <td>{$soporte['Titulo Soporte']}</td>
                                    <td>{$soporte['Numero Soporte']}</td>
                                    <td>{$soporte['Precio']}</td>
                                </tr>";
                        }
                        echo "</table>";
                    } else {
                        echo "<script language='Javascript'>
                                alert('El Producto introducido no existe');
                            </script>";
                    }
                } else {
                    echo "<script language='Javascript'>
                            alert('Error al realizar la consulta');
                        </script>";
                }
            }
        ?>

        <a href="main.php">Volver al menu principal</a>
    </table>    
</body>
</html>

