<?php
session_start();
session_unset();
session_destroy();
header('Location: ../php/Portal/Guest/login.php');
exit();
?>
