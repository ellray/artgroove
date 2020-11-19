<?php
	$page_title = "The Gallery:  See the Art of Carolyn Ellingson";
	$desc = "See the Art!:  Search or Browse the Art of Carolyn Ellingson.  Search by keyword or medium or just browse randomly.";
	$keys = "Artgroove.com,artgroove,gallery,keyword search,search art,properties search,display random art,Carolyn Ellingson,see art,abstract art";
	include("./templates/header.php");
?>
<body>
	<div id="wrapper">
		<?php include "./templates/nav_header.html"; ?>

		<div class="gallery_container center">
			<h1>Artgroove Gallery</h1>
			<hr />

		<div style="padding: 10px;">
			Use the search options below or choose a button: &nbsp;&nbsp;&nbsp;
			<form style="display:inline;" action="./php/for-sale.php" method="get"><input type="submit" value="All Art For Sale" /></form>&nbsp; &nbsp;
			<form style="display:inline;" action="./php/process-random.php" method="get"><input type="submit" value="Random Selection" /></form>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
			<a href="#" onclick="window.open ('about-the-gallery.php','', 'scrollbars=no,width=800,height=800,resizable=yes'); return false;"><span class="underline">About the Gallery</span></a>
		</div>
		<br />

		<table style="width: 100%">
			<tr>
				<td style="width: 50%" class="gallery_search_boxes">
					<span class="bold">Properties Search</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  <a href="#" onclick="window.open ('properties-search-info.php','', 'scrollbars=no,width=800,height=600,resizable=yes'); return false;"><span class="underline">Tell me more</span></a>

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
				<span class="bold">Keyword(s) Search</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="#" onclick="window.open ('keyword-search-info.php','', 'scrollbars=no,width=800,height=750,resizable=yes'); return false;"><span class="underline">Tell me more</span></a>
					<p>
					Show art pertaining to the following word or phrase (case-insensitive):
			</p>
					<form action="php/process-keyword.php" method="get">

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
		require './php/utils.php';

		$query = "SELECT * FROM `Art Inventory` ORDER BY RAND() LIMIT 3";

			// Connect to the MySQL server
		if (!($connection = @ mysql_connect($hostname, $username, $password)))
			die("Cannot connect");

		if (!(mysql_select_db($databasename, $connection)))
			showerror();
		
		// Run the query on the connection
		if (!($result = @ mysql_query($query, $connection)))
			showerror();

		// Start a table, with column headers
		print "\n<table class='gallery_results'><tr>\n\n";
			
		// No error correction/checking here, since our query is hard-coded to return 3 records
		// Until there are no more rows in the result set, fetch a row into the $row and ...
		while ($row = @ mysql_fetch_array($result))
		{
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
		}
		// close the row and table
		print "\n</tr>\n</table>";
		?>

		</div>
	</div>
	<?php include("./templates/footer.htm"); ?>
</body>
</html>
