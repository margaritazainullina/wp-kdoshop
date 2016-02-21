<?php
/**
 * The Footer template.
 */
$multishop_options = get_option('multishop_theme_options');
?>

<div class="clearfix"></div>
<footer>
	 <?php if (is_active_sidebar('footer-1') || is_active_sidebar('footer-2') || is_active_sidebar('footer-3') || is_active_sidebar('footer-4')) { ?>
    <div class="container multishop-container multishop-footer">
        <div class="row">
            <div class="col-md-4 col-sm-6 footer-box">
                <?php if (is_active_sidebar('footer-1')) {
                    dynamic_sidebar('footer-1');
                } ?>
            </div>
            <div class="col-md-4 col-sm-6 footer-box">
                <?php if (is_active_sidebar('footer-2')) {
                    dynamic_sidebar('footer-2');
                } ?>
            </div>
            <div class="col-md-4 col-sm-6 footer-box">
					<?php if (is_active_sidebar('footer-3')) {
						dynamic_sidebar('footer-3');
					} ?>
            </div>
            <div class="col-md-4 col-sm-6 footer-box">
                <?php if (is_active_sidebar('footer-4')) {
                    dynamic_sidebar('footer-4');
                } ?>
            </div>
        </div>
    </div>
    <?php } ?>
    <div class="footer-bottom">
        <div class="container multishop-container">
            <div class="col-md-6 foot-copy-right no-padding-lr">
<?php
if (!empty($multishop_options['footertext'])) {
    echo esc_attr($multishop_options['footertext']); 
} else {
    printf( __( 'Powered by %1$s and %2$s', 'multishop' ), '<a href="http://wordpress.org" target="_blank">WordPress</a>', '<a href="http://fasterthemes.com/wordpress-themes/multishop" target="_blank">Multishop</a>' );
}

?>

            </div>
            <div class="col-md-6  no-padding-lr social-icon">
                <ul>
                            <?php if (!empty($multishop_options['fburl'])) { ?>
                        <li><a href="<?php echo esc_url($multishop_options['fburl']); ?>"><i class="fa fa-facebook-square twitt"></i></a></li>
<?php } ?>
<?php if (!empty($multishop_options['twitter'])) { ?>
                        <li><a href="<?php echo esc_url($multishop_options['twitter']); ?>"><i class="fa fa-twitter-square linkin"></i></a></li>
<?php } ?>
<?php if (!empty($multishop_options['googleplus'])) { ?>
                        <li><a href="<?php echo esc_url($multishop_options['googleplus']); ?>"><i class="fa fa-google-plus-square"></i></a></li>
<?php } ?>
                </ul>
            </div>
        </div>
    </div>
</footer>
<?php wp_footer(); ?>
</body></html>
