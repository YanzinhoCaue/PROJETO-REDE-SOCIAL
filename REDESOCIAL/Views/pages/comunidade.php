<!DOCTYPE html>
<html>

<head>
	<!--ALTERAR TITULO-->
	<title>Bem-vindo <?php echo $_SESSION['nome']; ?></title>
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<link href="<?php echo INCLUDE_PATH_STATIC ?>css/feed.css" rel="stylesheet">
	<link href="<?php echo INCLUDE_PATH_STATIC ?>css/comunidade.css" rel="stylesheet">
</head>

<body>
	<section class="main-feed">
		<?php
		include('includes/sidebar.php');
		?>
		<div class="feed">
			<div class="comunidade">
				<div class="container-comunidade">
					<h4>Amigos</h4>
					<div class="container-comunidade-wraper">
						<?php 
							foreach(\RedeSocial\Models\UsuariosModel::listarAmigos() as $key => $value){
						?>
						<div class="container-comunidade-single">
							<div class="img-comunidade-user-single">
								<?php if($value['img'] == ''){ ?>
									<img src="<?php echo INCLUDE_PATH_STATIC ?>images/perfil.jpg" />
								<?php }else{ ?>
									<img src="<?php echo INCLUDE_PATH ?>uploads/<?php echo $_SESSION['img']?>"/>
								<?php } ?>
							</div>
							<div class="info-comunidade-user-single">
								<h2><?php echo $value['nome'] ?></h2>
								<p><?php echo $value['email'] ?></p>
							</div>
						</div>
						<?php } ?>
					</div>
				</div>
				<br />
				<div class="container-comunidade">
					<h4>Comunidade</h4>
					<div class="container-comunidade-wraper">
						<?php
						$comunidade = \RedeSocial\Models\UsuariosModel::listarComunidade();
						foreach ($comunidade as $key => $value) {
							$pdo = \RedeSocial\MySql::connect();
							$verificarAmizade = $pdo->prepare("SELECT * FROM amizades WHERE (enviou = ? AND recebeu = ? AND status = 1) OR (enviou = ? AND recebeu = ? AND status = 1)");
							$verificarAmizade->execute(array($value['id'],$_SESSION['id'],$_SESSION['id'],$value['id']));
							if($verificarAmizade->rowCount() == 1){
								continue;
							}
							if($value['id'] == $_SESSION['id']){
								continue;
							}
						?>
							<div class="container-comunidade-single">
								<div class="img-comunidade-user-single">
									<img src="<?php echo INCLUDE_PATH_STATIC ?>images/perfil.jpg" />
								</div>
								<div class="info-comunidade-user-single">
									<h2><?php echo $value['nome']; ?></h2>
									<p><?php echo $value['email']; ?></p>
									<div class="btn-solicitar-amizade">
										<?php 
											if(\RedeSocial\Models\UsuariosModel::existePedidoAmizade($value['id'])){
										?>
										<a href="<?php echo INCLUDE_PATH ?>comunidade?solicitarAmizade=<?php echo $value['id']; ?>">Solicitar Amizade</a>
										<?php }else{ ?>
											<a href="javascript:void(0)" style="color: orangered;border: 1px solid orangered;">Amizade Pendente</a>
										<?php } ?>
									</div>
								</div>
							</div>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
		</div><!--feed-->
	</section>


</body>


</html>