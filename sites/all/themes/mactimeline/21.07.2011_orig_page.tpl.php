<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<?php
  		  if (arg(0) == 'calendar' || arg(0) == 'updates' || arg(0) == 'frontpage') {
          $feed_url = '/feed';
  		  }
        else if (arg(0) == 'node' && $node->type == 'product') {
          $feed_url = '/feed/' . $_REQUEST['q'];
  		  }
        else if ((arg(0) == 'node' && $node->type == 'event') || arg(0) == 'events') {
          $feed_url = '/feed/events/';
  		  }
        else if (arg(0) == 'taxonomy' && arg(2) == 2) {
          $feed_url = '/feed/hardware/';
  		  }
        else if (arg(0) == 'taxonomy' && arg(2) == 1) {
          $feed_url = '/feed/software/';
  		  }
?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php print $language->language ?>" lang="<?php print $language->language ?>" dir="<?php print $language->dir ?>">
  <head>
    <link rel="alternate" title="Mactimeline RSS" href="<?php print url($feed_url, array('absolute' => true)); ?>" type="application/rss+xml">
    <?php print $head ?>
    <title><?php print $head_title ?></title>
    <?php print $styles ?>
    <?php print $scripts ?>
  </head>
  <body>  
	<div id="layout">		
		<div id="header"><? if ($logo && !$is_front) print l('<img src="'.$logo.'"/>','',array('html' => true)); else if ($logo && $is_front) print '<img src="'.$logo.'"/>';?></div>		
  		<?php
  		  print $feed_icons;
        print theme('feed_icon', $feed_url, 'RSS feed');
  		  
    		if (isset($primary_links)) { 
    		  print theme('links', $primary_links, array('class' => 'links primary-links')); 
    		}    		
  		?>
    <div id="main">
    	<?php
    	  print $top;
    	  if ($title && !$node && arg(0) != 'calendar') print '<h2>'.$title.'</h2>';
    	  print $content;
    	  print $bottom;
    	?>    	
    </div>
    <div id="right-side">
    	<?php print $right?>
    </div>           
	</div>
	<div id="footer">
	 <div class="indent"><?php print $footer_message;?></div>
	</div> 
  <?php print $closure ?>
  </body>
</html>
<script>
	function clearField(obj){
		if(obj.value == "eMail address")
		obj.value = "";
	}

	function validateEmail(){
		var emailRegEx = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
		str = document.getElementById('emailField').value;
		if(str.match(emailRegEx)){
			document.mailingListForm.submit();
		}else{
			alert('Please enter a valid email address.');
			return false;
		}
	}
</script>