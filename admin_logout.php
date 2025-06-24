<?php
session_start();
session_unset();
session_destroy();
header("Location: signin_signup.html");  // or your login page
exit();
?>
