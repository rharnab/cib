<?php 
ini_set('max_execution_time', '0'); // for infinite time of execution 
error_reporting(0);
include("../database.php");
$count=0;

if(isset($_FILES['input_file']))
{
   $file_name = $_FILES['input_file']['name'];
   $currentStamp = date('YmdHis');
   $today = date('Y-m-d');
   //$entry_by = '10000';
   $entry_by = $_SESSION['login_id'];
   $tag = $_POST['tag'];
   $report_date = date('Y-m-d', strtotime($_POST['report_date']));

   //this month array
   $today_dt = date('Y-m', strtotime($today));
 

   //reporting month array
   $report_dt = date('Y-m', strtotime($report_date));

   //last month
   $last_month = date('Y-m', strtotime($today_dt." -1 month"));

   if(($last_month <= $report_dt) && ($report_dt < $today_dt))
   {
   	 $report_date_array = explode('-', $report_dt);
   	 $report_year =  $report_date_array[0];
   	 $report_month =  $report_date_array[1];

   	 mysql_query("DELETE  from   cl_table where month (reporting_date)='$report_month' and year (reporting_date)='$report_year' ");


    $du_sql = mysql_query("SELECT file_name from cl_table where file_name = '$file_name' ");
	$dup_result = mysql_fetch_array($du_sql);

	if($dup_result['file_name'] === $file_name)
	{
	  

	echo " Sorry this is duplicate file ";

	}else{


	  $ext = explode(".", $file_name);
	  if(( $ext[1] =='TXT' or $ext[1] =='txt') || ( $ext[1] =='ASC' or $ext[1] =='asc') )
	  {

	  		if(!file_exists('contracts'))
	  		{
	  			mkdir('contracts');
	  		}


	  		$path = "contracts/".$currentStamp.$file_name;

	  		if(move_uploaded_file($_FILES['input_file']['tmp_name'], $path))
	  		{
	  			
	  		}else{
	  			echo "Sorry file not not upload or Wrong file ";
	  		}

	          //read text file
	          //$fp = fopen($_FILES['input_file']['tmp_name'], 'r');
	          $fp = fopen($path, 'r');

	          //$array = explode("\n", fread($fp, filesize($_FILES['input_file']['tmp_name'])));
	         $array = explode("\n", fread($fp, filesize($path)));
					
					
					 $title=explode("|",  $array[9]);
					
					
					$total_row =  count($array);
					$insert_success = 0;
					for($j =12; $j < $total_row; $j++)
					{
						$exp_data = explode("|", $array[$j]);


						if($exp_data[8] && $exp_data[2] && $exp_data[33] !='')
						{
							
							

							// echo "<pre>";
							// print_r($exp_data);
							

							 list($null ,$personal_code, $client_id, $title, $customer_name, $date_of_birth, $sex, $designation, $mothers_name, $fathers_name, $resident_address, $resident_city, $resident_region, $resident_country, $correspondence_address, $correspondence_city, $correspondence_region, $correspondence_country, $office, $telephone,  $mobile_no, $email, $referenced_by, $reference, $null, $null, $national_id, $tin, $emp_id, $sector_code, $security_code, $marketed_by ,  $card_no, $card_product_name, $statement_cycle, $due_date, $branch_name, $create_date, $active_date ,$exp_date, $card_state,  $card_status, $caredit_limit_bdt, $outstanding_bdt, $suspense_profit_bdt, $unpaid_emi_bdt, $total_outstanding_bdt, $mp_due_bdt, $overdue_amt_bdt, $last_paid_amt_bdt, $last_paid_date_bdt, $caredit_limit_usd, $outstanding_usd, $suspense_profit_usd, $total_outstanding_usd, $mp_due_usd, $overdue_amt_usd, $last_paid_amt_usd, $last_paid_date_usd, $contract, $deliquency) = $exp_data;

							 



							 $personal_code= mysql_real_escape_string(trim($personal_code));
							 $client_id =mysql_real_escape_string(trim($client_id)); 
							 $title= mysql_real_escape_string(trim($title));
							 $customer_name=mysql_real_escape_string(trim($customer_name));
							 $date_of_birth=mysql_real_escape_string(trim($date_of_birth));
							 $sex=mysql_real_escape_string(trim($sex));
							 $designation=mysql_real_escape_string(trim($designation));
							 $mothers_name=mysql_real_escape_string(trim($mothers_name));
							 $fathers_name=mysql_real_escape_string(trim($fathers_name));
							 $resident_address=mysql_real_escape_string(trim($resident_address));
							 $resident_city=mysql_real_escape_string(trim($resident_city));
							 $resident_region=mysql_real_escape_string(trim(str_replace('-', '', $resident_region)));
							 $resident_country=mysql_real_escape_string(trim($resident_country));
							 $correspondence_address=mysql_real_escape_string(trim($correspondence_address));
							 $correspondence_city=mysql_real_escape_string(trim($correspondence_city));
							 $correspondence_region=mysql_real_escape_string(trim(str_replace('-', '', $correspondence_region)));
							 $correspondence_country=mysql_real_escape_string(trim($correspondence_country));
							 $office=mysql_real_escape_string(trim($office));
							 $telephone= mysql_real_escape_string(trim(str_replace("(", "", str_replace(")", "", substr($telephone, 4))))); 
							 $mobile_no=mysql_real_escape_string(trim(str_replace("(", "", str_replace(")", "", substr($mobile_no, 4)))));
							 $email=mysql_real_escape_string(trim($email));
							 $referenced_by=mysql_real_escape_string(trim($referenced_by));
							 $reference=mysql_real_escape_string(trim($reference));
							 $passport_no=mysql_real_escape_string(trim($passport_no));
							 $national_id=mysql_real_escape_string(trim($national_id));
							 $tin=mysql_real_escape_string(trim($tin));
							 $emp_id=mysql_real_escape_string(trim($emp_id));
							 $sector_code=mysql_real_escape_string(trim($sector_code));
							 $security_code=mysql_real_escape_string(trim($security_code));
							 $marketed_by = mysql_real_escape_string(trim($marketed_by));
							 $card_no=mysql_real_escape_string(trim($card_no));
							 $card_product_name =mysql_real_escape_string(trim($card_product_name));
							 $statement_cycle =mysql_real_escape_string(trim($statement_cycle));
							 $due_date =mysql_real_escape_string(trim($due_date));
							 $branch_name =mysql_real_escape_string(trim($branch_name));
							 $create_date= mysql_real_escape_string(trim($create_date));
							 $active_date= mysql_real_escape_string(trim($active_date));
							 $exp_date = mysql_real_escape_string(trim($exp_date));
							 $card_state = mysql_real_escape_string(trim($card_state));
							 $card_status= mysql_real_escape_string(trim($card_status));
							 $caredit_limit_bdt= trim(str_replace(",", "", str_replace("-","", $caredit_limit_bdt)));
							 $outstanding_bdt= trim(str_replace(',', '', str_replace("-","", $outstanding_bdt)));
							 $suspense_profit_bdt= trim(str_replace(',', '', str_replace("-","", $suspense_profit_bdt)));
							 $unpaid_emi_bdt= trim(str_replace(",", '', str_replace("-","", $unpaid_emi_bdt)));
							 $total_outstanding_bdt= trim(str_replace(',', '', str_replace("-","", $total_outstanding_bdt)));
							 $mp_due_bdt= trim(str_replace(',', '', str_replace("-","", $mp_due_bdt)));
							 $overdue_amt_bdt= trim(str_replace(',', '', str_replace("-","", $overdue_amt_bdt)));
							 $last_paid_amt_bdt= trim(str_replace(',', '', str_replace("-","", $last_paid_amt_bdt)));
							 $last_paid_date_bdt= trim(str_replace(',', '', str_replace("-","", $last_paid_date_bdt)));

							 $caredit_limit_usd= trim(str_replace(',', '', str_replace("-","", $caredit_limit_usd)));
							 $outstanding_usd= trim(str_replace(',', '', str_replace("-","", $outstanding_usd)));
							 $suspense_profit_usd= trim(str_replace(',', '', str_replace("-","", $suspense_profit_usd)));
							 $total_outstanding_usd= trim(str_replace(',', '', str_replace("-","", $total_outstanding_usd)));
							 $mp_due_usd= trim(str_replace(',', '', str_replace("-","", $mp_due_usd)));
							 $overdue_amt_usd= trim(str_replace(',', '', str_replace("-","", $overdue_amt_usd)));
							 $last_paid_amt_usd=trim(str_replace(',', '', str_replace("-","", $last_paid_amt_usd)));
							 $last_paid_date_usd= trim(str_replace(',', '', str_replace("-","", $last_paid_date_usd)));

							  $contract= mysql_real_escape_string(trim($contract));
							  $deliquency= mysql_real_escape_string(trim($deliquency));
							

							 $insert = mysql_query("INSERT INTO `cl_table`(`personal_code`, `client_id`, `title`, `customer_name`, `dath_of_birth`, `sex`, `designation`, `mothers_name`, `fathers_name`, `resident_address`, `resident_city`, `resident_region`, `resident_country`, `correspondence_address`, `correspondence_city`, `correspondence_region`, `correspondence_country`, `office`, `telephone`, `mobile_no`, `email`, `referenced_by`, `reference`, `national_id`, `tin`, `emp_id`, `sector_code`, `security_code`, `marketed_by`, `card_no`, `card_product_name`, `statement_cycle`, `due_date`, `branch_name`, `create_date`, `active_date`, `exp_date`, `card_state`, `card_status`, `caredit_limit_bdt`, `outstanding_bdt`, `suspense_profit_bdt`, `unpaid_emi_bdt`, `total_outstanding_bdt`, `mp_due_bdt`, `overdue_amt_bdt`, `last_paid_amt_bdt`, `last_paid_date_bdt`, `caredit_limit_usd`, `outstanding_usd`, `suspense_profit_usd`, `total_outstanding_usd`, `mp_due_usd`, `overdue_amt_usd`, `last_paid_amt_usd`, `last_paid_date_usd`, `contract`, `deliquency`, `entry_by`, `entry_date`, `file_name`, `tag`,`reporting_date`,`status`) VALUES ('$personal_code', '$client_id', '$title', '$customer_name', '$date_of_birth', '$sex', '$designation', '$mothers_name', '$fathers_name', '$resident_address', '$resident_city', '$resident_region', '$resident_country', '$correspondence_address', '$correspondence_city', '$correspondence_region', '$correspondence_country', '$office', '$telephone',  '$mobile_no', '$email', '$referenced_by', '$reference', '$national_id', '$tin', '$emp_id', '$sector_code', '$security_code', '$marketed_by' ,  '$card_no', '$card_product_name', '$statement_cycle', '$due_date', '$branch_name', '$create_date', '$active_date' , '$exp_date', '$card_state',  '$card_status', '$caredit_limit_bdt', '$outstanding_bdt', '$suspense_profit_bdt', '$unpaid_emi_bdt', '$total_outstanding_bdt', '$mp_due_bdt', '$overdue_amt_bdt', '$last_paid_amt_bdt', '$last_paid_date_bdt', '$caredit_limit_usd', '$outstanding_usd', '$suspense_profit_usd', '$total_outstanding_usd', '$mp_due_usd', '$overdue_amt_usd', '$last_paid_amt_usd', '$last_paid_date_usd', '$contract', '$deliquency', '$entry_by', '$today', '$file_name', '$tag', '$report_date','0')");




							 if($insert)
							 {
							 	 $sql = mysql_query("INSERT INTO `card_close`(`personal_code`, `client_id`, `title`, `customer_name`, `dath_of_birth`, `sex`, `designation`, `mothers_name`, `fathers_name`, `resident_address`, `resident_city`, `resident_region`, `resident_country`, `correspondence_address`, `correspondence_city`, `correspondence_region`, `correspondence_country`, `office`, `telephone`, `mobile_no`, `email`, `referenced_by`, `reference`, `national_id`, `tin`, `emp_id`, `sector_code`, `security_code`, `marketed_by`, `card_no`, `card_product_name`, `statement_cycle`, `due_date`, `branch_name`, `create_date`, `active_date`, `exp_date`, `card_state`, `card_status`, `caredit_limit_bdt`, `outstanding_bdt`, `suspense_profit_bdt`, `unpaid_emi_bdt`, `total_outstanding_bdt`, `mp_due_bdt`, `overdue_amt_bdt`, `last_paid_amt_bdt`, `last_paid_date_bdt`, `caredit_limit_usd`, `outstanding_usd`, `suspense_profit_usd`, `total_outstanding_usd`, `mp_due_usd`, `overdue_amt_usd`, `last_paid_amt_usd`, `last_paid_date_usd`, `contract`, `deliquency`, `entry_by`, `entry_date`, `file_name`, `tag`,`reporting_date`,`status`) VALUES ('$personal_code', '$client_id', '$title', '$customer_name', '$date_of_birth', '$sex', '$designation', '$mothers_name', '$fathers_name', '$resident_address', '$resident_city', '$resident_region', '$resident_country', '$correspondence_address', '$correspondence_city', '$correspondence_region', '$correspondence_country', '$office', '$telephone',  '$mobile_no', '$email', '$referenced_by', '$reference', '$national_id', '$tin', '$emp_id', '$sector_code', '$security_code', '$marketed_by' ,  '$card_no', '$card_product_name', '$statement_cycle', '$due_date', '$branch_name', '$create_date', '$active_date' , '$exp_date', '$card_state',  '$card_status', '$caredit_limit_bdt', '$outstanding_bdt', '$suspense_profit_bdt', '$unpaid_emi_bdt', '$total_outstanding_bdt', '$mp_due_bdt', '$overdue_amt_bdt', '$last_paid_amt_bdt', '$last_paid_date_bdt', '$caredit_limit_usd', '$outstanding_usd', '$suspense_profit_usd', '$total_outstanding_usd', '$mp_due_usd', '$overdue_amt_usd', '$last_paid_amt_usd', '$last_paid_date_usd', '$contract', '$deliquency', '$entry_by', '$today', '$file_name', '$tag', '$report_date','0')");

							 	$insert_success +=1;
							 }
							

						}

						
					}

					

	                //end read text file

	           

	        }else{
	          echo "File must be txt file";
	        }

	         print "$insert_success Data imported ";
	  

		}

   }else{
   		echo "PLEASE SELECT PREVIOUS MONTH FOR REPORTING DATE";
   }





  
   }


 ?>