<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php print $language->language ?>" lang="<?php print $language->language ?>" dir="<?php print $language->dir ?>">
  <head>
  	<link rel="alternate" title="Mactimeline RSS" href="<?php print url($feed_url, array('absolute' => true)); ?>" type="application/rss+xml">
    <?php print $head ?>
    <title><?php print $head_title ?></title>
    <?php print $styles ?>
    <?php print $scripts ?>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/jquery-ui.min.js"></script>
    <link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css"/>
    <script type="text/javascript" src="/<?php echo drupal_get_path('theme', 'mactimeline');?>/jquery.sortElements.js"></script>
    <script type="text/javascript" src="/<?php echo drupal_get_path('theme', 'mactimeline');?>/jquery.watermark.js"></script>
  </head>
  <body>  
  
	<div id="layout">		
		<div id="header"><? if ($logo && !$is_front) print l('<img src="'.$logo.'"/>','',array('html' => true)); else if ($logo && $is_front) print '<img src="'.$logo.'"/>';?></div>		
 		<!--esem: making pr.links to be on the same line as loginbar, at the left-->
        <div id="mylinks" style="float:left;">
		<!--esem: end-->
        <?php
  		  print $feed_icons;
          print theme('feed_icon', $feed_url, 'RSS feed');
    		if (isset($primary_links)) {
    		  print theme('links', $primary_links, array('class' => 'links primary-links')); 
    		}
  		?>
		<!--esem: making pr.links to be on the same line as loginbar, at the left-->
        </div>
		<!--esem: end-->
  		<!--esem: introducing header region for the placing loginbar in it-->
        <div id="loginbar" style="float:right;">
           	<?php print $header; ?>
        </div>
  		<!--end esem-->
    <div id="main">
    	<?php
    	  print $top;
          
          $related_product = node_load(array('nid' => arg(3)));
		  $product_icon = theme('imagecache','icon',$related_product->field_icon[0]['filepath'],NULL,NULL,array('class' => 'imagecache-icon'));
		  if ($related_product):
		?>
		<div class="product">
			<table class="header">
				<tbody>
					<td class="icon">
						<?php print $product_icon;?>
					</td>
					<td class="related-product">
						<h1><?php print $related_product->title; ?></h1>
					</td>
				</tbody>
			</table>
		</div>
		<?php endif;?>
		<div class="submitidea">
			<?php 
			  if ($title && !$node && arg(0) != 'calendar') print '<h2>'.$title.'</h2>';
	          /*esem show hints-warnings-messages, don't show for update nodes, since there is a warring showing up for them*/
	          if ($show_messages && $messages && $node->type != 'update' && !$is_front): print $messages; endif;
	          /*end esem*/
	          print "<div><label>Username: </label>". $user->name."</div>";
	          print $content;
	    	  print $bottom;
	    	?>
	    	Product Ideas are submitted for approval before they appear on mactimeline.
	    	<br />
			This site is not affiliated with Apple Inc.
		</div>
    </div>
    <div id="right-side">
    	<?php print $right?>
    </div>           
	</div>
	<div id="footer">
	 <div class="indent"><?php print $footer_message;?></div>
	</div> 
  <?php print $closure ?>
<?php //var_dump(get_defined_vars()); ?>
  </body>
</html>
