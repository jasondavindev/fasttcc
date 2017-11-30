<?php
require "settings.php";
require "autoload.php";
require "language.php";

SESSION_NAME(NAME_SESSION);
SESSION_START();

$template = new Template();
$general = new General();

if(!$general->checkLogged()) header("Location: login.php");

$conclusao = new Conclusao();

if(!$general->isMember())
{
	header("Location: painel.php");
}
$conclusao->close();
$template->show();