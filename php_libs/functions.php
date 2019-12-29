<?php


// This function is called at the start of every page to write the header-------------------------------------------------------

function writeHeader(&$user){
    echoHtml("../html/header.html");
    echoHtml("../html/dialogs.html");

    $_SESSION['pagecount'] = 1;

    if (isset($user)){
       
        $fname = $user->getFname();
        $lname = $user->getLname();
        $profession = $user->getProfession();

        hideElement("signupLink");
        
        if ($profession=="doctor"){
            elementInnerText ('browse' , "Browse Patients");
        }
        else elementInnerText ('browse' , "Browse Clients");
       
        elementInnerText ('userText' , "{$fname} {$lname} [{$profession}]");
       
        elementInnerText ('loginLink' , 'Log Out');
        setOnClick ('loginLink', 'logOutDialog');  
       

        if (!$user->isSignedIn()){
            $user->signIn();
            hideElement('logInForm');
            displayElement('loggedInForm');
            if ($profession=="doctor") $temp = "a doctor";
            else $temp = "an insurance professional";
            elementInnerText ('loginName' , "Welcome {$fname} {$lname}, you have successfuly logged in to Medi-Screen as {$temp}.");
            if ($user->getIsNew()) {
                displayElement('registeredOK');
                $user->setIsNew(false);
            }
            else  displayElement('logInDialog');
        }
        
    }

    // Dislays a 'search type' modal dialog over the page if the 'search' parameter is set in the URL'
    // i.e. if the user has clicked the search button.
    if (isset($_GET['search'])){
        
        $search = $_GET["search"];
        echo <<<EOF
        <div id="searchTypeDialog" class="modal">
            <form method="get" class="modal-content animate" action="search.php">
                <div class="imgcontainer">
                    <span onclick="document.getElementById('searchTypeDialog').style.display='none'" class="close" title="Close Modal">&times;</span>
                </div>
                </br></br></br></br>
                <p class = 'smallLine'>Search for this term, <b>'{$search}'</b> from:</p>
                <input type="radio" name="searchType" value="artists" checked="checked"><span class = 'smallLine'> Artists</span></br>
                <input type="radio" name="searchType" value="artwork"><span class = 'smallLine'>Artworks</span></br>
                <input type="radio" name="searchType" value="genre"><span class = 'smallLine'>Genre or Medium</span></br>
                <input type="hidden" name="searchString" value="{$search}"></br>
                <input type = 'submit' value = 'GO'>
            </form>
        </div>
        
EOF;
       displayElement('searchTypeDialog');
       
    }
}

// Writes the footer. Called by every page.
function writeFooter(){
    echoHtml("../html/footer.html");
}

// Reads the contents of a file (HTML) and echoes it.
function echoHtml($fileName){
    $content = file_get_contents($fileName);
    echo $content;
}



// These functions are PHP wrappers for some simple javascript functions, 
// most of which are defined in the jsFunctions.js library-------------------------------------------------------------------

function displayElement($element){
    echo("<script>document.getElementById('{$element}').style.display='block';</script>");
}

function hideElement($element){
    echo("<script>document.getElementById('{$element}').style.display='none';</script>");
}

function elementInnerText ($element , $text){
    echo("<script>document.getElementById('{$element}').innerText = '{$text}';</script>");

}

function setOnClick($link, $dialogID){
    echo("<script>document.getElementById('{$link}').onclick = function() {document.getElementById('{$dialogID}').style.display='block';};</script>");
}


function addNavbarLink ($name, $page, $isActive, $id){
    echo "<script>addNavBarLink('{$name}','{$page}','{$isActive}','{$id}');</script>";
}

function setLink($id, $attr, $val){
    echo "<script>setLink('{$id}','{$attr}','{$val}');</script>";
}

function RemoveElement ($ID){
    echo "<script>removeElement('{$ID}');</script>";

}

function setLinkActive($ID){
   echo "<script>document.getElementById('$ID').setAttribute('class', 'active');</script>";
}

function msgBox($msg) {
    echo '<script>alert("'.$msg.'");</script>';
}

function goBack(){
    echo "<script>window.history.back();</script>";
}



function callBack($str){
    $script = <<<EOF
        <script>
            var param = '{$str}';
            var url = document.referrer;
            if (param != ""){
                if (url.indexOf('?') > -1) {param = "&" + param;}
                else {param = "?" + param;}
            }
            location.href = url + param;
        </script>
EOF;
echo ($script);
  
}

function modalBox($msg){
    echo("<script>displayModalBox('{$msg}');</script>");
}


// Some helper functions --------------------------------------------------------------------------------------------------------------

function unsetValue(array $array, $value, $strict = TRUE){
    if(($key = array_search($value, $array, $strict)) !== FALSE) {
        unset($array[$key]);
    }
    return $array;
}

function reverseName ($name){
	$array =  explode(",",$name); // Break the string where there's a comma.
	$name = "";
	for ($i=count($array)-1;$i >= 0; $i--){ // Rebuild the string from the resulting array.
        $name = $name.$array[$i]." ";
	}
	return trim($name);
}

//-------------------------------------------------------------------------------------------------------------------------------------

// Classes ---------------------------------------------------------------------------------------------------------------------------



// The User class. When this is instantiated, a user is logged in.
// The resulting User object is passed between the various pages as a session variable.
Class User {
    private $fname;
    private $lname;
    private $email;
    private $password;
    private $phone;
    private $ID;
    private $profession;
    
    private $signedIn;
    private $isNew;
   
    public function __construct($_fname, $_lname, $_email, $pword, $_phone, $_profession) {
        $this->fname = $_fname;
        $this->lname = $_lname;
        $this->email = $_email;
        $this->password = $pword;
        $this->phone = $_phone;
        $this->profession = $_profession;
        $this->signedIn = false;
        $this->isNew = false;
    }

    public function getFname(){return $this->fname;}
    public function setFName($_fname) {$this->fname=$_fname;}
    
    public function getLname(){return $this->lname;}
    public function setLName($_lname) {$this->lname=$_lname;}

    public function getEmail(){return $this->email;}
    public function setEmail($_email) {$this->email=$_email;}

    public function getPassWord(){return $this->password;}
    public function setPassWord($pword){ $this->password = $pword;}

    public function getPhone(){return $this->phone;}
    public function setPhone($_phone){ $this->phone = $_phone;}

    public function getProfession(){return $this->profession;}
    public function setProfession($_profession){ $this->profession = $_profession;}

    public function isSignedIn(){return $this->signedIn;}
    public function signIn(){$this->signedIn = true;}
    
    public function setID ($_id){$this->ID = $_id;}
    public function getID (){return $this->ID;}
    
    public function getIsNew(){return $this->isNew;}
    public function setIsNew($val){$this->isNew=$val;}
   
}

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


function download_file($file){
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="'.basename($file).'"');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($file));
    readfile($file);
}
$count = 1;

?>
