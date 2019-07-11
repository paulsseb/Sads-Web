<?php
// Initialize the session
session_start();
 
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: doctorhome.php");
    exit;
}
 
// Include neccessary files
 require "User.php";

// Define variables and initialize with empty values
$username = $password = "";
$variable_err =  "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $variable_err = "Please enter username.";
    } else{
        $username = trim($_POST["username"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $variable_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate credentials
    if(empty($variable_err)){
         
    $requestUrl ="http://localhost:8080/SADS/AuthWS/getLogin?Username=".$username."&Password=".$password."&App=Web";
    $responseFromServer = file_get_contents($requestUrl);

    $results = json_decode(json_encode($responseFromServer));// Encode it to a string then decode the JSON object
    $iter = new RecursiveIteratorIterator( new RecursiveArrayIterator(json_decode($results,true)));// iterate through the items
// Define variables and initialize with empty values
$userid = $email = $firstName = $lastName = $role= $dob = $gender= $phoneNumber = $username= $password = "";

// results returns there create user object with results from API
      foreach($iter as $key=>$value) 
      { 
       if($key == "userid")
         {  $userid = $value; }
     else if($key == "email")
         { $email = $value; } 
     else if($key == "firstName")
         { $firstName = $value; } 
     else if($key == "lastName")
         { $lastName = $value; } 
     else if($key == "role")
         { $role = $value; } 
     else if($key == "dob")
         { $dob = $value; } 
      else if($key == "gender")
         { $gender = $value; } 
     else if($key == "phoneNumber")
         { $phoneNumber = $value; } 
     else if($key == "username")
         { $username = $value; } 
     else if($key == "password")
         { $password = $value; } 

    }
    $CurrentUser = new User( $userid, $firstName,$lastName, $role , $dob,$gender, $phoneNumber , $email,$username, $password );
     


            if(($userid)!= "")
            {
                

                  // Password is correct, so start a new session
                    session_start();
                            
                  // Store data in session variables
                 $_SESSION["loggedin"] = true;
                 $_SESSION["id"] = $id;
                 $_SESSION["username"] = $username;                            
                            
                 // Redirect user to welcome page
                 header("location: doctorhome.php");
                       
            } else{
               $variable_err = "Wrong login Details";
               // echo "Oops! Something went wrong. Please try again later.";
            }
        
    }
    
   
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

    <link rel="stylesheet" href="fonts/ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="fonts/fontawesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="fonts/flaticon/font/flaticon.css">


    <!-- Theme Style -->
    <link rel="stylesheet" href="css/style.css">
	  
  </head>
  <body>
    
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
                <a class="nav-link  active" href="login.php">Login</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="register.php">Register</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="arthritisInfo.php">About</a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
    </header>
    <!-- END header -->
    
  
    <!-- END slider -->

    
   
    <!-- END section -->

		  
	

    <!-- END section -->
<div class="container">
	<h2 align="center"  style="color:#868e96;">Please Enter your details to access the system </h2>
	<div class="row">
		 <div class="col-md-6">
		<!--<h4 align="center">About the system</h4>-->
			<br>
			<p>The Smart Arthritis Diagnosis system simplifies the diagnosis and monitoring of RA
for both patients and doctors.<br>
				<br>It recommends remedies to patients as well as bridging
the communication gap between patients and doctors.</p>
			<p>The system allows patients to conveniently, easily and quickly perform a diagnosis of
Arthritis.<br>
<br>The system allows patients and doctors to monitor the progression of the disease and advise
them accordingly.</p>
		
		</div>
		<div class="col-md-6">
    <div class="login-form">
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <h2 class="text-center" style="color:#868e96;">Log in</h2>       
        <div class="form-group">
          <span class="help-block"><?php echo $variable_err; ?></span>
            <input type="text" name="username" class="form-control" placeholder="Username" required="required" value="<?php echo $username; ?>">
        </div>
        <div class="form-group">
            <input type="password" name="password" class="form-control" placeholder="Password" required="required">
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-block">Log in</button>
        </div>
        <div class="clearfix">
            <label class="pull-left checkbox-inline"><input type="checkbox"> Remember me</label>
            <a href="#" class="pull-right">Forgot Password?</a>
        </div>        
    </form>
     <!--  <span class="sub-heading">Ready to Visit?</span>
      <span class="heading">Make an Appointment</span>-->
   </div>
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


    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/bootstrap-datepicker.js"></script>
    <script src="js/jquery.timepicker.min.js"></script>
    <script src="js/jquery.waypoints.min.js"></script>
    <script src="js/main.js"></script>
  </body>
</html>