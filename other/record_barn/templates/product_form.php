<?php
// The idea of this form is to provide a method for the website owner to either edit or
// fill in an inventory product from scratch, depending on whether $op == 'ed' or 'new'.
if ( $op == 'ed') {  //edit mode--not coming back from a submission!
    // get current product info to fill in form
    $row = $result->fetch_assoc();
    $prod_id = $row['prod_id'];
    $title = $row['title'];
    $artist = $row['artist'];
    $stock = $row['stock'];
    $year = $row['year'];
    $label = $row['label'];
    $description = $row['description'];
    $image = $row['image'];
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
    $id = $prod_id;
}
if (!$form_err)
    $form_heading = "Edit Product Details";
else
    $form_heading = "Please Fill in Missing Fields and Resubmit";
// NEED TO GET FIELD OUT OF HERE WITH POST, BUT ALSO NEED CALLING op setting (new or edit)!
$edit_form = <<< EDIT_FORM
    <div><h2>$form_heading</h2>
    <form action="products.php" method="post">
    <fieldset><p>
    Title:  <input type="text" size="40" value="$title" name="title" />
    $title_err<br />
    Artist:  <input type="text" size="40" value="$artist" name="artist" />
    $artist_err<br />
    Release Year:  <input type="text" size="4" value="$year" name="year" />
    $year_err<br />
    Quantity in Stock:  <input type="text" size="4" value="$stock" name="stock" />
    $stock_err<br />
    Label:  <input type="text" size="20" value="$label" name="label" />
    $label_err<br />
    Image Path:  <input type="text" size="40" value="$image" name="image" /><br />
    <input type="hidden" value="$id" name="prod_id" />
    </p>
    <p>Description:<br />
    <textarea cols="100" rows="18" name="description">$description</textarea><br />
    $desc_error<br />
    </p>
    <p>
    <input type="submit" value="$button_value" name="submit" />
    </p></fieldset></form>
    </div>
EDIT_FORM;
print $edit_form;

?>
