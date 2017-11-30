<?php
require "settings.php";
require "autoload.php";
require "language.php";

SESSION_NAME(NAME_SESSION);
SESSION_START();
$template = new Template();
$general = new General();
$profile = new Profile();
if(!$general->checkLogged()) header("location: login.php");
$ajax = new Ajax();
$template->open("template/pages/[USER]edit_profile.tpl.php");
$template->show();
$ajax->close();
?>