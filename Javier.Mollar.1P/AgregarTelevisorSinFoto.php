<?php

require_once "./clases/Televisor.php";

$tipo = isset($_POST['tipo']) ? $_POST['tipo'] : NULL;
$precio = isset($_POST['precio']) ? $_POST['precio'] : NULL;
$pais = isset($_POST['pais']) ? $_POST['pais'] : NULL;

if($tipo != NULL && $precio != NULL && $pais != NULL){
    $lamparita = new Televisor($tipo,$precio,$pais);
    if($lamparita->Agregar()){
        echo json_encode(array('exito'=>true,'mensaje'=>"Televisor agregado correctamente"));
    }else{
        echo json_encode(array('exito'=>false,'mensaje'=>"No se pudo ingresar a la base de datos"));
    }
}else{
    echo json_encode(array('exito'=>false,'mensaje'=>"No se ingresaron variables"));
}