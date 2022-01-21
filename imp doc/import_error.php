
<?php
	if(!($mylink=mysql_connect("localhost","root","")))
	{
		print "<h3>couldnot connect database</h3>\n";
		exit;
	}
	@mysql_select_db("card_20_06", $mylink )
	or die ("unable to locate database");
	date_default_timezone_set('Asia/Dhaka');
	
?>


<?php 

include 'vendor/autoload.php';

if(isset($_FILES['input_file']['name']))
{
	$file_name= $_FILES['input_file']['name'];
	$file_path ="upload/".$_FILES['input_file']['name'];

	 move_uploaded_file($_FILES['input_file']['tmp_name'], $file_name);
	$file_type = \PhpOffice\PhpSpreadsheet\IOFactory::identify($file_name);
  $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($file_type);

    $spreadsheet = $reader->load($file_name);
	$data = $spreadsheet->getActiveSheet(1)->toArray();
	//$data = $spreadsheet->getSheetByName('FINAL')->toArray();
	$count = 0;
	
	foreach($data as $key => $val)
	{
		if($key > 0)
		{
			if(!empty($val[0])  && !empty($val[1]) )
			{
				/*echo "<pre>";
				print_r($val);
				echo "<hr>";*/

				$error_type = mysql_real_escape_string($val[0]);
				$error_code = mysql_real_escape_string($val[1]);
				$error_description = mysql_real_escape_string($val[2]);

				$insert = mysql_query("INSERT INTO cib_error (error_type, error_code, error_description ) values ('$error_type', '$error_code', '$error_description') ");

				if($insert)
				{
				  $count = $count + 1;	
				}else{

					echo "INSERT INTO cib_error (error_type, error_code, error_description ) values ('$error_type', '$error_code', '$error_description') "."<br>";
				}


			}
		}
	}
	

}


echo $count;




 ?>