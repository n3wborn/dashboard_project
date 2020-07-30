<?php

/*start or resume session*/
session_start();

/*"close" session*/
$_SESSION=[];
header("Location: ../login.php");

?>