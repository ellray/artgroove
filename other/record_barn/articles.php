<?php
  header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
  header("Cache-Control: no-store, no-cache, must-revalidate");
  header("Cache-Control: post-check=0, pre-check=0", false);
  $page_title = "Articles";
  include("templates/header.php");
  include("templates/db_funcs.php");
  $id = $_GET['id'];
  $op = $_GET['op'];  // ed(it) or del(ete) if set
  include("templates/masthead.php");
?>

<div id="mid_container">
    <div id="left_bar">

        <?php include("templates/nav.php"); ?>

    </div>
    <div id="article_section">
        <?php
        $conn = new mysqli($db_host, $user, $pw, $dbase);
        if ($conn->errno) {
            die("Error: $conn->error()<br />");
        }

        // initialize form errors for empty validation
        $title_error = "";
        $author_error = "";
        $content_error = "";

        // first:  handle submits from edit/new form
        if (isset($_POST['submit'])) {
            // get values from form
            $article_id = $_POST['article_id'];
            $title = $_POST['title'];
            $author = $_POST['author'];
            $content = $_POST['content'];

            /* DEBUG printing
            print "<div>";
            foreach ($_POST as $name => $value)
                print "$name => $value";
            print "</div>";
            */

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
                if (!empty($article_id)) { // EDIT, so do UPDATE
                    //print "<p>Article ID is $article_id and apparently not empty</p>";
                    $article_id_sql = $conn->real_escape_string($article_id);
                    $sql = "UPDATE `articles` SET `title` = '$title_sql',
                        `author` = '$author_sql',
                        `content` = '$content_sql'
                        WHERE `article_id` = '$article_id'";
                    print "<p>SQL = $sql</p>";
                    if ($result = $conn->query($sql)) {
                        // success!  redirect back to table of articles
                        header('Location: articles.php');
                    }
                } 
                else { // NEW article
                    $sql = "INSERT INTO articles 
                    (`article_id`, `title`, `author`, `date`, `content`) 
                    VALUES ( NULL, '$title_sql', '$author_sql', NULL, '$content_sql' )";
                    if ($result = $conn->query($sql)) {
                        // success!  redirect to article detail
                        $id = $conn->insert_id;
                        header("Location: articles.php?id='$id'");
                    }
                }
            }
            else {  // some field is blank...back to form
                include('templates/article_form.php');
            }
        } 
        else {  // !isset($_POST['submit'], so not a form submission!
            if (isset($id)) {  // VIEW, edit or delete (new appears further below)
                $sql = "SELECT * FROM articles WHERE article_id = $id";
            }
            else {   // this is default--table LIST of articles
                $sql = "SELECT * FROM articles ORDER BY date DESC";
            }
            //print "<br />" . $sql . "<br />"; // For debugging ONLY
            // query and test in one go...
            if ($result = $conn->query($sql)) {
                if (isset($id) && !isset($op)) {
                    // VIEW details of article
                    $row = $result->fetch_assoc();
                    $product_detail = <<< END_DETAIL
                <div><h2>{$row['title']}</h2>
                <div>Author:  {$row['author']}</div>
                <div>Created:  {$row['date']}</div>
                <div class="boxed">{$row['content']}</div>
                <p><a href="articles.php">See All Articles</a></p>
                </div>
END_DETAIL;
                    print $product_detail;
                    if ($_SESSION['logged_in']) {  // Admin only
                        $a_id = $row['article_id'];
                        $title = $row['title'];
                        print "<p><a href=\"articles.php?id=$a_id&amp;op=ed\">Edit</a></p>";
                        // onclick confirm doesn't work here for some reason!
                        $email_link = '<p><a href="articles.php?id=' . $a_id . '&amp;op=email"
                            onclick="return confirm(\'Email the article **' . $title . '** to
                            the subscriber list?\')">Email</a></p>';
                        print $email_link;
                    }
                }
                elseif (( $op == 'ed') || ( $op == 'new' )) {  // edit form
                    include ( "templates/article_form.php");
                }
                elseif (isset($id) && ( $op == 'del' )) {  // delete article from dbase
                    $sql = "DELETE FROM articles WHERE article_id = $id";
                    if ($result = $conn->query($sql)) { // article is deleted
                        header('Location: articles.php');
                    } else {  // delete error?
                    }
                }
                elseif ((isset($id)) && ($op == 'email')) {
                    include ("templates/email_article.php");
                } else {
                    // default page display:  list of articles, most recent first
                    print "<table class=\"my_table\"><tr>";
                    // Print the headers for each column first
                    $field_names = $result->fetch_fields();
                    foreach ($field_names as $field) {
                        if (($field->name == "article_id") && (!$_SESSION['logged_in'])) {
                            // no op
                        } else {
                            print "<td class=\"bold\">" . ucwords($field->name) . "</td>";
                        }
                    }
                    if ($_SESSION['logged_in']) {  // Admin only
                        print '<td colspan="4"><a href="articles.php?op=new">** Post New **</a></td>';
                    }
                    print "</tr>";

                    // Print the data for each column
                    while ($row = $result->fetch_row()) {
                        $field_num = ($_SESSION['logged_in']) ? 0 : 1;
                        print "<tr>";
                        while ($field_num < $result->field_count) {
                            if ($field_num == 4) {
                                print "<td>" . substr($row[$field_num], 0, 160) . "</td>";
                            }
                            elseif ($field_num == 1) {
                                print "<td><a href=\"articles.php?id=$row[0]\">" . $row[$field_num] . "</a></td>";
                            }
                            else {
                                print "<td>" . $row[$field_num] . "</td>";
                            }
                            $field_num++;
                        }

                        // edit and delete could be links to separate pages ('edit_product.php', etc)
                        $view = '<a href="articles.php?id=' . $row[0] . '">View</a>';
                        $edit = '<a href="articles.php?id=' . $row[0] . '&amp;op=ed">Edit</a>';
                        $delete = '<a href="articles.php?id=' . $row[0] . '&amp;op=del" 
                            onclick="return confirm(\'Are you sure you want to delete the article: '
                            . $row[1] . '?\')">Delete</a>';
                        $email = '<a href="articles.php?id=' . $row[0] . '&amp;op=email"
                            onclick="return confirm(\'Email the article **'
                            . $row[1] . '** to the subscriber list?\')">Email</a>';

                        print '<td>' . $view . "</td>\n";
                        if ($_SESSION['logged_in']) {  // not available to non-admins
                            print '<td>' . $edit . "</td>\n";
                            print '<td>' . $delete . "</td>\n";
                            print '<td>' . $email . "</td>\n";
                        }
                        print "</tr>\n";
                    }
                    print "</table>";
                }
            }
            else {
                die("Query Failed - No Records Found: $connection->error()");
            }
        }





        $conn->close();
        ?>
    </div>
</div>

<?php include("templates/footer.php"); ?>

</body>
</html>

