<?php
	$page_title = "What's New with Artgroove.com?!";
	$desc = "Here is the most recent News from artgroove.com";
	$keys = "Artgroove.com,artgroove,news,newsletter,what's new,subscribe";
	include("./templates/header.php");
	$item = $_GET["item"];
?>

<body>
	<?php
		// set up array of news content--one of these is included to build the page
		$news_items = array("news-130330","news-110816","news-070310","news-050221","news-020426","gift-cert","sell-direct","imageonbook","paintwholesale");
		
		if (!isset($item))
			$item = 0;
	?>
	<div id="wrapper">
	<?php include ("./templates/nav_header.html"); ?>
		<div class="left_align_narrow">
			<?php include "./newsletter/newsitems/" . $news_items[$item] . ".htm"; ?>

			<h2 class="newsletter_head">NewsLetter Archive</h2>
					
			<ul class="news_list">
				<li> 
				<a href="./newsletter.php?item=0">Current News</a>
				</li>
				<li> 
				<a href="./newsletter.php?item=1">16 Aug 2011</a>
				</li>
				<li> 
				<a href="./newsletter.php?item=2">10 March 2007</a>
				</li>
				<li> 
				<a href="./newsletter.php?item=3">21 February 2005</a>
				</li>
				<li> 
				<a href="./newsletter.php?item=4">Carolyn Ellingson, 1937 - 2002</a>
				</li>
				<li> 
				<a href="./newsletter.php?item=5">Give a Gift Certificate for Art</a>
				</li>
				<li> 
				<a href="./newsletter.php?item=6">Selling Art Directly to Collectors - from an Artist's Point of View</a>
				</li>
				<li> 
				<a href="./newsletter.php?item=7">My Image on a Book Cover</a>
				</li>
				<li> 
				<a href="./newsletter.php?item=8">Why Can't Professional Artists Buy Their Paint Wholesale?</a>
				</li>

			</ul>
		</div>
	</div>
	<?php include("./templates/footer.htm"); ?>
</body>
</html>
