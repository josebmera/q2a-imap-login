<?php
/* 
* This script creates a SESSION array or a cookie that can be checked by the
* imap-login module's check_login function, and bypasses the internal QA auth
* mechanism by redirecting back to the login page.
*/

require_once QA_INCLUDE_DIR."qa-base.php";
require  QA_INCLUDE_DIR."../qa-plugin/imap-login/imap-config.php";

// imap_process() validates the user/pass combo against the appropriate server
// and return an array with some parameters which will be used for creating
// a SESSION array or a cookie, or false if the authentication fails
function imap_process ($user, $pass)
{
    global $mailbox, $options, $n_retries;

    $server_case;
    list($username, $domain) = explode("@", $user);
    switch ($domain) {
        // A case for each server that has been configured
        case "alumnos.upm.es":
            $server_case = 0;
            break;

        case "upm.es":
            $server_case = 1;
            break;

        default:
            return false;
            break;

    }
    switch ($server_case) {
        // Select de mailbox according to the server
        case 0:
            $imap_stream = imap_open($mailbox[0], $username, $pass, $options, $n_retries);
            break;

        case 1:
            $imap_stream = imap_open($mailbox[1], $username, $pass, $options, $n_retries);
            break;

        default:
            // should never happen
            return false;
            break;

    }
    if ($imap_stream == false) {
        return false;
    } else {
        imap_close($imap_stream);
        $data = array($user, $username);
        return $data;
    }
}

function validateEmpty($attr)
{
    if ($attr == '' || preg_match("/^[[:space:]]+$/", $attr)) {

    } else {
        return true;
    }
}

$expire = 14*24*60*60;

if (validateEmpty($inemailhandle)) {
    if (validateEmpty($inpassword)) {

        $user = imap_process($inemailhandle, $inpassword);

        if ($user) {

            // Set name variables based on results from imap_process()
            $email = $user[0];
            $username = $user[1];
            if ($inremember == 'true') {
                setcookie("qa-login_fname", $username, time() + $expire, '/');
                setcookie("qa-login_email", $email, time() + $expire, '/');
                setcookie("qa-login_user", $username, time() + $expire, '/');
            } else {
                $_SESSION["qa-login_fname"] = $username;
                $_SESSION["qa-login_email"] = $email;
                $_SESSION["qa-login_user"] = $username;
            }
            qa_redirect('login');
            exit();

        } else {
            $error = 'emailhandle';
        }

    } else {
        $error = 'password';
    }
} else {
    $error = 'emailhandle';
}



/*
    Omit PHP closing tag to help avoid accidental output
*/