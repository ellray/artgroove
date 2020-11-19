<?php $page_title = "Logout";
      include("templates/header.php");
?>

      <?php include("templates/masthead.php"); ?>

      <?php   session_destroy();
              header('Location: index.php');
      ?>

      <div id="mid_container">
        <div id="left_bar">
          <?php include("templates/nav.php"); ?>
        </div>
      </div>

      <?php include("templates/footer.php"); ?>

  </body>
</html>

