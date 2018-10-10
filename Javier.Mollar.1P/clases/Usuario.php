<?php

class Usuario{
    private $_email;
    private $_clave;

    public function __construct($email = '',$clave=''){
        $this->_email = $email;
        $this->_clave = $clave;
    }

    public function getMail(){
        return $this->_email;
    }
    public function getClave(){
        return $this->_clave;
    }
    public function ToJson(){
        $array=array('email'=>$this->_email,'clave'=>$this->_clave);
        return json_encode($array);
    }

    public function GuardarEnArchivo(){
        $retorno = array('exito'=>false,'mensaje'=>"No se pudo guardar el archivo");
        $array = null;
        $json=null;
        $newJson = $this->ToJson();

        if(file_exists("./archivos/usuarios.json")){
            $archivo = fopen("./archivos/usuarios.json","rb");            
            $lee = fgets($archivo);
            fclose($archivo);
            $array = json_decode($lee,true);
            $array[]=json_decode($newJson,true);
            $json = json_encode($array);
            unlink("./archivos/usuarios.json");

        }else{
            $json = $newJson;
        }

        $archivo = fopen("./archivos/usuarios.json","a+");
        $escribio = fwrite($archivo,$json);
        fclose($archivo); 
        if($escribio){
            $retorno['exito']= true;
            $retorno['mensaje']='Se guardo el usuario en el archivo "./archivos/usuarios.json"';
        }
        return json_encode($retorno);
    }

    public static function TraerTodos(){
        $ArrayStd= null;
        $ArrayUsuarios=null;
        if(file_exists("./archivos/usuarios.json")){
            $archivo = fopen("./archivos/usuarios.json","rb");            
            $lee = fgets($archivo);
            fclose($archivo);
            $ArrayStd = json_decode($lee,true);
            if(isset($ArrayStd['email'])){                
                $user = new Usuario($ArrayStd['email'],$ArrayStd['clave']);
                $ArrayUsuarios[]=$user;
            }else{               
                foreach($ArrayStd as $a){
                    var_dump($a);
                    $user = new Usuario($a['email'],$a['clave']);
                    $ArrayUsuarios[]=$user;
                } 
            }
            foreach($ArrayStd as $a){
              // var_dump($a);
                $user = new Usuario($a['email'],$a['clave']);
                $ArrayUsuarios[]=$user;
            }
        }
      //  var_dump($ArrayUsuarios);
        return $ArrayUsuarios;
    }

    public static function VerificarExistencia($usuario){
            $ArrayUsuarios = Usuario::TraerTodos();
            $retorno = false;
            //var_dump($ArrayUsuarios);
            if($ArrayUsuarios != null){
                foreach($ArrayUsuarios as $u){
                    if($u->getMail() == $usuario->getMail() && $u->getClave() == $usuario->getClave()){
                        $retorno = true;
                        break;
                    }
                }
            }
            return $retorno;
    }
}