<?php
require "settings.php";
require "autoload.php";
require "language.php";

SESSION_NAME(NAME_SESSION);
SESSION_START();

$template = new Template();
$general = new General();

if(!$general->checkLogged()) header("Location: login.php");
$capa = new Capa();

if(!$general->isMember())
{
	header("Location: painel.php");
}
else
{
	$template->open("template/pages/[DOC]capa.tpl.php");
}

$template->show();
$capa->close();