<?php
	$Page_Request = strtolower(basename($_SERVER['REQUEST_URI']));
	$File_Request = strtolower(basename(__FILE__));
	
	// Verificacao se o usuario esta tentando acessar o arquivo diretamente
	if($Page_Request == $File_Request) {
		exit("");
	}
	
	if(!class_exists("Introducao"))
	{
		class Introducao extends Mysql
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
				
				$inputs = "";
				$dados = array(
					"tema" => "",
					"historico" => "",
					"evolucao" => "",
					"problema" => "",
					"solucao" => "",
					"obj_geral" => ""
				);
				
				$stmt = $this->prepare("SELECT * FROM documentos WHERE id = ?");
				if($stmt->execute(array($_SESSION["INTEGRANTE"]["iddocumento"])) && $this->numRow($stmt) > 0)
				{
					$row = $this->fetch($stmt);
					
					$dados["tema"] = html_entity_decode($row["introducao_tema"]);
					$dados["historico"] = html_entity_decode($row["introducao_historico"]);
					$dados["evolucao"] = html_entity_decode($row["introducao_evolucao"]);
					$dados["problema"] = html_entity_decode($row["introducao_problema"]);
					$dados["solucao"] = html_entity_decode($row["introducao_solucao"]);
					$dados["obj_geral"] = html_entity_decode($row["objetivo_geral"]);
					
					// verificar o ultimo campo com texto
					for($i = 10; $i >= 1; $i--)
					{
						if($row["objetivo_esp$i"]!="")
							break;
					}
					
					for($j = 1; $j <= $i; $j++)
					{
						$inputs .= "<input type=\"text\" name=\"objetivo[$j]\" class=\"input_text\" value=\"".html_entity_decode($row["objetivo_esp$j"])."\" />";
					}
				}
				$template->set("DICA",$DICAS["introducao"]);
				$template->set("DICA_OBJ_GERAL",$DICAS["objetivo_geral"]);
				$template->set("TEMA",$dados["tema"]);
				$template->set("HISTORICO",$dados["historico"]);
				$template->set("EVOLUCAO",$dados["evolucao"]);
				$template->set("PROBLEMA",$dados["problema"]);
				$template->set("SOLUCAO",$dados["solucao"]);
				$template->set("OBJ_GERAL",$dados["obj_geral"]);
				$template->set("INPUT_OBJS",$inputs);
			}
			
			private function inserirDados()
			{
				$objetivos = $_POST["objetivo"];
				$insert = "";
				
				$params = array();
				
				$insert .= "introducao_tema = ?, introducao_historico = ?, introducao_evolucao = ?, introducao_problema = ?, introducao_solucao = ?, objetivo_geral = ?,";
				
				$params[] = htmlentities($_POST["tema"]);
				$params[] = htmlentities($_POST["historico"]);
				$params[] = htmlentities($_POST["evolucao"]);
				$params[] = htmlentities($_POST["problema"]);
				$params[] = htmlentities($_POST["solucao"]);
				$params[] = htmlentities($_POST["obj_geral"]);
				
				if(is_array($objetivos))
				{
					foreach($objetivos as $key => $value)
					{
						$params[] = htmlentities($value);
						$insert .= "objetivo_esp$key = ?,";
					}
				}
				
				$insert = substr($insert, 0, strlen($insert) - 1); // tirar a ultima virgula
				
				$params[] = $_SESSION["INTEGRANTE"]["iddocumento"];
				
				$stmt = $this->prepare("UPDATE documentos SET $insert WHERE id = ?");
				
				if($stmt->execute($params) && $this->numRow($stmt) > 0)
				{
					exit(json_encode(array("status" => html_entity_decode(SUCESSO_INTRODUCAO))));
				}
				else
				{
					exit(json_encode(array("status" => html_entity_decode(NENHUMA_ALTERACAO))));
				}
			}
		}
	}
?>