<?php
// The idea of this form is to provide a form that someone can either edit or
// fill in from scratch, depending on whether $op == 'ed' or 'new'.
if ( $op == 'ed') {  //edit mode--not coming back from a submission!
    // get current article info to fill in form
    $row = $result->fetch_assoc();
    $article_id = $row['article_id'];
    $title = $row['title'];
    $author = $row['author'];
    $date   = $row['date'];
    $content = $row['content'];
    $button_value = "Update";
}
elseif ( $op == 'new' ) {
    $button_value = "Create";
}
else {
    // it's a submit due to validation failure
    // --just use the $_POST['submit'] value as the button_value
    $button_value = $_POST['submit'];
    // set $id in case it's an edit
    $id = $article_id;
}
if (($title_error == "") && ($author_error == "") && ($content_error == ""))
    $form_heading = "Edit Article Details";
else
    $form_heading = "Please Fill in Missing Fields and Resubmit";
// NEED TO GET FIELD OUT OF HERE WITH POST, BUT ALSO NEED CALLING op setting (new or edit)!
$edit_form = <<< EDIT_FORM
    <div><h2>$form_heading</h2>
    <form action="articles.php" method="post">
    <fieldset><p>
    Title:  <input type="text" size="40" value="$title" name="title" />
    $title_error<br />
    Author:  <input type="text" size="40" value="$author" name="author" />
    $author_error<br />
    <input type="hidden" value="$date" name="date"/>
    <input type="hidden" value="$id" name="article_id"/>
    </p>
    <p>
    <textarea cols="100" rows="18" name="content">$content</textarea><br />
    $content_error<br />
    </p>
    <p>
    <input type="submit" value="$button_value" name="submit" />
    </p></fieldset></form>
    </div>
EDIT_FORM;
print $edit_form;

?>
