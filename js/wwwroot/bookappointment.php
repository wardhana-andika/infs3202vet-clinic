<?php
session_start();
if ($_SESSION['auth'] == false){
	header('location: login.php');
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
	<link href="css/style.css" rel="stylesheet">
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
    <nav class="navbar navbar-default">
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
								<a href="#" class="list-group-item active">Book a New Appointment</a>
								<a href="pastappointment.php" class="list-group-item">View Appointments</a>
								<a href="personal.php" class="list-group-item">View/Edit Personal Information</a>
							</div>
						</div>
						<!-- Content Column -->
						<div id = "bookappointment" class="col-md-9">
							<section class="booking">
								<hr>
								<h2 class="intro-text text-center">
									<strong>Book an Appointment Today!</strong>
								</h2>
								<hr>
								<form id="booking">
									<fieldset>
										<legend>Appointment Form</legend>
										<label>Preferred Date: </label>
										<input id="date" type="date" name="date" min="<?php echo date('Y-m-d'); ?>"><br><br>
										<label>Preferred Time: </label>
										<input id="time" type="time" name="time" min="08:00:00" max="17:00:00">
										<br /><br />
										<label>Appointment Type: </label>
										<select id="proc" name="procedure">
											 <option value="checkup">Check-Up</option>
											 <option value="surgery">Surgery</option>
											 <option value="tablet">Tablet</option>
											 <option value="clean">Clean & Groom</option>
											 <option value="diagnostic">Diagnostic</option>
										</select>
										<br /><br />
										<label>Additional Information: </label>
										<textarea id="notes" name="notes"></textarea>
										<br /><br />
										<div class="buttondiv">
											<input type="button" onclick="updatedata();"  class="btn btn-default" value="Book an Appointment" name="book">
										</div><br>
										<div id="indicator"></div>
									</fieldset>
								</form>
							</section>
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
	function updatedata(){

		var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function(){
			if(xhttp.readyState == 4 && xhttp.status == 200){
			//window.alert(xhttp.responseText);
			if(xhttp.responseText == "SUCCESS")
				updatepersonal();
				document.getElementById("indicator").innerHTML = "<br><br><button type='button' class='btn btn-success'>Appointment Booked</button>";
			} else if (xhttp.responseText == "FAIL"){
				document.getElementById("indicator").innerHTML = "<br><br><button type='button' class='btn btn-danger'>Booking Failed, Please Try Again or Contact Us</button>";
			} else{
				document.getElementById("indicator").innerHTML = "<br><br><button type='button' class='btn btn-info'>Processing...</button>";
			}
		}
		xhttp.open("POST", "createbooking.php", true);
		xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xhttp.send("date="+$("#date").val()+"&time="+$("#time").val()+"&notes="+$("#notes").val()+"&procedure="+$("#proc").val());
		
		
	
	}
	
	/*
	function loadMessage() {
	  var xhttp = new XMLHttpRequest();
	  xhttp.onreadystatechange = function() {
		if (xhttp.readyState == 4 && xhttp.status == 200) {
		  document.getElementById("confirmation").innerHTML = "DONE!";
		}
	  };
	}
	*/
	</script>


</body>

</html>
