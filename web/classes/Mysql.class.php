<?php
	$Page_Request = strtolower(basename($_SERVER['REQUEST_URI']));
	$File_Request = strtolower(basename(__FILE__));
	
	// Verificacao se o usuario esta tentando acessar o arquivo diretamente
	if($Page_Request == $File_Request) {
		exit("");
	}
	
	if(!class_exists("Mysql"))
	{
		class Mysql
		{
			private $con = NULL;
			
			protected function connect()
			{
				try {
					$this->con = new PDO("mysql:host=".HOST.";dbname=".DATABASE, USER, PASSWORD);
				}
				catch(PDOException $e)
				{
					die("<span style='border: dashed 1px #c00; color: #c00; background: #ffebeb; padding: 6px;'>".MYSQL_ERROR_CONNECT."</span>");
				}
				return $this->con;
			}
			
			protected function execute($sql)
			{
				return $sql->execute();
			}
			
			protected function prepare($stmt)
			{
				return $this->con->prepare($stmt);
			}
			
			protected function fetch($stmt)
			{
				return $stmt->fetch(PDO::FETCH_ASSOC);
			}
			
			protected function numRow($stmt)
			{
				return $stmt->rowCount();
			}
			
			public function close() {
				try {
					$this->con = NULL;
				}
				catch(PDOException $e) {
					exit("<span style='border: dashed 1px #c00; color: #c00; background: #ffebeb; padding: 6px;'>".MYSQL_ERROR_CLOSE_CONNECT."</span>");
				}
			}
		}
	}
?>