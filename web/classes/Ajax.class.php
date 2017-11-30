<?php
	$Page_Request = strtolower(basename($_SERVER['REQUEST_URI']));
	$File_Request = strtolower(basename(__FILE__));
	
	// Verificacao se o usuario esta tentando acessar o arquivo diretamente
	if($Page_Request == $File_Request) {
		exit("");
	}
	
	if(!class_exists("Ajax"))
	{
		class Ajax extends Mysql
		{
			public function __construct()
			{
				$this->connect();
				
				if(isset($_GET["ajax"]))
				{
					switch($_GET["ajax"])
					{
						case "login":
							$this->fazerLogin();
							break;
						
						case "register":
							$this->fazerRegistro();
							break;
						
						default:
							exit("Erro no Ajax");
							break;
					}
				}
			}
			
			private function isEmail($email)
			{
				$regex = "/^(([0-9a-zA-Z]+[-._+&])*[0-9a-zA-Z]+@([-0-9a-zA-Z]+[.])+[a-zA-Z]{2,6}){0,1}$/";
				
				if(preg_match($regex,$email)) return true;
				else return false;
			}
			
			private function fazerRegistro()
			{
				$dados = array();
				
				if(empty($_POST["nme__"]) || empty($_POST["eml__"]) || empty($_POST["pwd__"]) || empty($_POST["cpwd__"]))
				{
					$dados = array("status" => html_entity_decode(FILL_FIELD));
				}
				else
				{
					if($this->isEmail($_POST["eml__"]))
					{
						$nome = htmlentities($_POST["nme__"]);
						$email = htmlentities($_POST["eml__"]);
						$senha = $_POST["pwd__"];
						$csenha = $_POST["cpwd__"];
						$senha_crypt = password_hash($senha,PASSWORD_BCRYPT);
						//$senha_crypt = $senha;
						
						$stmt = $this->prepare("SELECT id FROM usuarios WHERE email = ?");
						
						if($stmt->execute(array($email)) && $this->numRow($stmt) > 0)
						{
							$dados = array("status" => html_entity_decode(EMAIL_EM_USO));
						}
						else
						{
							if($senha === $csenha)
							{
								$stmt = $this->prepare("INSERT INTO usuarios SET nome = ?,email = ?,senha = ?,tipousuario = 0,idequipe = 1");
								
								if($stmt->execute(array($nome,$email,$senha_crypt)) && $this->numRow($stmt) > 0)
								{
									$dados = array("status" => "<script type=\"text/javascript\">setTimeout(function() {window.location = 'login.php';}, 1500);</script>".html_entity_decode(CADASTRO_SUCESSO));
								}
								else
								{
									$dados = array("status" => html_entity_decode(ERRO_CADASTRO));
								}
							}
							else
							{
								$dados = array("status" => html_entity_decode(CONFIRM_SENHA_INVALIDA));
							}
						}
					}
					else
					{
						$dados = array("status" => html_entity_decode(EMAIL_INVALIDO));
					}
				}
				exit(json_encode($dados));
			}
			
			private function fazerLogin()
			{
				if(empty($_POST["eml__"]) || empty($_POST["pwd__"]))
				{
					$dados = array("status" => html_entity_decode(FILL_FIELD));
				}
				else
				{
					$email = htmlentities($_POST["eml__"]);
					$senha = $_POST["pwd__"];
					
					$stmt = $this->prepare("SELECT * FROM usuarios WHERE email = ?");
					
					if($stmt->execute(array($email)) && $this->numRow($stmt) > 0)
					{
						$row = $this->fetch($stmt);
						if(password_verify($senha,$row["senha"]))
						//if(preg_match("/$senha/", $row["senha"]))
						{
							$_SESSION["INTEGRANTE"]["id"] = $row["id"];
							$_SESSION["INTEGRANTE"]["nome"] = html_entity_decode($row["nome"]);
							$_SESSION["INTEGRANTE"]["email"] = html_entity_decode($row["email"]);
							$_SESSION["INTEGRANTE"]["senha"] = $row["senha"];
							$_SESSION["INTEGRANTE"]["idequipe"] = $row["idequipe"];
							$_SESSION["INTEGRANTE"]["tipousuario"] = $row["tipoUsuario"];
							
							$dados = array("status" => "<script type=\"text/javascript\">setTimeout(function() {window.location = 'index.php';}, 1500);</script>".html_entity_decode(LOGIN_SUCCESS));
						}
						else
						{
							$dados = array("status" => html_entity_decode(LOGIN_ERROR_AUTHENTIC));
						}
					}
					else
					{
						$dados = array("status" => html_entity_decode(LOGIN_ERROR_AUTHENTIC));
					}
				}
				
				exit(json_encode($dados));
			}
		}
	}
?>