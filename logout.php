<?php
session_start();
session_destroy();
$_SESSION['logout'] = "ออกจากระบบสำเร็จ";
header("location:index1.php");

?>