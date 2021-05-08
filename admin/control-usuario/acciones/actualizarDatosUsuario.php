<?php
//Libreria de funciones

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once "/home/sebastian/Documentos/htdocs/proyecto_blog/includes/helpers/helpers.php";

if (isset($_POST)) {

    if (isset($_POST["nombre"]) && isset($_POST["apellido"]) && isset($_POST["email"])) {

        //Se llama a la funcion para conectarse a la BD
        $conectar = ConnectBD();

        //Se reciben los datos por post y se escapan los datos en caso de tener comillas o espacios
        $nombres = $_POST["nombre"] ? str_replace(" ", "", mysqli_real_escape_string($conectar, ($_POST["nombre"]))) : false;
        $apellidos = $_POST["apellido"] ? str_replace(" ", "", mysqli_real_escape_string($conectar, trim($_POST["apellido"]))) : false;
        $email = $_POST["email"] ? str_replace(" ", "", mysqli_real_escape_string($conectar, trim($_POST["email"]))) : false;

        //Se llama la funcion para validar los datos, si no ocurre ningun error no devuelve nada
        $estado = Validar_datos_registro($nombres, $apellidos, $email);

    }else {
        if (!isset($_SESSION)) {
            session_start();
        }
        $estado["estado"] = "No se recibieron datos";
    }
} 

//Siempre y cuando la variable de errores este vacia se podran insertar datos en la BD
//Si ocuure algun error en la validacion se obtiene un array de la funcion y se redireciona al index.
if (gettype($estado) == null || empty($estado)) {


    //Se llama a la funcion para actualizar los datos
    $estado_bd = actualizarDatosUsuario($nombres, $apellidos, $email);
    //Si la ejecucion del query arroja algun error lo almacena en una sesion y se redireciona, de no se asi se manda al index
    if ($estado_bd != "Registro exitoso") {
        $_SESSION["estado"]= $estado_bd;
    } else {

        //Se llama a la funcion para setear los datos
        $_SESSION["estado"]["exito"] = $estado_bd;
       
    }
} else {
    if (isset($_SESSION)) {
        session_start();
    }
    $_SESSION["estado"] = $estado;
}

header("Location: ../vistas/misdatos.php");
