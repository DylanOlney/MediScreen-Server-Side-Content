<?php
/*===============================================================================================
This is the home page and the entry point of the website for the user.
================================================================================================*/

// The 'functions' library (contains definitions for Customer class, CartItem class and various functions
// used throughout the application.)
require_once "../php_libs/functions.php";  

// A customer object will be passed between pages as a session variable.
// If the customer object is null, then the site is being accessed as a visitor.
// Otherwise, a user is logged on as a customer.
session_start();
@$user = $_SESSION["user"];

writeHeader($user); // Write the header which contains a logo, navigation bar and top status bar, etc.
setLinkActive('home');
echoHtml("../html/homepage.html");  // The main body html is echoed here.
if ($user ==null){
    hideElement("browse");
} else {
    $name = "{$user->getFname()} {$user->getLname()}";
    $profession = $user->getProfession();
    if ($profession=='doctor') $temp = "registered patients";
    else $temp = "clients";
    elementInnerText("scrollMessage", "Hi {$name}, you are currently logged in!  Use the navigation bar above to browse through your {$temp}.");
}
writeFooter();  // Write the page's footer
?>



