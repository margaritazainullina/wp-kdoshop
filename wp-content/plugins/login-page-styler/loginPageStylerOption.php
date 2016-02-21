<?php

add_action( 'admin_menu', 'lps_menu');

function lps_menu(){
	add_menu_page( 'Login Page Styler', 'Login Page Styler','administrator', 'lps_option', 'lps_settings_page', '', 15);
	add_action( 'admin_init', 'lps_register_settings' );

}



function lps_register_settings(){
	register_setting('lps-settings-group', 'lps_login_background_color' );
	register_setting('lps-settings-group', 'lps_login_label_color' );
	register_setting('lps-settings-group', 'lps_login_nav_color');
	register_setting('lps-settings-group', 'lps_login_nav_hover_color');
	register_setting('lps-settings-group', 'lps_login_form_border_radius');
	register_setting('lps-settings-group', 'lps_login_label_size' );
	register_setting('lps-settings-group', 'lps_login_nav_link_hide' );
	register_setting('lps-settings-group', 'lps_login_logo_hide' );
	register_setting('lps-settings-group', 'lps_login_form_position' );
	register_setting('lps-settings-group', 'lps_login_form_color' );
	register_setting('lps-settings-group', 'lps_login_logo_msg_hide');
	register_setting('lps-settings-group', 'lps_login_on_off');
	register_setting('lps-settings-group', 'lps_login_blog_link_hide');
	register_setting('lps-settings-group', 'lps_login_form_input_feild_border_radius' );
	register_setting('lps-settings-group', 'lps_login_background_image');
	register_setting('lps-settings-group', 'lps_login_form_color_opacity');
	register_setting('lps-settings-group', 'lps_login_custom_css');
	register_setting('lps-settings-group', 'lps_login_button_border_radius');
	register_setting('lps-settings-group', 'lps_login_form_border_color');
	register_setting('lps-settings-group', 'lps_login_form_input_feild_border_color');
	register_setting('lps-settings-group', 'lps_login_remember_label_size') ;
	register_setting('lps-settings-group', 'lps_login_logo_link');
	register_setting('lps-settings-group', 'lps_login_logo_tittle');
	register_setting('lps-settings-group', 'lps_body_bg_img');
	register_setting('lps-settings-group', 'lps_login_logo');
	register_setting('lps-settings-group', 'lps_login_logo_width');
	register_setting('lps-settings-group', 'lps_login_logo_height');
	register_setting('lps-settings-group', 'lps_login_button_color');
	register_setting('lps-settings-group', 'lps_login_button_border_color');
	register_setting('lps-settings-group', 'lps_login_button_color_hover');
	register_setting('lps-settings-group', 'lps_login_button_text_color');
	register_setting('lps-settings-group', 'lps_login_button_text_color_hover');
	register_setting('lps-settings-group', 'lps_login_button_border_color_hover');
	register_setting('lps-settings-group', 'lps_login_bg_repeat');
	register_setting('lps-settings-group', 'lps_login_form_input_color_opacity');
	register_setting('lps-settings-group', 'lps_login_form_border_style');
	register_setting('lps-settings-group', 'lps_login_form_input_border_style');
	register_setting('lps-settings-group', 'lps_login_form_input_border_size');
	register_setting('lps-settings-group', 'lps_login_form_border_size');
	register_setting('lps-settings-group', 'lps_login_form_bg');
	register_setting('lps-settings-group', 'lps_login_form_label_font');
	register_setting('lps-settings-group', 'lps_login_nav_size');

	
	
}

add_action( 'admin_enqueue_scripts', 'wp_enqueue_color_picker' );
function wp_enqueue_color_picker( ) {
    wp_enqueue_style( 'wp-color-picker' );
    wp_enqueue_style( 'thickbox' );
    wp_enqueue_script( 'thickbox' );
    wp_enqueue_script( 'media-upload' ); 
    wp_enqueue_script( 'wp-color-picker-script', WP_PLUGIN_URL .'/login-page-styler/loginPageStyler.js', array( 'wp-color-picker' ), false, true );
}

 function lps_settings_page(){?>
 <style type="text/css">


    .onoffswitch {
        position: relative; width: 90px;
        -webkit-user-select:none; -moz-user-select:none; -ms-user-select: none;
    }
   td .onoffswitch-checkbox {
        display: none;
    }
    .onoffswitch-label {
        display: block; overflow: hidden; cursor: pointer;
        border: 2px solid #999999; border-radius: 20px;
    }
    .onoffswitch-inner {
        display: block; width: 200%; margin-left: -100%;
        transition: margin 0.1s ease-in 0s;
    }
    .onoffswitch-inner:before, .onoffswitch-inner:after {
        display: block; float: left; width: 50%; height: 30px; padding: 0; line-height: 30px;
        font-size: 14px; color: white; font-family: Trebuchet, Arial, sans-serif; font-weight: bold;
        box-sizing: border-box;
    }
    .onoffswitch-inner:before {
        content: "Yes";
        padding-left: 10px;
        background-color: #34A7C1; color: #FFFFFF;
    }
    .onoffswitch-inner:after {
        content: "No";
        padding-right: 10px;
        background-color: #EEEEEE; color: #999999;
        text-align: right;
    }
    .onoffswitch-switch {
        display: block; width: 18px; margin: 6px;
        background: #FFFFFF;
        position: absolute; top: 0; bottom: 0;
        right: 56px;
        border: 2px solid #999999; border-radius: 20px;
        transition: all 0.1s ease-in 0s; 
    }
    .onoffswitch-checkbox:checked + .onoffswitch-label .onoffswitch-inner {
        margin-left: 0;
    }
    .onoffswitch-checkbox:checked + .onoffswitch-label .onoffswitch-switch {
        right: 0px; 
    }

@font-face {
  font-family: 'Montserrat';
  font-style: normal;
  font-weight: 400;
  src: local('Montserrat-Regular'), url(http://fonts.gstatic.com/s/montserrat/v6/zhcz-_WihjSQC0oHJ9TCYPk_vArhqVIZ0nv9q090hN8.woff2) format('woff2'), url(http://fonts.gstatic.com/s/montserrat/v6/zhcz-_WihjSQC0oHJ9TCYBsxEYwM7FgeyaSgU71cLG0.woff) format('woff');
}

@font-face {
  font-family: 'Lato';
  font-style: normal;
  font-weight: 400;
  src: local('Lato Regular'), local('Lato-Regular'), url(http://fonts.gstatic.com/s/lato/v11/1YwB1sO8YE1Lyjf12WNiUA.woff2) format('woff2'), url(http://fonts.gstatic.com/s/lato/v11/9k-RPmcnxYEPm8CNFsH2gg.woff) format('woff');
}
@font-face {
  font-family: 'Lato';
  font-style: normal;
  font-weight: 700;
  src: local('Lato Bold'), local('Lato-Bold'), url(http://fonts.gstatic.com/s/lato/v11/H2DMvhDLycM56KNuAtbJYA.woff2) format('woff2'), url(http://fonts.gstatic.com/s/lato/v11/wkfQbvfT_02e2IWO3yYueQ.woff) format('woff');
}
@font-face {
  font-family: 'Lato';
  font-style: italic;
  font-weight: 400;
  src: local('Lato Italic'), local('Lato-Italic'), url(http://fonts.gstatic.com/s/lato/v11/PLygLKRVCQnA5fhu3qk5fQ.woff2) format('woff2'), url(http://fonts.gstatic.com/s/lato/v11/oUan5VrEkpzIazlUe5ieaA.woff) format('woff');
}

* {
  -webkit-transition: all 0.4s ease-in-out;
-moz-transition: all 0.4s ease-in-out;
-ms-transition: all 0.4s ease-in-out;
-o-transition: all 0.4s ease-in-out;
transition: all 0.4s ease-in-out;
}

b, strong {
    color: #666;
    font-size: 18px;
    font-weight: 700;
}


.wrap {
    background-color: #fff;
    border-radius: 3px;
    box-shadow: 0 2px 1px 0 rgba(0, 0, 0, 0.1);
    font-family: Lato;
    margin: 4% auto;
    overflow: hidden;
    padding: 40px 6%;
    width: 80%;
}

.wrap p{
  font-size: 19px;
  color:#777;
}

.wrap h1 {
    background: #ffba00 none repeat scroll 0 0;
    color: #fff;
    font-family: 'Montserrat',sans-serif;
    font-size: 42px;
    font-weight: 400;
    margin: -40px -8% 40px;
    padding: 40px;
    text-align: center;
    text-shadow: 1px 1px 0 rgba(0, 0, 0, 0.1);
}

.wrap h3 {
    color: #666;
    font-size: 20px;
    text-align: left;
}


.wrap #hed3 {
    background-color: #0074a2;
    height: auto;
    margin: 40px -8%;
    padding: 10px;
    text-align: center;
    text-shadow: 1px 1px 0 rgba(0, 0, 0, 0.1);
}


#hed3 h3 {
    color: #fff;
    font-family: Montserrat,sans-serif;
    font-size: 32px;
    font-weight: 400;
    text-align: center;
}

 .wrap th
 {
  color :#666;
  font-size: 1.2em;
  padding-left: 15px;

 }


 .wrap td
 {
  padding-left: 40px;
 }
.wrap h3 a ,p a
{
  text-decoration: none;
}
.wrap td p
{
  color:#666;
  font-size:1.2em;
}
.wrap p.submit
{
  text-align: center;
}
.wrap input[type=checkbox] {
  /* All browsers except webkit*/
  transform: scale(1.2);

  /* Webkit browsers*/
  -webkit-transform: scale(1.2);
}


.wrap input[type=number]{
  width:50px;
}
.wrap input[type=range]::-webkit-slider-thumb {
  -webkit-appearance: none;
  background-color: #ecf0f1;
  border: 1px solid #bdc3c7;
  width: 25px;
  height: 25px;
  border-radius: 10px;
  cursor: pointer;
}


.wrap input[type=range]::-moz-range-track {
    border-radius: 8px;
    height: 5px;
    border: 1px solid #bdc3c7;
    background-color: #fff;
}
.wrap input[type=range]::-moz-range-thumb {
    background: #0074A2;
    border: 1px solid #bdc3c7;
    width: 20px;
    height: 20px;
    border-radius: 15px;
    cursor: pointer;
}

.wrap input[type=number] {-moz-appearance: textfield;}
.wrap input[type=number]::-webkit-inner-spin-button { -webkit-appearance: none;}
.wrap input[type=number]::-webkit-outer-spin-button { -webkit-appearance: none;}

.wrap input.button-primary
.wrap input.button-primary {
    border-radius: 4px;
    height: 4em;
    width: 25%;
}


.wp-core-ui .button-primary {
    background: #00a0d2 none repeat scroll 0 0 !important;
    border: medium none !important;
    box-shadow: 0 2px 1px 0 rgba(0, 0, 0, 0.1) !important;
    color: #fff !important;
    font-family: "Montserrat",sans-serif !important;
    font-size: 18px !important;
    height: 4rem;
    text-decoration: none !important;
    text-transform: uppercase !important;
    width: 25% !important;
}

.wp-core-ui .button-primary.focus, .wp-core-ui .button-primary.hover, .wp-core-ui .button-primary:focus, .wp-core-ui .button-primary:hover {
  background:#ffba00 !important;
}

input[type="text"] {
  padding: 4px;
  border: solid 1px #dcdcdc;
  transition: box-shadow 0.3s, border 0.3s;
}
 input[type="text"]:focus,
 input[type="text"].focus {
  border: solid 1px #707070;
  box-shadow: 0 0 5px 1px #969696;
}




 </style>

<div class='wrap'> 
    
    <h1><?php _e('Login Page Styler')?></h1>
    <h3><strong><ul><li><?php _e('In free version you can use 24 features. ')?> </li> 
    <li> <?php _e('In  <a href=http://web-settler.com/login-page-styler/> Premium Version</a> you can use 42 features ')?></li>
    </ul></strong></h3></br>
    <?php _e('<a href="http://web-settler.com/login-page-styler/" target="_blank" class="button_pro">Go Premium</a>')?>
    <?php _e('<a href="https://wordpress.org/plugins/scrollbar-designer//" target="_blank" class="button_pro">Try Scrollbar Designer</a>')?>

    
     <h3><strong><?php _e('If you want us to Style your login page contact us : ziaimtiaz21@gmail.com'); ?></strong></h3>
       <?php settings_errors(); ?>
       <form method="post" action="options.php" >
           <?php settings_fields('lps-settings-group');?>
           <div id="headings-data">

           	<div id="hed3"><h3><?php _e('Login Settings') ?></h3></div>

           <table class="form-table">


        <p>Change enable switch to Yes, then plugin will take effect on your login page </p>
		    <tr valign='top'>
        <th scope='row'><?php _e('Enable Plugin :');?></th>
        <td>
            <div class="onoffswitch">
                     <input type="checkbox" name="lps_login_on_off" class="onoffswitch-checkbox"  id="myonoffswitch" value='1'<?php checked(1, get_option('lps_login_on_off')); ?> />
                     <label class="onoffswitch-label" for="myonoffswitch">
                     <span class="onoffswitch-inner"></span>
                     <span class="onoffswitch-switch"></span>
                     </label>
                    </div>


        </td>
      </tr>
        
      
      <tr valign='top'>
        <th scope='row'><?php _e('Hide Login Logo');?></th>
        <td>
            <div class="onoffswitch">
                     <input type="checkbox" name="lps_login_logo_hide" class="onoffswitch-checkbox"  id="myonoffswitch2" value='1'<?php checked(1, get_option('lps_login_logo_hide')); ?> />
                     <label class="onoffswitch-label" for="myonoffswitch2">
                     <span class="onoffswitch-inner"></span>
                     <span class="onoffswitch-switch"></span>
                     </label>
                    </div>


        </td>
      </tr>


      <tr valign='top'>
        <th scope='row'><?php _e('Hide Login Error Msg');?></th>
        <td>
            <div class="onoffswitch">
                     <input type="checkbox" name="lps_login_logo_msg_hide" class="onoffswitch-checkbox"  id="myonoffswitch3" value='1'<?php checked(1, get_option('lps_login_logo_msg_hide')); ?> />
                     <label class="onoffswitch-label" for="myonoffswitch3">
                     <span class="onoffswitch-inner"></span>
                     <span class="onoffswitch-switch"></span>
                     </label>
                    </div>


        </td>
      </tr>



      <tr valign='top'>
        <th scope='row'><?php _e('Hide Lost Password Link');?></th>
        <td>
            <div class="onoffswitch">
                     <input type="checkbox" name="lps_login_nav_link_hide" class="onoffswitch-checkbox"  id="myonoffswitch4" value='1'<?php checked(1, get_option('lps_login_nav_link_hide')); ?> />
                     <label class="onoffswitch-label" for="myonoffswitch4">
                     <span class="onoffswitch-inner"></span>
                     <span class="onoffswitch-switch"></span>
                     </label>
                    </div>

        </td>
      </tr>


      <tr valign='top'>
        <th scope='row'><?php _e('Hide Back to Blog Link');?></th>
        <td>
            <div class="onoffswitch">
                     <input type="checkbox" name="lps_login_blog_link_hide" class="onoffswitch-checkbox"  id="myonoffswitch5" value='1'<?php checked(1, get_option('lps_login_blog_link_hide')); ?> />
                     <label class="onoffswitch-label" for="myonoffswitch5">
                     <span class="onoffswitch-inner"></span>
                     <span class="onoffswitch-switch"></span>
                     </label>
                    </div>
        </td>
      </tr>

            
             </table>
		    </div>


<div id="headings-data">
           <div id="hed3"><h3><?php _e('Logo Settings') ?></h3></div>
           <table class="form-table">

			<tr valign="top">
			  <th scope="row"><?php _e('Logo Link'); ?></th>
			  <td><label for="lps_login_logo_link">
				  <input type="text" id="lps_login_logo_link"  name="lps_login_logo_link" size="40" value="<?php echo get_option( 'lps_login_logo_link' ); ?>"/>
				  <p class="description"><?php _e( 'Enter site url eg: www.google.com ,It will redirect user when logo is clicked'); ?></p>
				  </label>
			 </td>
		    </tr>


		    <tr valign="top">
			  <th scope="row"><?php _e('Logo Title'); ?></th>
			  <td><label for="lps_login_logo_tittle">
				  <input type="text" id="lps_login_logo_tittle"  name="lps_login_logo_tittle" value="<?php echo get_option( 'lps_login_logo_tittle' ); ?>" />
				  <p class="description"><?php _e( 'Enter Tittle for logo eg:Powered by abcd. '); ?></p>
				  </label>
			 </td>
		    </tr>


		    <tr valign="top">
			  <th scope="row"><?php _e('Logo Image'); ?></th>
			  <td><label for="lps_login_logo">
				  <input id="image_location" type="text" name="lps_login_logo" value="<?php echo get_option('lps_login_logo') ?>" size="50" />
                    <input class="onetarek-upload-button button" type="button" value="Upload Image" />
					<p class='description'><?php _e('Upload or Select Logo Image,Use 80px X 80px logo,<br>To Use bigger logo <b> <a href="http://web-settler.com/login-page-styler/">Buy Premium Version</a> </b> ') ;?></p>
				 </lable>
			 </td>
		    </tr>


		    <tr valign="top">
			  <th scope="row"><?php _e('Logo Width'); ?></th>
			  <td><label for="lps_login_logo_width">
				  <input type='range'  id='lps_login_logo_width' name='lps_login_logo_width' min='0' disabled max='350' value='<?php echo get_option('lps_login_logo_width') ?>' oninput="this.form.amountInputW.value=this.value" /> <input type="number"  name="amountInputW" min="0" max="350" value='<?php echo get_option('lps_login_logo_width') ?>' size='4' oninput="this.form.lps_login_logo_width.value=this.value" disabled/>
				  <p class="description"><?php _e( 'Slide to select  logo width. <b>Premium Version <a href="http://web-settler.com/login-page-styler/">Unlock Here</a> </b>'); ?></p>
				 </lable>
			 </td>
		    </tr>


		    <tr valign="top">
			  <th scope="row"><?php _e('Logo Height'); ?></th>
			  <td><label for="lps_login_logo_height">
				  <input type='range'  id='lps_login_logo_height' name='lps_login_logo_height' min='0' disabled max='200' value='<?php echo get_option('lps_login_logo_height') ?>' oninput="this.form.amountInputH.value=this.value" /> <input type="number"  name="amountInputH" min="0" max="200" value='<?php echo get_option('lps_login_logo_height') ?>' size='4' oninput="this.form.lps_login_logo_height.value=this.value" disabled />
				  <p class="description"><?php _e( 'Slide to select  logo height .<b>Premium Version <a href="http://web-settler.com/login-page-styler/">Unlock Here</a> </b>'); ?></p>
				 </lable>
			 </td>
		    </tr>

</table></div>

<div id="headings-data">

           <div id="hed3"><h3><?php _e('Login Background Settings') ?></h3></div>
           <table class="form-table">


		    <tr valign="top">
			  <th scope="row"><?php _e( 'Background Color' ); ?></th>
			  <td><label for="lps_login_background_color">
				  <input type="text" class="color_picker" id="lps_login_background_color"  name="lps_login_background_color" value="<?php echo get_option( 'lps_login_background_color' ); ?>" />
				  <p class="description"><?php _e( 'Change background color'); ?></p>
				  </label>
			 </td>
		    </tr>


		    <tr valign="top">
			  <th scope="row"><?php _e('Login Background Image'); ?></th>
			  <td><label for="lps_body_bg_img">
					<input id="image_location" type="text" name="lps_body_bg_img" value="<?php echo get_option('lps_body_bg_img') ?>" size="50" disabled/>
                    <input  class="onetarek-upload-button button" type="button" value="Upload Image" disabled />
					<p class='description'><?php _e('Upload or Select  Background Image,<b>Premium Version <a href="http://web-settler.com/login-page-styler/">Unlock Here</a></b>') ;?></p>
				</label>
				</td>
		    </tr>


            <tr valign="top">
			  <th scope="row"><?php _e('Login Body Background Image Repeat'); ?></th>
			  <td><label for="lps_body_bg_repeat">
				  <select name='lps_login_bg_repeat'>
					     <option value='no-repeat' <?php selected( get_option('lps_login_bg_repeat'),'no-repeat'); ?> >No Repeat</option>
                         <option value='repeat-x' <?php selected( get_option('lps_login_bg_repeat'),'repeat-x'); ?> >Repeat X</option>
                         <option value='repeat-y' <?php selected( get_option('lps_login_bg_repeat'),'repeat-y'); ?> >Repeat Y</option>
				  </select>
				  <p class="description"><?php _e('Background image repeat');?></p>
		          </label>
			 </td>
		    </tr>
<table></div>


<div id="headings-data">

	        <div id="hed3"><h3><?php _e('Form Settings') ?></h3></div>

           <table class="form-table">


		    <tr valign='top'>
				<th scope='row'><?php _e('Change Login Form Position');?></th>
				<td><label for='lps_login_form_position'>
				<select name="lps_login_form_position">
					<option value='1' <?php selected( get_option('lps_login_form_position'),'1'); ?> >Middle-Center</option> 
					<option disabled value='2' <?php selected( get_option('lps_login_form_position'),'2' ); ?> >Middle-Left</option>
					<option disabled value='3' <?php selected( get_option('lps_login_form_position'),'3' ); ?> >Middle-Right</option>
					<option value='4' <?php selected( get_option('lps_login_form_position'),'4' ); ?> >Top-Center</option>
					<option disabled value='5' <?php selected( get_option('lps_login_form_position'),'5' ); ?> >Top-Left</option>
					<option disabled value='6' <?php selected( get_option('lps_login_form_position'),'6' ); ?> >Top-Right</option>
					<option value='7' <?php selected( get_option('lps_login_form_position'),'7' ); ?> >Bottom-Center</option>
					<option disabled value='8' <?php selected( get_option('lps_login_form_position'),'8' ); ?> >Bottom-Left</option>
					<option disabled value='9' <?php selected( get_option('lps_login_form_position'),'9' ); ?> >Bottom-Right</option>

				</select>
				<p class="description"> <?php _e('Select option to change Login Form Position'); ?></p>						
				<p class="description"> <?php _e('While using bottom positioning, Hide error msg  on top of this plugin'); ?></p>
				<p class="description"> <?php _e('Unlock rest of form positions with <b>Premium Version <a href="http://web-settler.com/login-page-styler/">Unlock Here</a></b>'); ?></p>
				</label>
				</td>
			</tr>

            
            <tr valign="top">
			  <th scope="row"><?php _e('Login Form Background Image'); ?></th>
			  <td><label for="lps_login_form_bg">
					<input id="image_location" type="text" name="lps_login_form_bg" value="<?php echo get_option('lps_login_form_bg'); ?>" size="50" disabled />
                    <input  class="onetarek-upload-button button" type="button" value="Upload Image" disabled />
					<p class='description'><?php _e('Upload or Select Form Background Image <br><b>Premium Version <a href="http://web-settler.com/login-page-styler/">Unlock Here</a></b>') ;?></p>
				</label>
				</td>
		    </tr>

			
			<tr>
				<th scope='row'><?php _e('Login Form Color');?></th>
				<td><label for='lps_login_form_color'>
					<input type='text' class='color_picker' id='lps_login_form_color' name='lps_login_form_color' value='<?php echo get_option('lps_login_form_color' ); ; ?>'/>
					<p class='description'><?php _e('Change Form color') ;?></p>
				</label>
				</td>
			</tr>


			<tr>
				<th scope='row'><?php _e('Login Form Color with Opacity');?></th>
				<td><label for='lps_login_form_color_opacity'>
					<input type='text' id='lps_login_form_color_opacity' name='' value='<?php echo get_option('lps_login_form_color_opacity' ); ; ?>' disabled />
					<p class='description'> <?php _e( 'Add RGBA color value eg: 255 , 255 , 255 ,0.5 last value in decimal is the Opacity .<b>Premium Version <a href="http://web-settler.com/login-page-styler/">Unlock Here</a> </b>'); ?></p>
				</label>
				</td>
			</tr>


			<tr valign='top'>
				<th scope='row'><?php _e('Label Color');?></th>
				<td><label for='lps_login_label_color'>
					<input type='text' class='color_picker' id='lps_login_label_color' name='lps_login_label_color' value='<?php echo get_option('lps_login_label_color'); ?>' /> 
					<p class='description'> <?php _e( 'Change form label(Username /Password) color'); ?></p>
				    </label>
			    </td>
			</tr>

			<tr valign='top'>
				<th scope='row'><?php _e('Login Form Label Size');?></th>
				<td><label for='lps_login_label_size'>
					<input type='range'  id='lps_login_label_size' name='lps_login_label_size' min='14' max='30' value='<?php echo get_option('lps_login_label_size') ?>' oninput="this.form.amountInput.value=this.value" /> <input type="number"  name="amountInput" min="0" max="25" value='<?php echo get_option('lps_login_label_size') ?>' size='4' oninput="this.form.lps_login_label_size.value=this.value" />
					<p class='description'> <?php _e( 'Change form label size '); ?></p>
				    </label>
			    </td>
			</tr>


			<tr valign="top">
			  <th scope="row"><?php _e('Login Form Label Fonts'); ?></th>
			  <td>
			  	<label for="lps_login_form_label_font">
				  <select name='lps_login_form_label_font'>
					     <option value='Arial'           <?php selected( get_option('lps_login_form_label_font'),'Arial'); ?>   >      Arial</option>
					     <option disabled value='Bedrock'         <?php selected( get_option('lps_login_form_label_font'),'Bedrock'); ?> >      Bedrock</option>
                         <option disabled value='Comic Sans MS'   <?php selected( get_option('lps_login_form_label_font'),'Comic Sans MS'); ?>>Comic Sans MS</option>
                         <option disabled value='Courier New'     <?php selected( get_option('lps_login_form_label_font'),'Courier New'); ?> >  Courier New</option>
                         <option disabled value='Georgia'         <?php selected( get_option('lps_login_form_label_font'),'Georgia'); ?> >      Georgia</option>
                         <option disabled value='Trebuchet MS'    <?php selected( get_option('lps_login_form_label_font'),'Trebuchet MS'); ?> > Trebuchet MS</option>
                         <option disabled value='Verdana'         <?php selected( get_option('lps_login_form_label_font'),'Verdana'); ?> >      Verdana</option>
                         <option disabled value='Times New Roman' <?php selected( get_option('lps_login_form_label_font'),'Times New Roman');?>>Times New Roman</option>
                         <option disabled value='Lucida Console'  <?php selected( get_option('lps_login_form_label_font'),'Lucida Console'); ?>>Lucida</option>
                         <option value='WildWest'        <?php selected( get_option('lps_login_form_label_font'),'WildWest'); ?> >     WildWest</option>
                         <option value='Arial'           <?php selected( get_option('lps_login_form_label_font'),'Arial'); ?> >     Arial</option>

				  </select>
				  <p class="description"><?php _e('Select login form label(Username,password) font-family ,  ');?></p>
		          </label>
			 </td>
		    </tr>


			<tr valign='top'>
				<th scope='row'><?php _e('Login Form  Remember Me Label Size');?></th>
				<td><label for='lps_login_remember_label_size'>
					<input type='range'  id='lps_login_remember_label_size' name='lps_login_remember_label_size' disabled min='12' max='25' value='<?php echo get_option('lps_login_remember_label_size') ?>' oninput="this.form.amountInput2.value=this.value" /> <input type="number"  name="amountInput2" min="12" max="25" value='<?php echo get_option('lps_login_remember_label_size') ?>' disabled size='4' oninput="this.form.lps_login_remember_label_size.value=this.value" /> 
					<p class='description'> <?php _e( 'Slide to change login form remember me label size .<b>Premium Version <a href="http://web-settler.com/login-page-styler/">Unlock Here</a></b>'); ?></p>
				    </label>
			    </td>
			</tr>


			<tr valign="top">
			  <th scope="row"><?php _e('Login Form Border Style'); ?></th>
			  <td>
			  	<label for="lps_login_form_border_size">
			  	  <input type='range'  id='lps_login_form_border_size' name='lps_login_form_border_size' min='0' max='10' value='<?php echo get_option('lps_login_form_border_size') ?>' oninput="this.form.amountInput3.value=this.value"  /> <input type="number"  name="amountInput3" min="0" max="10" value='<?php echo get_option('lps_login_form_border_size') ?>' size='4' oninput="this.form.lps_login_form_border_size.value=this.value" /> 	
			  	  <p class="description"><?php _e('Slide to change border width');?></p>
			  	</label>

			  	<label for="lps_login_form_border_style">
				  <select name='lps_login_form_border_style'>
					     <option value='none'   <?php selected( get_option('lps_login_form_border_style'),'none'); ?>   >None</option>
                         <option disabled value='solid'  <?php selected( get_option('lps_login_form_border_style'),'solid'); ?>  >Solid</option>
                         <option value='dashed' <?php selected( get_option('lps_login_form_border_style'),'dashed'); ?> >Dashed</option>
                         <option disabled value='dotted' <?php selected( get_option('lps_login_form_border_style'),'dotted'); ?> >Dotted</option>
                         <option disabled value='double' <?php selected( get_option('lps_login_form_border_style'),'double'); ?> >Double</option>
				  </select>
				  <p class="description"><?php _e('Select login form border style, <b>Premium Version <a href="http://web-settler.com/login-page-styler/">Unlock Here</a> </b>');?></p>
		          </label>
			 </td>
		    </tr>


		    <tr valign='top'>
				<th scope='row'><?php _e('Login Form Border Color');?></th>
				<td><label for='lps_login_form_border_color'>
					<input type='color' class='' disabled id='lps_login_form_border_color' name='lps_login_form_border_color' value='<?php echo get_option('lps_login_form_border_color' ); ; ?>' />
					<p class="description"><?php _e('Change login form  border color . <b>Premium Version <a href="http://web-settler.com/login-page-styler/">Unlock Here</a> </b>'); ?></p>
				</label>
				</td>
			</tr>



			<tr valign='top'>
				<th scope='row'><?php _e('Login Form Border Radius');?></th>
				<td><label for='lps_login_form_border_radius'>
					 <input type='range'  id='lps_login_form_border_radius' name='lps_login_form_border_radius' min='0' max='10' value='<?php echo get_option('lps_login_form_border_radius') ?>' oninput="this.form.amountInput4.value=this.value"  /> <input type="number"  name="amountInput4" min="0" max="10" value='<?php echo get_option('lps_login_form_border_radius') ?>' size='4' oninput="this.form.lps_login_form_border_size.value=this.value" />
					<p class="description"><?php _e('Slide to select Login form border radius'); ?></p>
				</label>
				</td>
			</tr>


			<tr valign="top">
			  <th scope="row"><?php _e('Login Form Input Field Border Style'); ?></th>
			  <td>
			  	<label for="lps_login_form_input_border_size">
			  	  <input type='range'  id='lps_login_form_input_border_size' name='lps_login_form_input_border_size' min='0' max='10' value='<?php echo get_option('lps_login_form_input_border_size') ?>' oninput="this.form.amountInput5.value=this.value"  /> <input type="number"  name="amountInput5" min="0" max="10" value='<?php echo get_option('lps_login_form_input_border_size') ?>' size='4' oninput="this.form.lps_login_form_border_size.value=this.value" />	
			  	  <p class="description"><?php _e('Slide to select Login form input-field border width');?></p>
			  	</label>

			  	<label for="lps_login_form_input_border_style">
				  <select name='lps_login_form_input_border_style'>
					     <option value='none'   <?php selected( get_option('lps_login_form_input_border_style'),'none'); ?>   >None</option>
                         <option disabled value='solid'  <?php selected( get_option('lps_login_form_input_border_style'),'solid'); ?>  >Solid</option>
                         <option disabled value='dashed' <?php selected( get_option('lps_login_form_input_border_style'),'dashed'); ?> >Dashed</option>
                         <option value='dotted' <?php selected( get_option('lps_login_form_input_border_style'),'dotted'); ?> >Dotted</option>
                         <option disabled value='double' <?php selected( get_option('lps_login_form_input_border_style'),'double'); ?> >Double</option>
				  </select>
				  <p class="description"><?php _e('Select login form input field border style, <b>Premium Version <a href="http://web-settler.com/login-page-styler/">Unlock Here</a> </b>');?></p>
		          </label>
			 </td>
		    </tr>


		    <tr valign='top'>
				<th scope='row'><?php _e('Login Form Input Field Border Color');?></th>
				<td><label for='lps_login_form_input_feild_border_color'>
					<input disabled type='color' class='' id='lps_login_form_input_feild_border_color' name='lps_login_form_input_feild_border_color' value='<?php echo get_option('lps_login_form_input_feild_border_color' ); ; ?>' disabled />
					<p class="description"><?php _e('Change login form input field border color . <b>Premium Version <a href="http://web-settler.com/login-page-styler/">Unlock Here</a> </b>'); ?></p>
				</label>
				</td>
			</tr>



			<tr valign='top'>
				<th scope='row'><?php _e('Login Form Input Field Border Radius');?></th>
				<td><label for='lps_login_form_input_feild_border_radius'>
					<input type='range'  id='lps_login_form_input_feild_border_radius' name='lps_login_form_input_feild_border_radius' min='0' max='10' value='<?php echo get_option('lps_login_form_input_feild_border_radius') ?>' oninput="this.form.amountInput7.value=this.value"  /> <input type="number"  name="amountInput7" min="0" max="10" value='<?php echo get_option('lps_login_form_input_feild_border_radius') ?>' size='4' oninput="this.form.lps_login_form_input_feild_border_radius.value=this.value" />
					<p class="description"><?php _e( 'Slide to select Login form input-field border radius . <b>Premium Version <a href="http://web-settler.com/login-page-styler/">Unlock Here</a> </b> '); ?></p>
				</label>
				</td>
			</tr>


			<tr>
				<th scope='row'><?php _e('Login Form Input Field Color with Opacity');?></th>
				<td><label for='lps_login_form_input_color_opacity'>
					<input type='text' id='lps_login_form_input_color_opacity' name='lps_login_form_input_color_opacity' value='<?php echo get_option('lps_login_form_input_color_opacity' ); ; ?>'/>
					<p class='description'> <?php _e( 'Add RGBA color value eg: 255 , 255 , 255 ,0.5 last value in decimal is the Opacity . ')?></p>
				</label>
				</td>
			</tr>


</table></div>

<div id="headings-data">

	        <div id="hed3"><h3><?php _e('Button Settings') ?></h3></div>
            <table class="form-table">

			<tr valign='top'>
				<th scope='row'><?php _e('Login Button Border Radius');?></th>
				<td><label for='lps_login_button_border_radius'>
					<input type='range'  id='lps_login_button_border_radius' name='lps_login_button_border_radius' min='0' max='10' value='<?php echo get_option('lps_login_button_border_radius') ?>' oninput="this.form.amountInput6.value=this.value"  /> <input type="number"  name="amountInput6" min="0" max="10" value='<?php echo get_option('lps_login_button_border_radius') ?>' size='4' oninput="this.form.lps_login_button_border_radius.value=this.value" />
					<p class="description"><?php _e('Add login button border radius..'); ?></p>
				</label>
				</td>
			</tr>


  
            <tr valign='top'>
				<th scope='row'><?php _e('Login Button Color');?></th>
				<td><label for='lps_login_button_color'>
					<input type='text' class='color_picker' id='lps_login_button_color' name='lps_login_button_color' value='<?php echo get_option('lps_login_button_color'); ?>' /> 
					<p class='description'> <?php _e( 'Change login button color'); ?></p></br>
					<p class='description'><?php _e('Login Button Border Color');?></p><input type='text' class='color_picker' id='lps_login_button_border_color' name='lps_login_button_border_color' value='<?php echo get_option('lps_login_button_border_color'); ?>' /></br></br>
					<p class='description'><?php _e('Login Button Text Color');?></p><input type='text' class='color_picker' id='lps_login_button_text_color' name='lps_login_button_text_color' value='<?php echo get_option('lps_login_button_text_color'); ?>' />
				    </label>
			    </td>
			</tr>


			<tr valign='top'>
				<th scope='row'><?php _e('Login Button Color Hover');?></th>
				<td><label for='lps_login_button_color_hover'>
					<input type='color' class='' id='lps_login_button_color_hover' name='lps_login_button_color_hover' value='<?php echo get_option('lps_login_button_color_hover'); ?>' disabled/> 
					<p class='description'> <?php _e( 'Change login button color hover,<b>Premium Version <a href="http://web-settler.com/login-page-styler/">Unlock Here</a></b>'); ?></p></br>
					<p class='description'><?php _e('Login Button Border Color Hover. <b>Premium Version <a href="http://web-settler.com/login-page-styler/">Unlock Here</a></b>');?></p><input type='color' class='' id='lps_login_button_border_color_hover' name='lps_login_button_border_color_hover' value='<?php echo get_option('lps_login_button_border_color_hover'); ?>' disabled /></br></br>
					<p class='description'><?php _e('Login Button Text Color Hover. <b>Premium Version <a href="http://web-settler.com/login-page-styler/">Unlock Here</a></b>');?></p><input type='color' class='' id='lps_login_button_text_color_hover' name='lps_login_button_text_color_hover' value='<?php echo get_option('lps_login_button_text_color_hover'); ?>' disabled />
				    </label>
			    </td>
			</tr>

</table></div>

<div id="headings-data">

	        <div id="hed3"><h3><?php _e('Lost password and Back to blog ') ?></h3></div>
            <table class="form-table">


            <tr valign='top'>
				<th scope='row'><?php _e('Navigation Link Size');?></th>
				<td><label for='lps_login_nav_size'>
					<input type='range'  id='lps_login_nav_size' name='lps_login_nav_size' min='13' max='20' value='<?php echo get_option('lps_login_nav_size') ?>' oninput="this.form.amountInput8.value=this.value"  /> <input type="number"  name="amountInput8" min="13" max="20" value='<?php echo get_option('lps_login_nav_size') ?>' size='4' oninput="this.form.lps_login_nav_size.value=this.value" />
					<p class="description"><?php _e( 'Slide to select Navigation Link Size .'); ?></p>
				</label>
				</td>
			</tr>	


			<tr vlaign='top'>
				<th scope='row'><?php _e('Navigation Links Color');?></th>
				<td><label for='lps_login_nav_color'>
					<input type='text' class='color_picker' id='lps_login_nav_color' name='lps_login_nav_color' value='<?php echo get_option('lps_login_nav_color' ); ; ?>'/>
					<p class="description"><?php _e('Change navigation link color'); ?></p>
				</label>
				</td>
			</tr>

			
			<tr valign='top'>
				<th scope='row'><?php _e('Navigation Hover Links Color');?></th>
				<td><label for='lps_login_nav_hover_color'>
					<input type='color' class='' id='lps_login_nav_hover_color' name='lps_login_nav_hover_color' value='<?php echo get_option('lps_login_nav_hover_color' ); ; ?>' disabled />
					<p class="description"><?php _e('Change navigiation link hover color <b>Premium Version <a href="http://web-settler.com/login-page-styler/">Unlock Here</a></b>'); ?></p>
				</label>
				</td>
			</tr>


</table></div>
<div id="headings-data">

	        <div id="hed3"><h3><?php _e('Custom CSS') ?></h3></div>
            <table class="form-table">

            <tr valign="top">
				<th scope="row"><?php _e( 'Custom Css') ?></th>
				<td><label for="lps_login_custom_css">
					<textarea cols="80" rows="7" id="lps_login_custom_css"  name="lps_login_custom_css"  ><?php echo get_option( 'lps_login_custom_css' ); ?> </textarea>
					<p class='description'> <?php _e('Add styling inside this text area.' );?></p>
					</label>
				</td>
			</tr>



           </table></div>

           <h3><strong><?php _e('To use full features of this plugin use <a href=http://web-settler.com/login-page-styler/>Login Page Styler Premium</a>'); ?></strong></h3>
            <h3><strong><?php _e('Try my other plugin ,Click Here :<a href="https://wordpress.org/plugins/scrollbar-designer/" target="_blank">Scrollbar Designer</a>')?> </strong></h3></br>
           <p class="submit">
			<input type="submit" class="button-primary" value="<?php _e( 'Save Changes' ); ?>" />
		</p>

       </form>    

</div>


<?php }; ?>
