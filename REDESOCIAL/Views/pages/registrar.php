<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="stylesheet" href="<?php echo INCLUDE_PATH_STATIC ?>css/styles.css">
</head>
<body>
  <div class="sidebar"></div>
  <div class="form-container-login">
    <div class="logo-chamada-login">
      <img src="<?php echo INCLUDE_PATH_STATIC ?>images/logo.svg" alt="">
      <p>Conecte-se com seus amigos e expanda seus aprendizados com a rede social Danki Code.</p>
    </div>
    <div class="form-login">
      <h3>Crie sua Conta!</h3>
      <form method="post">
        <input type="text" name="nome" id="" placeholder="Nome">
        <input type="text" name="email" id="" placeholder="Email">
        <input type="password" name="senha" id="" placeholder="Senha">
        <input class="login" type="submit" name="acao" value="Criar Conta">
        <input type="hidden" name="registrar" value="registrar"/>
      </form>
    </div>
  </div>
</body>
</html>