<?php
session_start();
unset($_SESSION["userid"]);
header("Location: /COLLEGE_EVM/index.php");
?>