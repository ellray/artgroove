<?php
  $page_title = "\"In Memory, IV\" by Carolyn Ellingson";
  include("../../templates/header.php");
?>
<body>
  <?php include "../../templates/nav_header.html"; ?>
	<div class="left_align_narrow">
		<div class="center">
			<a href="./crash3.php" id="crash_left_arrow" onmousedown="change_image(this, '../../images/arrow_left_active.gif')" 
				onmouseup="change_image(this, '../../images/arrow_left_red.gif')"><img src="../../images/arrow_left_red.gif" alt="Previous" /></a>
			<img src="./crash4.jpg" alt="In Memory, IV" />
			<a href="./crash5.php" id="crash_right_arrow" onmousedown="change_image(this, '../../images/arrow_right_active.gif')" 
				onmouseup="change_image(this, '../../images/arrow_right_red.gif')"><img src="../../images/arrow_right_red.gif" alt="Next" /></a>
			<br />
		</div>
		<p class="front_page_image">
			<span>In Memory, IV</span>
		</p>
		<p>
			"I had thoughts of his last moments alive, frantic milliseconds of pain and violence in which he had been catapulted from a pleasant domestic interlude into a concertina of metalized death."<br /><br />
		</p>
		<p>
			<a href="../../captions.php">Back to Crash Overview</a><br /><br /><br />
		</p>

		<p id="copyright">
			Photo and image Copyright &copy; Carolyn Ellingson 1997-2011, All Rights Reserved.
			<br />
			Caption from the book Crash by J. G. Ballard, 1973. Permission granted for use. 
		</p>
	</div>
</body>
</html>