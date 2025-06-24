<?php
session_start();
session_destroy();
header("Location: signin_signup.html");
exit();
?>
