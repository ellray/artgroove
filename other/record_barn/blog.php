<?php
  header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
  header("Cache-Control: no-store, no-cache, must-revalidate");
  header("Cache-Control: post-check=0, pre-check=0", false);
  $page_title = "Blogs";
  include("templates/header.php");
  include("templates/db_funcs.php");
  $id = $_GET['id'];
  $op = $_GET['op'];  // ed(it)/del(ete)/list if set
  include("templates/masthead.php");
?>

<div id="mid_container">
    <div id="left_bar">

        <?php include("templates/nav.php"); ?>
    </div>

    <div id="content_section">
        <?php
        // This webpage has to serve quite a few views:
        // 1) Default:  details view of most recently modified blog
        //    plus comment form at bottom
        //    1a) re-display in case of validation problem with comment submission
        // 2) List of blogs (if user clicks link on default page)
        // 3) Blog form:
        //   a) create blog
        //     a1) re-edit create blog (if validation error)
        //   b) edit blog
        //     b1) re-edit edit blog (if validation error)

        function blog_detail_view($connection, $sql_string,
                $name, $name_err, $comment, $cmnt_err) {
            if ($result = $connection->query($sql_string)) {
                // VIEW details of blog
                $row = $result->fetch_assoc();
                $id = $row['blog_id'];
                $edit_link = ($_SESSION['logged_in']) ?
                    "<a href=\"blog.php?id=$id&amp;op=ed\">Edit</a>" :
                    "";
                $blog_detail = <<< END_DETAIL
                <div><h2>{$row['title']}</h2>
                <div>Author:  {$row['author']}</div>
                <div>Last Modified:  {$row['date']}</div>
                <div class="boxed">{$row['content']}</div>
                <p><a href="blog.php?op=list">See All Blogs</a>&nbsp;&nbsp;&nbsp;
                   $edit_link</p>
                <fieldset><legend>Add a comment</legend>
                  <form action="blog.php" method="post">
                    <p>Name:  <input type="text" value="$name" name="fullname" />
                    $name_err<br />
                    Comment:  <textarea cols="60" rows="4" name="comment">$comment</textarea>
                    $cmnt_err<br />
                    <input type="hidden" value="$id" name="blog_id" />
                    <input type="submit" value="Post Comment" name="submit_comment" /></p>
                  </form></fieldset>
                </div>

END_DETAIL;
                    print $blog_detail;
                    // now we need to print all the existing comments on this blog
                    $sql = "SELECT * FROM blog_comments WHERE blog_id = $id ORDER BY date DESC";

                    if ($result = $connection->query($sql)) { // successful query
                        print "<br />\n<div>\n";
                        //print "DEBUG: sql = $sql<br />";
                        //print "DEBUG: id = $id<br />\n";
                        while ($row = $result->fetch_row()) {
                            print "<br />\n";
                            print $row[1] . "<br />\n";
                            print "<span class=\"bold\">" . $row[2] . "</span> said:<br />";
                            print $row[3] . "<br />\n";
                        }
                        print "</div>\n";
                    }
                    else {  // unsuccessful query for comments
                        print "<br /><br /><div>(no comments to display)</div>\n";
                        /* DEBUG printing */
                        //print "<div>";
                        //foreach ($_POST as $name => $value)
                        //    print "$name => $value";
                        //print "</div>";
                    }
            }
            else {
                print "<div>blog_detail fn DEBUG: sql = $sql_string<br />";
                die("Query Failed - No Records Found: $connection->error()");
            }

        }   // end function blog_detail_view()

        $conn = new mysqli($db_host, $user, $pw, $dbase);
        if ($conn->errno) {
            die("Error: $conn->error()<br />");
        }

        // these are comment form errors
        $name_err = "";
        $comment_err = "";

        // first:  handle submits from edit/new form
        if (isset ($_POST['submit'])) {  // blog submission (not comment)
            // get values from form
            $blog_id = $_POST['blog_id'];
            $title = $_POST['title'];
            $author = $_POST['author'];
            $content = $_POST['content'];

            /* DEBUG printing
            print "<div>";
            foreach ($_POST as $name => $value)
                print "$name => $value";
            print "</div>";
            */

            // initialize blog create/edit form errors for empty validation
            $title_error = "";
            $author_error = "";
            $content_error = "";

            $form_error = false;  // no errors yet
            if (empty($title)) {
                $title_error = '<span class="err">Error:  Please fill in a title</span>';
                $form_error = true;
            }
            if (empty($author)) {
                $author_error = '<span class="err">Error:  Please fill in an author name</span>';
                $form_error = true;
            }
            if (empty($content)) {
                $content_error = '<span class="err">Error:  Please add your content!</span>';
                $form_error = true;
            }
            if (!$form_error) {  // run the sql update/insert
                // massage variables
                $author_sql = $conn->real_escape_string($author);
                $title_sql = $conn->real_escape_string($title);
                $content_sql = $conn->real_escape_string($content);
                if (!empty($blog_id)) { // EDIT, so do UPDATE
                    //print "<p>Blog ID is $blog_id and apparently not empty</p>";
                    // shouldn't have to escape the id
                    //$blog_id_sql = $conn->real_escape_string($blog_id);
                    $sql = "UPDATE `blogs` SET `title` = '$title_sql',
                        `author` = '$author_sql',
                        `content` = '$content_sql'
                        WHERE `blog_id` = '$blog_id'";
                    print "<p>SQL = $sql</p>";
                    if ($result = $conn->query($sql)) {
                        // success!  redirect back to table of blogs
                        header("Location: blog.php?id='$blog_id'");
                    }
                    else {  // error on INSERT...do nothing?
                        print "<div>SQL ERROR on INSERT\n";
                        print "sql = $sql </div>";
                    }
                }
                else { // NEW blog
                    $sql = "INSERT INTO blogs
                    (`blog_id`, `title`, `author`, `date`, `content`)
                    VALUES ( NULL, '$title_sql', '$author_sql', NULL, '$content_sql' )";
                    if ($result = $conn->query($sql)) {
                        // success!  redirect to blog detail
                        $id = $conn->insert_id;
                        // this is basically a 'return'...reload page
                        header("Location: blog.php");
                    }
                }
            }
            else {  // some field is blank...back to form
                include('templates/blog_form.php');
            }
        }
        // POSTED COMMENT; ADD TO blog_comments TABLE
        elseif (isset ($_POST['submit_comment'])) {
            /* DEBUG printing */
            //print "<div>Inside 'submit comment' section<br />";
            //foreach ($_POST as $name => $value)
            //    print "$name => $value<br />";
            //print "</div>";
            $fullname = $_POST['fullname'];
            $comment = $_POST['comment'];
            $id = $_POST['blog_id'];

            if (empty($fullname)) {
                $fullname_err = '<span class="err">Error: Please add an author name!</span>';
                $form_err = TRUE;
            }
            if (empty($comment)) {
                $comment_err = '<span class="err">Error:  Comment box is empty!</span>';
                $form_err = TRUE;
            }
            if (!$form_err) {  // go ahead and insert comment
                $fullname = $conn->real_escape_string($fullname);
                $comment = $conn->real_escape_string($comment);
                $sql = "INSERT INTO blog_comments
                    (blog_id, date, author, comment) VALUES
                    ('$id', NULL, '$fullname', '$comment')";
                if ($result = $conn->query($sql)) {  // successful INSERT
                    header("Location: blog.php?id='$id'");
                }
            }
            else {  // form error:  author or comment is blank
                // redisplay blog detail with partially filled-in comment form
                $sql = "SELECT * FROM blogs WHERE blog_id = $id";
                blog_detail_view($conn, $sql, $fullname, $fullname_err, $comment, $comment_err);
            }
        }
        // NOT a form submission (though could be an erroneous comment submission)
        // go to VIEW (default), EDIT, DELETE, NEW, or LIST
        else {  
            if (isset($id)) {  // VIEW, EDIT, NEW, or DELETE (new appears further below)
                $sql = "SELECT * FROM blogs WHERE blog_id = $id";
            }
            elseif ($op == 'list') {   // table LIST of blogs
                $sql = "SELECT * FROM blogs ORDER BY date DESC";
            }
            else {  // no id, list detail of most recently modified blog
                $sql = "SELECT * FROM blogs ORDER BY date DESC LIMIT 1";
            }
            //print "<br />" . $sql . "<br />"; // For debugging ONLY
            // query and test in one go...
            //print "<div>DEBUG: After view/edit/new/del switch:<br />\n
            //    sql = $sql<br />\n
            //    id = $id<br /></div>";
            //if ($result = $conn->query($sql)) {
            if (!isset($op)) {  // VIEW (either top 1 or selected blog_id)
                blog_detail_view($conn, $sql, $fullname,
                        $fullname_err, $comment, $comment_err);
            }
            elseif (( $op == 'ed') || ( $op == 'new' )) {  // edit form
                if ($result = $conn->query($sql)) {
                    include ("templates/blog_form.php");
                }
                else {  // query failure
                    print "<div class=\"err\">op=ed or op=new query error:<br />\n";
                    print "DEBUG: sql = $sql</div>";
                }
            }
            elseif ((isset($id)) && ( $op == 'del' )) {  // delete blog from dbase
                $sql = "DELETE FROM blogs WHERE blog_id = $id";
                if ($result = $conn->query($sql)) { // blog is deleted
                    header('Location: blog.php');
                }
                else {  // delete error?
                    print "<div class=\"err\">Error deleting blog_id: $id</div>";
                }
            }
            else {  // $op=list => list table of blogs
                if ($result = $conn->query($sql)) {  // successful
                    print "<table class=\"list\"><tr>";
                    // Print the headers for each column first
                    // only want fields 1-3
                    for ($i = 0; $i < 4; $i++) {
                        $field = $result->fetch_field();
                        if ($i > 0) {
                            print "<td>" . ucwords($field->name) . "</td>";
                        }
                    }
                    if ($_SESSION['logged_in']) { // Admin only
                        print '<td colspan="3"><a href="blog.php?op=new">** Post New **</a></td>';
                    }
                    print "</tr>";

                    // Print the data for each column
                    while ($row = $result->fetch_row()) {
                        $field_num = 1;
                        print "<tr>";
                        print "<td><a href=\"blog.php?id=$row[0]\">$row[$field_num]</a></td>";
                        $field_num++;
                        while ($field_num < 4) {
                            print "<td>" . $row[$field_num] . "</td>";
                            $field_num++;
                        }

                        // edit and delete could be links to separate pages ('edit_product.php', etc)
                        $view = '<a href="blog.php?id=' . $row[0] . '">View</a>';
                        $edit = '<a href="blog.php?id=' . $row[0] . '&amp;op=ed">Edit</a>';
                        $delete = '<a href="blog.php?id=' . $row[0] . '&amp;op=del" onclick="return confirm(\'Are you sure you want to delete the blog: ' . $row[1] . '?\')">Delete</a>';

                        print '<td>' . $view . "</td>\n";
                        if ($_SESSION['logged_in']) {  // Admin only
                            print '<td>' . $edit . "</td>\n";
                            print '<td>' . $delete . "</td>\n";
                        }
                        print "</tr>\n";
                    }
                    print "</table>";
                }
                else {
                    print "<div class=\"err\">DEBUG:  sql = " . $sql . "</div>";
                    die("Query Failed - No Records Found: $connection->error()");
                }
            }
        }
        $conn->close();
        ?>
    </div>
</div>

<?php include("templates/footer.php"); ?>

</body>
</html>

