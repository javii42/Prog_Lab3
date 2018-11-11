<?php
require_once "./clases/Televisor.php";

$tipoGet = isset($_GET['tipo']) ? $_GET['tipo'] : NULL;
$tipoSet = isset($_POST['tipo']) ? $_POST['tipo']: NULL;
$accion = isset($_POST['accion']) ? $_POST['accion']: NULL;

if($tipoGet != NULL){
    $televisores = Televisor::Traer();
    $flag = false;
    foreach($televisores as $tv){
        if($tv->tipo ==$tipoGet){
            $flag = true;
            break;
        }
    }
    if($flag){
        echo "El televisor se encuentra en la base";
    }else{
        echo "No se encuentra el tipo de televisor en la base";
    }

}else if($tipoSet != NULL && $accion == "borrar"){
    $televisores = Televisor::Traer();
    $flag = false;    
    if(Televisor::Eliminar($tipoSet)){
        echo "Eliminado correctamente";
        foreach($televisores as $tv){
            if($tv->tipo==$tipoSet){
                $extension=pathinfo($tv->path, PATHINFO_EXTENSION);
                $foto= $tv->path;
                if(file_exists($foto)){
                    if(rename($foto,"./TelevisoresBorrados/".
                    $tv->tipo.".Borrado.".date('h').date('i').date('s').".".$extension)){
                      
                    }else{
                        echo "No se puede mover la imagen";
                    }
                }
            }
        }
    }else{
        echo "No se pudo eliminar";
    }
}else{
    echo "opción incorrecta";
}