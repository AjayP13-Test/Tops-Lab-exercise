<?php


//print_r($_FILES);
if($_FILES ['fileupload']){
    $path = $_FILES ['fileupload']['name'];
    echo $path;
  //  $upload_path = "./uploads".$path;
  $upload_path = "./uploads".$path;


    if(move_uploaded_file($_FILES['fileupload']['tmp_name'],$upload_path)){
         echo "file uploaded";
    } else {
          die ("failed to uplaod");
    }
    
}else {
      die ("no file found");
}

include('filesize.php');
?>


  



