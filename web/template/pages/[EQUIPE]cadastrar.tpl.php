<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="content-language" content="pt-br" />
	<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<link rel="shortcut icon" type="image/x-icon" href="favicon.ico"/>
	
	<link href="css/main.style.css" type="text/css" rel="stylesheet"/>
	<link href="css/material_design.css" type="text/css" rel="stylesheet"/>
	<link href="css/fonts.css" type="text/css" rel="stylesheet"/>
	<title>{#TITLE_SITE}</title>
</head>

<body>
<div id="wrap" class="row">
	<header>
		<img src="css/logo2.png" class="logo"/>
		<p class="name-logo">FastTCC</p>
		<div class="navbar">
			<div class="links">
				<button id="button-bar" class="material-icons">menu</button>
			</div>
		</div>
		
		<div id="dropdown">
			<a href="index.php">
				<span class="material-icons icon">home</span>
				<span>Início</span>
			</a>
			<a href="profile.php">
				<span class="material-icons icon">person</span>
				<span>Perfil</span>
			</a>
			<a href="logout.php">
				<span class="material-icons icon">exit_to_app</span>
				<span>Sair</span>
			</a>
		</div>
	</header>
	
	<div class="content-background">
		<div class="app-title">
			<span>Criar equipe</span>
		</div>
	</div>
	
	<div class="content">
		<section class="primary-container">
			<div class="page-width">
				<article class="page">
					<div class="content-padding">
						<div class="section-page">
							<div class="section" style="width: 100%">
								<form id="frm-criar-equipe">
									<div class="form-group">
										<input type="text" name="nome_equipe" id="nome_equipe" required="required" />
										<label for="input" class="input-label">Nome da equipe</label><i class="bar"></i>
									</div>
									<div class="form-group">
										<select id="orientador" name="orientador" required>
											<option value="">Selecione</option>
											{#ORIENTADORES}
										</select>
										<label for="select" class="input-label">Orientador</label><i class="bar"></i>
									</div>
									<div class="button-container">
										<button class="button"><span>Confirmar</span></button>
									</div>
								</div>
							</div>
						</div>
					</div>
				</article>
			</div>
		</section>
		
		<div id="snack-message">
			<div id="content-snack">
				<span id="message"></span>
			</div>
		</div>
		
		<footer>
			<div id="footer">
				FastTCC 2017 - WebSite desenvolvido por {#TEAM_NAME}
			</div>
		</footer>
	</div>
</div>
<script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="js/fasttcc.main.js"></script>
</body>
</html>