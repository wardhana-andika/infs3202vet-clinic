<?php
session_start();
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
	$get_id="SELECT customerID FROM customer WHERE email='$current_user'";
	$id_result= $conn->query($get_id);
	if($id_result){
		while($row = $id_result->fetch_assoc()){
			//assign retrieved customerID to variable
			$ref_id = $row['customerID'];
		}
	}
	
	if ($_POST['fname'] == "" || $_POST['lname'] == "" || $_POST['address'] == "" || $_POST['phone'] == "" || $_POST['password'] == "")
	{
		//cannot be empty
		echo $_POST['fname'] . $_POST['lname'] . $_POST['address'] . $_POST['phone'] . $_POST['password'];
		return;
	}
	//set variables to store user changes
	$user_fname = mysqli_real_escape_string($conn, $_POST['fname']);
	$user_lname = mysqli_real_escape_string($conn, $_POST['lname']);
	$user_address = mysqli_real_escape_string($conn, $_POST['address']);
	$user_phone = mysqli_real_escape_string($conn, $_POST['phone']);
	$user_pw = mysqli_real_escape_string($conn, $_POST['password']);
	
	//query for updating customer details
	$update_details = "UPDATE customer SET firstname='$user_fname', lastname='$user_lname', address='$user_address', 
	phone='$user_phone', password='$user_pw' WHERE email='$current_user'";
	$change_result = $conn->query($update_details);
	//check if successful
	if($change_result){
		echo "SUCCESS";
	} else {
		echo "FAIL";
	}
}
?>