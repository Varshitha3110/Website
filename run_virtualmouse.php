<?php
// Set the correct path to your Python file
$command = escapeshellcmd("python3 virtualmouse.py");
$output = shell_exec($command);

// You can optionally return $output if needed
echo "Virtual Mouse is sttopped";
?>
