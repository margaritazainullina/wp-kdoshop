<?php
/**
 * Created by PhpStorm.
 * User: fast user
 * Date: 2/16/2015
 * Time: 6:31 PM
 */


// This file is based on wp-includes/js/tinymce/langs/wp-langs.php

if ( ! defined( 'ABSPATH' ) )
    exit;

if ( ! class_exists( '_WP_Editors' ) )
    require( ABSPATH . WPINC . '/class-wp-editor.php' );

$text_domain = cbfc_get_text_domain();

function cbfc_tinymce_plugin_translation($text_domain) {
    $strings = array(
        'title'                 => __('CBX Countdown Shortcode', $text_domain),
        'type_label'            => __('Countdown Type', $text_domain),
        'type_tooltip'          => __('select countdown type', $text_domain),
        'date_label'            => __('Date', $text_domain),
        'date_tooltip'          => __('date format: mm/dd/yyyy', $text_domain),
        'hour_label'            => __('Hour', $text_domain),
        'hour_tooltip'          => __('max value is 23', $text_domain),
        'minute_label'          => __('Minute', $text_domain),
        'minute_tooltip'        => __('max value is 59', $text_domain),
        'numclr_label'          => __('Number Color', $text_domain),
        'numclr_tooltip'        => __('number color for light countdown', $text_domain),
        'resnumclr_label'       => __('Number Color(On Responsive)', $text_domain),
        'resnumclr_tooltip'     => __('number color for light countdown(On Responsive)', $text_domain),
        'numbgclr_label'        => __('Count Number Background Color', $text_domain),
        'numbgclr_tooltip'      => __('number background color for light countdown', $text_domain),
        'secbclr_label'         => __('Seconds Border Color', $text_domain),
        'secbclr_tooltip'       => __('seconds border for circular countdown', $text_domain),
        'minbclr_label'         => __('Minutes Border Color', $text_domain),
        'minbclr_tooltip'       => __('minutes border for circular countdown', $text_domain),
        'hourbclr_label'        => __('Hours Border Color', $text_domain),
        'hourbclr_tooltip'      => __('hours border for circular countdown', $text_domain),
        'daysbclr_label'        => __('Days Border Color', $text_domain),
        'daysbclr_tooltip'      => __('days border for circular countdown', $text_domain),
        'bgclr_label'           => __('Background Color', $text_domain),
        'bgclr_tooltip'         => __('background color for circular countdown', $text_domain),
        'fontclr_label'         => __('Number And Text Color(Default)', $text_domain),
        'fontclr_tooltip'       => __('number and text color for circular countdown', $text_domain),
        'textclr_label'         => __('Text Color', $text_domain),
        'textclr_tooltip'       => __('text color for light and circular countdown', $text_domain),
        'restextclr_label'      => __('Text Color(On Responsive)', $text_domain),
        'restextclr_tooltip'    => __('text color for light and circular countdown(On Responsive)', $text_domain),
        'textbgclr_label'       => __('Text Background Color', $text_domain),
        'textbgclr_tooltip'     => __('text background color for light countdown', $text_domain),
        'kkfsize_label'         => __('Countdown Font Size', $text_domain),
        'kkfsize_tooltip'       => __('font size for kk countdown', $text_domain),
        'kkfclr_label'          => __('Countdown Number Color', $text_domain),
        'kkfclr_tooltip'        => __('number color for kk countdown', $text_domain),
        'kktextclr_label'       => __('Countdown Text Color', $text_domain),
        'kktextclr_tooltip'     => __('text color for kk countdown', $text_domain),
    );

	$strings = apply_filters('codeboxrflexiblecountdown_tinymce_translation', $strings);

    $locale = _WP_Editors::$mce_locale;
    $translated = 'tinyMCE.addI18n("' . $locale . '.cbfccountdown", ' . json_encode( $strings ) . ");\n";

    return $translated;
}

$strings = cbfc_tinymce_plugin_translation( $text_domain );