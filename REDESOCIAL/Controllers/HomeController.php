<?php
  namespace RedeSocial\Controllers;
  class HomeController{
    public function index(){
      if(isset($_GET['logout'])){
        session_unset();
        session_destroy();
        \RedeSocial\Utilidades::redirect(INCLUDE_PATH);
      }
      if(isset($_SESSION['login'])){
        if(isset($_GET['recusarAmizade'])){
          $idEnviou = (int) $_GET['recusarAmizade'];
          \RedeSocial\Models\UsuariosModel::atualizarPedidoAmizade($idEnviou, 0);
          \RedeSocial\Utilidades::alerta('Pedido de amizade recusada!');
          \RedeSocial\Utilidades::redirect(INCLUDE_PATH);
        }else if(isset($_GET['aceitarAmizade'])){
          $idEnviou = (int) $_GET['aceitarAmizade'];
          if(\RedeSocial\Models\UsuariosModel::atualizarPedidoAmizade($idEnviou, 1)){
            \RedeSocial\Utilidades::alerta('Pedido de amizade aceita!');
            \RedeSocial\Utilidades::redirect(INCLUDE_PATH);
          }else{
            \RedeSocial\Utilidades::alerta('Erro ao aceitar pedido de amizade!');
            \RedeSocial\Utilidades::redirect(INCLUDE_PATH);
          }
        }
        if(isset($_POST['post_feed'])){
          if($_POST['post_content'] == '' || strlen($_POST['post_content'] < 10)){
            \RedeSocial\Utilidades::alerta('Posts vazios não são permitidos!');
            \RedeSocial\Utilidades::redirect(INCLUDE_PATH);
          }
          \RedeSocial\Models\HomeModel::postFeed($_POST['post_content']);
          \RedeSocial\Utilidades::alerta('Compartilhado com sucesso!');
          \RedeSocial\Utilidades::redirect(INCLUDE_PATH);
        }
        \RedeSocial\Views\MainView::render('home');
      }else{
        if(isset($_POST['login'])){
          $login = $_POST['email'];
          $senha = $_POST['senha'];
          $verificar = \RedeSocial\MySql::connect()->prepare("SELECT * FROM usuarios WHERE email = ?");
          $verificar->execute(array($login));
          if($verificar->rowCount() == 0){
            \RedeSocial\Utilidades::alerta('Usuário não cadastrado');
            \RedeSocial\Utilidades::redirect(INCLUDE_PATH);
          }else{
            $dados = $verificar->fetch();
            $senhaBanco = $dados['senha'];
            if(\RedeSocial\Bcrypt::check($senha,$senhaBanco)){
              $_SESSION['login'] = $dados['email'];
              $_SESSION['id'] = $dados['id'];
              $_SESSION['nome'] = explode(' ',$dados['nome'])[0];
              $_SESSION['img'] = $dados['img'];
              \RedeSocial\Utilidades::alerta('Login feito com sucesso.');
              \RedeSocial\Utilidades::redirect(INCLUDE_PATH);
            }else{
              \RedeSocial\Utilidades::alerta('Senha incorreta.');
              \RedeSocial\Utilidades::redirect(INCLUDE_PATH);
            }
          }
        }
        \RedeSocial\Views\MainView::render('login');
      }
    } 
  };
?>