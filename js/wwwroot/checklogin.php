<?php
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
	session_start();
	//store login details in variables?
	$user_email = mysqli_real_escape_string($conn, $_POST['email']);
	$user_pw = mysqli_real_escape_string($conn, $_POST['password']);
	//check database for matching email and password
	$sql = "SELECT * FROM customer WHERE email= '$user_email' AND password= '$user_pw'";
	$result = $conn->query($sql);
	
	if(isset($_POST['submit'])){
		//if result returns a row then correct match
		if ($result->num_rows>0){
			//is_auth is used to make sure user can view other pages needing credentials
			$_SESSION['auth'] = true;
			$_SESSION['error'] = "";
			$_SESSION['user'] = $_POST['email'];
			//redirect to member section
			header('location: welcome.php');	
			exit;
		} else{
			//display error message
			$_SESSION['error'] = "Invalid email or password!";
			header('location:login.php');
		}
	} else {
		$_SESSION['error'] = "Enter a username & password!";
		header('location:login.php');
	}
$conn->close();
}
?>
