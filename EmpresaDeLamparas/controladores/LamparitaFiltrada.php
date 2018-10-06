<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    
    <?php

    require_once "../clases/Lamparita.php";
    
    $color = isset($_GET['color']) ? $_GET['color'] : NULL;
    $accionGet = isset($_GET['accion']) ? $_GET['accion'] : NULL;
    $tipo = isset($_POST['tipo']) ? $_POST['tipo'] : NULL;
    $accionSet = isset($_POST['accion']) ? $_POST['accion'] : NULL;

    if($tipo != NULL && $accionSet == "filtrar"){
        echo "<h2>Filtro por tipo</h2><br>";

        $lamparitas = Lamparita::TraerTodas();
        echo "<ul>";
        foreach($lamparitas as $l){
            $lamparita = new Lamparita($l->tipo,$l->precio,$l->color,$l->path);
            if($lamparita->GetTipo()==$tipo){
                echo "<li>".$lamparita->ToString()."</li>";
            }
        }
        echo "</ul>";

    }
    echo "<br><hr><br>";
    if($color != NULL && $accionGet == "filtrarColor"){       
        echo "<h2>Filtro por color</h2><br>";
        $lamparitas = Lamparita::TraerTodas();
        echo "<ul>";
        foreach($lamparitas as $l){
            $lamparita = new Lamparita($l->tipo,$l->precio,$l->color,$l->path);
            if($lamparita->GetColor()==$color){
                echo "<li>".$lamparita->ToString()."</li>";
            }
        }
        echo "</ul>";

    }

    ?>   
</body>
</html>
