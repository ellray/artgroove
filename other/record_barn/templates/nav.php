          <div id="menu">
            <ul>
                <!-- fix the current_link styling later...  -->
              <li><a href="index.php" class=
                   <?php if ($page_title=="Home")
                       echo "\"current_link\"";
                       else echo "\"\""?>>Home</a></li>
              <li><a href="aboutus.php" class=
                   <?php if ($page_title=="About Us")
                       echo "\"current_link\"";
                       else echo "\"\""; ?>>About Us</a></li>
              <li><a href="products.php" class=
                   <?php if ($page_title=="Products")
                       echo "\"current_link\""; 
                       else echo "\"\""; ?>>Products</a></li>
              <li><a href="newsletter.php" class=
                   <?php if ($page_title=="NewsLetter")
                       echo "\"current_link\"";
                       else echo "\"\""; ?>>Newsletter</a></li>
              <li><a href="blog.php" class=
                   <?php if ($page_title=="Blogs")
                       echo "\"current_link\"";
                       else echo "\"\""; ?>>Blog</a></li>
              <li><a href="calendar.php" class=
                   <?php if ($page_title=="Calendar")
                       echo "\"current_link\"";
                       else echo "\"\""; ?>>Calendar</a></li>
              <li><a href="articles.php" class=
                   <?php if ($page_title=="Articles")
                       echo "\"current_link\"";
                       else echo "\"\""; ?>>Articles</a></li>
              <li><?php
                    if (!$_SESSION['logged_in']) {
                        print '<a href="login.php" class=';
                        if ($page_title=="Login")
                            echo "\"current_link\"";
                        else echo "\"\"";
                        print '>Login</a></li>';
                    }
                    else {
                        print '<a href="logout.php">Logout</a></li>';
                    }
                    ?>
            </ul>
	  </div>
