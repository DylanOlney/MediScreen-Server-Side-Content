<?php  
 
require_once "initDB.php";
// Get POST data...
$id = $_POST["patient_id"];  
 

// Create query from POST data.
$sql_query = "SELECT * FROM heart_disease WHERE patient_id = {$id};"; 


$result = mysqli_query($conn, $sql_query);

if(mysqli_num_rows($result) == 0){
	echo "not found";}
else{
    $stmt = $conn->prepare($sql_query); 
    $stmt->execute();
    $stmt->bind_result($patientid, $f1, $f2, $f3, $f4, $f5, $f6, $f7 ,$f8, $f9, $f10, $f11 ,$f12, $f13, $f14);   
    $stmt->fetch();
    $stmt->close();
    $results = array($f1, $f2, $f3, $f4, $f5, $f6, $f7 ,$f8, $f9, $f10 ,$f11, $f12,$f13, $f14);
    echo json_encode($results);
}
?>  