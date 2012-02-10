<?php
	session_start();
	$title=$_GET['title'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SUBMIT REQUEST FEATURE</title>
</head>

<body>
<?php include 'header.php'; ?>
<form action="submit_request_action.php" method="post" id="f1" enctype="multipart/form-data">
<table border="0" bgcolor="#999999" width="100%">
<tr><td align="left" width="100%" ><font  color="#FFFFFF">SUBMIT FEATURE REQUEST</font></td></tr></table>
<?php
	if( isset($_SESSION['ERRMSG_ARR']) && is_array($_SESSION['ERRMSG_ARR']) && count($_SESSION['ERRMSG_ARR']) >0 ) {
		echo '<ul class="err">';
		foreach($_SESSION['ERRMSG_ARR'] as $msg) {
			echo '<li>',$msg,'</li>'; 
		}
		echo '</ul>';
		unset($_SESSION['ERRMSG_ARR']);
	}
?>
<table border="0">
<tr>
<td>
<label id="name">Name*</label></td>
<td><input type="text" name="name" id="name" /></td></tr>
<tr><td>
<label id="name">Email*</label></td>
<td><input type="text" name="email" id="email" /></td></tr>
<tr><td>
<label id="name">Website</label></td>
<td><input type="text" name="website" id="website" /></td></tr>
<tr><td>
<label id="name">Feature*</label></td>
<td><input type="text" name="feature" id="feature" /></td></tr>
<tr>
<td><label id="name">Mockup or Concept image</label></td>
<td><input type="file" name="imgfile" accept="image/jpeg"/></td>
<tr>
<td>
<label id="name">Feature Decription*</label></td>
<td><textarea name="description" id="description" rows="8" cols="30"></textarea></td></tr>
<tr><td align="right"><input type="submit" name="request" id="request" value="Submit Feature Request" /> </td>
<input type="hidden" name="title" id="title" value="<? echo $title; ?>"/></tr>
</table>

</form>
</body>
</html>