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
		<div id="navbar">
			<img src="css/logo2.png" class="logo"/>
			<p class="name-logo">FastTCC</p>
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
	
	<section id="page-presentation-photo">
		<div class="section-photo" id="presentation">
			<div class="opacity-back"></div>
			<a href="capa.php" id="start-project">Iniciar projeto</a>
		</div>
	</section>
	
	<section id="page-presentation-content">
		<div class="container">
			<div class="row border-bottom">
				<div class="col-md-6 col-md-pull-0" style="margin: 54px 0">
					<div class="section">
						<h2 class="head">Economize tempo</h2>
						<p class="section-body">No FastTCC, você economiza muito mais tempo para elaborar o documento do seu trabalho.</p>
					</div>
				</div>
				<div class="col-md-6 col-md-push-0">
					<div class="align-center">
						<img src="css/relogio.png" class="example" />
					</div>
				</div>
			</div>
			<div class="row border-bottom">
				<div class="col-md-6 col-md-push-6" style="margin: 54px 0">
					<div class="section">
						<h2 class="head">Criação dinâmica</h2>
						<p class="section-body">FastTCC permite a criação de conteúdo de forma dinâmica.</p>
					</div>
				</div>
				<div class="col-md-6 col-md-pull-6">
					<div class="align-center">
						<img src="css/dinamico.png" class="example" />
					</div>
				</div>
			</div>
			<div class="row border-bottom">
				<div class="col-md-6 col-md-pull-0" style="margin: 55px 0">
					<div class="section">
						<h2 class="head">Dicas</h2>
						<p class="section-body">Desenvolvimento do conteúdo com auxílio de dicas pedagógicas.</p>
					</div>
				</div>
				<div class="col-md-6 col-md-push-0">
					<div class="align-center">
						<img src="css/dica.png" class="example" />
					</div>
				</div>
			</div>
			<div class="row border-bottom">
				<div class="col-md-6 col-md-push-6" style="margin: 63px 0">
					<div class="section">
						<h2 class="head">Praticidade</h2>
						<p class="section-body">No final, você pode gerar seu documento completo em formato PDF.</p>
					</div>
				</div>
				<div class="col-md-6 col-md-pull-6">
					<div class="align-center">
						<img src="css/documento.png" class="example" />
					</div>
				</div>
			</div>
		</div>
	</section>
	
	<footer>
		<div id="footer">
			<p>FastTCC 2017- WebSite desenvolvido por {#TEAM_NAME}</p>
		</div>
	</footer>
</div>

<script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="js/fasttcc.main.js"></script>
<script type="text/javascript">
	$('li a#menu').on('click',function(e)
	{
		e.preventDefault();
		e.stopPropagation();
		$('#dropdown-menu').animate({width: 'toggle'}, 300);
	});
	
	$(document).ready(function() {
		
		adjustSize();
		
		$(window).resize(function() {
			adjustSize();
		});
	});
	
	function adjustSize() {
		var window_height = $(window).height();
		var row_height = $('.row').height();
		
		var of_height = $(window).width() <= 768 ? window_height : (window_height-row_height);
		
		$('#presentation').css({height: of_height+'px'});
	}
</script>
</body>
</html>