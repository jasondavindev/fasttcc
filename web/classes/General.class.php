<?php
	$Page_Request = strtolower(basename($_SERVER['REQUEST_URI']));
	$File_Request = strtolower(basename(__FILE__));
	
	// Verificacao se o usuario esta tentando acessar o arquivo diretamente
	if($Page_Request == $File_Request) {
		exit("");
	}
	
	if(!class_exists("General"))
	{
		class General extends Mysql
		{
			public function __construct()
			{
				$this->connect();
				$this->refreshSession();
				
				global $template;
				
				$template->set("TITLE_SITE",TITLE_SITE);
				$template->set("TEAM_NAME",TEAM_NAME);
			}
			
			private function refreshSession()
			{
				if(!isset($_SESSION["INTEGRANTE"])) return;
				
				$stmt = $this->prepare("SELECT * FROM usuarios WHERE id = ?");
				
				if($stmt->execute(array($_SESSION["INTEGRANTE"]["id"])) && $this->numRow($stmt) > 0)
				{
					$row = $this->fetch($stmt);
					
					$_SESSION["INTEGRANTE"]["nome"] = $row["nome"];
					$_SESSION["INTEGRANTE"]["email"] = $row["email"];
					$_SESSION["INTEGRANTE"]["senha"] = $row["senha"];
					$_SESSION["INTEGRANTE"]["idequipe"] = $row["idequipe"];
					$_SESSION["INTEGRANTE"]["tipousuario"] = $row["tipoUsuario"];
					
					if($_SESSION["INTEGRANTE"]["idequipe"] != 1)
					{
						$stmt = $this->prepare("SELECT id FROM documentos WHERE idequipe = ?");
						
						if($stmt->execute(array($_SESSION["INTEGRANTE"]["idequipe"])) && $this->numRow($stmt) > 0)
						{
							$row = $this->fetch($stmt);
							
							$_SESSION["INTEGRANTE"]["iddocumento"] = $row["id"];
						}
						else
						{
							$stmt = $this->prepare("INSERT INTO documentos SET idequipe = ?");
							
							if($stmt->execute(array($_SESSION["INTEGRANTE"]["idequipe"])) && $this->numRow($stmt) > 0)
							{
								$this->refreshSession();
							}
						}
					}
				}
				return;
			}
			
			public function checkLogged()
			{
				if(isset($_SESSION["INTEGRANTE"]["id"],$_SESSION["INTEGRANTE"]["email"])) return true;
				else return false;
			}
			
			public function isMember()
			{
				if($_SESSION["INTEGRANTE"]["idequipe"] != 1) return true;
				else return false;
			}
		}
	}
?>