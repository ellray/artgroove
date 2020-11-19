<?php
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
$page_title = "Products";
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
    <div id="content_section">
        <?php
        /*
         * This section has gotten very complicated.
         * It now feeds many different page views:
         *   1. table of products
         *   2. product detail
         *   3. create product form
         *   3a. re-edit create product form (validation problem)
         *   4. edit product form
         *   4a. re-edit product form (validation problem)
         *   5. create product review
         *   5a. re-edit create review form (validation problem)
         *
         * Here is the basic logic:
         *  - if ($_POST['submit'] && NOT $id)
         *     => product creation submission ($id can't exist yet)
         *     => $form_err results in 3a
         *  - elseif ($_POST['submit'] && $id)
         *     => product edit submission ($form_err => 3a)
         *  - elseif ($_POST['post_review'])
         *     => review creation (requires product detail display) (5, 5a)
         *  - elseif (NOT $_POST['submit'] && $id && $op=='new')
         *      => create product form (3)
         *  - elseif (NOT $_POST['submit'] && $id && $op=='ed')
         *      => edit product form (4)
         *  - elseif (NOT $_POST['submit'] && $id &&  NOT $op)
         *      => product detail (2)
         *  - default view (no $_POST[], no $op) => table of products (1)
         */
        $conn = new mysqli($db_host, $user, $pw, $dbase);
        if ($conn->errno) {
            die("Error: $conn->error()<br />");
        }

        // initialize form errors for empty validation
        $title_err = "";
        $artist_err = "";
        $year_err = "";
        $label_err = "";
        $stock_err = "";
        $desc_err = "";

        if (isset($_POST['prod_id'])) {
            // something posted, save the prod_id here and handle the post later
            $id = $_POST['prod_id'];
        }
        // handle submits from edit/new product form
        if (isset($_POST['submit'])) {
            // get values from form
            $prod_id = $_POST['prod_id'];
            $title = $_POST['title'];
            $artist = $_POST['artist'];
            $year = $_POST['year'];
            $stock = $_POST['stock'];
            $label = $_POST['label'];
            $image = $_POST['image'];
            $description = $_POST['description'];

            /* DEBUG printing
              print "<div>";
              foreach ($_POST as $name => $value)
              print "$name => $value";
              print "</div>";
             */

            $form_err = false;  // no errors yet
            if (empty($title)) {
                $title_err = '<span class="err">Error:  Please fill in a title!</span>';
                $form_err = true;
            }
            if (empty($artist)) {
                $artist_err = '<span class="err">Error:  Please fill in an artist name!</span>';
                $form_err = true;
            }
            if (empty($year)) {
                $year_err = '<span class="err">Error:  Please add the record release year!</span>';
                $form_err = true;
            }
            if (empty($label)) {
                $label_err = '<span class="err">Error:  Please add the record label!</span>';
                $form_err = true;
            }
            if ($stock == "") {
                $stock_err = '<span class="err">Error:  Please add the number in stock!</span>';
                $form_err = true;
            }
            if (empty($description)) {
                $desc_err = '<span class="err">Error:  Please add the record description!</span>';
                $form_err = true;
            }
            if (!$form_err) {  // run the sql update/insert
                // massage variables
                $artist = strip_tags($artist);
                $artist = $conn->real_escape_string($artist);
                $title = strip_tags($title);
                $title = $conn->real_escape_string($title);
                $year = strip_tags($year);
                $year = $conn->real_escape_string($year);
                $label = strip_tags($label);
                $label = $conn->real_escape_string($label);
                $stock = strip_tags($stock);
                $stock = $conn->real_escape_string($stock);
                $desc = strip_tags($desc);
                $desc = $conn->real_escape_string($description);
                $image = strip_tags($image);
                $image = $conn->real_escape_string($image);
                if (!empty($prod_id)) { // EDIT, so do UPDATE
                    print "<p>Product ID is $prod_id and apparently not empty</p>";
                    $sql = "UPDATE `products` SET `title` = '$title',
                        `artist` = '$artist',
                        `year` = '$year',
                        `label` = '$label',
                        `stock` = '$stock',
                        `image` = '$image',
                        `description` = '$desc'
                        WHERE `prod_id` = '$prod_id'";
                    // DEBUG: print "<p>SQL = $sql</p>";
                    if ($result = $conn->query($sql)) {
                        // success!  redirect back to table of articles
                        $conn->close();
                        header('Location: products.php');
                    }
                } else { // NEW product
                    $sql = "INSERT INTO products
                    (`prod_id`, `title`, `artist`, `year`, `label`, `stock`, 
                      `image`, `description`)
                    VALUES ( NULL, '$title', '$artist', '$year',
                      '$label', '$stock', '$image', '$desc' )";
                    if ($result = $conn->query($sql)) {
                        // success!  redirect to article detail
                        $id = $conn->insert_id;
                        $conn->close();
                        header("Location: products.php?id='$id'");
                    }
                    else {
                        die("Insert failed: $conn->error()");
                    }
                }
            } else {  // some field is blank...back to form
                include('templates/product_form.php');
            }
        } else {  // not a product form submission!
            if (isset($id)) {
                // VIEW (w/ review form), edit, or delete (new appears further below)
                $sql = "SELECT * FROM products WHERE prod_id = $id";
                //print "<br />" . $sql . "<br />"; // For debugging ONLY
                // query and test in one go...
                if ($result = $conn->query($sql)) {
                    if (isset($id) && !isset($op)) {
                        // VIEW PRODUCT DETAILS
                        include('templates/product_detail_and_reviews.php');
                    } elseif (( $op == 'ed') || ( $op == 'new' )) {  // product form
                        include ( "templates/product_form.php" );
                    } elseif ($op == 'del') {  // delete product from dbase
                        $sql = "DELETE FROM products WHERE prod_id = $id";
                        if ($result = $conn->query($sql)) { // product is deleted
                            $conn->close();
                            header('Location: products.php');
                        } else {  // delete error?
                            die("Delete failed: $conn->error()");
                        }
                    }
                } else {
                    die("Product query failed for id #$id: $conn->error()");
                }
            }
            else {
                // DEFAULT PAGE DISPLAY:  PRODUCT LIST
                $sql = "SELECT * FROM products ORDER BY artist, title DESC";
                if ($result = $conn->query($sql)) {
                    print "<table class=\"my_table\"><tr>";
                    // Print the headers for each column first
                    $field_names = $result->fetch_fields();
                    foreach ($field_names as $field) {
                        if ((($field->name == "prod_id") || ($field->name == "image")) &&
                                (!$_SESSION['logged_in'])) {
                            // skip prod_id and image location unless Admin
                        } else {
                            print "<td class=\"bold\">" . ucwords($field->name) . "</td>";
                        }
                    }
                    if ($_SESSION['logged_in']) {
                        print '<td colspan="3"><a href="products.php?op=new">** Add New **</a></td>';
                    }
                    print "</tr>";

                    // Print the data for each column
                    while ($row = $result->fetch_row()) {
                        $field_num = ($_SESSION['logged_in']) ? 0 : 1;  // only print prod_id for Admin
                        print "<tr>";
                        while ($field_num < $result->field_count) {
                            if ($field_num == 7) {  // limit description to abstract
                                print "<td>" . substr($row[$field_num], 0, 120) . "</td>";
                            } elseif ($field_num == 1) {  // make 'title' a link to detail
                                print "<td><a href=\"products.php?id=$row[0]\">" . $row[$field_num] . "</a></td>";
                            } elseif (($field_num == 6) && (!$_SESSION['logged_in'])) {
                                // skip image location unless Admin
                            } else {
                                print "<td>" . $row[$field_num] . "</td>";
                            }
                            $field_num++;
                        }

                        // edit and delete could be links to separate pages ('edit_product.php', etc)
                        $view = '<a href="products.php?id=' . $row[0] . '">View</a>';
                        $edit = '<a href="products.php?id=' . $row[0] . '&amp;op=ed">Edit</a>';
                        $delete = '<a href="products.php?id=' . $row[0] . '&amp;op=del" onclick="return confirm(\'Are you sure you want to delete the product: ' . $row[1] . '?\')">Delete</a>';

                        print '<td>' . $view . "</td>\n";
                        if ($_SESSION['logged_in']) {  // Admins only
                            print '<td>' . $edit . "</td>\n";
                            print '<td>' . $delete . "</td>\n";
                        }
                        print "</tr>\n";
                    }
                    print "</table>";
                }
                else {
                    die("Product list query failed: $conn->error()");
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

