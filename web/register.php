<?php
require "settings.php";
require "autoload.php";
require "language.php";

SESSION_NAME(NAME_SESSION);
SESSION_START();
$template = new Template();
$general = new General();
if($general->checkLogged()) header("location: index.php");
$ajax = new Ajax();
$template->open("template/pages/register.tpl.php");
$template->show();
$ajax->close();
?>