<?php

require_once "../clases/Lamparita.php";


$tipo = isset($_POST['tipo']) ? $_POST['tipo'] : NULL;
$precio = isset($_POST['precio']) ? $_POST['precio'] : NULL;
$color = isset($_POST['color']) ? $_POST['color'] : NULL;
$foto = isset($_FILES['foto']) ? $_FILES['foto'] : NULL;

if($tipo != NULL && $precio != NULL && $color != NULL && $foto!=NULL){
    $tipoArchivo = pathinfo($foto["name"], PATHINFO_EXTENSION);
    $fotoFinalName="lamparitas/imagenes/". $tipo.".".$color.".".date('h').date('i').date('s').".".$tipoArchivo;
    $destino = "../".$fotoFinalName;
    if(move_uploaded_file($foto["tmp_name"], $destino)){
        $lamparita = New Lamparita($tipo,$precio,$pais,$fotoFinalName);
        if($lamparita->Agregar()){
            header('Location:./Listado.php');
        }else{
            echo "Error al cargar la bd";
        }
    }else{
        echo "No se pudo cargar la imagen ";
    }


}