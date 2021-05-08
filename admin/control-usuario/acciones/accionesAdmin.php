<?php
 require_once "/home/sebastian/Documentos/htdocs/proyecto_blog/includes/helpers/helpers.php";
    if(isset($_GET)){
        //Se recive el id del elemento a eliminar
        $eliminar = !empty($_GET["IdEliminar"]) ? $_GET["IdEliminar"] : false;
        if($eliminar != false){
            //Se llama a la funcion para borrar el elemento

        }
    }

    if(isset($_POST)){
        $titulo = !empty($_POST["titulo"]) ? $_POST["titulo"] : null;
        $idCategoria = !empty($_POST["IdCategoria"]) ? $_POST["IdCategoria"] : null;
        $descripcion = !empty($_POST["descripcion"]) ? $_POST["descripcion"] : null;
        $idEntrada = !empty($_POST["IdEntrada"]) ? $_POST["IdEntrada"] : null;

        if($idEntrada != null && is_numeric($idEntrada)){
            //Se realiza una consulta a la Bd para comprobar que los datos recibidos no existan.
            $datos_entradas = conseguirEntrada(null,$idEntrada);

            //Si los datos recibidos no son iguales a la BD se mantienen, si no se convierten en null
            $idEntrada = $idEntrada == $datos_entradas["id"] ? $idEntrada: null;
           /* $idCategoria = $idCategoria == $datos_entradas["categoria_id"] ? null : $idCategoria;
            $idUsuario = $_SESSION["usuario"]["id"] == $datos_entradas["usuario_id"] ? true : null;
            $titulo = $titulo == $datos_entradas["titulo"] ? null : $titulo;
            $descripcion = $descripcion == $datos_entradas["descripcion"] ? null : $descripcion;*/

            if($idEntrada != null){
              $result = editarEntrada(validaruser($idEntrada,$idCategoria,$titulo ,$descripcion),$idEntrada);
              if($result == 1){
                $_SESSION["estado"]["exito"]="Los datos se actualizaron correctamente";
              }else{
                $_SESSION["estado"]["error"] =$result;
              }
            }else{
              $_SESSION["estado"]["error"] ="El id:".$_POST['IdEntrada']." de la entrada no existe, por favor vuelva a intentarlo";
            }

        }
    }
    header("Location: ../vistas/editarentrada.php?IdEditar=$idEntrada&IdCategoria=$idCategoria");
    
?>
