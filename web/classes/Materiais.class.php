<?php
	$Page_Request = strtolower(basename($_SERVER['REQUEST_URI']));
	$File_Request = strtolower(basename(__FILE__));
	
	// Verificacao se o usuario esta tentando acessar o arquivo diretamente
	if($Page_Request == $File_Request) {
		exit("");
	}
	
	if(!class_exists("Materiais"))
	{
		class Materiais extends Mysql
		{
			public function __construct()
			{
				$this->connect();
				$this->setTags();
				
				if(isset($_GET["act"]))
				{
					switch($_GET["act"])
					{
						case "save":
							$this->salvarMateriais();
							break;
						
						case "load":
							$this->carregarMateriais();
							break;
							
						case "remove":
							$this->removerItem();
							break;
					}
				}
			}
			
			private function setTags()
			{
				global $template, $DICAS;

				$template->set("DICA",$DICAS["materiais"]);
			}

			private function removerItem()
			{
				$dados = array();
				
				if(!empty($_POST["id_item"]))
				{
					$id = base64_decode($_POST["id_item"]);
					
					$stmt = $this->prepare("UPDATE documentos SET material$id = ? WHERE id = ?");
					
					if($stmt->execute(array("",$_SESSION["INTEGRANTE"]["iddocumento"])) && $this->numRow($stmt) > 0)
					{
						$dados["status"] = html_entity_decode(SUCESSO_REMOVER);
					}
					else
					{
						$dados["status"] = html_entity_decode(ERRO_REMOVER);
					}
				}
				exit(json_encode($dados));
			}
			
			private function carregarMateriais()
			{
				$dados = array();
				
				$stmt = $this->prepare("SELECT material1,material2,material3,material4,material5,material6,material7,material8,material9,material10 FROM documentos WHERE id = ?");
				
				if($stmt->execute(array($_SESSION["INTEGRANTE"]["iddocumento"])) && $this->numRow($stmt) > 0)
				{
					$row = $this->fetch($stmt);
					
					for($i = 1; $i <= 10; $i++)
					{
						if(!empty($row["material$i"]) && $row["material$i"] !== "" && $row["material$i"] !== null)
						{
							$dados[$i] = html_entity_decode($row["material$i"]);
						}
					}
				}
				
				exit(json_encode($dados));
			}
			
			private function salvarMateriais()
			{
				$dados = array();
				$campos_vazios = array();
				
				if(isset($_POST["item_mat"]))
				{
					$stmt = $this->prepare("SELECT material1,material2,material3,material4,material5,material6,material7,material8,material9,material10 FROM documentos WHERE id = ?");
					
					if($stmt->execute(array($_SESSION["INTEGRANTE"]["iddocumento"])) && $this->numRow($stmt) > 0)
					{
						$row = $this->fetch($stmt);
						$inicio_camp = 0;
						$vazios = 0;
						
						for($i = 0; $i < count($_POST["item_mat"]); $i++)
						{
							if(!empty($_POST["item_mat"][$i]))
							{
								for($j = $inicio_camp+1; $j <= 10; $j++)
								{
									if(empty($row["material$j"]))
									{
										$campos_vazios[$j] = $_POST["item_mat"][$i];
										$inicio_camp = $j+1;
										break;
									}
								}
							}
							else $vazios++;
						}
						
						if($vazios == count($_POST["item_mat"])) exit(json_encode(array("status" => html_entity_decode(NENHUMA_ALTERACAO))));
						
						if($inicio_camp === 0)
						{
							exit(json_encode(array("status" => html_entity_decode(MAX_MATERIAIS))));
						}
						
						$paramsStr = "SET ";
						$paramsVal = array();
						
						foreach($campos_vazios AS $key => $value)
						{
							$paramsStr .= "material".$key." = ?,";
							$paramsVal[] = htmlentities($value);
						}
						$paramsVal[] = $_SESSION["INTEGRANTE"]["iddocumento"];
						
						
						$stmt = $this->prepare("UPDATE documentos ".substr($paramsStr, 0, strlen($paramsStr) - 1)." WHERE id = ?");
						
						if($stmt->execute($paramsVal) && $this->numRow($stmt) > 0)
						{
							$dados["status"] = html_entity_decode(SUCESSO_MATERIAIS);
						}
						else
						{
							$dados["status"] = html_entity_decode(NENHUMA_ALTERACAO);
						}
					}
					else
					{
						$dados["status"] = "ERRO";
					}
				}
				exit(json_encode($dados));
			}
		}
	}
?>