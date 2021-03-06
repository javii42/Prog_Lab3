<?php

require_once "./clases/Televisor.php";

$tipo = isset($_POST['tipo']) ? $_POST['tipo'] : NULL;
$precio = isset($_POST['precio']) ? $_POST['precio'] : NULL;
$pais = isset($_POST['pais']) ? $_POST['pais'] : NULL;
$foto = isset($_FILES['foto']) ? $_FILES['foto'] : NULL;

if($tipo != NULL && $precio != NULL && $pais != NULL){
    $tipoArchivo = pathinfo($foto["name"], PATHINFO_EXTENSION);
    $fotoFinalName="TelevisoresModificados/". $tipo.".".$pais.".".date('h').date('i').date('s').".".$tipoArchivo;
    $destino = "./".$fotoFinalName;
    if(move_uploaded_file($foto["tmp_name"], $destino)){
        $tv = New Televisor($tipo,$precio,$pais,$fotoFinalName);
        if(Lamparita::Modificar($lamparita)){
            header('Location:./Listado.php');
        }else{
            echo "Error al cargar la bd";
        }
    }else{
        echo "No se pudo cargar la imagen ";
    }


}   