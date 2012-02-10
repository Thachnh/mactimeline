<?php
if ((($_FILES["file"]["type"] == "image/gif")
|| ($_FILES["file"]["type"] == "image/jpeg")
|| ($_FILES["file"]["type"] == "image/png"))
&& ($_FILES["file"]["size"] < 100000))
  {
	if ($_FILES["file"]["error"] > 0)
		{
		echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
		}
	else
		 {

    echo "Upload: " . $_FILES["file"]["name"] . "<br />";
    echo "Type: " . $_FILES["file"]["type"] . "<br />";
    echo "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
    echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br />";
	$mylist=$_POST['mylist'];
		if($mylist=='software')
			{
			if (file_exists("upload/software/" . $_FILES["file"]["name"]))
				{
				 echo $_FILES["file"]["name"] . " already exists. ";
				 }
			else
				 {
				 move_uploaded_file($_FILES["file"]["tmp_name"],
				"upload/software/" . $_FILES["file"]["name"]);
				 echo "Stored in: " . "upload/software/" . $_FILES["file"]["name"];
                  $title=$_FILES["file"]["name"];   
				  $info = pathinfo($title);
$file_name =  basename($title,'.'.$info['extension']);
echo $file_name;
				 require_once '../library/config.php';
				 $sql="INSERT INTO tbl_images (category,parent_image) VALUES ('$mylist','$file_name')";
				$result=mysql_query($sql);
				 }
		}
		else
		{
			if (file_exists("upload/hardware/" . $_FILES["file"]["name"]))
      {
      echo $_FILES["file"]["name"] . " already exists. ";
      }
    else
      {
      move_uploaded_file($_FILES["file"]["tmp_name"],
      "upload/hardware/" . $_FILES["file"]["name"]);
      echo "Stored in: " . "upload/hardware/" . $_FILES["file"]["name"];
	    $title=$_FILES["file"]["name"];   
				  $info = pathinfo($title);
$file_name =  basename($title,'.'.$info['extension']);
echo $file_name;
				 require_once '../library/config.php';
				 $sql="INSERT INTO tbl_images (category,parent_image) VALUES ('$mylist','$file_name')";
				$result=mysql_query($sql);
      }
    }
  }
  }
else
  {
  echo "Invalid file";
  }
?> 