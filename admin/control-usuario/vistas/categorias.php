<?php
 require_once "/home/sebastian/Documentos/htdocs/proyecto_blog/admin/control-usuario/acciones/redireccionar.php";
 require_once "/home/sebastian/Documentos/htdocs/proyecto_blog/includes/partials/header.php";
?>

<div id="principal">
    <h3>Mis categorias</h3>
    <div class="accion">
        <?php
//Funcion para consultar las categorias en la BD
$consulta = conseguirCategoria();

//Por cada iteracion del objeto devuelto en la funcion, se almacena en una variable y se muestra
while ($result = mysqli_fetch_assoc($consulta)): ?>

        <a href="" class="boton"><?php echo $result["nombre"]; ?></a>

        <?php endwhile;?>
    </div>



</div>

<div class="categorias">
    <div class="">
        <h3>Crear una nueva categoria</h3></br>


        <?php if (isset($_SESSION["estado"]["categorias"]) && !empty($_SESSION["estado"]["categorias"])): ?>

        <div class="alerta alerta-exito">
            <?php echo $_SESSION['estado']["categorias"]; ?>
        </div>
        <?php endif;?>

        <php echo isset($_SESSION["estado"]) ? Mostrar_errores($_SESSION["estado"]["error-login"], "email" ) : "" ;?>
            <form action="crearCategorias.php" method="POST">
                <label for="nombre">Categoria</label>
                <input type="text" name="categoria" placeholder="Escriba un nuevo nombre para la categoria"
                    pattern="[a-zA-Z ]+" required="requiered">

                <input type="submit" value="Crear">
            </form>
            <?php Borrar_errores();?>
    </div>

</div>