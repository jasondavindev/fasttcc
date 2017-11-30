<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="content-language" content="pt-br" />
	<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<link rel="shortcut icon" type="image/x-icon" href="favicon.ico"/>
	
	<link href="css/main.style.css" type="text/css" rel="stylesheet"/>
	<link href="css/fonts.css" type="text/css" rel="stylesheet"/>
	<title>{#TITLE_SITE} - Capa</title>
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
				<span class="material-icons icon">assignment</span>
				<span>Capa</span>
			</a>
			<a href="resumo.php">
				<span class="material-icons icon">description</span>
				<span>Resumo</span>
			</a>
			<a href="introducao.php">
				<span class="material-icons icon">content_paste</span>
				<span>Introdução</span>
			</a>
			<a href="referencial.php">
				<span class="material-icons icon">find_in_page</span>
				<span>Referencial teórico</span>
			</a>
			<a href="metodologia.php">
				<span class="material-icons icon">description</span>
				<span>Metodologia</span>
			</a>
			<a href="materiais.php">
				<span class="material-icons icon">build</span>
				<span>Materiais</span>
			</a>
			<a href="conclusao.php">
				<span class="material-icons icon">description</span>
				<span>Conclusão</span>
			</a>
			<a href="logout.php">
				<span class="material-icons icon">exit_to_app</span>
				<span>Sair</span>
			</a>
		</div>
	</header>
	
	<div class="content-background">
		<div class="app-title">
			<span>Capa</span>
		</div>
	</div>
	
	<div class="content">
		<section class="primary-container">
			<div class="page-width">
				<article class="page">
					<div class="content-padding">
						<div class="section-page">
							<div class="section" style="width: 30%">
								<div class="postit-margin">
									<div class="postit">
										<p>{#DICA}</p>
									</div>
								</div>
							</div>
							<div class="section" style="width: 70%">
								<form method="POST" name="frm-capa" id="frm-capa" class="form-style">
								
									<div class="input_with_tip" style="margin: 5px 0 20px 0">
										<input type="text" id="titulo" name="titulo" value="{#TITULO_DOC}" class="input" placeholder="Título"/>
										<i class="material-icons help" data-pop="titulo">help_outline</i>
										<div class="pop-dica" data-dica="titulo">
											<p>{#DICA_TITULO}</p>
										</div>
									</div>
									
									<input type="text" id="sub-titulo" name="sub-titulo" value="{#SUBTITULO_DOC}" class="input_text" placeholder="Subtítulo"/>
									
									<input type="text" id="instituicao" name="instituicao" value="{#INSTITUICAO_DOC}" class="input_text" placeholder="Instituição"/>
									
									<input type="text" id="curso" name="curso" value="{#CURSO_DOC}" class="input_text" placeholder="Curso"/>
									
									<input type="text" id="cidade" name="cidade" value="{#CIDADE_DOC}" class="input_text" placeholder="Cidade"/>
									
									<input type="text" id="ano" name="ano" value="{#ANO_DOC}" class="input_text" placeholder="Ano"/>
									
									<div class="buttons-align">
										<button class="button-flat">Salvar</button>
									</div>
								</form>
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