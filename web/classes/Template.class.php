<?php
	$Page_Request = strtolower(basename($_SERVER['REQUEST_URI']));
	$File_Request = strtolower(basename(__FILE__));
	
	// Verificacao se o usuario esta tentando acessar o arquivo diretamente
	if($Page_Request == $File_Request) {
		exit("");
	}
	
	if(!class_exists("Template"))
	{
		class Template
		{
			private $file;
			private $content_file;
			private $includeContent_file;
			private $includeFile;
			private $tags = array();
			private $tags_count = 0; 
			
			public function set($tag,$value) 
			{
				$this->tags[$this->tags_count++] = array("Name" => $tag, "Value" => $value);
			}
			
			public function open($file)
			{
				$file = urlencode($file);
				$file = str_replace(array("%2F","%5B","%5D"), array("/","[","]"), $file);
				$this->file = @fopen($file, "r");
				if(!$this->file) exit( printf("Arquivo %s nao encontrado", $file) );
				$this->content_file = @fread($this->file, filesize($file));
				if(!$this->content_file) exit(ERROR_READING_FILE." ".$file);
			}
			
			public function includeOpen($file) 
			{
				$this->includeFile = @fopen($file, "r");
				if($this->includeFile == false) exit( printf("Arquivo %s nao encontrado", $file) );
				$this->includeContent_file = @fread($this->includeFile, filesize($file));
				if($this->includeContent_file == false) exit(ERROR_READING_FILE." ".$file);		
			}
			
			public function includes()
			{
				$lastPos = 0;
				$stop = false;
				while($stop == false)
				{
					if(($beginCurrentPos = stripos($this->content_file, "{#INCLUDE:", $lastPos)) !== false)
					{
						$lastPos = ++$beginCurrentPos;
						
						if(($endCurrentPos = stripos($this->content_file, "}", $lastPos)) !== false)
						{
							$lastPos = ++$endCurrentPos;
							
							$fileNameInclude = substr($this->content_file, $beginCurrentPos+9, (($endCurrentPos-1) - ($beginCurrentPos+9)));
							
							$this->includeOpen("template/".$fileNameInclude.".tpl.php");
							$this->content_file = str_replace("{#INCLUDE:".$fileNameInclude."}", $this->includeContent_file, $this->content_file);
						} 
						else
							$stop = true;     
					} 
					else
						$stop = true;
				}
			}
			
			public function show() 
			{
				$this->includes();
				for($Count_Sets = 0; $Count_Sets < count($this->tags); $Count_Sets++) 
				{
					$this->content_file = str_replace("{#".$this->tags[$Count_Sets]['Name']."}", $this->tags[$Count_Sets]['Value'], $this->content_file);
				}
				eval("?>".$this->content_file."<?");
			
			}
		}
	}
?>