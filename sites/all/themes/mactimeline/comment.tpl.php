<?php
// $Id: comment.tpl.php,v 1.2 2009/10/28 13:28:39 webmaster Exp $
?>
<div class="comment<?php print ($comment->new) ? ' comment-new' : ''; print ' '. $status; print ' '. $zebra; ?>">
	<?php if (user_access('administer nodes')) {?>
	<ul class="admin-controls">
		<li class="delete"><?php print l(t('delete'),'comment/delete/'.$comment->cid); ?></li>
  	<li class="edit"><?php print l(t('edit'),'comment/edit/'.$comment->cid); ?></li>  	
	</ul>
	<?php }?>
	<div class="grey-up author"><?php print '<b>'.$author.'</b>'; ?></div>

  <div class="content">
    <?php print $content ?>
    <?php if ($signature): ?>
    <div class="clear-block">
      <div>—</div>
      <?php print $signature ?>
    </div>
    <?php endif; ?>
  </div>
  <div class="time"><?php print format_date($comment->timestamp,'custom','d F Y, h:i a',25200);?></div>
</div>
