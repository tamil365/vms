<?php
    session_start();

    # Get JSON as a string
    //$json_str = file_get_contents('php://input');

    
    //$results = json_decode($json_str, true);
    //echo $results;

   //echo $results;

    include '../common/SqlConnection.php';

    $success ="";
    $error="";
    $otp = mt_rand(100000, 999999); 

   
    $mobile = $_POST["mobile"];
    //echo $mobile;
     if(isset($mobile)) {

        $query="INSERT INTO otp_expiry (otp,mobile,is_expired,create_at) VALUES('$otp','$mobile',0, now())";
        
        echo $query;
        $inserted=mysqli_query($conn, $query);

        echo $inserted;

         if(!empty($inserted)) {
             $success="otpsend";
             echo $success;    
         }else {
             $error="notsend";
             echo $error;    
         }
     }

    //  if (is_ajax()) {
    //     if (isset($_POST["action"]) && !empty($_POST["action"])) { //Checks if action value exists
    //       $action = $_POST["action"];
    //       switch($action) { //Switch case for value of action
    //         case "verify":verifyOTP(); break;
    //       }
    //     }
    //   }
      //Function to check if the request is an AJAX request
    // function is_ajax() {
    //     return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
    // }

    //  function verifyOTP(){
        
    //     if(!empty($_POST["otp"])) {

    //         $result = mysqli_query($conn,"SELECT * FROM otp_expiry WHERE otp='" . $_POST["otp"] . "' AND is_expired!=1 AND NOW() <= DATE_ADD(create_at, INTERVAL 24 HOUR)");
    //         $count  = mysqli_num_rows($result);
    //         if(!empty($count)) {
    //             $result = mysqli_query($conn,"UPDATE otp_expiry SET is_expired = 1 WHERE otp = '" . $_POST["otp"] . "'");
    //             if(!empty($result)) {
    //                 $success=1;
    //             }else{
    //                 $success=2;
    //             }
                
    //         }
    //      }
    //      echo $success;
    // }   
  
?>
    