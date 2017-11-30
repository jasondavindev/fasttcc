<?php
	$Page_Request = strtolower(basename($_SERVER['REQUEST_URI']));
	$File_Request = strtolower(basename(__FILE__));
	
	// Verificacao se o usuario esta tentando acessar o arquivo diretamente
	if($Page_Request == $File_Request) {
		exit("");
	}
	
	if(!class_exists("Conclusao"))
	{
		class Conclusao extends Mysql
		{	
			public function __construct()
			{
				$this->connect();
				$this->configTemplate();
				
				if(isset($_GET["act"]))
				{
					switch($_GET["act"])
					{
						case "go":
							$this->salvarConclusao();
							break;
						
						case "load_conc":
							$this->carregarConclusao();
							break;
					}
				}
			}
			
			private function configTemplate()
			{
				global $template, $DICAS;
				
				if(isset($_GET["refer"]))
				{
					$id = base64_decode($_GET["refer"]);
					
					$stmt = $this->prepare("SELECT objetivo_esp$id,conc$id FROM documentos WHERE id = ?");
					
					$arryData = array("titulo" => "", "conteudo" => "");
					
					if($stmt->execute(array($_SESSION["INTEGRANTE"]["iddocumento"])) && $this->numRow($stmt) > 0)
					{
						$row = $this->fetch($stmt);
						
						$arryData["titulo"] = $row["objetivo_esp$id"];
						$arryData["conteudo"] = $row["conc$id"];
					}
					else
					{
						header("location: conclusao.php");
					}
					
					$template->set("ID_OBJ",$_GET["refer"]);
					$template->set("TITULO_OBJETIVO",$arryData["titulo"]);
					$template->set("CONTEUDO",$arryData["conteudo"]);
					$template->open("template/pages/[DOC]conclusao_refer.tpl.php");
				}
				else
				{
					$template->set("OBJETIVOS",$this->carregarObjetivos());
					$template->open("template/pages/[DOC]conclusao.tpl.php");
				}

				$template->set("DICA", $DICAS["conclusao"]);
			}
			
			private function salvarConclusao()
			{
				$dados = array();
				
				$id_obj = base64_decode($_POST["obj"]);
				$texto = htmlentities($_POST["conclusao"]);
				
				$stmt = $this->prepare("UPDATE documentos SET conc".$id_obj." = ? WHERE id = ?");
				
				if($stmt->execute(array($texto,$_SESSION["INTEGRANTE"]["iddocumento"])) && $this->numRow($stmt) > 0)
				{
					$dados["status"] = html_entity_decode(SUCESSO_CONCLUSAO);
				}
				else
				{
					$dados["status"] = html_entity_decode(NENHUMA_ALTERACAO);
				}
				
				exit(json_encode($dados));
			}
			
			private function carregarObjetivos()
			{
				$str = "";
				$stmt = $this->prepare("SELECT objetivo_esp1,objetivo_esp2,objetivo_esp3,objetivo_esp4,objetivo_esp5,objetivo_esp6,objetivo_esp7,objetivo_esp8,objetivo_esp9,objetivo_esp10 FROM documentos WHERE id = ?");
				
				if($stmt->execute(array($_SESSION["INTEGRANTE"]["iddocumento"])) && $this->numRow($stmt) > 0)
				{
					if($row = $this->fetch($stmt))
					{
						for($i = 1; $i <= 10; $i++)
						{
							if($row["objetivo_esp$i"] != "" && $row["objetivo_esp$i"] != null)
							{
								$str .= "<a href=\"?refer=".base64_encode($i)."\"><h2>".html_entity_decode($row["objetivo_esp$i"])."</h2></a>";
							}
						}
					}
				}
				return $str;
			}
			
			private function carregarConclusao()
			{
				$dados = array("content" => "");
				
				$id_obj = $_POST["obj"];
				
				$stmt = $this->prepare("SELECT conc".$id_obj." FROM documentos WHERE id = ?");
				
				if($stmt->execute(array($_SESSION["INTEGRANTE"]["iddocumento"])) && $this->numRow($stmt) > 0)
				{
					$row = $this->fetch($stmt);
					$dados["content"] = html_entity_decode($row["conc".$id_obj]);
				}
				
				exit(json_encode($dados));
			}
		}
	}
?>