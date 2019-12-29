

<?php

// This function uses CURL to post a row of numerical medical data to the Flask AI service and get the result.
function AI_getRisk($data, $url){
    $values = array("data" => $data);
    $json =  json_encode($values);
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
    $response = curl_exec($ch);
    curl_close($ch);
    $result =  json_decode($response, true);
    return $result;
} 

// This function returns the model accuracy from the Flask AI service.
function AI_getAccuracy($url){
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, null);
    $response = curl_exec($ch);
    curl_close($ch);
    $result =  json_decode($response, true);
    $accuracy = $result['accuracy'];
    return $accuracy;
}


?>


