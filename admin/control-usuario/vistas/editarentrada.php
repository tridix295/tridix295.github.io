<?php 
    require_once "/home/sebastian/Documentos/htdocs/proyecto_blog/admin/control-usuario/acciones/redireccionar.php";
    require_once "/home/sebastian/Documentos/htdocs/proyecto_blog/includes/partials/header.php";
    $consultaentrada = conseguirEntrada($limit = null, $identrada = $_GET["IdEditar"]);
    if($_SESSION["usuario"]["id"] == $consultaentrada["usuario_id"]):
?>
<div id="principal">
    <h1>Editar Entradas</h3>
        <div class="cnt-form">

            <form action="../acciones/accionesAdmin.php" method="post">
            <?php
               echo isset($_SESSION["estado"]["exito"]) ? "<div class='alerta alerta-exito'>".$_SESSION["estado"]["exito"]."</div>" : "";
               echo isset($_SESSION["estado"]["error"]) ? "<div class='alerta alerta-error'>".$_SESSION["estado"]["error"]."</div>" : "";
                //Mostrar datos
            ?>

                <label for="titulo">Titulo</label></br>
                <input type="text" name="titulo" value="<?php echo $consultaentrada["titulo"];?>" /></br></br>
                <?php echo isset($_SESSION["estado"]) ? Mostrar_errores($_SESSION["estado"],"nombres") : ""; ?>

                <!--Categorias-->
                <select name="IdCategoria">
                    <?php $mostrarcategorias = conseguirCategoria();
                          foreach ($mostrarcategorias as $categorias):
                          //Si el id recivido por get existe la consulta lo selecciona por defecto
                          $id = $_GET["IdCategoria"] == $categorias['id'] ? "selected" : "";
                    ?>
                    <option value="<?=$categorias['id']?>" <?=$id?> required><?=$categorias["nombre"];?></option>
                    <?php endforeach?>
                </select></br></br>

                <!--descripcion-->
                <label for="descripcion">Descripcion</label>

                <textarea name="descripcion" id="" cols="30" rows="10"><?php echo $consultaentrada["descripcion"]; ?></textarea></br>
                <input type="hidden" value="<?=$_GET["IdEditar"]?>" name="IdEntrada" required>

                
                <input type="submit" value="Actualizar">
            </form>
            <?php  Borrar_errores();?>
        </div>
</div>
<?php endif; $_SESSION["usuario"]["id"] != $consultaentrada["usuario_id"] ? header("Location: ../../../index.php") : ""?>