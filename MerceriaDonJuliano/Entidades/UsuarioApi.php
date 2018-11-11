<?php
    require_once "./Entidades/Usuario.php";
    require_once "./Entidades/InterfaceApi.php";

    class UsuarioApi extends Usuario implements InterfaceApi{

        public function TraerUno($request, $response,$args){

        }

        public function TraerTodos($request, $response,$args){
            $usuarios = Usuario::TraerUsuarios();
            if($usuarios != null){
                $newResponse = $response->withJson($usuarios,200);
            }else{
                $newResponse = $response->withJson(array(mensaje=>'Error'),409);
            }
            return $newResponse;

        }

        public function CargarUno($request, $response,$args){
            $datos = $request->getParsedBody();
          //  var_dump($datos);
            if(Usuario::AltaUsuario($datos)){
                $newResponse = $response->withJson(array(mensaje=>'Ok'),200);
            }else{
                $newResponse = $response->withJson(array(mensaje=>'Error'),409);
            }
            return $newResponse;

        }

        public function BorrarUno($request, $response,$args){

        }

        public function ModificarUno($request, $response,$args){
            
        }

        public function Ingresar($request, $response,$args){
            
        }

        public function Verificar($request, $response,$args){
            
        }

        
    }