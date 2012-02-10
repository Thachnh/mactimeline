<?php include 'header.php'; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Mactimeline</title>
<style type="text/css">
.three{
	position:relative; TOP:170px; LEFT:55px; width:75%; 

}
.four{
	position:relative; TOP:250px; LEFT:55px; width:75%; 

}
</style>
</head>

<body>

<div class="three">
<table border="0" bgcolor="#999999" width="100%">
<tr><td align="left"  ><font  color="#FFFFFF">SOFTWARES</font></td></tr></table>
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
$sql="select parent_image from tbl_images where category='software'";
$result=mysql_query($sql);
$count=mysql_num_rows($result);
while($row=mysql_fetch_array($result,MYSQL_ASSOC))
	   {
		  
	if($row['parent_image']==$file_name)
		   {

		?>
		<table border="0">
<tr><td align="left"><?$img = array_pop($string);
  echo "<a href=\"feature_request.php?title=$file_name\"><img src='$filePath$img' alt='$file'   border='0'/></a>"; ?></td>
 <td><? echo $file_name; ?></td></tr></table><?
		   
		   }
		   
	   }   }
   }




?>
</div>
<div class="four">
<table border="0" bgcolor="#999999" width="100%">
<tr><td align="left"  ><font  color="#FFFFFF">HARDWARE</font></td></tr></table>
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
$sql="select parent_image from tbl_images where category='hardware'";
$result=mysql_query($sql);
$count=mysql_num_rows($result);
while($row=mysql_fetch_array($result,MYSQL_ASSOC))
	   {

		
	if($row['parent_image']==$file_name)
		   {

		?>
		<table border="0">
<tr><td align="left"><?$img = array_pop($string);
  echo "<a href=\"feature_request.php?title=$file_name\"><img src='$filePath$img' alt='$file'   border='0'/></a>"; ?></td>
 <td><? echo $file_name; ?></td></tr></table><?
		   
		   }
	   }   }
   }




?>

</div>
<?php include 'footer.php';?>
</body>
</html>