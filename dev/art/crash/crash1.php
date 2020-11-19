<?php
  $page_title = "\"In Memory, I\" by Carolyn Ellingson";
  include("../../templates/header.php");
?>
<body>
  <?php include "../../templates/nav_header.html"; ?>
	<div class="left_align_narrow">
		<div class="center">
			<img src="./crash1.jpg" alt="In Memory, I" />
			<a href="./crash2.php" id="crash_right_arrow" onmousedown="change_image(this, '../../images/arrow_right_active.gif')" 
				onmouseup="change_image(this, '../../images/arrow_right_red.gif')"><img src="../../images/arrow_right_red.gif" alt="Next" /></a>
			<br />
		</div>
		<p class="front_page_image">
			<span>In Memory, I</span>
		</p>
		<p>
			"In our wounds we celebrated the re-birth of the traffic-slain dead, the deaths and injuries of those we had seen dying by the roadside and the imaginary wounds and postures of the millions yet to die."<br /><br />
		</p>
		<p><a href="../../captions.php">Back to Crash Overview</a><br /><br /><br />
		</p>

		<p id="copyright">
			Photo and image Copyright &copy; Carolyn Ellingson 1997-2011, All Rights Reserved.<br />
			Caption from the book Crash by J. G. Ballard, 1973. Permission granted for use. 
		</p>
	</div>
</body>
</html>