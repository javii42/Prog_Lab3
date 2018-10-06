<?php

require_once "../clases/Lamparita.php";

$tipo = isset($_GET['tipo']) ? $_GET['tipo'] : NULL;
$color = isset($_GET['color']) ? $_GET['color'] : NULL;

if($tipo != NULL && $color != NULL){
    $lamparitas = Lamparita::TraerTodas();
   // var_dump($lamparitas);
    foreach($lamparitas as $lamparita){
        if($lamparita->color == $color && $lamparita->tipo == $tipo){
            $l = new Lamparita($lamparita->tipo,$lamparita->precio,$lamparita->color,$lamparita->path);
            echo $l->ToString()."-"."Precio con iva: ".$l->PrecioConIva()."<br>";
            break;
        }else if($lamparita->color == $color){
            echo "Coincide el color";
        }else if($lamparita->tipo == $tipo){
            echo "Coindice el tipo";
        }else{
            echo "No coincide ni el color ni el tipo";
        }
        echo "<br>";
    }
}
