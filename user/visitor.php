<?php
	session_start();
 
	if (!isset($_SESSION['id'])) {
        header('location: login.php');
        exit();
		}
    include('../common/SqlConnection.php');
    include('../user/phpqrcode/qrlib.php'); 
    $id=$_SESSION['id'];
    // $check_username=mysqli_query($conn, "SELECT * FROM user WHERE id='$id'");
    // $numrows=mysqli_num_rows($check_username);
    // $row = mysqli_fetch_array($check_username);

    if (isset($_SESSION['receiptid'])) {    
        $receiptid = $_SESSION['receiptid'];
        
        $sql = "SELECT * FROM visitor WHERE receiptid = $receiptid";
        $re = mysqli_query($conn, $sql);
        $result = mysqli_fetch_array($re, MYSQLI_ASSOC);
    }

    if(isset($_SESSION['receiptid'])) {
        echo '<script> $("#printqrid").prop(hidden,false) </script>';
        
    $receiptid = $_SESSION['receiptid'];
    
    $visitorinfo=mysqli_query($conn, "SELECT * FROM visitor WHERE receiptid='$receiptid'");
    
    $visitorData = mysqli_fetch_assoc($visitorinfo);
   
    $visitorName=$visitorData["name"];
    
    $visitorAddress=$visitorData["address"];
    $visitorMobile=$visitorData["mobile"];
    $visitorEmail=$visitorData["email"];
    $visitorWhomtoMeet=$visitorData["whomtomeet"];
    $visitorCompany=$visitorData["fromwhichcompany"];
    $visitorPhoto=$visitorData["photo"];
    $visitorReceiptId=$visitorData["receiptid"];

        
    $tempDir = 'qrcodeimages/';   
    if (!file_exists($tempDir))
        mkdir($tempDir);
    $codeContents="Name :".$visitorName."\n";
    $codeContents.="Address : ".$visitorAddress."\n";
    $codeContents.="Contact : ".$visitorMobile."\n";
    $codeContents.="Meet To : ".$visitorWhomtoMeet."\n";
    $codeContents.="Receipt Id : ".$visitorReceiptId."\n";
    $fileName     = 'qr_'.md5($codeContents).'.png';
 
    $pngAbsoluteFilePath = $tempDir.$fileName;

    $urlRelativeFilePath = 'qrcodeimages/' . $fileName;
 
    if (!file_exists($pngAbsoluteFilePath)) {
        QRcode::png($codeContents, $pngAbsoluteFilePath,"L", 4, 4);

       echo QRcode::png($codeContents, $pngAbsoluteFilePath);
    }
    else {
       //echo "Not working!";
    }
 
    //echo '<img src="'.$urlRelativeFilePath.'" />';
}
      
 ?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Visitor Management - Visitor</title>

  <!-- Custom fonts for this template-->
  <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Custom styles for this template-->
  <link href="../css/sb-admin.css" rel="stylesheet">

  <style>
    #visitorcreateForm label.error { color: red; }
	#visitorcreateForm input.error{color:1px solid orange;}
    
  </style>

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
                    <form id="visitorcreateForm">
                        <div class="row">
                            <div class="col-sm-8">
                                <div class="row">
                                     <div class="col-sm-6">
                                        <label  for="visitorname">Visitor Name</label>
                                        <input type="text" class="form-control"  style="text-transform: capitalize;" autocomplete="off" placeholder="Enter Visitor name" name="visitorname" id="visitorname">
                                    </div>
                                    <div class="col-sm-6">
                                        <label  for="fromwhichcompany">Company</label> 
                                        <input type="text" class="form-control" autocomplete="off" placeholder="Enter Company" name="fromwhichcompany" id="fromwhichcompany">
                                    </div>
                                </div>  

                                <div class="row">
                                    <div class="col-sm-6">
                                        <label for="address">Address</label>
                                        <input type="text" class="form-control" autocomplete="off" placeholder="Enter Address" name="address" id="address">  
                                    </div>
                                    <div class="col-sm-6">
                                        <label  for="mobile">Mobile</label>
                                        <input type="text" autocomplete="off" class="form-control" placeholder="Enter Mobile" maxlength="10" name="mobile" id="mobile">
                                    </div>
                                </div>

                                <div class="row">
                                                        
                                    <div class="col-sm-6">
                                        <label  for="email">Email</label>
                                        <input type="email" class="form-control" autocomplete="off" autocomplete="off" placeholder="Enter email" name="email" id="email">
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="whomtomeet">Whom To Meet</label>
                                        <select class="selectpicker form-control" name="whomtomeet" id="whomtomeet">
                                            <option value= "" selected>Select whom to meet</option>
                                            <option value= "James">James -Yes</option>
                                            <option value= "Hari">Hari -No</option>
                                        </select>                        
                                    </div>

                                </div>
                                <div class="row">    
                                    <div class="col-sm-6">
                                        <label  for="appointment">Appointment</label>
                                        <select class="selectpicker form-control" name="appointmentrequired" id="appointmentrequired">
                                            <option value= "" selected>Select Appointment</option>
                                            <option value= "YES">YES</option>
                                            <option value= "No">NO</option>
                                        </select>
                                    </div>

                                    <div class="col-sm-6">
                                        <label  for="govtidproof">Govt id proof</label>
                                        <input type="text" class="form-control" autocomplete="off"  placeholder="Enter govt id " name="govtid" id="govtid">
                                    </div>
                                </div> <!-- end of row --> 
                            </div><!-- end col-sm-8 -->
                            

                            <div class="col-sm-4" style="padding-top:30px;padding-left:30px">
                                <div style="width: 350px; height: 250px;" id="my_camera">No Camera Detected !</div>
                                    <div  id="pre_take_buttons" style="padding-top:20px;text-align:center;">
                                        <button autocomplete="off" class="btn btn-primary" onclick="preview_snapshot()" type="button"><i class="fa fa-camera" aria-hidden="true"></i> Take Snapshot</button>
                                    </div>
                                    <div id="post_take_buttons" style="display: none;padding-top:20px;text-align:center;">
                                        <button autocomplete="off" class="btn btn-primary"  onclick="cancel_preview()" type="button"><i class="fas fa-less-than"></i> Take Another</button>
                                        <button autocomplete="off" class="btn btn-primary"  onclick="save_photo()" style="font-weight:bold;" type="button"> Save Photo <i class="fas fa-greater-than"></i></button>
                                    </div>
                            
                                </div>                              
                            </div> 

                           
                            <div style="margin-top: 15px;">   
                                <button type="button" class="btn btn-success" id="createVisitorBtn" name="createvisitor">Submit</button>
                                <input autocomplete="off" id="mydata" type="hidden" name="mydata">
                            </div>
                       
                        </div>                       
                        <!-- <script type="text/javascript">
                            function emptys() {
                                var x;
                                x = document.getElementById("mydata").value;
                                if (x == "") {
                                alert("please take a proper phto!");
                                return false;
                                };
                            }
                            </script>	 -->
                        </form> 

                        <div class="form-row" id="printqrid">
                            <div class="col-md-2 mb-2">
                                <button type="button" class="btn btn-danger"data-toggle="modal" data-target="#printModal" ><i class="fa fa-print"></i> Print </button>
                            </div>
                            <div class="col-md-2 mb-2">
                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#qrModal"><i class="fa fa-qrcode"></i> QRCode</button>
                            </div>
                        </div> 

                        
                    </div>   	
                                    
                </div>
            </div>
        </div>
    </div>    

    

        <!-- The snopshot modal -->
    <div class="modal" id="snopshotModal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Visitor Photo</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <div class="container">
                    <div class="row">    
                        <div class="col-md-6 mb-6">
                            <div id="my_camera"></div>
                            <br/>
                            <input type=button value="Take Snapshot" onClick="take_snapshot()">
                            <!-- <input type="hidden" name="image" class="image-tag"> -->
                        </div>
                        <br/>
                        <div class="col-md-6 mb-6">
                            <div id="results">Your captured image will appear here...</div>
                        </div>
                    </div> 
                </div>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>

            </div>
        </div>
    </div>

     <!-- OTP Modal -->   
    <div class="modal" id="otpModal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">OTP</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <div class="container">
                    <div class="error"></div>
                    <div class="success"></div>
                    <form id="frm-mobile-verification">
                        <div class="error"></div>
                        <div class="success"></div>
                        <div class="form-row">
                            <label>OTP is sent to Your Mobile Number</label>		
                        </div>

                        <div class="form-row">
                            <input type="text"  id="mobileOtp" class="form-input" placeholder="Enter the OTP">		
                        </div>

                        <div class="form-row">
                            <input type="button" id="verify" class="btn-primary" value="Verify" onClick="verifyOTP()">
                                
                        </div>
                    </form>
                </div>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>

            </div>
        </div>
    </div>

     <!-- Print Modal -->   
    <div class="modal" id="printModal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Visitor Pass</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <div class="container">
                    <div id="printDiv" class="row">

                        <div class="col-sm-4" > 
                            <img style="width: 200px; height: 224px;" src="<?php echo $result['photo']?>"> 
                        </div>

                        <div class="col-sm-8" >
                            <p style="width: 678px;" id="col-1">Date and Time :<?php echo $result['intime'];?>&nbsp;&nbsp;
                            <br>
                            <span id="col-1" name="main">VistorName :&nbsp;
                                <?php echo $result['name'];?>
                            </span>
                            <br>
                            <span id="col-1">Contact No :&nbsp;
                                <?php echo $result['mobile']?>
                            </span>    
                            <br>
                            <span id="col-1">Address :&nbsp;
                                <?php echo $result['address'];?>
                            </span>
                            <br>
                            <span id="col-1">Meeting :&nbsp;
                                <?php echo $result['whomtomeet'];?>
                            </span>
                            <br>
                            <span id="col-1">Receipt ID :&nbsp;
                                    <?php echo $result['receiptid'];?>
                            </span>
                            <br>           
                        </div>
                    </div>
                    <!-- <p style="text-align:center;padding-top:20px;">NOTE : This visitor badge is only valid for x hours, please return it at the exit !</p>
                    <br>
                    <br> -->
                    <div style="text-align:center;"> 
                        <button type="button" id="button" class="hide-from-printer" onclick="printPage(printDiv)">Print</button> 
                        <!-- <a type="button" id="button" class="hide-from-printer" href="front.php">Back </a> -->
                    </div>
                    <!-- <a type="button" id="button" class="hide-from-printer" href="front.php"> </a> -->
                </div>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>

            </div>
        </div>
    </div>


    <div class="modal" id="qrModal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">QR Code</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <div class="container">
                    <div class="row">    
                        <div class="col-md-6 mb-6">
                            <img src=" <?php echo $urlRelativeFilePath?>">
                        </div>
                        <br/>
                        
                    </div> 
                </div>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>

            </div>
        </div>
    </div>





  <!-- Bootstrap core JavaScript-->
  <script src="../vendor/jquery/jquery.min.js"></script>
  <script src="../vendor/jquery/jquery.validate.min.js"></script>
  <script src="../vendor/jquery/validation.js"></script>
  <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  

  <!-- Core plugin JavaScript-->
  <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="../vendor/webcam.min.js"></script>
  <script src="../scripts/visitor.js"></script>      

<!-- Configure a few settings and attach camera -->
 <script language="JavaScript">



    Webcam.set({
        width: 350,
        height: 250,
        image_format: 'jpeg',
        jpeg_quality: 90
    });
  
    Webcam.attach( '#my_camera' );
  
    // function take_snapshot() {
    //     Webcam.snap( function(data_uri) {
    //         $(".image-tag").val(data_uri);
    //         document.getElementById('results').innerHTML = '<img src="'+data_uri+'"/>';
    //     } );
    // }

    function printPage(){
        var divToPrint = document.getElementById('printDiv');
       var popupWin = window.open('', '_blank', 'width=500,height=500');
       popupWin.document.open();
       popupWin.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</html>');
       popupWin.document.close();
    }
</script>

<script language="JavaScript">
   function preview_snapshot() {
// freeze camera so user can preview pic
	Webcam.freeze();
// swap button sets
	document.getElementById('pre_take_buttons').style.display = 'none';
	document.getElementById('post_take_buttons').style.display = '';
}
	function cancel_preview() {
// cancel preview freeze and return to live camera feed
	  Webcam.unfreeze();
// swap buttons back
	  document.getElementById('pre_take_buttons').style.display = '';
	  document.getElementById('post_take_buttons').style.display = 'none';
  }
	function save_photo() {
// actually snap photo (from preview freeze) and display it
	  Webcam.snap( function(data_uri) {
// display results in page
	  document.getElementById('my_camera').innerHTML = 
		  '<img src="'+data_uri+'"/>';
	  var raw_image_data = data_uri.replace(/^data\:image\/\w+\;base64\,/, '');
	  document.getElementById('mydata').value = raw_image_data;
	  document.getElementById('pre_take_buttons').style.display = '';
	  document.getElementById('post_take_buttons').style.display = 'none';
 });
}
</script>
<?php
include('../common/footerForAll.php');
?>
</body>

</html>
