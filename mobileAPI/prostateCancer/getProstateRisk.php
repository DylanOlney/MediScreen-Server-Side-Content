<?php
// This script gets the patient's prostate risk from the AI service based on medical data posted
require_once "../AI_functions.php";
$id = $_POST["patient_id"];  
$f1 = $_POST["f1"];  
$f2 = $_POST["f2"]; 
$f3 = $_POST["f3"];  
$f4 = $_POST["f4"]; 
$f5 = $_POST["f5"];  
$f6 = $_POST["f6"]; 
$f7 = $_POST["f7"];  
$f8 = $_POST["f8"];

$data = array($f1, $f2, $f3, $f4, $f5, $f6, $f7 ,$f8);

$result = AI_getRisk($data, "http:/127.0.0.1:5000/predictProstateCancer");   // Posting the data to the webservice URL.
$risk  = $result['probability'] * 100;
$bool = $result['binary'];
$accuracy = AI_getAccuracy("http:/127.0.0.1:5000/prostateModelAccuracy");   // This URL reports the accuracy of the AI model.


echo "{$risk},{$bool},{$accuracy}"

?>


