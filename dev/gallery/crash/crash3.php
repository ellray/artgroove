<?php
	$page_title = "In Memory, III, by Carolyn Ellingson";
	$desc = $page_title . ", part of the Crash series dedicated to Bill Bateman";
	include("../../templates/header.php");
?>
<body>
	<?php include "../../templates/nav_header.html"; ?>
	<div class="left_align_narrow">
		<div class="center">
			<a href="./crash2.php"><img id="crash_left_arrow" onmousedown="change_image(this.id, '../../images/arrow_left_active.gif')" 
				onmouseup="change_image(this.id, '../../images/arrow_left_red.gif')" src="../../images/arrow_left_red.gif" alt="Previous" /></a>
			<img src="../../images/crash/crash3.jpg" alt="In Memory, III" />
			<a href="./crash4.php"><img id="crash_right_arrow" onmousedown="change_image(this.id, '../../images/arrow_right_active.gif')" 
				onmouseup="change_image(this.id, '../../images/arrow_right_red.gif')" src="../../images/arrow_right_red.gif" alt="Next" /></a>
			<br />
		</div>
		<p class="front_page_image">
			<span>In Memory, III</span>
		</p>
		<p>
			"For a moment I felt we were the principal actors at the climax of some grim drama in an unrehearsed theatre of technology, involving these crushed machines, the dead man destroyed in their collision, and the hundreds of drivers waiting beside the stage with their headlamps blazing."<br /><br />
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