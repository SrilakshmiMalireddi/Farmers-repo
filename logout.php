<?php

session_start();
unset($_SESSION['Login_user']);
session_destroy();
header("Location: Signintest.php");

?>
