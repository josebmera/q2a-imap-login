<?php

	class qa_html_theme_layer extends qa_html_theme_base
	{
		function nav_list($navigation, $navtype, $level=null)
		{
			// Remove register link from the login bar
			unset($navigation['register']);

			qa_html_theme_base::nav_list($navigation, $navtype);
		} // end function nav_list

		function main()
		{
			if ($this->template == 'account') {
				// Remove password form from the user account page
				unset($this->content['form_password']);
			}
			qa_html_theme_base::main(); // call back through to the default function	    
		}
	};



/*
	Omit PHP closing tag to help avoid accidental output
*/