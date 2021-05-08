
<div id="sidebar" class="sidebar">
    <!--admin-control-->
    <div id="form" class="bloque container-1">
        
        <h3>Bienvenido,<?= $_SESSION["usuario"]["nombre"]?></h3>
        <form action="/admin/control-usuario/acciones/buscar.php" method="POST">
            <input type="search" value="buscar" placeholder="Buscar..."><i class="fas fa-search iconoInput"></i>
        </form>
        <a href="/admin/control-usuario/vistas/misdatos.php" class="boton boton-accion">Mis datos</a>
        <a href="/admin/control-usuario/vistas/crearentradas.php" class="boton boton-accion">Crear Entradas</a>
        <a href="/admin/control-usuario/vistas/categorias.php" class="boton boton-accion">Mis Categorias</a>
        <a href="/admin/control-usuario/acciones/logout.php" class="boton">Cerrar cesion</a>

    </div>
</div>

<div id="clearfix"></div>
