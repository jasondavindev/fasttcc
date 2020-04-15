<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="content-language" content="pt-br" />
	<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<link rel="shortcut icon" type="image/x-icon" href="favicon.ico"/>
	
	<link href="css/main.style.css" type="text/css" rel="stylesheet"/>
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" type="text/css" rel="stylesheet"/>
	<title>{#TITLE_SITE} - Referencial Teórico</title>
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
			<span>Referencial teórico</span>
		</div>
	</div>
	
	<div class="content">
		<section class="primary-container">
			<div class="page-width">
				<article class="page">
					<div class="content-padding">
						<section class="section-page">
							<div class="section" style="width: 30%">
								<div class="postit-margin">
									<div class="postit">
										<p>{#DICA}</p>
									</div>
								</div>
							</div>
							<div class="section" style="width: 70%">
								<div class="buttons-align">
									<button class="button-raised" id="view-references">Todas referências</button>
								</div>
								<form class="form-style" id="frm-referencial" name="frm-referencial">
									<input type="hidden" name="refer" value="{#REFER_ID}"/>

									<div class="input_with_tip" style="margin-top: 20px;">
										<input type="text" class="input" id="titulo_ref" name="titulo_ref" value="{#TITULO_REF}" placeholder="Título" autocomplete="off" />
									</div>
								
									<span style="font-size: 16px; margin: 25px 0 10px 0; display: block;">Citação</span>
								
									<div class="tab">
										<a class="tablink" id="direta">Direta</a>
										<a class="tablink" id="indireta">Indireta</a>
									</div>
									
									<div class="tabcontent" id="tab_direta">
										<div class="textarea_tip">
											<textarea id="cit_ori" name="cit_ori" class="textarea" placeholder="">{#CIT_ORI_REF}</textarea>
											<i class="material-icons help" data-pop="citacao_direta">help_outline</i>
											<div class="pop-dica" data-dica="citacao_direta">
												<p>{#DICA_CIT_DIRETA}</p>
											</div>
										</div>
									</div>
									
									<div class="tabcontent" id="tab_indireta">
										<div class="textarea_tip">
											<textarea id="cit_ind" name="cit_ind" class="textarea" placeholder="">{#CIT_IND_REF}</textarea>
											<i class="material-icons help" data-pop="citacao_indireta">help_outline</i>
											<div class="pop-dica" data-dica="citacao_indireta">
												<p>{#DICA_CIT_INDIRETA}</p>
											</div>
										</div>
									</div>
									
									<div class="input_with_tip" style="margin-top: 20px;">
										<input type="text" class="input" id="ref_simp" name="ref_simp" value="{#REF_SIMP}" placeholder="Fonte na citação" autocomplete="off" />
										<i class="material-icons help" data-pop="fonte_citacao">help_outline</i>
										<div class="pop-dica" data-dica="fonte_citacao">
											<p>
												Indicar entre parenteses: SOBRENOME do autor, data de publicação e caso houver, número da página referenciada. <a href="#" id="btn-example-fonte" class="view-example">Ver exemplos.</a>
											</p>
										</div>
									</div>

									<div class="input_with_tip" style="margin-top: 20px;">
										<input type="text" class="input" id="ref_comp" name="ref_comp" value="{#REF_COMP}" placeholder="Referência bibliográfica" autocomplete="off" />
										<i class="material-icons help" data-pop="fonte_bibliografia">help_outline</i>
										<div class="pop-dica" data-dica="fonte_bibliografia">
											<p>
												Fonte que aparecerá na referência bibliográfica do trabalho. <a href="#" id="btn-view-example-referencia" class="view-example">Ver exemplos.</a>
											</p>
										</div>
									</div>
									
									<div id="inputs-citacao-ref">
										{#DIV_INPUTS}
									</div>
									
									<span style="font-size: 16px; margin: 25px 0 10px 0; display: block;">Usar citação:</span>
									
									<div id="inputs-radio">
										<div class="div-radio">
											<label class="material-icons radio-citacao" for="citacao-direta" id="r_direta">radio_button_unchecked</label>
											<span>Direta</span>
										</div>
										<div class="div-radio">
											<label class="material-icons radio-citacao" for="citacao-indireta" id="r_indireta">radio_button_unchecked</label>
											<span>Indireta</span>
										</div>
									</div>
									
									<div class="buttons-align">
										<button class="button-flat">Salvar</button>
									</div>
								</form>
							</div>
						</section>
					</div>
					<div id="snack-message">
						<div id="content-snack">
							<span id="message"></span>
						</div>
					</div>
				</article>
			</div>
			
			<div id="content_referencias" class="modal-dica">
				<div class="modal-view">
					<div class="pop-header">
						<span>Referências</span>
						<button class="close-pop material-icons">close</button>
					</div>
					<div class="pop-content">
						{#CONTENT_REFERENCIAIS}
					</div>
				</div>
			</div>

			<div id="exemplo_fonte_citacao" class="modal-dica">
				<div class="modal-view">
					<div class="pop-header">
						<span>Exemplo fonte de citação</span>
						<button class="close-pop material-icons">close</button>
					</div>
					<div class="pop-content">
						<h2>Fontes de livros</h2>
						<i class="line-break"></i>
						<p>Deve-se indicar <b>SOBRENOME</b> do autor em letras maiúsculas, <b>data de publicação</b> do texto citado e <b>número da(s) página(s) referenciada(s).</b></p>
						<i class="line-break"></i>
						<h2>Exemplo</h2>
						<i class="line-break"></i>
						<i>“Não se desconsidera a contribuição de outros procedimentos de pesquisa e análise de dados, pelo contrário, assinala-se que a utilização simultânea de diferentes abordagens é, em muitos casos, não só cabível, mas desejável”</i> <b>(THIOLLENT, 1984, p.200)</b>.
						<i class="line-break"></i>
						<h2>Fontes da internet</h2>
						<i class="line-break"></i>
						<p>Deve-se indicar o <b>SOBRENOME</b> do autor em letras maiúsculas e <b>data de publicação</b>.</p>
						<i class="line-break"></i>
						<h2>Exemplo</h2>
						<i class="line-break"></i>
						<i>“[...] publicar em um veículo informal pode inviabilizar a publicação futura em um periódico reconhecido pela comunidade científica.”</i> <b>(ARRABAL, 2010)</b>.
						<i class="line-break"></i>
						<p>Caso o texto não contenha a indicação da data de publicação, informe a data de acesso ao conteúdo. Datas prováveis deve-se indicar entre colchetes quando não houver outra possibilidade de determinar esta informação.</p>
						<i class="line-break"></i>
						<p>Exemplo de data provável: <b>(AUTOR, [200-?])</b>.</p>
					</div>
				</div>
			</div>

			<div id="exemplo_referencia" class="modal-dica">
				<div class="modal-view">
					<div class="pop-header">
						<span>Exemplo referência bibliográfica</span>
						<button class="close-pop material-icons">close</button>
					</div>
					<div class="pop-content">
						<h2>Fontes de livros</h2>
						<i class="line-break"></i>
						<p>Deve-se indicar autor(es), <b>Título da Obra</b>, subtítulo. Local de publicação, Editora e Ano de publicação.</p>
						<i class="line-break"></i>
						<h2>Exemplo</h2>
						<i class="line-break"></i>
						DI BERNARDO, L. <b>Algas e suas influências na qualidade das águas e nas tecnologias de tratamento</b>. Rio de janeiro: ABES, 1995.
						<i class="line-break"></i>
						<h2>Fontes da internet</h2>
						<i class="line-break"></i>
						<p>Quando se tratar de obras consultadas online são essenciais as informações sobre o endereço eletrônico, apresentado entre os sinais < >, precedido da expressão “disponível em:” e a data de acesso ao documento, precedida da expressão “Acesso em.” A data deve ser colocada com o dia do mês, espaço, com as primeiras três letras do mês, espaço e o ano com 4 dígitos, ponto final.</p>
						<i class="line-break"></i>
						<h2>Exemplo</h2>
						<i class="line-break"></i>
						<p>ARRABAL, Alejandro Knaesel. Publicação de artigos científicos. <b>Prática da Pesquisa</b>, set. 2010. Disponível em: &#60;http://www.praticadapesquisa.com.br/2010/09/publicacao-de-artigos-cientificos.html>. Acesso em: 9 out. 2011.</p>
					</div>
				</div>
			</div>
			
			<div class="popup" id="remover-item" type-remove="ref">
				<div class="text">
					Voc&#234; tem certeza que quer remover este item?
				</div>
				<div class="buttons">
					<button id="accept">Sim</button>
					<button id="deny">Não</button>
				</div>
			</div>
		</section>
		
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