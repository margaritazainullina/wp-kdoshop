<?php
/**
 * @package   Codeboxr_Flexible_CountDown
 * @author    Codeboxr <info@codeboxr.com>
 * @license   GPL-2.0+
 * @link      http://codeboxr.com/
 * @copyright 2014 Codeboxr
 */
?>


<?php
    $countdown_list = cbfc_get_countdown_style();
?>

<p>
    <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', $this->get_widget_slug() ); ?></label>
    <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" />
</p>

<p>
    <label for="<?php echo $this->get_field_id( 'cbfc_countdown_style' ); ?>"><?php _e( 'Countdown Style:', $this->get_widget_slug() ); ?></label>
    <select class="widefat" id="<?php echo $this->get_field_id( 'cbfc_countdown_style' ); ?>" name="<?php echo $this->get_field_name( 'cbfc_countdown_style' ); ?>">
        <?php foreach( $countdown_list as $list_id => $list_name ): ?>
            <option value="<?php echo $list_id; ?>"<?php echo ( $list_id == $cbfc_countdown_style ) ? 'selected="selected"' : ''; ?>><?php echo $list_name; ?></option>
        <?php endforeach; ?>
    </select>
</p>

<p>
    <label for="<?php echo $this->get_field_id( 'cbfc_date' ); ?>"><?php _e( 'Launch Date:', $this->get_widget_slug() ); ?></label>
    <input class="widefat datepicker cbxcntdatepicker" id="<?php echo $this->get_field_id( 'cbfc_date' ); ?>" name="<?php echo $this->get_field_name( 'cbfc_date' ); ?>" type="text" placeholder="mm/dd/yyyy" value="<?php echo $cbfc_date; ?>" />
</p>

<p>
    <label for="<?php echo $this->get_field_id( 'cbfc_hour' ); ?>"><?php _e( 'Launch Hour:', $this->get_widget_slug() ); ?></label>
    <input class="widefat" id="<?php echo $this->get_field_id( 'cbfc_hour' ); ?>" name="<?php echo $this->get_field_name( 'cbfc_hour' ); ?>" type="text" value="<?php echo $cbfc_hour; ?>" />
</p>

<p>
    <label for="<?php echo $this->get_field_id( 'cbfc_min' ); ?>"><?php _e( 'Launch Minute:', $this->get_widget_slug() ); ?></label>
    <input class="widefat" id="<?php echo $this->get_field_id( 'cbfc_min' ); ?>" name="<?php echo $this->get_field_name( 'cbfc_min' ); ?>" type="text" value="<?php echo $cbfc_min; ?>" />
</p>
<?php
 do_action('cbxflexiblecountdownwidgetform', $this, $instance);
?>