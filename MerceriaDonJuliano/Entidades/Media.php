<?php
    require_once "./Entidades/AccesoDatos.php";
    class Media{
        public $_color;
        public $_marca;
        public $_precio;
        public $_talle;

        public function __construct(){
            
        }

        public static function AltaMedia($datosMedia){
            $retorno = false;
           // var_dump($datosMedia);
            //echo $datosMedia['color'];
            try{
                $Media = new Media();
                $Media->_color  = $datosMedia['color'];
                $Media->_marca = $datosMedia['marca'];
                $Media->_precio = $datosMedia['precio'];
                $Media->_talle = $datosMedia['talle'];

                $conn = AccesoDatos::DameUnObjetoAcceso();
                $consulta = $conn->RetornarConsulta("INSERT INTO medias(color, marca, precio, talle) VALUES (:color,:marca,:precio,:talle) ");
                $consulta->bindParam(':color',$Media->_color);
                $consulta->bindParam(':marca',$Media->_marca);
                $consulta->bindParam(':precio',$Media->_precio);
                $consulta->bindParam(':talle',$Media->_talle);
                $consulta->execute();

                $retorno = true;
            }catch(Exception $e){

                print "Error!<br/>" . $e->getMessage();
                
            }
            return $retorno;
            
        }

        public function TraerMedias(){
            $retorno = null;
            try{
                $conn = AccesoDatos::DameUnObjetoAcceso();
                $consulta = $conn->RetornarConsulta("SELECT * FROM medias WHERE 1");              
                $consulta->execute();
                while($res = $consulta->fetch()){
                    $stdClass = new stdClass();
                    $stdClass->color = $res['color'];
                    $stdClass->marca = $res['marca'];
                    $stdClass->precio = $res['precio'];
                    $stdClass->talle = $res['talle'];
                    $retorno[]=$stdClass;
                }
              //  var_dump($retorno);
            }catch(Exception $e){

                print "Error!<br/>" . $e->getMessage();
                
            }
            return $retorno;

        }

    }