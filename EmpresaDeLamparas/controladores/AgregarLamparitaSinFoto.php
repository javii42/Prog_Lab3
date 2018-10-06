<?php

require_once "../clases/Lamparita.php";

$tipo = isset($_POST['tipo']) ? $_POST['tipo'] : NULL;
$precio = isset($_POST['precio']) ? $_POST['precio'] : NULL;
$color = isset($_POST['color']) ? $_POST['color'] : NULL;

if($tipo != NULL && $precio != NULL && $color != NULL){
    $lamparita = new Lamparita($tipo,$precio,$color);
    if($lamparita->Agregar()){
        $archivo = fopen("../archivos/lamparitas_sin_fotos.txt","a+");
        $escribio = fwrite($archivo,$lamparita->ToString()."\r\n");
        fclose($archivo); 
        echo "Lamparita guardada: ".$lamparita->ToString();
    }else{
        echo "Error al guardar en la BD";
    }
}else{
    echo "Variable incorrecta";
}