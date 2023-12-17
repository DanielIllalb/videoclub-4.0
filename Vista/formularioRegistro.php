<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Login Usuario</title>
    </head>
    <body>
        <h1>Formulario de Registro</h1>
        <form method="post" action="../Bdd/registro.php">
             
        <div>
            <label for="user">Usuario:</label>
            <input type="text" name="NuevoUsuario" id="username">
        </div>
             
        <div>
            <label for="userPassword">Contraseña:</label>
            <input type="password" name="NuevaContrasenia" id="userPassword">
        </div>
        
        <input type="submit" name="submit" value="enviar"/>

        </form>
    </body>
</html>