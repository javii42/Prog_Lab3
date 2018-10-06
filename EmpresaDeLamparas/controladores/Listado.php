<?php
require_once "../clases/Lamparita.php";

header('Content-Type: application/json');

$lamparitas = Lamparita::TraerTodas();
$lamparitasJSon= json_encode($lamparitas);

if(file_exists("../archivos/listado.txt")) unlink("../archivos/listado.txt");

$archivo = fopen("../archivos/listado.txt","a+");
$escribio = fwrite($archivo,json_encode($lamparitas));

echo json_encode($lamparitas); 