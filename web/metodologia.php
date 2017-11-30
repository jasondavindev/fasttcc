<?php
require "settings.php";
require "autoload.php";
require "language.php";

SESSION_NAME(NAME_SESSION);
SESSION_START();

$template = new Template();
$general = new General();

if(!$general->checkLogged()) header("Location: login.php");

$metodologia = new Metodologia();

if(!$general->isMember())
{
	header("Location: painel.php");
}
$metodologia->close();
$template->show();