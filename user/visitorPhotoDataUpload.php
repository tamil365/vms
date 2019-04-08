<?php
    session_start();
    include '../common/SqlConnection.php';
    $visitorId=$_SESSION['visitorId'];
     
  
    $img = $_POST['image'];
    $folderPath = "imageUpload/";
    if(!is_dir($folderPath))
     mkdir($folderPath);

    $image_parts = explode(";base64,", $img);
    $image_type_aux = explode("image/", $image_parts[0]);
    $image_type = $image_type_aux[1];
  
    $image_base64 = base64_decode($image_parts[1]);
    $fileName = time() . '.jpg';
  
    $file = $folderPath . $fileName;
    file_put_contents($file, $image_base64);
    echo file_put_contents($file, $image_base64);
    if (is_int(file_put_contents($file, $image_base64)))
    {
        $sql="update visitor set photo='$file' where id=$visitorId";
         
        $result=mysqli_query($conn,$sql);
        if($result==1){
         header('location:visitorPrint.php');
        }
    }    
    print_r($result);
       
     
      

?>