<?php
  $page_title = "In Memory, VI, by Carolyn Ellingson";
	$desc = $page_title . ", part of the Crash series dedicated to Bill Bateman";
  include("../../templates/header.php");
?>
<body>
  <?php include "../../templates/nav_header.html"; ?>
	<div class="left_align_narrow">
		<div class="center">
			<a href="./crash5.php"><img id="crash_left_arrow" onmousedown="change_image(this.id, '../../images/arrow_left_active.gif')" 
				onmouseup="change_image(this.id, '../../images/arrow_left_red.gif')" src="../../images/arrow_left_red.gif" alt="Previous" /></a>
			<img src="../../images/crash/crash6.jpg" alt="In Memory, VI" />
			<a href="./crash7.php"><img id="crash_right_arrow" onmousedown="change_image(this.id, '../../images/arrow_right_active.gif')" 
				onmouseup="change_image(this.id, '../../images/arrow_right_red.gif')" src="../../images/arrow_right_red.gif" alt="Next" /></a>
			<br />
		</div>
		<p class="front_page_image">
			<span>In Memory, VI</span>
		</p>
		<p>
			"At my feet lay a litter of dead leaves, cigarette cartons and glass crystals.  These fragments of broken safety glass, brushed to one side by generations of ambulance attendants, lay in a small drift.  I stared down at this dusty necklace, the debris of a thousand automobile accidents.  Within fifty years, as more and more cars collided here, the glass fragments would form a sizable bar, within thirty years a beach of sharp crystal."<br /><br />
		</p>
		<p>
			<a href="./captions.php">Back to Crash Overview</a><br /><br /><br />
		</p>

		<p id="copyright">
			Photo and image Copyright &copy; Carolyn Ellingson 1997-<?php print(date("Y")); ?>, All Rights Reserved.
			<br />
			Caption from the book Crash by J. G. Ballard, 1973. Permission granted for use. 
		</p>
	</div>
</body>
</html>