<!DOCTYPE html>
<html>
<head>
  <title>Bem-vindo <?php echo $_SESSION['nome']; ?></title>
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link href="<?php echo INCLUDE_PATH_STATIC ?>css/feed.css" rel="stylesheet">
</head>
<body>
  <section class="main-feed">
    <?php include('includes/sidebar.php'); ?>
    <div class="feed">
      <div class="editar-perfil">
        <h2>Perfil</h2>
        <br>
        <?php
        if (isset($_SESSION['img']) && $_SESSION['img'] == '') {
          echo '<img src="' . INCLUDE_PATH_STATIC . 'images/perfil.jpg"/>';
        } else {
          echo '<img src="' . INCLUDE_PATH . 'uploads/' . $_SESSION['img'] . '"/>';
        }
        ?>
        <br>
        <form method="post" enctype="multipart/form-data">
          <input type="text" name="nome" value="<?php echo $_SESSION['nome'] ?>">
          <br>
          <input type="password" name="senha" placeholder="Nova senha">
          <br>
          <input type="file" name="file">
          <input type="hidden" name="atualizar" value="atualizar">
          <input type="submit" name="acao" value="Salvar">
        </form>
      </div>
    </div><!--feed-->
  </section>
</body>
</html>