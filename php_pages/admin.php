<?php
/*===============================================================================================
This is the admin page.
================================================================================================*/

// The 'functions' library (contains definitions for Customer class, CartItem class and various functions
// used throughout the application.)
require_once "../php_libs/functions.php";  


session_start();
@$user = $_SESSION["user"];

writeHeader($user); // Write the header which contains a logo, navigation bar and top status bar, etc.

hideElement('home');
hideElement("browse");
$name = "{$user->getFname()} {$user->getLname()}";
echo "</br></br><ul><li><a href = 'http://localhost/phpmyadmin/db_structure.php?server=1&db=mediscreendb' class = 'mediumLine'>Database Admin Page</a></li>";
echo "<li><p class='mediumLine'>Export Medial Data:</p></li>";   

$diabetes = <<<EOF
            <ul>
            <p class = 'mediumLine'>Diabetes:</p>
            <li style="padding: 5px 5px 5px 10px;">
            <form method ="post" action="../php_pages/formHandler.php">
                <input type="hidden"  name="aggregateDiabetes" value="1"> 
                <button type="submit" class='pageBtn' style = 'width:600px;'>Aggregate and export all patient diabetes data to a <b>NEW DATASET</b>.</button>
            </form>
            </li>

            <li style="padding: 5px 5px 5px 10px;">
            <form method = "post" action="../php_pages/formHandler.php">
                <input type="hidden" name="aggregateDiabetes" value='2'> 
                <button type="submit" class='pageBtn' style = 'width:600px;'>Aggregate all patient diabetes data and <b>APPEND TO EXISTING DATASET</b>.</button>
            </form>
            </li>
            </ul>
            </br></br>
        

EOF;

$heart = <<<EOF
            <ul>
            <p class = 'mediumLine'>Heart Disease:</p>
            <li style="padding: 5px 5px 5px 10px;">
            <form method ="post" action="../php_pages/formHandler.php">
                <input type="hidden"  name="aggregateHeart" value="1"> 
                <button type="submit" class='pageBtn' style = 'width:600px;'>Aggregate and export all patient heart disease data to a <b>NEW DATASET</b>.</button>
            </form>
            </li>

            <li style="padding: 5px 5px 5px 10px;">
            <form method = "post" action="../php_pages/formHandler.php">
                <input type="hidden" name="aggregateHeart" value='2'> 
                <button type="submit" class='pageBtn' style = 'width:600px;'>Aggregate all patient heart disease data and <b>APPEND TO EXISTING DATASET</b>.</button>
            </form>
            </li>
            </ul>
            </br></br>

EOF;

$breast = <<<EOF
            <ul>
            <p class = 'mediumLine'>Breast Cancer:</p>
            <li style="padding: 5px 5px 5px 10px;">
            <form method ="post" action="../php_pages/formHandler.php">
                <input type="hidden"  name="aggregateBreast" value="1"> 
                <button type="submit" class='pageBtn' style = 'width:600px;'>Aggregate and export all patient breast cancer data to a <b>NEW DATASET</b>.</button>
            </form>
            </li>

            <li style="padding: 5px 5px 5px 10px;">
            <form method = "post" action="../php_pages/formHandler.php">
                <input type="hidden" name="aggregateBreast" value='2'> 
                <button type="submit" class='pageBtn' style = 'width:600px;'>Aggregate all patient breast cancer data and append to <b>APPEND TO EXISTING DATASET</b>.</button>
            </form>
            </li>
            </ul>
            </br></br>

EOF;

$prostate = <<<EOF
            <ul>
            <p class = 'mediumLine'>Prostate Cancer:</p>
            <li style="padding: 5px 5px 5px 10px;">
            <form method ="post" action="../php_pages/formHandler.php">
                <input type="hidden"  name="aggregateProstate" value="1"> 
                <button type="submit" class='pageBtn' style = 'width:600px;'>Aggregate and export all patient prostate cancer data to a <b>NEW DATASET</b>.</button>
            </form>
            </li>

            <li style="padding: 5px 5px 5px 10px;">
            <form method = "post" action="../php_pages/formHandler.php">
                <input type="hidden" name="aggregateProstate" value='2'> 
                <button type="submit" class='pageBtn' style = 'width:600px;'>Aggregate all patient prostate cancer data and append to <b>APPEND TO EXISTING DATASET</b>.</button>
            </form>
            </li>
            </ul>
            </br></br>

EOF;
echo $diabetes;
echo $heart;
echo $breast;
echo $prostate;
echo "</ul></ul>";
writeFooter();  // Write the page's footer
?>



