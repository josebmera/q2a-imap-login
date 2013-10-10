<?php

global $mailbox, $options, $n_retries;

// For more information about the config  parameters: http://php.net/manual/en/function.imap-open.php

// You may configure more than a server:
$mailbox = array("{correo.alumnos.upm.es:993/imap/ssl}INBOX", "{correo.upm.es:993/imap/ssl}INBOX");

//Following are optional
$options = 0;
$n_retries = 0;



/*
	Omit PHP closing tag to help avoid accidental output
*/