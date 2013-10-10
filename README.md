# IMAP Login for Question2Answer #

## Description ##

Imap-login is an IMAP authentication mechanism for Question2Answer. In it's current form, it is intended to replace the existing Q2A login form. The script will first check user credentials through an IMAP request and fall back to the login form again if that fails. When the user exists in the email server, the script will create a new user account for the individual in the Q2A database.

## Installation ##

To install the plugin:

1. Add the imap-login directory with plugin files to the qa-plugin directory for your Q2A install.

2. Edit imap-config.php to match your IMAP server settings. You may configure the login for more than a server, but then you should modify imap-process-login.php as appropiate.

3. Insert the following line of code above the if statement near line 59 of qa-include/qa-page-login.php

	require_once QA_INCLUDE_DIR.'../qa-plugin/imap-login/imap-process-login.php';

4. Insert the following line of code above the if statement near line 36 of qa-include/qa-page-logout.php

	require_once QA_INCLUDE_DIR.'../qa-plugin/imap-login/imap-process-logout.php';

5.  In qa-include/qa-page-account.php, make all these changes:

	$inhandle=qa_post_text('handle'); ... in line 70 to ... $inhandle=$useraccount['handle'];
	
	$inemail=qa_post_text('email');   ... in line 71 to ... $inemail=$useraccount['email'];
 
	'handle' => array(							'handle' => array( ...
		...				... in line 228 to ...		'type' => 'static',
	),											),

	'handle' => array(							'handle' => array(
		...				... in line 231 to ...		'type' => 'static',
	),												... ),
 
6.	If you also want to avoid the registration of a new user, insert the following sentence in the line 31 of qa-include/qa-page-register.php

	qa_redirect('login');

## Change log ##

**v0.0.0**

* Initial release which supports logging in through an IMAP request to an email server.

## License ##
This program is free software; you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation; either version 2 of the License, or (at your option) any later version.

## About Q2A ##
Question2Answer is a free and open source platform for Q&A sites. For more information, visit [http://www.question2answer.org/](http://www.question2answer.org/)
