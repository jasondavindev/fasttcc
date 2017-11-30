<?php
require "settings.php";
require "autoload.php";
require "language.php";

SESSION_NAME(NAME_SESSION);
SESSION_START();

$template = new Template();
$general = new General();

if(!$general->checkLogged()) header("Location: login.php");
$resumo = new Resumo();

if(!$general->isMember())
{
	header("Location: painel.php");
}
else
{
	$template->open("template/pages/[DOC]resumo.tpl.php");
}

$template->show();
$resumo->close();