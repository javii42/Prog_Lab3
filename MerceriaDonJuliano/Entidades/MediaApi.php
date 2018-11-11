<?php
    require_once "./Entidades/Media.php";
    require_once "./Entidades/InterfaceApi.php";

    class MediaApi extends Media implements InterfaceApi{

        public function TraerUno($request, $response,$args){

        }

        public function TraerTodos($request, $response,$args){
            $medias = Media::TraerMedias();
            if($medias != null){
                $newResponse = $response->withJson($medias,200);
            }else{
                $newResponse = $response->withJson(array(mensaje=>'Error'),409);
            }
            return $newResponse;
        }

        public function CargarUno($request, $response,$args){
            $datos = $request->getParsedBody();
          //  var_dump($datos);
            if(Media::AltaMedia($datos)){
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

        
    }