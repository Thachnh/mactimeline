<?php
ob_start();
include 'library/config.php';
if(isset($_POST['request'])){
$errmsg_arr = array();
	
	//Validation error flag
	$errflag = false;

$name=$_POST['name'];
$email=$_POST['email'];
$website=$_POST['website'];
$feature=$_POST['feature'];
$description=$_POST['description'];
$title=$_REQUEST['title'];

if($name == '') {
		$errmsg_arr[] = 'Name field is required';
		$errflag = true;
	}
	
	if($email == '') {
		$errmsg_arr[] = 'Email field is required';
		$errflag = true;
	}
	if($feature == '') {
		$errmsg_arr[] = 'Feature field is required';
		$errflag = true;
	}
	if($description == '') {
		$errmsg_arr[] = ' Description field is required';
		$errflag = true;
	}
	
	if($errflag) {
		$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
		session_write_close();
		header("location: index1.php");
		exit();
	}
	
 
      
      
date_default_timezone_set('Asia/Kolkata');

$date=date("Y-m-d");
require_once "library/config.php";


$sql="INSERT INTO tbl_request ( Name,Email,Website,Feature,Description,reqdate,title) values ('$name','$email','$website','$feature','$description','$date','$title')";
$result=mysql_query($sql);
if($result) {
		function confirm($msg,$url)
{
echo "<script langauge=\"javascript\">alert(\"".$msg."\");

</script>";
echo "<script langauge=\"javascript\">window.location =(\"".$url."\");</script>";
}//end function
$msg="Succesufully Your SUBMIT FEATURE REQUEST is requested";
$url="submit_request.php";
confirm($msg,$url); 


}
}
ob_flush();
?>
