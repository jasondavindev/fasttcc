<?php
	$Page_Request = strtolower(basename($_SERVER['REQUEST_URI']));
	$File_Request = strtolower(basename(__FILE__));
	
	// Verificacao se o usuario esta tentando acessar o arquivo diretamente
	if($Page_Request == $File_Request) {
		exit("");
	}
	
	if(!class_exists("Documento"))
	{
		class Documento extends Mysql
		{
			public function __construct()
			{
				$this->connect();
				
				$this->configTemplate();
				
				if(isset($_GET["act"]) && $_GET["act"] == "delete")
				{
					$this->apagarDocumento();
				}
			}
			
			private function apagarDocumento()
			{
				$doc = $_SESSION["INTEGRANTE"]["iddocumento"];
				$equipe__ = $_SESSION["INTEGRANTE"]["idequipe"];
				
				$stmt = $this->prepare("DELETE FROM itens_metodologia WHERE iddocumento = ?");
				$stmt->execute(array($doc));
				
				$stmt = $this->prepare("DELETE FROM referencial_teorico WHERE iddocumento = ?");
				$stmt->execute(array($doc));
				
				$stmt = $this->prepare("DELETE FROM documentos WHERE id = ? AND idequipe = ?");
				
				if($stmt->execute(array($doc,$equipe__)) && $this->numRow($stmt) > 0)
				{
					$dados = array("status" => "<script type=\"text/javascript\">setTimeout(function() {location.reload();},1500);</script>".html_entity_decode(DOCUMENTO_EXCLUIDO));
				}
				else
				{
					$dados = array("status" => html_entity_decode(DOCUMENTO_ERRO_EXCLUIR));
				}
				exit(json_encode($dados));
			}
			
			private function configTemplate()
			{
				$equipe__ = $_SESSION["INTEGRANTE"]["idequipe"];
				
				$titulo__ = "";
				
				$stmt = $this->prepare("SELECT id,titulo FROM documentos WHERE idequipe = ?");
				
				if($stmt->execute(array($equipe__)) && $this->numRow($stmt) > 0)
				{
					$row = $this->fetch($stmt);
					
					$id_doc = $row["id"];
					$titulo__ = !empty($row["titulo"]) ? "Título do documento: ".html_entity_decode($row["titulo"]) : "Título do documento: Indefinido";
				}
				
				global $template;
				
				$template->set("TITULO_DOCUMENTO",$titulo__);
			}
		}
	}
?>