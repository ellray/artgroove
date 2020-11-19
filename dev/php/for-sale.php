<?php
	$page_title = "Art Currently for Sale";
	$desc = "art currently for sale from artgroove.com,contemporary modern abstract art,purchase";
	$keys = "art,san francisco,contemporary art,abstract ,abstract art,non-representational,carolyn ellingson,ellingson,carolyn,artgroove,oil painting,pastel drawing,pastel,acrylic,acrylic painting,painting,drawing,monotype,pastel,watercolor,gouache,design,color,intense color,form,line,composition,drawing,painting,art quotes,artists say,artist quotes,quotations,art quotations,artist quotations,sell art,art gallery,art auction,visual art,on-line,buy,home,home decor,office,office decor,interior design,color field,sales,art dealer,art seller,contemporary,colorful,modern,post-modern,strong,fine art,visual art,mixed media,hunter's point,open studio,hunter's point shipyard,studio visit,exhibition,exhibit,venue,auction,direct to buyer,direct to you,direct sales,sell direct,buy art,framing,frame,framing tips,hang,moderate price,acid-free,archival,design,web design,web designer,san francisco,show,free,image,images,california,northern california,san francisco bay area,bay area,united states,original,original art,new art,recent work,select work,selection,extraordinary,pictures,fine artist,creative,design services,colours,handmade,exciting,fine art,bargain,printmaking,prints,studio,color field,colour field,art world,new,art object,purchase,sale";
	include("../templates/header.php");
?>

<body>
	<div id="wrapper">

<?php include "../templates/nav_header.html"; ?>
  <div class="gallery_container">
		<h2>Art for Sale</h2>

<?php 
// using .php extension is secure...
require './db.php';
require './utils.php';

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
  
	$page = $_GET['page'];
	if(empty($page)){    // Checks if the $page variable is empty (not set)
		 $page = 1;        // If empty, we're on page 1
	}

	// need to split query string so we can do a count of records returned below
	$query_start = "SELECT * FROM `Art Inventory`";

	//start middle part of query with Image filter
	$query_mid = "WHERE `Image`!=\"NULL\" AND `ForSale`=1";
	
	// add ordering
	$query_mid = "$query_mid ORDER by `Title`";

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

	//print "<p>Query now looks like:<br />$final_query<br />";

	// Connect to the MySQL server
	if (!($connection = @ mysql_connect($hostname, $username, $password)))
		die("Cannot connect");

	if (!(mysql_select_db($databasename, $connection)))
		showerror();
	
	// First count the total rows returned
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

		// Let's limit individual page number display to 20 pages
		$max_pages=20;

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
			else {  // $page<=($max_pages/2) 
				$high=$max_pages;
				$low=1;
			}
		}
		else {  // $num_pages<$max_pages (display all page numbers)
			$low = 1;
			$high=$num_pages;
		}
					
		echo ("Displaying ".$rows_found." ".$pieces.", (page ".$page." of ".$num_pages.")</td><td class='results_cell'>");
		echo ("Page navigation:&nbsp;&nbsp;");		
		if($page > 1)
		{
			$pageprev = $page - 1;
			echo("<a href=\"for-sale.php?page=$pageprev&amp;forsale=1\">prev</a>&nbsp;");
		}		
		$i=$low;
		while($i<=$high) {
			if($page == $i) {
				echo("<b>".$i."</b>&nbsp;");
	    	}
			else
				echo("<a href=\"for-sale.php?page=$i&amp;forsale=1\">$i</a>&nbsp;");
			$i++;
		}
	
		if($page < $num_pages) {
			$pagenext = ($page + 1);
			echo ("<a href=\"for-sale.php?page=$pagenext&amp;forsale=1\">next</a>");
		}
	
		// Add "Gallery Home" link
		echo ("</td><td class='results_cell'><a href=\"../gallery.php\">Gallery Home</a>");
		echo ("<br /><a href=\"#\" onclick=\"window.open('how-to-buy.php','', 'scrollbars=no,width=800,height=350,resizable=yes'); return false;\"><span id='big_link'>How to buy art</span></a><br />");
		echo ("</td></tr></table><hr /><br />");
		//******* end TOP page navigation display ******
  			
		displayart($result);
	}
	else
		print "No art found for search...";

	// finally, add pagination at bottom of page...
	
	echo ("<table class='gallery_results'><tr><td class='results_cell'></td><td>");
	
	echo ("Page navigation:&nbsp;&nbsp;");
	if($page > 1) {
		$pageprev = $page - 1;
		echo("<a href=\"for-sale.php?page=$pageprev&amp;forsale=1\">prev</a>&nbsp;");
	}
		
	$i=$low;
	while($i<=$high) {
		if($page == $i)
			echo("<b>".$i."</b>&nbsp;");
		else
			echo("<a href=\"for-sale.php?page=$i&amp;forsale=1\">$i</a>&nbsp;");
		$i++;
	}

	if($page < $num_pages) {
		$pagenext = ($page + 1);
		echo ("<a href=\"for-sale.php?page=$pagenext&amp;forsale=1\">next</a>");
	}

	// Add "Search Again" link
	echo ("</td><td class='results_cell'><a href=\"../gallery.php\">Gallery Home</a>");
	echo ("</td></tr>");
	
?>

</table>
			</div>
	</div>
	<?php include("../templates/footer.htm"); ?>
</body>
</html>
