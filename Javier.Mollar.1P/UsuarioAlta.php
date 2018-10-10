<?php
require_once("./clases/Usuario.php");

$email = isset($_POST['email']) ? $_POST['email'] : NULL;
$clave = isset($_POST['clave']) ? $_POST['clave'] : NULL;

if($email != null && $clave != null){
    $usuario = new Usuario($email,$clave);
    $jsonResultado = $usuario->GuardarEnArchivo();
    echo $jsonResultado;
}else{
    echo "No se recibieron los datos por post";
}
