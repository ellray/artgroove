<?php

// This form provides individual product view with the review form and
// previously submitted reviews
// First, get and display the product detail
$row = $result->fetch_assoc();
$product_detail = <<< END_DETAIL
                <div><p class="large_clean">{$row['title']}</p>
                  <img class="boxed" src="images/{$row['image']}" alt="Record Barn img" />
                  <p class="float_left"> Artist:  {$row['artist']}<br />
                    Release Year:  {$row['year']}<br />
                    Label:  {$row['label']}<br />
                    In Stock:  {$row['stock']}
                  </p>
                </div>
                <div class="boxed">{$row['description']}</div>
                  <p><a href="products.php">See All Products</a></p>
END_DETAIL;
print $product_detail;
if ($_SESSION['logged_in']) {  // Admins only
    print "<p><a href=\"products.php?id={$row['prod_id']}&amp;op=ed\">Edit</a></p>";
}

// now display the review form (check for posting errors if this is a post)
if (isset($_POST['post_review'])) {
    // We have a posted review to check
    // initialize variables
    $form_err = false;
    $reviewer = $_POST['reviewer'];
    $rating = $_POST['rating'];
    $review_text = $_POST['review_text'];
    $reviewer_err = "";
    $rating_err = "";
    $review_err = "";

    if (empty($reviewer)) {
        $reviewer_err = '<span class="err">Error:  Please add the an author name!</span>';
        $form_err = true;
    }
    if (empty($review_text)) {
        $review_err = '<span class="err">Error:  Please add your review!</span>';
        $form_err = true;
    }
    if (empty($rating)) {
        $rating_err = '<span class="err">Error:  Please add your rating!</span>';
        $form_err = true;
    }
    if (!$form_err) {  // run the sql update/insert
        // clean up...
        $reviewer = strip_tags($reviewer);
        $reviewer = $conn->real_escape_string($reviewer);
        if ($rating > 5) $rating = 5;
        elseif ($rating < 1) $rating = 1;
        $rating = strip_tags($rating);
        $rating = $conn->real_escape_string($rating);
        $review_text = strip_tags($review_text);
        $review_text = $conn->real_escape_string($review_text);

        $sql = "INSERT INTO reviews
                                (prod_id, author, date, review, rating) VALUES
                                ('$id', '$reviewer', NULL, '$review_text', '$rating');";
        if ($result = $conn->query($sql)) { // review successfully added
            $conn->close();
            header("Location: products.php?id=$id");
        } else {  // error?
            die("Insert failed: $conn->error()");
        }
        // overwrite vars so they're not displayed in the 'post review' form
        // when the product is displayed with this new review at the top
        // 
        $reviewer = "";
        $rating = "";
        $review_text = "";
    }
}
// display review form with errors and previously entered fields
// May be empty if it's not a redisplay of an errant post
if ($form_err) {
    $review_legend = "<span class=\"err\">Error:  Please fill in missing data and repost!</span>";
} else {
    $review_legend = "Post a Review";
}
$review_form = <<< END_REVIEW_FORM
                  <form action="products.php" method="post">
                    <fieldset><legend>$review_legend</legend>
                      <div>
                        Author:  <input type="text" size="40" value="$reviewer" name="reviewer" />
                        $reviewer_err<br />
                        Rating (1-5):  <input type="text" size="1" value="$rating" name="rating" />
                        $rating_err<br />
                        Review:  <textarea cols="60" rows="3" name="review_text">$review_text</textarea>
                        $review_err<br />
                        <input type="hidden" value="$id" name="prod_id" />
                        <input type="submit" value="Post Review" name="post_review" />
                      </div>
                    </fieldset>
                  </form>
                </div>
END_REVIEW_FORM;

print $review_form;

// Now get review items to post after product detail

// First print average review rating with icon "records"
$sql = "SELECT AVG(rating) FROM reviews WHERE prod_id = $id";
$avg_query = $conn->query($sql) or die("Average rating query failed: $conn->error()");
$row = $avg_query->fetch_row();
if (!is_null($avg = $row[0])) {  // NULL if no result returned
    print "<p>Avg Rating:  ";
    for ($i = 0; $i < $avg; $i++) {
       print '<img src="images/vinyl_icon.gif">';
    }
    print "</p>";
}
else {
    // no reviews yet...do nothing here
}
// now for the reviews themselves...
$sql = "SELECT * FROM reviews WHERE prod_id = $id";
$reviews = $conn->query($sql) or die("SELECT FROM reviews query failed: $conn->error()");
if (($num_rows = mysqli_num_rows($reviews)) > 0) {
    while ($row = $reviews->fetch_row()) {
        print "<br />\n";
            for ($i = 0; $i < $row[4]; $i++ ) {
                print '<img src="images/vinyl_icon.gif">';
            }
        print "<br />" . $row[2] . "<br />\n";
        print "<span class=\"bold\">" . $row[1] . "</span> said:<br />";
        print $row[3] . "<br />\n";
    }
    print "</div>\n";
}
else {
    print "<br /><br /><div>(no reviews)</div>\n";
    // DEBUG printing
    //print "<div>";
    //foreach ($_POST as $name => $value)
    //    print "$name => $value";
    //print "</div>";
}
?>
