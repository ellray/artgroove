<?php $page_title = "Calendar";
      include("templates/header.php");
?>

      <?php include("templates/masthead.php"); ?>

      <div id="mid_container">
        <div id="left_bar">

          <?php include("templates/nav.php"); ?>

        </div>
        <div id="content">
          <?php
          include("templates/mini_calendar.php");
          ?>
        </div>
        <div id="right_bar">
          <a href="bestsellers.htm">
            <img src="images/bestseller_ad2.jpg" alt="Record Barn Best Sellers" class="ad_img" /></a>
          <a href="events.htm">
            <img src="images/events.jpg" alt="Record Barn Events" class="ad_img" /></a>
        </div>
      </div>

      <?php include("templates/footer.php"); ?>

</body>
</html>

