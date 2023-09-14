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
			<div class="feed-wraper">
				<div class="feed-form">
					<form method="post">
						<textarea name="post_content" placeholder="Em que você esta pensando?"></textarea>
						<input type="hidden" name="post_feed">
						<input type="submit" name="acao" value="Compartilhar">
					</form>
				</div>
				<?php
					$retrievePosts = \RedeSocial\Models\HomeModel::retrieveFriendsPosts();
					foreach($retrievePosts as $key => $value) {
				?>
				<div class="feed-single-post">
					<div class="feed-single-post-author">
						<div class="img-single-post-author">
							<?php
								if(!isset($value['me']) && $value['img'] == ''){ ?>
									<img src="<?php echo INCLUDE_PATH_STATIC ?>images/perfil.jpg" />
							<?php }else if(!isset($value['me'])){ ?>
									<img src="<?php echo INCLUDE_PATH ?>uploads/<?php echo $value['img']?>"/>
							<?php } ?>
							<?php
								if(isset($value['me']) && $_SESSION['img'] == ''){ ?>
									<img src="<?php echo INCLUDE_PATH_STATIC ?>images/perfil.jpg" />
							<?php }else if(isset($value['me'])){ ?>
									<img src="<?php echo INCLUDE_PATH ?>uploads/<?php echo $_SESSION['img']?>"/>
							<?php } ?>
						</div>
						<div class="feed-single-post-author-info">
						<?php if(isset($value['me'])){ ?>
							<h3><?php echo $_SESSION['nome'] ?> (eu)</h3>
						<?php }else{ ?>
							<h3><?php echo $value['usuario'] ?></h3>
						<?php } ?>
							<p><?php echo date('d/m/Y H:i:s',strtotime($value['data'])) ?></p>
						</div>
					</div>
					<div class="feed-single-post-content">
						<p><?php echo $value['conteudo'] ?></p>
					</div>
				</div>
				<?php } ?>
			</div>
			<div class="friends-request-feed">
				<h4>Solicitações de amizade</h4>
				<?php
				foreach (\RedeSocial\Models\UsuariosModel::listarAmizadesPendentes() as $key => $value) {
					$usuarioInfo = \RedeSocial\Models\UsuariosModel::getUsuarioById($value['enviou']);
				?>
					<div class="friend-request-single">
						<img src="<?php echo INCLUDE_PATH_STATIC ?>images/perfil.jpg" />
						<div class="friend-request-single-info">
							<h3><?php echo $usuarioInfo['nome'] ?></h3>
							<p><a href="<?php echo INCLUDE_PATH ?>?aceitarAmizade=<?php echo $usuarioInfo['id'] ?>">Aceitar</a> | <a href="<?php echo INCLUDE_PATH ?>?recusarAmizade=<?php echo $usuarioInfo['id'] ?>">Recusar</a></p>
						</div>
					</div>
				<?php } ?>
			</div>
		</div><!--feed-->
	</section>
</body>
</html>