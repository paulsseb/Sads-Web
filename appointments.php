<?php
// Initialize the session
include 'img/connection.php';

session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>


<!doctype html>
<html lang="en">
  <head>
    <title>Smart Arthritis Diagnosis System</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300, 400, 700" rel="stylesheet">

    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="css/jquery.timepicker.css">

    <script src="js/jquery-1.12.4.js"></script>
    <script>
        $(document).ready(function() {
                $('#example').DataTable({});
            });

        </script>
    <link rel="stylesheet" href="css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
    <script src="js/jquery.dataTables.min.js"></script>

    <link rel="stylesheet" href="fonts/ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="fonts/fontawesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="fonts/flaticon/font/flaticon.css">


    <!-- Theme Style -->
    <link rel="stylesheet" href="css/style.css">
    
  </head>
  <body onload="myFunction()" style="margin:0;">
    
    <header role="banner">

      <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
          <a class="navbar-brand" href="index.php"><img src="img/cropped-logo11.jpg"></a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample05" aria-controls="navbarsExample05" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse" id="navbarsExample05" >
            <ul class="navbar-nav ml-auto">
              <li class="nav-item">
                <a class="nav-link" href="index.php">Home</a>
              </li>
          
        
              <li class="nav-item">
               
                <a class="nav-link" href="logout.php">Logout</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="doctorhome.php".php>Back</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="arthritisInfo.php">About Artritis</a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
    </header>

 
    <!-- END section -->
<div class="container">
   <h2 align="center"  style="color:#868e96;"> Appointments</h2>

    <div class="row">
      <div class="col-12">

        <table id="example" class="display nowrap" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>Patient Name</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Reason</th>
                   
                </tr>
            </thead>
            
            <tbody>
                <?php 
                    $sql = "SELECT o.*, c.userId,c.firstName, c.lastName
                                                  FROM `appointment` o, users c
                                                  WHERE c.userId = o.user_id
                                                  AND o.status = 'PENDING'";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        // output data of each row
                        while($row = $result->fetch_assoc()) {
                            $id = $row['appointmentId'];
                            $firstName = $row['firstName'];
                            $lastName = $row['lastName'];
                            $date = $row['date'];
                            $time = $row['time'];
                            $reason = $row['reason'];
                       

                    ?>
                <tr>
                   
                    <td>
                        <?php echo $firstName." ".$lastName; ?>
                    </td>
                   
                    <td>
                        <?php echo $date; ?>
                    </td>
                    <td>
                        <?php echo $time; ?>
                    </td>
                    <td>
                        <?php echo $reason; ?>
                    </td>
                    <td>  
                      <a href="#approve<?php echo $id;?>" data-toggle="modal">
                            <button type='button' class='btn btn-success btn-sm'><span > Approve</span></button>
                        </a>
                        <a href="#delete<?php echo $id;?>" data-toggle="modal">
                            <button type='button' class='btn btn-danger btn-sm'><span >Cancel</span></button>
                        </a>
                    </td>
        

                    <!--Delete Modal -->
                    <div id="delete<?php echo $id; ?>" class="modal fade" role="dialog">
                        <div class="modal-dialog">
                            <form method="post">
                                <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h5 align="center"  style="color:#868e96;">Delete</h5>
                                    </div>
                                    <div class="modal-body">
                                        <input type="hidden" name="delete_id" value="<?php echo $id; ?>">
                                        <div class="alert alert-danger">Are you Sure you want Delete this appointment by <strong>
                                                <?php echo $firstName." ".$lastName; ?>?</strong> </div>
                                        <div class="modal-footer">
                                            <button type="submit" name="delete" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> YES</button>
                                            <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove-circle"></span> NO</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                         <!--Approve Modal -->
                    <div id="approve<?php echo $id; ?>" class="modal fade" role="dialog">
                        <div class="modal-dialog">
                            <form method="post">
                                <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4  align="center"  style="color:#868e96;">Approve</h4>
                                    </div>
                                    <div class="modal-body">
                                        <input type="hidden" name="delete_id" value="<?php echo $id; ?>">
                                        <div class="alert alert-danger">Do you want to approve this appointment by <strong>
                                                <?php echo $firstName." ".$lastName; ?>?</strong> </div>
                                        <div class="modal-footer">
                                            <button type="submit" name="approve" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> YES</button>
                                            <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove-circle"></span> NO</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div> 
                  </tr>

              <?php
                        }
                       


                        if(isset($_POST['delete'])){
                            // sql to delete a record
                            $statusss = "CANCELD";
                            $sql = "UPDATE appointment set status='$statusss' WHERE appointmentId='$id' ";
                            if ($conn->query($sql) === TRUE) {
                                echo '<script>window.location.href="appointments.php"</script>';
                            } else {
                                echo "Error cancelling appointmentsssss: " . $conn->error;
                            }
                        }


                        if(isset($_POST['approve'])){
                             // sql to delete a record
                            $statusss = "APPROVED";
                            $sql = "UPDATE appointment set status='$statusss' WHERE appointmentId='$id' ";
                            if ($conn->query($sql) === TRUE) {
                                echo '<script>window.location.href="appointments.php"</script>';
                            } else {
                                echo "Error cancelling appointmentsssss: " . $conn->error;
                            }
                        }




                    }

               
              

                
?>
            </tbody>
        </table>



      </div>
    </div>

    
  </div>

    <!-- END cta-link -->
<footer class="site-footer" role="contentinfo" >
      <div class="container">
<div class="row pt-md-3 element-animate">
	<div class="col-md-12" >
                        <h5 align="center">
                            <a href="">Useful Links:</a>
                        </h5>
                    <div align="center">   
<a href="http://athritisuganda.org/">The Arthritis Association Of Uganda</a>&emsp;
 <a href="https://disu256.blogspot.com/2016/09/arthritis-in-uganda.html">Arthritis in Uganda</a>&emsp;
 <a href="https://smartarthritisdiagnosis.wordpress.com/">BSE 19-27 Blogg</a>&emsp;

						</div>
                    </div>
      
          <div class="col-12 copyright"><br>
            <p align="center">&copy; 2019 SADS. Designed &amp; Developed by <a href="">BSE 19-27</a></p>
          </div>
          <div class="col-md-6 col-sm-12 text-md-right text-sm-left">
            <a href="#" class="p-2"><span class="fa fa-facebook"></span></a>
            <a href="#" class="p-2"><span class="fa fa-twitter"></span></a>
            <a href="#" class="p-2"><span class="fa fa-instagram"></span></a>
          </div>
        </div>
      </div>
    </footer>

    <!-- END footer -->





    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/bootstrap-datepicker.js"></script>
    <script src="js/jquery.timepicker.min.js"></script>
    <script src="js/jquery.waypoints.min.js"></script>
    <script src="js/main.js"></script>
  </body>
</html>