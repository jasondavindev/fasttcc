<?php
require "settings.php";
require "autoload.php";
require "language.php";

SESSION_NAME(NAME_SESSION);
SESSION_START();

$template = new Template();
$general = new General();
$referencial = new Referencial();

if(!$general->checkLogged()) header("Location: login.php");
if($general->isMember())
{
	$template->open("template/pages/[DOC]referencial.tpl.php");
}
else
{
	header("Location: painel.php");
}
$referencial->close();
$template->show();