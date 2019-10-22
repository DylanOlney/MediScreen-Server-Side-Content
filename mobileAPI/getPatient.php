<?php  
 
require_once "initDB.php";
// Get POST data...
$email = $_POST["email"];  
$password = $_POST["password"];  

// Create query from POST data.
$sql_query = "SELECT * FROM patients WHERE email = '{$email}' AND pword = '{$password}';"; 

if (isset($_POST["id"])){
	$id = $_POST['id'];
 	$sql_query = "SELECT * FROM patients WHERE id = {$id};"; 
 }

$result = mysqli_query($conn, $sql_query);

if(mysqli_num_rows($result) == 0){
	echo "not found";}
else{
    $stmt = $conn->prepare($sql_query);
    //executing the query 
	$stmt->execute();
	
	//binding results to the query 
	$stmt->bind_result($id, $fname, $lname, $mail, $pword, $phone, $dob, $gender ,$history);

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
		$temp['DOB'] = $dob; 
		$temp['GENDER'] = $gender;
        	$temp['HISTORY'] = $history; 
		array_push($results, $temp);
	}
	$stmt->close();
	//displaying the result in json format 
	echo json_encode($results);
}
?>  
