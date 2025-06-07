<?php
if (isset($_FILES['fileupload'])) {
    $fileSize = $_FILES['fileupload']['size']; 
    echo "File size in bytes: " . $fileSize . "<br>" ;

    echo "File size in KB: " . round($fileSize / 1024, 2) . " KB<br>";
    echo "File size in MB: " . round($fileSize / 1024 / 1024, 2) . " MB<br>";
}
?>  