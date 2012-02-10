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
<html xmlns:fb="http://www.facebook.com/2008/fbml" 
                    xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php print $language->language ?>" 
                    lang="<?php print $language->language ?>" dir="<?php print $language->dir ?>">
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
    <script type="text/javascript">
 	
    	$(function() {
    		function sorttable(table, thIndex, inverse) {
        		table.find('td').filter(function(){
                    
                    return $(this).index() === thIndex;
                    
                }).sortElements(function(a, b){
                    
                    return parseInt($.text([a])) > parseInt($.text([b])) ?
                        inverse ? -1 : 1
                        : inverse ? 1 : -1;
                    
                }, function(){
                    
                    // parentNode is the element we want to move
                    return this.parentNode; 
                    
                });
            }
			$(window).load(function(){
				// Hide days_since_last_update column in product list and sort by that column
				$('.view-taxonomy-term.view-dom-id-3 td:nth-child(3)').hide();
				// Set starting sort is descreasing
				sorttable($('.view-taxonomy-term.view-dom-id-3 table'),2,false);
				$('.view-taxonomy-term .product-list-sort-newest').addClass("active");
				// Change sorting when being triggered
				$('.view-taxonomy-term .product-list-sort-newest').click(function(){
					sorttable($('.view-taxonomy-term.view-dom-id-3 table'),2,false);
					$(this).addClass("active");
					$('.view-taxonomy-term .product-list-sort-oldest').removeClass("active");
				});
				$('.view-taxonomy-term .product-list-sort-oldest').click(function(){
					sorttable($('.view-taxonomy-term.view-dom-id-3 table'),2,true);
					$(this).addClass("active");
					$('.view-taxonomy-term .product-list-sort-newest').removeClass("active");
				});
			});

			$( "#tabs" ).tabs();
    	});
    </script>
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
    	  if ($title && !$node && arg(0) != 'calendar') print '<h2>'.$title.'</h2>';
          /*esem show hints-warnings-messages, don't show for update nodes, since there is a warring showing up for them*/
          if ($show_messages && $messages && $node->type != 'update' && !$is_front): print $messages; endif;
          /*end esem*/
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
<!--esem making watermarks to login&pass input fields-->
<script type="text/javascript">
	$(function () {
		$("#name-hint").watermark("Username");
		$("#pass-hint").watermark("Password");
		// Hide the New tag if the node was posted more than one day
		$(".list-right .tags .new-tag").each(function(){
			if (!($(this).attr("title").indexOf("day") >= 0 || $(this).attr("title").indexOf("month") >= 0 || $(this).attr("title").indexOf("year") >= 0 || $(this).attr("title").indexOf("week") >= 0))
				$(this).show();
		});
		// Change the CSS of comment tag if the node has more than 0 comments
		$(".list-right .comment-tag").each(function(){
			if ($(this).find("a").text().indexOf("(0)") >= 0)
				$(this).find("a").text("Comments...");
			if ($(this).find("a").text().indexOf(".") < 0)
				$(this).addClass("more");
		});
		// Add active class to the selected year in calendar page
		$("#mactimeline-calendar-year-list li").each(function(){
			if ($("#mactimeline-year-current").text() == $(this).find("a").text() || $(this).find("a").text() == $("#main h2").text())
			{
				$(this).addClass("active");
				if ($(this).find("a").text() == $("#main h2").text()) $("#main h2").hide();
				return false;
			}
		});
		// Add tooltips for update type tags
		$(".tags .Intr").each(function(){
			$(this).attr("title", "Introduction");
			$(".tags .desc").text("Introduction");
		});
		$(".tags .Mjr").each(function(){
			$(this).attr("title", "Major Update");
			$(".tags .desc").text("Major");
		});
		$(".tags .Scd").each(function(){
			$(this).attr("title", "Secondary Update");
			$(".tags .desc").text("Secondary");
		});
		$(".tags .Mnr").each(function(){
			$(this).attr("title", "Minor Update");
			$(".tags .desc").text("Minor");
		});
		$(".tags .Note").hide();
		
		// Add vote graph
		$(".vote-graph").each(function(){
			var up = $(this).find(".vote_up_down_percent_up").text();
			$(this).find(".graph-up").css("width",up);
			var down = $(this).find(".vote_up_down_percent_down").text();
			$(this).find(".graph-down").css("width",down);
		});
		// Set width for views-field-nothing if it's the graph
		$(".views-field-nothing:has(div.vote-graph)").each(function(){
			$(this).css("width",$(this).find(".vote-graph").css("width"));
		});
		// Add "days" to day-format field
		$(".day-format").each(function(){
			if ($(this).text() == "0") $(this).text("Today")
				else if ($(this).text() == "") $(this).text("Null")
					else if ($(this).text() == "1") $(this).text($(this).text()+" day")
						else $(this).text($(this).text()+" days");
		});
		// Add the title "PRICE" into the table header in product page
		$('.product .group-prices h2').hide();
		$('.product .group-prices table').find('th').filter(function(){
                    return $(this).index() === 0;
		}).text($('.product .group-prices h2').text()).addClass("left");	

		// Change border color of product icon when hover in frontpage
		$('.view-category .views-view-grid td').hover(function(){
			$(this).find('.views-field-title').css('border-top','1px solid black');
		}, function(){
			$(this).find('.views-field-title').css('border-top','1px solid #999');
		});
	});
</script>
<!--end esem-->
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
