<?php
/*
Plugin Name: SMTP
Version: 1.1.2
Plugin URI: http://hel.io/wordpress/smtp/
Description: Allows you to configure and use a SMTP server (such as Gmail) for sending emails.
Author: Sorin Iclanzan
Author URI: http://hel.io/
Text Domain: smtp
Domain Path: /language
*/

// Key used for encrypting and decrypting passwords
define( 'CRYPT_KEY', '-J5:2Yqd?Ri9wLjN' );
// Text domain
define( 'TEXT_DOMAIN', 'smtp' );
// Plugin basename
$plugin_basename = dirname( plugin_basename( __FILE__ ) );

// Loads the plugin's translated strings.
add_action( 'plugins_loaded', 'smtp_init' );
function smtp_init() {
  global $plugin_basename;
  load_plugin_textdomain( TEXT_DOMAIN, false, $plugin_basename . '/language/' );
}

// This is run when you activate the plugin, adding the default options to the database
register_activation_hook(__FILE__,'smtp_activation');
function smtp_activation() {
  global $plugin_basename;
    // Check for compatibility
    try {
        // check mycrypt
        if(!function_exists('mcrypt_encrypt')) {
            throw new Exception(__('Please enable \'php_mycrypt\' in PHP. It is needed to encrypt passwords.', TEXT_DOMAIN));
        }
    }
    catch(Exception $e) {
        deactivate_plugins($plugin_basename.'/backup.php', true);
        echo '<div id="message" class="error">' . $e->getMessage() . '</div>';
        trigger_error('Could not activate SMTP.', E_USER_ERROR);
    }
    
    // Default options
    $smtp_options = array (
        'host' => 'http://localhost',
        'port' => '25',
        'smtp_secure' => '',
        'username' => '',
        'password' => ''
    );
    
    // Add options
    add_option('smtp_options',$smtp_options);
    
}

// Add options page in the admin menu
add_action('admin_menu','smtp_menu');
function smtp_menu() {
    add_options_page( __( 'SMTP Settings', TEXT_DOMAIN ), __( 'SMTP', TEXT_DOMAIN ) , 'manage_options', 'smtp', 'smtp_options_page');
}

// Add "Settings" link to the plugins page
add_filter( 'plugin_action_links', 'smtp_action_links',10,2);
function smtp_action_links( $links, $file ) {
    if ( $file != plugin_basename( __FILE__ ))
        return $links;

    $settings_link = sprintf( '<a href="options-general.php?page=smtp">%s</a>', __( 'Settings', TEXT_DOMAIN ) );

    array_unshift( $links, $settings_link );

    return $links;
}

// Display options page
function smtp_options_page() {
    
    // Send test email if requested
    if (isset($_POST['smtp_test']) && $_POST['smtp_test'] == 'Send' && isset($_POST['to']) && is_email($_POST['to'])) {
            
            $to = $_POST['to'];
            $subject = __( 'SMTP Test', TEXT_DOMAIN );
            $message = __( 'If you received this email it means you have configured SMTP correctly on your Wordpress website.', TEXT_DOMAIN );
    
            // Send the test mail
            $result = wp_mail($to, $subject, $message);
            
            // Notify user of the result
            if ($result) {
                ?>
                <div id="message" class="updated fade">
                <p><strong><?php _e( 'Test Email Sent', TEXT_DOMAIN ); ?></strong></p>
                <p><?php _e('The test email was sent successfully!', TEXT_DOMAIN ); ?></p>
                </div>
                <?php
            }
            else {
                ?>
                <div id="message" class="error">
                <p><strong><?php _e('Send Error', TEXT_DOMAIN ); ?></strong></p>
                <p><?php _e('There was an error while trying to send the test email. Please check the connection details.', TEXT_DOMAIN ); ?></p>
                </div>
                <?php
            }    
    }
    
    ?>
    <div class="wrap">
    <h2><?php _e('SMTP Settings', TEXT_DOMAIN ); ?></h2>
        
        <form action="options.php" method="post">
            <?php settings_fields('smtp_options'); ?>
            <?php do_settings_sections('smtp'); ?>
            <p class="submit">
                <input name="submit" type="submit" class="button-primary" value="<?php _e('Save Changes', TEXT_DOMAIN ); ?>" />
            </p>
        </form>
        
        <h3><?php _e('Send a Test Email', TEXT_DOMAIN ); ?></h3>
        <p><?php _e('Enter an email address below to send a test message.', TEXT_DOMAIN ); ?></p>
        <form action="options-general.php?page=smtp" method="post">
            <table class="optiontable form-table">
                <tr valign="top">
                    <th scope="row"><label for="to"><?php _e('To:', TEXT_DOMAIN ); ?></label></th>
                    <td>
                        <input name="to" type="text" id="to" value="" class="regular-text" />
                    </td>
                </tr>
            </table>
            <p class="submit">
                <input type="submit" name="smtp_test" id="smtp_test" class="button-primary" value="<?php _e('Send', TEXT_DOMAIN ); ?>" />
            </p>
        </form>
        
    </div>
    <?php
}

// Register settings, add sections and fields
add_action('admin_init', 'smtp_admin_init');
function smtp_admin_init(){
    register_setting( 'smtp_options', 'smtp_options', 'smtp_options_validate' );
    add_settings_section('smtp_main', __( 'Settings', TEXT_DOMAIN ), 'smtp_section', 'smtp');
    add_settings_field('host', __( 'Host', TEXT_DOMAIN ), 'smtp_host', 'smtp', 'smtp_main');
    add_settings_field('encryption', __( 'Encryption', TEXT_DOMAIN ), 'smtp_encryption', 'smtp', 'smtp_main');
    add_settings_field('username', __( 'Username', TEXT_DOMAIN ), 'smtp_username', 'smtp', 'smtp_main');
    add_settings_field('password', __('Password', TEXT_DOMAIN ), 'smtp_password', 'smtp', 'smtp_main');
}

function smtp_section() {
    echo '<p>' . __( 'Please enter your SMTP connection details.', TEXT_DOMAIN ) . '</p>';
}

function smtp_host() {
    $options = get_option('smtp_options');
    echo "
        <input id='host' name='smtp_options[host]' type='text' class='regular-text' value='{$options['host']}' />
        <label for='port'>" . __( 'Port', TEXT_DOMAIN ) . "</label>
        <input id='port' name='smtp_options[port]' type='text' class='small-text' value='{$options['port']}' />
    ";
}

function smtp_encryption() {
    $options = get_option('smtp_options');
    echo "
        <label><input name='smtp_options[smtp_secure]' type='radio' class='tog' value='' ". checked('', $options['smtp_secure'], false) . " /> <span>" . __( 'None', TEXT_DOMAIN ) . "</span></label><br/>
        <label><input name='smtp_options[smtp_secure]' type='radio' class='tog' value='ssl' " . checked('ssl', $options['smtp_secure'], false) . " /> <span>" . __( 'SSL', TEXT_DOMAIN ) . "</span></label><br/>
        <label><input name='smtp_options[smtp_secure]' type='radio' class='tog' value='tls' " . checked('tls', $options['smtp_secure'], false) . " /> <span>" . __( 'TLS', TEXT_DOMAIN ) . "</span></label>
    ";
}

function smtp_username() {
    $options = get_option('smtp_options');
    echo "<input id='username' name='smtp_options[username]' type='text' class='regular-text' value='{$options['username']}' />";
}
function smtp_password() {
    $options = get_option('smtp_options');
    $placeholder = '';
    if ( $options['password'] )
        $placeholder = '&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;';
    echo "<input id='password' name='smtp_options[password]' type='password' class='regular-text' value='' placeholder='{$placeholder}' />";
}

function smtp_options_validate($input) {
    $smtp_options = get_option('smtp_options');
    
    $input['host'] = stripslashes(wp_filter_kses(addslashes(strip_tags($input['host']))));
    if ($input['host'] == '')
        $input['host'] = $smtp_options['host'];
    
    $input['port'] = absint($input['port']);
    if ($input['port'] == 0 || $input['port'] == 1)
        $input['port'] = $smtp_options['port'];
        
    if ($input['smtp_secure'] != '' && $input['smtp_secure'] != 'ssl' && $input['smtp_secure'] != 'tls')
        $input['smtp_secure'] = $smtp_options['smtp_secure'];
        
    $input['username'] = stripslashes(wp_filter_kses(addslashes(strip_tags($input['username']))));
    if ($input['username'] == '')
        $input['username'] = $smtp_options['username'];
        
    $input['password'] = stripslashes(wp_filter_kses(addslashes(strip_tags($input['password']))));
    if ($input['password'] == '')
        $input['password'] = $smtp_options['password'];
    else
        $input['password'] = encrypt_string( $input['password'], CRYPT_KEY );
    
    return $input;
}

/*
 * Encrypt $string using $key
 */
function encrypt_string( $string, $key ) {
    return base64_encode( mcrypt_encrypt( MCRYPT_RIJNDAEL_256, md5( $key ), $string, MCRYPT_MODE_CBC, md5( md5( $key ) ) ) );
}

/*
 * Decrypt $string using $key
 */
function decrypt_string( $string, $key ) {
    return rtrim( mcrypt_decrypt( MCRYPT_RIJNDAEL_256, md5( $key ), base64_decode( $string ), MCRYPT_MODE_CBC, md5( md5( $key ) ) ), "\0" );
}

// This makes the magic happen
add_action('phpmailer_init','smtp_phpmailer_init');
function smtp_phpmailer_init($phpmailer) {
        
    $smtp_options = get_option('smtp_options');
    $admin_info = get_userdata(1);
    
    // Set Mailer value
    $phpmailer->Mailer = 'smtp';
    
    // Set From value
    $phpmailer->From = $admin_info->user_email;
    
    // Set FromName value
    $phpmailer->FromName = $admin_info->display_name;
    
    // Set SMTPSecure value
    $phpmailer->SMTPSecure = $smtp_options['smtp_secure'];
        
    // Set Host value
    $phpmailer->Host = $smtp_options['host'];
    
    // Set Port value
    $phpmailer->Port = $smtp_options['port'];
        
    // If usrname option is not blank we have to use authentication
    if ($smtp_options['username'] != '') {
        $phpmailer->SMTPAuth = true;
        $phpmailer->Username = $smtp_options['username'];
        $phpmailer->Password = decrypt_string( $smtp_options['password'], CRYPT_KEY );
    }
}
