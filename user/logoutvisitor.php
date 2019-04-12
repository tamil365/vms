<?php
	session_start();
 
	if (!isset($_SESSION['id'])) {
        header('location: login.php');
        exit();
		}
    include('../common/SqlConnection.php');

?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Visitor Management - Logout visitors</title>

  <!-- Custom fonts for this template-->
  <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Custom styles for this template-->
  <link href="../css/sb-admin.css" rel="stylesheet">

  

</head>

<body id="page-top">

<?php include '../common/navbar.php';?>

  <div id="wrapper">

    <!-- Sidebar -->
    <?php include '../common/sidebar.php';?>

        <div id="content-wrapper">

            <div class="container-fluid">
                 <!-- Breadcrumbs-->
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="#">Visitor</a>
                    </li>
                    <li class="breadcrumb-item active">Overview</li>
                </ol>
                <div class="card-body">
                    <p><h3 style = "padding-left: 25px">These visitors were Logged out Today!</h3></p><br>
                  <div class="row" style = "padding-left: 25px">
                    <?php 
                      $date = date("Y/m/d");
                      $query = "SELECT * FROM visitor WHERE date='$date' AND status='OUT'";
                      $res = mysqli_query( $conn,$query);
                  
                      while($result = mysqli_fetch_array($res, MYSQLI_ASSOC))
                                                 
                      echo '<div class="col-sm-2">
                              <div class="thumbnail" style = "width:175px;">
                                <img class="img-thumbnail" src="'.$result['photo'].'" alt="photo" width="400" height="300">
                                <p style = "text-align:center;"><strong>'.$result['name'].' </strong></p>
                                <p>Receipt ID : '.$result['receiptid'].'</p>
                                <p>Contact : '.$result['mobile'].'</p>
                                <p>Time In : '.$result['intime'].'</p>
                                <p>Date    : '.$result['date'].'</p>
                                <p>Meeting : '.$result['whomtomeet'].'</p>                           
                              </div>
                          </div>';
                    ?>
                  </div>
                </div>
            </div>
        </div>
  </div>
<?php
include('../common/footerForAll.php');
?>
</body>
</html>