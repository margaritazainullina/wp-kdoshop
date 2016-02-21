<?php if(preg_match('#' . basename(__FILE__) . '#', $_SERVER['PHP_SELF'])) { die('You are not allowed to call this page directly.'); } ?>
<?php
// Form submitted, check the data
if (isset($_POST['frm_gCountdisplay']) && $_POST['frm_gCountdisplay'] == 'yes')
{
	$did = isset($_GET['did']) ? $_GET['did'] : '0';
	if(!is_numeric($did)) { die('<p>Are you sure you want to do this?</p>'); }
	
	$gCountsuccess = '';
	$gCountsuccess_msg = FALSE;
	
	// First check if ID exist with requested ID
	$sSql = $wpdb->prepare(
		"SELECT COUNT(*) AS `count` FROM ".WP_G_Countdown_TABLE."
		WHERE `gCountid` = %d",
		array($did)
	);
	$result = '0';
	$result = $wpdb->get_var($sSql);
	
	if ($result != '1')
	{
		?><div class="error fade"><p><strong><?php _e('Oops, selected details doesnt exist.', 'deal-or-announcement-with-countdown-timer'); ?></strong></p></div><?php
	}
	else
	{
		// Form submitted, check the action
		if (isset($_GET['ac']) && $_GET['ac'] == 'del' && isset($_GET['did']) && $_GET['did'] != '')
		{
			//	Just security thingy that wordpress offers us
			check_admin_referer('gCountform_show');
			
			//	Delete selected record from the table
			$sSql = $wpdb->prepare("DELETE FROM `".WP_G_Countdown_TABLE."`
					WHERE `gCountid` = %d
					LIMIT 1", $did);
			$wpdb->query($sSql);
			
			//	Set success message
			$gCountsuccess_msg = TRUE;
			$gCountsuccess = __('Selected record was successfully deleted.', 'deal-or-announcement-with-countdown-timer');
		}
	}
	
	if ($gCountsuccess_msg == TRUE)
	{
		?><div class="updated fade"><p><strong><?php echo $gCountsuccess; ?></strong></p></div><?php
	}
}
?>
<div class="wrap">
  <div id="icon-edit" class="icon32 icon32-posts-post"></div>
    <h2><?php _e('Deal with countdown', 'deal-or-announcement-with-countdown-timer'); ?>
	<a class="add-new-h2" href="<?php echo WP_deal_ADMIN_URL; ?>&amp;ac=add"><?php _e('Add New', 'deal-or-announcement-with-countdown-timer'); ?></a></h2>
    <div class="tool-box">
	<?php
		$pagenum = isset( $_GET['pagenum'] ) ? absint( $_GET['pagenum'] ) : 1;
		$limit = 20;
		$offset = ($pagenum - 1) * $limit;
		$sSql = "SELECT COUNT(gCountid) AS count FROM ". WP_G_Countdown_TABLE;
		$total = 0;
		$total = $wpdb->get_var($sSql);
		$total = ceil( $total / $limit );
	
		$sSql = "SELECT * FROM `".WP_G_Countdown_TABLE."` order by gCountid desc LIMIT $offset, $limit";
		$myData = array();
		$myData = $wpdb->get_results($sSql, ARRAY_A);
		?>
		<script language="JavaScript" src="<?php echo WP_deal_PLUGIN_URL; ?>/pages/gCountdownform.js"></script>
		<form name="frm_gCountdisplay" method="post">
      <table width="100%" class="widefat" id="straymanage">
        <thead>
          <tr>
            <th class="check-column" scope="col" style="padding: 8px 2px;"><input type="checkbox" name="gCountgroup_item[]" /></th>
			<th scope="col"><?php _e('Announcement', 'deal-or-announcement-with-countdown-timer'); ?></th>
            <th scope="col"><?php _e('Expiration', 'deal-or-announcement-with-countdown-timer'); ?></th>
			<th scope="col"><?php _e('Display', 'deal-or-announcement-with-countdown-timer'); ?></th>
			<th scope="col"><?php _e('Id', 'deal-or-announcement-with-countdown-timer'); ?></th>
          </tr>
        </thead>
		<tfoot>
          <tr>
            <th class="check-column" scope="col" style="padding: 8px 2px;"><input type="checkbox" name="gCountgroup_item[]" /></th>
			<th scope="col"><?php _e('Announcement', 'deal-or-announcement-with-countdown-timer'); ?></th>
            <th scope="col"><?php _e('Expiration', 'deal-or-announcement-with-countdown-timer'); ?></th>
			<th scope="col"><?php _e('Display', 'deal-or-announcement-with-countdown-timer'); ?></th>
			<th scope="col"><?php _e('Id', 'deal-or-announcement-with-countdown-timer'); ?></th>
          </tr>
        </tfoot>
		<tbody>
			<?php 
			$i = 0;
			if(count($myData) > 0 )
			{
				foreach ($myData as $data)
				{
					?>
					<tr class="<?php if ($i&1) { echo'alternate'; } else { echo ''; }?>">
						<td align="left"><input type="checkbox" value="<?php echo $data['gCountid']; ?>" name="gCountgroup_item[]"></td>
						<td><?php echo stripslashes($data['gCount']); ?>
						<div class="row-actions">
						<span class="edit"><a title="Edit" href="<?php echo WP_deal_ADMIN_URL; ?>&amp;ac=edit&amp;did=<?php echo $data['gCountid']; ?>"><?php _e('Edit', 'deal-or-announcement-with-countdown-timer'); ?></a> | </span>
						<span class="trash"><a onClick="javascript:gCountdelete('<?php echo $data['gCountid']; ?>')" href="javascript:void(0);"><?php _e('Delete', 'deal-or-announcement-with-countdown-timer'); ?></a></span> 
						</div>
						</td>
						<td><?php echo $data['gCountyear']."-".$data['gCountmonth']."-".$data['gCountdate']."<br>".$data['gCounthour'].":00 ".$data['gCountzoon']; ?></td>
						<td><?php echo $data['gCountdisplay']; ?></td>
						<td><?php echo $data['gCountid']; ?></td>
					</tr>
					<?php 
					$i = $i+1; 
				} 
			}
			else
			{ 
				?><tr><td colspan="5" align="center"><?php _e('No records available.', 'deal-or-announcement-with-countdown-timer'); ?></td></tr><?php 
			} 
			?>
		</tbody>
        </table>
		<?php wp_nonce_field('gCountform_show'); ?>
		<input type="hidden" name="frm_gCountdisplay" value="yes"/>
		<?php
		  $page_links = paginate_links( array(
				'base' => add_query_arg( 'pagenum', '%#%' ),
				'format' => '',
				'prev_text' => __( ' &lt;&lt; ' ),
				'next_text' => __( ' &gt;&gt; ' ),
				'total' => $total,
				'show_all' => False,
				'current' => $pagenum
			) );
		 ?>	
      </form>	
		<div class="tablenav bottom">
			<div class="tablenav-pages"><span class="pagination-links"><?php echo $page_links; ?></span></div>
			<div class="alignleft actions" style="padding-top:8px;">
			  <a class="button" href="<?php echo WP_deal_ADMIN_URL; ?>&amp;ac=add"><?php _e('Add New', 'deal-or-announcement-with-countdown-timer'); ?></a>
			  <a class="button" href="<?php echo WP_deal_ADMIN_URL; ?>&amp;ac=set"><?php _e('Widget Setting', 'deal-or-announcement-with-countdown-timer'); ?></a>
			  <a class="button" target="_blank" href="<?php echo WP_deal_FAV; ?>"><?php _e('Help', 'deal-or-announcement-with-countdown-timer'); ?></a>
			</div>		
		</div>
		<h3><?php _e('Plugin configuration option', 'deal-or-announcement-with-countdown-timer'); ?></h3>
		<ol>
			<li><?php _e('Add directly in to the theme using PHP code.', 'deal-or-announcement-with-countdown-timer'); ?></li>
			<li><?php _e('Drag and drop the widget to your sidebar.', 'deal-or-announcement-with-countdown-timer'); ?></li>
		</ol>
	<p class="description">
		<?php _e('Check official website for more information', 'deal-or-announcement-with-countdown-timer'); ?>
		<a target="_blank" href="<?php echo WP_deal_FAV; ?>"><?php _e('click here', 'deal-or-announcement-with-countdown-timer'); ?></a>
	</p>
	</div>
</div>