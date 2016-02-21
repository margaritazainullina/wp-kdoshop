<?php
/* 
 *	Multishop Recent post widget	
 */
class multishop_randompostwidget extends WP_Widget
{
function multishop_randompostwidget()
{
$multishop_widget_ops = array('classname' => 'multishop_recentpostwidget', 'description' => __('Displays a recent post with thumbnail','multishop') );
$this->WP_Widget('multishop_recentpostwidget', ' '.__('Multishop Recent Post','multishop').' ', $multishop_widget_ops);
}

function form($multishop_instance)
{
$multishop_instance = wp_parse_args( (array) $multishop_instance, array( 'title' => '' ) );
$multishop_instance['title'];
if(!empty($multishop_instance['post_number'])) { $multishop_instance['post_number']; } 
?>
        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title', 'multishop'); echo ":"; ?></label>
            <input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php if(!empty($multishop_instance['title'])) { echo $multishop_instance['title']; } ?>" style="width:100%;" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'post_number' ); ?>"><?php _e('Number of post to show', 'multishop');  echo ":"; ?></label>
            <input id="<?php echo $this->get_field_id( 'post_number' ); ?>" name="<?php echo $this->get_field_name( 'post_number' ); ?>" value="<?php if(!empty($multishop_instance['post_number'])) { echo $multishop_instance['post_number']; } else { echo '5'; } ?>" style="width:100%;" />
        </p>
<?php
}

function update($multishop_new_instance, $multishop_old_instance)
{
$multishop_instance = $multishop_old_instance;
$multishop_instance['title'] = $multishop_new_instance['title'];
$multishop_instance['post_number'] = $multishop_new_instance['post_number'];
return $multishop_instance;
}

function widget($multishop_args, $multishop_instance)
{
extract($multishop_args, EXTR_SKIP);

echo $before_widget;
$multishop_title = empty($multishop_instance['title']) ? ' ' : apply_filters('widget_title', $multishop_instance['title']);

if (!empty($multishop_title))
echo $before_title . $multishop_title . $after_title;;

//widget code here
?>
<div class="multishop-custom-widget">
<?php
$multishop_args = array(
	'posts_per_page'   => $multishop_instance['post_number'],
	'orderby'          => 'post_date',
	'order'            => 'DESC',
	'post_type'        => 'post',
	'post_status'      => 'publish'
);
$multishop_single_post = new WP_Query( $multishop_args );

while ( $multishop_single_post->have_posts() ) { $multishop_single_post->the_post();
?>
<div class="multishop-recentpost no-padding-lr clearfix">
    <p>
    	<a href="<?php echo esc_url(get_permalink()); ?>" class="recent-post-title-link"><?php esc_attr(the_title()); ?></a>
   
       <span> <?php echo get_the_date("M j, Y "); ?></span>
   </p>
  </div>
<?php } wp_reset_query(); ?>
</div>
<?php	
echo $after_widget;
}
}
add_action( 'widgets_init', create_function('', 'return register_widget("multishop_randompostwidget");') );
?>
