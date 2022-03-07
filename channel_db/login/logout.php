<?php
if(session_status()!=PHP_SESSION_ACTIVE) session_start();
$_SESSION = array();
session_destroy();
header("location: ..");
exit();
?>
