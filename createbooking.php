<?php
session_start();
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
	//retrieve customerID to use for linking with appointment
	$get_userid="SELECT customerID FROM customer WHERE email='$current_user'";
	$userid_result = $conn->query($get_userid);
	if($userid_result){
		while($row = $userid_result->fetch_assoc()){
			//assign retrieved customerID to variable for use
			$ref_userid = $row['customerID'];
		}
	}
	//retrieve petID to use for linking with appointment 
	$get_petid="SELECT petID FROM pets WHERE owner_id='$ref_userid'";
	$petid_result = $conn->query($get_petid);
	if($petid_result){
		while($row = $petid_result->fetch_assoc()){
			//assign retrieved petID to variable for use
			$ref_petid = $row['petID'];
		}
	}
	//store details in variables to be inserted into SQL
	$booking_petID = $ref_petid;
	$booking_userID = $ref_userid;
	$booking_date = mysqli_real_escape_string($conn, $_POST['date']);
	$booking_time = mysqli_real_escape_string($conn, $_POST['time']) . ":00";//complete the time format
	$booking_notes = mysqli_real_escape_string($conn, $_POST['notes']);
	$booking_type = mysqli_real_escape_string($conn, $_POST['procedure']);
	//set variable for procedure cost;
	switch($booking_type){
		case "checkup":
			$booking_cost = 40;
			break;
		case "surgery":
			$booking_cost = 200;
			break;
		case "tablet":
			$booking_cost = 30;
			break;
		case "diagnostic":
			$boooking_cost = 80;
			break;
		case "clean":
			$booking_cost = 15;
			break;
	}
	//create SQL query for inserting the data
	$sql_update = "INSERT INTO appointments (appointment_type, cost, appointment_date, customer_id, pet_id, notes, appointment_time)  
	VALUES ('$booking_type', '$booking_cost', '$booking_date', '$booking_userID', '$booking_petID', '$booking_notes', '$booking_time')";
	$update_result = $conn->query($sql_update);
	//check if successfull
	if($update_result){
		echo "SUCCESS";
		include 'mail.php';
	} else {
		echo "FAIL";
	}
$conn->close();
}
?>