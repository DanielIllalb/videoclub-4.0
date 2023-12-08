<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Formulario de inicio de sesion</title>
</head>
<body>
<form method="post" action="login.php">
    <label for="username">Introduce tu Nombre de Usuario:</label>
    <input type="text" name="username" id="username" required>
    <br>
    <label for="contrasenia">Introduce tu Contraseña:</label>
    <input type="text" name="contrasenia" id="contrasenia" required>
    <br>
    <input type="submit" name="submit" value="Acceder">
</form>
</body>
</html>