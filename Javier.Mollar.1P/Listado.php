<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Listado de televisores</title>
</head>
<body>
    <table border = "1">
        <tr>
            <th>Tipo</th>
            <th>Pais</th>
            <th>Precio</th>
            <th>Precio + IVA</th>
            <th>Imagen</th>
        </tr>
        <?php
            require_once "./clases/Televisor.php";
            $listaTv = Televisor::Traer();
            $html = '';
            //var_dump($listaTv);
         //   echo "<br>";
            foreach($listaTv as $t){ 
                $html.= "<tr>";               
                $us2 = new Televisor($t->tipo,$t->precio,$t->paisOrigen,$t->path);
                $html.="<td>".$us2->tipo."</td><td>".$us2->paisOrigen."</td><td>".$us2->precio."</td><td>".$us2->CalcularIVA()."</td>";
                $html.='<td><img src="'.$us2->path.'" width="200px" height="200px"/></td>';
                $html.="</tr>";
            }
            echo $html;
        ?>
    </table>
</body>
</html>