<?php
require "settings.php";
require "autoload.php";
require "language.php";

SESSION_NAME(NAME_SESSION);
SESSION_START();

$template = new Template();
$general = new General();

if(!$general->checkLogged()) header("Location: login.php");
$introducao = new Introducao();

if(!$general->isMember())
{
	header("Location: painel.php");
}
else
{
	$template->open("template/pages/[DOC]introducao.tpl.php");
}

$template->show();
$introducao->close();