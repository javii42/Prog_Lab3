<?php
    require_once './clases/IParte2.php';

    class Televisor implements IParte2{
        public $tipo;
        public $precio;
        public $paisOrigen;
        public $path;

        public function __construct($tipo = '',$precio = 0, $paisOrigen='', $path='/'){
            $this->tipo = $tipo;
            $this->precio = $precio;
            $this->paisOrigen = $paisOrigen;
            $this->path = $path;
        }

        public function ToJson(){
            $array=array('tipo'=>$this->tipo,'precio'=>$this->precio,
                'paisOrigen'=>$this->paisOrigen,'path'=>$this->path);
            return json_encode($array);
        }

        public function Agregar(){
            $conn = "mysql:host=localhost;dbname=productos_bd";
            try{
                $pdo = new PDO($conn,'root','');
                $sp = $pdo->Prepare('INSERT INTO televisores(tipo, precio, pais, foto) VALUES ("'.
                $this->tipo.'",'. $this->precio.',"'.$this->paisOrigen.'","'.$this->path.'")');
                return ($sp->Execute());
            }catch(PDOException $e){
                return false;
            }
        }
        public static function Traer(){
            $conn = "mysql:host=localhost;dbname=productos_bd";
            try{
                $televisores= NULL;
                $televisor = NULL;
                $pdo = new PDO($conn,'root','');
                $sp = $pdo->Prepare('SELECT * FROM televisores');
                $sp->Execute();
                while($fila = $sp->fetch(PDO::FETCH_ASSOC)){
                    $televisor = new stdClass();                    
                    $televisor->tipo=$fila['tipo'];
                    $televisor->precio=$fila['precio'];
                    $televisor->paisOrigen=$fila['pais'];
                    $televisor->path=$fila['foto'];
    
                    $televisores[] = $televisor;
                } 
                return $televisores;
            }catch(PDOException $e){
                return null;
            }
        }
        public function CalcularIVA(){
            return $this->precio *1.21;
        }

        

    public static function Eliminar($tipo){
        $conn = "mysql:host=localhost;dbname=productos_bd";
        try{
            $pdo = new PDO($conn,'root','');
            $sp = $pdo->Prepare('DELETE FROM televisores WHERE (tipo="'.$tipo.'")');
          //  var_dump($sp);
            return ($sp->Execute());
        }catch(PDOException $e){
            return false;
        }

    }

    public static function Modificar($tv){
        $conn = "mysql:host=localhost;dbname=productos_bd";
        try{
            $pdo = new PDO($conn,'root','');
            $query = 'UPDATE televisores SET precio='.
            $tv->precio.',path="'.$tv->pathFoto.'" WHERE tipo="'.
            $tv->tipo.'" AND pais="'.$tv->paisOrigen.'"';
            //echo $query;
            $sp = $pdo->Prepare($query);
            return ($sp->Execute());
        }catch(PDOException $e){
            return false;
        }

    }

        
        
    }
