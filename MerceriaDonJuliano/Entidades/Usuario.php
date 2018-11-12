<?php

    require_once "./Entidades/AccesoDatos.php";
    require_once "./Entidades/ErrorPerfilException.php";

    class Usuario{
        public $correo;
        public $clave;
        public $nombre;
        public $apellido;
        public $perfil;
        public $foto;

        public function __construct(){

        }

        public static function AltaUsuario($datos,$nombreFoto){
            $retorno = false;
           // var_dump($datosMedia);
            //echo $datosMedia['color'];
            try{
                $perfil = strtolower($datos['perfil']);
                if($perfil != 'propietario' && $perfil != 'encargado' && $perfil != 'empleado'){
                    throw new ErrorPerfilException("Tipo de perfil incorrecto");
                }else{
                    $Usuario = new Usuario();
                    $Usuario->correo  = $datos['correo'];
                    $Usuario->clave = $datos['clave'];
                    $Usuario->nombre = $datos['nombre'];
                    $Usuario->apellido = $datos['apellido'];
                    $Usuario->perfil = $datos['perfil'];
                    $Usuario->foto = $nombreFoto;
                    
                    $conn = AccesoDatos::DameUnObjetoAcceso();
                    $consulta = $conn->RetornarConsulta('INSERT INTO usuarios(correo, clave, nombre,apellido, perfil, foto) VALUES (:correo,:clave,:nombre,:apellido,:perfil,:foto)');
                    $consulta->bindParam(':correo',$Usuario->correo);
                    $consulta->bindParam(':clave',$Usuario->clave);
                    $consulta->bindParam(':nombre',$Usuario->nombre);
                    $consulta->bindParam(':apellido',$Usuario->apellido);
                    $consulta->bindParam(':perfil',$Usuario->perfil);
                    $consulta->bindParam(':foto',$Usuario->foto);
                    $consulta->execute();
    
                    $retorno = true;
                } 
                
            }catch(ErrorPerfilException $e){               
                print "Error!<br/>" . $e->getMessage();
            }catch(Exception $e){

                print "Error!<br/>" . $e->getMessage();
                
            }
            return $retorno;
            
        }

        public function TraerUsuarios(){
            $retorno = null;
            try{
                $conn = AccesoDatos::DameUnObjetoAcceso();
                $consulta = $conn->RetornarConsulta("SELECT * FROM usuarios WHERE 1");              
                $consulta->execute();
                while($datos = $consulta->fetch()){
                    $Usuario = new Usuario();
                    $Usuario->correo  = $datos['correo'];
                    $Usuario->clave = $datos['clave'];
                    $Usuario->nombre = $datos['nombre'];
                    $Usuario->apellido = $datos['apellido'];
                    $Usuario->perfil = $datos['perfil'];
                    $Usuario->foto = $datos['foto'];

                    $retorno[]=$Usuario;
                }
              //  var_dump($retorno);
            }catch(Exception $e){

                print "Error!<br/>" . $e->getMessage();
                
            }
            return $retorno;

        }

        public function Ingresar($datos){
            $retorno = false;
            try{
                $conn = AccesoDatos::DameUnObjetoAcceso();
                $consulta = $conn->RetornarConsulta("SELECT * FROM usuarios WHERE correo = :correo");
                $consulta->bindParam(':correo',$datos['correo']);              
                $consulta->execute();
                while($res = $consulta->fetch()){
                    if($datos['correo'] == $res['correo'] && $datos['clave']== $res['clave']){
                        $retorno = true;
                    }
                }
              //  var_dump($retorno);
            }catch(Exception $e){

                print "Error!<br/>" . $e->getMessage();
                
            }
            return $retorno;

        }
        

        public function Verificar($datos){
            $retorno = false;
            try{
                $conn = AccesoDatos::DameUnObjetoAcceso();
                $consulta = $conn->RetornarConsulta("SELECT * FROM usuarios WHERE correo = :correo");
                $consulta->bindParam(':correo',$datos['correo']);              
                $consulta->execute();
                while($res = $consulta->fetch()){
                    if($datos['correo'] == $res['correo'] && $datos['clave']== $res['clave']){
                        $retorno = true;
                    }
                }
              //  var_dump($retorno);
            }catch(Exception $e){

                print "Error!<br/>" . $e->getMessage();
                
            }
            return $retorno;

        }

    }