<?php
session_start();
session_unset();
session_destroy();
header('Location: ../php/device_login.php');
exit();
?>
