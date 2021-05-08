<sidebar id="sidebar" class="asidebar">
    <!--Login-->


    <div id="login" class="bloque login">
    <strong><h2>Login</h></strong>

        <!--Si se registro bien muestra un mensaje-
    	<?php if (isset($_SESSION['estado'])): ?>
		<div class="alerta alerta-exito">
			<?=$_SESSION['estado']["general"];?>
		</div>
	<?php endif;?>-->
        <form action="includes/login/login_usuario.php" method="post">
            <strong><label for="email">Nombre</label></strong>
            <input type="text" name="email" placeholder="Ingresa tu email">
            <?php echo isset($_SESSION["estado"]) ? Mostrar_errores($_SESSION["estado"]["error-login"], "email") : ""; ?>

            <strong><label for="pass">Contraseña</label></strong>
            <input type="password" name="pass" placeholder="Ingresa tu clave">
            <?php echo isset($_SESSION["estado"]) ? Mostrar_errores($_SESSION["estado"]["error-login"], "pass") : ""; ?>

            <input type="submit" value="Ingresar" class="btn btn-accion">

            <label for="registar"><a href="/includes/login/registrar.php">Registrate</a></label>
        </form>
        <?php Borrar_errores();?>
    </div>
</sidebar>

<div id="clearfix"></div>