<?php
// Run the Python script
$output = shell_exec("python keyboard.py 2>&1");

// Send response
echo "Virtual Keyboard program stopped";
?>
