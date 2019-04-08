<?php
    session_start();
    include '../common/SqlConnection.php';
    
    
      if ($_SERVER["REQUEST_METHOD"] =="POST"){
        
         $visitorname=$_POST['visitorname'];
         $fromwhichcompany=$_POST['fromwhichcompany'];
         $address=$_POST['address'];
         $mobile=$_POST['mobile'];
         $email=$_POST['email'];
         $whomtomeet=$_POST['whomtomeet'];
         $appointmentrequired=$_POST['appointmentrequired'];
         $govtid=$_POST['govtid'];
         $receiptid = rand(100000,900000);
         $_SESSION["receiptid"] = $receiptid ;
         //image upload content
         $img = $_POST['image'];
         $folderPath = "imageUpload/";
         if(!is_dir($folderPath))
         mkdir($folderPath);

         $image_parts = explode(";base64,", $img);
         $image_type_aux = explode("image/", $image_parts[0]);
         $image_type = $image_type_aux[1];
         $image_base64 = base64_decode($image_parts[1]);
         
         $fileName ="$visitorname"."$receiptid".".jpg";

         $file = $folderPath . $fileName;
         file_put_contents($file, $image_base64);
                
         $query = "INSERT INTO visitor (receiptid,name,address,mobile,email,fromwhichcompany,whomtomeet,appointment_required,intime,govtidproof,photo) 
            VALUES('$receiptid','$visitorname', '$address', ' $mobile','$email', '$fromwhichcompany','$whomtomeet','$appointmentrequired',now(),'$govtid','$file')"; 
         echo $query;
         $inserted=mysqli_query($conn, $query);
         if($inserted == 1){
            $lastinsert_visitorId = mysqli_insert_id($conn);
            $_SESSION['visitorId']=$lastinsert_visitorId;
            echo $inserted;
            //echo "New record created successfully";
         }else{
               echo "Error: " . $query . "<br>" . $conn->error;
            }
         }
       

?>