<?php include 'header.php'; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>HARDWARE</title>
<style>
.hardware{
	position:relative; TOP:170px; LEFT:55px; width:75%; 

}
</style>
</head>

<body>

<div class="hardware">
<table border="0" bgcolor="#999999" width="100%">
<tr><td align="left"  ><font  color="#FFFFFF">HARDWARE</font></td></tr></table>
<?
$string =array();
$filePath='admin/upload/hardware/';  
$dir = opendir($filePath);
while ($file = readdir($dir)) { 
   if (eregi("\.png",$file) || eregi("\.jpg",$file) || eregi("\.gif",$file) ) { 
   $string[] = $file;
$info = pathinfo($file);
$file_name =  basename($file,'.'.$info['extension']);
   $img = array_pop($string);
  echo "<a href=\"feature_request.php?title=$file_name&pre=568\"><img src='$filePath$img' alt='$file'  width='50px' border='0'/></a>";


echo $file_name;

    
   }
}


?>
</div>
</body>
</html>