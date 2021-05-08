 <?php require_once "/home/sebastian/Documentos/htdocs/proyecto_blog/includes/partials/header.php";?>

    <!--Registro pattern="[a-zA-Z ]+" -->
    <div class="form">
        <form class="form" action="registro_usuario.php" method="post">

            <label for="titulo">
                <h3>Registrase</h3>
            </label>

            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" required="required" placeholder="Ingresa tu nombre">
            <?php echo isset($_SESSION["estado"]) ? Mostrar_errores($_SESSION["estado"], "nombres") : ""; ?>

            <label for="apellido">Apellido</label>
            <input type="text" name="apellido" required="required" placeholder="Ingresa tu apellido">
            <?php echo isset($_SESSION["estado"]) ? Mostrar_errores($_SESSION["estado"], "apellidos") : ""; ?>

            <label for="mail">Mail</label>
            <input type="email" name="email" required="required" placeholder="Ingresa tu correo electronico">
            <?php echo isset($_SESSION["estado"]) ? Mostrar_errores($_SESSION["estado"], "email") : ""; ?>

            <label for="pass">Contraseña</label>
            <input type="password" name="pass" required="required" minlength="8" placeholder="ingresa tu clave">
            <?php echo isset($_SESSION["estado"]) ? Mostrar_errores($_SESSION["estado"], "pass") : ""; ?>

            <label for="regresar"><a href="../../index.php">Regresar</a></label>
            <input type="submit" value="Registrarse">
        </form>
        <?php Borrar_errores();?>
    </div>