<?php
	$Page_Request = strtolower(basename($_SERVER['REQUEST_URI']));
	$File_Request = strtolower(basename(__FILE__));
	
	// Verificacao se o usuario esta tentando acessar o arquivo diretamente
	if($Page_Request == $File_Request) {
		exit("");
	}
	
	if(!class_exists("Metodologia"))
	{
		class Metodologia extends Mysql
		{
			public function __construct()
			{
				$this->connect();
				$this->configTemplate();
				
				if(isset($_GET["act"]))
				{
					switch($_GET["act"])
					{
						case "remove":
							$this->removerItem();
							break;
							
						case "add":
							$this->adicionarItem();
							break;
							
						case "save_content":
							$this->salvarConteudo();
							break;
						
						case "load_item":
							$this->carregarDadosItem();
							break;
					}
				}
			}
			
			private function removerItem() // 20-11-2017
			{
				$dados = array(
					"error" => true,
					"mensagem" => ""
				);
				$id_item = base64_decode($_POST["id_item"]);
				
				$stmt = $this->prepare("SELECT id,idreference FROM metodologia WHERE id = ?");
				
				if($stmt->execute(array($id_item)) && $this->numRow($stmt) > 0)
				{
					$row = $this->fetch($stmt);
					if($row["idreference"] == 0)
					{
						$stmt = $this->prepare("DELETE FROM metodologia WHERE idreference = ? OR id = ?");
						
						$params = array(
							$row["id"],
							$row["id"]
						);
						
						if($stmt->execute($params))
						{
							$dados["error"] = false;
							$dados["mensagem"] = TOPICO_EXCLUIDO;
						}
						else {
							$dados["mensagem"] = "Erro ao excluir itens desse tópico.";
						}
					}
					else
					{
						$stmt = $this->prepare("DELETE FROM metodologia WHERE id = ? AND iddocumento = ?");
						
						$params = array(
							$id_item,
							$_SESSION["INTEGRANTE"]["iddocumento"]
						);
						
						if($stmt->execute($params) && $this->numRow($stmt) > 0)
						{
							$dados["error"] = false;
							$dados["mensagem"] = TOPICO_EXCLUIDO;
						}
						else {
							$dados["mensagem"] = "Erro ao excluir este tópico.";
						}
					}
				}
				exit(json_encode($dados));
			}
			
			private function configTemplate()
			{
				global $template, $DICAS;
				
				if(isset($_GET["refer"]))
				{	
					$params = array
					(
						base64_decode($_GET["refer"]),
						$_SESSION["INTEGRANTE"]["iddocumento"]
					);
					
					$stmt = $this->prepare("SELECT * FROM metodologia WHERE id = ? AND iddocumento = ?");
					
					if($stmt->execute($params) && $this->numRow($stmt) > 0)
					{
						$row		= $this->fetch($stmt);
						$name_topic	= utf8_decode($row["nome"]);
						$id_topic	= base64_encode($row["id"]);
						
						// selecionando subitens do topico
						
						$stmt = $this->prepare("SELECT * from metodologia WHERE idreference = ? AND iddocumento = ?");
						
						$templateSub = "";
						
						$templateSub .= "<a href=\"#\" data-id=\"".$id_topic."\"><h2>".$name_topic."</h2></a>";
						
						if($stmt->execute($params) && $this->numRow($stmt) > 0)
						{	
							while($row = $this->fetch($stmt))
							{
								$templateSub .= "<a href=\"#\" data-id=\"".base64_encode($row["id"])."\"><h2>".utf8_decode($row["nome"])."</h2></a>";
							}
						}
						$template->set("ID_TOPICO",$id_topic);
						$template->set("ID_PAI",$id_topic);
						$template->set("SUB_ITENS",$templateSub);
						$template->set("TITLE_TOPIC",$name_topic);
						$template->open("template/pages/[DOC]metodologia_refer.tpl.php");
					}
					else
					{
						header("Location: metodologia.php");
					}
				}
				else
				{
					$template->set("TOPICOS_METODOLOGIA",$this->carregarTopicos());
					$template->open("template/pages/[DOC]metodologia.tpl.php");
				}

				$template->set("DICA",$DICAS["metodologia"]);
			}
			
			private function carregarDadosItem()
			{
				$dados = array(
					"id_item"				=> "",
					"nome_item"				=> "",
					"txt_texto"				=> "",
					"img_texto"				=> "",
					"nome_img_texto"		=> "",
					"fonte_img_texto"		=> "",
					"txt_resultado"			=> "",
					"img_resultado"			=> "",
					"nome_img_resultado"	=> "",
					"fonte_img_resultado"	=> ""
				);
				
				if(isset($_POST["id_item"]))
				{
					$id_item = base64_decode($_POST["id_item"]);
				
					$stmt = $this->prepare("SELECT * FROM metodologia WHERE id = ? AND iddocumento = ?");
					
					$params = array(
						$id_item,
						$_SESSION["INTEGRANTE"]["iddocumento"]
					);
					
					if($stmt->execute($params) && $this->numRow($stmt) > 0)
					{
						$row = $this->fetch($stmt);
						
						$dados["id_item"]				= base64_encode($row["id"]);
						$dados["nome_item"]				= utf8_decode($row["nome"]);
						$dados["txt_texto"]				= utf8_decode($row["texto"]);
						$dados["img_texto"]				= $row["img_texto"];
						$dados["nome_img_texto"]		= utf8_decode($row["nome_img_texto"]);
						$dados["fonte_img_texto"]		= utf8_decode($row["fonte_img_texto"]);
						$dados["txt_resultado"]			= utf8_decode($row["resultado"]);
						$dados["img_resultado"]			= $row["img_resultado"];
						$dados["nome_img_resultado"]	= utf8_decode($row["nome_img_resultado"]);
						$dados["fonte_img_resultado"]	= utf8_decode($row["fonte_img_resultado"]);
					}
				}
				exit(json_encode($dados));
			}
			
			private function salvarConteudo() // 13-09-2017
			{
				$id_item = base64_decode($_POST["id_item"]);
				$dados = array(
					"error" => true,
					"mensagem" => ""
				);
				
				$params = array(
					utf8_encode($_POST["nome_topico"]),
					utf8_encode($_POST["txt_texto"]),
					utf8_encode($_POST["txt_resultado"]),
					$id_item
				);
				
				$stmt = $this->prepare("UPDATE metodologia SET nome = ?, texto = ?, resultado = ? WHERE id = ?");
				if($stmt->execute($params) && $this->numRow($stmt) > 0)
				{
					$dados["error"] = false;
					$dados["mensagem"] = SUCESSO_ALTERACAO;
				}
				else
				{
					$dados["mensagem"] = NENHUMA_ALTERACAO;
				}
				
				$execTexto	= $this->salvarImagem("imagem_texto","imgtxt","texto",$id_item);
				$execResult	= $this->salvarImagem("imagem_resultado","imgrs","resultado",$id_item);
				
				if($execTexto["error"] == false || $execResult["error"] == false)
				{
					$dados["error"] = false;
					$dados["mensagem"] = SUCESSO_ALTERACAO;
				}
				else
				{
					if($execTexto["error"] == true && $execTexto["mensagem"] != NENHUMA_ALTERACAO)
					{
						$dados["mensagem"] = $execTexto["mensagem"];
					}
					if($execResult["error"] == true && $execResult["mensagem"] != NENHUMA_ALTERACAO)
					{
						$dados["mensagem"] = $execResult["mensagem"];
					}
				}
				
				exit(json_encode($dados));
			}
			
			private function adicionarItem() // 20-11-2017
			{
				// Iniciando novas praticas de programacao -> 20-11-2017
				
				$dados = array(
					"error" => true,
					"mensagem" => ""
				);
				
				$name_topic = utf8_encode($_POST["nome_item"]);
				
				if(!empty($name_topic))
				{
					if(isset($_POST["item_pai"]) && !empty($_POST["item_pai"]))
					{
						$stmt = $this->prepare("INSERT INTO metodologia SET nome = ?,iddocumento = ?,idreference = ?");
						
						$params = array(
							$name_topic,
							$_SESSION["INTEGRANTE"]["iddocumento"],
							base64_decode($_POST["item_pai"])
						);
					}
					else
					{
						$stmt = $this->prepare("INSERT INTO metodologia SET nome = ?,iddocumento = ?");
						
						$params = array(
							$name_topic,
							$_SESSION["INTEGRANTE"]["iddocumento"]
						);
					}
					if(strlen($_POST["nome_item"]) > 45)
					{
						$dados["mensagem"] = ERRO_TAMANHO_TOPICO;
						exit(json_encode($dados));
					}
					
					if($stmt->execute($params) && $this->numRow($stmt) > 0)
					{
						$dados["error"] = false;
						$dados["mensagem"] = SUCESSO_TOPICO;
					}
					else
					{
						$dados["mensagem"] = ERRO_TOPICO;
					}
				}
				else {
					$dados["mensagem"] = NOME_ITEM_VAZIO;
				}
				
				exit(json_encode($dados));
			}
			
			private function carregarTopicos()
			{
				$str = "";
				$stmt = $this->prepare("SELECT id,nome FROM metodologia WHERE iddocumento = ? AND idreference = 0");
				
				if($stmt->execute(array($_SESSION["INTEGRANTE"]["iddocumento"])) && $this->numRow($stmt) > 0)
				{
					while($row = $this->fetch($stmt))
					{
						$str .= "<a href=\"?refer=".base64_encode($row["id"])."\"><h2>".utf8_decode($row["nome"])."</h2></a>";
					}
				}
				return $str;
			}
			
			private function salvarImagem($post,$tipo_nome,$campo,$id)
			{
				$dados = array(
					"error" => true,
					"mensagem" => ""
				);
				
				if($_FILES[$post]["size"] > 0)
				{
					$dir = "uploads/images/";
					
					$image_type = pathinfo($_FILES[$post]["name"],PATHINFO_EXTENSION);
					$new_name = $tipo_nome."_".$_SESSION["INTEGRANTE"]["iddocumento"]."_".$id.".".$image_type;
					
					$check = getimagesize($_FILES[$post]["tmp_name"]);
					
					$target_file = $dir.$new_name;
					
					if($check!==false)
					{
						if(preg_match("/jpg|jpeg|png/", $image_type))
						{
							if($check[0] <= 636 && $check[1] <= 636)
							{
								if(move_uploaded_file($_FILES[$post]["tmp_name"],$target_file))
								{
									$stmt = $this->prepare("UPDATE metodologia SET img_$campo = ? WHERE id = ?");
				
									$params = array(
										$new_name,
										$id
									);
								
									if($stmt->execute($params))
									{
										$dados["error"] = false;
										$dados["mensagem"] = "Alterações feitas com sucesso.";
									}
								}
							}
							else {
								$dados["mensagem"] = IMAGE_DIMENSION;
								return $dados;
							}
						}
						else {
							$dados["mensagem"] = IMAGE_FORMAT;
							return $dados;
						}
					}
					else {
						$dados["mensagem"] = DONT_IMAGE;
						return $dados;
					}
				}
				
				$stmt = $this->prepare("UPDATE metodologia SET nome_img_$campo = ?, fonte_img_$campo = ? WHERE id = ? AND iddocumento = ?");
				
				$params = array(
					utf8_encode($_POST["nome_img_$campo"]),
					utf8_encode($_POST["fonte_img_$campo"]),
					$id,
					$_SESSION["INTEGRANTE"]["iddocumento"]
				);
			
				if($stmt->execute($params) && $this->numRow($stmt) > 0)
				{
					$dados["error"] = false;
					$dados["mensagem"] = SUCESSO_ALTERACAO;
				}
				else {
					$dados["mensagem"] = NENHUMA_ALTERACAO;
				}
				return $dados;
			}
		}
	}
?>