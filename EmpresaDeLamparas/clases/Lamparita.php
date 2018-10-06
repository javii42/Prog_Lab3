<?php
require_once("IVendible.php");

class Lamparita implements IVendible{
    private $_tipo;
    private $_precio;
    private $_color;
    private $_pathFoto;

    public function __construct($tipo = "", $precio = 0, $color = "", $pathFoto = "/"){
        $this->_tipo = $tipo;
        $this->_precio = $precio;
        $this->_color = $color;
        $this->_pathFoto = $pathFoto;
    }

    public function GetTipo(){
        return  $this->_tipo;
    }
    public function GetPath(){
        return  $this->_pathFoto;
    }
    public function GetColor(){
        return  $this->_color;
    }

    public function ToString(){
        return $this->_tipo . "-" . $this->_precio . "-" . $this->_color . "-" .$this->_pathFoto;
    }

    public function PrecioConIva(){
        return $this->_precio * 1.21;
    }

    public function Agregar(){
        $conn = "mysql:host=localhost;dbname=lamparitas_bd";
        try{
            $pdo = new PDO($conn,'root','');
            $sp = $pdo->Prepare('INSERT INTO lamparitas(tipo, color, precio, path) VALUES ("'.
            $this->_tipo.'","'. $this->_color.'",'.$this->_precio.',"'.$this->_pathFoto.'")');
            return ($sp->Execute());
        }catch(PDOException $e){
            return false;
        }
    }

    public static function TraerTodas(){
        $conn = "mysql:host=localhost;dbname=lamparitas_bd";
        try{
            $lamparitas= NULL;
            $lamparita = NULL;
            $pdo = new PDO($conn,'root','');
            $sp = $pdo->Prepare('SELECT * FROM lamparitas');
            $sp->Execute();
            while($fila = $sp->fetch(PDO::FETCH_ASSOC)){
                $lamparita = new stdClass();
                
                $lamparita->tipo=$fila['tipo'];
                $lamparita->precio=$fila['precio'];
                $lamparita->color=$fila['color'];
                $lamparita->path=$fila['path'];

                $lamparitas[] = $lamparita;
            } 
            return $lamparitas;
        }catch(PDOException $e){
            return null;
        }
    }

    public function Eliminar(){
        $conn = "mysql:host=localhost;dbname=lamparitas_bd";
        try{
            $pdo = new PDO($conn,'root','');
            $sp = $pdo->Prepare('DELETE FROM lamparitas WHERE (tipo="'.$this->_tipo.'" AND  color="'.
                $this->_color.'" AND precio ='.$this->_precio.' AND path="'.$this->_pathFoto.'")');
            return ($sp->Execute());
        }catch(PDOException $e){
            return false;
        }

    }

    public static function Modificar($lamparita){
        $conn = "mysql:host=localhost;dbname=lamparitas_bd";
        try{
            $pdo = new PDO($conn,'root','');
            $query = 'UPDATE lamparitas SET precio='.
            $lamparita->_precio.',path="'.$lamparita->_pathFoto.'" WHERE tipo="'.
            $lamparita->_tipo.'" AND color="'.$lamparita->_color.'"';
            //echo $query;
            $sp = $pdo->Prepare($query);
            return ($sp->Execute());
        }catch(PDOException $e){
            return false;
        }

    }
}