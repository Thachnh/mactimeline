<?php
// $Id: block.tpl.php,v 1.3 2010/03/09 22:42:23 webmaster Exp $
?>
<div class="<?php print "block block-$block->module" ?>" id="<?php print "block-$block->module-$block->delta"; ?>">
  <div class="title"><h3><?php print $block->subject ?></h3></div>
  <div class="content"><?php print $block->content ?></div>
</div>