<?php
	$page_title = "Random Selection";
	$desc = "random selection of art from artgroove.com,contemporary modern abstract art";
	$keys = "art, san francisco, contemporary art, abstract , abstract art, non-representational, carolyn ellingson, ellingson, carolyn, artgroove, oil painting, pastel drawing, pastel, acrylic, acrylic painting, painting, drawing, monotype, pastel, watercolor, gouache, design, color, intense color, form, line, composition, drawing, painting, art quotes, artists say, artist quotes, quotations, art quotations, artist quotations, sell art, art gallery, art auction, visual art, on-line, buy, home, home decor, office, office decor, interior design, color field, sales, art dealer, art seller, contemporary, colorful, modern, post-modern, strong, fine art, visual art, mixed media, hunter's point, open studio, hunter's point shipyard, studio visit, exhibition, exhibit, venue, auction, direct to buyer, direct to you, direct sales, sell direct, buy art, framing, frame, framing tips, hang, moderate price, acid-free, archival, design, web design, web designer, san francisco, show, free, image, images, california, northern california, san francisco bay area, bay area, united states, original, original art, new art, recent work, select work, selection, extraordinary, pictures, fine artist, creative, design services, colours, handmade, exciting, fine art, bargain, printmaking, prints, studio, color field, colour field, art world, new, art object";
	include("../templates/header.php");
?>

<body>
	<div id="wrapper">
<?php include "../templates/nav_header.html"; ?>
	<div class="gallery_container">
		<h2>Random Selection of Art from the Gallery</h2>

<?php 
require 'db.php';
require 'utils.php';

function displayArt($result)
{
    global $page;
	global $num_pages;
	global $rows_found;
	global $row_size;
  	
	// Start a table, with column headers
	print "\n<table class='gallery_results'>\n\n";

	// row counter
	$row_cnt=0;

	// Until there are no more rows in the result set, fetch a row into the $row and ...
	while ($row = @ mysql_fetch_array($result))
	{
		// $row_size returned pieces per row, starting here:
		if ($row_cnt%$row_size == 0)
			print "\n<tr>";

		// Do not display info for pieces without images
		if (($row["Image"] == 0)||($row["Image"] == NULL))
			continue;

		$title = $row["Title"];
		$lg_img = $row["Image"];
		$thumb = $row["Image"];
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

		print_results_cell($id, $title, $year, $lg_img, $thumb, $width, $height, $materials, $for_sale, $price);
		
		// If there are $row_size items in this row, close the row:
		$row_cnt++;
		if ($row_cnt%$row_size==0)
			print "\n</tr>";
	}

	// Then finish the table
	print "\n</table>\n";
}

//
// Main program starts here!		Main program starts here!		Main program starts here!
//
	// set pagination size and check page number
	$row_size = 3;
	$rows_per_page = 10;
	$max_pages = 10;  // pagination page display limit

	if(empty($page)){    // Checks if the $page variable is empty (not set)
		$page = 1;        // If empty, we're on page 1
	}

	// need to split query string so we can do a count of records returned below
	$query_start = "SELECT * FROM `Art Inventory`";

	//start middle part of query with Image filter
	$query_mid = "WHERE `Image`!=\"NULL\""; 
		
	// add random selection.ordering
	// note that MD5 is some sort of message digest encryption command which apparently operates on the returned string
	$query_mid = "$query_mid ORDER by MD5(RAND())";

	// compose complete query (minus limits to be added later)
	$query = "$query_start $query_mid";
	//print "<p>Query now looks like:<br />$query<br /></p>";

	$limitStr = "LIMIT 30";

	$final_query = "$query $limitStr";

	// print "<p>Query now looks like:<br />$final_query<br /></p>";

	// Connect to the MySQL server
	if (!($connection = @ mysql_connect($hostname, $username, $password)))
		die("Cannot connect");

	if (!(mysql_select_db($databasename, $connection)))
		showerror();
	
	// Run the query on the connection
	if (!($result = @ mysql_query ($final_query, $connection)))
		showerror();
	$rows_found = @ mysql_num_rows($result);
	
	if ($rows_found > 0)
	{
		// Display the results
		
		//******* start TOP page navigation display ******
		echo ("<table class='gallery_results'><tr><td class='results_cell'>");
		
		echo("Displaying ".$rows_found." random pieces</td>");
			
		// Add "30 More Random Images" and "Searchable Gallery Home" links
		echo("<td class='results_cell'><a href=\"/php/process-random.php\">30 More Random Images</a></td>");
		echo("<td class='results_cell'><a href=\"../gallery.php\">Gallery Home</a></td></tr></table>");
		echo("\n<hr /><br />");
		
		//******* end TOP page navigation display ******
  		
		// add the thumbnails/titles!
		displayart($result);
	}
	else
	{
		// this should never happen...we're just displaying random pieces
		print "No art found for search...";
	}
	
	// finally, add links to bottom of page...	
	echo ("<hr /><table class='gallery_results'><tr><td class='results_cell'></td>");

	// Add "30 More Random Images" and "Searchable Gallery Home" links
	echo ("<td class='results_cell'><a href=\"/php/process-random.php\">30 More Random Images</a></td>");
	echo ("<td class='results_cell'><a href=\"../gallery.php\">Gallery Home</a></td></tr></table>\n");
	
?>

		</div>
	</div>
	<?php include("../templates/footer.htm"); ?>
</body>
</html>
