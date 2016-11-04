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
	//store current logged in user in variable
	$current_user = $_SESSION['user'];
	//retrieve customerID to use for linking customer with pet
	$get_id="SELECT customerID FROM customer WHERE email='$current_user'";
	$id_result= $conn->query($get_id);
	if($id_result){
		while($row = $id_result->fetch_assoc()){
			//assign retrieved customerID to variable
			$ref_id = $row['customerID'];
		}
	}
	//query for retrieving customer details
	$get_details = "SELECT firstname, lastname, address, phone, email FROM customer WHERE email='$current_user'";
	//query for retrieving pet details
	$get_petdetails = "SELECT name, type, age FROM pets WHERE owner_id='$ref_id'";
	$pet_result = $conn->query($get_petdetails);
	$person_result = $conn->query($get_details);
	
	$output = "";
	
		//retrieve and output results to page
	if($person_result) {
		//return data of each row
		while($row = $person_result->fetch_assoc()){
			$output .= "<dt>Name:</dt>
					<dd>" .$row['firstname']. " " .$row['lastname']. "</dd>
				<dt>Address:</dt> 
					<dd>" .$row['address']. "</dd>
				<dt>Phone:</dt>
					<dd>" .$row['phone']. "</dd>
				<dt>Email:</dt>
					<dd>" .$row['email']. "</dd>";
		}
	} else {
		$output .= "No results found";
	}
	if($pet_result){
		while($row = $pet_result->fetch_assoc()){
			$output.= "<dt>Pet Name:</dt>
					<dd>" .$row['name']. "</dd>
				<dt>Pet Age:</dt>
					<dd>".$row['age']. "</dd>
				<dt>Pet Type:</dt>
					<dd>" .$row['type']. "</dd>";
		}
	} else{
		$output.= "<dt>Pet Name:</dt>
					<dd> N/A </dd>
				<dt>Pet Age:</dt>
					<dd> N/A </dd>
				<dt>Pet Type:</dt>
					<dd> N/A </dd>";
	}
	
}
	echo $output;
?>