
<?php include("../../database.php"); ?>

<?php
/*if(isset($_POST['submit']))
{
*/	 
	 $subject_file = $_FILES['subject_file']['name'];
	 $contract_file = $_FILES['contract_file']['name'];

	 $subject_extension  = pathinfo($subject_file, PATHINFO_EXTENSION);
	 $contract_file  = pathinfo($contract_file, PATHINFO_EXTENSION);
	 //echo "<pre>";

	 if(($subject_extension == 'txt' || $subject_extension == 'Txt') && ($contract_file == 'txt' || $contract_file == 'Txt'))
	 {
	 	########################################## Subject info #######################################################
	 	   $fileopen = fopen($_FILES['subject_file']['tmp_name'], 'r');
	 	   $file_read= explode("\n", fread($fileopen, filesize($_FILES['subject_file']['tmp_name'])));
	 	   $fi_subjec_code_array =array();
	 	   

	 	   $reporting_date = substr($file_read[0], 4, 8);
	 	    $month = substr($reporting_date, 2, 2);
	 	    $year = substr($reporting_date, 4, 4);


	 	   /*fi_subject_code form file push in array*/
	 	   foreach ($file_read as $key => $value) {
	 	   	   if($key > 0 )
	 	   	   {
	 	   	   		
	 	   	   		 $record_type = substr($value, 0, 1);
	 	   	   		 if($record_type == 'P')
	 	   	   		 {
	 	   	   		 	$fi_subject_code = trim(substr($value, 8, 16));

	 	   	   		 	echo $fi_subject_code.",<br>";
	 	   	   		 }

	 	   	   		 
	 	   	   		

	 	   	   }
	 	   }


	 	   die;

	 	   
	 	   /*end fi_subject_code form file push in array*/

	 	 /* $fi_subject_code_list = implode(',', $fi_subjec_code_array);
	 	  $subject_query= mysql_query("SELECT count(fi_subject_code) as total_subjects from subject_info where fi_subject_code in ($fi_subject_code_list) and year(reporting_date)='$year' and month(reporting_date) = '$month' and status ='1' ");

	 	  $total_subjects = count($fi_subjec_code_array);
	 	 //update status for subject
	 	  $result =mysql_fetch_array($subject_query);
	 	  if($result !='')
	 	  {
	 	  	 if($result['total_subjects'] == $total_subjects)
	 	  	 {

	 	  	 	mysql_query("UPDATE subject_info set status='2' where fi_subject_code in ($fi_subject_code_list) and year(reporting_date)='$year' and month(reporting_date) = '$month' and status ='1' ");

	 	  	 }else{
	 	  	 	$total_subjects= 0;
	 	  	 }
	 	  	 
	 	  }*/
	 	########################################## end  Subject info ##################################################

	 	  
	 	########################################## contracts info #######################################################
	 	   $fileopen = fopen($_FILES['contract_file']['tmp_name'], 'r');
	 	   $file_read= explode("\n", fread($fileopen, filesize($_FILES['contract_file']['tmp_name'])));
	 	   $fi_subjec_code_for_contracts =array();
	 	   $reporting_date = substr($file_read[0], 4, 8);
	 	    $month = substr($reporting_date, 2, 2);
	 	    $year = substr($reporting_date, 4, 4);

	 	   foreach($file_read as $key => $value)
	 	   {
	 	   		if($key > 0)
	 	   		{
	 	   			 $record_type  = substr($value, 0, 1);
	 	   			 if($record_type =='D')
	 	   			 {
	 	   			 	 $con_fi_subject_code = trim(substr($value, 8, 16));
	 	   			 	 array_push($fi_subjec_code_for_contracts, $con_fi_subject_code);
	 	   			 	
	 	   			 }
	 	   			
	 	   			

	 	   		}
	 	   		
	 	   }



	 	   /*$con_fi_subject_list = implode(',', $fi_subjec_code_for_contracts);
	 	   $contract_query =mysql_query("SELECT count(fi_subject_code) as total_contracts from contracts_info where fi_subject_code in ($con_fi_subject_list) and year(reporting_date)='$year' and month(reporting_date) = '$month' and status ='1' ");


	 	   

	 	   $total_contracts = count($fi_subjec_code_for_contracts);

	 	   $contract_result  = mysql_fetch_array($contract_query);

	 	   if(!empty($contract_result))
	 	   {
	 	   		if($contract_result['total_contracts'] == $total_contracts)
	 	   		{

	 	   			mysql_query("UPDATE contracts_info set status='2' where fi_subject_code in ($con_fi_subject_list) and year(reporting_date)='$year' and month(reporting_date) = '$month' and status ='1' ");
	 	   		}else{

	 	   			$total_contracts = 0;
	 	   		}

	 	   	 	
	 	   }*/
	 	   

	 	 ########################################## end  contracts info ##################################################

	 }else{
	 	echo 'SORRY ONLY TEXT FILE IS ALLOWED';
	 }

//}


/*if((!empty($fi_subjec_code_array)) && (!empty($fi_subjec_code_for_contracts)))
{
	//remove array data
	foreach($fi_subjec_code_array as $key => $fi_subject_code)
	{
		
		unset($fi_subjec_code_array[$key]);
	}
	foreach($fi_subjec_code_for_contracts as $key => $fi_subject_code)
	{
		
		unset($fi_subjec_code_for_contracts[$key]);
	}

}*/



//echo "YOUR ".$total_subjects." SUBJECTS and  ".$total_contracts ." CONTRACTS UPDATED ";


 ?>