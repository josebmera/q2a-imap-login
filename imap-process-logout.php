<?php


require_once QA_INCLUDE_DIR."qa-base.php";

if(isset($_COOKIE["qa-login_fname"]) || isset($_SESSION["qa-login_fname"])) {

    if(isset($_COOKIE["qa-login_fname"])){
        $expire = 14*24*60*60;
        setcookie("qa-login_fname", '1', time()-$expire, '/');
        setcookie("qa-login_email", '1', time()-$expire, '/');
    }

    session_destroy();
}



/*
  Omit PHP closing tag to help avoid accidental output
*/