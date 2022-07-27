<?php

namespace Bin\Router;

/**
 * Description of router
 * @author nyakode
 * @date Create at 07/23/2022
 */
class Route {
   private static $uris = [];

   public function __construct() {
   }

   public static function add($method, $uri, $function = null) {
      Route::$uris[] = new \Bin\Router\Uri(self::parse_uri($uri), $method, $function);
      // return middleware
      return;
   }

   public static function get($uri, $function = null) {
      return Route::add('GET', $uri, $function);
   }

   public static function post($uri, $function = null) {
      return Route::add('POST', $uri, $function);
   }

   public static function put($uri, $function = null) {
      return Route::add('PUT', $uri, $function);
   }

   public static function delete($uri, $function = null) {
      return Route::add('DELETE', $uri, $function);
   }

   public static function any($uri, $function = null) {
      return Route::add('ANY', $uri, $function);
   }

   public static function parse_uri($uri) {
      $uri = trim($uri, '/');
      $uri = (strlen($uri) > 0) ? $uri : '/';
      return $uri;
   }

   public static function submit() {
      $method = $_SERVER['REQUEST_METHOD'];
      $uri = isset($_GET['url']) ? $_GET['url'] : '';
      $uri = self::parse_uri($uri);

      foreach (Route::$uris as $key => $recordUri) {
         if ($recordUri->match($uri)) {
            return $recordUri->call();
         }
         // uri no encontrado
         header("Content-Type", "text/html");
         echo "</br>La url <a href='{$uri}'> {$uri} </a> no se encuentra registrada en el metodo {$method} </br>";
      }
   }
}
