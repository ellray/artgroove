<?php 	
	require 'db.php';
	require 'utils.php';
	
	// use GET to enable user to save bookmark of search
	$id = $_GET["id"];
	// print "<h3>DEBUG: Found ID=$id!</h3>"
	// prevent sql injection
	$id = strip_tags(trim($id));

	$query = "SELECT * FROM `Art Inventory` WHERE `Item_ID` = '". $id . "'";

	// Connect to the MySQL server -- have to do this *before* we do any mysql_real_escape_string call
	if (!($connection = @ mysql_connect($hostname, $username, $password)))
		die("Cannot connect");

	if (!(mysql_select_db($databasename, $connection)))
		showerror();
	
	// print "DEBUG: <p>Query looks like:<br />$query</p>";

	if (!($result = @ mysql_query ($query, $connection)))
		showerror();
	$rows_found = @ mysql_num_rows($result);
	// print "<p>DEBUG: rows found: " . $rows_found . "</p>;
	
	$too_many_pieces_found = False;
	if ($rows_found > 1) {
		// this should never happen; we're loading a single piece via ID
		$too_many_pieces_found = True;
	}

	if ($rows_found > 0) {
		// Display the piece
		$row = @ mysql_fetch_array($result);
		$title = $row["Title"];
		$img = $row["Image"];
		// add filename prefixes to the image field if the image field isn't null or 0
		if (strlen($img) > 0) {
			$thumb = "t_" . $img;
			$lg_img = "lg_" . $img;
		}
		else
			print "<h3>WHAT?! lg_img appears to be empty?: " . $lg_img . "</h3>";
		$id = $row["Item_ID"];
		$materials = $row["Materials"];
		$height = $row["Height"];
		$width = $row["Width"];
		$for_sale = $row["ForSale"];
		$price = $row["Price"];
		
		if ($row["Year"] == NULL)
			$year = "(date unknown)";
		else
			$year = $row["Year"];
	}

	$page_title = "Artgroove.com: \"" . $title . "\"";
	$og_title = $title;
	$desc = "Artgroove.com: " . $title;
	$og_desc = $desc;
	$og_url = "https://www.artgroove.com/display-art.php?id=" . $id;
	$og_image = "https://www.artgroove.com/db_images/dblarge/" . $lg_img;
	// get image dimensions for FB share spec
	list($wide, $high) = getimagesize("../../db_images/dblarge/".$lg_img);
	$og_img_width = $wide;
	$og_img_height = $high;
	$keys = "art,san francisco,contemporary art,abstract,abstract art,non-representational,carolyn ellingson,ellingson,carolyn,artgroove";
	include("../templates/header.php");
?>

<body>
    <div id="wrapper">
        <?php include("../templates/nav_header.html"); ?>
		<div class="gallery_container">
			<div class="center">

<?php
	if ($too_many_pieces_found)
		print "<h3>There was a database problem (>1 piece with single ID)</h3>";
	else {
		//print "<p>lg_img: " . $lg_img . "</p><p>row[\"Image\"]: " . $row["Image"] . "</p>";
		display_single($id, $title, $year, $img, $width, $height, $materials, $for_sale, $price);
	}
?>
			</div>
        </div><!-- end main_content -->
    </div>
    <?php include("../templates/footer.htm"); ?>
</body>
</html>
