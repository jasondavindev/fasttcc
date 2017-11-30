<?php
	$Page_Request = strtolower(basename($_SERVER['REQUEST_URI']));
	$File_Request = strtolower(basename(__FILE__));
	
	// Verificacao se o usuario esta tentando acessar o arquivo diretamente
	if($Page_Request == $File_Request) {
		exit("");
	}
	
	if(!class_exists("Painel"))
	{
		class Painel extends Mysql
		{
			public function __construct()
			{
				$this->connect();
				
				$this->addFunctions();
			}
			
			private function addFunctions()
			{
				if(isset($_GET["act"]))
				{
					switch($_GET["act"])
					{
						case "integrantes":
							$this->carregarIntegrantes();
							break;
							
						case "remover":
							$this->removerIntegrante();
							break;
						
						case "usuarios":
							$this->carregarUsuarios();
							break;
						
						case "adicionar":
							$this->adicionarUsuario();
							break;
						
						case "criar":
							$this->criarEquipe();
							break;
						
						case "cadastrar":
							$this->cadastrarEquipe();
							break;
							
						case "edit_equip":
							$this->editarEquipe();
							break;
					}
				}
			}
			
			private function cadastrarEquipe()
			{
				$dados = array();
				
				if($_SESSION["INTEGRANTE"]["idequipe"] != 1)
				{
					$dados["status"] = html_entity_decode(PERTENCE_EQUIPE);
					exit(json_encode($dados));
				}
				
				if(isset($_POST["nome_equipe"],$_POST["orientador"]))
				{
					$nome_equipe = htmlentities($_POST["nome_equipe"]);
					$orientador = base64_decode($_POST["orientador"]);
					
					if(!empty($nome_equipe) && !empty($orientador))
					{
						$stmt = $this->prepare("SELECT id FROM equipes WHERE apelido = ?");
						
						if($stmt->execute(array($nome_equipe)) && $this->numRow($stmt) > 0) // Nome em uso
						{
							$dados["status"] = html_entity_decode(NOME_EM_USO);
						}
						else
						{
							$dataCriacao = date("Y-m-d");
							$stmt = $this->prepare("INSERT INTO equipes SET apelido = ?, dataCriacao = ?, idorientador = ?");
							
							if($stmt->execute(array($nome_equipe,$dataCriacao,$orientador)) && $this->numRow($stmt) > 0) // Inserindo equipe
							{
								$stmt = $this->prepare("SELECT id FROM equipes WHERE apelido = ?");
								
								if($stmt->execute(array($nome_equipe)) && $this->numRow($stmt) > 0) // Pegando id equipe
								{
									$row = $this->fetch($stmt);
									
									$stmt = $this->prepare("UPDATE usuarios SET idequipe = ?, tipoUsuario = 1 WHERE id = ?");
									
									if($stmt->execute(array($row["id"],$_SESSION["INTEGRANTE"]["id"])) && $this->numRow($stmt) > 0) // Atualizando usuario
									{
										$_SESSION["INTEGRANTE"]["idequipe"] = $row["id"];
										$_SESSION["INTEGRANTE"]["tipousuario"] = 1;
										$dados["status"] = "<script type=\"text/javascript\">setTimeout(function() {location.reload();}, 1500)</script>".html_entity_decode(SUCESSO_CRIACAO_EQUIPE);
									}
								}
							}
							else
							{
								$dados["status"] = html_entity_decode(ERRO_CRIACAO_EQUIPE);
							}
						}
					}
					else
					{
						$dados["status"] = html_entity_decode(FILL_FIELD);
					}
				}
				else
				{
					$dados["status"] = html_entity_decode(FILL_FIELD);
				}
				
				exit(json_encode($dados));
			}
			
			private function criarEquipe()
			{
				global $template;
				
				if($_SESSION["INTEGRANTE"]["idequipe"] == 1)
				{
					$template->open("template/pages/[EQUIPE]cadastrar.tpl.php");
					$conteudo = "";
					
					$stmt = $this->prepare("SELECT id,nome FROM usuarios WHERE tipousuario = 2");
					
					if($stmt->execute() && $this->numRow($stmt) > 0)
					{
						while($row = $this->fetch($stmt))
						{
							$conteudo .= "<option value=\"".base64_encode($row["id"])."\">".html_entity_decode($row["nome"])."</option>";
						}
					}
					
					$template->set("ORIENTADORES",$conteudo);
				}
				else
				{
					header("Location: painel.php");
				}
			}
			
			private function adicionarUsuario()
			{
				$dados = array();
				
				if(isset($_GET["id"]) && !empty($_GET["id"]))
				{
					$id = base64_decode($_GET["id"]);
					
					$stmt = $this->prepare("SELECT COUNT(id) AS count FROM usuarios WHERE idequipe = ?");
					
					if($stmt->execute(array($_SESSION["INTEGRANTE"]["idequipe"])) && $this->numRow($stmt) > 0)
					{
						$row = $this->fetch($stmt);
						
						if($row["count"] < 4)
						{
							if($id !== $_SESSION["INTEGRANTE"]["id"])
							{
								$stmt = $this->prepare("UPDATE usuarios SET idequipe = ?, tipoUsuario = 0 WHERE id = ? AND idequipe = 1");
								
								if($stmt->execute(array($_SESSION["INTEGRANTE"]["idequipe"],$id)) && $this->numRow($stmt) > 0)
								{
									$dados["status"] = "<script type\"text/javascript\">setTimeout(function() {location.reload();},1500);</script>".html_entity_decode(SUCESSO_ADICIONAR_USUARIO);
								}
								else
								{
									$dados["status"] = html_entity_decode(ERRO_ADICIONAR_USUARIO);
								}
							}
							else
							{
								$dados["status"] = html_entity_decode(USUARIO_INVALIDO);
							}
						}
						else
						{
							$dados["status"] = html_entity_decode(MAXIMO_INTEGRANTES);
						}
					}
				}
				
				exit(json_encode($dados));
			}
			
			private function carregarUsuarios()
			{
				$dados = array();
				
				$stmt = $this->prepare("SELECT id,nome,email FROM usuarios WHERE idequipe = 1 AND tipoUsuario = 0");
				
				if($stmt->execute() && $this->numRow($stmt) > 0)
				{
					while($row = $this->fetch($stmt))
					{
						$dados[] = array("id" => base64_encode($row["id"]), "nome" => html_entity_decode($row["nome"]), "email" => html_entity_decode($row["email"]));
					}
				}
				
				exit(json_encode($dados));
			}
			
			private function removerIntegrante()
			{
				$dados = array();
				
				if($_SESSION["INTEGRANTE"]["tipousuario"] >= 1)
				{
					if(isset($_GET["id"]) && !empty($_GET["id"]))
					{
						$id = base64_decode($_GET["id"]);
						
						if($id != $_SESSION["INTEGRANTE"]["id"])
						{
							$stmt = $this->prepare("UPDATE usuarios SET idequipe = 1 WHERE id = ? AND idequipe = ?");
							
							if($stmt->execute(array($id,$_SESSION["INTEGRANTE"]["idequipe"])) && $this->numRow($stmt) > 0)
							{
								$dados["status"] = "<script type\"text/javascript\">setTimeout(function() {location.reload();},1500);</script>".html_entity_decode(SUCESSO_REMOVER_INTEGRANTE);
							}
							else
							{
								$dados["status"] = html_entity_decode(ERRO_REMOVER_INTEGRANTE);
							}
						}
					}
					else
					{
						$dados["status"] = html_entity_decode(USUARIO_INVALIDO);
					}
				}
				
				exit(json_encode($dados));
			}
			
			private function carregarIntegrantes()
			{
				$usuarios = array();
				
				$stmt = $this->prepare("SELECT id,nome,email,tipousuario FROM usuarios WHERE idequipe = ? ORDER BY tipousuario DESC");
				
				if($stmt->execute(array($_SESSION["INTEGRANTE"]["idequipe"])) && $this->numRow($stmt) > 0)
				{
					while($row = $this->fetch($stmt))
					{
						$usuarios[] = array("id" => base64_encode($row["id"]), "nome" => html_entity_decode($row["nome"]), "email" => html_entity_decode($row["email"]), "tipouser" => (int)$row["tipousuario"]);
					}
				}
				
				exit(json_encode($usuarios));
			}
			
			public function configurarTemplate()
			{
				global $template;
				
				if($_SESSION["INTEGRANTE"]["idequipe"] == 1)
				{
					$this->criarEquipe();
					$template->open("template/pages/[EQUIPE]cadastrar.tpl.php");
				}
				else
				{
					$template->open("template/pages/[EQUIPE]gerenciar.tpl.php");
				}
			}
			
			public function templateInformacoes()
			{
				global $template;
				
				$id_orientador = "";
				$orientadores = "";
				$integrantes = "";
				
				$stmt = $this->prepare("SELECT idorientador FROM equipes WHERE id = ?");
				
				if($stmt->execute(array($_SESSION["INTEGRANTE"]["idequipe"])) && $this->numRow($stmt) > 0)
				{
					$row = $this->fetch($stmt);
					$id_orientador = $row["idorientador"];
				}
				
				/*
				* Dados orientador
				*/
				$stmt = $this->prepare("SELECT id,nome FROM usuarios WHERE tipousuario = 2");
				
				if($stmt->execute() && $this->numRow($stmt) > 0)
				{
					while($row = $this->fetch($stmt))
					{
						$selected = $row["id"] == $id_orientador ? " selected" : "";
						$orientadores .= "<option value=\"".base64_encode($row["id"])."\" $selected>".html_entity_decode($row["nome"])."</option>";
					}
				}
				
				$template->set("ORIENTADORES",$orientadores);
				$template->open("template/pages/[EQUIPE]informacoes.tpl.php");
			}
			
			private function editarEquipe()
			{
				$dados = array();
				
				if(isset($_POST["apelido"],$_POST["orientadores"]))
				{
					if(!empty($_POST["apelido"]) && !empty($_POST["orientadores"]))
					{
						$apelido = htmlentities($_POST["apelido"]);
						$id_orientador = base64_decode($_POST["orientadores"]);
						
						$stmt = $this->prepare("SELECT id FROM equipes WHERE apelido = ?");
						
						if($stmt->execute(array($apelido)) && $this->numRow($stmt) > 0)
						{
							$dados["status"] = html_entity_decode(NOME_EM_USO);
						}
						else
						{
							$stmt = $this->prepare("UPDATE equipes SET apelido = ?, idorientador = ? WHERE id = ?");
							
							if($stmt->execute(array($apelido,$id_orientador,$_SESSION["INTEGRANTE"]["idequipe"])) && $this->numRow($stmt) > 0)
							{
								$dados["status"] = html_entity_decode(EQUIPE_EDITADA);
							}
							else
							{
								$dados["status"] = html_entity_decode(ERRO_EQUIPE_EDITADA);
							}
						}
					}
					else
					{
						$dados["status"] = html_entity_decode(FILL_FIELD);
					}
				}
				
				exit(json_encode($dados));
			}
		}
	}
?>