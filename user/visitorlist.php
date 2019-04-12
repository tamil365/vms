<?php
	 session_start();
 
	// if (!isset($_SESSION['id'])) {
    //     header('location: login.php');
    //     exit();
	// 	}
    

    

      
 ?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Visitor Management - List</title>

  <!-- Custom fonts for this template-->
  <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Custom styles for this template-->
  <link href="../css/sb-admin.css" rel="stylesheet">

  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.18/datatables.min.css"/>      
  <!-- <link href="../vendor/datatables.dataTables.bootstrap4.min.css" rel="stylesheet"> -->

  <style>
    
    
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
                    <div class="container">
                        <h3>Visitor List</h3>
	                    <hr></hr>
                        <div class="row">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <td>Name</td>
                                            <td>Address</td>
                                            <td>Mobile</td>
                                            <td>Meeting To</td>
                                            <td>Company</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            include('../common/SqlConnection.php');
                                            $sql = $conn->query('SELECT * FROM visitor');
                                            while($data = $sql->fetch_array()) {
                                                echo '
                                                    <tr>
                                                        <td>'.$data['name'].'</td>
                                                        <td>'.$data['address'].'</td>
                                                        <td>'.$data['mobile'].'</td>
                                                        <td>'.$data['whomtomeet'].'</td>
                                                        <td>'.$data['fromwhichcompany'].'</td>
                                                    </tr>
                                                ';
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>

                        </div>

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
  <!-- DataTable plugin -->  
  <!-- <script src="../vendor/datatables/dataTables.bootstrap4.min.js"></script>
  <script src="../vendor/datatables/jquery.dataTables.min.js"></script>   -->
  
 
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.18/datatables.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $(".table").DataTable({  
                
            });
        });
    </script>
<?php
include('../common/footerForAll.php');
?>
</body>

</html>
