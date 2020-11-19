<?php
	$page_title = "Gallery Search Results: Properties";
	$desc = "search results art from artgroove.com,contemporary modern abstract art";
	$keys = "art,san francisco,contemporary art,abstract,abstract art,non-representational,carolyn ellingson,ellingson,carolyn, artgroove,oil painting,pastel drawing,pastel,acrylic,acrylic painting,painting,drawing,monotype,pastel,watercolor,gouache, design,color,intense color,form,line,composition,drawing,painting,art quotes,artists say,artist quotes,quotations,art quotations, artist quotations,sell art,art gallery,art auction,visual art,on-line,buy, home,home decor,office,office decor,interior design,color field,sales,art dealer,art seller,contemporary,colorful,modern,post-modern,strong,fine art,visual art,mixed media,hunter's point,open studio,hunter's point shipyard,studio visit,exhibition,exhibit,venue,auction,direct to buyer,direct to you,direct sales,sell direct,buy art,framing,frame,framing tips,hang,moderate price,acid-free,archival,design,web design,web designer,san francisco,show,free,image,images,california,northern california,san francisco bay area,bay area,united states,original,original art,new art,recent work,select work,selection,extraordinary,pictures,fine artist,creative,design services,colours,handmade,exciting,fine art,bargain,printmaking,prints,studio,color field,colour field,art world,new,art object,search";
	include("../templates/header.php");
?>

<body>
<div id="wrapper">
  <?php include "../templates/nav_header.html"; ?>
    <div class="gallery_container">
		<h2>Gallery Search Results</h2>

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
	$rows_per_page = 5;
	$max_pages = 10;  // pagination display limit
	
	$page = $_GET['page'];
	
	if(empty($page)){    // Checks if the $page variable is empty (not set)
		$page = 1;        // If empty, we're on page 1
	}

	// need to split query string so we can do a count of records returned below
	$query_start = "SELECT * FROM `Art Inventory`";

	//start middle part of query with Image filter
	$query_mid = "WHERE `Image`!=\"NULL\""; 

	// Connect to the MySQL server -- need to do this BEFORE we use mysql_real_escape_string()
	if (!($connection = @ mysql_connect($hostname, $username, $password)))
		die("Cannot connect");

	if (!(mysql_select_db($databasename, $connection)))
		showerror();
	
	// get values from gallery form and filter (using GET to allow bookmarking search)
	$medium = $_GET["medium"];
	$medium = mysql_real_escape_string(strip_tags(trim($medium)));
	$materials = $_GET["materials"];
	$materials = mysql_real_escape_string(strip_tags(trim($materials)));
	$width = $_GET["width"];
	$width = mysql_real_escape_string(strip_tags(trim($width)));
	
	switch ($width)
	{
		case "small":
			$w_var0=0;
			$w_var1=12;
			break;

		case "medium":
			$w_var0=12;
			$w_var1=24;
			break;
			
		case "large":
			$w_var0=24;
			$w_var1=36;
			break;
			
		case "very_large":
			$w_var0=36;
			$w_var1=100;
			break;
			
		case "any":
			$w_var0=0;
			$w_var1=100;
			break;
		
		default:  // default to any size
			$w_var0=0;
			$w_var1=100;
	}

	if ($medium != "any") {
		if ($medium != "other") {
			// start building the "mid" part of the query string
			$query_mid .= " AND `Medium`=\"$medium\"";
		}
		else
		{
			$query_mid .= " AND ((`Medium`!=\"painting\") AND (`Medium`!=\"drawing\") AND (`Medium`!=\"print\") AND (`Medium`!=\"mixed media\"))";
		}
	}

	if ($materials != "any") {
		$query_mid .= " AND `Materials` LIKE '%$materials%'";
	}

	$query_mid .= " AND (`Width`>=$w_var0 AND `Width`<$w_var1)";
	
	// add ordering
	$query_mid .= " ORDER by `Title`";

	// compose complete query (minus limits to be added later)
	$query = "$query_start $query_mid";
	//print "<p>Query now looks like:<br />$query<br />";

	// add pagination
	$limit = $row_size * $rows_per_page;
    $start = ($page - 1) * $limit;
	$limitStr = "LIMIT $start, $limit";

	// new var name so we can pass $query for 'next' or 'prev' pages of
	// results without re-determining the string...
	$final_query = "$query $limitStr";

	// print "<p>DEBUG: Query with limitStr now looks like:<br />$final_query<br />";

	// First count the total rows returned--this could probably be done with the actual query, but this works
	if (!($count_array = mysql_query ("SELECT count(*) from `Art Inventory` $query_mid", $connection)))
		showerror();
	$result_cnt = mysql_fetch_row($count_array);
	$row_total = $result_cnt[0];
	// print "<p>row total = $row_total<br />");
	
	// Run the query on the connection
	if (!($result = @ mysql_query ($final_query, $connection)))
		showerror();
	$rows_found = @ mysql_num_rows($result);
	
	$num_pages = ceil($row_total / $limit);
	//echo ("<br />num_pages = $num_pages<br />");

	if ($rows_found > 0) {
		// Display the results
		
		//******* start TOP page navigation display ******
		
		// handle single piece result nicely
		if ($rows_found == 1)
			$pieces = "piece";
		else
			$pieces = "pieces";

		// start with container for results table...
		echo ("<table class='gallery_results'><tr><td class='results_cell'>");
		
		if ($num_pages > $max_pages) {
			if ($page > ($max_pages/2)) {
				if ($num_pages>$page+($max_pages/2)) {
					$low=$page-($max_pages/2);
					$high=$page+($max_pages/2);
				}
				else {  // $num_pages<=$page+($max_pages/2)
					$high=$num_pages;
					$low=$num_pages-$max_pages;
				}
			}
			else {   // $page<=($max_pages/2) 
				$high=$max_pages;
				$low=1;
			}
		}
		else {  // $num_pages<$max_pages (display all page numbers)
			$low = 1;
			$high=$num_pages;
		}
					
  		echo ("Displaying ".$rows_found." ".$pieces.", (page ".$page." of ".$num_pages.")</td><td class='results_cell'>");
		
		if($page > 1) {
	  		$pageprev = $page - 1;
	  		echo("<a href=\"process.php?page=$pageprev&amp;medium=$medium&amp;materials=$materials&amp;width=$width\">prev</a>&nbsp;&nbsp;");
		}
		
		$i=$low;
		while($i<=$high) {
	    	if($page == $i) {
				echo("<span class=\"bold\">".$i."</span>&nbsp;");
			}
			else
				echo("<a href=\"process.php?page=$i&amp;medium=$medium&amp;materials=$materials&amp;width=$width\">$i</a>&nbsp;&nbsp;");
		$i++;
		}
	
		if($page < $num_pages) {
			$pagenext = ($page + 1);
			echo ("<a href=\"process.php?page=$pagenext&amp;medium=$medium&amp;materials=$materials&amp;width=$width\">next</a>");
		}
	
		// Add "Search Again" link
		echo ("</td><td class='results_cell'><a href=\"../gallery.php\">New Search</a>");
		echo ("</td></tr>\n<tr><td colspan='3'><hr /></td></tr></table>\n");
		//******* end TOP page navigation display ******
  			
		displayart($result);
	}
	else
		print "No art found for search...";

	// finally, add pagination at bottom of page...	
	echo ("<hr /><br /><table class='gallery_results'><tr><td class='results_cell'></td><td>");
	
	if($page > 1) {
		$pageprev = $page - 1;
		echo("<a href=\"process.php?page=$pageprev&amp;medium=$medium&amp;materials=$materials&amp;width=$width\">prev</a>&nbsp;");
	}
		
	$i=$low;
	while($i<=$high) {
		if($page == $i) {
			echo("<span class=\"bold\">".$i."</span>&nbsp;&nbsp;");
		}
		else
			echo("<a href=\"process.php?page=$i&amp;medium=$medium&amp;materials=$materials&amp;width=$width\">$i</a>&nbsp;&nbsp;");
		$i++;
	}

	if($page < $num_pages) {
		$pagenext = ($page + 1);
		echo ("<a href=\"process.php?page=$pagenext&amp;medium=$medium&amp;materials=$materials&amp;width=$width\">next</a>");
	}

	// Add "Search Again" link
	echo ("</td><td class='results_cell'><a href=\"../gallery.php\">New Search</a>");
	echo ("</td></tr></table>");
?>

			</div>
		</div>
	<?php include("../templates/footer.htm"); ?>
</body>
</html>
