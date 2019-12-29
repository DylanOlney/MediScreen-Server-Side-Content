<?php  
 
require_once "../initDB.php";

$patient_id = $_POST["patient_id"];

if (isset($_POST["profession"])){
	if ($_POST["profession"]=="doctor") {
		$prof = "patient_doctor";
	}
	else {
		$prof = "patient_professional";
	}
	$risk_report  = "risk_report";
}

else die();

// Create query from POST data.
$sql_query = "SELECT {$risk_report} FROM {$prof} WHERE patient_id = {$patient_id};"; 

$result = mysqli_query($conn, $sql_query);

if(mysqli_num_rows($result) == 0){
	echo "none found";}
else{

    $stmt = $conn->prepare($sql_query);
	$stmt->execute();
	$stmt->bind_result($report);
	$stmt->fetch();
	$stmt->close();

    echo $report;
}
?>  