<?php
	$page_title = "How to Purchase Carolyn's Art from Artgroove.com";
	$desc = "It's easy to buy art from artgroove.com.  How to purchase Carolyn's art.";
	$keys = "artgroove.com,purchase art,gallery,buy,Carolyn Ellingson";
	include("./templates/header.php");
?>

  <body>
		<div id="wrapper">
			<?php include("./templates/nav_header.html"); ?>

			<div class="left_align_float" style="font-size: 105%">

				<h2>PHP Info:<br /><?php phpinfo(); ?></h2>

				<form style="display:inline;" action="./php/for-sale.php" method="get"><input type="hidden" name="forsale" value="1" /><input type="submit" value="All Art For Sale" /></form>
				<br />
				<!-- main content here (within the table) -->

				<p><span class="bold_red">General Information:</span>  Since Carolyn's death in April 2002, we have created a database of all of her known works.  Where possible, each entry in the database includes an image and information such as the title, size, medium, and date.  As of 2007, we have more than 1900 pieces catalogued.  If you have art by Carolyn not included in the Online Gallery, please let us know using the <a href="contact.php">Contact</a> form.  Images in the Gallery can be expanded by clicking the image; a larger version will appear in a &quot;shadowbox&quot;.  
				</p>
				<p>
				<span class="bold_red">Availability:</span> We provide a selection of Carolyn's art for sale here on <span class="bold">artgroove.com</span>, which will change periodically.  To receive email notification when additional works are made available for purchase, please <a href="subscribe.php"><span class="bold">subscribe</span></a> to our email list.  Your email address remains private -- we do not share email address information with anyone, and each update email we send to you will include a link to remove your email address.
				</p>
				<p>We are also open to discussing purchase of works not currently listed for sale.  Simply contact us via the <a href="contact.php"> Contact </a> form.
				</p>
				<p>
				<span class="bold_red">How to Buy:</span>  Images of art available for purchase will show <span class="bold_italic">"For Sale"</span> along with a price.  When you find a piece that you're interested in purchasing, click the  <span class="bold_italic">"For Sale"</span> graphic and/or price near the piece -- that will bring up the Contact form.  See also, Shipping Information (below).
				</p>
				<p>
				<span class="bold_red">Payment Information:</span>  Initially, we will be able to accept payment only by personal check, and we will ship your purchase after your payment clears.  We hope to be able to accept payment by credit card soon.  We will not charge Sales Tax on purchases shipping outside of Colorado.
				</p>
				<p>
				<span class="bold_red">Shipping Information:</span>  The buyer will pay actual costs of packing and insured shipping.  To receive an estimate of the packing and shipping, be sure to include your Zip Code (for US destinations) or Country (for international destinations).
				</p>
				<p>
				<span class="bold_red">Return Policy:</span> No cash refunds for artwork received in good condition.  However, if you are not satisfied when you receive the work, within 30 days of your receipt of the work you may exchange the piece for another piece of equal value, or use the credit toward another piece of greater value. In the event of an exchange, Buyer is responsible for both the return shipping of original piece to artist, as well as shipping of replacement piece.
				</p>
				<p>
				For further information, you can always send us email using this <a href="contact.php">Contact</a> form.
				</p>
				<p>
				We appreciate your interest in Carolyn's art.  
				</p>
			</div>
		</div>
	<?php include("./templates/footer.htm"); ?>
  </body>
</html>
