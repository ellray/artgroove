<?php
  $page_title = "Login";
  include("../templates/header.php");
	header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
	header("Cache-Control: no-store, no-cache, must-revalidate");
	header("Cache-Control: post-check=0, pre-check=0", false);
	require("./db.php");
	require './utils.php';
?>

<body>
	<div id="wrapper">
	<?php include("./templates/nav_header.html"); ?>
    <div>
			<div  id="form_section">
					<?php
					session_start();
					if ($_SESSION['logged_in']) {
							header('Location: create_email.php');
					} 
					else {  // not yet logged in; could still be form submission
						$logged_in = FALSE;
						// Connect to the MySQL server -- need to do this BEFORE we use mysql_real_escape_string()
						if (!($connection = @ mysql_connect($hostname, $username, $password)))
							die("Cannot connect");

						if (!(mysql_select_db($databasename, $connection)))
							showerror();
						if ($connection->errno) {
							die("Error: $connection->error()<br />");
						}
						if (isset($_POST['Login'])) {
							// Get the data from the form
							$email = $_POST['email'];
							$pass = $_POST['password'];

							$email = strip_tags($email);
							$pass = strip_tags($pass);
							$email = $connection->real_escape_string($email);
							$pass = $connection->real_escape_string($pass);

							$sql = "SELECT * FROM users WHERE email = '$email'";
							//print "<div class=\"err\">sql = $sql</div>";

							if ($result = $connection->query($sql)) {
								while ($row = $result->fetch_row()) {
									if (( $row[1] == $email ) && ( $row[2] == $pass ) &&
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
							} 
							else {  // connection failure
								print "<p>Connection failure!</p>";
							}
						} 
						else {   // display login form
							$login_form = <<< END_OF_LOGIN_FORM
		 <form action="login.php" method="post">
			 <div><fieldset>
				 <span class="bold">Please Log In</span><br />
				 Name:  <input type="text" id="name" value="$email" name="email" /><br />
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

		<?php include("./templates/footer.htm"); ?>
	</div><!-- wrapper -->

</body>
</html>
