<?php include("../../database.php") ?>

<?php 
if(isset($_POST['id']))
{
	  $id = $_POST['id'];
	  $column_name = $_POST['column_name'];
	  $column_value = $_POST['column_value'];
	  if($column_name == 'actual_end_date_of_the_contract')
	  {
	  	// $column_value = date('d/m/Y', strtotime($column_value));
	  	  $end_date = explode('/', $column_value);

	  	  if(isset($end_date[1]))
	  	  {
	  	  	 $column_value = $end_date[1].'/'.$end_date[0].'/'.$end_date[2];	
	  	  }else{

	  	  	 echo "DATE FORMATE NOT VALID PLEASE TYPE THIS FORMAT MM/DD/YY"; die;
	  	  }
	  	 

	  	 


	  	 
	  }

	 
	 $update = mysql_query("UPDATE contracts_info set $column_name = '$column_value' where id='$id'");
	 if($update)
	 {
	 	echo true;
	 }else{
	 	echo  "Error ! Failed To Update.";
	 }
	

}

 ?>