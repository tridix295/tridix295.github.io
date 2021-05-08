<?php
//Cabezera
require_once "/home/sebastian/Documentos/htdocs/proyecto_blog/includes/partials/header.php";?>

<!--Contenido principal-->
<div id="principal">
    <span>
        <h1>Ultimas publicaciones</h1>
    </span>

<?php
$consultar = conseguirEntrada($limit = 4);
if (!empty($consultar)):
    while ($entrada = mysqli_fetch_assoc($consultar)):
	 $IdEntrada = $entrada["id"];
?>
		    <article id="contenido">
				<a href="/includes/vistas/entrada.php?IdEntrada=<?=$entrada['id']?>&IdCategoria=<?=$entrada["categoria_id"]?>">
		            <h2><?php echo $entrada["titulo"];?></h2>
		            <time style="color: #999;"><?php echo $entrada["nombre"] . " | " . $entrada["fecha"]; ?></time></br></br>
		            <p>
		                <?php echo substr($entrada["descripcion"], 0, 200) . "..."; ?>
		            </p>
		        </a>

		    </article></br>
<?php 
	endwhile;
	endif;
?>

    <div id="ver-todas"><a href="/includes/vistas/viewfullentradas.php">Ver todas las publicaciones</a></div>
</div>

</div>

</body>