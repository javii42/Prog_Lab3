<?php

require_once("./clases/Usuario.php");
header('Content-Type: application/json');

$archivo = fopen("./archivos/usuarios.json","rb");            
$lee = fgets($archivo);

echo $lee;