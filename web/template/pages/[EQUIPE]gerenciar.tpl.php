<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="content-language" content="pt-br" />
	<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<link rel="shortcut icon" type="image/x-icon" href="favicon.ico"/>
	
	<link href="css/main.style.css" type="text/css" rel="stylesheet"/>
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" type="text/css" rel="stylesheet"/>
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
			<a href="capa.php">
				<span class="material-icons icon">description</span>
				<span>Documentação</span>
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
			<span>Equipe</span>
		</div>
	</div>
	
	<div class="content">
		<section class="primary-container">
			<div class="page-width">
				<article class="page">
					<div class="content-padding">
						<div class="section-page">
						
							<div class="section" style="width: 100%; margin-bottom: 10px">
								<div id="integrantes">
									<div class="section-title" style="padding: 2px 10px; border-bottom: solid 1px #eee">Integrantes</div>
									<div id="box-integrantes"></div>
								</div>
							</div>
							
							<div class="section" style="width: 100%">
								<div id="usuarios">
									<div class="section-title" style="padding: 2px 10px; border-bottom: solid 1px #eee;overflow:hidden;">
										<p style="float:left">Selecionar usuários</p>
										<div id="div-search">
											<input type="text" placeholder="Pesquisar nome ou e-mail" id="input-search"/>
										</div>
									</div>
									<div id="box-usuarios"></div>
								</div>
							</div>
						</div>
					</div>
				</article>
			</div>
		</section>
		
		<footer>
			<div id="footer">
				FastTCC 2017 - WebSite desenvolvido por {#TEAM_NAME}
			</div>
		</footer>
	</div>
	
	<div id="snack-message">
		<div id="content-snack">
			<span id="message"></span>
		</div>
	</div>
</div>
<script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="js/fasttcc.main.js"></script>
</body>
</html>