<?php  
// This script gets a patient's prostate medical details from the dtabase if a record exists.
require_once "../initDB.php";

// Get POST data...
$id = $_POST["patient_id"];  
 

// Create query from POST data.
$sql_query = "SELECT * FROM prostate_cancer WHERE patient_id = {$id};"; 


$result = mysqli_query($conn, $sql_query);

if(mysqli_num_rows($result) == 0){
	echo "not found";}
else{
    $stmt = $conn->prepare($sql_query); 
    $stmt->execute();
    $stmt->bind_result($patientid, $f1, $f2, $f3, $f4, $f5, $f6, $f7 ,$f8, $f9);   
    $stmt->fetch();
    $stmt->close();
    $results = array($f1, $f2, $f3, $f4, $f5, $f6, $f7 ,$f8, $f9);
    echo json_encode($results);
}
?>  