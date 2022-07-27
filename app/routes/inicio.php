<?php

use Bin\Router\Request;
$router = new \Bin\Router\Route();

$router->get('/saludar/hola/:nombre', function(Request $req) {
   echo '<h1>Saludos desde ruta HOLA</h1>';
});

$router->get('/adios', function(Request $req) {
   echo '<h1>Saludos desde ruta ADIOS</h1>';
});



