<?php
require "settings.php";
require "autoload.php";

SESSION_NAME(NAME_SESSION);
SESSION_START();

$template = new Template();
$general = new General();
$template->open("template/pages/index.tpl.php");
$template->show();
?>