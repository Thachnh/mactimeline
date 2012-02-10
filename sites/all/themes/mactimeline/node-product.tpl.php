<div class="demo-description" style="display: none; ">
<p>Click tabs to swap between content that is broken into logical sections.</p>
</div><!-- End demo-description -->

<?php


/*It's important for us to know is there any updates in the this project*/
  $upd = db_query('SELECT DISTINCT ctu.* FROM content_type_update ctu WHERE ctu.field_related_product_nid = '.$node->nid.' && (ctu.field_update_type_value = 2 || ctu.field_update_type_value = 3) ORDER BY ctu.field_date_value DESC');

  if (mysql_num_rows($upd)) {
    /*Last update, days ago*/
      $result = db_query('
        SELECT DATEDIFF(NOW(),previous.field_date_value) days_between FROM
        (
        	SELECT DISTINCT ctu.* FROM content_type_update ctu WHERE ctu.field_related_product_nid = '.$node->nid.' && (ctu.field_update_type_value = 2 || ctu.field_update_type_value = 3) ORDER BY ctu.field_date_value DESC LIMIT 1
        ) AS previous
      ');

      $last_update = db_fetch_array($result);
      $last_update_days_ago = $last_update['days_between'];
    /*Last update, days ago*/

    mysql_free_result($result);   

    $result = db_query('SELECT DISTINCT ctu.* FROM content_type_update ctu WHERE ctu.field_related_product_nid = '.$node->nid.' && (ctu.field_update_type_value = 2 || ctu.field_update_type_value = 3) ORDER BY ctu.field_date_value DESC');
    
    /*Counting average days between updates*/
      $between_sum = 0;
      
      while ($update = db_fetch_object($result)) {
        $btwu = db_fetch_array(db_query('
          SELECT DATEDIFF("'.$update->field_date_value.'",previous.field_date_value) days_between FROM
          (
          	SELECT * FROM
          	(
          		(
          			SELECT DISTINCT ctu.* FROM content_type_update ctu WHERE ctu.field_related_product_nid = '.$node->nid.' && (ctu.field_update_type_value = 1 || ctu.field_update_type_value = 2 || ctu.field_update_type_value = 3)
          		) UNION (
      				SELECT DISTINCT ctu.* FROM content_type_update ctu WHERE ctu.field_related_product_nid = '.$node->nid.' && ctu.field_update_type_value != 4 ORDER BY ctu.field_date_value ASC LIMIT 1
          		)
          	) AS dates
          	WHERE dates.field_date_value < "'.$update->field_date_value.'" ORDER BY field_date_value DESC LIMIT 1
          ) AS previous
				'));

        if ($btwu['days_between']) {
          $updates[] =  array('days_between' => $btwu['days_between']) + array('date' => format_date(strtotime($update->field_date_value),'custom','d M y',25200));
        }        
        $between_sum += $btwu['days_between'];
        $days[] = $btwu['days_between'];
      }
      $dbu_average = round($between_sum/mysql_num_rows($result));
    /*Counting average days between updates*/
  }

/*It's important for us to know is there any updates in the this project*/
?>

<?php if ($page != 0) { ?>
<div class="<?php print $type?> node" style="margin-bottom:30px;">
	<?php if (user_access('administer nodes')) {?>
	<ul class="admin-controls">
		<li class="delete"><?php print l(t('delete'),'node/'.$nid.'/delete'); ?></li>
  	<li class="edit"><?php print l(t('edit'),'node/'.$nid.'/edit'); ?></li>  	
	</ul>
	<?php }?>
	<div class="clear"></div>
	<table class="header">
		<tr>
    	<td class="icon"><?php print $field_icon['0']['view'];?></td>
    	<td class="related-group">
    		<?php 
    		  if ($field_related_group['0']['view']) {
    		    print '<h1>'.$title.'</h1>';
    		    print $field_related_group['0']['view'];
    		  } else {
    		    print '<h1>'.$title.'</h1>';
    		  }
    		?>
    	</td>
    	<td class="right links tags">
    		<div><?php print $field_product_url['0']['url'] ? '<a href="'.$field_product_url['0']['url'].'" class="link-button">Official Website</a>' : '';?></div>
    		<div><?php print $field_feedback_url['0']['url'] ? '<a href="'.$field_feedback_url['0']['url'].'" class="link-button">Send Apple Feedback</a>' : '';?></div>
    	</td>
  	</tr>
  </table>
  <div class="product-dates">
  	<?php print db_fetch_array($upd) ? '<span>'.t('Last key update: !num',array('!num' => isset($last_update_days_ago) ? $last_update_days_ago==0 ? t('Today') : format_plural($last_update_days_ago,'1 day',t('@count days ago')) : t('Never'))).'</span><span>'.t('Average: !num',array('!num' => $dbu_average ? format_plural($dbu_average,t('1 day'),t('@count days')) : t('Will soon'))).'</span>':null;?>
  </div>
	<div id="tabs">
		<ul class="tab-header">
			<li><a href="#overview">Overview</a></li>
			<li><a href="#update-list">List of Updates</a></li>
		</ul>
		
		<div id="overview">
			<?php print theme('blocks','group_products');?>
			<?php print $node->content['group_prices']['#children']; ?>
			
			<div class="left halfwidth">
				<div class="wrapper" style="padding-right: 10px;">
				<?php 
				$view = views_get_view('ideas');
			    $display = $view->execute_display('block_2');
			    ?>
			    <div class="block-header left"><?php print $display['subject'];?></div>
			    <div class="tags right"><a href="/submitidea/<?php print $node->nid;?>" class="link-button">Submit Product Idea</a></div>
			    <?php print $display['content'];?>
			    </div>
			</div>
			
			<div class="right halfwidth">
				<?php if (db_fetch_array($upd) && $updates) { ?>
			  	<div class="block-header left">Days Between Key Updates</div>
			
					<?php
						$dbu_max = 0;
						for($i=0;$i<count($days);$i++) {
							if($days[$i]>$dbu_max) $dbu_max = $days[$i];
						}
			 			if ($dbu_max > $dbu_average*2) {
							$ug_max = $dbu_max + 10;
						} else {
							$ug_max = $dbu_average * 2;				
						}			
						$ug_max = round(ceil($ug_max/150)*10,-1)*15;
						if (!isset($last_update_days_ago)) $last_update_days_ago = 0;
						$today_width = ($last_update_days_ago*100)/$ug_max;
					?>			
					<ul id="update-graphic">
					<li><div class="ug-date">Today</div><div class="ug-date-between"><?php print $last_update_days_ago;?></div><div class="ug-bar-width"><div class="ug-bar <?php print ($last_update_days_ago>$dbu_average) ? "redchart" : "greenchart"?>" style="width:<?php print $today_width?>%"></div></div></li>
					<?php
					  foreach ($updates as $unode) {			    
				  		$bar_width = ($unode['days_between']*100)/$ug_max;
				      print '<li><div class="ug-date">'.$unode['date'].'</div><div class="ug-date-between">'.$unode['days_between'].'</div><div class="ug-bar-width"><div class="ug-bar" style="width:'.$bar_width.'%"></div></div></li>';
					  }
					?>
					</ul>
					<div id="ug-average" style="margin-top:-<?php print ((count($updates)+1)*23);?>px"><div style="width:<?php print (($dbu_average*100)/$ug_max);?>%; height:<?php print (((count($updates)+1)*23) - 5);?>px;"></div></div>
					<div id="ug-scale" style="height:<?php print ((count($updates)*23) + 15);?>px; margin-top:-<?php print ((count($updates)+1)*23);?>px">
						<ul>
							<?php 
								unset($i);
								$scale_item = $ug_max/15;
								for($i=0;$i<15;$i++) {
									$scale_item_next += $scale_item;
									print '<li style="padding-top:'.((count($updates)+1)*23).'px;">'.$scale_item_next.'</li>';
								}
							?>
						</ul>
					</div>			
			  <?php } ?>
			</div>
		</div>
		
		<div id="update-list">
			<?php
			$view = views_get_view('updates');
		    $display = $view->execute_display('block_2');
		    if ($display) {
		      print '<h2 class="clear">'.$display['subject'];
		      print '</h2>';
		      print $display['content'];
		    }
		    if (!$field_related_group['0']['view']) {
		      unset($view);
		      unset($display);
		      $view = views_get_view('updates');
		      $display = $view->execute_display('block_4');
		      if ($display) {
		        print '<h2 class="clear">'.$display['subject'];
		        print '</h2>';
		        print $display['content'];
		      }
		    }
		  ?>
		</div>
	</div>
</div>
<?php } ?>