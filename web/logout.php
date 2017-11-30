<?php
require "settings.php";
SESSION_NAME(NAME_SESSION);
SESSION_START();
SESSION_UNSET();
header("location: index.php");
?>