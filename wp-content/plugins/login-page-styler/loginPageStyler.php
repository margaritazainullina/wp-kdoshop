<?php
/* 
 *Plugin Name: Login Page Styler
 *Plugin URI:http://web-settler.com/login-page-styler/
 *Description: This plugin allows you to customize the appearance of the WordPress Login Screen as you like to see.
 *Version: 3.1.5
 *Author: Zia Imtiaz
 *Author URI:http://web-settler.com/login-page-styler/
 *License: GPLv2
 */




function lps_login_background_color(){
    
    echo '<style>body { height:100%; background-color: ' . get_option( 'lps_login_background_color' ) . '!important; } </style>';
}


function lps_login_label_color(){

	echo '<style> .login label{ color: ' . get_option( 'lps_login_label_color' ) . '!important; opacity:'.get_option('lps_label_color_opacity').'!important; } </style>';
}


function lps_login_form_input_color_opacity(){

	echo '<style> .login form .input{background: rgba('.get_option('lps_login_form_input_color_opacity').');}</style>';
}

function lps_login_nav_color(){

	echo '<style> .login #login a{ color : '.get_option('lps_login_nav_color' ).';}</style>';
}

function lps_login_nav_hover_color(){

	echo '<style> .login #login a:hover{ color : '.get_option('lps_login_nav_hover_color' ).';}</style>';
}

function lps_login_form_border_radius(){

	echo '<style> .login form{ border-radius:'.get_option('lps_login_form_border_radius' ).'px;}</style>';
}

function lps_login_label_size(){

	echo '<style> .login label { font-size:' .get_option('lps_login_label_size').'px; font-family:'.get_option('lps_login_form_label_font').';}</style>';
}


function lps_login_remember_label_size(){

	echo '<style>  .login form .forgetmenot label {font-size:'.get_option('lps_login_remember_label_size').'px;} </style>';
}


function lps_login_nav_link_hide(){

	if (get_option('lps_login_nav_link_hide') == 1)
	{ 

		echo '<style> .login #nav {display:none;}</style>';
	}
	else
	{
	    echo '<style> .login #nav {display:block;}</style>';
	}
}


function lps_login_logo_hide(){

	if (get_option('lps_login_logo_hide') == 1)
	{ 

		echo '<style> .login h1 a {display:none;}</style>';
	}
	else
	{
	    echo '<style> .login h1 a {display:block;}</style>';
	}
}

function lps_login_form_position(){

	if(get_option('lps_login_form_position') == 1)
	{
		echo '<style>div#login { top: 0; right:0; bottom: 0; left: 0; padding: 10% 0 0 0; }</style>';
	}

	if(get_option('lps_login_form_position') == 2)
	{
		echo '<style>div#login { top: 0; right:auto; bottom: 0; left: 0; padding: 10% 70% 0 0; }</style>';
	}
	if(get_option('lps_login_form_position') == 3)
	{
		echo '<style>div#login { top: 0; right:0; bottom: 0; left: auto; padding: 10% 0 0 70%; }</style>';
	}
	if(get_option('lps_login_form_position') == 4)
	{
		echo '<style>div#login { top:0; right:auto; bottom: auto; left: auto; padding: 1% 0 0 0; }</style>';
	}

	if(get_option('lps_login_form_position') == 5)
	{
		echo '<style>div#login { top: 0; right:auto; bottom: 0; left: 0; padding: 1% 70% 0 0; }</style>';
	}
	if(get_option('lps_login_form_position') == 6)
	{
		echo '<style>div#login { top: 0; right:0; bottom: 0; left:0; padding: 1% 0 0 70%; overflow:hidden; }</style>';
	}
	
	if(get_option('lps_login_form_position') == 7 && get_option('lps_login_blog_link_hide')== 1 && get_option('lps_login_nav_link_hide') == 1 && get_option('lps_login_logo_hide') == 1 )
	{
		echo '<style>div#login { top: auto; right:auto; bottom:auto; left: autos; padding: 36% 0 0 0; }</style>';
	}

	if(get_option('lps_login_form_position') == 7 && get_option('lps_login_blog_link_hide') != 1 && get_option('lps_login_nav_link_hide') != 1 && get_option('lps_login_logo_hide') != 1 )
	{
	
	    echo '<style>div#login { top: auto; right:auto; bottom:auto; left: autos; padding: 23.5% 0 0 0; }</style>';
    }

    if(get_option('lps_login_form_position') == 7 && get_option('lps_login_blog_link_hide') == 1 && get_option('lps_login_nav_link_hide') != 1 && get_option('lps_login_logo_hide') == 1 )
	{
	
	    echo '<style>div#login { top: auto; right:auto; bottom:auto; left: autos; padding: 36% 0 0 0; }</style>';
    }


    if(get_option('lps_login_form_position') == 7 && get_option('lps_login_blog_link_hide') != 1 && get_option('lps_login_nav_link_hide') == 1 && get_option('lps_login_logo_hide') == 1 )
	{
	
	    echo '<style>div#login { top: auto; right:auto; bottom:auto; left: autos; padding: 32% 0 0 0; }</style>';
    }


    if(get_option('lps_login_form_position') == 7 && get_option('lps_login_blog_link_hide') == 1 && get_option('lps_login_nav_link_hide') != 1 && get_option('lps_login_logo_hide') !=1 )
	{
	
	    echo '<style>div#login { top: auto; right:auto; bottom:auto; left: autos; padding: 26% 0 0 0; }</style>';
    }


    if(get_option('lps_login_form_position') == 7 && get_option('lps_login_blog_link_hide') != 1 && get_option('lps_login_nav_link_hide') == 1 && get_option('lps_login_logo_hide') !=1 )
	{
	
	    echo '<style>div#login { top: auto; right:auto; bottom:auto; left: autos; padding: 26% 0 0 0; }</style>';
    }



    if(get_option('lps_login_form_position') == 7 && get_option('lps_login_blog_link_hide') != 1 && get_option('lps_login_nav_link_hide') != 1 && get_option('lps_login_logo_hide') == 1 )
	{
	
	    echo '<style>div#login { top: auto; right:auto; bottom:auto; left: autos; padding: 30% 0 0 0; }</style>';
    }


    if(get_option('lps_login_form_position') == 7 && get_option('lps_login_blog_link_hide') == 1 && get_option('lps_login_nav_link_hide') == 1 && get_option('lps_login_logo_hide') != 1 )
	{
	
	    echo '<style>div#login { top: auto; right:auto; bottom:auto; left: autos; padding: 29% 0 0 0; }</style>';
    }


	if(get_option('lps_login_form_position') == 8 && get_option('lps_login_blog_link_hide')== 1 && get_option('lps_login_nav_link_hide') == 1 && get_option('lps_login_logo_hide') == 1 )
	{
		echo '<style>div#login { top: auto; right:auto; bottom:auto; left: autos; padding: 36% 70% 0 0; }</style>';
	}

	if(get_option('lps_login_form_position') == 8 && get_option('lps_login_blog_link_hide') != 1 && get_option('lps_login_nav_link_hide') != 1 && get_option('lps_login_logo_hide') != 1 )
	{
	
	    echo '<style>div#login { top: auto; right:auto; bottom:auto; left: autos; padding: 23.5% 70% 0 0; }</style>';
    }

    if(get_option('lps_login_form_position') == 8 && get_option('lps_login_blog_link_hide') == 1 && get_option('lps_login_nav_link_hide') != 1 && get_option('lps_login_logo_hide') == 1 )
	{
	
	    echo '<style>div#login { top: auto; right:auto; bottom:auto; left: autos; padding: 36% 70% 0 0; }</style>';
    }


    if(get_option('lps_login_form_position') == 8 && get_option('lps_login_blog_link_hide') != 1 && get_option('lps_login_nav_link_hide') == 1 && get_option('lps_login_logo_hide') == 1 )
	{
	
	    echo '<style>div#login { top: auto; right:auto; bottom:auto; left: autos; padding: 32% 70% 0 0; }</style>';
    }


    if(get_option('lps_login_form_position') == 8 && get_option('lps_login_blog_link_hide') == 1 && get_option('lps_login_nav_link_hide') != 1 && get_option('lps_login_logo_hide') !=1 )
	{
	
	    echo '<style>div#login { top: auto; right:auto; bottom:auto; left: autos; padding: 26% 70% 0 0; }</style>';
    }


    if(get_option('lps_login_form_position') == 8 && get_option('lps_login_blog_link_hide') != 1 && get_option('lps_login_nav_link_hide') == 1 && get_option('lps_login_logo_hide') !=1 )
	{
	
	    echo '<style>div#login { top: auto; right:auto; bottom:auto; left: autos; padding: 26% 70% 0 0; }</style>';
    }



    if(get_option('lps_login_form_position') == 8 && get_option('lps_login_blog_link_hide') != 1 && get_option('lps_login_nav_link_hide') != 1 && get_option('lps_login_logo_hide') == 1 )
	{
	
	    echo '<style>div#login { top: auto; right:auto; bottom:auto; left: autos; padding: 30% 70% 0 0; }</style>';
    }


    if(get_option('lps_login_form_position') == 8 && get_option('lps_login_blog_link_hide') == 1 && get_option('lps_login_nav_link_hide') == 1 && get_option('lps_login_logo_hide') != 1 )
	{
	
	    echo '<style>div#login { top: auto; right:auto; bottom:auto; left: autos; padding: 29% 70% 0 0; }</style>';

	} 



	if(get_option('lps_login_form_position') == 9 && get_option('lps_login_blog_link_hide')== 1 && get_option('lps_login_nav_link_hide') == 1 && get_option('lps_login_logo_hide') == 1 )
	{
		echo '<style>div#login { top: auto; right:auto; bottom:auto; left: autos; padding: 36% 0 0 70%; }</style>';
	}

	if(get_option('lps_login_form_position') == 9 && get_option('lps_login_blog_link_hide') != 1 && get_option('lps_login_nav_link_hide') != 1 && get_option('lps_login_logo_hide') != 1 )
	{
	
	    echo '<style>div#login { top: auto; right:auto; bottom:auto; left: autos; padding: 23.5% 0 0 70%; }</style>';
    }

    if(get_option('lps_login_form_position') == 9 && get_option('lps_login_blog_link_hide') == 1 && get_option('lps_login_nav_link_hide') != 1 && get_option('lps_login_logo_hide') == 1 )
	{
	
	    echo '<style>div#login { top: auto; right:auto; bottom:auto; left: autos; padding: 36% 0 0 70%; }</style>';
    }


    if(get_option('lps_login_form_position') == 9 && get_option('lps_login_blog_link_hide') != 1 && get_option('lps_login_nav_link_hide') == 1 && get_option('lps_login_logo_hide') == 1 )
	{
	
	    echo '<style>div#login { top: auto; right:auto; bottom:auto; left: autos; padding: 32% 0 0 70%; }</style>';
    }


    if(get_option('lps_login_form_position') == 9 && get_option('lps_login_blog_link_hide') == 1 && get_option('lps_login_nav_link_hide') != 1 && get_option('lps_login_logo_hide') !=1 )
	{
	
	    echo '<style>div#login { top: auto; right:auto; bottom:auto; left: autos; padding: 26% 0 0 70%; }</style>';
    }


    if(get_option('lps_login_form_position') == 9 && get_option('lps_login_blog_link_hide') != 1 && get_option('lps_login_nav_link_hide') == 1 && get_option('lps_login_logo_hide') !=1 )
	{
	
	    echo '<style>div#login { top: auto; right:auto; bottom:auto; left: autos; padding: 26% 0 0 70%; }</style>';
    }



    if(get_option('lps_login_form_position') == 9 && get_option('lps_login_blog_link_hide') != 1 && get_option('lps_login_nav_link_hide') != 1 && get_option('lps_login_logo_hide') == 1 )
	{
	
	    echo '<style>div#login { top: auto; right:auto; bottom:auto; left: autos; padding: 30% 0 0 70%; }</style>';
    }


    if(get_option('lps_login_form_position') == 9 && get_option('lps_login_blog_link_hide') == 1 && get_option('lps_login_nav_link_hide') == 1 && get_option('lps_login_logo_hide') != 1 )
	{
	
	    echo '<style>div#login { top: auto; right:auto; bottom:auto; left: autos; padding: 29% 0 0 70%; }</style>';

	}


	else
	{
		echo  '<style> div#login (padding:8% 0 0 0;)</style>';
	}
}

function lps_login_form_color(){
	
	echo '<style> .login form{background : '.get_option('lps_login_form_color') .'; opacity:'.get_option('lps_login_form_color_opacity ').'; }</style>';
}

function lps_login_logo_msg_hide(){

	if(get_option('lps_login_logo_msg_hide')== 1)
	{
		echo '<style> #login_error,.login .message{display:none;}</style>';
	}
	else
	{
	   
		echo '<style> #login_error,.login .message{display:block;}</style>';
	}
	
}

function lps_login_blog_link_hide(){

	if(get_option('lps_login_blog_link_hide') == 1)
	{
		echo '<style> .login #backtoblog{ display:none;}</style>';
	}
	else
	{
		echo '<style> .login #backtoblog{ display:block;}</style>';
	}
}

function lps_login_form_input_feild_border_radius(){

	echo '<style> .login form .input {border-radius:'.get_option('lps_login_form_input_feild_border_radius').'px;}</style>';
}


function lps_login_form_color_opacity(){

	echo '<style> .login form{ background: rgba('.get_option('lps_login_form_color_opacity').');</style>';
}


function lps_login_custom_css(){

	echo '<style>' .get_option('lps_login_custom_css' ) . '</style>';
}



function lps_login_button_border_radius(){

	echo '<style> .login .button-primary{ border-radius:'.get_option('lps_login_button_border_radius').'px; } </style>';
}



function lps_login_form_input_feild_border_color(){

	echo '<style> .login form .input{border-color:'.get_option('lps_login_form_input_feild_border_color').';}</style>';
}

function lps_login_logo_link(){

	return  get_option('lps_login_logo_link');
}


function lps_login_logo_tittle(){

	return get_option('lps_login_logo_tittle');
}


function lps_body_bg_img(){

	echo '<style> body{ background-image:url('.get_option('lps_body_bg_img').');background-position: center top;
	background-repeat: '.get_option('lps_login_bg_repeat').'; display:block;   background-attachment: fixed;!important background-size:100% 100% }; </style>';
}


function lps_login_logo(){
	if(get_option('lps_login_logo') != '')
	{	
	   echo '<style> .login h1 a{ display:block; background-size:'.get_option('lps_login_logo_width').'px,'.get_option('lps_login_logo_height').'px;  background-image:url('.get_option('lps_login_logo').');} </style>';
    }
    
}

function lps_login_logo_width(){

	if(get_option('lps_login_logo_width')!= '')
    {
	   echo '<style> .login h1 a{ width:'.get_option('lps_login_logo_width').'px;}</style>';
    }
}

function lps_login_logo_height(){
    if(get_option('lps_login_logo_height')!= '')
    {
	   echo '<style> .login h1 a{ height:'.get_option('lps_login_logo_height').'px;}</style>';
    }
}


function lps_login_button_color(){

	echo '<style> .login .button-primary{background-color:'.get_option('lps_login_button_color').'!important;

    border-color:'.get_option('lps_login_button_border_color').'; border:1px solid '.get_option('lps_login_button_border_color').';

    color:'.get_option('lps_login_button_text_color').';
 

    }</style>';
}


function lps_login_button_color_hover(){

	echo '<style> .login .button-primary:hover {background-color:'.get_option('lps_login_button_color_hover').'!important;

    border-color:'.get_option('lps_login_button_border_color_hover').'; border:1px solid '.get_option('lps_login_button_border_color_hover').';

    color:'.get_option('lps_login_button_text_color_hover').';

    }</style>';
}


function lps_login_form_border_style(){

	echo '<style> .login form{border-style:'.get_option('lps_login_form_border_style').';
     border-width:'.get_option('lps_login_form_border_size').'px;
     border-color:'.get_option('lps_login_form_border_color').';}</style>';
}


function lps_login_form_input_border_style(){

	echo '<style> .login form .input{border-style:'.get_option('lps_login_form_input_border_style').';
	 border-width:'.get_option('lps_login_form_input_border_size').'px;}</style>';
}

function lps_login_form_bg(){

	
	echo '<style> .login form {background-image:url('.get_option('lps_login_form_bg').'); display:block;}</style>';
	
}

function lps_login_nav_size(){

	echo '<style> .login #nav,
.login #backtoblog{font-size:'.get_option('lps_login_nav_size').'px;}</style>';
}

function lps_login_nav_rgba(){

	echo '<style> .login #nav,
.login #backtoblog{background-color:rgba('.get_option('lps_login_nav_rgba').');}</style>';
}



function lps_action_links( $links, $file ) {
	if ( $file == plugin_basename( dirname(__FILE__).'/loginPageStyler.php' ) ) {
		$links[] = '<a href="' . get_bloginfo('url') . '/wp-admin/admin.php?page=lps_option">Settings</a>';;
	}
	return $links;
}





require('loginPageStylerOption.php'); 

if (get_option('lps_login_on_off')==1) {
	require 'lpsFiltersAndActions.php';
	
}


 ?>