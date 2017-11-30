<?php
	$Page_Request = strtolower(basename($_SERVER['REQUEST_URI']));
	$File_Request = strtolower(basename(__FILE__));
	
	// Verificacao se o usuario esta tentando acessar o arquivo diretamente
	if($Page_Request == $File_Request) {
		exit("");
	}
	
	if(!class_exists("Referencial"))
	{
		class Referencial extends Mysql
		{
			private $id;
			
			public function __construct()
			{
				$this->connect();
				$this->setTags();
				
				if(isset($_GET["act"]))
				{
					switch($_GET["act"])
					{
						case "go":
							$this->inserirDados();
							break;
						case "remove":
							$this->removerReferencial();
							break;
					}
				}
			}
			
			private function setTags()
			{
				global $template, $DICAS;
				
				$cont_referenciais = "";
				
				if(isset($_GET["id"]))
				{
					$valor_button = $_GET["id"];
				}
				else
				{
					$valor_button = "";
				}
				
				$stmt = $this->prepare("SELECT id,titulo FROM referencial_teorico WHERE iddocumento = ?");
				$stmt->execute(array($_SESSION["INTEGRANTE"]["iddocumento"]));
				
				if($this->numRow($stmt) > 0)
				{
					while($row = $this->fetch($stmt))
					{
						
						$cont_referenciais .= "<div class=\"row_content\">
						<span class=\"title\">".$row["titulo"]."</span>
						<div class=\"buttons\">
						<button onclick=\"window.location = 'referencial.php?id=".base64_encode($row["id"])."'\" class=\"material-icons\">create</button>
						<button class=\"material-icons remove\" id=\"".base64_encode($row["id"])."\">delete</button>
						</div>
						</div>";
					}
				}
				else
				{
					$cont_referenciais = NENENHUM_REFERENCIAL;
				}
				
				$dados = array(
					"titulo" => "",
					"cit-ori" => "",
					"cit-ind" => "",
					"ref-simp" => "",
					"ref-comp" => "",
					"id-referencia" => $valor_button
				);
				
				$str = "<input type=\"radio\" id=\"citacao-direta\" name=\"tipoCitacao\" value=\"0\" class=\"radio\" check_dir /><input type=\"radio\" id=\"citacao-indireta\" name=\"tipoCitacao\" value=\"1\" class=\"radio\" check_ind />";
				
				if(isset($_GET["id"]) && $_GET["id"]!="")
				{
					$id = base64_decode($_GET["id"]);
					
					$stmt = $this->prepare("SELECT * FROM referencial_teorico WHERE id = ?");
					$stmt->execute(array($id));
					
					if($this->numRow($stmt) > 0)
					{
						$row = $this->fetch($stmt);
						
						$this->id = $row["id"];
						$dados["titulo"] = $row["titulo"];
						$dados["cit-ori"] = $row["citacaoOriginal"];
						$dados["cit-ind"] = $row["citacaoIndireta"];
						$dados["ref-simp"] = $row["refCitacao"];
						$dados["ref-comp"] = $row["refCompleta"];
						
						if($row["tipoCitacao"] == 0)
						{
							$str = str_replace(array("check_dir","check_ind"),array("checked",""),$str);
						}
						else if($row["tipoCitacao"] == 1)
						{
							$str = str_replace(array("check_ind","check_dir"),array("checked",""),$str);
						}
					}
				}
				else
				{
					$str = str_replace(array("check_dir","check_ind"),array("checked",""),$str);
				}
				
				$template->set("DICA",$DICAS["referencial_teorico"]);
				$template->set("DICA_CIT_DIRETA",$DICAS["citacao_direta"]);
				$template->set("DICA_CIT_INDIRETA",$DICAS["citacao_indireta"]);
				$template->set("REFER_ID",$valor_button);
				$template->set("TITULO_REF",$dados["titulo"]);
				$template->set("CIT_ORI_REF",$dados["cit-ori"]);
				$template->set("CIT_IND_REF",$dados["cit-ind"]);
				$template->set("REF_SIMP",$dados["ref-simp"]);
				$template->set("REF_COMP",$dados["ref-comp"]);
				$template->set("CONTENT_REFERENCIAIS",$cont_referenciais);
				$template->set("DIV_INPUTS",$str);
			}
			
			private function removerReferencial()
			{
				if(isset($_GET["id"]))
				{
					$id = base64_decode($_GET["id"]);
					
					$stmt = $this->prepare("DELETE FROM referencial_teorico WHERE id = ? AND iddocumento = ?");
					if($stmt->execute(array($id, $_SESSION["INTEGRANTE"]["iddocumento"])) && $this->numRow($stmt) > 0)
					{
						exit("<script type=\"text/javascript\">window.location='referencial.php'</script>");
					}
					else
					{
						exit("<script type=\"text/javascript\">alert('".ERRO_REMOVE."');window.location = 'referencial.php'</script>");
					}
				}
			}
			
			private function inserirDados()
			{
				$msg = array();

				if(empty($_POST["titulo_ref"]))
				{
					exit(json_encode(array("status" => FILL_FIELD)));
				}
				
				$dados = array(
					"titulo" => htmlentities($_POST["titulo_ref"]),
					"cit-ori" => htmlentities($_POST["cit_ori"]),
					"cit-ind" => htmlentities($_POST["cit_ind"]),
					"ref-simp" => htmlentities($_POST["ref_simp"]),
					"ref-comp" => htmlentities($_POST["ref_comp"]),
					"tipo-cit" => $_POST["tipoCitacao"]
				);
				
				if(isset($_POST["refer"]) && !empty($_POST["refer"]))
				{
					$stmt = $this->prepare("UPDATE referencial_teorico SET titulo = ?, refCitacao = ?, refCompleta = ?, citacaoOriginal = ?, citacaoIndireta = ?, tipoCitacao = ? WHERE id = ? AND iddocumento = ?");
					$params = array(
						$dados["titulo"],
						$dados["ref-simp"],
						$dados["ref-comp"],
						$dados["cit-ori"],
						$dados["cit-ind"],
						$dados["tipo-cit"],
						base64_decode($_POST["refer"]),
						$_SESSION["INTEGRANTE"]["iddocumento"]
					);
				}
				else
				{
					$stmt = $this->prepare("INSERT INTO referencial_teorico SET titulo = ?, refCitacao = ?, refCompleta = ?, citacaoOriginal = ?, citacaoIndireta = ?, tipoCitacao = ?, iddocumento = ?");
					$params = array(
						$dados["titulo"],
						$dados["ref-simp"],
						$dados["ref-comp"],
						$dados["cit-ori"],
						$dados["cit-ind"],
						$dados["tipo-cit"],
						$_SESSION["INTEGRANTE"]["iddocumento"]
					);
				}
				
				if($stmt->execute($params) && $this->numRow($stmt) > 0)
				{
					$msg["status"] = "<script type=\"text/javascript\">setTimeout(function() {window.location = 'referencial.php'}, 1500);</script>".SUCESSO_REFERENCIAL_TEORICO;
				}
				else
				{
					$msg["status"] = html_entity_decode(NENHUMA_ALTERACAO);
				}
				exit(json_encode($msg));
			}
		}
	}
?>