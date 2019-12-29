<?php
// This page doesn't contain any visual material. It is the 'action page' for
// many of the forms in the application. It's function is to provide
// 'if' statements which test the parameters passed on by the submission of the
// various forms and then carry out the appropriate action before returning to the home page.

require_once "../php_libs/functions.php";
require_once "../php_libs/initDB.php";
session_start();
@$user = $_SESSION["user"];

$homepage = "Location: ../php_pages/index.php";
$adminpage = "Location: ../php_pages/admin.php";


// Handles the submission of the 'signUp' form.
// It persists new users's details to the database,
// creates a new User object based on user's details and
// logs user in as either a doctor or an insurance professional.
if (isset($_POST["signUp"])){
    if (isset($user)){return;}
    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $lname =  str_replace("'","\'", $lname);
    $email = $_POST["email"];
    $pword = $_POST["pword"];
    $phone = $_POST["phone"];
    $profession = $_POST["profession"];
    
     $sql1 = <<<EOF
     INSERT INTO doctors (fname,lname,email,pword,phone)
     VALUES ('{$fname}','{$lname}','{$email}','{$pword}','{$phone}');
EOF;
     $sql2 = <<<EOF
     INSERT INTO insurance_professionals (fname,lname,email,pword,phone)
     VALUES ('{$fname}','{$lname}','{$email}','{$pword}','{$phone}');
EOF;
    if ($profession == 'doctor') $sql3 = $sql1;
    else $sql3 = $sql2;
    
    if (!mysqli_query($conn, $sql3)){
        msgBox('error writing to database.');
        die();
    }

    $id =  mysqli_insert_id($conn);
   
    $user = new User($fname,$lname,$email,$pword,$phone,$profession);
    $user->setID($id);
    $user->setIsNew(true);
    $_SESSION["user"] = $user;
    header($homepage);
}



// Handles the submission of the 'signIn' form.
// It searches both the doctors and insrance_profs database tables for the submitted user name and password.
// If not found, it displays an invalid log in message. Otherwise, it creates a User object 
// from the details read from the database and the User is logged in.
if (isset($_POST["signIn"])){
    if (isset($user)){return;}
    $email = $_POST["email"];
    $password = $_POST["pword"];
    
    $sql_query1 = "SELECT * FROM doctors WHERE email = '{$email}' AND pword = '{$password}';"; 
    $sql_query2 = "SELECT * FROM insurance_professionals WHERE email = '{$email}' AND pword = '{$password}';"; 
    $sql_query3 = "SELECT * FROM admins WHERE email = '{$email}' AND pword = '{$password}';"; 
    
    $result = mysqli_query($conn, $sql_query1);
    if(mysqli_num_rows($result) == 0){
          $result = mysqli_query($conn, $sql_query2);
          if(mysqli_num_rows($result) == 0){
                $result = mysqli_query($conn, $sql_query3);
                if(mysqli_num_rows($result) == 0){
                    msgBox("Username and/or password is not correct!");
                    goBack();
                    exit();
                }
                else {
                    $stmt = $conn->prepare($sql_query3);
                    $profession = "admin"; 
                }
                
          }
          else {
            $stmt = $conn->prepare($sql_query2);
            $profession = "insurance";
          }
    }
    else {
        $stmt = $conn->prepare($sql_query1);
        $profession = "doctor";
    }

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
    
    $data = $results[0];
    $user = new User($data['FNAME'],$data['LNAME'],$data['EMAIL'],$data['PWORD'],$data['PHONE'],$profession);
    $user->setID($data['ID']);
    $_SESSION["user"] = $user;
    
    if ($profession=='admin'){
        header($adminpage);
    }
    else header($homepage);
}



// Handles the search button click.
if (isset($_POST["search"])){
     $str = $_POST["search"];
     callback("search={$str}");  // Calls the calling page, updating its URL's parameters with the search string.
     // The calling page then diplays a 'searchType' dialog in which the user can specify the type of search to perform.
     // The 'searchType' dialog submission is in turn handled by the calling page.
 }

 
// Handles the logout confrimation dialog submission.
// Logs a customer out by setting the User object to null and then goes back to the home page.
if (isset($_POST["logout"])){
    $_SESSION["user"] = null;
    $user = null;
    header($homepage);
}


// Updates insurance report submission.
if (isset($_POST["insuranceReport"])){
    $text = $_POST["insuranceReport"];
    $text = str_replace("'","\'", $text);
    $id = $_POST['patientID'];
    $sql = "UPDATE patient_professional SET risk_report = '{$text}' WHERE patient_id = {$id};";
    if (!mysqli_query($conn, $sql)){
        msgBox('error writing to database.');
        die();
    }
    callback("report=1");
}


// Updates doctor's report submission.
if (isset($_POST["doctorsReport"])){
    $text = $_POST["doctorsReport"];
    $text = str_replace("'","\'", $text);
    $id = $_POST['patientID'];
    $sql = "UPDATE patient_doctor SET risk_report = '{$text}' WHERE patient_id = {$id};";
    if (!mysqli_query($conn, $sql)){
        msgBox('error writing to database.');
        die();
    }
    callback("report=1");
}



// ===============================================================================================================================
// The remaining blocks have to do with the aggregation medical data into new or existing datasets by the administrator.


if (isset($_POST["aggregateDiabetes"])){
    $sql = "SELECT * FROM diabetes"; 
    $stmt = $conn->prepare($sql); 
    $stmt->execute();
    $stmt->bind_result($patientid, $f1, $f2, $f3, $f4, $f5, $f6, $f7 ,$f8, $f9);   
    $results = array(); 
   
    //traversing through the resultset
    while($stmt->fetch()){
       
        $temp = array();
        if ($f9 != null) {
            $temp[0] = $f1; 
            $temp[1] = $f2; 
            $temp[2] = $f3; 
            $temp[3] = $f4; 
            $temp[4] = $f5; 
            $temp[5] = $f6; 
            $temp[6] = $f7; 
            $temp[7] = $f8; 
            $temp[8] = $f9; 
            array_push($results, $temp);
        }
    }
    $json =  json_encode($results);
    if ($_POST['aggregateDiabetes']==1){
        $url = "http:/127.0.0.1:5000/newDiabetesDataset";
    }
    elseif ($_POST['aggregateDiabetes']==2) {
        $url = "http:/127.0.0.1:5000/appendDiabetesDataset";
    }
    else die();

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
    curl_exec($ch);
    curl_close($ch);
    download_file("../medi_ai/exportedDatasets/diabetes/diabetes.csv");
}


if (isset($_POST["aggregateHeart"])){
    $sql = "SELECT * FROM heart_disease"; 
    $stmt = $conn->prepare($sql); 
    $stmt->execute();
    $stmt->bind_result($patientid, $f1, $f2, $f3, $f4, $f5, $f6, $f7 ,$f8, $f9, $f10 , $f11, $f12, $f13, $f14);   
    $results = array(); 
   
    //traversing through the resultset
    while($stmt->fetch()){
       
        $temp = array();
        if ($f14 != null) {
            $temp[0] = $f1; 
            $temp[1] = $f2; 
            $temp[2] = $f3; 
            $temp[3] = $f4; 
            $temp[4] = $f5; 
            $temp[5] = $f6; 
            $temp[6] = $f7; 
            $temp[7] = $f8; 
            $temp[8] = $f9; 
            $temp[9] = $f10;
            $temp[10] = $f11;
            $temp[11] = $f12;
            $temp[12] = $f13;
            $temp[13] = $f14;
            array_push($results, $temp);
        }
    }
    $json =  json_encode($results);
    if ($_POST['aggregateHeart']==1){
        $url = "http:/127.0.0.1:5000/newHeartDataset";
    }
    elseif ($_POST['aggregateHeart']==2) {
        $url = "http:/127.0.0.1:5000/appendHeartDataset";
    }
    else die();

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
    curl_exec($ch);
    curl_close($ch);
    download_file("../medi_ai/exportedDatasets/heartDisease/heartDisease.csv");
}

if (isset($_POST["aggregateBreast"])){
    $sql = "SELECT * FROM breast_cancer ;"; 
    $stmt = $conn->prepare($sql); 
    $stmt->execute();
    $stmt->bind_result($patientid, $f1, $f2, $f3, $f4, $f5, $f6, $f7 ,$f8, $f9, $f10);   
    $results = array(); 
   
    //traversing through the resultset
    while($stmt->fetch()){
       
        $temp = array();
        if ($f10 != null) {
            $temp[0] = $f1; 
            $temp[1] = $f2; 
            $temp[2] = $f3; 
            $temp[3] = $f4; 
            $temp[4] = $f5; 
            $temp[5] = $f6; 
            $temp[6] = $f7; 
            $temp[7] = $f8; 
            $temp[8] = $f9; 
            $temp[9] = $f10;
            array_push($results, $temp);
        }
    }
    $json =  json_encode($results);
    if ($_POST['aggregateBreast']==1){
        $url = "http:/127.0.0.1:5000/newBreastDataset";
    }
    elseif ($_POST['aggregateBreast']==2) {
        $url = "http:/127.0.0.1:5000/appendBreastDataset";
    }
    else die();

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
    curl_exec($ch);
    curl_close($ch);
    download_file("../medi_ai/exportedDatasets/breastCancer/breastCancer.csv");
}

if (isset($_POST["aggregateProstate"])){
    $sql = "SELECT * FROM prostate_cancer ;"; 
    $stmt = $conn->prepare($sql); 
    $stmt->execute();
    $stmt->bind_result($patientid, $f1, $f2, $f3, $f4, $f5, $f6, $f7 ,$f8, $f9);   
    $results = array(); 
   
    //traversing through the resultset
    while($stmt->fetch()){
       
        $temp = array();
        if ($f9 != null) {
            $temp[0] = $f1; 
            $temp[1] = $f2; 
            $temp[2] = $f3; 
            $temp[3] = $f4; 
            $temp[4] = $f5; 
            $temp[5] = $f6; 
            $temp[6] = $f7; 
            $temp[7] = $f8; 
            $temp[8] = $f9; 
            array_push($results, $temp);
        }
    }
    $json =  json_encode($results);
    if ($_POST['aggregateProstate']==1){
        $url = "http:/127.0.0.1:5000/newProstateDataset";
    }
    elseif ($_POST['aggregateDiabetes']==2) {
        $url = "http:/127.0.0.1:5000/appendProstateDataset";
    }
    else die();

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
    curl_exec($ch);
    curl_close($ch);
    download_file("../medi_ai/exportedDatasets/prostateCancer/prostate.csv");
}

?>