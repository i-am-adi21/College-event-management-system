<?php
session_start();
unset($_SESSION["username"]);
header("Location: /COLLEGE_EVM/index.php");
?>