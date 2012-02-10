<?php if ($page != 0) { ?>

<div class="<?php print $type;?> node">
<?php if (user_access('administer nodes')) {?>

	<ul class="admin-controls">

		<li class="delete"><?php print l(t('delete'),'node/'.$nid.'/delete'); ?></li>

  	<li class="edit"><?php print l(t('edit'),'node/'.$nid.'/edit'); ?></li>  	

	</ul>

	<?php }?>
	
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