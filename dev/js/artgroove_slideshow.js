var image_path = "./images/slides/";

var images = [
	["angles_show.jpg", "2013 Show at Inside Angles, Holland OH", "Show Runs Through 17 June!", "0"],
	["carolyns_brushes_slide.jpg", "The Artist's Brushes", " ", "0"],
	["carolyn_with_memphis_ca_1986_slide.jpg", "Carolyn with \"Memphis CA\"", "1986 ", "0"],
	["carolyn_at_studio_sale_1998_slide.jpg", "Carolyn Ellingson", "1998 Open Studio ", "0"],
	["carolyn_1990_slide.jpg", "Carolyn Ellingson", "1990 ", "0"],
	["1688_toons_and_dreams.jpg", "Toons and Dreams", "acrylic on canvas, 30\"x30\"", "0"],
	["0225_images_from_within_i.jpg", "Image From Within, I", "monotype with painting, 17.5\" x 23.5\"", "1"],
	["1008_love_of_the_irrational.jpg", "Love of the Irrational", "oil on canvas, 12\" x 12\"", "0"],
	["1010_luminous_entities_convene.jpg", "Luminous Entities Convene", "acrylic on canvas, 48\" x 70\"", "0"],
	["1031_mastermind.jpg", "Mastermind", "iridescent acrylic on canvas, 36\" x 36\"", "0"],
	["1362_radio_head_ii.jpg", "Radio Head, II", "pastel on black paper, 19\" x 25\"", "0"],
	["0122_recent_painting.jpg", "untitled", "oil on canvas, 36\" x 36\"", "0"],
	["0423_centrifuge.jpg", "Centrifuge", "oil on canvas, 16\" x 20\"", "0"],
	["0679_does_anyone_else_live_like_this.jpg", "Does Anyone Else Live Like This?", "acrylic on paper, 26\" x 32\"", "0"],
	["0746_entertainments.jpg", "Entertainments", "watercolor/gouache on paper, 15\" x 18\"", "0"],
	["0550_bluescape_ii.jpg", "Bluescape II", "monotype, 17.5\" x 23.5\"", "0"],
	["0295_blue_moon.jpg", "Blue Moon", "pastel on black paper, 19\" x 25\"", "0"],
	["0107_ice_blue.jpg", "Ice Blue", "oil on canvas, 48\" x 60\"", "0"],
	["1180_out_of_the_blue.jpg", "Out of the Blue", "oil on canvas, 24\" x 20\"", "0"],
	["1393_red_and_blue_i.jpg", "Red and Blue I", "monotype, 23.5\" x 17.5\"", "0"],
	["1411_red_hot_red_and_blues.jpg", "Red Hot (and Blues)", "monotype / painting, 24\" x 36\"", "0"],
	["1621_study_in_black_red_and_blue_36.jpg", "Study in Black, Red and Blue #36", "monotype, 8\" x 8\"", "0"],
	["1614_study_in_black_red_and_blue_27.jpg", "Study in Black, Red and Blue #27", "monotype, 8\" x 8\"", "0"],
	["1605_study_in_black_red_and_blue_16.jpg", "Study in Black, Red and Blue #16", "monotype, 23\" x 34\"", "0"],
	["0212_rose_and_black.jpg", "Rose and Black", "monotype, 23.75\" x 17.5\"", "0"],
	["0299_untitled_pastel.jpg", "untitled", "pastel on black paper, 19\" x 25\"", "0"],
	["0235_cerulean_i.jpg", "Cerulean I", "acrylic, iridescent acrylic and oil pastel, 19\" x 26.5\"", "0"],
	["1777_hoopla_i.jpg", "Hoopla I", "watercolor with gouache, 9.5\" x 12\"", "1"],
	["0888_hot_spots.jpg", "Hot Spots", "monotype, 4\" x 6\"", "0"],
	["0006_maui_zowie_vi_painting.jpg", "Maui Zowie VI", "oil on canvas, 23.75\" x 19.75\"", "0"],
	["0008_rejection_of_the_third_dimension_ii.jpg", "Rejection of the Third Dimension II", "oil on canvas, 18\" x 24\"", "0"],
	["0024_pacific_surf.jpg", "Pacific Surf", "oil on canvas, 20\" x 23.75\"", "0"],
	["0027_wild_ride_ii.jpg", "Wild Ride II", "oil on canvas, 18\" x 24\"", "0"],
	["0061_islais.jpg", "Islais", "watercolor, gouache and oil pastel, 14.5\" x 21.5\"", "0"],
	["0071_dunshee.jpg", "Dunshee", "watercolor, gouache and oil pastel, 10.5\" x 14.5\"", "0"],
	["0074_turquoise_and_cobalt_abstract_i.jpg", "Turquoise and Cobalt Abstract", "oil on canvas, 24\" x 24\"", "0"],
	["0078_little_yellow_extravagance.jpg", "Little Yellow Extravagance", "oil on canvas, 24\" x 24\"", "0"],
	["0079_yellow_flip.jpg", "Yellow Flip", "oil on canvas, 24\" x 30\"", "0"],
	["0086_malibu_v.jpg", "Malibu, V", "monotype, 23.5\" x 17.5\"", "0"],
	["0099_black_red_and_blue_abstract_ii.jpg", "Black, Red and Blue Abstract, #2", "oil on canvas, 36\" x 36\"", "0"],
	["0113_happy_new_year.jpg", "Happy New Year", "monotype with collage, 17.5\" x 23.5\"", "0"],
	["0120_red_abstract_41.jpg", "Red Abstract, #41", "monotype, 17.5\" x 23.5\"", "1"],
	["0121_green_machine.jpg", "Green Machine", "oil or acrylic on canvas (unsure), 40\" x 67\"", "0"],
	["0136_rose_madder_4.jpg", "Rose Madder, #4", "monotype, 7.75\" x 7.75\"", "0"],
	["0139_emancipated_eye_vi.jpg", "Emancipated Eye, VI", "monotype with painting, 7.75\" x 7.75\"", "1"],
	["0256_span.jpg", "Span", "monotype with painting, 17.5\" x 23.5\"", "0"],
	["0285_dark_garden_ix.jpg", "Dark Garden, IX", "monotype with painting, 17.5\" x 23.5\"", "0"],
	["0291_paradise_with_tiger.jpg", "Paradise with Tiger", "oil on canvas, 67\" x 92\"", "0"],
	["0312_pink_smash_x.jpg", "Pink Smash, X", "monotype, 23\" x 34\"", "0"],
	["0319_rococo_ii.jpg", "Rococo, II", "monotype, 23\" x 34\"", "1"],
	["0342_elysium_i.jpg", "Elysium, I", "monotype, 23\" x 34\"", "1"],
	["0353_red_black_and_pink_field.jpg", "Red, Black and Pink Field", "monotype with painting, 23\" x 34\"", "0"],
	["0378_untitled_drawing_i.jpg", "untitled drawing, I", "ink drawing, 4\" x 6\"", "0"],
	["0412_composition_in_cadmium_red_ii.jpg", "Composition in Cadmium Red, II", "monotype, 23.5\" x 17.5\"", "0"],
	["0428_information_age.jpg", "Information Age", "acrylic on canvas, 24\" x 36\"", "0"],
	["0511_baybee.jpg", "Baybee", "oil on canvas, 24\" x 24\"", "0"],
	["0542_blue_fusion.jpg", "Blue Fusion", "acrylic on canvas, 30\" x 30\"", "0"],
	["0551_boingo.jpg", "Boingo", "fluorescent acrylic on canvas, 36\" x 36\"", "0"],
	["0566_but_will_it_match_the_couch.jpg", "But Will It Match the Couch?", "oil on canvas, 72\" x 49\"", "0"],
	["0595_chrome_green_and_pink_ii.jpg", "Chrome Green and Pink, II", "monotype with painting, 23\" x 34\"", "0"],
	["0633_the_dark_is_in_love_with_forms_of_light.jpg", "The Dark is in Love with Forms of Light", "monotype, 34\" x 45\"", "0"],
	["0641_deconstructed_landscape.jpg", "Deconstructed Landscape", "acrylic on paper, 22\" x 30\"", "0"],
	["0645_delerium_iv.jpg", "Delerium, IV", "monotype, 17.5\" x 23.5\"", "0"],
	["0647_delicate_negotiations.jpg", "Delicate Negotiations", "iridescent acrylic on canvas, 21\" x 21\"", "0"],
	["0677_distant_destination_ii.jpg", "Distant Destination, II", "watercolor with gouache, 8\" x 10\"", "0"],
	["0696_earthly_delights_2.jpg", "Earthly Delights, #2", "pastel on black paper, 19\" x 25\"", "0"],
	["0737_encore.jpg", "Encore", "acrylic on canvas, 36\" x 24\"", "0"],
	["0742_encounter.jpg", "Encounter", "acrylic on canvas, 32\" x 32\"", "0"],
	["0744_endless_fun_ii.jpg", "Endless Fun, II", "acrylic on canvas, 36\" x 24\"", "0"],
	["0745_entertainers_dressing.jpg", "Entertainers Dressing", "collage, 16\" x 12\"", "0"],
	["0756_extravaganza.jpg", "Extravaganza", "oil on canvas, 18\" x 14\"", "0"],
	["0823_garnet_and_blue.jpg", "Garnet and Blue", "monotype, 17.5\" x 23.5\"", "0"],
	["0824_generation_of_high_order_harmonics.jpg", "Generation of High Order Harmonics Originated From a Single Quantum Path", "oil on canvas, 42\" x 72\"", "0"],
	["0892_hot_spots_iv.jpg", "Hot Spots, IV", "oil on canvas, 17\" x 17\"", "0"],
	["0920_infatuation.jpg", "Infatuation", "oil on canvas, 30\" x 22\"", "0"],
	["0931_intergalactic_traffic.jpg", "Intergalactic Traffic", "pastel on black paper, 19\" x 25\"", "0"],
	["0942_isla_de_cozumel_mexico.jpg", "Isla de Cozumel, Mexico", "watercolor, 12\" x 13\"", "0"],
	["0945_japonesque_i.jpg", "Japonesque, I", "monotype, 23.5\" x 17.5\"", "0"],
	["0967_kinahhn.jpg", "Kinahhn", "oil on canvas, 24\" x 20\"", "0"],
	["0995_little_arch.jpg", "Little Arch", "fluorescent acrylic on canvas, 24\" x 24\"", "0"],
	["1042_metro.jpg", "Metro", "acrylic on canvas, 48\" x 48\"", "0"],
	["1067_modern_times_iii.jpg", "Modern Times, III", "monotype, 23\" x 34\"", "0"],
	["1117_neptune.jpg", "Neptune", "fluorescent acrylic, 48\" x 84\"", "0"],
	["1125_new_beginnings_vii.jpg", "New Beginnings, VII", "monotype with painting, 34\" x 23\"", "0"],
	["1174_orange_extravagance.jpg", "Orange Extravagance", "oil on canvas, 24\" x 24\"", "0"],
	["1175_orange_fusion.jpg", "Orange Fusion", "watercolor, 19\" x 22\"", "0"],
	["1190_palm_ii.jpg", "Palm, II", "pastel on black paper, 19\" x 25\"", "0"],
	["1204_passage.jpg", "Passage", "monotype, 23\" x 34\"", "0"],
	["1357_pyromaniacs_love_song_with_charred_remains.jpg", "Pyromaniac's Love Song with Charred Remains", "oil on canvas, 42\" x 54\"", "0"],
	["1358_quake.jpg", "Quake", "monotype, 17.5\" x 23.5\"", "0"],
	["1359_quint.jpg", "Quint", "monotype with gouache and oil pastel, 18\" x 21\"", "0"],
	["1479_scorcher.jpg", "Scorcher", "oil on canvas, 18\" x 24\"", "0"],
	["1480_sea_creatures.jpg", "Sea Creatures", "acrylic on paper, 22\" x 30\"", "0"],
	["1487_sensing_device.jpg", "Sensing Device", "oil on canvas, 12\" x 12\"", "0"],
	["1494_serene_spaces_iii.jpg", "Serene Spaces, III", "monotype with painting, 17.5\" x 23.5\"", "0"],
	["1510_situations_iv.jpg", "Situations, IV", "watercolor, gouache and acrylic on paper, 22\" x 30\"", "0"],
	["1580_strata_i.jpg", "Strata, I", "monotype, 34\" x 23\"", "0"],
	["1582_study_in_black_1.jpg", "Study in Black, 1", "monotype, 17.5\" x 23.5\"", "0"],
	["1641_study_in_black_red_and_blue_62.jpg", "Study in Black, Red and Blue, #62", "monotype, 8\" x 8\"", "0"],
	["1687_tomorrow_land.jpg", "Tomorrow Land", "pastel on black paper, 24\" x 30\"", "0"],
	["1692_totem_ii.jpg", "Totem, II", "monotype with painting, 8\" x 8\"", "0"],
	["1704_tee_shirt_black_shirt_pelicans.jpg", "T-Shirt: Pelicans", "metallic textile paint", "0"],
	["1778_urban_composition.jpg", "Urban Composition", "oil on canvas, 24\" x 24\"", "0"],
	["1791_viaduct.jpg", "Viaduct", "fluorescent acrylic on canvas, 36\" x 36\"", "0"],
	["1796_warrior.jpg", "Warrior", "monotype with collage, 4\" x 6\"", "0"],
	["1836_zulu.jpg", "Zulu", "monotype, 4\" x 6\"", "0"],
	["1853_in_my_heart.jpg", "In My Heart", "watercolor, 11\" x 15\"", "0"],
	["1870_riverbank.jpg", "Riverbank", "watercolor, 18\" x 24\"", "0"]
	];

function random_num(num) {
	return (Math.floor(Math.random() * num));
}

// caching no longer done en masse
function cache_images () {
//if (document.images) {
	// cache images for quick loading
	// stores pre-loaded images, so browser garbage collection doesn't remove them from the cache
	var image_objects = new Array();
	// preload images by cycling through the src files as javascript image objects.
	var cache_img = new Image();

	for (var i = 0; i < images.length; i++) {
		cache_img.src = image_path + images[i][0]; // use same object to cache image sources!
		// push onto global array to prevent cleanup by browser
		image_objects.push(cache_img);
	}
}

// global image indices
var cur_index = random_num(images.length);
var next_index = random_num(images.length);
var new_index;
var ssid;

// use this to pause the slideshow by mouse-click...
function stopSlideshow() {
	ssid = clearInterval(ssid);  // arg for clearInterval is return value of setInterval!
	// change Stop button to Play
	$("#slide_control1").replaceWith("<input type='button' class='slide_button' onclick='playSlideshow(ssid);' value='Play' id='slide_control1' />");
	$("#slide_control2").replaceWith("<input type='button' class='slide_button' onclick='playSlideshow(ssid);' value='Play' id='slide_control2' />");
}
// use this to start the slideshow by mouse-click...
function playSlideshow() {
	ssid = setInterval("slideSwitch()", 5000);  // arg for clearInterval is return value of setInterval!
	// change Stop button to Stop
	$("#slide_control1").replaceWith("<input type='button' class='slide_button' onclick='stopSlideshow(ssid);' value='Pause' id='slide_control1' />");
	$("#slide_control2").replaceWith("<input type='button' class='slide_button' onclick='stopSlideshow(ssid);' value='Pause' id='slide_control2' />");
}

// init_images()
// Assign a current image div and next image div to set up
// the initial image display and first slide transition.
// 
// The 2 divs will be used again and again (toggling classes from active/next_active and
// changing the image and info each time) to transition through the images.
//
// NOTE: optional argument allows defining initial image for special assignment!
function init_images(first_index) {
	if (typeof first_index == 'undefined')
		cur_index = random_num(images.length); // cur_index & next_index are globals, so don't need initialized here
	else
		cur_index = first_index;  // specified first image index in call from html
		
	//cache the first image!
	var first_img = new Image();
	first_img.src = image_path + images[cur_index][0];
	
	next_index = random_num(images.length);
	// don't let images repeat in slideshow
	while (next_index == cur_index) {
		next_index = random_num(images.length);
	}
	//cache next img
	next_img = new Image();
	next_img.src = image_path + images[next_index][0];
	
	if (document) {	
		document.open();
		// create the "next" and "active" divs -- these occupy the same space on the page!
		document.write('<div class="active">' + "\n");
		document.write('<p class="front_page_image">' + "\n");
		document.write("\n<input type='button' class='slide_button' onclick='stopSlideshow(ssid);' value='Pause' id='slide_control1' />");
		document.write('<img src="' + image_path + images[cur_index][0] + '" alt="Artgroove Image" style="display: inline" onclick="slideSwitch()" onMouseOver="this.style.cursor=\'pointer\'" />');
		document.write("<br />\n");
		document.write('<span>' + images[cur_index][1] + '</span>');
		document.write("<br />\n");
		document.write('<span style="font-size: 80%; font-style: italic">' + images[cur_index][2] + '</span></p>');
		document.write("\n" + '</div>');
		
		document.write('<div class="" style="display:none">' + "\n");
		document.write('<p class="front_page_image">' + "\n");
		document.write("\n<input type='button' class='slide_button' onclick='stopSlideshow(ssid);' value='Pause' id='slide_control2' />");
		document.write('<img src="' + image_path + images[next_index][0] + '" alt="Artgroove Image" style="display: inline" onclick="slideSwitch()" onMouseOver="this.style.cursor=\'pointer\'" />');
		document.write("<br />\n");
		document.write('<span>' + images[next_index][1] + '</span>');
		document.write("<br />\n");
		document.write('<span style="font-size: 80%; font-style: italic">' + images[next_index][2] + '</span></p>');
		document.write("\n</div><!--closes 2nd slide div-->");
		document.close();
		$(function() {
			ssid = setInterval("slideSwitch()", 5000);
		});
	}
}

// slideSwitch()
// This function needs to do a couple things:
// 1.  fade in the next-active image
// 2.  toggle classes on the 2 superimposed divs
// 3.  choose a new random image different from the one in the ones currently "loaded"
function slideSwitch() {
	// get a new image index that isn't one of the previous two--we'll use this below
	do {new_index = random_num(images.length);}
	while (new_index == cur_index || new_index == next_index);
	
	//cache next img
	next_img = new Image();
	next_img.src = image_path + images[new_index][0];
	
	// get handles on divs
	var $active = $('#slideshow DIV.active');
	// tricky bit--get a handle on the other div (currently without a class)
	var $next = $active.next().length ? $active.next() : $('#slideshow DIV:first');
	
	// do the fade and stage the next image/info
	$active.fadeOut(1000, function() {
			$active.removeClass('active');
			cur_index = next_index;
			next_index = new_index;
			$active.find('img').attr("src", image_path + images[next_index][0]);
			$active.find('span').first().text(images[next_index][1]);
			$active.find('span').last().text(images[next_index][2]);
		});
	$next.fadeIn(1000, function() {
			$next.addClass('active');
		});
}
