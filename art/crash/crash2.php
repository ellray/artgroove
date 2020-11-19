<?php
  $page_title = "\"In Memory, II\" by Carolyn Ellingson";
  include("../../templates/header.php");
?>
<body>
  <?php include "../../templates/nav_header.html"; ?>
	<div class="left_align_narrow">
		<div class="center">
			<a href="./crash1.php" id="crash_left_arrow" onmousedown="change_image(this, '../../images/arrow_left_active.gif')" 
				onmouseup="change_image(this, '../../images/arrow_left_red.gif')"><img src="../../images/arrow_left_red.gif" alt="Previous" /></a>
			<img src="./crash2.jpg" alt="In Memory, II" />
			<a href="./crash3.php" id="crash_right_arrow" onmousedown="change_image(this, '../../images/arrow_right_active.gif')" 
				onmouseup="change_image(this, '../../images/arrow_right_red.gif')"><img src="../../images/arrow_right_red.gif" alt="Next" /></a>
			<br />
		</div>
		<p class="front_page_image">
			<span>In Memory, II</span>
		</p>
		<p>
			"The cars overtaking us were now being superheated by the sunlight, and I was sure that their metal bodies were only a fraction of a degree below their melting points, held together by the force of my own vision, and that the slightest shift of my attention to the steering wheel would burst the metal films that held them together and break these blocks of boiling steel across our path."<br /><br />
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