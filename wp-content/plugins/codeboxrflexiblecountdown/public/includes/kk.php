<?php
/**
 * @package   Codeboxr_Flexible_CountDown
 * @author    Codeboxr <info@codeboxr.com>
 * @license   GPL-2.0+
 * @link      http://codeboxr.com/
 * @copyright 2015 Codeboxr
 */
?>

<style type="text/css">

    <?php if ( $load_css ): $load_css = false ?>
    .cbfc-kkcountdown {
        margin: 30px 0;
        text-align: center;
    }
    <?php endif; ?>

    .cbfc-kkcountdown<?php echo $kk_id_counter; ?> .kkcountdown-box {
        font-weight: 300;
        font-size: <?php echo $attr['kkfsize']; ?>px;
        color: <?php echo $attr['kkfclr']; ?>;
    }

    .cbfc-kkcountdown<?php echo $kk_id_counter; ?> .kkcountdown-box .kkc-days-text,
    .cbfc-kkcountdown<?php echo $kk_id_counter; ?> .kkcountdown-box .kkc-hours-text,
    .cbfc-kkcountdown<?php echo $kk_id_counter; ?> .kkcountdown-box .kkc-min-text,
    .cbfc-kkcountdown<?php echo $kk_id_counter; ?> .kkcountdown-box .kkc-sec-text {
        color: <?php echo $attr['kktextclr']; ?>;
    }


    @media (max-width: 767px) {

        .cbfc-kkcountdown<?php echo $kk_id_counter; ?> .kkcountdown-box {
            font-size: 43px;
        }

    }

    @media (max-width: 480px) {

        .cbfc-kkcountdown<?php echo $kk_id_counter; ?> .kkcountdown-box {
            font-size: 21px;
        }

    }

</style>



<?php $kk_count_down = explode('/', $attr['date'] ); ?>
<div class="cbfc-kkcountdown cbfc-kkcountdown<?php echo $kk_id_counter; ?>" data-time="<?php echo mktime( $attr['hour'], $attr['minute'], 0, $kk_count_down[0], $kk_count_down[1], $kk_count_down[2] ); ?>"></div> <!-- End of KKCountdown Div -->