<?php
	function __autoload($classname)
	{
		$way = "classes/".$classname.".class.php";
		if(file_exists($way))
		{
			require_once $way;
		}
	}
?>