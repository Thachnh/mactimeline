<?php if ($page != 0) { ?>

<div class="<?php print $type;?> node">

  <?php if (user_access('administer nodes')) {?>

	<ul class="admin-controls">

		<li class="delete"><?php print l(t('delete'),'node/'.$nid.'/delete'); ?></li>

  	<li class="edit"><?php print l(t('edit'),'node/'.$nid.'/edit'); ?></li>  	

	</ul>

	<?php }?>

	<h1><?php print $title;?></h1>

	<div class="date"><?php print $field_event_date['0']['view']; ?></div>
	
	<div class="left halfwidth">
	<div class="clear"></div>
	<?php
		$today = getdate();
		if ($today['0'] > strtotime($field_event_date['0']['value'])) {
			$view = views_get_view('updates');
	
			$display = $view->execute_display('block_3');
	
			if ($display) {
	
				print '<div class="block-header left">'.$display['subject'].'</div>';
	
				print $display['content'];
			}
		}
		else {
    ?>    
		    <span class="countdowntimer">
			 	<span style="display:none" class="format_num">1</span>
			 	<span style="display:none" class="datetime"><?php print $field_event_date['0']['value']; ?></span>
			</span>
	<?php };?>
    </div>
    <div class="clear"></div>

</div>

<?php } ?>