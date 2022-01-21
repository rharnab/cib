<?php include("../../database.php");?>

<?php 

$id =  $_POST['id'];
$status= $_POST['status'];

if($status == '0')
{
	$error_code = $_POST['error_code'];
}else{
	$error_code='';
}

$result=mysql_query("UPDATE subject_info set status='$status', error_code='$error_code' where id='$id'  ");
if($result)
{
echo  1;
}else{
echo "SORRY NOT UPDATE";
}

 ?>