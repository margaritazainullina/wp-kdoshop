<?php
function login_formo_css() {?>
	<style type="text/css">
		body.login{background:url(<?php echo cfb_ez_get_option( 'loginformo_bg_image', 'cfb_login_formo_general', 'true' );?>) <?php echo cfb_ez_get_option( 'loginformo_bg_color', 'cfb_login_formo_general', 'true' );?>;}
		body.login{background-repeat:<?php echo cfb_ez_get_option( 'loginformo_bg_img_repeat', 'cfb_login_formo_general', 'true' );?>;}
		body.login{background-size:<?php echo cfb_ez_get_option( 'loginformo_bg_img_size', 'cfb_login_formo_general', 'true' );?>;}
		body.login div#login{border:<?php echo cfb_ez_get_option( 'form_section_border_width', 'cfb_login_formo_section', 'true' );?>px solid <?php echo cfb_ez_get_option( 'form_section_border_color', 'cfb_login_formo_section', 'true' );?>;}
		body.login div#login{border-radius:<?php echo cfb_ez_get_option( 'form_section_border_radius', 'cfb_login_formo_section', 'true' );?>px;}
		body.login div#login{background:url(<?php echo cfb_ez_get_option( 'form_section_bg_img', 'cfb_login_formo_section', 'true' );?>) <?php echo cfb_ez_get_option( 'form_section_bg_color', 'cfb_login_formo_section', 'true' );?>;}
		body.login div#login{background-repeat:<?php echo cfb_ez_get_option( 'form_section_bg_repeat', 'cfb_login_formo_section', 'true' );?>;}
		body.login div#login{background-size:<?php echo cfb_ez_get_option( 'form_section_bg_size', 'cfb_login_formo_section', 'true' );?>;}
		body.login div#login form#loginform, body.login div#login form#registerform, body.login div#login form#lostpasswordform{border:<?php echo cfb_ez_get_option( 'form_border_width', 'cfb_login_formo', 'true' );?>px solid <?php echo cfb_ez_get_option( 'form_border_color', 'cfb_login_formo', 'true' );?>;}
		body.login div#login form#loginform, body.login div#login form#registerform, body.login div#login form#lostpasswordform{border-radius:<?php echo cfb_ez_get_option( 'form_border_radius', 'cfb_login_formo', 'true' );?>px;}
		body.login div#login form#loginform, body.login div#login form#registerform, body.login div#login form#lostpasswordform{background:url(<?php echo cfb_ez_get_option( 'form_bg_img', 'cfb_login_formo', 'true' );?>) <?php echo cfb_ez_get_option( 'form_bg_color', 'cfb_login_formo', 'true' );?>;}
		body.login div#login form#loginform, body.login div#login form#registerform, body.login div#login form#lostpasswordform{background-repeat:<?php echo cfb_ez_get_option( 'form_bg_repeat', 'cfb_login_formo', 'true' );?>;}
		body.login div#login form#loginform, body.login div#login form#registerform, body.login div#login form#lostpasswordform{background-size:<?php echo cfb_ez_get_option( 'form_bg_size', 'cfb_login_formo', 'true' );?>;}
		body.login div#login form#loginform p label, body.login div#login form#registerform p label, #reg_passmail, body.login div#login form#lostpasswordform p label{text-transform:<?php echo cfb_ez_get_option( 'label_text_transform', 'cfb_login_formo', 'true' );?>;}
		body.login div#login form#loginform p label, body.login div#login form#registerform p label, #reg_passmail, body.login div#login form#lostpasswordform p label{color:<?php echo cfb_ez_get_option( 'label_color', 'cfb_login_formo', 'true' );?>;}
		body.login div#login form#loginform p input, body.login div#login form#registerform p input, body.login div#login form#lostpasswordform p input{border:<?php echo cfb_ez_get_option( 'input_border_width', 'cfb_login_formo', 'true' );?>px solid <?php echo cfb_ez_get_option( 'input_border_color', 'cfb_login_formo', 'true' );?>;}
		body.login div#login form#loginform p input, body.login div#login form#registerform p input, body.login div#login form#lostpasswordform p input{border-radius:<?php echo cfb_ez_get_option( 'input_border_radius', 'cfb_login_formo', 'true' );?>px;}
		body.login div#login form#loginform p input, body.login div#login form#registerform p input, body.login div#login form#lostpasswordform p input{background:url(<?php echo cfb_ez_get_option( 'input_bg_img', 'cfb_login_formo', 'true' );?>) <?php echo cfb_ez_get_option( 'input_bg_color', 'cfb_login_formo', 'true' );?>;}
		body.login div#login form#loginform p input, body.login div#login form#registerform p input, body.login div#login form#lostpasswordform p input{background-repeat:<?php echo cfb_ez_get_option( 'input_bg_repeat', 'cfb_login_formo', 'true' );?>;}
		body.login div#login form#loginform p input, body.login div#login form#registerform p input, body.login div#login form#lostpasswordform p input{background-size:<?php echo cfb_ez_get_option( 'input_bg_size', 'cfb_login_formo', 'true' );?>;}
		body.login div#login form#loginform p input, body.login div#login form#registerform p input, body.login div#login form#lostpasswordform p input{color:<?php echo cfb_ez_get_option( 'input_text_color', 'cfb_login_formo', 'true' );?>;}
		html body.login div#login form#loginform p.submit input#wp-submit, body.login div#login form#registerform p.submit input#wp-submit, body.login div#login form#lostpasswordform  p.submit input#wp-submit{border:<?php echo cfb_ez_get_option( 'btn_border_width', 'cfb_login_formo', 'true' );?>px solid <?php echo cfb_ez_get_option( 'btn_border_color', 'cfb_login_formo', 'true' );?>;}
		html body.login div#login form#loginform p.submit input#wp-submit, body.login div#login form#registerform p.submit input#wp-submit, body.login div#login form#lostpasswordform  p.submit input#wp-submit{border-radius:<?php echo cfb_ez_get_option( 'btn_border_radius', 'cfb_login_formo', 'true' );?>px;}
		html body.login div#login form#loginform p.submit input#wp-submit, body.login div#login form#registerform p.submit input#wp-submit, body.login div#login form#lostpasswordform  p.submit input#wp-submit{color:<?php echo cfb_ez_get_option( 'btn_text_color', 'cfb_login_formo', 'true' );?>;}
		html body.login div#login form#loginform p.submit input#wp-submit, body.login div#login form#registerform p.submit input#wp-submit, body.login div#login form#lostpasswordform  p.submit input#wp-submit{background:<?php echo cfb_ez_get_option( 'btn_bg_color', 'cfb_login_formo', 'true' );?>;}
		html body.login div#login form#loginform p.submit input#wp-submit, body.login div#login form#registerform p.submit input#wp-submit, body.login div#login form#lostpasswordform  p.submit input#wp-submit{text-transform:<?php echo cfb_ez_get_option( 'btn_text_transform', 'cfb_login_formo', 'true' );?>;}
		html body.login div#login form#loginform p.submit input#wp-submit:hover, body.login div#login form#registerform p.submit input#wp-submit:hover, body.login div#login form#lostpasswordform  p.submit input#wp-submit:hover{color:<?php echo cfb_ez_get_option( 'btnh_text_color', 'cfb_login_formo', 'true' );?>;}
		html body.login div#login form#loginform p.submit input#wp-submit:hover, body.login div#login form#registerform p.submit input#wp-submit:hover, body.login div#login form#lostpasswordform  p.submit input#wp-submit:hover{background:<?php echo cfb_ez_get_option( 'btnh_bg_color', 'cfb_login_formo', 'true' );?>;}
		html body.login p.message{border-left:<?php echo cfb_ez_get_option( 'not_border_width', 'notification', 'true' );?>px solid <?php echo cfb_ez_get_option( 'not_border_color', 'notification', 'true' );?>;}	
		html body.login div#login_error{border-left:<?php echo cfb_ez_get_option( 'not_border_width', 'notification', 'true' );?>px solid <?php echo cfb_ez_get_option( 'not_border_color', 'notification', 'true' );?>;}		
		html body.login div#login_error{border-left-color:<?php echo cfb_ez_get_option( 'not_error_border_color', 'notification', 'true' );?>;}		
		html body.login p.message{border-radius:<?php echo cfb_ez_get_option( 'not_border_radius', 'notification', 'true' );?>px;}		
		html body.login div#login_error{border-radius:<?php echo cfb_ez_get_option( 'not_border_radius', 'notification', 'true' );?>px;}	
		html body.login div#login p#nav a{text-transform:<?php echo cfb_ez_get_option( 'nav_text_transform', 'cfb_login_formo_general', 'true' );?>;}
		html body.login div#login p#nav a{color:<?php echo cfb_ez_get_option( 'nav_text_color', 'cfb_login_formo_general', 'true' );?>;}
		html{background:none;}
		body.login div#login {padding: 40px;position: absolute;left: 50%;margin: -225px auto auto -200px;top: 50%;}
		body.login div#login h1 a {width:100%;}
		body.login div#login form#loginform, #lostpasswordform, #registerform {box-shadow:none;}
		body.login div#login form#loginform p.forgetmenot input#rememberme {border:none;border-radius:0px;}
		html body.login div#login form#loginform p.submit input#wp-submit, body.login div#login form#registerform p.submit input#wp-submit, body.login div#login form#lostpasswordform p.submit input#wp-submit {box-shadow:none;height:inherit;float:none;display:block;margin-top:10px;}
		body.login div#login p#nav {margin:0px;margin-top:10px;}
		body.login div#login p#backtoblog {display:none;}
		body.login div#login form#loginform p.forgetmenot {float:none;display:block;}
		body.login div#login form#registerform p#reg_passmail {margin-bottom:-15px;}
		html body.login p.message, html body.login div#login_error{background:url(<?php echo cfb_ez_get_option( 'not_bg_img', 'notification', 'true' );?>) <?php echo cfb_ez_get_option( 'not_bg_color', 'notification', 'true' );?>;}
		html body.login p.message, html body.login div#login_error{background-repeat:<?php echo cfb_ez_get_option( 'not_bg_repeat', 'notification', 'true' );?>;}
		html body.login p.message, html body.login div#login_error{background-size:<?php echo cfb_ez_get_option( 'not_bg_size', 'notification', 'true' );?>;}
		body.login div#login h1 a {background:url(<?php echo cfb_ez_get_option( 'loginformo_logo', 'cfb_login_formo_general', 'true' );?>);}
	</style>
<?php
}
add_action('login_enqueue_scripts', 'login_formo_css');