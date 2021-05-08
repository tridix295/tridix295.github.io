<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="/asset/css/style.css">
    <link href="/asset/css/fontawesome-free-5.15.3-web/css/all.min.css" rel="stylesheet" type="text/css">
    <title>Blog de videojuegos</title>

</head>

<body>
    <?php
require_once "/home/sebastian/Documentos/htdocs/proyecto_blog/includes/helpers/helpers.php";
?>
    <!--Cabezera-->
    <header id="header">
        <!--Logo-->
        <div id="logo">
            <a href="/index.php">
                Blog de videojuegos
            </a>
        </div>

        <!--menu-->
        <div id="nav">
            <nav>
                <ul>
                    <li><a href="/index.php">Inicio</a></li>

                    <?php
                        //Funcion para consultar las categorias en la BD
                        $consulta = conseguirCategoria();
                        
                        //Por cada iteracion del objeto devuelto en la funcion, se almacena en una variable y se muestra
                        while ($result = mysqli_fetch_assoc($consulta)):
                    ?>

                          <li><a href="/includes/vistas/entradacategoria.php?IdEntrada=<?=$result['id']?>"><?php echo $result["nombre"]; ?></a></li>

                    <?php endwhile;?>

                    <li><a href="/index.php">Sobre nosotros</a></li>
                    <li><a href="/index.php">Contacto</a></li>
                </ul>
            </nav>
        </div>

        <div class="clearfix"></div>
    </header>

    <div id="container">
    <?php
        isset($_SESSION["usuario"]) && !empty($_SESSION["usuario"]) ? require_once "/home/sebastian/Documentos/htdocs/proyecto_blog/admin/control-usuario/vistas/control-admin.php" :
        (require_once "/home/sebastian/Documentos/htdocs/proyecto_blog/includes/login/login.php");
    ?>
