<?php
  $page_title = "Some of Carolyn's Favorite Artist Colleagues";
	$desc = "Artgroove.com: Other Artists of Personal Interest to Carolyn--friends and colleagues who make great art.";
	$keys = "Artgroove.com,artgroove,artists,friends,other artists";
  include("./templates/header.php");
?>
<body>
	<div id="wrapper">
  <?php include "./templates/nav_header.html"; ?>

  <div class="left_align_float">
		<h2>More Artists</h2>
		<p>
		Carolyn invited these artists to post links on her site.  Click on an image to see more information about each artist's work.
		<br />
		If you are one of these artists and wish to make a change, please <a href="contact.php">contact us</a>.
		<br />
		</p>

		<div id="more_artists_div">

			<a href="./moreartists/akamine.php"><div class="artist_cell">
				<h3>Estelle Akamine</h3>
				<p>
				<img src="./moreartists/image/akamine/amishstarquilt_160.jpg" alt="Amish Star Quilt" />
				</p>
			</div></a>

			<a href="./moreartists/bates.php"><div class="artist_cell">
				<h3>Bates Poland Bates</h3>
				<p>
				<img src="./moreartists/image/bates/A._K._Smith_with_StretchersII.jpg-tn.jpg" alt="A. K. Smith with Stretchers II" />
				</p>
			</div></a>

			<a href="./moreartists/brophy.php"><div class="artist_cell">
				<h3>Ruth Brophy</h3>
				<p>
				<img src="./moreartists/image/brophy/opera2-tn.jpg" alt="Opera 2" />
				</p>
			</div></a>

			<a href="./moreartists/huckaby.php"><div class="artist_cell">
				<h3>Santie Huckaby</h3>
				<p>
				<img src="./moreartists/image/huckaby/papa_john_creech-tn.jpg" alt="Papa John Creech" />
				</p>
			</div></a>

			<a href="./moreartists/huff.php"><div class="artist_cell">
				<h3>Peggy Huff</h3>
				<p>
				<img src="./moreartists/image/huff/gulliver1-tn.jpg" alt="Gulliver 1" />
				</p>
			</div></a>

			<a href="./moreartists/clegg.php"><div class="artist_cell">
				<h3>Donald Clegg</h3>
				<p>
				<img src="./moreartists/image/clegg/garden_medley_9-tn.jpg" alt="Garden Medley #9" />
				</p>
			</div></a>

			<a href="./moreartists/kussano.php"><div class="artist_cell">
				<h3>Claudia Kussano</h3>
				<p>
				<img src="./moreartists/image/kussano/knit_choker-tn.jpg" alt="Knit Choker" />
				</p>
			</div></a>

			<a href="./moreartists/patton.php"><div class="artist_cell">
				<h3>John Patton</h3>
				<p>
				<img src="./moreartists/image/patton/jp_3_0378_160.jpg" alt="John Patton Painting" />
				</p>
			</div></a>

			<a href="./moreartists/sugita.php"><div class="artist_cell">
				<h3>Toru Sugita</h3>
				<p>
				<img src="./moreartists/image/sugita/angular_transition-tn.jpg" alt="Angular Transition" />
				</p>
			</div></a>

			<a href="./moreartists/wilson.php"><div class="artist_cell">
				<h3>Pat Wilson</h3>
				<p>
				<img src="./moreartists/image/wilson/chickenshaman-tn.jpg" alt="Chicken Shaman" />
				</p>
			</div></a>
			
			<!-- force clear of the above "contained" floated divs -->
			<br class="clear" />
			
		</div>
	</div>
	</div>
	<?php include("./templates/footer.htm"); ?>
  </body>
</html>
