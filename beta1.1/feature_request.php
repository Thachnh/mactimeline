<?php
include 'header.php';
$title=$_GET['title'];
$pre=$_GET['pre'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><? echo $title;?>|Mactimeline</title>

</head>

<body>
<div class="content">
<h1><? echo $title; ?></h1>
<?

	
$string =array();
$filePath='admin/upload/';  
$dir = opendir($filePath);
while ($file = readdir($dir)) { 
   if (eregi("\.png",$file) || eregi("\.jpg",$file) || eregi("\.gif",$file) ) { 
   $string[] = $file;
   $info = pathinfo($file);
$file_name =  basename($file,'.'.$info['extension']);

if($title==$file_name){
   $img = array_pop($string);
  echo "<img src='$filePath$img' alt='$file'  width='70px' border='0'/>";
  

	   }
   }
}

?>
</div>
<div class="main">
<table border="0" bgcolor="#999999" width="50%">
<tr><td align="left"  ><font  color="#FFFFFF">FEATURE REQUEST</font></td><td align="right"><font  color="#FFFFFF"><a href="index1.php?title=<? echo $title; ?>">SUBMIT FEATURE REQUEST</a></font></td></tr></table>


 <table  width="581" border="0" >
         
	    <?php 
			require_once 'library/config.php';
			 $num_displayed=10;
			 $color1 = "#FFFFFF"; 
$color2 = "#e8e8e8"; 
$row_count = 0; 
	$sql="SELECT rno,Feature,Description,Pvote, Nvote from tbl_request where title='$title' ORDER BY Pvote DESC LIMIT $num_displayed   ";
	$result=dbQuery($sql);
	while ($row = mysql_fetch_assoc($result)) {
		$row_color = ($row_count % 2) ? $color1 : $color2; 
print "<tr><td bgcolor=".$row_color.">$row[Feature],</td>";
$area=substr($row['Description'],0,5);
print "<td bgcolor=".$row_color.">$area</td>";
print "<td bgcolor=".$row_color.">$row[Pvote]</td><td bgcolor=".$row_color."><a href=\"positivecounter.php?rno=".$row['rno']."&title=".$title."\"><img src=\"images/positive.jpg\" border='0'></a></td>";
print "<td bgcolor=".$row_color.">$row[Nvote]</td><td bgcolor=".$row_color."><a href=\"negativecounter.php?rno=".$row['rno']."&title=".$title."\"><img src=\"images/negative.jpg\" border='0'></a></td></tr>";
$row_count++; 
}
?>
</div>
<div class="main">
<table border="0" bgcolor="#999999" width="50%">
<tr><td align="left"  ><font  color="#FFFFFF">IMAGES(11)</font></td><td align="right"><font  color="#FFFFFF"><a href="image_upload.php?title=<? echo $title; ?>">SUBMIT IMAGE</a></font></td></tr></table>
<?
$string =array();
$filePath='admin/upload/';  
$dir = opendir($filePath);
while ($file = readdir($dir)) { 
   if (eregi("\.png",$file) || eregi("\.jpg",$file) || eregi("\.gif",$file) ) { 
  
   $info = pathinfo($file);
$file_name =  basename($file,'.'.$info['extension']);
 $string[] = $file;
require_once 'library/config.php';
$sql="select image from tbl_child_images where title='$title'";
$result=mysql_query($sql);
$count=mysql_num_rows($result);
while($row=mysql_fetch_array($result,MYSQL_ASSOC))
	   {
		  
	if($row['image']==$file_name)
		   {

		?>
		<table border="0">
<tr><td align="left"><?$img = array_pop($string);
  echo "<img src='$filePath$img' alt='$file'   border='0'/>"; ?></td>
 </tr></table><?
		   
		   }
		   
	   }   }
   }




?>
</div>

</body>
</html>