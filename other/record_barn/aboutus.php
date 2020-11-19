<?php
$page_title = "About Us";
include("templates/header.php");
include("templates/db_funcs.php");
?>

    <?php include("templates/masthead.php"); ?>

      <div id="mid_container">
        <div id="left_bar">

          <?php include("templates/nav.php"); ?>

        </div>
        <div id="form_section">
          <h3>About Us</h3><hr />
          <p class="clean">Record Barn - New and Used Vinyl Records!<br />
          2456 Marmot Street<br />
          Spokane WA 99000<br /></p>
          <p class="clean">509-555-5555<br />
          recordbarn@recordbarn.com</p>

          <?php include("templates/contact_form.php"); ?>

          <div>
            <div class="left_float"><p class="bold">Hours:</p></div>
            <div class="left_indent"><ul>
                <li>M-F: 10a - 10p</li>
                <li>Sat: 10a - 11p</li>
                <li>Sun: 11a - 6p</li></ul></div>
            <p>Subscribe to the Record Barn <a href="newsletter.php">Newsletter</a> for the latest on Events, Specials and Community Happenings!</p>
          </div>
        </div>
        <div id="right_bar">
          <a href="bestsellers.php">
            <img src="images/bestseller_ad2.jpg" alt="Book Barn Best Sellers" class="ad_img" /></a>
          <a href="events.php">
            <img src="images/events.jpg" alt="Book Barn Events" class="ad_img" /></a>
        </div>
      </div>

      <?php include("templates/footer.php"); ?>

  </body>
</html>

