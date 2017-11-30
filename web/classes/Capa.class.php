<?php
	$Page_Request = strtolower(basename($_SERVER['REQUEST_URI']));
	$File_Request = strtolower(basename(__FILE__));
	
	// Verificacao se o usuario esta tentando acessar o arquivo diretamente
	if($Page_Request == $File_Request) {
		exit("");
	}
	
	if(!class_exists("Capa"))
	{
		class Capa extends Mysql
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
				
				$stmt = $this->prepare("SELECT * FROM documentos WHERE id = ?");
				$stmt->execute(array($_SESSION["INTEGRANTE"]["iddocumento"]));
				
				$titulo="";
				$subtitulo="";
				$cidade="";
				$instituicao="";
				$curso="";
				$ano="";
				
				if($this->numRow($stmt) > 0)
				{
					$row = $this->fetch($stmt);
					
					$titulo = html_entity_decode($row["titulo"]);
					$subtitulo = html_entity_decode($row["subtitulo"]);
					$ano = $row["ano"];
					$cidade = html_entity_decode($row["cidade"]);
					$instituicao = html_entity_decode($row["instituicao"]);
					$curso = html_entity_decode($row["curso"]);
				}
				
				$template->set("DICA",$DICAS["capa"]);
				$template->set("DICA_TITULO",$DICAS["titulo"]);
				$template->set("TITULO_DOC", $titulo);
				$template->set("SUBTITULO_DOC", $subtitulo);
				$template->set("ANO_DOC", $ano);
				$template->set("CIDADE_DOC", $cidade);
				$template->set("INSTITUICAO_DOC", $instituicao);
				$template->set("CURSO_DOC", $curso);
			}
			
			private function inserirDados()
			{	
				if(!is_numeric($_POST["ano"]) || ($_POST["ano"] < 1700 || $_POST["ano"] > 9999))
				{
					exit(json_encode(array("status" => html_entity_decode(ANO_INVALIDO))));
				}
				
				$dados = array(
					"titulo" => htmlentities($_POST["titulo"]),
					"sub-titulo" => htmlentities($_POST["sub-titulo"]),
					"instituicao" => htmlentities($_POST["instituicao"]),
					"curso" => htmlentities($_POST["curso"]),
					"cidade" => htmlentities($_POST["cidade"]),
					"ano" => $_POST["ano"]
				);
				
				$stmt = $this->prepare("UPDATE documentos SET titulo = ?, subtitulo = ?, curso = ?, instituicao = ?, ano = ?, cidade = ? WHERE id = ?");
				
				if($stmt->execute(array(
					$dados["titulo"],
					$dados["sub-titulo"],
					$dados["curso"],
					$dados["instituicao"],
					$dados["ano"],
					$dados["cidade"],
					$_SESSION["INTEGRANTE"]["iddocumento"]
				)) && $this->numRow($stmt) > 0)
				{
					exit(json_encode(array("status" => html_entity_decode(SUCESSO_CAPA))));
				}
				else
				{
					exit(json_encode(array("status" => html_entity_decode(NENHUMA_ALTERACAO))));
				}
			}
		}
	}
?>