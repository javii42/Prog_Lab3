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

    require_once "./clases/Televisor.php";
    
    $pais = isset($_GET['pais']) ? $_GET['pais'] : NULL;
    $accionGet = isset($_GET['accion']) ? $_GET['accion'] : NULL;
    $tipo = isset($_POST['tipo']) ? $_POST['tipo'] : NULL;
    $accionSet = isset($_POST['accion']) ? $_POST['accion'] : NULL;

    if($tipo != NULL && $accionSet == "filtrar"){
        echo "<h2>Filtro por tipo</h2><br>";

        $televisores = Televisor::Traer();
       ?><table border = "1">
        <tr>
            <th>Tipo</th>
            <th>Pais</th>
            <th>Precio</th>
            <th>Precio + IVA</th>
            <th>Imagen</th>
        </tr>
        <?php
        foreach($televisores as $tv){
            $t = new Lamparita($tv->tipo,$tv->precio,$tv->paisOrigen,$tv->path);
            if($tv->tipo==$tipo){                 
                $html.= "<tr>";               
                $html.="<td>".$us2->tipo."</td><td>".$us2->paisOrigen."</td><td>".$us2->precio."</td><td>".$us2->CalcularIVA()."</td>";
                $html.='<td><img src="'.$us2->path.'" width="200px" height="200px"/></td>';
                $html.="</tr>";
            }
        }
        echo $html."</table>";

    }
    echo "<br><hr><br>";
    if($color != NULL && $accionGet == "filtrarColor"){       
        echo "<h2>Filtro por pais</h2><br>";
        $televisores = Televisor::Traer();
        ?><table border = "1">
         <tr>
             <th>Tipo</th>
             <th>Pais</th>
             <th>Precio</th>
             <th>Precio + IVA</th>
             <th>Imagen</th>
         </tr>
         <?php
        foreach($televisores as $tv){
            $t = new Lamparita($tv->tipo,$tv->precio,$tv->paisOrigen,$tv->path);
            if($tv->paisOrigien==$pais){                 
                $html.= "<tr>";               
                $html.="<td>".$us2->tipo."</td><td>".$us2->paisOrigen."</td><td>".$us2->precio."</td><td>".$us2->CalcularIVA()."</td>";
                $html.='<td><img src="'.$us2->path.'" width="200px" height="200px"/></td>';
                $html.="</tr>";
            }
        }
        echo $html."</table>";

    }

    ?>   
</body>
</html>
