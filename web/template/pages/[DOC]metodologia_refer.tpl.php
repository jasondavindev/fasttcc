<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="content-language" content="pt-br" />
	<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<link rel="shortcut icon" type="image/x-icon" href="favicon.ico"/>
	
	<link href="css/main.style.css" type="text/css" rel="stylesheet"/>
	<link href="css/metodologia.css" type="text/css" rel="stylesheet"/>
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" type="text/css" rel="stylesheet"/>
	<title>{#TITLE_SITE} - Metodologia</title>
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
			<span>Metodologia</span>
		</div>
	</div>
	
	<div class="content">
		<section class="primary-container">
			<div class="page-width">
				<article class="page">
					<div class="pop-message">
						<p></p>
					</div>
					<div class="content-padding">
						<div class="section-page">
							<div class="section" style="width: 30%">
								<div class="postit-margin">
									<div class="postit">
										<p>{#DICA}</p>
									</div>
								</div>
							</div>
							<div class="section" style="width: 70%;">
								<div class="section-title"><b>Subitens</b> - {#TITLE_TOPIC}</div>
									<div class="list-topicos">
										{#SUB_ITENS}
									</div>
								
								<div class="section-content">
									<div class="buttons-align">
										<button class="button-raised" id="view-modal-novo-item">Novo item</button>
									</div>
									<div id="edit-item-metodologia">
										<form enctype="multipart/form-data" id="frm-metodologia" class="form-style">
											<input type="hidden" name="id_item" id="id_item" value="{#ID_TOPICO}">
											<div class="tab">
												<a class="tablink" id="texto">Texto</a>
												<a class="tablink" id="resultado">Resultado</a>
											</div>
											
											<div class="tabcontent" id="tab_texto">
												<input type="text" name="nome_topico" value="{#TITLE_TOPIC}" id="nome_topico" class="input_text_met" placeholder="Digite um nome"/>
												<textarea id="txt_texto" name="txt_texto"></textarea>
												
												<div class="box-image">
													<div id="buttons-image">
														<input type="file" id="imagem_texto" name="imagem_texto" style="display: none"/>
														<label for="imagem_texto" class="button-raised" id="btn-choose-img">Escolher um arquivo</label>
														
														<button class="button-raised" id="view-image"data-image="texto">Ver imagem</button>
													</div>
													
													<input type="text" class="input_text_met" id="nome_img_texto" name="nome_img_texto" placeholder="Título"/>
													<input type="text" class="input_text_met" id="fonte_img_texto" name="fonte_img_texto" placeholder="Fonte"/>
													
													<div id="div-checkbox">
														<input type="checkbox" value="owner" id="autoria_texto" style="display: none"/>
														<label for="autoria_texto" class="material-icons" data-type="texto">check_box_outline_blank</label>
														<span>Autoria própria</span>
													</div>
												</div>
											</div>
											
											<div class="tabcontent" id="tab_resultado">
												<textarea id="txt_resultado" name="txt_resultado"></textarea>
												
												<div class="box-image">
													<div id="buttons-image">
														<input type="file" id="imagem_resultado" name="imagem_resultado" style="display: none"/>
														<label for="imagem_resultado" class="button-raised" id="btn-choose-img">Escolher um arquivo</label>
														
														<button class="button-raised" id="view-image" data-image="resultado">Ver imagem</button>
													</div>
													
													<input type="text" class="input_text_met" id="nome_img_resultado" name="nome_img_resultado" placeholder="Título"/>
													<input type="text" class="input_text_met" id="fonte_img_resultado" name="fonte_img_resultado" placeholder="Fonte"/>
													
													<div id="div-checkbox">
														<input type="checkbox" value="owner" id="autoria_resultado" style="display: none"/>
														<label for="autoria_resultado" class="material-icons" data-type="resultado">check_box_outline_blank</label>
														<span>Autoria própria</span>
													</div>
												</div>
												
											</div>
											<div class="buttons-align">
												<button class="button-flat" id="excluir-item">Excluir</button>
												<button class="button-flat">Salvar</button>
											</div>
											
										</form>
										
										<div id="modal-img-item">
											<div id="box-modal-img">
												<div id="content-box">
													<div class="button">
														<button class="material-icons" id="close-modal">close</button>
													</div>
													<img src="" data-image="texto"/>
													<img src="" data-image="resultado"/>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</article>
			</div>

			<div class="popup" id="remover-item" type-remove="met">
				<div class="text">
					Voc&#234; tem certeza que quer remover este item?
				</div>
				<div class="buttons">
					<button id="accept">Sim</button>
					<button id="deny">Não</button>
				</div>
			</div>
		</section>
		
		<div class="modal" id="modal-novo-item">
			<div class="popup-item">
				<h2>Criar novo item</h2>
				<p>Por favor, insira um nome:</p>
				<form id="add-topico">
					<input type="hidden" name="item_pai" id="item_pai" value="{#ID_PAI}"/>
					<input type="text" name="nome-item" class="input-modal" id="nome-item"/>
					<button class="submit-modal" id="submit-topico">Enviar</button>
					<button class="submit-modal cancel-topico">Cancelar</button>
				</form>
			</div>
		</div>
		
		<div class="modal" id="modal-remove-item">
			<div class="popup-item">
				<h2>Excluir tópico</h2>
				<p>Você realmente deseja excluir este tópico?</p>
				
				<button class="submit-modal" id="remove-topico">Sim</button>
				<button class="submit-modal cancel-topico">Cancelar</button>
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