<?php
// Run the Python script
$output = shell_exec("python gesture.py 2>&1");

// Send response
echo "Gesture Detection program stopped";
?>
