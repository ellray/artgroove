<?php
// php function for inclusion by forms for validating email address input
function validate_email($email) {
	if (!preg_match("/^([a-zA-Z0-9])+@([a-zA-Z0-9_-])+(\.[a-zA-Z]{2,3}$)/", $email)) {
			return FALSE;
	} else {
			return TRUE;
	}
}
?>
