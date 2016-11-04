<?php
session_start();
if ($_SESSION['auth'] == false){
	header('location: login.php');
} 

$username = "b28bffa55824a6";
$password = "83271fff";
$servername = "au-cdbr-azure-east-a.cloudapp.net";
$dbname = "vet3202";

//create connection_aborted
$conn = new mysqli($servername, $username, $password, $dbname);
//check connection status
if ($conn->connect_error){
	die("Connection error: " . $conn->connect_error);
} else if ($conn){
	//store current user in variable
	$current_user = $_SESSION['user'];
	//retrieve customerID to use for linking with right row of data
	$retrieve_id="SELECT customerID, firstname, lastname, address, phone, password FROM customer WHERE email='$current_user'";
	$retrieve_result= $conn->query($retrieve_id);
	if($retrieve_result){
		while($row = $retrieve_result->fetch_assoc()){
			//assign retrieved customer details to variables
			$ref_id = $row['customerID'];
			$c_fname= $row['firstname'];
			$c_lname= $row['lastname'];
			$c_address= $row['address'];
			$c_phone= $row['phone'];
			$c_password= $row['password'];
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
								<a href="welcome.php" class="list-group-item">Welcome</a>
								<a href="bookappointment.php" class="list-group-item">Book a New Appointment</a>
								<a href="pastappointment.php" class="list-group-item">View Appointments</a>
								<a href="#" class="list-group-item active">View/Edit Personal Information</a>
							</div>
						</div>
						<!-- Content Column -->
						
						<div id = "viewpersonal" class="col-md-9">
								<h2 class="intro-text text-center">
									<strong>Saved Personal Information</strong>
								</h2>
								<br>
							
							<div id="personaloutput">Loading</div>
							<dl>
									
							</dl>
							
						</div>
						
						
						<div id = "editpersonal" class="col-md-9">
								<h2 class="intro-text text-center">
									<strong>Edit Information</strong>
								</h2>
								<br>
							
							<form>
									<dl>
										<dt>First Name:</dt>
											<ds><input type='text' id="fname" name='fname' value="<?php echo $c_fname;?>"></ds>
										<dt>Last Name:</dt>
											<ds><input type='text' id="lname" name='lname' value="<?php echo $c_lname;?>"></ds>
										<dt>Address:</dt>
											<ds><input type='text' id="address" name='address' value="<?php echo $c_address;?>"></ds>
										<dt>Phone:</dt>
											<ds><input type='text' id="phone" name='phone' value="<?php echo $c_phone;?>"></ds>
										<dt>New password:</dt>
											<ds><input type='text' id="pw" name='password' value="<?php echo $c_password;?>"></ds>							
									</dl><br>
									<input type="button" onclick="updatedata();" class="btn btn-default" value="Submit changes">
									<div id="indicator"></div>
								</form>
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
		
	<script>
	
	$(document).ready(function(){
		updatepersonal();
	});
	
	function updatepersonal(){
		
		var xhttp=new XMLHttpRequest();
		xhttp.onreadystatechange=function(){
			if (xhttp.readyState==4 && xhttp.status==200){
					document.getElementById("personaloutput").innerHTML = xhttp.responseText;
			}
		};
		xhttp.open("GET", "personalgetter.php", true);
		xhttp.send();
	
	}
	
	function updatedata(){

	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function(){
		if(xhttp.readyState == 4 && xhttp.status == 200){
		//window.alert(xhttp.responseText);
		if(xhttp.responseText == "SUCCESS")
			updatepersonal();
			document.getElementById("indicator").innerHTML = "<br><br><button type='button' class='btn btn-success'>Update Successful</button>";
		} else if (xhttp.responseText == "FAIL"){
			document.getElementById("indicator").innerHTML = "<br><br><button type='button' class='btn btn-danger'>Update Failed, Please Try Again or Contact Us</button>";
		} else{
			document.getElementById("indicator").innerHTML = "<br><br><button type='button' class='btn btn-info'>Saving...</button>";
		}
	}
	xhttp.open("POST", "update_info.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("fname="+$("#fname").val()+"&lname="+$("#lname").val()+"&address="+$("#address").val()+"&phone="+$("#phone").val()+"&password="+$("#pw").val());
	
	
	
	}
	
	
	</script>
	

</body>

</html>
