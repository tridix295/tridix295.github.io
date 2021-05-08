<?php
//Cabezera
require_once "/home/sebastian/Documentos/htdocs/proyecto_blog/includes/partials/header.php";
session_destroy();
?>
<!--Contenido principal-->
<div id="principal">
<?php
$consultaentrada = conseguirEntrada($limit = null, $identrada = $_GET["IdEntrada"]);

if (!empty($consultaentrada)):
echo isset($_SESSION["estado"]["error"]) ? "<div class='alerta alerta-error'>".$_SESSION["estado"]["error"]."</div>" : "";
?>
		    <article id="contenido">
			<h2><?php echo $consultaentrada ["titulo"];?></h2>
		        <time style="color: #999;"><?php echo $consultaentrada ["nombre"] . " | " . $consultaentrada ["fecha"]; ?></time></br></br>
		        <p>
		            <?php echo $consultaentrada ["descripcion"]; ?>
		        </p>
				<?php include "/home/sebastian/Documentos/htdocs/proyecto_blog/admin/control-usuario/vistas/botonaccion.php";?>
		    </article></br></br>
<?php
	endif;
	Borrar_errores();
?>
</div>

    </body>