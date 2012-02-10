<html>
<body>

<form action="upload_file.php" method="post"
enctype="multipart/form-data">
<label>Category</label>
<SELECT NAME="mylist">
<OPTION VALUE="software">Software</option>
<OPTION VALUE="hardware">Hardware</option>
</SELECT>
 
<label for="file">Image :</label>
<input type="file" name="file" id="file" />
<br />
<input type="submit" name="submit" value="Submit" />
</form>

</body>
</html>
<?
$pattern="(\.jpg$)|(\.png$)|(\.jpeg$)|(\.gif$)"; //valid image extensions
$files = array();
$curimage=0;
if($handle = opendir('upload/software/')) {
while(false !== ($file = readdir($handle))){
if(eregi($pattern, $file)){ //if this file is a valid image
//Output it as a JavaScript array element
echo $file;
echo '<img src="'.$file .'" width="150" height="150">';
$curimage++;
}
}

closedir($handle);
}
?> 