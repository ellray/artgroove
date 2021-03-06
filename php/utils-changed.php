<?php
// utils.php

function print_results_cell($id, $title, $year, $lg_image, $thumbnail, $width, $height, $materials, $for_sale, $price) {
	$lg_img = "lg_" . $lg_image;
	$thumb = "t_" . $thumbnail;
	$title = htmlentities($title);  // fix double-quotes
	
	print "<td class='results_cell'>\n";
	if ($for_sale == 0)
		$sale = "";
	else
	{
		$price_dollars = number_format($price);
		// contact email subject line for link
		$subj = rawurlencode("purchase inquiry: " . $title . " (#" . $id. ")");
		// this one goes into the full-size image if the thumbnail is clicked
		$sale = "<a href=\"/contact.php?subject=" . $subj . "\"><span class='sale_header'>** For Sale: \$" . $price_dollars . " **</span></a><br />";
		print "<a href=\"/contact.php?subject=$subj\"><span class=\"bold\">For Sale! \$$price_dollars</span></a><br />";
	}
			
	if ($height==0)
		$size = "(size unknown)";
	else
		$size = $height . "\" h x " . $width . "\" w";
		
	$info = htmlentities($sale) . "<span class='bigger'>" . $title . ", " . $year . "</span><br />" . $materials . ", " . htmlentities($size) . "<br /><span class='smaller'>id: " . $id;
	//print "<!-- info = " . $info . "-->";
	//print	"<a href=\"#\" onclick=\"
	({$row["Item_ID"]});\">";
	print "<a href=\"/db_images/dblarge/{$lg_img}\" class=\"shadowbox\" title=\"{$info}\">";
	print "<img class=\"cell_img\" src=\"/db_images/dbthumbs/{$thumb}\" alt=\"{$title}\" /></a>\n";
	print "<br /><span class='italic'>{$title}</span>,&nbsp;&nbsp;";
	print $year . "<br />";
	print $size;
	print "<br />" . $materials . "\n<br /></td>";
	//print"<br /><span class='smaller'>(Item ID = {$id})</span>\n<br /></td>";	
}

?>