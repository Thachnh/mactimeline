<?php

require_once 'library/config.php';

//Get ID
$id = $_GET['rno'];
$title=$_GET['title'];
//Update clicks
$sql="UPDATE tbl_request SET Nvote=Nvote+1 WHERE rno='$id'";
$result=dbQuery($sql);
if($result){
	
//Redirect to URL
header ("Location: feature_request.php?title=$title");

}

?> 