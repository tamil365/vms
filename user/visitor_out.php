<?php
	
	if (!isset($_SESSION['id'])) {
		header('location: login.php');
		exit();
	}
	include('../common/SqlConnection.php');
	if($_SERVER["REQUEST_METHOD"]== "POST"){
		if(!empty($_POST["rid"]))
			$rid = $_POST["rid"];
			$userOf = $_SESSION["user"];

			$time = date("H:i:s");
			$date = date("d/m/Y");

	if(empty($rid))
		echo "You have not entered the required fields Correctly !!";
	else {
	
		$query_s = "SELECT receiptid FROM visitor WHERE receiptid = '$rid'";
	
		$query = "UPDATE visitor SET Status = 'OUT' , outtime = '$time', logOutBy = '$userOf' WHERE receiptid = '$rid' ";
	
	
	if(mysqli_num_rows(mysqli_query($conn,$query_s))>0){

	
		mysqli_query($conn,$query);
		$success = 1;
		//echo $success;
		// and refresh
		
		}

	else{
	 	 $success =0;
	 //echo $success;
	}
	}

	}


	?>



	