<?php  
 
require_once "initDB.php";
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
$f9 = $_POST["f9"];  


// Create query from POST data.
$sql = "SELECT * FROM breast_cancer WHERE patient_id = {$id};"; 


$result = mysqli_query($conn, $sql);

if(mysqli_num_rows($result) == 0){
    $sql = "INSERT INTO breast_cancer (f1,f2,f3,f4,f5,f6,f7,f8,f9) VALUES ({$id}, {$f1}, {$f2}, {$f3}, {$f4}, {$f5}, {$f6}, {$f7}, {$f8}, {$f9})";
}
else {
    $sql = "UPDATE breast_cancer SET f1 = {$f1}, f2 = {$f2}, f3 = {$f3}, f4 = {$f4}, f5 = {$f5}, f6 = {$f6}, f7 = {$f7}, f8 = {$f8}, f9 = {$f9} WHERE patient_id = {$id};";
}


$result = mysqli_query($conn, $sql);
if ($result == false){
   echo "insertion error";
}
else echo "Insertion success";

?>  