function toggle_faq_display(elem_id) {
	var faq = document.getElementById(elem_id);
	if (faq.style.maxHeight == "1000px") 
		faq.style.maxHeight = "0";
	else
		faq.style.maxHeight = "1000px";
}

function change_image(elem_id, img) {
	document.getElementById(elem_id).src = img;
}
	