<?php
	$Page_Request = strtolower(basename($_SERVER['REQUEST_URI']));
	$File_Request = strtolower(basename(__FILE__));
	
	// Verificacao se o usuario esta tentando acessar o arquivo diretamente
	if($Page_Request == $File_Request) {
		exit("");
	}
	
	if(!class_exists("Profile"))
	{
		class Profile extends Mysql
		{
			public function __construct()
			{
				$this->connect();
				$this->configTags();
				$this->execFunc();
			}
			
			private function configTags()
			{
				global $template;
				
				$stmt = $this->prepare("SELECT nome,email FROM usuarios WHERE id = ?");
				
				if($stmt->execute(array($_SESSION["INTEGRANTE"]["id"])) && $this->numRow($stmt) > 0)
				{
					$row = $this->fetch($stmt);
					
					$template->set("MEU_NOME",html_entity_decode($row["nome"]));
					$template->set("MEU_EMAIL",html_entity_decode($row["email"]));
				}
			}
			
			private function execFunc()
			{
				if(isset($_GET["act"]))
				{
					if($_GET["act"] == "edit_info")
					{
						$this->editarInformacao();
					}
				}
			}
			
			private function editarInformacao()
			{
				if(isset($_POST["action"]))
				{
					if($_POST["action"] == "go_name")
					{
						$this->editarNome();
					}
					else if($_POST["action"] == "go_senha")
					{
						$this->editarSenha();
					}
				}
			}
			
			private function editarNome()
			{
				$dados = array();
				
				if(isset($_POST["edit_nome"]) && !empty($_POST["edit_nome"]))
				{
					$nome = htmlentities($_POST["edit_nome"]);
					
					$stmt = $this->prepare("UPDATE usuarios SET nome = ? WHERE id = ?");
					
					if($stmt->execute(array($nome,$_SESSION["INTEGRANTE"]["id"])) && $this->numRow($stmt) > 0)
					{
						$_SESSION["INTEGRANTE"]["nome"] = html_entity_decode($nome);
						
						$dados["status"] = "<script type=\"text/javascript\">setTimeout(function() {location.reload();}, 1500);</script>".html_entity_decode(SUCESSO_EDIT_PROFILE);
					}
					else
					{
						$dados["status"] = html_entity_decode(ERRO_EDITAR_PROFILE);
					}
				}
				else
				{
					$dados["status"] = html_entity_decode(INFORMACAO_VAZIA_PROFILE);
				}
				
				exit(json_encode($dados));
			}
			
			private function editarSenha()
			{
				$dados = array();
				
				if(isset($_POST["edit_senha"],$_POST["confirm_senha"]) && !empty($_POST["edit_senha"]) && !empty($_POST["confirm_senha"]))
				{
					$senha = $_POST["edit_senha"];
					$confirm = $_POST["confirm_senha"];
					
					$stmt = $this->prepare("SELECT id,senha FROM usuarios WHERE id = ?");
					
					if($stmt->execute(array($_SESSION["INTEGRANTE"]["id"])) && $this->numRow($stmt) > 0)
					{
						$row = $this->fetch($stmt);

						//if(password_verify($confirm,$row["senha"]))
						if(preg_match("/$confirm/", $row["senha"]))
						{
							$stmt = $this->prepare("UPDATE usuarios SET senha = ? WHERE id = ?");
							
							//$senha = password_hash($senha,PASSWORD_BCRYPT);

							if($stmt->execute(array($senha,$_SESSION["INTEGRANTE"]["id"])) && $this->numRow($stmt) > 0)
							{
								$_SESSION["INTEGRANTE"]["senha"] = $senha;
								
								$dados["status"] = "<script type=\"text/javascript\">setTimeout(function() {location.reload();}, 1500);</script>".html_entity_decode(SUCESSO_EDIT_PROFILE);
							}
							else
							{
								$dados["status"] = html_entity_decode(ERRO_EDITAR_PROFILE);
							}
						}
						else
						{
							$dados["status"] = html_entity_decode(CONFIRM_SENHA_INVALIDA);
						}
					}
				}
				else
				{
					$dados["status"] = html_entity_decode(INFORMACAO_VAZIA_PROFILE);
				}
				
				exit(json_encode($dados));
			}
		}
	}
?>