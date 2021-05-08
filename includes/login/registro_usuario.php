<?php
require_once "/home/sebastian/Documentos/htdocs/proyecto_blog/includes/helpers/helpers.php";

//Se reciben los datos y se guardan en variables
if (isset($_POST)) {

    if (isset($_POST["nombre"]) && isset($_POST["apellido"]) && isset($_POST["email"]) && isset($_POST["pass"])) {

        //Se llama a la funcion para conectarse a la BD
        $conectar = ConnectBD();

        //Se reciben los datos por post y se escapan los datos en caso de tener comillas o espacios
        $nombres = $_POST["nombre"] ? str_replace(" ", "", mysqli_real_escape_string($conectar, ($_POST["nombre"]))) : false;
        $apellidos = $_POST["apellido"] ? str_replace(" ", "", mysqli_real_escape_string($conectar, trim($_POST["apellido"]))) : false;
        $email = $_POST["email"] ? str_replace(" ", "", mysqli_real_escape_string($conectar, trim($_POST["email"]))) : false;
        $pass = $_POST["pass"] ? str_replace(" ", "", mysqli_real_escape_string($conectar, trim($_POST["pass"]))) : false;

        //Se llama la funcion para validar los datos
        $estado = Validar_datos_registro($nombres, $apellidos, $email, $pass);

    }
} else {
    if (!isset($_SESSION)) {
        session_start();
    }
    $estado["estado"]["general"] = "No se recibieron datos";
}

//Siempre y cuando la variable de errores este vacia se podran insertar datos en la BD
//Si ocuure algun error en la validacion se obtiene un array de la funcion y se redireciona al index.
if (gettype($estado) == null || empty($estado)) {
    //Se llama a la funcion de cifrado y se almacena en una variable
    $clave_cifrada = Cifrar_clave($pass);

    //Se llama a la funcion de registro
    $estado_bd = Registrar_usuario($nombres, $apellidos, $email, $clave_cifrada, $conectar);

    //Si la ejecucion del query arroja algun error lo almacena en una sesion y se redireciona, de no se asi se manda al index
    if ($estado_bd != "Registro exitoso") {
        $_SESSION["estado"]["general"] = $estado_bd;
        header("Location: registrar.php");
    } else {

        $_SESSION["estado"]["general"] = $estado_bd;
        header("Location: ../../index.php");
    }
} else {
    if (isset($_SESSION)) {
        session_start();
    }
    $_SESSION["estado"] = $estado;
    header("Location: registrar.php");
}
