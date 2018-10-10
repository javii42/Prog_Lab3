<?php
require_once("./clases/Usuario.php");

$email = isset($_POST['email']) ? $_POST['email'] : NULL;
$clave = isset($_POST['clave']) ? $_POST['clave'] : NULL;

if($email != null && $clave != null){
    $usuario = new Usuario($email,$clave);
    if(Usuario::VerificarExistencia($usuario)){
        $hora = date('d/m/y-h:i:s');
        //echo $hora;
        setcookie($email,$hora,time() + (86400 * 30), "/");
        header('Location: ./ListadoUsuarios.php');
    }else{
        echo json_encode(array('exito'=>false,'mensaje'=>"El usuario no existe"));
    }
}