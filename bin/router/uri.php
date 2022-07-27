<?php

namespace Bin\Router;

/**
 * Description of uri
 * @author nyakode
 * @date Create at 07/23/2022
 */
class Uri {
   public $uri;
   public $method;
   public $function;
   public $matches;
   protected $request;
   protected $response;

   public function __construct($uri, $method, $function) {
      $this->uri = $uri;
      $this->method = $method;
      $this->function = $function;
   }

   public function match($url) {
      $path = preg_replace('#:([\w]+)#', '([^/]+)', $this->uri);
      $regex = "#^$path$#i";
      
      if(!preg_match($regex, $url, $matches)) {
         return false;
      }
      if($this->method != $_SERVER['REQUEST_METHOD'] && $this->method != 'ANY') {
         return false;
      }

      array_shift($matches);
      $this->matches = $matches;
      return true;
   }

   private function execFunction() {
      $this->parseRequest();
      $this->response = call_user_func_array($this->function, $this->matches);
   }

   public function call() {
      try{
         $this->request = $_REQUEST;
         $this->execFunction();
         $this->printResponse();

      } catch (\Exception $e) {
         echo "ERROR => " . $e->getMessage();
      }
   }

   private function parseRequest() {
      $reflectionFunction = new \ReflectionMethod($this->function);
      $this->request = new Request($this->request);
      $this->matches = $this->request;
   }

   private function printResponse(){
      if(is_string($this->response)) {
         echo $this->response;
      } else if(is_array($this->response)) {
         echo json_encode($this->response);
      } else if(is_object($this->response)) {
         echo json_encode($this->response);
      } else {
         echo 'No se pudo procesar la respuesta';
      }
   
   }

}
