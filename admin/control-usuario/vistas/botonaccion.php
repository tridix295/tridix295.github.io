<?php if(!isset($_SESSION["usuario"])){
    session_start();
}
    if($_SESSION["usuario"]["id"] == $consultaentrada["usuario_id"]):
?>
    <div class=>
        <a href="../../admin/control-usuario/acciones/Eliminar.php?IdEliminar=<?=$_GET['IdEntrada']?>&IdCategoria=<?=$consultaentrada["categoria_id"]?>" class="btn btn-accion">Eliminar</a>
        <a href="../../admin/control-usuario/vistas/editarentrada.php?IdEditar=<?=$_GET['IdEntrada']?>&IdCategoria=<?=$consultaentrada["categoria_id"]?>" class="btn btn-accion">Editar</a>
    </div>
<?php endif;?>