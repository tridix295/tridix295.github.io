<?php //includes
 require_once "/home/sebastian/Documentos/htdocs/proyecto_blog/admin/control-usuario/acciones/redireccionar.php";
 require_once "/home/sebastian/Documentos/htdocs/proyecto_blog/includes/partials/header.php";
?>

    <!--Registro pattern="[a-zA-Z ]+" -->
    <div class="form">
        <form class="form" action="../acciones/actualizarDatosUsuario.php" method="post">

            <h3>Mis datos</h3>
            <?php echo isset($_SESSION["estado"]["exito"]) ? "<div class='alerta alerta-exito'>".$_SESSION["estado"]["exito"]."</div>" : ""?>

            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" value="<?=$_SESSION["usuario"]["nombre"];?>"/>
            <?php echo isset($_SESSION["estado"]) ? Mostrar_errores($_SESSION["estado"],"nombres") : ""; ?>

            <label for="apellido">Apellido</label>
            <input type="text" name="apellido" value="<?=$_SESSION["usuario"]["apellidos"];?>"/>
            <?php echo isset($_SESSION["estado"]) ? Mostrar_errores($_SESSION["estado"], "apellidos") : ""; ?>

            <label for="mail">Mail</label>
            <input type="email" name="email" value="<?=$_SESSION["usuario"]["email"];?>"/>
            <?php echo isset($_SESSION["estado"]) ? Mostrar_errores($_SESSION["estado"], "email") : ""; ?>

            <input type="submit" value="Actualizar">
        </form>
        <?php Borrar_errores();?>
    </div>