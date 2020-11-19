<?php
  $page_title = "Talk to artgroove.com!";
	$desc = "Artgroove.com: Contact Us about art, life, magic or anything else!";
	$keys = "Artgroove.com,artgroove,contact,email,form,art,Carolyn Ellingson";
  include("./templates/header.php");
?>
<body>
	<div id="wrapper">
		<?php include "./templates/nav_header.html"; ?>

		<div class="left_align_narrow" id="form_container">
			<h2>Artgroove Contact Form</h2>
			<p>

			<?php
			global $msg;
			global $headers;
			function validate(&$check, $fld, &$error_field, $invalidchars = "", $blanks = "")
			{
				$expr = "^[_\.0-9a-z-]+@([0-9a-z][0-9a-z-]+\.)+[a-z][a-z]+\$";
				//echo "expr=" . $expr . "<br>";
				if ((!$fld) || ($fld == "") || (!eregi($expr,$fld))) {
					if ($invalidchars > "") {
						$error_field = $invalidchars . "<br>\n";
					} else {
						$error_field = "invalid characters<br>\n";
					}
					if ($check == true) $check = false;
				}
				if (strrpos($fld,' ') > 0) {
					if ($blanks > "") {
						$error_field = $blanks . "<br>\n";
					} else {
						$error_field = "Spaces in e-mail<br>\n";
					}
					if ($check == true) $check = false;
				}
			}

			$curator_email = 'ellray@comcast.net';

			if (empty($subject)) $subject = "";
			if (empty($err_subject)) $err_subject = "";
			if (empty($name)) $name = "";
			if (empty($err_name)) $err_name = "";
			if (empty($email_address)) $email_address = "";
			if (empty($err_email_address)) $err_email_address = "";
			if (empty($message)) $message = "";
			if (empty($err_message)) $err_message = "";

			$checked = true;
			if (isset($submit))
			{
				validate($checked, $email_address, $err_email_address, "<span class='err'>*The e-mail contains invalid characters or is incomplete</span>", "<span class='err'>*The e-mail contains spaces</span>");

				if ($subject == "") 
				{ $err_subject = "<span class='err'>*Please include a subject</span>";
					$checked = false;
				}

				if ($name == "") 
				{ $err_name = "<span class='err'>*Please include your name</span>";
					$checked = false;
				}

				if ($message == "") 
				{ $err_message = "<span class='err'>*Please include a message</span>";
					$checked = false;
				}
			}
			if (!$checked) {
				$instruction = "<span class='err'>There appear to be errors in the form (see messages below)</span>";
			}
			if ( empty($submit) or (!$checked) )
			{
				echo $instruction;
			?>
			
			</p>
			<p>
			You may also subscribe or unsubscribe to our newsletter by clicking <a href="./subscribe.php">HERE</a>.
			</p>
			<p>
			Note that all fields below are required...  (click <a href="./privacy.php">here</a> to see the <span class="bold">artgroove.com</span> privacy policy.)
			</p>

			<form action="contact.php" method="post">

			<table class="form_table">
				<tr><td>Subject</td><td>
				<input type="text" size="40" maxlength="100" name="subject" id="subject" value="<?php echo $subject; ?>" />
				</td>
				<td>
				<?php echo $err_subject ?>
				</td>
				</tr>

				<tr>
				<td>Name</td><td>
				<input type="text" size="40" maxlength="50" name="name" id="name" value="<?php echo $name; ?>" />
				</td>
				<td>
				<?php echo $err_name ?>
				</td>
				</tr>

				<tr><td>Email Address</td><td>
				<input type="text" size="40" maxlength="50" name="email_address" id="email_address" value="<?php echo $email_address; ?>" />
				</td>
				<td>
				<?php echo $err_email_address ?>
				</td>
				</tr>
			</table>
			<table class="form_table">
				<tr>
				<td>Message <br />(1000 character maximum)</td><td>
				<textarea rows="12" cols="48" maxlength="1000" name="message" id="message"><?php echo $message; ?></textarea>
				</td>
				<td>
				<?php echo $err_message ?>
				</td>
				</tr>
			</table>

			<p><input type="submit" name="submit" class="button" value="Send" /></p>
			</form>
			<?php
			
			} // closes if ( empty($submit) or (!$checked) ) from above

			$msg = stripslashes($message);  // gets rid of ... slashes!
			
			if (isset($submit) and ($checked)) {
				// critical to have double-quotes around 'From:' field value
				$headers = 'From: "' . $name . ' <' . $email_address . '>"' . "\r\n" . 'Reply-To: ' . $name . "<" . $email_address . ">\r\n"; 
				$subject_plus = 'artgroove.com: ' . $subject;  // add artgroove.com to subject for clarity
				
				if (mail($curator_email, $subject_plus, $msg, $headers)) {
					echo "<h3>Thank you!  Your e-mail has been sent to Artgroove.com</h3>\n";
					echo "<table id='confirmation'>\n";
					echo "<tr><td>Subject:</td><td>" . $subject . "</td></tr><br />\n";
					echo "<tr><td>From:</td><td>" . $email_address . "</td></tr><br />\n";
					echo "<tr><td>Message:</td><td>" . $msg . "</td><br />\n";
				}
				else {
					echo"Error in sending email to artgroove.com!";
				}
				echo "</tr></table>\n";
			}
			?>

			<p><span class="bold">Telephone Contact Information:</span>
			</p>
			<ul>
				<li><span class="bold">Jeff Ellingson 509.270.9255</span></li>
				<li><span class="bold">Randy Ellingson 419.386.5606</span></li>
			</ul>
		</div>
	</div>
	<?php include("./templates/footer.htm"); ?>
</body>
</html>
