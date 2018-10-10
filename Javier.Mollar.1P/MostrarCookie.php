<?php
require_once("./clases/Usuario.php");
$email = isset($_GET['email']) ? $_GET['email'] : NULL;
//header('Content-Type: application/json');
//var_dump($_COOKIE);
if(isset($_COOKIE[$email])){
  echo json_encode(array('exito'=>true,'mensaje'=>$_COOKIE[$email]
));;
}else{
     echo json_encode(array('exito'=>false,'mensaje'=>"La COOKIE no existe"));;
}