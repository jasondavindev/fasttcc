<?php
	$Page_Request = strtolower(basename($_SERVER['REQUEST_URI']));
	$File_Request = strtolower(basename(__FILE__));
	
	// Verificacao se o usuario esta tentando acessar o arquivo diretamente
	if($Page_Request == $File_Request) {
		exit("");
	}
	
	if(!class_exists("Resumo"))
	{
		class Resumo extends Mysql
		{
			public function __construct()
			{
				$this->connect();
				$this->setTags();
				
				if(isset($_GET["act"]) && $_GET["act"] === "go")
				{
					$this->inserirDados();
				}
			}
			
			private function setTags()
			{
				global $template, $DICAS;
				
				$port = array("","","","");
				$ing = array("","","","");
				
				$stmt = $this->prepare("SELECT resumo_port,palavra_chave1,palavra_chave2,palavra_chave3,resumo_ing,keyword1,keyword2,keyword3 FROM documentos WHERE id = ?");
				$stmt->execute(array($_SESSION["INTEGRANTE"]["iddocumento"]));
				
				if($this->numRow($stmt) > 0)
				{
					$row = $this->fetch($stmt);
					
					$port[0] = html_entity_decode($row["resumo_port"]);
					$port[1] = html_entity_decode($row["palavra_chave1"]);
					$port[2] = html_entity_decode($row["palavra_chave2"]);
					$port[3] = html_entity_decode($row["palavra_chave3"]);
					
					$ing[0] = html_entity_decode($row["resumo_ing"]);
					$ing[1] = html_entity_decode($row["keyword1"]);
					$ing[2] = html_entity_decode($row["keyword2"]);
					$ing[3] = html_entity_decode($row["keyword3"]);
				}
				
				$template->set("DICA",$DICAS["resumo"]);

				$template->set("RESUMO_PORT",$port[0]);
				$template->set("P_CHAVE1",$port[1]);
				$template->set("P_CHAVE2",$port[2]);
				$template->set("P_CHAVE3",$port[3]);
				
				$template->set("RESUMO_ING",$ing[0]);
				$template->set("K_WORD1",$ing[1]);
				$template->set("K_WORD2",$ing[2]);
				$template->set("K_WORD3",$ing[3]);
			}
			
			private function inserirDados()
			{
				$paramsStr = "SET ";
				$paramsVal = array();
				
				if(isset($_POST["resumo_port"]))
				{
					$paramsStr .= "resumo_port = ?,";
					$paramsVal[] = htmlentities($_POST["resumo_port"]);
					
					foreach($_POST["keyword"] AS $key => $value)
					{
						$paramsStr .= "palavra_chave".($key+1)." = ?,";
						$paramsVal[] = htmlentities($value);
					}
				}
				if(isset($_POST["resumo_ing"]))
				{
					$paramsStr .= "resumo_ing = ?,";
					$paramsVal[] = htmlentities($_POST["resumo_ing"]);
					
					foreach($_POST["keyword"] AS $key => $value)
					{
						$paramsStr .= "keyword".($key+1)." = ?,";
						$paramsVal[] = htmlentities($value);
					}
				}
				
				$paramsVal[] = $_SESSION["INTEGRANTE"]["iddocumento"];
				
				$stmt = $this->prepare("UPDATE documentos ".substr($paramsStr,0,strlen($paramsStr) - 1)." WHERE id = ?");

				if($stmt->execute($paramsVal) && $this->numRow($stmt) > 0)
				{
					exit(json_encode(array("status" => html_entity_decode(SUCESSO_RESUMO))));
				}
				else
				{
					exit(json_encode(array("status" => html_entity_decode(NENHUMA_ALTERACAO))));
				}
			}
		}
	}
?>