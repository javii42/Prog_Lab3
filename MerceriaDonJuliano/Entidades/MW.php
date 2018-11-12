<?php
    require_once "./Entidades/Usuario.php";

class MW{

    public function MWUno($request, $response,$next){
        $datos = $request->getParsedBody();
        $newResponse = $response->withJson(array(mensaje=>"OK"),200);
        if($datos['correo']!=null && $datos['clave'] != null){
            if(MW::VerificarVacios($datos)){
                if($this->VerificarUsuario($datos)){                  
                    $response = $next($request,$response);
                }else{
                    $newResponse = $response->withJson(array(mensaje=>"No existe el usuario"),409);

                }
            }else{
                $newResponse = $response->withJson(array(mensaje=>"La clave o el usuario estan vacios"),409);

            }
        }else{
            $newResponse = $response->withJson(array(mensaje=>"No fue seteado el correo o la clave"),409);
        }
        return $newResponse;
    }

    public static function VerificarVacios($datos){      
        if($datos['correo']!='' && $datos['clave'] != ''){
            return true;
        }else{
            return false;
        }
    }

    public function VerificarUsuario($datos){
        if(Usuario::Verificar($datos)){
            return true;
        }else{
            return false;
        }
    }

    public function MWDos($request, $response,$next){
        if($request->isDelete()){
            
        }else if($request->isPut()){

        }
        return $response;
    }

    public static function EsPropietario(){

    }

    public function EsEncargado(){
        
    }
}