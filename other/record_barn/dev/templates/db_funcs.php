<?php
  $db_host = 'cis230.cis3scc.com';
  $user = 'scc_jellingson';
  $pw = 'cks111';
  $dbase = 'jellingson_cis3scc_com';

  function check_email($email) {
    if (!preg_match("/^([a-zA-Z0-9])+@([a-zA-Z0-9_-])+(\.[a-zA-Z]{2,3}$)/", $email)) {
        return FALSE;
    } else {
        return TRUE;
    }
}

?>
