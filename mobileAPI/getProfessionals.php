<?php  
 
require_once "initDB.php";

if (isset($_POST["doctors"])){
	$table = "doctors";
}
elseif (isset($_POST["insurance_professionals"])){
	$table = "insurance_professionals";
}
else die();

// Create query from POST data.
$sql_query = "SELECT * FROM {$table} ;"; 


$result = mysqli_query($conn, $sql_query);

if(mysqli_num_rows($result) == 0){
	echo "none found";}
else{
    $stmt = $conn->prepare($sql_query);
    //executing the query 
	$stmt->execute();
	
	//binding results to the query 
	$stmt->bind_result($id, $fname, $lname, $mail, $pword, $phone);
	
	$results = array(); 
	
	//traversing through the resultset
	while($stmt->fetch()){
		$temp = array();
		$temp['ID'] = $id; 
		$temp['FNAME'] = $fname; 
		$temp['LNAME'] = $lname; 
		$temp['EMAIL'] = $mail; 
		$temp['PWORD'] = $pword; 
        $temp['PHONE'] = $phone; 
		array_push($results, $temp);
	}
	$stmt->close();
	//displaying the result in json format 
	echo json_encode($results);
}
?>  