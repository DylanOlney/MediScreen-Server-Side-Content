<?php  

//Puts either a patient/doctor or a patient/professional record to the database based on data posted.
require_once "../initDB.php";

$patient_id = $_POST["patient_id"];
$prof_id = $_POST["prof_id"];


if ($_POST["profession"]=="doctor") {
	$table = "patient_doctor";
	$col2 = "doc_id";
		
}
else {
	$table = "patient_professional";
	$col2 = "prof_id";
}
	



// Create query from POST data.
$sql_query = "SELECT * FROM {$table} WHERE patient_id = {$patient_id};"; 

$result = mysqli_query($conn, $sql_query);


if(mysqli_num_rows($result) > 0){
	$sql_query = "UPDATE {$table} SET {$col2} = {$prof_id} WHERE patient_id = {$patient_id};";
}
else{
	$sql_query = "INSERT INTO {$table} (patient_id, {$col2}) VALUES ({$patient_id},{$prof_id});";
}
	
$result2 = mysqli_query($conn, $sql_query); 

if ($result2){echo "OK";} 
else echo "insertion error";
	

?>  