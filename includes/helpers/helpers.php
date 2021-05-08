<?php
require_once "/home/sebastian/Documentos/htdocs/proyecto_blog/includes/BD/conexion.php";

//Si se recibe algun error a traves de la sesion se recibe el error y se devuelve el resultado en la pagina
function Mostrar_errores($estado, $campo)
{
    $alerta = "";

    if (isset($estado) && !empty($campo)) {

        $alerta = "<div class='alerta alerta-error'>" . $estado["$campo"] . "</div>";

    }

    return $alerta;
}

function Borrar_errores()
{
    $borrar = false;
    if (isset($_SESSION["estado"])) {
        $_SESSION["estado"] = null;
        unset($_SESSION["estado"]);
        $borrar = true;
    }

    return $borrar;
}

function Registrar_usuario($nombres, $apellidos, $email, $pass, $conectar)
{
    $sql = "INSERT INTO usuarios VALUES (null,'$nombres','$apellidos','$email','$pass',CURDATE())";
    $guardar = mysqli_query($conectar, $sql) or die(mysqli_error($conectar));

    if ($guardar) {
        $estado_db = "Registro exitoso";
    } else {
        $estado_db = "ERROR AL REGISTRAR EL USUARIO";
    }

    return $estado_db;
}

//Funcion para validar los datos de registro
function Validar_datos_registro($nombres, $apellidos, $email)
{
    $estado = array();
    //En caso de tener espacios se quitan
    $nombres = trim($nombres);
    $apellidos = trim($apellidos);
    $email = trim($email);
    
    $alerta_registro = false;
    //Validar los parametros recividos y se le asigna un estado segun el caso
    //Si no hay ningun error la funcion devolvera una variable vacia, de no ser asi devolvera el array con los errores correspondientes
    if (!empty($nombres) && !is_numeric($nombres) && !preg_match("/[0-9]+/", $nombres)) {
        $alerta_registro = true;
    } else {
        $estado["nombres"] = "El nombre no es valido";
    }

    if (!empty($apellidos) && !is_numeric($apellidos) && !preg_match("/[0-9]+/", $apellidos)) {
        $alerta_registro = true;
    } else {
        $estado["apellidos"] = "El apellido no es valido";
    }

    if (!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $alerta_registro = true;
    } else {
        $estado["email"] = "El email no es valido";
    }

    return $estado;

}

function Cifrar_clave($pass)
{
    $clave_cifrada = password_hash($pass, PASSWORD_BCRYPT, ['cost' => 4]);

    return $clave_cifrada;
}

function Login_usuario($email, $pass)
{
    $estado_usuario = null;
    $conectar = ConnectBD();

    //Se trae la informacion del usuario con el email ingresado
    $sql = "SELECT * FROM usuarios WHERE email = '$email'";

    $query = mysqli_query($conectar, $sql);

    if ($query && mysqli_num_rows($query) == 1) {
        $usuario = array();
        $usuario = mysqli_fetch_assoc($query);

        $verificar_pass = password_verify($pass, $usuario["password"]);
        if ($verificar_pass) {

            //Si la clave es correcta se devuelve el array
            return $usuario;
        } else {
            $estado_usuario["pass"] = "Contraseña incorrecta";

        }

    } else {
        $estado_usuario["email"] = "El email ingresado no existe";
    }
    return $estado_usuario;

}

function Validar_usuario($email, $pass)
{
    $usario_validado = array();
    $email = trim($email);
    $pass = trim($pass);

    if (!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $alerta_registro = true;
    } else {
        $usario_validado["email"] = "El email no es valido";
    }

    if (!empty($pass) && strlen($pass) >= 8) {
        $alerta_registro = true;
    } else {
        $usario_validado["pass"] = "La contraseña debe tener mas 8 caracteres";
    }

    return $usario_validado;
}

function conseguirCategoria($idCategoria = null)
{

    $resultado = array();

    //Conexion a la BD
    $conexion = ConnectBD();

    $sql = "SELECT * FROM categorias ";
    if($idCategoria){
        $sql .= "WHERE id = $idCategoria";
    }

    $categorias = mysqli_query($conexion, $sql);

    //Si la consulta arroja algun resultado, el objeto de la consulta se almacena en una variable y se devuelve.
    if ($categorias && mysqli_num_rows($categorias) >= 1) {
        if(mysqli_num_rows($categorias) == 1){
            $resultado = mysqli_fetch_assoc($categorias);
        }else{
            $resultado = $categorias;
        }
    }
    return $resultado;
}

function borrarCategorias($id)
{
    $resultado = false;
    $conectar = ConnectBD();

    //Primero validamos que el id que recibimos como parametro no esta vacio, y si es un numero
    if (!empty($id) && is_numeric($id)) {
        $sql = "DELETE FROM categorias WHERE id = '$id';";
        $query = mysqli_query($conectar, $sql);
        if (mysqli_affected_rows($conectar)) {
            $resultado = "Borrado exitoso";
        }
    }
    return $resultado;
}

//Funcion para insertar nuevas categorias en la BD
function crearCategorias($nombreCategorias)
{
    $conectar = ConnectBD();
    $estadocrear = false;

    //Comprueba si el parametro no esta vacio antes de insertarlo en la BD
    if (!empty($nombreCategorias)) {
        $sql = "INSERT INTO categorias VALUES (NULL,'$nombreCategorias');";
        $query = mysqli_query($conectar, $sql);

        if ($query) {
            $estadocrear = "la categoria <strong>$nombreCategorias</strong> se creo correctamente";
        }

        return $estadocrear;
    }
}

//Funcion para hacer las busquedas en entradas
function conseguirEntrada($limit = null,$idEntrada = null, $idCategoria = null)
{
     $resultado_entrada = array();

    //Conexion a la BD
    $conexion = ConnectBD();

    $sql = "SELECT Entr.*, Ctg.nombre FROM entradas Entr
            INNER JOIN categorias Ctg ON Ctg.id = Entr.categoria_id ";
    
    //Si solo se va a realizar una consulta en particulas se le contatena el id de la entrada
    if($idEntrada){
        $sql .= "WHERE Entr.id = $idEntrada";
    }

    if($idCategoria){
        $sql .= "WHERE Entr.categoria_id = $idCategoria";
    }

    $sql .= " ORDER BY Entr.id DESC ";

    //Si se desea mostrar un numero determindao de busquedas el valor recivido se lo  agregamos a un limit
    if($limit){
        $sql .= "LIMIT $limit";
    }
 
    $categorias = mysqli_query($conexion, $sql);

    //Si la consulta arroja algun resultado, el objeto de la consulta se almacena en una variable y se devuelve.
    if ($categorias == true && mysqli_num_rows($categorias) >= 1) {
        if(mysqli_num_rows($categorias) == 1){
            $resultado_entrada = mysqli_fetch_assoc($categorias);
        }else{
            $resultado_entrada = $categorias;
        }
    }
    return $resultado_entrada;
}

//Funcion para insertar una nueva entrada en la BD.
function crearEntrada($tituloEntrada, $categoriaEntrada, $descripcionEntrada, $usuarioID)
{
    $estadoEntrada = null;
    $conectar = ConnectBD();
    if (!empty($tituloEntrada) && !empty($categoriaEntrada) && !empty($descripcionEntrada) && !empty($usuarioID)) {

        $sqlEntrada = "INSERT INTO entradas VALUES(NULL,$usuarioID,$categoriaEntrada,'$tituloEntrada','$descripcionEntrada',CURDATE())";

        $queryEntrada = mysqli_query($conectar, $sqlEntrada);

        if ($queryEntrada) {
            $estadoEntrada = $queryEntrada;
        } else {
            $estadoEntrada = "Error al crear una nueva entrada =>" . mysqli_error($conectar);
        }
    } else {
        $estadoEntrada = "Por favor vuelva a ingresar los datos correspondientes";
    }

    return $estadoEntrada;
}

function actualizarDatosUsuario($nombres = false, $apellidos = false, $email = false, $pass = false)
{
    $conectar = ConnectBD();
    $usuarioID = $_SESSION["usuario"]["id"];

    //Se comprueba si los datos recibidos no son iguales a los almacenados en la sesion del usuarios
    $sql_email = "SELECT id, email FROM usuarios WHERE email = '$email'";
    $iseet_email = mysqli_query($conectar, $sql_email);
    $isset_user = mysqli_fetch_assoc($iseet_email);

    if ($isset_user["id"] == $usuarioID || empty($isset_user)) {

        $sql = "UPDATE usuarios SET nombre = '$nombres',
            apellidos = '$apellidos',
            email = '$email'
            WHERE id = '$usuarioID'";

        $actualizarUsuario = mysqli_query($conectar, $sql);

        if ($actualizarUsuario) {

            $_SESSION["usuario"]["nombre"] = $nombres;
            $_SESSION["usuario"]["apellidos"] = $apellidos;
            $_SESSION["usuario"]["email"] = $email;
            $estado_db = "Registro exitoso";
        } else {
            $estado_db = "ERROR AL REGISTRAR EL USUARIO =>" . mysqli_error($conectar);
        }
    } else {
        $estado_db = "Error al actualizar los datos";
    }
    return $estado_db;
}

//Funcion para concatenar al momento de hacer un inser en la tabla de entradas.
function validaruser($idEntrada, $idCategoria = null,$tituloEntrada = null, $descripcionEntrada = null){
    $insertEntrada = "";
    if($idEntrada != null){
       if($idCategoria){
            $insertEntrada .= " categoria_id = $idCategoria ";
        }

        if($tituloEntrada){
            if($idCategoria){
                $insertEntrada .= ",";
            }
            $insertEntrada .= " titulo = '$tituloEntrada' ";
        }

        if($descripcionEntrada){
            if($tituloEntrada){
                $insertEntrada .= ",";
            }
            $insertEntrada .= " descripcion = '$descripcionEntrada' ";
            
        }

  }
    return  $insertEntrada;
}

function editarEntrada($insertBD,$idEntrada){
    $result_insert = false;
    if(!empty($insertBD)){
        $conectar = ConnectBD();
         $sql_entrada = "UPDATE entradas SET".$insertBD." WHERE id = $idEntrada";

       $query_entrada = mysqli_query($conectar,$sql_entrada);

         if(mysqli_affected_rows($conectar) != 0){
            $result_insert = true;
         }else{
            $result_insert = "Error =>".mysqli_error($conectar);
         }

    }
    return $result_insert;

}

function eliminarEntrada($idEntrada,$IdUsuario){
    $eliminado =  false;
    $conectar = ConnectBD();
    if(!empty($idEntrada) && !empty($IdUsuario)){
        $sql_eliminar = "DELETE FROM entradas WHERE usuario_id = $IdUsuario AND id = $idEntrada";
        $query_eliminar = mysqli_query($conectar,  $sql_eliminar);

        if(mysqli_affected_rows($conectar) != 0){
            $eliminado = true;
        }else{
            $eliminado = "ERROR => No se pudo borrar el elemento";
        }
    }
    return $eliminado;
    
}