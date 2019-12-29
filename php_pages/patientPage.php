
<?php
/* ============================================================================================
This page gets the patient/client in questiion from the database and displays his/her details.
==============================================================================================*/

require_once "../php_libs/functions.php";
require_once "../php_libs/initDB.php";

session_start();

@$user = $_SESSION["user"];  

writeHeader($user);
$profession = $user->getProfession();

// Query the 'patients' database table for the patient's details and bind the results to some variables. 
// The patients ID was sent as a GET via the url of the page.
$id = $_GET['id'];  
$sql = ("SELECT * from patients WHERE id = {$id}");
$stmt = $conn->prepare($sql);
$stmt->execute();
$stmt->bind_result($id, $fname, $lname, $mail, $pword, $phone, $dob, $gender ,$history);   
$stmt->fetch();
$stmt->close();
$name = "{$fname} {$lname}";
if ($gender="M") $sex = "Male";
else $sex = "Female";


if ($profession=='doctor'){
  $table = "patient_doctor";
}
else  $table = "patient_professional";

$sql = ("SELECT msg from {$table} WHERE patient_id = {$id}");

$result = mysqli_query($conn, $sql);
if(mysqli_num_rows($result) > 0){
$stmt = $conn->prepare($sql);
  $stmt->execute();
  $stmt->bind_result($message);   
  $stmt->fetch();
  $stmt->close();
  $message = str_replace("'","\'", $message);
}





// Query the 'diabetes' table to get the patients diabetes data, again binding the results to some variables.
$sql = ("SELECT * from diabetes WHERE patient_id = {$id}");
$result = mysqli_query($conn, $sql);
if(mysqli_num_rows($result) == 0) $showDiabetesTable = false;
else {
  $stmt = $conn->prepare($sql); 
  $stmt->execute();
  $stmt->bind_result($patientid, $f1, $f2, $f3, $f4, $f5, $f6, $f7 ,$f8, $f9);   
  $stmt->fetch();
  $stmt->close();
  $data = array($f1, $f2, $f3, $f4, $f5, $f6, $f7 ,$f8);
  $showDiabetesTable = true;
}

// Query the 'heart_disease' table to get the patients data, again binding the results to some variables.
$sql = ("SELECT * from heart_disease WHERE patient_id = {$id}");
$result = mysqli_query($conn, $sql);
if(mysqli_num_rows($result) == 0) $showHeartTable = false;
else{
  $stmt = $conn->prepare($sql); 
  $stmt->execute();
  $stmt->bind_result($patientid, $g1, $g2, $g3, $g4, $g5, $g6, $g7 ,$g8,$g9, $g10, $g11, $g12, $g13, $g14);   
  $stmt->fetch();
  $stmt->close();
  $data2 = array($g1, $g2, $g3, $g4, $g5, $g6, $g7 ,$g8,$g9, $g10, $g11, $g12, $g13);
  $showHeartTable = true;
}

$sql = ("SELECT * from breast_cancer WHERE patient_id = {$id}");
$result = mysqli_query($conn, $sql);
if(mysqli_num_rows($result) == 0) $showCancerTable = false;
else{
  $stmt = $conn->prepare($sql); 
  $stmt->execute();
  $stmt->bind_result($patientid, $h1, $h2, $h3, $h4, $h5, $h6, $h7 ,$h8, $h9, $h10);   
  $stmt->fetch();
  $stmt->close();
  $data3 = array($h1, $h2, $h3, $h4, $h5, $h6, $h7 ,$h8, $h9);
  $showCancerTable = true;
}

$sql = ("SELECT * from prostate_cancer WHERE patient_id = {$id}");
$result = mysqli_query($conn, $sql);
if(mysqli_num_rows($result) == 0) $showProstateTable = false;
else {
  $stmt = $conn->prepare($sql); 
  $stmt->execute();
  $stmt->bind_result($patientid, $i1, $i2, $i3, $i4, $i5, $i6, $i7 ,$i8, $i9);   
  $stmt->fetch();
  $stmt->close();
  $data4 = array($i1, $i2, $i3, $i4, $i5, $i6, $i7 , $i8);
  $showProstateTable = true;
}


echo "</br></br><div style = 'padding-left: 20px'><ul>";
echo "<p class = 'mediumLine'><b>{$name}</b></p>";
// Display the patients details as gathered from the first query including the table(s) created above...
$patientTable = <<<EOF
    <li style="padding: 5px 5px 5px 10px;">
      <button class = 'pageBtn'  onclick="toggleHide('patientInfo');">Patient Details (Show/Hide)</button>
      <table  id = 'patientInfo' class = 'smallLine' style = "border-radius: 25px;display:none;width:450px;background-color:#FFDF91;border-collapse:separate; border:5px solid #CCC;">
        <tr><td style="padding: 5px 10px 5px 5px;"><b>Name:</b></td><td style="padding: 5px 10px 5px 25px;">{$name}</td></tr>
        <tr><td style="padding: 5px 10px 5px 5px;"><b>Email:</b></td><td style="padding: 5px 10px 5px 25px;"><a  href = 'mailto:{$mail}'>{$mail}</a></td></tr>
        <tr><td style="padding: 5px 10px 5px 5px;"><b>Phone:</b></td><td style="padding: 5px 10px 5px 25px;"><a  href = 'tel:{$phone}'>{$phone}</a></td></tr>
        <tr><td style="padding: 5px 10px 5px 5px;"><b>DOB:</b></td><td style="padding: 5px 10px 5px 25px;">{$dob}</td></tr>
        <tr><td style="padding: 5px 10px 5px 5px;"><b>Gender:</b></td><td style="padding: 5px 10px 5px 25px;">{$sex}</td></tr>
      </table>
    </li>
EOF;

if ($showDiabetesTable == true) $diabetesTable = <<<EOF
        <table style = "border-radius: 15px;margin-left: 20px;background-color:#FFDF91;border-collapse:separate; border:5px solid #CCC;">
          <tr><th style='float: left;text-decoration: underline;padding-left:15px;'>Diabetes</td></tr>
          <tr><td>Times pregnant:</td><td><b>{$f1}</b></td></tr>
          <tr><td>Plasma glucose concentration:</td><td><b>{$f2}</b></td></tr>
          <tr><td>Diastolic blood pressure (mm Hg):</td><td><b>{$f3}</b></td></tr>
          <tr><td>Triceps skin fold thickness (mm):</td><td><b>{$f4}</b></td></tr>
          <tr><td>2-Hour serum insulin (mu U/ml):</td><td><b>{$f5}</b></td></tr>
          <tr><td>Body mass index :</td><td><b>{$f6}</b></td></tr>
          <tr><td>Diabetes pedigree function:</td><td><b>{$f7}</b></td></tr>
          <tr><td>Age:</td><td><b>{$f8}</b></td></tr>
          <tr><td style='float: right;'>
              <form method = 'post' action="../php_pages/patientPage.php?id={$id}">
                <input type="hidden" name="diabetesRisk" value='diabetesRisk'> 
                <button type="submit" class='pageBtn' style = 'width:200px;'>Estimate Diabetes Risk</button>
              </form>
            </td>
          </tr>
        </table>
EOF;
else $diabetesTable = "<ul><li class = 'smallLine'> No Diabetes Data on record for this patient!</li></ul>";


if ($showHeartTable == true) $heartDiseaseTable = <<<EOF
        <table style = "border-radius: 15px;margin-left: 20px;background-color:#FFDF91;border-collapse:separate; border:5px solid #CCC;">
          <tr><th style='float: left;text-decoration: underline;padding-left:15px;'>Heart Disease</td></tr>
          <tr><td>1. Age:</td><td><b>{$g1}</b></td></tr>
          <tr><td>2. Sex:</td><td><b>{$g2}</b></td></tr>
          <tr><td>3. CP Type (chest pain 1-4):</td><td><b>{$g3}</b></td></tr>
          <tr><td>4. Resting Blood Pressure (mm Hg):</td><td><b>{$g4}</b></td></tr>
          <tr><td>5. Cholesterol (mg/dl):</td><td><b>{$g5}</b></td></tr>
          <tr><td>6. Fasting blood sugar > 120 mg/dl:</td><td><b>{$g6}</b></td></tr>
          <tr><td>7. Rest ecg (1-3):</td><td><b>{$g7}</b></td></tr>
          <tr><td>8. Maximum heart rate achieved:</td><td><b>{$g8}</b></td></tr>
          <tr><td>9. Exercise induced angina:</td><td><b>{$g9}</b></td></tr>
          <tr><td>10. ST depression induced by exercise relative to rest:</td><td><b>{$g10}</b></td></tr>
          <tr><td>11. The slope of the peak exercise ST segment:</td><td><b>{$g11}</b></td></tr>
          <tr><td>12. Number of major vessels (0-3) :</td><td><b>{$g12}</b></td></tr>
          <tr><td>13. thal (3,6 or 8):</td><td><b>{$g13}</b></td></tr>
          <tr><td style='float: right;'>
              <form method = 'post' action="../php_pages/patientPage.php?id={$id}">
                <input type="hidden" name="heartRisk" value='heartRisk'> 
                <button type="submit" class='pageBtn' style = 'width:200px;'>Estimate Heart Risk</button>
              </form>
            </td>
          </tr>
        </table>
EOF;
else $heartDiseaseTable = "<ul><li class = 'smallLine'> No Heart Disease Data on record for this patient!</li></ul>";


if ($showCancerTable == true) $cancerTable = <<<EOF
        <table style = "border-radius: 15px;margin-left: 20px;background-color:#FFDF91;border-collapse:separate; border:5px solid #CCC;">
          <tr><th style='float: left;text-decoration: underline;padding-left:15px;'>Breast cancer</td></tr>
          <tr><td>Clump Thickness (1 - 10):</td><td><b>{$h1}</b></td></tr>
          <tr><td>Uniformity of Cell Size (1 - 10):</td><td><b>{$h2}</b></td></tr>
          <tr><td>Uniformity of Cell Shape (1 - 10):</td><td><b>{$h3}</b></td></tr>
          <tr><td>Marginal Adhesion (1 - 10):</td><td><b>{$h4}</b></td></tr>
          <tr><td>Single Epithelial Cell Size (1 - 10):</td><td><b>{$h5}</b></td></tr>
          <tr><td>Bare Nuclei (1 - 10):</td><td><b>{$h6}</b></td></tr>
          <tr><td>Bland Chromatin (1 - 10):</td><td><b>{$h7}</b></td></tr>
          <tr><td>Normal Nucleoli (1 - 10):</td><td><b>{$h8}</b></td></tr>
          <tr><td>Mitoses (1 - 10):</td><td><b>{$h9}</b></td></tr>
          <tr><td style='float: right;'>
              <form method = 'post' action="../php_pages/patientPage.php?id={$id}">
                <input type="hidden" name="cancerRisk" value='cancerRisk'> 
                <button type="submit" class='pageBtn' style = 'width:200px;'>Estimate Breast Cancer Risk</button>
              </form>
            </td>
          </tr>
        </table>
EOF;
else $cancerTable = "<ul><li class = 'smallLine'> No Breast Cancer Data on record for this patient!</li></ul>";


if ($showProstateTable == true) $prostateTable = <<<EOF
        <table style = "border-radius: 15px;margin-left: 20px;background-color:#FFDF91;border-collapse:separate; border:5px solid #CCC;">
          <tr><th style='float: left;text-decoration: underline;padding-left:15px;'>Prostate Cancer</td></tr>
          <tr><td>Radius:</td><td><b>{$i1}</b></td></tr>
          <tr><td>Texture:</td><td><b>{$i2}</b></td></tr>
          <tr><td>Perimeter:</td><td><b>{$i3}</b></td></tr>
          <tr><td>Area:</td><td><b>{$i4}</b></td></tr>
          <tr><td>Smoothness:</td><td><b>{$i5}</b></td></tr>
          <tr><td>Compactness:</td><td><b>{$i6}</b></td></tr>
          <tr><td>Symmetry:</td><td><b>{$i7}</b></td></tr>
          <tr><td>Fractal Dimension:</td><td><b>{$i8}</b></td></tr>
          <tr><td style='float: right;'>
              <form method = 'post' action="../php_pages/patientPage.php?id={$id}">
                <input type="hidden" name="prostateRisk" value='prostateRisk'> 
                <button type="submit" class='pageBtn' style = 'width:200px;'>Estimate Prostate Cancer Risk</button>
              </form>
            </td>
          </tr>
        </table>
EOF;
else $prostateTable = "<ul><li class = 'smallLine'> No Prostate Data on record for this patient!</li></ul>";


$mediAI = <<<EOF
  <li style="padding: 5px 5px 5px 10px;">  
  <button class = 'pageBtn'  onclick="toggleHide('box');">Medi-AI (Show/Hide)</button>
    <div  id="box" style="padding-top: 25px;border-radius: 25px;display:none;height:300px;width:500px;border:5px solid #ccc;font:16px/26px Georgia, Garamond, Serif;overflow:auto;
      background-color:white;color:black;scrollbar-base-color:gold;font-family:sans-serif;">
      {$diabetesTable}
      </br>
      {$heartDiseaseTable}
      </br>
      {$cancerTable}
      </br>
      {$prostateTable}
      </br>
    </div>
  </li>
EOF;

echo $patientTable;
echo $mediAI;


if ($profession=='insurance'){
  
  echo  <<<EOF
      <li style="padding: 5px 5px 5px 10px;">
        <button class = 'pageBtn'  onclick="toggleHide('textInput');">Submit/Edit Report (Show/Hide)</button>
        <form method = 'post' action="../php_pages/formHandler.php">
          <input type="hidden" name="patientID" value='{$id}'> 
          <table id="textInput" style = "border-radius: 25px;display:none;height:275px;width:450px;background-color:#FFDF91;border-collapse:separate; border:5px solid #CCC;">
            <tr><th style='float: left;padding-left:15px'>Client Report:</th></tr>
            <tr><td style='float: left;padding-left:15px'>(Please include risk levels for all known categories)<td></tr>
            <tr><td><textarea id = 'insuranceReport' name = 'insuranceReport' style = "height:140px;width:410px;margin-left:10px;"></textarea></td></tr>
            <tr><td><button type="submit" class='btn' style = 'width:100px;float: right;'>Submit</button></td></tr>
          </table>
        </form>
      </li>  

    <li style="padding: 5px 5px 5px 10px;">
      <button class = 'pageBtn'  onclick="toggleHide('readOnlyReport');">Doctor's Report (Show/Hide)</button>
      <table id="readOnlyReport" style = "border-radius: 25px;display:none;height:225px;width:450px;background-color:#FFDF91;border-collapse:separate; border:5px solid #CCC;">
        <tr><th style='float: left;padding-left:15px;text-decoration: underline;'>Doctor's Report:</th></tr>
        <tr><td><span id = 'docName' style='padding-left:15px;'> </span><td></tr>
        <tr><td><textarea readonly id = 'docReport'  style = "height:140px;width:410px;margin-left:10px;"></textarea><td></tr>
      </table>
    </li>
    </br></br>
EOF;

  $sql = "SELECT risk_report FROM patient_professional WHERE patient_id = {$id}";
  $stmt = $conn->prepare($sql); 
  $stmt->execute();
  $stmt->bind_result($text);   
  $stmt->fetch();
  $stmt->close();
  $text = str_replace("'","\'", $text);
  elementInnerText("insuranceReport", "{$text}");


  $sql = "SELECT doc_id, risk_report  FROM patient_doctor WHERE patient_id = {$id}";
  $stmt = $conn->prepare($sql); 
  $stmt->execute();
  $stmt->bind_result($doc_id, $text);   
  $stmt->fetch();
  $stmt->close();
  $text = str_replace("'","\'", $text);
  $sql = "SELECT fname, lname  FROM doctors WHERE id = {$doc_id}";
  $stmt = $conn->prepare($sql); 
  $stmt->execute();
  $stmt->bind_result($x, $y);   
  $stmt->fetch();
  $stmt->close();
  $doc_name = "Dr. {$x} {$y}";
  elementInnerText("docName", "Submitted by {$doc_name}.");
  elementInnerText("docReport", "{$text}");
}

if ($profession=='doctor'){
  echo  <<<EOF
    <li style="padding: 5px 5px 5px 10px;">
      <button class = 'pageBtn'  onclick="toggleHide('textInput');">Submit/Edit Report (Show/Hide)</button>
      <form method = 'post' action="../php_pages/formHandler.php">
        <input type="hidden" name="patientID" value='{$id}'> 
        <table id="textInput" style = "border-radius: 25px;display:none;height:275px;width:450px;background-color:#FFDF91;border-collapse:separate; border: 1px solid black;">
          <tr><th style='float: left;'><span style = 'padding-left:15px;text-decoration: underline;'>Patient Report:</span></th></tr>
          <tr><td><span style='text-decoration: none;padding-left:15px'> (Please include risk levels for all known categories)</span><td></tr>
          <tr><td><textarea id = 'doctorsReport' name = 'doctorsReport' style = "height:140px;width:410px;margin-left:10px;"></textarea></td></tr>
          <tr><td><button type="submit" class='btn' style = 'width:100px;float: right;'>Submit</button></td></tr>
          </table>
      </form>
    </li>
EOF;


  $sql = "SELECT risk_report FROM patient_doctor WHERE patient_id = {$id}";
  $stmt = $conn->prepare($sql); 
  $stmt->execute();
  $stmt->bind_result($text);   
  $stmt->fetch();
  $stmt->close();
  $text = str_replace("'","\'", $text);
  elementInnerText("doctorsReport", "{$text}");
}

if ($message == "") $message = "No messages!";
else $message = "From {$fname} {$lname}:\n\n{$message}";
$patterns = array("/\\\\/", '/\n/', '/\r/', '/\t/', '/\v/', '/\f/');
$replacements = array('\\\\\\', '\n', '\r', '\t', '\v', '\f');
$message = preg_replace($patterns, $replacements, $message);
echo  <<<EOF
<li style="padding: 5px 5px 5px 10px;">
 <button class = 'pageBtn'  onclick='alert("{$message}");'>Latest E-mail sent via app.</button>
</li>
EOF;


echo "</div></ul>";


if (isset($_GET['report'])){
  displayElement('reportSubmitted');
}

echo "</ul>";
if ($profession == "doctor") $str = "Patient: ";
else $str = "Client: ";
addNavbarLink ( "{$str}{$name}","",true, "artist");  // Update the navigation bar




// This block of code is executed when the user clicks the 'Show diabetes risk' button in the HTML table in the above code.
// The patient's risk is determined by posting his/her data to the Medi-AI service which is a Python 'Flask' webs service which
// determines the risk via Python AI libraries.
if (isset($_POST['diabetesRisk'])){
  $result = AI_getRisk($data, "http:/127.0.0.1:5000/predictdiabetes");   // Posting the data to the webservice URL.
  $risk  = $result['probability'] * 100;
  $bool = $result['binary'];
  $accuracy = AI_getAccuracy("http:/127.0.0.1:5000/diabetesModelAccuracy");   // This URL reports the accuracy of the AI model.
  
  // If the service responded, the '$accuracy' variable will not be null and we can show the results...
  if (isset($accuracy)){
    elementInnerText('riskMessage',"Based on the data, our AI model has estimated that the probability of this patient developing diabetes within the next five years is:");
    elementInnerText('riskPercentage',"{$risk}%");
    elementInnerText('accracyMessage',"(AI model accuracy = {$accuracy}%)");
    $sql = "UPDATE diabetes SET f9 = {$bool} WHERE patient_id = {$id};";
    if (!mysqli_query($conn, $sql)){
      msgBox('error writing to database.');
    }
  } 
  else { // If it didn't respond, display a message conveying this..
    elementInnerText('riskMessage','The Medi-AI service did not respond. The server appears to be offline. Unable to display patient risk data!');
  }
  displayElement('patientRisk');
}



if (isset($_POST['heartRisk'])){
  $result = AI_getRisk($data2, "http:/127.0.0.1:5000/predictHeartDisease");   // Posting the data to the webservice URL.
  $risk  = $result['probability'] * 100;
  $bool = $result['binary'];
  $accuracy = AI_getAccuracy("http:/127.0.0.1:5000/heartDiseaseModelAccuracy");   // This URL reports the accuracy of the AI model.
  
  // If the service responded, the '$accuracy' variable will not be null and we can show the results...
  if (isset($accuracy)){
    elementInnerText('riskMessage',"Based on the data, our AI model has estimated that the probability of this patient of having heart disease is:");
    elementInnerText('riskPercentage',"{$risk}%");
    elementInnerText('accracyMessage',"(AI model accuracy = {$accuracy}%)");
    $sql = "UPDATE heart_disease SET f14 = {$bool} WHERE patient_id = {$id};";
    if (!mysqli_query($conn, $sql)){
      msgBox('error writing to database.');
    }
  } 
  else { // If it didn't respond, display a message conveying this..
    elementInnerText('riskMessage','The Medi-AI service did not respond. The server appears to be offline. Unable to display patient risk data!');
  }
  displayElement('patientRisk');
}


if (isset($_POST['cancerRisk'])){
  $result = AI_getRisk($data3, "http:/127.0.0.1:5000/predictBreastCancer");   // Posting the data to the webservice URL.
  $risk  = $result['probability'] * 100;
  $bool = $result['binary'];
  $accuracy = AI_getAccuracy("http:/127.0.0.1:5000/breastCancerModelAccuracy");   // This URL reports the accuracy of the AI model.
  
  // If the service responded, the '$accuracy' variable will not be null and we can show the results...
  if (isset($accuracy)){
    elementInnerText('riskMessage',"Based on the data, our AI model has estimated that the probability of this patient having a malignant tumour is:");
    elementInnerText('riskPercentage',"{$risk}%");
    elementInnerText('accracyMessage',"(AI model accuracy = {$accuracy}%)");
    $sql = "UPDATE breast_cancer SET f10 = {$bool} WHERE patient_id = {$id};";
    if (!mysqli_query($conn, $sql)){
      msgBox('error writing to database.');
    }
  } 
  else { // If it didn't respond, display a message conveying this..
    elementInnerText('riskMessage','The Medi-AI service did not respond. The server appears to be offline. Unable to display patient risk data!');
  }
  displayElement('patientRisk');
}


if (isset($_POST['prostateRisk'])){
  $result = AI_getRisk($data4, "http:/127.0.0.1:5000/predictProstateCancer");   // Posting the data to the webservice URL.
  $risk  = $result['probability'] * 100;
  $bool = $result['binary'];
  $accuracy = AI_getAccuracy("http:/127.0.0.1:5000/prostateModelAccuracy");   // This URL reports the accuracy of the AI model.
  
  // If the service responded, the '$accuracy' variable will not be null and we can show the results...
  if (isset($accuracy)){
    elementInnerText('riskMessage',"Based on the data, our AI model has estimated that the probability of this patient having a malignant tumour is:");
    elementInnerText('riskPercentage',"{$risk}%");
    elementInnerText('accracyMessage',"(AI model accuracy = {$accuracy}%)");
    $sql = "UPDATE prostate_cancer SET f9 = {$bool} WHERE patient_id = {$id};";
    if (!mysqli_query($conn, $sql)){
      msgBox('error writing to database.');
    }
  } 
  else { // If it didn't respond, display a message conveying this..
    elementInnerText('riskMessage','The Medi-AI service did not respond. The server appears to be offline. Unable to display patient risk data!');
  }
  displayElement('patientRisk');
}


writeFooter();  

?>



