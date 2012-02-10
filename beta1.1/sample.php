
<!DOCTYPE html>

<html>

<!--
	This is a jQuery Tools standalone demo. Feel free to copy/paste.
	                                                         
	http://flowplayer.org/tools/demos/
	
	Do *not* reference CSS files and images from flowplayer.org when in production  

	Enjoy!
-->

<head>
	<title>jQuery Tools standalone demo</title>

	<!-- include the Tools -->
	<script src="http://cdn.jquerytools.org/1.2.5/full/jquery.tools.min.js"></script>

	 

	<!-- standalone page styling (can be removed) -->
	<link rel="stylesheet" type="text/css" href="http://static.flowplayer.org/tools/css/standalone.css"/>	


	<link rel="stylesheet" type="text/css" href="http://static.flowplayer.org/tools/css/overlay-apple.css"/>
	
	<style>
	
	/* use a semi-transparent image for the overlay */
	#hide {
   position:absolute;
   z-index:9000;
   background-color:#000;
   display:none;
 }

 #container .window {
   position:absolute;
   width:440px;
   height:200px;
   display:none;
   z-index:9999;
   padding:20px;
 }


 /* Customize your modal window here, you can add background image too */
 #container #openbox {
   width:375px;
   height:203px;
 }
	</style>
	
</head>

<body>



<a name="modalwindow" href="#open">Open</a>

<div>

     <!--You easily customize your window here -->

<div class="window">
         <strong>Testing of Modal Window</strong> |

         <!-- close button is defined as close window -->
         <a class="close" href="#">Close window</a>

</div>

     <!-- Do not remove div#hide, because you shall need it to fill the whole screen -->

</div>
<!-- make all links with the 'rel' attribute open overlays -->
<script>

$(document).ready(function() {

     //select all the a tag with name equal to modalwindow
     $('a[name=modalwindow]').click(function(e) {
         //Cancel the link behavior
         e.preventDefault();
         //Get the A tag
         var id = $(this).attr('href');

         //Get the screen height and width
         var hideHeight = $(document).height();
         var hideWidth = $(window).width();

         //Set heigth and width to hide to fill up the whole screen
         $('#hide').css({'width':hideWidth,'height':hideHeight});

         //transition effect
         $('#hide').fadeIn(1000);
         $('#hide').fadeTo("slow",0.8);

         //Get the window height and width
         var winH = $(window).height();
         var winW = $(window).width();

         //Set the popup window to center
         $(id).css('top',  winH/2-$(id).height()/2);
         $(id).css('left', winW/2-$(id).width()/2);

         //transition effect
         $(id).fadeIn(2000);

     });

     //if close button is clicked
     $('.window .close').click(function (e) {
         //Cancel the link behavior
         e.preventDefault();
         $('#hide, .window').hide();
     });

     //if hide is clicked
     $('#hide').click(function () {
         $(this).hide();
         $('.window').hide();
     });

 });

</script>

</body>

</html>
