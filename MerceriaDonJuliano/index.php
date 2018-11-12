<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require_once './vendor/autoload.php';
require_once'./Entidades/MediaApi.php';
require_once'./Entidades/UsuarioApi.php';
require_once'./Entidades/MW.php';

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

$app->group('/',function(){
  $this->post('', \MediaApi::class .':CargarUno');
  $this->get('', \UsuarioApi::class .':TraerTodos');
  $this->delete('', \UsuarioApi::class . ':BorrarUno');
  $this->put('', \UsuarioApi::class . ':ModificarUno');
})->add(\MW::class . ":MWDos");
  
$app->get('/medias[/]', \MediaApi::class . ':TraerTodos');

$app->post('/usuarios[/]', \UsuarioApi::class . ':CargarUno');

$app->group('/login',function(){
  $this->post('[/]', \UsuarioApi::class . ':Ingresar');
  $this->get('[/]', \UsuarioApi::class . ':Verificar');
})->add(\MW::class . ":MWUno");

$app->run();