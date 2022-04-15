<?php
require_once('./initialize.php');
include("session_handling.php");



session_destroy();
session_regenerate_id(TRUE);
session_start();
redirect("login.php", "Logout successful.");
?>
