<?php    session_start();  ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
  <head>
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
    <title>The Record Barn: <?php echo $page_title ?></title>
    <!-- CIS230 PHP Website
         Jeff Ellingson
         26-Sep-2010
    -->
    <link href="images/record_barn.ico" rel="shortcut icon" />
    <!--<link rel="icon" type="image/ico" href="images/favicon.ico" />-->
    <link rel="stylesheet" type="text/css" href="css/jellingson.css" />

  </head>
  <body>
    <?php
    if ( $_SESSION['logged_in'] == true ) {
        print "<p class=\"bold\">" . $_SESSION['name'] . " logged in as ADMIN</p>\n";
    }