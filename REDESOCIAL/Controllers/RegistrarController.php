<?php
  namespace RedeSocial\Controllers;
  class RegistrarController{
    public function index(){
      if(isset($_POST['registrar'])){
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $senha = $_POST['senha'];

        if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
          \RedeSocial\Utilidades::alerta('E-mail invalido');
          \RedeSocial\Utilidades::redirect(INCLUDE_PATH.'registrar');
        }else if(strlen($senha) < 6){
          \RedeSocial\Utilidades::alerta('Sua senha é muito curta.');
          \RedeSocial\Utilidades::redirect(INCLUDE_PATH.'registrar');
        }else if(\RedeSocial\Models\UsuariosModel::emailExists($email)){
          \RedeSocial\Utilidades::alerta('Email já cadastrado.');
          \RedeSocial\Utilidades::redirect(INCLUDE_PATH.'registrar');
        }else{
          $senha = \RedeSocial\Bcrypt::hash($senha);
          $registro = \RedeSocial\MySql::connect()->prepare("INSERT INTO usuarios VALUES(null,?,?,?,'')");
          $registro->execute(array($nome,$email,$senha));
          \RedeSocial\Utilidades::alerta('Registrado com sucesso!');
          \RedeSocial\Utilidades::redirect(INCLUDE_PATH);
        }
      }
      \RedeSocial\Views\MainView::render('registrar');
    } 
  };
?>