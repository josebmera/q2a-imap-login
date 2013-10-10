<?php

class imap_login {

    var $directory;
    var $urltoroot;

    function load_module($directory, $urltoroot)
    {
        $this->directory=$directory;
        $this->urltoroot=$urltoroot;
    }

    // check_login() is called early on during every page request for
    // checking if user is already logged in by looking for a cookie
    // or session variable (dependent on 'remember me' setting)
    function check_login()
    {
        if(!isset($_COOKIE["qa-login_fname"]) && !isset($_SESSION["qa-login_fname"])) {
            return false;
        } else {

            if(isset($_COOKIE["bdops-login_fname"])){
                $fname = $_COOKIE["qa-login_fname"];
                $email = $_COOKIE["qa-login_email"];
                $username = $_COOKIE["qa-login_user"];
            } else {
                $fname = $_SESSION["qa-login_fname"];
                $email = $_SESSION["qa-login_email"];
                $username = $_SESSION["qa-login_user"];
            }

            $source = 'imap';
            $identifier = $email;

            $fields['email'] = $email;
            $fields['confirmed'] = true;
            $fields['handle'] = $username;
            $fields['name'] = $fname;
            
            qa_log_in_external_user($source,$identifier,$fields);
        }
    }

    function match_source($source)
    {
        return $source=='imap';
    }

    function login_html($tourl, $context)
    {

    }

    function logout_html ($tourl)
    {
        require_once QA_INCLUDE_DIR."qa-base.php";

        $_SESSION['logout_url'] = $tourl;
        $logout_url = qa_path('logout', null, qa_path_to_root());
        echo('<a href="'.$logout_url.'">'.qa_lang_html('main/nav_logout').'</a>');        
    }

}



/*
Omit PHP closing tag to help avoid accidental output
*/