<?php
$page_title = "Subscribe to Artgroove News";
$desc = "Artgroove.com Newsletter Subscription Form: Subscribe to the Artgroove.com Newsletter, featuring news about the art of Carolyn Ellingson";
$keys = "artgroove.com,subscribe,newsletter";
include("./templates/header.php");
?>
<body>
	<div id="wrapper">
		<?php include "./templates/nav_header.html"; ?>

		<div class="left_align_narrow">
			<h2>Artgroove Contact Form</h2>
        <?php
        // Newsletter subscription form
        // We'll only display the form if:
        // - the page load is NOT a form posting, or
        // - the posted data doesn't validate

        $form_err = FALSE;  // we actually use this regardless of post or not
        //
        // get & validate data from form if this is a post
        if (isset($_POST['subscribe'])) {
            $submit = $_POST['subscribe'];
            $firstname = $_POST['firstname'];
            $lastname = $_POST['lastname'];
            $email = $_POST['email'];

            $lname_err = "";
            $fname_err = "";
            $email_err = "";

            // validation portion (required fields and specific data configurations)
            if (empty($firstname)) {
                $fname_err = '<span class="err">Error:  Please fill in a first name!</span>';
                $form_err = TRUE;
            }
            if (empty($lastname)) {
                $lname_err = '<span class="err">Error:  Please fill in a last name!</span>';
                $form_err = TRUE;
            }
            if (empty($email)) {
                $email_err = '<span class="err">Error:  Please fill in a valid email address!</span>';
                $form_err = TRUE;
            } elseif (!check_email($email)) {
                $form_err = TRUE;
                $email_err = '<span class="err">Error:  "' . $email . '" doesn\'t appear to be a valid email
                                                         address.  Please enter a valid email.</span>';
            }
            if (!$form_err) {  // subscribe user - add to database
                $conn = new mysqli($db_host, $user, $pw, $dbase);
                if ($conn->errno) {
                    die("Error: $conn->error()<br />");
                }
                // check for existence of user in dbase - error out if true
                $sql = "SELECT * FROM subscribers
                    WHERE firstname = '$firstname' AND
                    lastname = '$lastname' AND
                    email = '$email'";
                if ($result = $conn->query($sql)) {
                    if (mysqli_num_rows($result) == 0) { // no matches, add to dbase
                        $sql = "INSERT INTO subscribers
                                (id, email, firstname, lastname) VALUES
                                (NULL, '$email', '$firstname', '$lastname');";
                        if ($conn->query($sql)) {  // successful addition!
                            print "<h2>Thank you for subscribing to the Record
                                Barn Newsletter!</h2>";
                        } else {  // unsuccessful addition
                            die("INSERT INTO subscribers failed: $conn->error()");
                        }
                    } else {  // user is already subscribed!
                        print "<h2>There appears to already be a $firstname $lastname
                         subscribed with the identical $email address!</h2>";
                    }
                } else {
                    die("Query of subscribers failed: $conn->error()");
                }
                $conn->close();
            }  // post with validation errors
        }
        // Set an appropriate form legend based on validation
        if ($form_err) {
            $legend = "<span class=\"err\">Error:  Missing or Broken Data!</span>";
        } else {
            $legend = "Subscription Form";
        }
        if ((!isset($submit)) ||
                (isset($submit) && $form_err)) { // the only cases in which we display the form
            $subscribe_form = <<< END_OF_SUBSCRIBE
        <h2>Sign Up for the Record Barn Newsletter</h2>
        <p>Our newsletter comes out once a month--if that's too frequent for you,
            simply unsubscribe (it's easy!).  We do not sell or distribute any user information!!
        </p>
        <form id="signup" action="newsletter.php" method="post">
            <fieldset><legend>$legend</legend>
                <label for="firstname">First name: </label>
                    <input type="text" name="firstname" id="firstname" value="$firstname" />$fname_err<br />
                <label for="lastname">Last name: </label>
                    <input type="text" name="lastname" id="lastname" value="$lastname" />$lname_err<br />
                <label for="email">Email: </label>
                    <input type="text" name="email" id="email" value="$email" />$email_err<br />
                <input type="submit" value="Subscribe" name="subscribe" />
            </fieldset>
        </form>
END_OF_SUBSCRIBE;

            print $subscribe_form;
        }
        ?>
    </div>
    <div id="right_bar">
        <img src="images/bestseller_ad2.jpg" alt="Record Barn Best Sellers" class="ad_img" />
        <img src="images/events.jpg" alt="Record Barn Events" class="ad_img" />
    </div>
</div>

<?php include("templates/footer.php"); ?>

</body>
</html>

