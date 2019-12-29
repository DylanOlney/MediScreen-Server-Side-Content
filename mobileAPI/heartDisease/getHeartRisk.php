<?php

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
$f9 = $_POST["f9"];  
$f10 = $_POST["f10"]; 
$f11 = $_POST["f11"];  
$f12 = $_POST["f12"];
$f13 = $_POST["f13"];

$data = array($f1, $f2, $f3, $f4, $f5, $f6, $f7 ,$f8 ,$f9 ,$f10 ,$f11 ,$f12 , $f13);

$result = AI_getRisk($data, "http:/127.0.0.1:5000/predictHeartDisease");   // Posting the data to the webservice URL.
$risk  = $result['probability'] * 100;
$bool = $result['binary'];
$accuracy = AI_getAccuracy("http:/127.0.0.1:5000/heartDiseaseModelAccuracy");   // This URL reports the accuracy of the AI model.


echo "{$risk},{$bool},{$accuracy}"

?>


