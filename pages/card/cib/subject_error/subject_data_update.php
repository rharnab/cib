<?php include("../../database.php");?>
<?php 

	$id =  $_POST['id'];
	$status = $_POST['status'];

	$result=mysql_query("UPDATE subject_info set status='$status' where id='$id' ");
	if($result)
	{
		echo  1;
	}else{
		echo "SORRY NOT UPDATE";
	}


 ?>