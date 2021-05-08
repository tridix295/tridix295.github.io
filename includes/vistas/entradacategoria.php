<?php
//Cabezera
require_once "/home/sebastian/Documentos/htdocs/proyecto_blog/includes/partials/header.php";

	$consultaentrada = conseguirEntrada($limit = null, $identrada = null, $idcategoria = $_GET["IdEntrada"]);
	$categoria = conseguirCategoria($_GET["IdEntrada"]);
	//Contenido principal
	echo "<div id='principal'>";

		if (!empty($consultaentrada) && is_object($consultaentrada)):
		echo "<h1>Entradas de ".$categoria["nombre"]."</h1>";
	
  		while ($entrada = mysqli_fetch_assoc($consultaentrada)):
			$IdEntrada = $entrada["id"];
			var_dump($IdEntrada);
	?>

	    <article id="contenido">
			<a href="/includes/vistas/entrada.php?IdEntrada=<?=$IdEntrada?>&IdCategoria=<?=$entrada["categoria_id"]?>">
	        <h2><?php echo $entrada["titulo"]; ?></h2>
	        <time style="color: #999;"><?php echo $entrada["nombre"] . " | " . $entrada["fecha"]; ?></time></br></br>
	        <p>
				<?php echo substr($entrada["descripcion"], 0, 200) . "...";?>
	        </p>
			</a>
	    </article></br></br>

	<?php	endwhile; 
			endif;
	?>

			<?php
				if(!empty($consultaentrada) && !is_object($consultaentrada)):?>
				    <article id="contenido">
						<a href="/includes/vistas/entrada.php?IdEntrada=<?=$consultaentrada['id']?>&IdCategoria=2">
	   				    <h2><?php echo $consultaentrada["titulo"]; ?></h2>
	        			<time style="color: #999;"><?php echo $consultaentrada["nombre"] . " | " . $consultaentrada["fecha"]; ?></time></br></br>
	        			<p>
						<?php echo substr($consultaentrada["descripcion"], 0, 200) . "...";?>
	        			</p>
						</a>
	   	 			</article></br></br>
				<?php endif;
					  echo empty($consultaentrada) ? "<div id='principal'><h2 style='text-align: center;'>Esta entrada esta vacia o no existe!!!</h2></div>" : "";
				?>
	</div>
</body>