<?php
require "settings.php";
require "autoload.php";
require "language.php";

SESSION_NAME(NAME_SESSION);
SESSION_START();

$template = new Template();
$general = new General();

if(!$general->checkLogged())
{
	header("location: login.php");
}
date_default_timezone_set("America/Sao_Paulo");

$painel = new Painel();

if(isset($_GET["act"]) && $_GET["act"] == "informacoes")
{
	$painel->templateInformacoes();
}
else $painel->configurarTemplate();

$template->show();

$painel->close();
?>