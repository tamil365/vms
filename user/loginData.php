<?php
session_start();
include '../common/SqlConnection.php';
echo $_POST["userName"];
echo $_POST["inputPassword"];

	if (isset($_POST["userName"]) && isset($_POST["inputPassword"]))
	{
	   $user=$_POST['userName'];
       $pass=$_POST['inputPassword'];
       if(empty($user) || empty($pass)) 
		{
			echo"<script>alert('Fill all fields');
				window.location.href = 'login.php';
			</script>";
		}
	   else
	   { 
		// $passwordmd5=md5($password);
	    $check_username=mysqli_query($conn, "SELECT * FROM user WHERE userName='$user' or userEmail='$user' and userPassword ='$pass'");
        $numrows=mysqli_num_rows($check_username);
         if($numrows == 1)
	       {
			$row=mysqli_fetch_array($check_username);
			$_SESSION['id']=$row['id'];
			$_SESSION["user"] = $_POST["userName"];
			header('location:visitor.php'); 
			
		   }
		 else{
			$_SESSION['message']="Login Failed. Wrong Username or Password!";
			header('location:login.php');
			
	        }
	  }
	}
	
?>