<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="content-language" content="pt-br" />
	<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<link rel="shortcut icon" type="image/x-icon" href="favicon.ico"/>
	
	<link href="css/main.style.css" type="text/css" rel="stylesheet"/>
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" type="text/css" rel="stylesheet"/>
	<title>{#TITLE_SITE} - Introdução</title>
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
			<span>Introdução</span>
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
								<form method="POST" name="frm-introducao" id="frm-introducao" class="form-style">
									<div class="menu-accordion">
										<a class="accordion">Tema</a>
										<div class="panel">
											<div class="textarea_tip">
												<textarea id="tema" name="tema" class="textarea" placeholder="">{#TEMA}</textarea>
											</div>
										</div>
										
										<a class="accordion">Hist&#243;rico</a>
										<div class="panel">
											<div class="textarea_tip">
												<textarea id="historico" name="historico" class="textarea" placeholder="">{#HISTORICO}</textarea>
											</div>
										</div>
										
										<a class="accordion">Evolu&#231;&#227;o</a>
										<div class="panel">
											<div class="textarea_tip">
												<textarea id="evolucao" name="evolucao" class="textarea" placeholder="">{#EVOLUCAO}</textarea>
											</div>
										</div>
										
										<a class="accordion">Problema</a>
										<div class="panel">
											<div class="textarea_tip">
												<textarea id="problema" name="problema" class="textarea" placeholder="">{#PROBLEMA}</textarea>
											</div>
										</div>
										
										<a class="accordion">Solu&#231;&#227;o</a>
										<div class="panel">
											<div class="textarea_tip">
												<textarea id="solucao" name="solucao" class="textarea" placeholder="">{#SOLUCAO}</textarea>
											</div>
										</div>
										
										<a class="accordion">Objetivo geral</a>
										<div class="panel">
											<div class="textarea_tip">
												<textarea id="obj_geral" name="obj_geral" class="textarea" placeholder="">{#OBJ_GERAL}</textarea>
												<i class="material-icons help" data-pop="objetivo_geral">help_outline</i>
												<div class="pop-dica" data-dica="objetivo_geral">
													<p>
														{#DICA_OBJ_GERAL}
													</p>
												</div>
											</div>
										</div>
										
										<a class="accordion">Objetivos espec&#237;ficos</a>
										<div class="panel" id="panel-obj-esp">
											<div id="objetivos_esp">
												{#INPUT_OBJS}
											</div>
											
											<div class="buttons-align">
												<button class="button-flat-no-padding material-icons" id="add_obj" onclick="return false">add_circle_outline</button>
											</div>
										</div>
									
										<div class="buttons-align" style="margin-top: 10px">
											<button class="button-flat">Salvar</button>
										</div>
									</form>
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