<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="content-language" content="pt-br" />
	<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<link rel="shortcut icon" type="image/x-icon" href="favicon.ico"/>
	
	<link href="css/login_register.css" type="text/css" rel="stylesheet"/>
	<link href="css/material_design.css" type="text/css" rel="stylesheet"/>
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" type="text/css" rel="stylesheet"/>
	<title>{#TITLE_SITE} - Entrar</title>
</head>

<body>
<div id="wrap">
	<div class="content">
		<div class="container">
			<form id="form-login">
				<h1 class="header">Login FastTCC</h1>
				<div class="form-group">
					<input type="text" name="eml__" id="email" required />
					<label for="input" class="input-label">E-mail</label><i class="bar"></i>
				</div>
				<div class="form-group">
					<input type="password" name="pwd__" id="senha" required/>
					<label for="input" class="input-label">Senha</label><i class="bar"></i>
				</div>
				<div class="button-container">
					<div class="link">
						<a href="register.php">Criar conta</a>
					</div>
					<div class="buttons">
						<button class="button" id="send-login"><span>Fazer login</span></button>
					</div>
				</div>
			</form>
		</div>
	</div>
	
	<div id="snack-message">
		<div id="content-snack">
			<span id="message"></span>
		</div>
	</div>
</div>
<script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="js/entry_session.js"></script>
</body>
</html>