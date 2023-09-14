<?php
  namespace RedeSocial;
  class Application
  {
    private $controller;
    private function setApp(){
      $loadName = 'RedeSocial\Controllers\\';
      $url = explode('/', @$_GET['url']);
      if($url[0] == ''){
        $loadName.='Home';
      } else{
        $loadName.=ucfirst(strtolower($url[0]));
      }
      $loadName.='Controller';
      if(file_exists($loadName.'.php')){
        $this->controller = new $loadName();
      }else {
        include('Views/pages/404.php');
        die();
      }
    }
    public function run() {
      $this->setApp();
      $this->controller->index();
    }
  };
?>