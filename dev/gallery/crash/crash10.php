<?php
  $page_title = "In Memory, X, by Carolyn Ellingson";
	$desc = $page_title . ", part of the Crash series dedicated to Bill Bateman";
  include("../../templates/header.php");
?>
<body>
  <?php include "../../templates/nav_header.html"; ?>
	<div class="left_align_narrow">
		<div class="center">
			<a href="./crash9.php"><img src="../../images/arrow_left_red.gif" id="crash_left_arrow" onmousedown="change_image(this.id, '../../images/arrow_left_active.gif')" onmouseup="change_image(this.id, '../../images/arrow_left_red.gif')" alt="Previous" /></a>
			<img src="../../images/crash/crash10.jpg" alt="In Memory, X" />
			<br />
		</div>
		<p class="front_page_image">
			<span>In Memory, X</span>
		</p>
		<p>
			. . . you will be with us always.<br /><br />
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