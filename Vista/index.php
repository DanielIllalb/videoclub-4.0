<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Login Usuario</title>
    </head>
    <body>
        <h1>Bienvenido</h1>
        <form method="post" action="../Bdd/login.php">

        <div>
            <label for="username">Introduce tu Usuario:</label>
            <input type="text" name="Usuario" id="username">
        </div>
        
        <div>
            <label for="userPassword">Introduce tu Contraseña:</label>
            <input type="password" name="Contrasenia" id="userPassword">
        </div>
        
        <input type="submit" name="submit" value="enviar"/>
        </form>

        <p>¿No estas registrado? <button><a href="formularioRegistro.php">Registrarse</a></button></p>
    </body>
</html>