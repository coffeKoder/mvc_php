<?php

/**
 * Description of index
 * @author nyakode
 * @date Create at 07/23/2022
 */

$config_path = './config/app.config.php';

if (is_file($config_path)) {
   require_once $config_path;
   require_once BIN . 'Autoload.php';
   \Bin\Autoload::register();

   $ruta = scandir(ROUTERS);
   foreach ($ruta as $archivo) {
      $ruta_archivo = ROUTERS . $archivo;
      if (is_file($ruta_archivo)) {
         require_once $ruta_archivo;
      }
   }
   \Bin\Router\Route::submit();
   
} else {
   error_reporting(E_ALL);
   ini_set('display_errors', 1);
   throw new \Exception("Archivo $config_path  no existe", 500);
}
