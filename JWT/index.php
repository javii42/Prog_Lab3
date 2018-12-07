<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use Firebase\JWT\JWT;

require_once './vendor/autoload.php';

$config['displayErrorDetails'] = true;
$config['addContentLengthHeader'] = false;


/*
¡La primera línea es la más importante! A su vez en el modo de 
desarrollo para obtener información sobre los errores
 (sin él, Slim por lo menos registrar los errores por lo que si está utilizando
  el construido en PHP webserver, entonces usted verá en la salida de la consola 
  que es útil).

  La segunda línea permite al servidor web establecer el encabezado Content-Length, 
  lo que hace que Slim se comporte de manera más predecible.
*/

$app = new \Slim\App(["settings" => $config]);

$app->post('/crearToken[/]',function (Request $request, Response $response){
    $datos = $request->getParsedBody();
    //var_dump($datos);
    $ahora = time();
    $expire = $ahora + 1500;
    $playload = array(
        'iat'=>$ahora,
        'exp'=>$expire, //15 sec
        'data'=>$datos,
        'app'=> 'Ejercicio 23/11/2018'
    );

    $token = JWT::encode($playload,'123');
    return $response->withJson($token,200);
});

$app->post('/verificarToken[/]',function (Request $request, Response $response){
    $parametros = $request->getParsedBody();
    $token = trim($parametros['token'],'"');
    //var_dump($parametros);
    if(empty($token) || $token == ""){
        return $response->withJson(array('mensaje'=>'Token vacio'),502);
        //throw new Exception("El toquen esta vacio");
    }
    try{
        $decodificado = JWT::decode(
            $token,
            '123',
            ['HS256']
        );
      //  var_dump($decodificado);
    }catch(Exception $e){
        return $response->withJson(array('mensaje'=>'Token no valido'),502);
        //throw new Exception("Token no valido");
    }

    return $response->withJson(array('mensaje'=>'Token ok',"datos"=>$decodificado),200);
});



$app->run();