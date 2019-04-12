<?php
	 session_start();
 
	

    include('../common/SqlConnection.php');
    include('../user/visitor_out.php');
   $tody = date("Y:m:d");
	 $sql = "SELECT Name FROM visitor WHERE Date = '$tody'";
  
   $sqlOnline = "SELECT * FROM visitor  WHERE status='IN' LIMIT 10";

    $sqlRecent = "SELECT * FROM (SELECT * FROM visitor ORDER BY id DESC LIMIT 10) a ORDER BY id DESC";

   $resultToday = mysqli_num_rows(mysqli_query($conn,$sql));   //recent Visitors
   $resultS = mysqli_query($conn,$sqlOnline);       //Online Visitors




  
   $onlineVsitor = mysqli_num_rows($resultS);
  

	 
    $sqlResRecent = mysqli_query($conn,$sqlRecent);
          
 ?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Visitor Management - Exit</title>

  <!-- Custom fonts for this template-->
  <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Custom styles for this template-->
  <link href="../css/sb-admin.css" rel="stylesheet">

  <style>

 body {
    max-width: 100%;
    max-height: 100%;
    overflow-y: hidden;
    overflow-x: hidden;
    
   }

	
img {width:100%;}
.affix {
      top:0;
      width: 100%;
      z-index: 9999 !important;
  }
  .navbar {
      margin-bottom: 0px;
  }

  .affix ~ .container-fluid {
     position: relative;
     top: 50px;
  }

  #coverPic{

    width: 100%;
    height:35%;
}
  .popover-title{
    background: #3EFE00 !important;
    color: #000000;
}
input[type='number'] {
    -moz-appearance:textfield;
}
input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
    -webkit-appearance: none;
}
	
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

                <div class="row">
    
                    <div class="col-sm-3" style="padding-left:50px;height:100%;"> 
                    
                        <div><h3>Logout Visitor</h3></div>
                        <div style="padding-top:20px;display:block;">
                                <form method= "POST" action = ""> 
                                    <div class="form-group">
                                        <label class="control-label" id ="t" for="recept_id">Receipt ID :</label>
                                        <input class = "form-control" name= "rid" type = "number"  placeholder="Enter Receipt ID." required/>
                                    </div>
                                    <?php {?>

                                        <button id="x" name ="logout" class="btn btn-primary"  type ="submit" onclick='return confirm("Are you sure you want to Logout?")'> <i class="fas fa-sign-out-alt"></i> Logout</button>

                                    <?php }?>
                                    <?php
                                        if($_SERVER['REQUEST_METHOD'] == 'POST'){
                                        if($success == 1)
                                        echo "<span style = 'color:green;'>Done !</span>";

                                        else 
                                        echo "<span style = 'color:red;''>Sorry ! No match found.</span>";

                                        }
                                        ?>
                                </form>
                            </div>
                        </div>
                        <div class="col-sm-5"> 
                            <h3 style="padding-left:10px;text-align:center;">Details</h3>

                            <?php 

                              $showResultFor = 0;

                              if(isset($_GET['rid'])){
                                $showResultFor = $_GET['rid'];
                              }
                              $query = "SELECT * FROM visitor WHERE receiptid = '$showResultFor'";

                                        $getresult = mysqli_query($conn,$query);
                                        $resultDetails = mysqli_fetch_array($getresult, MYSQLI_ASSOC);

                                      

                              if($resultDetails) {?>
                                  
                                    <div  class="row" >

                                  <div class="col-sm-4" style = "padding-left:20px;padding-top:15px" > 
                                  
                                  <img style="width: 180px; height: 190px;" src="<?php echo $resultDetails['photo']?>"> </div>

                                  
                                  <div class="col-sm-8" style = "padding-left:50px;padding-top:20px; font-size:16px;">                           
                                    <span id="col-1">Date :<?php echo $resultDetails['date'];?></span><br>
                                    <span id="col-1"> Time in :<?php echo $resultDetails['intime'];?></span><br>
                                    <span id="col-1" name="main">Name :<?php echo $resultDetails['name'];?></span><br>
                                    <span id="col-1">Contact No : <?php echo $resultDetails['mobile']?></span><br>
                                    <span id="col-1">Meeting : <?php echo $resultDetails['whomtomeet'];?></span><br>
                                    <span id="col-1">Receipt ID :<?php echo $resultDetails['receiptid'];?></span><br> 
                                  </div>
                                </div>

                            <?php }?>

                        </div>

                      <div class="col-sm-4" style="height:100%;"> 
                            <h3 style="margin-right:auto;padding-left:40px;">Recent Visitors :&nbsp;<?php echo $onlineVsitor;?></h3>
                            <ul class="list-group" style="width:80%;padding-top:20px;">
                               
                              <?php 

                                  while($result2 = mysqli_fetch_array($resultS, MYSQLI_ASSOC))
                    
                                  echo '<div  style = "padding-right:45px;padding-left:20px;">
                            
                                  <li class = "list-group-item" style="height :30px;padding-top:3px;"> 
                            
                                  <a style = "font-size:15px;"  href="visitorexit.php?rid='.$result2['receiptid'].'" data-html="true"  

                                  title="<b>'.$result2['name'].'<b>" data-toggle="popover" data-trigger="hover"

                                  data-content="Contact : '.$result2['mobile'].' <br>Time in : '.$result2['intime'].' 
                              
                                  <br> R ID : '.$result2['receiptid'].'">'.$result2['name'].'</a>         
                                  </li>
                                </div>'
                              ?>
                            </ul>
                      </div>                 
                      
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
<script>
  $(document).ready(function(){
      $('[data-toggle="popover"]').popover({
          container: 'body'
       });
  });
</script>
<?php
include('../common/footerForAll.php');
?>
</body>

</html>
