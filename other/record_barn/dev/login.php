<?php
$page_title = "Login";
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
include("templates/db_funcs.php");
include("templates/header.php");
include("templates/masthead.php");
?>

<div id="mid_container">
    <div id="left_bar">
        <?php include("templates/nav.php"); ?>
    </div>

    <div>
        <div  id="form_section">
            <?php
            session_start();
            if ($_SESSION['logged_in']) {
                header('Location: index.php');
            } else {  // not yet logged in; could still be form submission
                $logged_in = FALSE;
                $connection = new mysqli($db_host, $user, $pw, $dbase);
                if ($connection->errno) {
                    die("Error: $connection->error()<br />");
                }
                if (isset($_POST['Login'])) {
                    // Get the data from the form
                    $name = $_POST['name'];
                    $pass = $_POST['password'];

                    $name = strip_tags($name);
                    $pass = strip_tags($pass);
                    $name = $connection->real_escape_string($name);
                    $pass = $connection->real_escape_string($pass);

                    $sql = "SELECT * FROM users WHERE name = '$name'";
                    //print "<div class=\"err\">sql = $sql</div>";

                    if ($result = $connection->query($sql)) {
                        while ($row = $result->fetch_row()) {
                            if (( $row[1] == $name ) && ( $row[2] == $pass ) &&
                                    ( $name != "" ) & ( $pass != "" )) {
                                print "<h2>Welcome $row[1]! You are now logged in.</h2>";
                                $logged_in = true;
                                $_SESSION['logged_in'] = true;
                                $_SESSION['name'] = $row[1];
                                header('Location: index.php');
                            }
                        }
                        if ($_SESSION['logged_in'] != true) {
                            print "<h2>Please Try Again.</h2>";
                        }
                    } else {  // connection failure
                        print "<p>Connection failure!</p>";
                    }
                } else {   // display login form
                    $login_form = <<< END_OF_LOGIN_FORM
       <form action="login.php" method="post">
         <div><fieldset>
           <span class="bold">Please Log In</span><br />
           Name:  <input type="text" id="name" value="$name" name="name" /><br />
           Password: <input type="password" name="password" id="pass" /><br />
           <input type="submit" value="login" name="Login" />
           </fieldset>
         </div>
       </form>
END_OF_LOGIN_FORM;

                    print $login_form;
                }
                $connection->close();
            }
            ?>
            </div>
        </div>

        <div id="right_bar">
            <img src="images/bestseller_ad2.jpg" alt="Book Barn Best Sellers" class="ad_img" />
            <img src="images/events.jpg" alt="Book Barn Events" class="ad_img" />
        </div>
    </div>

<?php include('templates/footer.php'); ?>


</body>
</html>