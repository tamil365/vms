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
     
    if(isset($_POST["otp"])) {

        $result = mysqli_query($conn,"SELECT * FROM otp_expiry WHERE otp='" . $_POST["otp"] . "' AND is_expired!=1 AND NOW() <= DATE_ADD(create_at, INTERVAL 24 HOUR)");
        $count  = mysqli_num_rows($result);
        if(!empty($count)) {
            $result = mysqli_query($conn,"UPDATE otp_expiry SET is_expired = 1 WHERE otp = '" . $_POST["otp"] . "'");
            if(!empty($result)) {
                $success=1;
            }else{
                $success=2;
            }
            
        }
        echo $success;
    }
        

  
?>
    