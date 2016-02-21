<?php
/**
 * @package   Codeboxr_Flexible_CountDown
 * @author    Codeboxr <info@codeboxr.com>
 * @license   GPL-2.0+
 * @link      http://codeboxr.com/
 * @copyright 2014 Codeboxr
 */
?>


<style type="text/css">



    .cbfc-circular-clock-canvas<?php echo $id_counter; ?> {
        background-color: <?php echo $attr['bgclr']; ?>;
    }

    .cbfc-circular-text<?php echo $id_counter; ?> {
        color: <?php echo $attr['fontclr']; ?>;
    }

    .cbfc-circular-countdown-container-480 .cbfc-circular-text<?php echo $id_counter; ?> .cbfc-circular-type-time {
        color: <?php echo $attr['textclr']; ?>;

    }

</style>

<!-- Circular countdown -->
<div id="cbfc-circular<?php echo $id_counter; ?>" class="cbfc-circular-countdown cbfc-circular-countdown-container" data-date="<?php echo $attr['date']; ?>" data-hour="<?php echo $attr['hour']; ?>" data-min="<?php echo $attr['minute']; ?>" data-sec-border-clr="<?php echo $attr['secbclr']; ?>" data-min-border-clr="<?php echo $attr['minbclr']; ?>" data-hour-border-clr="<?php echo $attr['hourbclr']; ?>" data-days-border-clr="<?php echo $attr['daysbclr']; ?>">
    <div class="cbfc-clock-container clock">
        <div class="cbfc-circular-clock-item cbfc-circular-clock-days cbfc-circular-countdown-time-value">
            <div class="cbfc-wrap">
                <div class="cbfc-circular-inner">
                    <div id="cbfc-circular-canvas-days<?php echo $id_counter; ?>" class="cbfc-circular-clock-canvas cbfc-circular-clock-canvas<?php echo $id_counter; ?>"></div>

                    <div class="cbfc-circular-text cbfc-circular-text<?php echo $id_counter; ?>">
                        <div class="cbfc-circular-val">0</div>
                        <div class="cbfc-circular-type-days cbfc-circular-type-time"><?php _e( 'Days', $this->get_plugin_slug() ); ?></div>
                    </div><!-- /.text -->
                </div><!-- /.inner -->
            </div><!-- /.cbfc-wrap -->
        </div><!-- /.clock-item -->

        <div class="cbfc-circular-clock-item cbfc-circular-clock-hours cbfc-circular-countdown-time-value">
            <div class="cbfc-wrap">
                <div class="cbfc-circular-inner">
                    <div id="cbfc-circular-canvas-hours<?php echo $id_counter; ?>" class="cbfc-circular-clock-canvas cbfc-circular-clock-canvas<?php echo $id_counter; ?>"></div>

                    <div class="cbfc-circular-text cbfc-circular-text<?php echo $id_counter; ?>">
                        <div class="cbfc-circular-val">0</div>
                        <div class="cbfc-circular-type-hours cbfc-circular-type-time"><?php _e( 'Hours', $this->get_plugin_slug() ); ?></div>
                    </div><!-- /.text -->
                </div><!-- /.inner -->
            </div><!-- /.cbfc-wrap -->
        </div><!-- /.clock-item -->

        <div class="cbfc-circular-clock-item cbfc-circular-clock-minutes cbfc-circular-countdown-time-value">
            <div class="cbfc-wrap">
                <div class="cbfc-circular-inner">
                    <div id="cbfc-circular-canvas-minutes<?php echo $id_counter; ?>" class="cbfc-circular-clock-canvas cbfc-circular-clock-canvas<?php echo $id_counter; ?>"></div>

                    <div class="cbfc-circular-text cbfc-circular-text<?php echo $id_counter; ?>">
                        <div class="cbfc-circular-val">0</div>
                        <div class="cbfc-circular-type-minutes cbfc-circular-type-time"><?php _e( 'Minutes', $this->get_plugin_slug() ); ?></div>
                    </div><!-- /.text -->
                </div><!-- /.inner -->
            </div><!-- /.cbfc-wrap -->
        </div><!-- /.clock-item -->

        <div class="cbfc-circular-clock-item cbfc-circular-clock-seconds cbfc-circular-countdown-time-value">
            <div class="cbfc-wrap">
                <div class="cbfc-circular-inner">
                    <div id="cbfc-circular-canvas-seconds<?php echo $id_counter; ?>" class="cbfc-circular-clock-canvas cbfc-circular-clock-canvas<?php echo $id_counter; ?>"></div>

                    <div class="cbfc-circular-text cbfc-circular-text<?php echo $id_counter; ?>">
                        <div class="cbfc-circular-val">0</div>
                        <div class="cbfc-circular-type-seconds cbfc-circular-type-time"><?php _e( 'Seconds', $this->get_plugin_slug() ); ?></div>
                    </div><!-- /.text -->
                </div><!-- /.inner -->
            </div><!-- /.cbfc-wrap -->
        </div><!-- /.clock-item -->
    </div><!-- /.clock -->
</div><!-- /.countdown-cbfc-wrapper --><!-- End Circular countdown -->
<p style="clear:both;"></p>