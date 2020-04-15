<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="content-language" content="pt-br" />
	<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<link rel="shortcut icon" type="image/x-icon" href="favicon.ico"/>
	
	<link href="css/main.style.css" type="text/css" rel="stylesheet"/>
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" type="text/css" rel="stylesheet"/>
	<title>{#TITLE_SITE} - Resumo</title>
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
			<span>Resumo</span>
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
								<div class="tab">
									<a class="tablink" id="port">Portugu&#234;s</a>
									<a class="tablink" id="ing">Ingl&#234;s</a>
								</div>
								
								<div class="tabcontent" id="tab_port">
									<form method="POST" name="frm-resumo-port" id="frm-resumo-port" class="form-style">
										<div class="textarea_tip">
											<textarea id="resumo_port" name="resumo_port" class="textarea" placeholder="">{#RESUMO_PORT}</textarea>
											<i class="material-icons help" data-pop="resumo-port">help_outline</i>
											<div class="pop-dica" data-dica="resumo-port">
												<p>É a apresentação concisa dos pontos relevantes do documento. Deve-se ressaltar o	objetivo, o método, os resultados e as conclusões do documento. Composto por frases concisas, afirmativas em parágrafo único e sem enumeração de tópicos. Deve-se usar o verbo na voz ativa e na terceira pessoa do singular.</p>
											</div>
										</div>
										
										<div class="input_with_tip">
											<input type="text" class="input" name="keyword[]" value="{#P_CHAVE1}" placeholder="Palavra-chave 1" autocomplete="off" />
											<i class="material-icons help" data-pop="keyword">help_outline</i>
											<div class="pop-dica" data-dica="keyword">
												<p>Palavras-chave identificam os principais assuntos que o trabalho aborda.</p>
											</div>
										</div>
										<div class="input_with_tip">
											<input type="text" class="input" name="keyword[]" value="{#P_CHAVE2}" placeholder="Palavra-chave 2" autocomplete="off" />
										</div>
										<div class="input_with_tip">
											<input type="text" class="input" name="keyword[]" value="{#P_CHAVE3}" placeholder="Palavra-chave 3" autocomplete="off" />
										</div>
										
										<div class="buttons-align">
											<button class="button-flat">Salvar</button>
										</div>
									</form>
								</div>
								
								<div class="tabcontent" id="tab_ing">
									<form method="POST" name="frm-resumo-ing" id="frm-resumo-ing" class="form-style">
										<div class="textarea_tip">
											<textarea id="resumo_ing" name="resumo_ing" class="textarea" placeholder="">{#RESUMO_ING}</textarea>
										</div>
										<div class="input_with_tip">
											<input type="text" class="input" name="keyword[]" value="{#K_WORD1}" placeholder="Palavra-chave 1" autocomplete="off" />
										</div>
										<div class="input_with_tip">
											<input type="text" class="input" name="keyword[]" value="{#K_WORD2}" placeholder="Palavra-chave 2" autocomplete="off" />
										</div>
										<div class="input_with_tip">
											<input type="text" class="input" name="keyword[]" value="{#K_WORD3}" placeholder="Palavra-chave 3" autocomplete="off" />
										</div>

										<div class="buttons-align">
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