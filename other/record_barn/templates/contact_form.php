<?php

$error_flag = FALSE;

if (isset($_POST['submit'])) {
    $submit = $_POST['submit'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $phone = $_POST['phone_num'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $question = $_POST['question'];
    $media = $_POST['media'];
    $genre_interests = $_POST['genres'];
}

// define this as an array if it wasn't set above to avoid processing errors
if (count($genre_interests) == 0) {
    $genre_interests = array();
}
// convert array to string
$genres = "";
foreach ($genre_interests as $i) {
    $genres .= $i . ", ";
}
// remove trailing comma + space
$genres = substr($genres, 0, -2);

$genre_array = array("Rock", "Classical", "Jazz", "Hip Hop", "Rap", "R&amp;B",
    "Electronic", "Techno", "Punk", "Country");
$checkbox_section = createCheckBoxes("genres[]", $genre_array, $genre_interests);

$media_array = array("Vinyl", "CDs", "Cassette Tapes", "DVDs", "8-Track Tapes", "Digital");
$select_section = createSelect("media", $media_array, $media);

$radio_buttons = array("Email", "Phone");
$radio_section = createRadio("contact", $radio_buttons);

// validation portion (required fields and specific data configurations)
if (isset($submit)) { // this page load is from a submitted form
    //echo "<p>INSIDE ISSET CLAUSE!</p>";
    global $error_flag;
    if (empty($firstname)) {
        $fn_error = '<span class="err">Error:  Please fill in a first name!</span>';
        $error_flag = TRUE;
    }
    if (empty($lastname)) {
        $ln_error = '<span class="err">Error:  Please fill in a last name!</span>';
        $error_flag = TRUE;
    }
    if (empty($email)) {
        $em_error = '<span class="err">Error:  Please fill in a valid email address!</span>';
        $error_flag = TRUE;
    } elseif (!check_email($email)) {
        $error_flag = TRUE;
        $em_error = '<span class="err">Error:  "' . $email . '" doesn\'t appear to be a valid email
                                                         address.  Please enter a valid email.</span>';
    }
}
$form_output = <<< END_OF_FORM
             <form action="aboutus.php" method="post">
               <fieldset><legend>Contact Us:</legend>
                 <div>
                   First Name: <input type="text" size="15" value="$firstname" name="firstname" />
                     $fn_error<br />
                   Last Name: <input type="text" size="20" value="$lastname" name="lastname" />
                     $ln_error<br />
                   Phone Number:<input type="text" value="$phone_num" name="phone_num" /><br />
                   Email:<input type="text" value="$email" name="email" />
                     $em_error<br />
                </div>
                <p>
                  My question/suggestion is: <textarea cols="40" rows="4" name="question">$question</textarea>
                </p>
                $radio_section
                $select_section
                $checkbox_section
                <div><input type="submit" value="submit" name="submit" /></div>
              </fieldset>
            </form>
END_OF_FORM;


if (isset($submit)) {
    if ($error_flag == TRUE) {
        echo $form_output;
    }
    else {
        print "\t\t\t<p class=\"boxed\">Thank you for your contact information and inquiry!\n
            \t\t\t\tYou will receive a confirmation email from us shortly.</p>";

        // send email to subscriber admin & bcc Dave
        $subject = "Welcome to Record Barn!";
        $email_lbl = "$firstname $lastname <$email>";
        $from = "From: Record Barn <jeffe@cet.com>";
        $bcc = "Bcc: dljones@scc.spokane.edu";
        $reply_to = "Reply-To: jeffe@cet.com";
        $message = <<< END_OF_BODY
Welcome $firstname!  We hope you will find Record Barn to be a useful
site for both purchasing and researching your latest vinyl interests.

Here is your user information as submitted:

First Name:  $firstname
Last Name:  $lastname
Phone:  $phone
Email:  $email
Question/Suggestion: $question
Preferred Contact Method:  $contact
Predominant Media Owned:  $media
Genre Interests:  $genres

Be sure to take advantage of the product reviews--anyone can create reviews on any
of our products.

We also offer periodic newsletters that keep you informed of the latest releases
as well as retrospective reviews, etc.  Subscribe to the newsletter to have them
delivered via email.

Happy shopping!

- Record Barn
END_OF_BODY;
        
        $msg_headers = $from . "\r\n" . $bcc . "\r\n" . $reply_to . "\r\n";

        mail($email_lbl, $subject, $message, $msg_headers);
    }
}
else {  // not from a submission, fresh page look
        echo $form_output;
}

// borrowed from Dave Jones' wiki--function to easily build select statements
// from an array of elements
function createSelect($name, array $a, $selected_element) {
    $tab = "            ";
    $tab2 = "              ";
    $select = "<p>I currently have mostly: \n" . $tab . '<select name="' . $name . '">' . "\n";
    foreach ($a as $key => $value) {
        $select .= $tab2 . "<option";
        if ($selected_element == $value) {
            $select .= " selected=\"selected\"";
        }
        $select .= ">" . $value . "</option>\n";
    }
    $select .= $tab . "</select>\n" . $tab . "</p>";
    return $select;
}

function createCheckBoxes($name, array $a, array $checked_boxes) {
    $tab = "            ";
    $tab2 = "              ";
    $checkbox = "\n" . $tab . "<fieldset>\n" . $tab2;
    $checkbox .= "<legend>I am interested in the following music types:</legend>\n";
    $checkbox .= $tab . '<div class="checkbox_list">' . "\n";
    //print_r($checked_boxes);
    foreach ($a as $key => $value) {
        if ((($key != 0) && ($key) % 3 == 0)) {
            $checkbox .= $tab . "</div>\n" . $tab . "<div class=\"checkbox_list\">\n";
        }
        $checked = (in_array($value, $checked_boxes)) ? " checked=\"checked\"" : "";
        $checkbox .= $tab2 . '<input type="checkbox" name="' . $name . '" value="' . $value . '"' . $checked . '/>' . $value . "<br />\n";
    }
    $checkbox .= $tab . "</div>\n" . $tab . '</fieldset>';
    return $checkbox;
}

function createRadio($name, $radio_array) {
    $tab = "            ";
    $tab2 = "              ";
    $radio = $tab . "<fieldset><legend>Please contact me via:</legend>\n";
    foreach ($radio_array as $key => $value) {
        $checked = ($_POST["$name"] == $value) ? " checked=\"checked\"" : "";
        $radio .= $tab2 . '<input type="radio" name="' . $name . '" value="' . $value . '"' . $checked . ' />' . $value . "<br />\n";
    }
    $radio .= $tab . "</fieldset>";
    return $radio;
}
?>
