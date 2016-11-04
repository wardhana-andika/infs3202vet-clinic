<?php
/*header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");*/
session_start();

$username = "b28bffa55824a6";
$password = "83271fff";
$servername = "au-cdbr-azure-east-a.cloudapp.net";
$dbname = "vet3202";

$conn = new mysqli($servername, $username, $password, $dbname);
//$customer_id = $_GET['id'];
//$customer_id = 1;

$current_user = $_SESSION['user'];
$get_id="SELECT customerID FROM customer WHERE email='$current_user'";
	$id_result= $conn->query($get_id);
	if($id_result){
		while($row = $id_result->fetch_assoc()){
			//assign retrieved customerID to variable
			$ref_id = $row['customerID'];
		}
	}
//echo $ref_id;
//create connection_aborted


$get_appt = "SELECT appointment_date, appointment_type, notes FROM appointments WHERE customer_id = '$ref_id'";
$result = $conn->query($get_appt);

$outp = "[";
while($rs = $result->fetch_array()) {
    if ($outp != "[") {$outp .= ",";}
    $outp .= '{"Date":"'  . $rs["appointment_date"] . '",';
    $outp .= '"Type":"'   . $rs["appointment_type"]        . '",';
    $outp .= '"Notes":"'. $rs["notes"]     . '"}'; 
}
$outp .="]";

$conn->close();

echo($outp);

?>