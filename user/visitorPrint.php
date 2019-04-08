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

    $visitorId=$_SESSION['visitorId'];
    
    $visitorinfo=mysqli_query($conn, "SELECT * FROM visitor WHERE id='$visitorId'");
    
    $visitorData = mysqli_fetch_assoc($visitorinfo);
   
    $visitorName=$visitorData["name"];
    $visitorAddress=$visitorData["address"];
    $visitorMobile=$visitorData["mobile"];
    $visitorEmail=$visitorData["email"];
    $visitorWhomtoMeet=$visitorData["whomtomeet"];
    $visitorCompany=$visitorData["fromwhichcompany"];
    $visitorPhoto=$visitorData["photo"];
   
          
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
                    <div class="col-md-8 col-xs-4" id="printDiv">
                        <div class="col-md-4 col-xs-2">
                            <img src=<?php echo $visitorPhoto; ?> alt="sample image" />
                        </div>
                        
                        <div class="col-md-4 col-xs-2">
                            <label>Name :<?php echo $visitorName; ?></label>
                            <label>Address :<?php echo $visitorAddress; ?></label>
                            <label>Mobile :<?php echo $visitorMobile; ?></label>
                            <label>Email :<?php echo $visitorEmail; ?></label>
                            <label>Company :<?php echo $visitorCompany; ?></label>
                            <label>Whom to meet :<?php echo $visitorWhomtoMeet; ?></label>
                        </div>
                        <div class="col-md-4 col-xs-2" >
                            <div id="qrcode"></div>
                        </div>

                    </div>

                    <button type="button" class="btn btn-danger" onclick=PrintDiv();> <i class="fa fa-print" aria-hidden="true"></i> Print</button>
                    <button type="button" class="btn btn-primary" onclick=generateQrCode();> <i class="fa fa-qrcode" aria-hidden="true"></i> Generate Qrcode</button>
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
<script type="text/javascript">     
    function PrintDiv() {  
       var divToPrint = document.getElementById('printDiv');
       var popupWin = window.open('', '_blank', 'width=400,height=400');
       popupWin.document.open();
       popupWin.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</html>');
       popupWin.document.close();
    }

    
        function generateQrCode() {
            alert("ajax");
           $.ajax({
                type: "POST",
                url: 'generateQRCode.php',
                data:{action:'call_this'},
                success:function(html) {
                  alert(html);
                  $('#qrcode').html(html)
                }

           });

        }
       

 </script>

</body>

</html>
