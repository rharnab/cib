<?php 

if(isset($_POST['download']))
{
	$reporting_date = $_POST['report_date'];
	$download_type = $_POST['download_type'];

	if($download_type == 0)
	{
		$url = 'privious_month_download_Xl.php?reporting_date='.$reporting_date;
		header("Location: $url");
	}else if($download_type == 1){

		$url = 'previous_month.php?reporting_date='.$reporting_date;
		header("Location: $url");
	}else{

	}
	
}else{
	echo  "no";
}


 ?>