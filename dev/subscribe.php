<?php
$page_title = "Subscribe to Artgroove.com News";
$desc = "Artgroove.com Newsletter Subscription Form: Subscribe to the Artgroove.com Newsletter, featuring news about the art of Carolyn Ellingson";
$keys = "artgroove.com,subscribe,newsletter";
include("./templates/header.php");
?>
<body>
	<div id="wrapper">
		<?php include "./templates/nav_header.html"; ?>

		<div class="left_align_narrow" id="form_container">
			<?php
			error_reporting(0);  // turn off warning display in case of database failures
			// Newsletter subscribe/unsubscribe form
			// We'll only display the form if:
			// - the page load is NOT a form posting, or
			// - the posted data doesn't validate
			require './templates/funcs.php';
			
			$exists = FALSE;  // email already in dbase?
			$form_err = FALSE;  // we actually use this regardless of post or not
			//
			// get & validate data from form if this is a post
			if (isset($_POST['submit'])) {
				$sub = 0;
				if ($_POST['action'] == 'subscribe') {
					$sub = 1;
					$sub_checked = 'checked="checked"';  // used to persist radio button setting
					$unsub_checked = '';
				}
				else {
					$sub_checked = '';
					$unsub_checked = 'checked="checked"';
				}
				// print "<p>DEBUG: INSIDE 'isset(_POST[Update])'<br />sub = $sub</p>";
				// print "<p>";
				// foreach ($_POST as $key => $val)
					// print "$key => $val <br />";
				// print "</p>";
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
				} elseif (!validate_email($email)) {
					$form_err = TRUE;
					$email_err = '<span class="err">Error:  "' . $email . '" doesn\'t appear to be a valid email
																									 address.</span>';
				}
				// set up dbase connection to enable real_escape_string()
				require './php/db.php';
				$conn = new mysqli($hostname, $username, $password, $databasename); 
				if (mysqli_connect_error()) {
					die('<h3 class="err">Sorry, we appear to have a problem with our database.</h3>');
					mail("jeff@webmondrian.com", "Database Error", $e->getMessage());
				}

				// sanitize input to prevent SQL injection...
				$firstname = mysqli_real_escape_string($conn,strip_tags(trim($firstname)));
				$lastname = mysqli_real_escape_string($conn, strip_tags(trim($lastname)));
				$email = mysqli_real_escape_string($conn, strip_tags(trim($email)));
				$sub_yes = $sub ? "yes" : "no";

				// check for existence of user in dbase - error out if true
				$sql = "SELECT * FROM contacts WHERE email = '$email'";
				if ($result = $conn->query($sql)) {
					if (mysqli_num_rows($result) == 1) {  // this user already in dbase
						$exists = TRUE;
						// unset name validation errors from above--we don't require name
						//    fields if the user is already in our database
						$fname_err = $lname_err = "";
						// unset $form_err if $email_err is unset (only errors would have been name fields)
						if ($email_err == "")
							$form_err = FALSE;
						// get names out of dbase if there
						$row = mysqli_fetch_assoc($result);
						$db_firstname = $row['firstname'];
						$db_lastname = $row['lastname'];
					}
				}
				else { // broken dbase  :-(
					die('<h3 class="err">Sorry, we appear to have a problem with our database.</h3>');
					mail("jeff@webmondrian.com", "Database Error", $e->getMessage());
				}
				
				
				// slight complication here:  push forward with update regardless of 
				//     name field validation if email is already in dbase
				// only redisplay form with errors if email is new to us
				if (!$form_err | $exists) {  // subscribe or unsubscribe user
					if (!$exists) { // not in dbase yet---add
						$sql = "INSERT INTO contacts
										(id, email, firstname, lastname, subscribed) VALUES
										(NULL, '$email', '$firstname', '$lastname', '$sub');";
						if ($conn->query($sql)) {  // successful addition!
							print "<h3>Thank you for subscribing to the Artgroove.com Newsletter!</h3>";
							print "<p>Your current settings are:<br />";
							print "First: $firstname<br />Last: $lastname<br />Email: $email<br />";
							print "Subscribed = $sub_yes</p>";
							print "<p>Please use our Subscription form to update your information anytime.</p>";
						}
						else {  // unsuccessful addition
							die('<h3 class="err">Sorry, we appear to have a problem with our database.</h3>');
							mail("jeff@webmondrian.com", "Database Error", $e->getMessage());
						}
					}
					else {  // user already in dbase
						// need to update subscriber info
						// don't update empty fields (not validated for unsubscribing...)
						// but get the firstname & lastname from returned data (need these for 
						//    update msg to user on result page
						// but use entered data if the user filled in name fields(s)
						if ($firstname == "") {
							$sql_first =  "";
							$firstname = $db_firstname;
						}
						else {
							$sql_first = "firstname='$firstname', ";
						}
						if ($lastname == "") {
							$sql_last = "";
							$lastname = $db_lastname;
						}
						else {
							$sql_last = "lastname='$lastname', ";
						}
					
						$sql = "UPDATE contacts SET $sql_first $sql_last subscribed='$sub' WHERE email='$email'";
						if ($result = $conn->query($sql)) {
							// successful update!
							print "<h3>Thank you!  Your information has been updated.</h3>";
							print "<p>Your current settings are:<br />";
							print "First: $firstname<br />Last: $lastname<br />Email: $email<br />";
							print "Subscribed = $sub_yes</p>";
							print "<p>Please use our Subscription form to update your information anytime.</p>";
						}
						else { // broken dbase  :-(
							die('<h3 class="err">Sorry, we appear to have a problem with our database.</h3>');
							mail("jeff@webmondrian.com", "Database Error", $e->getMessage());
						}
					}
					$conn->close();
				}  
			}
			// Set an appropriate form legend based on validation
			if ($form_err) {
				$legend = "<span class='err'>Error:  Missing Data?</span>";
			} 
			else {
				$legend = "Subscription Settings Form";
			}
			// form displays if:
			//    - not a POST OR
			//    - POST with form errors AND the entered email isn't in the dbase
			if ((!isset($_POST['submit'])) ||
							(isset($_POST['submit']) && $form_err && !$exists)) { 
					$subscribe_form = <<< END_OF_SUBSCRIBE
			<h2>Sign Up for the Artgroove.com Newsletter</h2>
			<p>If you're ever bothered by the frequency or content of our newsletters,
					simply unsubscribe (it's easy!).
			</p>
			<p class="bold">We do not use or distribute your information in any way.  See our Privacy Policy <a href="./privacy.php">here</a>.</p>
			<form id="signup" action="subscribe.php" method="post">
					<fieldset><legend>$legend</legend>
						<table class="form_table"><tr>
								<td><label for="firstname">First name: </label></td>
								<td><input type="text" name="firstname" id="firstname" value="$firstname" /></td>
								<td>$fname_err</td>
							</tr><tr>
								<td><label for="lastname">Last name: </label></td>
								<td><input type="text" name="lastname" id="lastname" value="$lastname" /></td>
								<td>$lname_err</td>
							</tr><tr>
								<td><label for="email">Email: </label></td>
								<td><input type="email" name="email" id="email" value="$email" /></td>
								<td>$email_err</td>
						</tr></table>
					</fieldset>
				<br />
				<input type="radio" name="action" value="subscribe" id="sub" $sub_checked />
					<label for="sub">Subscribe</label>
				<br />
				<input type="radio" name="action" value="unsubscribe" id="unsub" $unsub_checked />
					<label for="unsub">Unsubscribe</label>
				<br /><br />
				<input type="submit" value="Update" name="submit" />
			</form>
			<p><br /><span class="bold">NOTE:</span> If your email address is already on our list, the name fields are not required.  If you are subscribing a new email, however, we would like your name as well.  (If you
			would prefer not to enter your name, simply choose a false name.)
			</p>
			
END_OF_SUBSCRIBE;

					print $subscribe_form;
			}
			?>
    </div>
	</div>
	<?php include("./templates/footer.htm"); ?>
</body>
</html>

