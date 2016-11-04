<?php
session_start();
if ($_SESSION['auth'] == false){
	header('location: login.php');
} 

$dbusername = "b28bffa55824a6";
$dbpassword = "83271fff";
$dbservername = "au-cdbr-azure-east-a.cloudapp.net";
$db_name = "vet3202";
$tbl_name="customer";

//create connection
$conn = new mysqli($dbservername, $dbusername, $dbpassword, $db_name);
//check connection 
if ($conn->connect_error){
	die("Connection Error: " . $conn->connect_error);
} else if ($conn){
	//store current user in variable
	$current_user = $_SESSION['user'];
	//retrieve customer name for use
	$get_userid="SELECT firstname, lastname FROM customer WHERE email='$current_user'";
	$userid_result = $conn->query($get_userid);
	if($userid_result){
		while($row=$userid_result->fetch_assoc()){
			//assign retrieved name to variables for use
			$fname = $row['firstname'];
			$lname = $row['lastname'];
		}
	}	
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

	<title>Animal House Vet Clinic</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/business-casual.css" rel="stylesheet">
	
	
	

    <!-- Fonts -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Josefin+Slab:100,300,400,600,700,100italic,300italic,400italic,600italic,700italic" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div class="brand">Animal House Vet Clinic</div>
    <div class="address-bar">153 Park Road | Woolloongabba QLD 4102 | 0733767361</div>

    <!-- Navigation -->
    <nav class="navbar navbar-default" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <!-- navbar-brand is hidden on larger screens, but visible when the menu is collapsed -->
                <a class="navbar-brand" href="index.html">Animal House Vet Clinic</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="index.html">Home</a>
                    </li>
                    <li>
                        <a href="services.html">Services</a>
                    </li>
                    <li>
                        <a href="contact.html">Contact</a>
                    </li>
					<li>
                        <a href="logout.php">Log Out</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <div class="container">

        <div class="row">
            <div class="box">
                <div class="col-lg-12 text-center">
                    <div class="row">
						<!-- Sidebar Column -->
						<div class="col-md-3">
							<div class="list-group">
								<a href="#" class="list-group-item active">Welcome</a>
								<a href="bookappointment.php" class="list-group-item">Book a New Appointment</a>
								<a href="pastappointment.php" class="list-group-item">View Appointments</a>
								<a href="personal.php" class="list-group-item">View/Edit Personal Information</a>
							</div>
						</div>
						<!-- Content Column -->
						<div id = "welcome" class="col-md-9">
							<hr>
							<h2 class="intro-text text-center">
								<strong>Welcome to the Members Area, <?php echo $fname. " ". $lname. "!"; ?></strong>
							</h2>
							<hr>
							<br>
								<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent pulvinar tincidunt tortor, eget pharetra libero. Nulla felis nulla, interdum eu tincidunt eget, congue laoreet diam. Proin dignissim nec arcu non pretium. Cras non sem mollis, facilisis magna et, sollicitudin nunc. Donec id maximus erat. Fusce lacinia sem nec pellentesque dictum. Nulla sit amet nisi accumsan, cursus arcu eget, mattis diam. Ut dapibus, elit sed mattis condimentum, purus tellus blandit leo, a posuere eros ex pellentesque lacus.</p>
						</div>
					</div>
            </div>
			</div>
		</div>
    </div>
    <!-- /.container -->

    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <p>Copyright &copy; Animal House Veterinary Clinic 2016</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

	
	<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCKgMX23avWFEHgZFOz1fpjllvpKk5hPh0"></script>
		
	

</body>

</html>
