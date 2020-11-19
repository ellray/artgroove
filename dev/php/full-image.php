<?php
	// use GET to enable user to save bookmark of search
	$id = $_GET["id"];

	require_once 'db.php';
	$query = "SELECT * FROM `Art Inventory` WHERE `Item_ID`=\"$id\"";
	// Connect to the MySQL server -- have to do this *before* we do the mysql_real_escape_string call
	if (!($connection = @ mysql_connect($hostname, $username, $password)))
		die("Cannot connect");
	if (!(mysql_select_db($databasename, $connection)))
		showerror();
	$result = @ mysql_query ($query, $connection);
	// there should only be one row in the result!
	$row = @ mysql_fetch_array($result);

	$page_title = $row["Title"];
	$desc = "Displaying full image of $page_title by Carolyn Ellingson"
	$keys = "Artgroove.com,artgroove,gallery,keyword search,search art,properties search,display random art,Carolyn Ellingson,see art,abstract art";
	include("../templates/header.php");
	print "<body>
			<div id=\"wrapper\">"
    <?php include("../templates/nav_header.html"); ?>
	print "	<div class=\"left_align_narrow\">
				<div class=\"center\">"
<?php
	function displayImage($result)
	{
		$lgImagePath="/db_images/dblarge";
		
		// there should only be one row in the result since the item_id is a unique dbase key
		$row = @ mysql_fetch_array($result);

		$title = $row["Title"];
		$title2 = str_replace("#", "%23", $title);
		$img = $row["image"];
		$id = $row["Item_ID"];
		
		if ($row["ForSale"] == 0)
			print "";
		else
		{
			$price = $row["Price"];
			$price_dollars = number_format($price);
			// $subj = "purchase%20inquiry:%20%20$title2%20(%23$id)";
			$subj = 'purchase inquiry:  ' . $title2 . " #" . $id;
			print "<p id='sale_header'><span class='yellow'> ** </span><a href=\"../contact.php?subject=" . $subj . "\">For Sale! \$" . $price_dollars . "</a> <span class='yellow'>**</span> <a class='smaller' href=\"../contact.php?subject=" . $subj . "\">(click to inquire)</a><br /></a></p>";
		}

		print "<div>\n<img class='fullsize_img' src=\"$lgImagePath/lg_{$row["Image"]}\" alt=\"{$title}\" />\n";
		print "<p><span class='big'>\"" . $title . "\", ";
		if ($row["Year"] == NULL)
			print "(date unknown)\n";
		else
			print "({$row["Year"]})\n";
		print "</span><br />{$row["Materials"]}, \n";
		if ($row["Height"] == 0)
			print "(size unknown)\n";
		else
			print "{$row["Height"]}\" h x {$row["Width"]}\" w\n";
		print "<br /><span class='small_times'>Item ID# = {$row["Item_ID"]}:  {$row["Comments"]}</span>\n";
		//if ($row["Sold"] == 0)
		//	print "<td>unsold</td>";
		//else
		//	print "<td>sold</td>";

		print "\n\n";
	}

		$query = "SELECT * FROM `Art Inventory` WHERE `Item_ID`=\"$id\"";

		// Connect to the MySQL server
		if (!($connection = @ mysql_connect($hostname, $username, $password)))
			die("Cannot connect");

		if (!(mysql_select_db($databasename, $connection)))
			showerror();
		
		// Run the query on the connection
		if (!($result = @ mysql_query ($query, $connection)))
			showerror();
		$rows_found = @ mysql_num_rows($result);

		if ($rows_found > 0)
		{
			// Display the results
			displayImage($result);
		}
		else {
			print "<p class='err'>Error!  Sorry, image not found!<br /><br />\n";
			$subj = "artgroove error: id {$id} not found in dbase!";
			print "Please contact Artgroove by clicking <a href=\"../contact.php?subject={$subj}\">HERE</a>.<br />\n";
			print "Thank you!</p>";
	}
?>
	</div>
	</div>
</body>
</html>
