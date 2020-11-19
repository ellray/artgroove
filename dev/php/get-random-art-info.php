<?php

// get_random_art_info.php
// returns array of info about a random piece from the database 
//
//                                (id, title, medium, large image filename)
$max_id = 1972;
require_once 'db.php';

$art_info = ["id", "title", "medium", ""];  // fill this in from query
// Connect to the MySQL server
if (!($connection = @ mysql_connect($hostname, $username, $password)))
    die("Cannot connect");

if (!(mysql_select_db($databasename, $connection)))
    showerror();

// Run the query on the connection

do {
    $id = rand(1, $max_id);
    $query = "SELECT * FROM `Art Inventory` WHERE `Item_ID`=\"$id\"";
    if (!($result = @ mysql_query ($final_query, $connection)))
        showerror();
    if (@ mysql_num_rows($result) == 1) { // there should only be one row in the result!
        $row = @ mysql_fetch_array($result);
        if ($row["Image"] == NULL | $row["Image"] == "") {
            $art_info[3] = "";
        }
        else {  // fill in return array
            $art_info[0] = $row["Item_ID"];
            $art_info[1] = $row["Title"];
            $art_info[2] = $row["Medium"];
            $art_info[3] = $row["Image"];
        }
    }
} while ($art_info[3] == "" or $art_info[3] == NULL);
return $art_info;
?>
	
