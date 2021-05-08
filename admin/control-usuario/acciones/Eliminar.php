<?php 
 require_once "/home/sebastian/Documentos/htdocs/proyecto_blog/includes/helpers/helpers.php";
// if(isset($_SESSION["usuario"] && isset($_GET["IdEliminar"]))){}
        $IdCategoria = !empty($_GET["IdCategoria"]) ? $_GET["IdCategoria"] : null;
        $IdEntrada = !empty($_GET["IdEliminar"]) ? $_GET["IdEliminar"] : null;

        if($IdEntrada != null ){
            $datos_entradas = conseguirEntrada(null,$IdEntrada);

            $IdEntrada = is_numeric($IdEntrada) && $IdEntrada == $datos_entradas["id"] ? $IdEntrada: null;
            $IdUsuario = $_SESSION["usuario"]["id"] == $datos_entradas["usuario_id"] ? $_SESSION["usuario"]["id"] : null;

            if($IdEntrada != null && $IdUsuario != null){
                $result_eliminar = eliminarEntrada($IdEntrada,$IdUsuario);
                if($result_eliminar == true){ 
                  header("Location: ../../../index.php");
                }else{
                  $_SESSION["estado"]["error"]= $result_eliminar;
                  header("Location: ../../../includes/vistas/entrada.php?IdEntrada=$IdEntrada&IdCategoria=$IdCategoria  ");
                }
                }
        }     
?>