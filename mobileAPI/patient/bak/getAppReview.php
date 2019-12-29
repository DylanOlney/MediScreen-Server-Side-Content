<?php  
 
require_once "../initDB.php";
// Get POST data...



$id = $_POST['id'];

$sql_query = "SELECT app_rating FROM patients WHERE id = {$id};"; 
$result = mysqli_query($conn, $sql_query);
if(mysqli_num_rows($result) == 0){
	echo "not found";
}
else {
	$stmt = $conn->prepare($sql_query);
	$stmt->execute();
	$stmt->bind_result($rating);
	$stmt->fetch();
	$stmt->close();
	echo $rating;
}





?>  