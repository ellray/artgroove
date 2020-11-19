<?php
  $page_title = "Bill Bateman Memorial Exhibition";
	$desc = "Artgroove.com: Bill Bateman Memorial Exhibition";
	$keys = "Artgroove.com,artgroove,bill bateman,tragic,special,crash,art,Carolyn Ellingson";
  include("../../templates/header.php");
?>
<body>
	<div id="wrapper">
  <?php include "../../templates/nav_header.html"; ?>

	<div class="left_align_narrow">
		<h2>Bill Bateman Memorial Exhibition</h2>
		
		<p>
			This is a special exhibition of monotypes put together by Carolyn as she struggled to make sense of the tragic death of her cousin and close friend, <a href="/bateman.php">Bill Bateman</a>.
		</p>
		<p>
			Captions under first eight prints are from the book <a href="http://www.amazon.com/exec/obidos/ASIN/0374524122/qid=907517749/sr=1-24/002-9395039-9339068" target="_blank">&quot;Crash&quot;</a> by J. G. Ballard, 1973.  J. G. Ballard has granted the artist permission to use these captions here.  Click the thumbnails below to view an individual piece and text, or use the arrow below to enter the exhibit.
		</p>		
		<div class="float_left">
			<table><tr><td>
				<a href="./crash1.php">ENTER</a></td>
				<td><a href="./crash1.php"><img id="crash_right_arrow" onmousedown="change_image(this.id, '../../images/arrow_right_active.gif')" onmouseup="change_image(this.id, '../../images/arrow_right_red.gif')" src="../../images/arrow_right_red.gif" alt="Next" /></a>
				</td></tr>
			</table>
		</div>

		<table id="exhibit"><tr>
			<td><a href="./crash1.php">
				<img src="/db_images/dbthumbs/t_0923_in_memory_i.jpg" alt="In Memory, I" /><br />
				<span class="italic_title">In Memory, I</span></a>
			</td>
			<td><a href="./crash2.php">
				<img src="/db_images/dbthumbs/t_0002_in_memory_ii.jpg" alt="In Memory, II" /><br />
				<span class="italic_title">In Memory, II</span></a>
			</td>
			<td><a href="./crash3.php">
				<img src="/db_images/dbthumbs/t_0924_in_memory_iii.jpg" alt="In Memory, III" /><br />
				<span class="italic_title">In Memory, III</span></a>
			</td></tr><tr>
			<td><a href="./crash4.php">
				<img src="/db_images/dbthumbs/t_0003_in_memory_iv.jpg" alt="In Memory, IV" /><br />
				<span class="italic_title">In Memory, IV</span></a>
			</td>
			<td><a href="./crash5.php">
				<img src="/db_images/dbthumbs/t_0925_in_memory_v.jpg" alt="In Memory, V" /><br />
				<span class="italic_title">In Memory, V</span></a>
			</td>
			<td><a href="./crash6.php">
				<img src="/db_images/dbthumbs/t_0004_in_memory_vi.jpg" alt="In Memory, VI" /><br />
				<span class="italic_title">In Memory, VI</span></a>
			</td></tr><tr>
			<td><a href="./crash7.php">
				<img src="/db_images/dbthumbs/t_0081_in_memory_vii.jpg" alt="In Memory, VII" /><br />
				<span class="italic_title">In Memory, VII</span></a>
			</td>
			<td><a href="./crash8.php">
				<img src="/db_images/dbthumbs/t_0926_in_memory_viii.jpg" alt="In Memory, VIII" /><br />
				<span class="italic_title">In Memory, VIII</span></a>
			</td>
			<td><a href="./crash9.php">
				<img src="/db_images/dbthumbs/t_0388_in_memory_ix.jpg" alt="In Memory, IX" /><br />
				<span class="italic_title">In Memory, IX</span></a>
			</td></tr><tr>
			<td><a href="./crash10.php">
				<img src="/db_images/dbthumbs/t_0927_in_memory_x.jpg" alt="In Memory, X" /><br />
				<span class="italic_title">In Memory, X</span></a>
			</td>
		</tr></table>
	</div>
	</div>
	<?php include("../../templates/footer.htm"); ?>
</body>
</html>
