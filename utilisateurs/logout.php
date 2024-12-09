<?php
session_start();
session_destroy();
header("Location: vue.login.php");
exit();
?>