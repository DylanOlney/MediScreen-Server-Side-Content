
<?php

require_once "../php_libs/functions.php";
session_start();
@$customer = $_SESSION["customer"];
writeHeader($customer);

removeElement('search');
// This page doesn't contain any visual material. It is the 'action page' for
// the 'search type' dialog of the application and contains code to query the database
// for the search string based on the search type selected via radio buttons in the dialog.

if(isset($_GET['searchType'])){
    removeElement('header');
    writeHeader($customer);
    addNavBarLink ('Search Results','',true,'results');

    $type = $_GET['searchType'];
    $search = $_GET['searchString'];
    $searchToUpper = strtoupper($search);
    $links = array();

    if ($type=="artists"){   // Search type = search from 'artists' database table.
        
        $ret = $db->query("SELECT * from artists"); 
        while($row = $ret->fetchArray(SQLITE3_ASSOC) ) {
            $name = strtoupper(reverseName($row['name']));
            if ((strpos($name, $searchToUpper) !== false)||($name == $searchToUpper)) {
                $str =  "{$row['name']}, {$row['date']} </br>";
                $links[] =   "<li><a class = 'smallLine' href = 'artistPage.php?id={$row['id']}'>{$str}</a></li>";
            }
        }

       
        
    }
    elseif ($type=="artwork") {// Search type = search from 'title' column of 'artworks' database table.
        $ret = $db->query("SELECT * from artwork"); 
        while($row = $ret->fetchArray(SQLITE3_ASSOC) ) {
            $title = strtoupper($row['title']);
            $artist = reverseName($row['artist']);
            if ((strpos($title, $searchToUpper) !== false)||($title == $searchToUpper)) {
                $str =  "{$row['title']}, by {$artist} </br>";
                $links[] =   "<li><a class = 'smallLine' href = 'artPage.php?id={$row['artistId']}&id_art={$row['id']}&artist={$artist}'>{$str}</a></li>";
            }
        }
    }
    
    else {// Search type = search from 'medium' column of 'artists' database table.
        $ret = $db->query("SELECT * from artwork"); 
        while($row = $ret->fetchArray(SQLITE3_ASSOC) ) {
            $genre = strtoupper($row['medium']);
            $artist = reverseName($row['artist']);
            if ((strpos($genre, $searchToUpper) !== false)||($genre == $searchToUpper)) {
                $str =  "{$row['title']}, by {$artist} </br>";
                $links[] =   "<li><a class = 'smallLine' href = 'artPage.php?id={$row['artistId']}&id_art={$row['id']}&artist={$artist}'>{$str}</a></li>";
            }
        }
    }

    // If the search produced results, display them as links.
    if (!empty($links)){
        echo "</br></br><p class = 'standardLine'>Search result(s) for '{$search}' from {$type}:</p>";
        echo "<ul>";
        foreach ($links as $link) echo $link;
        echo "</ul>";
    }

    else {
        echo "</br></br><p class = 'standardLine'>No result(s) for '{$search}' from {$type}.</p>";
    }

}

writeFooter(); 
?>
