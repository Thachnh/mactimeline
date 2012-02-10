<?php
  /*Product group loading for getting title and icon, if exists*/
	$related_product = node_load(array('nid' => $node->field_feature4product[0]['nid']));
	$product_icon = theme('imagecache','icon',$related_product->field_icon[0]['filepath'],NULL,NULL,array('class' => 'imagecache-icon'));	
	$product_title = $related_product->title;
	if ($related_product->field_related_group) {
		$related_product->field_related_group['#item']['nid'] = $related_product->field_related_group[0]['nid'];
		$product_related_group = theme('nodereference_formatter_default',$related_product->field_related_group);
	}

	if ($node->field_date['0']['value'] && $node->field_feature4product[0]['nid']) {

    $result = db_query('
      SELECT DATEDIFF("'.$node->field_date['0']['value'].'",previous.field_date_value) days_between FROM
      (
      	SELECT * FROM
      	(
      	SELECT DISTINCT ctu.* FROM content_type_update ctu
      		WHERE ctu.field_related_product_nid = '.$node->field_related_product[0]['nid'].' && (ctu.field_update_type_value = 1 || ctu.field_update_type_value = 2 || ctu.field_update_type_value = 3 || ctu.field_update_type_value = 4)
      	) AS dates
      	WHERE dates.field_date_value < "'.$node->field_date['0']['value'].'" ORDER BY field_date_value DESC LIMIT 1
      ) AS previous
    ');

    $days_between_updates = db_fetch_array($result);
  }
?>
<?php if ($page != 0) { ?>
<div class="<?php print $type;?> node">
	<?php if (user_access('administer nodes')) {?>
	<ul class="admin-controls">
		<li class="delete"><?php print l(t('delete'),'node/'.$nid.'/delete'); ?></li>
  	<li class="edit"><?php print l(t('edit'),'node/'.$nid.'/edit'); ?></li>  	
	</ul>
	<?php }?>	
	<table class="header">
		<tr>
    	<td class="icon"><?php print $product_icon;?></td>
    	<td class="related-group">
    		<?php 
    		  if ($product_related_group) {
    		    print '<h1>'.l($product_title,'node/'.$node->field_feature4product[0]['nid']).'</h1>';
    		    print $product_related_group;
    		  } else {
    		    print '<h1>'.l($product_title,'node/'.$node->field_feature4product[0]['nid']).'</h1>';
    		  }
    		?>
    	</td>
  	</tr>
  </table>

	<?php print '<h2 class="clear">'.t('Feature Request: ').'<span class="date-display-single">'.$date.'</span></h2>'; ?>
	<div class="info">
		<div class="title"><?php print $title .' '. $related_event_tags;?> </div>
		<?php print $node->field_feature_description[0]['view'] ?>
	</div>
</div>
<?php }?>
