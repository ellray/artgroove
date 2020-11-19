<?php
// this file simply emails the subscriber list the article having
// article_id == $id

// $conn is already established
$sql = "SELECT title, content FROM articles WHERE article_id = '$id'";
$result = $conn->query($sql) or
        die("Query for article content failed: $conn->error()");
$row = $result->fetch_row();
$title = $row[0];
$article = $row[1];

$msg_body = <<< END_OF_MESSAGE


Here is our latest newsletter release:
---
$title

$article
---
Yours in vinyl,
The Record Barn
END_OF_MESSAGE;

$subject = "Record Barn Newsletter";
$msg_headers = "From: The Record Barn <jeffe@cet.com>";

$sql = "SELECT email, firstname, lastname FROM subscribers";
$result = $conn->query($sql) or
        die("Query for subscriber email list failed: $conn->error()");
$success_msg = "<h3>Successfully emailed the selected article to the following
    people:</h3><div><ul>";
while ($row = $result->fetch_row()) {
    $addr = $row[1] . $row[2] . "<" . $row[0] . ">";
    $message = "Hello $row[1]," . $msg_body;
    mail($addr, $subject, $message, $msg_headers);
    $success_msg .= "<li>$row[1] $row[2] ($row[0])</li>\n";
}
$success_msg .= "</ul></div>";

print $success_msg; 

?>
