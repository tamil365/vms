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
         $intime = date("H:i:s");
         $date = date("Y/m/d");
         //image upload content
         $img = $_POST['image'];
         $folderPath = "imageUpload/";
         if(!is_dir($folderPath))
         mkdir($folderPath);

         $image_base64=base64_decode($img);
         $fileName="$visitorname"."$receiptid".".jpg";
         $fileName= preg_replace('/\s/','',$fileName);


         // $image_parts = explode(";base64,", $img);
         // $image_type_aux = explode("image/", $image_parts[0]);
         // $image_type = $image_type_aux[1];
         // $image_base64 = base64_decode($image_parts[1]);
         
         // $fileName ="$visitorname"."$receiptid".".jpg";

         $file = $folderPath . $fileName;
         $result= file_put_contents($file, $image_base64);
         if (!$result) {//echo("Could not save image!  Check file permissions.");die();}
         }
                
         $query = "INSERT INTO visitor (receiptid,name,address,mobile,email,fromwhichcompany,whomtomeet,appointment_required,intime,govtidproof,photo,date,status) 
            VALUES('$receiptid','$visitorname', '$address', ' $mobile','$email', '$fromwhichcompany','$whomtomeet','$appointmentrequired','$intime','$govtid','$file','$date','IN')"; 
         echo $query;
         if(mysqli_query($conn,$query)) {
            $success =1;
         }   //redirection to the printing page.
         else{
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
         }

      //echo "<h4>You will be redirected to the home page after 10 secs !</h4> ";
         // if($success == 1){
         //    header('location: visitorPrint.php');
         // }
         
      }
   

?>