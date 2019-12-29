
<?php

/*======================================================================================================================================= 
This page lists out all the patients/clients of a particular professional found in the database as hyperlinks to their respective pages. 
==========================================================================================================================================*/


require_once "../php_libs/functions.php";
require_once "../php_libs/initDB.php";
session_start();
@$user = $_SESSION["user"];


writeHeader($user);

setLinkActive ('browse');


$profession = $user->getProfession();
$id = $user->getID();


if ($profession=='doctor'){
        $clientType = 'patient';
        $sql = "SELECT id, fname, lname FROM patients JOIN patient_doctor ON patient_id = id where patient_doctor.doc_id = {$id} ";
        echo "</br></br><p class='mediumLine'><b>Your Patients:</b></p>";
}
else {
        $clientType = 'client';
        $sql = "SELECT id, fname, lname FROM patients INNER JOIN patient_professional ON patient_id = id where patient_professional.prof_id = {$id}"; 
        echo "</br></br><p class='mediumLine'><b>Your Clients:</b></p>"; 
}
   
$stmt = $conn->prepare($sql);
$stmt->execute();
$stmt->bind_result($patientID,$fname,$lname);

// Loop through the result set of the table and create links.
echo "<ul>";
$flag = 0;
while($stmt->fetch()){
        $str = "{$fname} {$lname}";
        //echo  "<li><a class = 'smallLine' href = 'patientPage.php?id={$patientID}'>{$str}</a></li>"; 
        $html = <<<EOF
        <li><button class = 'pageBtn'  onclick="window.location.href = 'patientPage.php?id={$patientID}';">{$str}</button></li> 
EOF;
        echo $html;
        $flag ++;
}
$stmt->close();


if ($flag==0){
        echo  "<li class = 'mediumLine'>You have no Medi-Screen {$clientType}s yet!</li>";
        echo  "<li class = 'mediumLine'>They will show up here as soon they register with you via their mobile app!</li>";
}
echo "</ul>";


writeFooter();   
?>





