<?php  
// This script puts a patient's prostate medical data to the database.
// It either creates a new record or updates an existing one. 
require_once "../initDB.php";
// Get POST data...
$id = $_POST["patient_id"];  
$f1 = $_POST["f1"];  
$f2 = $_POST["f2"]; 
$f3 = $_POST["f3"];  
$f4 = $_POST["f4"]; 
$f5 = $_POST["f5"];  
$f6 = $_POST["f6"]; 
$f7 = $_POST["f7"];  
$f8 = $_POST["f8"];

// Create query from POST data.
$sql = "SELECT * FROM prostate_cancer WHERE patient_id = {$id};"; 


$result = mysqli_query($conn, $sql);

if(mysqli_num_rows($result) == 0){
    $sql = "INSERT INTO prostate_cancer (patient_id,f1,f2,f3,f4,f5,f6,f7,f8) VALUES ({$id},{$f1}, {$f2}, {$f3}, {$f4}, {$f5}, {$f6}, {$f7}, {$f8})";
}
else {
    $sql = "UPDATE prostate_cancer SET f1 = {$f1}, f2 = {$f2}, f3 = {$f3}, f4 = {$f4}, f5 = {$f5}, f6 = {$f6}, f7 = {$f7}, f8 = {$f8} WHERE patient_id = {$id};";
}


$result = mysqli_query($conn, $sql);
if ($result == false){
   echo "insertion error";
}
else echo "Insertion success";

?>  