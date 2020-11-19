<?php
  $page_title = "Create Email";
  include("../templates/header.php");
	require ('./utils.php');
?>

<body>
	<div id="wrapper">
	<?php include("../templates/nav_header.html"); ?>
	<div class="main_content_narrow">
		<?php
			function email_newsletter() {
				$subj = "Artgroove.com: Spring 2013 Newsletter";
				$headers = "From: curator@artgroove.com\r\n";
				$headers .= "Reply-to: curator@artgroove.com\r\n";
				$headers .= "MIME-Version: 1.0\r\n";
				$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
				$msg = <<< END_OF_EMAIL
<html style="margin:0;padding:0;background-color:#59e;">
<body style="margin:0;padding:0;background-color:#59e;font-family:corbel,'sans serif',arial;">
<a href="http://www.artgroove.com" style="text-decoration:none;"><div style="text-align: center;
	height:131px;
	background-image: url('http://www.artgroove.com/images/banner_800px.png');
	min-width:40em;
	width:100%;"
>
	<div >
		<h1 style="color:#eee;margin:0;
			font-size: 3em;
			padding:0;
			font-family:'ligurino condensed','sans serif';
			text-shadow: .1em .1em .1em #444;">artgroove.com</h1>
		<h1 style="color:#eee;margin:0;
			font-size: 3em;
			padding:0;
			font-family:'ligurino condensed','sans serif';
			text-shadow: .1em .1em .1em #444;">the work of Carolyn Ellingson</h1>
	</div>
</div>
</a>
<div style=" display:block;
  margin-left:auto;
  margin-right:auto;
  width:600px;
  overflow:auto;
	margin-top:10px;
	padding:0 20px;
	background-color:#f8f8dd;
	border: 3px solid #111;">
<h1 style="text-shadow: .1em .1em .1em #888;">Spring 2013 Newsletter</h1>
<p style="font-weight:700;">
Hello again, fans of Carolyn Ellingson's art!
<br /><br />
In this issue:
</p>
<h3><a href="#exhibit" style="text-decoration:none">Gallery Exhibition Featuring 40+ Works from the Artgroove.com Collection</a></h3>
<h3><a href="#repurchase" style="text-decoration:none">Artgroove.com Adds Two of Carolyn's Paintings Back to the Collection</a></h3>
<h3><a href="#future" style="text-decoration:none">Future Plans</a></h3>
<p>
</p>
<div style="-moz-border-radius:.5em;
	border-radius:.5em;
	width:90%;
	margin: 1em auto;
	padding:.5em;
	background-color:#ddd;">
<div style="padding:.5em;
	background-color:#eee;
	border: 1px solid #444;
	margin:.75em;
	text-align:center;
	float:right;">
	<img src="http://artgroove.com/db_images/dbthumbs/t_0233_red_abstract_32.jpg" alt="Red Abstract, #32" /><p style="font-style:italic">Red Abstract, #32</p>
</div>

<h3><a id="exhibit" style="text-decoration:none;color:#000;">Upcoming Exhibition:  &quot;Socko!  The Thrill of Art!&quot;</a></h3>

<p>
<a href="http://www.insideangles.com" style="font-weight:700">Inside Angles</a>, a custom framing gallery in Holland Ohio, will be hosting a show of Carolyn's art opening the 12th of April and running through the 18th of May this year (2013).  The show will be significant, with more than 40 of Carolyn's pieces on display, and they will also be available for purchase.
</p>
<hr />
<div>
<p>
  <span style="font-weight:700;">Here is the exhibition summary:</span><br /><br /><span style="font-weight:700;">Inside Angles Custom Framing Gallery</span>, located at 6831 Angola Rd. in Holland OH (<a href="http://goo.gl/maps/ZEc5X">map</a>), 419-867-3533, will feature Carolyn Ellingson in an exhibit, beginning April 12 until May 18. &quot;Socko! The Thrill of Art&quot; will include dozens of  monotype prints,  intaglio prints, and paintings produced by Ellingson in San Francisco during the '80s, '90s, and early '00s.  The art is dominated by bold compositions of vivid color in a non-representational form, and serves as a reminder of her courageously creative approach to life.
	<br /><br />
	Ellingson was taken by mesothelioma in 2002, but her artistic vision can be viewed for the first time since her passing, and for the first time in the Toledo area, this month. The public is invited to attend the opening reception on Friday, April 12, from 6 p.m. to 8 p.m.
</p>
</div>
<hr />
</div>
<div style="-moz-border-radius:.5em;
	border-radius:.5em;
	width:90%;
	margin: 1em auto;
	padding:.5em;
	background-color:#ddd;">
<a href="http://artgroove.com/php/process_keyword.php?keyword=1383">
	<div style="padding:.5em;
	background-color:#eee;
	border: 1px solid #444;
	margin:.75em;
	text-align:center;
	float:right;">
		<img src="http://artgroove.com/db_images/dbthumbs/t_1383_cerulean_blue_painting_ii.jpg" alt="Cerulean Blue Painting, II" /><p><span style="font-style:italic">Cerulean Blue Painting, II</span></p>
	</div>
</a>
<h3><a id="repurchase" style="text-decoration:none;color:#000;">Artgroove.com Art Re-Purchase!</a></h3>
<p>
Subscribers to our newsletters may recall that a Las Vegas collector was selling 2 of Carolyn's paintings under some hardship.  Artgroove.com was able to step in and re-purchase the pieces from the owner, and we are thrilled to have them back in our collection.
<br /><br />
The 2 pieces are <a href="http://artgroove.com/php/process_keyword.php?keyword=1383"><span style="font-style:italic">Cerulean Blue Painting, II</span></a> (seen here) and <a href="http://artgroove.com/php/process_keyword.php?keyword=1981"><span style="font-style:italic">Red, Pink and Blue, II</span></a>.
</p>
</div>
<div style="-moz-border-radius:.5em;
	border-radius:.5em;
	width:90%;
	margin: 1em auto;
	padding:.5em;
	background-color:#ddd;">
	<h3><a id="future" style="text-decoration:none;color:#000;">Future Plans for Artgroove.com (Let us know what you think!)</a></h3>
	<ul>
		<li>We are still planning on listing a handful of Carolyn's pieces for sale via eBay.  Watch this space.</li>
		<li>There are some impending changes to make the Artgroove.com <a href="http://www.artgroove.com/gallery.php">Gallery</a> a bit easier to browse and search.</li>
		<li>We are considering beginning to offer the ability to purchase and checkout (via PayPal) Carolyn's art via the website.  Packing/shipping costs will necessarily be imprecise, but any over-charge will be refunded to the buyer once the real cost is determined.
		</li>
	</ul>
	<div style="padding:.5em;
		background-color:#eee;
		border: 1px solid #444;
		margin:1em .75em .75em .75em;
		text-align:center;
		float:left;">
		<img src="http://artgroove.com/db_images/dbthumbs/t_0317_little_fishes_ii.jpg" alt="Little Fishes, II" /><p><span style="font-style:italic">Little Fishes, II</span><br />(also part of Inside Angles' Exhibition)</p>
	</div>
</div>
<p>
Requests, questions, suggestions?  Please <a href="http://www.artgroove.com/contact.php">contact us</a>, or you can simply reply to this email.  We appreciate all feedback, especially on our future plans!
<br /><br />
That's it for now.
<br /><br />
Best regards,<br />
Randy &amp; Jeff for <a href="http://www.artgroove.com" style="text-decoration:none">Artgroove.com</a>
</p>
<div style="text-align:center;"><p>
<br /><br /><br />
<p>visit <a href="http://www.artgroove.com/newsletter.php">http://www.artgroove.com/newsletter.php</a> in your browser to see the newsletter on the artgroove website.</p>
<p><a href="http://www.artgroove.com/subscribe.php" style="font-size:80%;text-decoration:none">manage your subscription</a>
</p></div>
</div>
</body>
</html>
END_OF_EMAIL;
				// set up dbase connection to enable real_escape_string()
				require './db.php';
				$conn = new mysqli($hostname, $username, $password, $databasename); 
				if (mysqli_connect_error()) {
					die('<h3 class="err">Sorry, we appear to have a problem with our database.</h3>');
					mail("jeff@webmondrian.com", "Database Error", $e->getMessage());
				}
				$sql = "SELECT firstname, lastname, email FROM contacts WHERE subscribed = '1'";
				$result = $conn->query($sql) or
					die("Query for subscriber email list failed: $conn->error()");
				print "<h3>Sending...</h3";
				while ($row = $result->fetch_row()) {
					if ($row[0] && $row[1])
						$to = "{$row[0]} {$row[1]} <{$row[2]}>";
					else
						$to = $row[2];
// uncomment this block (4 lines) to see the address list:
					print "<h3>Just the address list...not sending</h3>\n<ol>\n";
					print "<li>{$to}</li>\n";
				}
				print "</ol>\n";
						
// or uncomment this block (5 lines) to send email					
//					if (mail($to, $subj, $msg, $headers))
//						print "<h3>success:  " . $to . "</h3>";
//					else
//						print "<h3 class='err'>failure:  " . $to . "!</h3>";
//				}
			} // end email_newsletter() definition
			
		email_newsletter();
		?>
		</div>	
		<?php include("../templates/footer.htm"); ?>
	</div><!-- wrapper -->

</body>
</html>
