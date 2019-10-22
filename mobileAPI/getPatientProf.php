<?php  
 
require_once "initDB.php";

$patient_id = $_POST["patient_id"];

if (isset($_POST["profession"])){
	if ($_POST["profession"]=="doctor") {
		$table1 = "patient_doctor";
		$table2 = "doctors";
		$col2  = "doc_id";
	}
	else {
		$table1 = "patient_professional";
		$table2 = "insurance_professionals";
		$col2 = "prof_id";
	}
}

else die();

// Create query from POST data.
$sql_query = "SELECT {$col2} FROM {$table1} WHERE patient_id = {$patient_id};"; 

$result = mysqli_query($conn, $sql_query);

if(mysqli_num_rows($result) == 0){
	echo "none found";}
else{

    $stmt = $conn->prepare($sql_query);
	$stmt->execute();
	$stmt->bind_result($idprof);
	$stmt->fetch();
	$stmt->close();

	$sql_query = "SELECT * FROM {$table2} WHERE id = {$idprof};"; 
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