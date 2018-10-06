<?php
require_once "../clases/Lamparita.php";

$tipoGet = isset($_GET['tipo']) ? $_GET['tipo'] : NULL;
$tipoSet = isset($_POST['tipo']) ? $_POST['tipo']: NULL;
$accion = isset($_POST['accion']) ? $_POST['accion']: NULL;

if($tipoGet != NULL){
    $lamparitas = Lamparita::TraerTodas();
    $flag = false;
    foreach($lamparitas as $lamparita){
        if($lamparita->tipo==$tipoGet){
            $flag = true;
            break;
        }
    }
    if($flag){
        echo "La lamparita se encuentra en la base";
    }else{
        echo "No se encuentra el tipo de lamparita en la base";
    }

}else if($tipoSet != NULL && $accion == "borrar"){
    $lamparitas = Lamparita::TraerTodas();
    $flag = false;
    foreach($lamparitas as $l){
        $lamparita = new Lamparita($l->tipo,$l->precio,$l->color,$l->path);
        if($lamparita->GetTipo()==$tipoSet){
            $extension=pathinfo("../".$lamparita->GetPath(), PATHINFO_EXTENSION);
            $foto="../".$lamparita->GetPath();
            if(file_exists($foto)){
                if(rename($foto,"../lamparitasBorradas/".
                $lamparita->GetTipo().".Borrado.".date('h').date('i').date('s').".".$extension)){
                  
                }else{
                    echo "No se puede mover la imagen";
                }
            }
           
            if($lamparita->Eliminar()){
                echo "Eliminado correctamente";
            }else{
                echo "No se pudo eliminar";
            }
        }
    }
}else{
    echo "opción incorrecta";
}