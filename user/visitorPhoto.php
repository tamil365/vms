<?php
	session_start();
 
	if (!isset($_SESSION['id'])) {
        header('location: login.php');
        exit();
		}
    include('../common/SqlConnection.php');
    $id=$_SESSION['id'];
    $check_username=mysqli_query($conn, "SELECT * FROM user WHERE id='$id'");
    $numrows=mysqli_num_rows($check_username);
    $row = mysqli_fetch_array($check_username);
    
      
 ?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Visitor Management - Photo </title>

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
                    <form id="visitorPhotoForm" method="POST" action="visitorPhotoDataUpload.php">
                        
                        
                        <div class="form-row">
                            <div class="col-md-4 mb-4">
                                <div id="my_camera"></div>
                                <br/>
                                <input type=button value="Take Snapshot" onClick="take_snapshot()">
                                <input type="hidden" name="image" class="image-tag">
                                
                            </div>
                            <div class="col-md-4 mb-4">
                                <div id="results">Your captured image will appear here...</div>
                            </div> 
                        </div> 
                        
                        <div>
                            <div style="margin-top: 15px;">        
                                <button type="submit" class="btn btn-primary btn-lg"  name="uploadPhoto">UploadPhoto</button>
                            </div>
                        </div>	
                    </form>
                </div>
            </div>
        </div>
    </div>    

  <!-- Bootstrap core JavaScript-->
  <script src="../vendor/jquery/jquery.min.js"></script>
  <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>
 <script src="../vendor/webcam.min.js"></script>      
<!-- Configure a few settings and attach camera -->
 <script language="JavaScript">
    Webcam.set({
        width: 490,
        height: 390,
        image_format: 'jpeg',
        jpeg_quality: 90
    });
  
    Webcam.attach( '#my_camera' );
  
    function take_snapshot() {
        Webcam.snap( function(data_uri) {
            $(".image-tag").val(data_uri);
            document.getElementById('results').innerHTML = '<img src="'+data_uri+'"/>';
        } );
    }
</script>

</body>

</html>
