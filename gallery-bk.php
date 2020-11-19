<?php
  $page_title = "Artgroove Gallery";
  include("./templates/header.php");
?>
<body>
	<div id="wrapper">
		<?php include "./templates/nav_header.html"; ?>

		<!-- Headline graphic here -->
		<div class="center_align_float">
			<h1>Artgroove Gallery</h1>
		<!--	<p class="subhead">work by Carolyn Ellingson</p>-->
			<hr />

		<div style="padding: 10px;">
			Use the search options below or choose a button: &nbsp;&nbsp;&nbsp;
			<form style="display:inline;" action="php/process_offer.php?" method="get"><input type="hidden" name="forsale" value="1" /><input type="submit" value="All Art For Sale" /></form>&nbsp; &nbsp;
			<form style="display:inline;" action="php/process_random.php" method="get"><input type="submit" value="Random Selection" /></form>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
			<a href="#" onclick="window.open ('about_the_gallery.php','', 'scrollbars=yes,width=800,height=800,resizable=yes'); return false;"><span class="underline">About the Gallery</span></a>
		</div>
		<br />

		<table style="width: 100%">
			<tr>
				<td style="width: 50%" class="gallery_search_boxes">
					<span class="bold">Properties Search</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  <a href="#" onclick="window.open ('properties_search_info.php','', 'scrollbars=yes,width=720,height=550,resizable=yes'); return false;"><span class="underline">Tell me more</span></a>

					<p>
			Show art that has the following properties:
					</p>
						<form action="php/process.php" method="get">

						<p>Medium:&nbsp;
						<select name="medium">
					<option selected="selected">any</option>
					<option>painting</option>
					<option>drawing</option>
					<option>print</option>
					<option>mixed media</option>
					<option value="other">other (e.g., collage, batik, tee-shirt)</option>
						</select>
				</p><p>Materials:&nbsp;  
				<select name="materials">
					<option selected="selected">any</option>
					<option>watercolor</option>
					<option>oil</option>
					<option>acrylic</option>
					<option>pastel</option>
					<option>gouache</option>
					<option>monotype</option>
					<option>intaglio</option>
					<option>silkscreen</option>
					<option>collage</option>
					<option>ink</option>
					<option>pencil</option>
					<option>cotton</option>
					<option>shirt</option>
				</select>
				</p><p>
				Size (by width):&nbsp;
				<select name="width">
					<option selected="selected">any</option>
					<option value="small">&lt;12"</option>
					<option value="medium">12-24"</option>
					<option value="large">24-36"</option>
					<option value="very_large">&gt;36"</option>
				</select>
				</p>
				<p>
				<input class="button" type="submit" value="Show Art" />
				</p>
				</form>
				</td>

				<td style="width=50%" class="gallery_search_boxes">
				<span class="bold">Keyword(s) Search</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="#" onclick="window.open ('keyword_search_info.php','', 'scrollbars=yes,width=800,height=800,resizable=yes'); return false;"><span class="underline">Tell me more</span></a>
					<p>
					Show art pertaining to the following word or phrase (case-insensitive):
			</p>
					<form action="php/process_keyword.php" method="get">

						<p>Keyword(s):&nbsp;
						<input type="text" name="keyword" size="25" />
					</p>
						<p>
						<input class="button" type="submit" value="Show Art" />
				</p>
					</form>
				</td>
			</tr>
		</table>
	<br />
	<h3>The images below were randomly chosen from the gallery...</h3>
	<br />

	<?php 
		// using .php extension is secure...
		require './php/db.php';

		$query = "SELECT * FROM `Art Inventory` ORDER BY RAND() LIMIT 3";

			// Connect to the MySQL server
		if (!($connection = @ mysql_connect($hostname, $username, $password)))
			die("Cannot connect");

		if (!(mysql_select_db($databasename, $connection)))
			showerror();
		
		// Run the query on the connection
		if (!($result = @ mysql_query ($query, $connection)))
			showerror();

		// Start a table, with column headers
		print "\n<table style='width: 100%'><tr>\n\n";
			
		// No error correction/checking here, since our query is hard-coded to return 3 records
		// Until there are no more rows in the result set, fetch a row into the $row and ...
		while ($row = @ mysql_fetch_array($result))
		{
			// Do not display info for pieces without images
			if (($row["Image"] == 0)||($row["Image"] == NULL))
				continue;
			$title = $row["Title"];
			$lg_img = "lg_" . $row["Image"];
			$thumb = "t_" . $row["Image"];
			$id = $row["Item_ID"];
			$materials = $row["Materials"];

			print "<td style='width: 33%'>\n";
			
			if ($row["ForSale"] == 0)
				$sale = "";
			else
			{
				$price = $row["Price"];
				$price_dollars = number_format($price);
				// contact email subject line for link
				$subj = rawurlencode("purchase inquiry: " . $title . " (#" . $id. ")");
				// this one goes into the full-size image if the thumbnail is clicked
				$sale = "<a href=\"/contact.php?subject=" . $subj . "\"><span class='sale_header'>** For Sale: \$" . $price_dollars . " **</span></a><br />";
				print "<a href=\"/contact.php?subject=$subj\"><img src=\"./images/forsale.gif\" alt=\"For Sale\" /> \$$price_dollars</a><br />";
			}
			
			if ($row["Year"] == NULL)
				$year = "(date unknown)";
			else
				$year = $row["Year"];
				
			if ($row["Height"]==0)
				$size = "(size unknown)";
			else
				$size = $row["Height"] . "\" h x " . $row["Width"] . "\" w";
				
			$info = htmlentities($sale) . "<span class='bigger'>" . $title . ", " . $year . "</span><br />" . $materials . ", " . htmlentities($size);
			//print "<!-- info = " . $info . "-->";
			//print	"<a href=\"#\" onclick=\"open_fullsize_img({$row["Item_ID"]});\">";
			print "<a href=\"/db_images/dblarge/{$lg_img}\" rel=\"shadowbox\" title=\"{$info}\">";
			print "<img src=\"/db_images/dbthumbs/{$thumb}\" alt=\"\" /></a>\n";
			print "<br /><span class='italic'>{$title}</span>,&nbsp;&nbsp;";
			print $year . "<br />";
			print $size;
			print "<br />" . $materials . "\n";
			print"<br /><span class='smaller'>(Item ID = {$id})</span>\n<br /></td>";
		}
		// close the row and table
		print "\n</tr>\n</table>";
		?>

		</div>
		</div>
		<?php include("./templates/footer.htm"); ?>
	</div>
</body>
</html>
