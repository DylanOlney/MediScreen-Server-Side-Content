<?php  
 
require_once "../initDB.php";
// Get POST data...



$id = $_POST['patient_id'];
$rating = $_POST['rating'];

$sql_query = "SELECT * FROM patients WHERE id = {$id};"; 
$result = mysqli_query($conn, $sql_query);
if(mysqli_num_rows($result) == 0){
	echo "not found";
}
else {
	$sql_query = "UPDATE patients SET app_rating = '{$rating}' WHERE id = {$id};";
	$result = mysqli_query($conn, $sql_query);
	if ($result){
		echo "updated";
	}
	else {
		echo "update error";
	}
}





?>  