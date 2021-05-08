<?php
if (isset($_POST)) {
    require_once "/home/sebastian/Documentos/htdocs/proyecto_blog/includes/helpers/helpers.php";

    $conectar = ConnectBD();
    $usuarioID = !empty($_SESSION["usuario"]["id"]) ? ($_SESSION["usuario"]["id"]) : false ;
    $tituloEntrada = !empty($_POST["titulo"]) ? mysqli_real_escape_string($conectar, $_POST["titulo"]) : false;
    $categoriaEntrada = !empty($_POST["categoria"]) ? mysqli_real_escape_string($conectar, $_POST["categoria"]) : false;
    $descripcionEntrada = !empty($_POST["descripcion"]) ? mysqli_real_escape_string($conectar, $_POST["descripcion"]) : false;

    if ($tituloEntrada != false && $categoriaEntrada != false && $descripcionEntrada != false && $usuarioID != false) {
        $resultEntrada = crearEntrada($tituloEntrada, $categoriaEntrada, $descripcionEntrada, $usuarioID);
        
       if($resultEntrada){
           $_SESSION["estado"]["exito-entrada"] = "Se ha creado correctamente una nueva entrada";
       }else{
        $_SESSION["estado"]["error"] = $resultEntrada;
       }
    }else{
        $_SESSION["estado"]["error"] = "Por favor vuelva a ingresar los datos correspondientes";
    }
} else {
    $estado = "No se recivio ningun dato, por favor ingrese nuevamente los datos";
}

header("Location: ../vistas/crearentradas.php");
