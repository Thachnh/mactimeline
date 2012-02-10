<?php
// $Id: vote_up_down_widget.tpl.php,v 1.2 2010/04/07 18:15:23 webmaster Exp $
/**
 * @file vote_up_down_widget.tpl.php
 *
 * This template handles default voting widget output. Available variables:
 * - $points: voting points of a same style as widget;
 * - $class1: "vote-up-act", "vote-up-inact";
 * - $class2: "vote-down-act", "vote-down-inact";
 * - $title1, $title1: Contains a voting URL, should not be removed;
 * - $link1, $link2: Voting links for users with disabled JS;
 * - $cid: $node->nid or $comment->cid;
 */
?>
<div class="vote-up-down-widget">
  <?php if ($page) { ?>
  	<?php if ($class1) : ?>
  	<ul>
  		<li>
        <span id="vote_up_<?php print $cid; ?>" class="<?php print $class1; ?>" title="<?php print $title1; ?>"><?php print $link1; ?></span>
        <div class="grey-up"><span class="vote_up_down_up_count" id="vote_up_down_up_count_<?php print $cid; ?>"><?php print $up_count; ?></span> votes</div>
        <div class="grey-up"><span class="vote_up_down_percent_up" id="vote_up_down_percent_up_<?php print $cid; ?>"><?php print $percent1; ?></span></div>
        <div class="grey-up"><div class="vote_up_down_up_graph" id="vote_up_down_up_graph_<?php print $cid; ?>" style="width: <?php print ($percent1>0) ? $percent1 : "1%"; ?>"></div></div>
      </li>
      <li>
        <span id="vote_down_<?php print $cid; ?>" class="<?php print $class2; ?>" title="<?php print $title2; ?>"><?php print $link2; ?></span>
        <div class="grey-up"><div class="vote_up_down_down_graph" id="vote_up_down_down_graph_<?php print $cid; ?>" style="width: <?php print ($percent2>0) ? $percent2 : "1%"; ?>"></div></div>
        <div class="grey-up"><span class="vote_up_down_down_count" id="vote_up_down_down_count_<?php print $cid; ?>"><?php print $down_count; ?></span> votes</div>
        <div class="grey-up"><span class="vote_up_down_percent_down" id="vote_up_down_percent_down_<?php print $cid; ?>"><?php print $percent2; ?></span></div>
      </li>
    </ul>
    <?php endif; ?>
  <?php } else { ?>
   	<?php if ($class1) : ?>
      <span class="vote-graph"><span class="graph-bar vote_up_down_up_graph" id="vote_up_down_up_graph_<?php print $cid; ?>" style="width: <?php print ($percent1>0) ? $percent1 : "1%"; ?>"></span></span>
      <span id="vote_up_<?php print $cid; ?>" class="<?php print $class1; ?>" title="<?php print $title1; ?>"><?php print $link1; ?></span>
      <span class="vote_up_down_percent_up" id="vote_up_down_percent_up_<?php print $cid; ?>"><?php print $percent1; ?></span>
      <div class="clear"></div>
      <span class="vote-graph"><span class="graph-bar vote_up_down_down_graph" id="vote_up_down_down_graph_<?php print $cid; ?>" style="width: <?php print ($percent2>0) ? $percent2 : "1%"; ?>"></span></span>
      <span id="vote_down_<?php print $cid; ?>" class="<?php print $class2; ?>" title="<?php print $title2; ?>"><?php print $link2; ?></span>
      <span class="vote_up_down_percent_down" id="vote_up_down_percent_down_<?php print $cid; ?>"><?php print $percent2; ?></span>
      <?php endif; ?>
   <?php }; ?>
</div>