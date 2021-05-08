<?php 
    require_once "/home/sebastian/Documentos/htdocs/proyecto_blog/admin/control-usuario/acciones/redireccionar.php";
    require_once "/home/sebastian/Documentos/htdocs/proyecto_blog/includes/partials/header.php";
?>
<div id="principal">
    <div id="entradas">
        <h3>Crea aqui tus entradas</h3></br>
<?php //var_dump($_SESSION["estado"]);?>
        <?php echo isset($_SESSION["estado"]["exito-entrada"]) ? Mostrar_errores($_SESSION["estado"], "exito-entrada") : Mostrar_errores($_SESSION["estado"], "error"); ?>

        <form action="../acciones/crearentrada.php" method="POST">
            <label for="titulo">Titulo</label>
            <input type="text" name="titulo" placeholder="Escribe un nombre para tu entrada"></br>
            <label for="categoria">Elige una categoria</label>
            <select name="categoria">
            <?php $mostrarcategorias = conseguirCategoria();
                  while($categorias = mysqli_fetch_assoc($mostrarcategorias)):
            ?>
                    <option value=<?= $categorias["id"]?> ><?= $categorias["nombre"]; ?></option>
            <?php endwhile; ?>
            </select></br></br>
            <label for="descripcion">Descripcion</label>
            <textarea name="descripcion" cols="81" rows="5" placeholder="Escribe una descripcion de la nueva entrada"></textarea></br>

            <input type="submit" value="Crear">
        </form>
        <?php Borrar_errores();?>
    </div>
</div>