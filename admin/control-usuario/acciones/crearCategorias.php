<?php
if(isset($_POST)){
    require_once "/home/sebastian/Documentos/htdocs/proyecto_blog/includes/helpers/helpers.php";
        //Nos conectamos a la BD
        $conectar = ConnectBD();

    if(isset($_POST["categoria"])){
        $categoria = $_POST["categoria"] ? mysqli_real_escape_string($conectar, trim($_POST["categoria"])) : false;
    
        if($conectar != false){
            $estadocategoria = crearCategorias($categoria);
            $_SESSION["estado"]["categorias"] = $estadocategoria;
        }
    }else{
        $estado = "categoria vacia, vuelva a llenar el formulario";
    }

}else{
    $estado = "Por favor llene el campo";
}

if(isset($estado)){
    if(isset($_SESSION)){
        session_start();
    }

    $_SESSION["estado"]["error"] = $estado;
}
header("Location: ../categorias.php");

?>