<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="content-language" content="pt-br" />
	<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<link rel="shortcut icon" type="image/x-icon" href="favicon.ico"/>
	
	<link href="css/inicio.css" type="text/css" rel="stylesheet"/>
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" type="text/css" rel="stylesheet"/>
	<title>{#TITLE_SITE}</title>
</head>

<body>
<div id="wrap">
	<header>
		<img src="css/logo2.png" class="logo"/>
		<p class="name-logo">FastTCC</p>
		<div id="navbar">
			<ul id="items-nav">
				<li class="material-icons"><a href="login.php" id="login">person</a></li>
				<?php
					if(isset($_SESSION["INTEGRANTE"]["id"])) echo "<li class=\"material-icons\"><a href=\"#\" id=\"menu\">menu</a></li>";
				?>
			</ul>
		</div>
		<div class="dropdown" id="dropdown-menu">
			<a href="painel.php">
				<span class="material-icons icon">people</span>
				<span>Equipe</span>
			</a>
			<a href="capa.php">
				<span class="material-icons icon">description</span>
				<span>Documentação</span>
			</a>
			<a href="logout.php">
				<span class="material-icons icon">exit_to_app</span>
				<span>Sair</span>
			</a>
		</div>
	</header>
	
	<div id="background-profile">
		<div id="background-color">
			<span class="material-icons" id="icon">person</span>
		</div>
	</div>
	
	<section class="page">
		<div class="page-content">
			<h2 class="title-section">Minhas informações</h2>
			
			<div id="profile-content">
				<div class="grid-content">
					<div class="row">
						<div class="col icon">
							<span class="material-icons">person</span>
						</div>
						<div class="col information">
							Nome
						</div>
						<div class="col edit">
							<span class="material-icons" id="edit_nome">mode_edit</span>
						</div>
					</div>
					<div class="row">
						<div class="col icon">
							<span class="material-icons">mail</span>
						</div>
						<div class="col information">
							Email
						</div>
						<div class="col edit">
							<span class="material-icons" id="view_email">visibility</span>
						</div>
					</div>
					<div class="row">
						<div class="col icon">
							<span class="material-icons">lock</span>
						</div>
						<div class="col information">
							Senha
						</div>
						<div class="col edit">
							<span class="material-icons" id="edit_senha">mode_edit</span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	
	<div class="modal">
		<div class="box" id="box-name">
			<div class="head">
				<span>Editar nome</span>
				<button class="material-icons close-modal">close</button>
			</div>
			<div class="edit-content">
				<p class="info">Nome atual: <span id="info">{#MEU_NOME}</span></p>
				
				<form name="edit_informacao" class="edit_informacao">
					<input type="hidden" name="action" value="go_name" />
					<input type="text" name="edit_nome" placeholder="Nome" class="input" />
					
					<div class="button-align">
						<button class="salvar-info">Salvar</button>
					</div>
				</form>
			</div>
		</div>
		<div class="box" id="box-senha">
			<div class="head">
				<span>Editar senha</span>
				<button class="material-icons close-modal">close</button>
			</div>
			<div class="edit-content">
				<form name="edit_informacao" class="edit_informacao">
					<input type="hidden" name="action" value="go_senha" />
					<input type="password" name="edit_senha" placeholder="Nova senha" class="input" />
					<input type="password" name="confirm_senha" placeholder="Senha atual" class="input" />
					
					<div class="button-align">
						<button class="salvar-info">Salvar</button>
					</div>
				</form>
			</div>
		</div>
		<div class="box" id="box-email">
			<div class="head">
				<span>Meu e-mail</span>
				<button class="material-icons close-modal">close</button>
			</div>
			<div class="edit-content">
				<p>{#MEU_EMAIL}</p>
			</div>
		</div>
	</div>
	
	<div id="snack-message">
		<div id="content-snack">
			<span id="message"></span>
		</div>
	</div>
	
	<footer>
		<div id="footer">
			<p>FastTCC 2017- WebSite desenvolvido por {#TEAM_NAME}</p>
		</div>
	</footer>
</div>

<script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="js/profile.js"></script>
<script type="text/javascript">
	$('li a#menu').on('click',function(e)
	{
		e.preventDefault();
		e.stopPropagation();
		$('#dropdown-menu').animate({width: 'toggle'}, 300);
	});
</script>
</body>
</html>