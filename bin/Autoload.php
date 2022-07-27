<?php

namespace Bin;

/**
 * Description of Autoload
 * @author nyakode
 * @date Create at 07/23/2022
 */
class Autoload {

    public static function register() {
      spl_autoload_register(function ($class) {
         $ruta = APP_ROOT . str_replace('\\', DS, strtolower($class)) . '.php';
         if (is_file($ruta)) {
            require_once $ruta;
            return true;
         } else {
             throw new \Exception($ruta);
         }
      }, true, true);
   }

}
