<?php
$page_title = "Carolyn Ellingson: Brilliant Abstract Art";
$desc = "The powerful, brillian abstract art of Carolyn Ellingson, 1937-2002.   Visit the Gallery to see striking visual paintings and prints.";
$keys = "art, san francisco, contemporary art, abstract, abstract art, non-representational, carolyn ellingson, ellingson, carolyn, c ellingson, artgroove, oil painting, pastel drawing, pastel, acrylic, acrylic painting, painting, drawing, monotype, pastel, watercolor, gouache, design, color, intense color, form, line, composition, drawing, painting, art quotes, artists say, artist quotes, quotations, art quotations, artist quotations, sell art, art gallery, art auction, visual art, on-line, buy, home, home decor, office, office decor, interior design, color field, sales, art dealer, art seller, contemporary, colorful, modern, post-modern, strong, fine art, visual art, mixed media, hunter's point, open studio, hunter's point shipyard, studio visit, exhibition, exhibit, venue, auction, direct to buyer, direct to you, direct sales, sell direct, buy art, framing, frame, framing tips, hang, moderate price, acid-free, archival, design, web design, web designer, san francisco, show, free, image, images, california, northern california, san francisco bay area, bay area, united states, original, original art, new art, recent work, select work, selection, extraordinary, pictures, fine artist, creative, design services, colours, handmade, exciting, fine art, bargain, printmaking, prints, studio, color field, colour field, art world, new, art object";
include("./templates/header.php");
?>

<body>
    <div id="wrapper">
        <?php include("./templates/nav_header.html"); ?>

        <div id="main_content">
            <div id="slideshow">
                <script type="text/javascript">
                <!--  
                // display the initial image and title
                    init_images();
                //  -->
                </script>
            </div><!-- closes slideshow div -->

            <script type="text/javascript">
                <!-- 
                // display random art quote
                init_quote();
                // -->
            </script>
        </div><!-- main_content -->
    </div><!-- entry -->
    <?php include("./templates/footer.htm"); ?>
</body>
</html>
