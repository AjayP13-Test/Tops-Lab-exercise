<?php
$file = "demo.txt";
file_put_contents($file, "Hello World!\n", FILE_APPEND);
$content = file_get_contents($file);
echo nl2br($content);
?>
