<?php

//Si existe post y el valor recivido por post es un email o pass se realiza el procedimiento, sino se retorna con un mensaje.
if (isset($_POST)) {
    if (isset($_POST["email"]) && isset($_POST["pass"])) {
        require_once "/home/sebastian/Documentos/htdocs/proyecto_blog/includes/helpers/helpers.php";
        //Nos conectamos a la BD
        $conectar = ConnectBD();

        //Recibimos los datos, verificamos que no tengan espacios o caracteres especiales
        $email = $_POST["email"] ? str_replace(" ", "", mysqli_real_escape_string($conectar, trim($_POST["email"]))) : false;
        $pass = $_POST["pass"] ? str_replace(" ", "", mysqli_real_escape_string($conectar, trim($_POST["pass"]))) : false;

        //Se validan los datos recibidos se basan segun el estandar
        $estado = Validar_usuario($email, $pass);
    } else {
        $estado = "No se recibio un usuario o un email";
    }
} else {
    $estado = "No se recibieron datos";
}

if (count($estado) == 0 && empty($estado)) {

    //Se llama a la funcion de login
    $estado_usuario = Login_usuario($email, $pass);

    //Si se recibe un error de la funcion se crea la sesion del error, sino se crea una sesion para el usuario
    //y se le redireciona al index

    if (is_array($estado_usuario) && count($estado_usuario) > 1) {

        $_SESSION["usuario"] = $estado_usuario;

        if (isset($_SESSION["estado"]["error-login"])) {
            unset($_SESSION["estado"]["error-login"]);
        }
    } else {
        $_SESSION["estado"]["error-login"] = $estado_usuario;
    }

} else {
    //Si se ocurrio algun error en la validacion se redireciona al index
    if (!isset($_SESSION)) {
        session_start();
    }
    $_SESSION["estado"] = $estado;
}

    header("Location: ../../index.php");
