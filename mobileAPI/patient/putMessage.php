<?php  
 
require_once "../initDB.php";
// Get POST data...

$id = $_POST['patient_id'];
$message = $_POST['message'];

if (isset($_POST["profession"])){
	if ($_POST["profession"]=="doctor") {
		$table = "patient_doctor";
	}
	else {
		$table = "patient_professional";
		
	}
}

else die();

$sql_query = "SELECT * FROM {$table} WHERE patient_id = {$id};"; 
$result = mysqli_query($conn, $sql_query);
if(mysqli_num_rows($result) == 0){
	echo "not found";
}
else {
	$sql_query = "UPDATE {$table} SET msg = '{$message}' WHERE patient_id = {$id};";
	$result = mysqli_query($conn, $sql_query);
	if ($result){
		echo "updated";
	}
	else {
		echo "update error";
	}
}





?>  