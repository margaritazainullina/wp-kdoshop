<?php
/**
* @package   CBX_Flexible_CountDown
* @author    WPBoxr <info@wpboxr.com>
* @license   GPL-2.0+
* @link      http://wpboxr.com/
* @copyright 2015 WPBoxr
*/
?>
<?php //echo $title; ?>

<?php

    $args['type']   = $instance['cbfc_countdown_style'];
    $args['date']   = $instance['cbfc_date'];
    $args['hour']   = $instance['cbfc_hour'];
    $args['minute'] = $instance['cbfc_min'];
	$args           = apply_filters('cbxflexiblecountdownwidgetwidget', $args, $instance);

	/*echo '<pre>';
	print_r($args);
	echo '</pre>';*/


    echo cbfc_flexible_countdown($args);
?>