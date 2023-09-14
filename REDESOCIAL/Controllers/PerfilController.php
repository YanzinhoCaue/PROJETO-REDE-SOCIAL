<?php
  namespace RedeSocial\Controllers;
  class PerfilController{
    public function index(){
      if(isset($_SESSION['login'])){
        if(isset($_POST['atualizar'])){
          $pdo = \RedeSocial\MySql::connect();
          $nome = strip_tags($_POST['nome']);
          $senha = $_POST['senha'];
          if($nome == '' || strlen($nome) < 3){
            \RedeSocial\Utilidades::alerta('O campo nome é obrigatorio');
            \RedeSocial\Utilidades::redirect(INCLUDE_PATH.'perfil');
          }
          if($senha != ''){
            $senha = \RedeSocial\Bcrypt::hash($senha);
            $atualizar = $pdo->prepare("UPDATE usuarios SET nome = ?, senha = ? WHERE id = ?");
            $atualizar->execute(array($nome, $senha, $_SESSION['id']));
            $_SESSION['nome'] = $nome;
          }else{
            $senha = \RedeSocial\Bcrypt::hash($senha);
            $atualizar = $pdo->prepare("UPDATE usuarios SET nome = ? WHERE id = ?");
            $atualizar->execute(array($nome, $_SESSION['id']));
            $_SESSION['nome'] = $nome;
          }
          if($_FILES['file']['tmp_name'] != ''){
            $file = $_FILES['file'];
            $fileExt = explode('.',$file['name']);
            $fileExt = $fileExt[count($fileExt) - 1];
            if($fileExt == 'png' || $fileExt == 'jpg' || $fileExt == 'jpeg'){
              $size = intval($file['size'] / 1024);
              if($size <= 300) {
                $uniqid = uniqid().'.'.$fileExt;
                $atualizaImagem = $pdo->prepare("UPDATE usuarios SET img = ?  WHERE id = ?");
                $atualizaImagem->execute(array($uniqid,$_SESSION['id']));
                move_uploaded_file($file['tmp_name'], 'C:\xampp\htdocs\PROJETO-REDE-SOCIAL\uploads/'.$uniqid);
                $_SESSION['img'] = $uniqid;
                \RedeSocial\Utilidades::alerta('Imagem de perfil atualizado');
                \RedeSocial\Utilidades::redirect(INCLUDE_PATH.'perfil');
              }else{
                \RedeSocial\Utilidades::alerta('Imagem muito grande!');
                \RedeSocial\Utilidades::redirect(INCLUDE_PATH.'perfil');
              }
            }else{
              \RedeSocial\Utilidades::alerta('Tipo de arquivo não permitido!');
              \RedeSocial\Utilidades::redirect(INCLUDE_PATH.'perfil');
            }
          }else{
            \RedeSocial\Utilidades::alerta('Perfil Atualizado');
            \RedeSocial\Utilidades::redirect(INCLUDE_PATH.'perfil');
          }
          \RedeSocial\Utilidades::alerta('Perfil Atualizado');
          \RedeSocial\Utilidades::redirect(INCLUDE_PATH.'perfil');
        }
        \RedeSocial\Views\MainView::render('perfil');
      }else{
        \RedeSocial\Utilidades::redirect(INCLUDE_PATH);
      }
    }
  }
?>