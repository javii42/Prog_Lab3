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
            $archivos = $request->getUploadedFiles();
            $destino = "./fotos/";
            $nombreArchivoAnterior = $archivos['foto']->getClientFileName();
            $ext = explode(".",$nombreArchivoAnterior);
            $ext = array_reverse($ext);
            $nuevoNombre =$destino.$datos['correo'].".".$ext[0]; 
           // move_uploaded_file($archivos['foto']["tmp_name"], $nuevoNombre);
            $archivos['foto']->moveTo($nuevoNombre);
          //  var_dump($datos);
            if(Usuario::AltaUsuario($datos,$nuevoNombre)){
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
            $datos = $request->getParsedBody();

            var_dump($nuevoNombre);
            if(Usuario::Ingresar($datos)){

                $newResponse = $response->withJson(array("mensaje"=>'Ok'),200);
            }else{
                $newResponse = $response->withJson(array(mensaje=>'Error'),409);
            }
            return $newResponse;

        }

        public function Verificar($request, $response,$args){    
            $datos = $request->getParsedBody();
          //  var_dump($datos);
            if(Usuario::Ingresar($datos)){
                $newResponse = $response->withJson(array(mensaje=>'Ok'),200);
            }else{
                $newResponse = $response->withJson(array(mensaje=>'Error'),409);
            }
            return $newResponse;

            
        }

        
    }