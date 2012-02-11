<?php
	/*Update's event loading*/
  $related_event = node_load(array('nid' => $node->field_related_event[0]['nid']));
  //if ($related_event) {
    //foreach ($related_event->taxonomy as $tag) $related_event_tags = l($tag->name,'node/'.$related_event->nid,array('attributes' => array('class' => 'event')));
  //} 

  /*Product group loading for getting title and icon, if exists*/
	$related_product = node_load(array('nid' => $node->field_related_product[0]['nid']));
	$product_icon = theme('imagecache','icon',$related_product->field_icon[0]['filepath'],NULL,NULL,array('class' => 'imagecache-icon'));	
	$product_title = $related_product->title;
	if ($related_product->field_related_group) {
		$related_product->field_related_group['#item']['nid'] = $related_product->field_related_group[0]['nid'];
		$product_related_group = theme('nodereference_formatter_default',$related_product->field_related_group);
	}

	if ($node->field_date['0']['value'] && $node->field_related_product[0]['nid']) {

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
<div class="clear"></div>
<table class="header">
<tr>
<td class="icon"><?php print $product_icon;?></td>
<td class="related-group"><?php print '<h1>'.$product_title.'</h1>'; ?>
</td>
</tr>
</table>
<div class="block-header left">Product Idea</div>
<div class="clear"></div>
<div class="left halfwidth">
	<div class="description clear"><?php print $node->title;?></div>
	<div class="information">
	<div>Submitted by: <?php print $node->name;?></div>
	<div>Submitted on: <?php print format_date($node->created,'medium',NULL,25200);?> (Updated: <?php print format_date($node->changed,'medium',NULL,25200);?>)</div>
	</div>
	<div class="social-button">
		<?php print $content; ?>
	</div>
</div>

<div class="right halfwidth">
	<div class="rating"><?php print $node->field_vote_up_down['0']['safe']?></div>
</div>

<div class="clear"></div>
<?php 
if (!empty($node -> disqus_comments)) : 
	print $node -> disqus_comments; 
endif;
?>
</div>

<?php } ?>

<script type="text/javascript">
	$(function () {
		$(".idea .field-field-related-product").hide();
	});
</script>
