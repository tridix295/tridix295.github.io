<?php

function ConnectBD()
{
    $servidor = '127.0.0.1';
    $bd = 'blog_master';
    $nombre = 'root';
    $contraseña = 'root123';
    $puerto = '3306';

    //Primero se realiza la conexion a la base de datos, en el que recibe los parametros del servidor,usuario,pass,bd y el puerto
    //este ultimo puede ser opcional.
    $conectar = mysqli_connect($servidor, $nombre, $contraseña, $bd, $puerto);

    return $conectar;
} //Inicoar la sesion
session_start();
