<?php
/**
 * @package   Codeboxr_Flexible_CountDown
 * @author    Codeboxr <info@codeboxr.com>
 * @license   GPL-2.0+
 * @link      http://codeboxr.com/
 * @copyright 2014 Codeboxr
 */
?>



<!-- This file is used to markup the public facing aspect of the plugin. -->

<style type="text/css">

    .cbfc-countdown-<?php echo $id_counter; ?> .cbfc-cd-background {
        border: 1px solid <?php echo $attr['numbgclr']; ?>;
        background: none repeat scroll 0 0 <?php echo $attr['numbgclr']; ?>;
    }

    .cbfc-cd-number .digit-<?php echo $id_counter; ?> {
        color: <?php echo $attr['numclr']; ?>;
    }

    .cbfc-overlap-<?php echo $id_counter; ?> {
        background-color: <?php echo $attr['textbgclr']; ?>;
        color: <?php echo $attr['textclr']; ?>;
    }

    .cbfc-light-countdowns-480 .cbfc-cd-number .digit-<?php echo $id_counter; ?> {
        color: <?php echo $attr['resnumclr']; ?>;
        width: 65%;
    }

    .cbfc-light-countdowns-480 .cbfc-overlap-<?php echo $id_counter; ?> {
        color: <?php echo $attr['restextclr']; ?>;
    }

</style>


<!-- Countdown dashboard start -->
    <ul id="cbfc-countdowns-dashboard-<?php echo $id_counter; ?>" class="cbfc-countdown cbfc-countdown-<?php echo $id_counter; ?> countdowns-dashboard" data-date="<?php echo $attr['date']; ?>" data-hour="<?php echo $attr['hour']; ?>" data-min="<?php echo $attr['minute']; ?>">

        <li class="cbfc-number-box">
            <div class="cbfc-cd-main-container">
                <div class="cbfc-cd-background cbfc-cd-background-<?php echo $id_counter; ?>">
                    <div class="cbfc-cd-days cbfc-cd-number dash days_dash" data-color="<?php echo $attr['numclr']; ?>">
                        <div class="digit digit-<?php echo $id_counter; ?>">0</div>
                        <div class="digit digit-<?php echo $id_counter; ?>">0</div>
                    </div>

                    <div class="cbfc-overlap cbfc-overlap-<?php echo $id_counter; ?>"><?php _e( 'Days', self::$instance->plugin_slug ); ?></div>
                </div>
            </div>
        </li>

        <li class="cbfc-number-box">
            <div class="cbfc-cd-main-container">
                <div class="cbfc-cd-background">
                    <div class="cbfc-cd-hours cbfc-cd-number dash hours_dash">
                        <div class="digit digit-<?php echo $id_counter; ?>">0</div>
                        <div class="digit digit-<?php echo $id_counter; ?>">0</div>
                    </div>

                    <div class="cbfc-overlap cbfc-overlap-<?php echo $id_counter; ?>"><?php _e( 'Hours', self::$instance->plugin_slug ); ?></div>
                </div>
            </div>
        </li>

        <li class="cbfc-number-box">
            <div class="cbfc-cd-main-container">
                <div class="cbfc-cd-background">
                    <div class="cbfc-cd-minutes cbfc-cd-number dash minutes_dash">
                        <div class="digit digit-<?php echo $id_counter; ?>">0</div>
                        <div class="digit digit-<?php echo $id_counter; ?>">0</div>
                    </div>

                    <div class="cbfc-overlap cbfc-overlap-<?php echo $id_counter; ?>"><?php _e( 'Minutes', self::$instance->plugin_slug ); ?></div>
                </div>
            </div>
        </li>

        <li class="cbfc-number-box">
            <div class="cbfc-cd-main-container">
                <div class="cbfc-cd-background">
                    <div class="cbfc-cd-seconds cbfc-cd-number dash seconds_dash">
                        <div class="digit digit-<?php echo $id_counter; ?>">0</div>
                        <div class="digit digit-<?php echo $id_counter; ?>">0</div>
                    </div>

                    <div class="cbfc-overlap cbfc-overlap-<?php echo $id_counter; ?>"><?php _e( 'Seconds', self::$instance->plugin_slug ); ?></div>
                </div>
            </div>
        </li>

    </ul> <!-- End of Countdown Dashboard Div -->