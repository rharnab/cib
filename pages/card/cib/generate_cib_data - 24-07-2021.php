<?php include('../database.php'); ?>
<?php include('cib_common.php'); ?>


<?php 
  $report_date = $_POST['cib_date'];
  $report_date= date('Y-m', strtotime($report_date."-1 month"));
 $date_array = explode('-', $report_date);
 $report_year = $date_array[0];
 $report_month = $date_array[1];




/*cib generate data remove*/

/* $subject_dup = mysql_query("SELECT reporting_date from subject_info si where year(reporting_date)='$report_year' and month(reporting_date)='$report_month' limit 1");
$subject_result  = mysql_fetch_array($subject_dup);


$contracts_dup = mysql_query("SELECT reporting_date from contracts_info ci where year(reporting_date)='$report_year' and month(reporting_date)='$report_month' limit 1");
$contracts_result  = mysql_fetch_array($contracts_dup);

if($subject_result !='' &&  $contracts_result !='')
{
   mysql_query("TRUNCATE table  subject_info ");
   mysql_query("TRUNCATE table  contracts_info ");
   
}*/
/*end cib generate data remove*/


 mysql_query("TRUNCATE table  subject_info ");
 mysql_query("TRUNCATE table  contracts_info ");


//cl file check
$cl_file = mysql_query("SELECT reporting_date from cl_table ct where year(reporting_date)='$report_year' and month(reporting_date)='$report_month' limit 1");
$cl_file_result = mysql_fetch_array($cl_file);



if($cl_file_result == '')
{
	echo "SORRY CL FILE NOT IMPORT YET FOR THIS CIB REPORT";

}else{
	
	//crate data for cib

$mis_query = mysql_query("SELECT title, customer_name, dath_of_birth, fathers_name, mothers_name, sex, national_id, tin, mobile_no, reporting_date, client_id, file_name, resident_address, resident_city,resident_region,resident_country from cl_table mt where year(reporting_date)='$report_year' and month(reporting_date)='$report_month'");


$suject_insert =0;
$contracts_insert =0;
$duplicat_fi_subject_code=0;
$field_error_count = 0;
if(mysql_num_rows($mis_query) > 0)
{
	while($mis_result = mysql_fetch_array($mis_query))
	{
		

		if($mis_result['national_id'] !='')
		{


			if(strlen($mis_result['national_id']) ==17 )
			{
								
				  $full_nid_number = $mis_result['national_id'];

				  $nid_13 = substr($full_nid_number, 4);
				
			}
			else if(strlen($mis_result['national_id']) == 13){

				  if($mis_result['dath_of_birth'] !='')
				  {

					  $birth_array = explode("/", $mis_result['dath_of_birth']); 
					  $birth_year = $birth_array[2];
					  $full_nid_number = $birth_year.$mis_result['national_id'];

				  }else{
				  	$full_nid_number ='';
				  }
				  
				  
			}
			else if(strlen($mis_result['national_id']) == 10){

				  if($mis_result['dath_of_birth'] !='')
				  {

					  $birth_array = explode("/", $mis_result['dath_of_birth']); 
					  $birth_year = $birth_array[2];
					  $full_nid_number = $birth_year.$mis_result['national_id'];

				  }else{
				  	$full_nid_number ='';
				  }
				  
				  
			}

			if(strlen($mis_result['national_id']) == 13 )
			{

				 $nid_13 = $mis_result['national_id'];

			}else if(strlen($mis_result['national_id']) == 10){
				$nid_13 = $mis_result['national_id'];
			}

			$is_nid = '1';

		}else{
			$full_nid_number = '';
			$nid_13 ='';
			$is_nid='0';
		}

		/*if($mis_result['national_id'] !='')
		{
			 $national_id = $mis_result['national_id'];
			 $full_nid_number  =  $mis_result['national_id'];
			 $nid_13 =  $mis_result['national_id'];
			 $is_nid = '1';

		}else{
			
			$full_nid_number = '';
			$nid_13 ='';
			$is_nid='0';
		}*/

			$id_type ='';
		    $id_nr = '';
		


		

		
		$reporting_date = $mis_result['reporting_date'];

		$record_type = 'P';
		$fi_code = '077';
		$acc_date = date('Y-m-t', strtotime($mis_result['reporting_date']));
		$production_date = '';
		$code_link = '';
		$branch_code = '0014';
		$fi_subject_code = $mis_result['client_id'];
		$title = mysql_real_escape_string($mis_result['title']);
		$name = mysql_real_escape_string($mis_result['customer_name']);
		$fathers_title ='';
		$fathers_name = mysql_real_escape_string($mis_result['fathers_name']);
		$mothers_title='';
		$mothers_name = mysql_real_escape_string($mis_result['mothers_name']);
		$spouse_title='';
		$spouse='';
		$sector_type ='9';
		//from function
		$sector_code = fetch_sector_list();
		//$sector_code =911000;

		$gender= $mis_result['sex'];
		$dath_of_brth = $mis_result['dath_of_birth'];
		$place_of_birth= '';
		$country_of_birth='BD';
		 
		$tin_number = $mis_result['tin'];
		$tin_number = preg_replace('/[^0-9]/', '', $tin_number);

		$parmanent_street = mysql_real_escape_string($mis_result['resident_address']);
		$parmanent_postal_code ='0000';
		$parmanent_district = mysql_real_escape_string(str_replace('-', '', $mis_result['resident_region']));
		$parmanent_country_code ='BD';
		$additional_street ='';
		$additional_postal_code ='0000';
		$additional_district ='';
		$additional_country_code ='';

		$business_address ='';
		$business_postal_code ='0000';
		$business_district ='';
		$business_country_code ='';
		
		$id_issue_date = '';
		$id_issue_country_code = '';
		$phone_number = $mis_result['mobile_no'];

		
		//mis file name 
		$mis_file_name = $mis_result['file_name'];
		
		// 40

		/*update fi_subject_code from floora cbs*/
		/*$nid_number = $mis_result['national_id']; 
		$full_nid_number_for_floora = $full_nid_number;
		$customer_id =flora_fi_subject_code($nid_number);
		 
		if(!empty($customer_id))
		{
			  $fi_subject_code = $customer_id;
		}else if (empty($customer_id)){

			$customer_id =flora_fi_subject_code($full_nid_number_for_floora);

			if(!empty($customer_id))
			{
				$fi_subject_code =  $customer_id;
			}else{
				$fi_subject_code = $mis_result['client_id'];
			}	
			 

		}*/

		$card_fi_sub = $mis_result['client_id'];
		/*end update fi_subject_code from floora cbs*/

		$duplicate_sub_query=mysql_query("SELECT fi_subject_code, card_fi_sub from subject_info where (fi_subject_code = '$fi_subject_code' or card_fi_sub='$card_fi_sub') ");
		$dup_subject_result= mysql_fetch_array($duplicate_sub_query);

		if(empty($dup_subject_result ))
		{
		   /*find archive subject info*/ 
		   $archive_sql= mysql_query("SELECT fi_subject_code from subject_info_archive where status ='1' and card_fi_sub = '$card_fi_sub'");
		   $archive_result= mysql_fetch_assoc($archive_sql);
		   if(!empty($archive_result))
		   {
		   	 $sts = '2';
		   }else{
		   	 $sts = '1';
		   }
		   /*find archive subject info*/ 

			$subject_query = mysql_query("INSERT INTO `subject_info`(`record_type`, `fi_code`, `acc_date`, `production_date`, `code_link`, `branch_code`, `fi_subject_code`, `title`, `name`, `fathers_title`, `fathers_name`, `mothers_title`, `mothers_name`, `spouse_title`, `spouse`, `sector_type`, `sector_code`, `gender`, `dath_of_brth`, `place_of_birth`, `country_of_birth`, `nid_number`, `is_nid`, `tin_number`, `parmanent_street`, `parmanent_postal_code`, `parmanent_district`, `parmanent_country_code`, `additional_street`, `additional_postal_code`, `additional_district`, `additional_country_code`, `id_type`, `id_nr`, `id_issue_date`, `id_issue_country_code`, `phone_number`, `full_nid_number`, `reporting_date`, `status`, `card_fi_sub`,`business_address`, `business_postal_code`, `business_district`, `business_country_code`) VALUES ('$record_type', '$fi_code', '$acc_date', '$production_date', '$code_link','$branch_code', '$fi_subject_code', '$title', '$name', '$fathers_title', '$fathers_name', '$mothers_title', '$mothers_name', '$spouse_title', '$spouse', '$sector_type', '$sector_code', '$gender', '$dath_of_brth', '$place_of_birth', '$country_of_birth', '$nid_13', '$is_nid', '$tin_number', '$parmanent_street', '$parmanent_postal_code', '$parmanent_district', '$parmanent_country_code', '$additional_street', '$additional_postal_code', '$additional_district', '$additional_country_code', '$id_type', '$id_nr', '$id_issue_date', '$id_issue_country_code', '$phone_number', '$full_nid_number', '$reporting_date', '$sts','$card_fi_sub', '$business_address', '$business_postal_code', '$business_district', '$business_country_code')");


			if($subject_query)
			{
				$suject_insert =  $suject_insert + 1;
				
			}

		}else{
			$duplicat_fi_subject_code = $duplicat_fi_subject_code +1;

		}



		
	}

			
}
	$cl_query= mysql_query("SELECT branch_name, client_id, card_no, card_status, contract,create_date, exp_date, caredit_limit_bdt , outstanding_bdt, total_outstanding_bdt , mp_due_bdt, reporting_date, deliquency,file_name, overdue_amt_bdt, national_id,dath_of_birth from cl_table ct  where year(reporting_date)='$report_year' and month(reporting_date)='$report_month'");
	
	if(mysql_num_rows($cl_query) > 0)
	{
		$contract_error = 0;
		while($cl_result = mysql_fetch_array($cl_query))
		{
			//fetch branch code
			$name = $cl_result['branch_name'];
			/*$branch = fetch_brach_code($name);
			$br_code = $branch['br_code'];*/

			$br_code ='0014';

			$record_type ='D';
			$fi_code='077';
			//$branch_code='';
			$fi_subject_code = $cl_result['client_id'];
			$fi_contract_code = $cl_result['card_no'];

			//fetch_contract_type 
			//$contract_type = fetch_contract_type();
			$contract_type='CR';
			

			$fetch_phase_restlt = fetch_contract_phase($cl_result['card_status']);
			$contract_phase = $fetch_phase_restlt['value'];
			//$contract_status = $cl_result['contract'];

			/*if( $cl_result['contract'] == 'Ok' && $cl_result['deliquency'] == 'No Overdue' )
			{
				$contract_status = '';

			}else{
				$contract_status='';
			}*/

			$deliquency = preg_replace('/[^0-9]/', '', $cl_result['deliquency']);

			if($deliquency==2)
			{
				$contract_status='M';

			}else if(($deliquency == 3) || ($deliquency == 4) || ($deliquency == 5) || ($deliquency == 6) || ($deliquency == 7) || ($deliquency == 8))
			{
				$contract_status='S';

			}else if(($deliquency == 9) || ($deliquency == 10) || ($deliquency == 11))
			{
				$contract_status='S';

			}else if($deliquency > 12){
				$contract_status='B';
			}else{
				$contract_status='';
			}


			//$currency_code = fetch_currency_code();			
			$currency_code = 'BDT';
			$currency_code_of_credit = fetch_currency_code();
			$currency_code_of_credit = $currency_code_of_credit;	
			//$currency_code_of_credit='';
			$starting_date_of_contract= $cl_result['create_date'];
			$request_date_of_the_contract = $cl_result['create_date'];
			$planned_end_date_of_the_contract = $cl_result['exp_date'];
			$actual_end_date_of_the_contract = '';

			$periodicity_of_payment = fetch_periodicity();
			//$periodicity_of_payment ='M';
			$method_of_payment = fetch_payment();
			//$method_of_payment = 'CAS';
			$monthly_instalment_amt = '000000000000';
			$section_limit = $cl_result['caredit_limit_bdt']; ###-- Credit limit --#######
			$exp_date_of_next_installment ='';
			//$remaining_amt = str_replace(',', '', $cl_result['total_outstanding_bdt']);  ###--- total_out_standing_bdt ---- #####
			$remaining_amt = str_replace(',', '', $cl_result['outstanding_bdt']);  ###--- out_standing_bdt ---- #####
			$number_of_overdue_and_not_paid_installment = '';
			//$overdue_amt= str_replace(',', '', $cl_result['total_outstanding_bdt']);
			$overdue_amt= str_replace(',', '', $cl_result['overdue_amt_bdt']);
			$date_of_last_charge = '';
			$type_of_installment='V';
			$amount_charged_in_the_month='';
			$flag_card_used_in_the_month='';
			$monthly_card_used_in_the_month='';
			$payment_delay_number='';
			$recovery_due = str_replace(',', '', $cl_result['mp_due_bdt']);
			$recovery_during_the_reporting_period ='';

			if(($contract_status == 'S') || ($contract_status == 'D') || ($contract_status == 'B') || ($contract_status == 'W'))
			{
				//31/05/2021
				$date_of_classification=date ('t/m/Y', strtotime($report_date));
			}else{
				$date_of_classification='';
			}

			
			$cumulative_recovery='';
			$date_of_law_suit ='';
			$no_of_times_rescheduled='';
			$economic_purpose_code='';
			$defaulter_flag='N';
			$total_disburse_amt = str_replace(',', '', $cl_result['caredit_limit_bdt']);
			$outstanding_amt =  str_replace(',', '', $cl_result['total_outstanding_bdt']);
			$flag_update = '';
			$reporting_date = $cl_result['reporting_date'];


			//file nale
			$cl_file_name = $cl_result['file_name'];



			/* find floora client id from floora cbs*/
			if($cl_result['national_id'] !='')
			{


				if(strlen($cl_result['national_id']) ==17 )
				{
									
					  $full_nid_number = $cl_result['national_id'];

					  $nid_13 = substr($full_nid_number, 4);
					
				}
				else if(strlen($cl_result['national_id']) == 13){

					  if($cl_result['dath_of_birth'] !='')
					  {

						  $birth_array = explode("/", $cl_result['dath_of_birth']); 
						  $birth_year = $birth_array[2];
						  $full_nid_number = $birth_year.$cl_result['national_id'];

					  }else{
					  	$full_nid_number ='';
					  }
					  
					  
				}
				else if(strlen($cl_result['national_id']) == 10){

					  if($cl_result['dath_of_birth'] !='')
					  {

						  $birth_array = explode("/", $cl_result['dath_of_birth']); 
						  $birth_year = $birth_array[2];
						  $full_nid_number = $birth_year.$cl_result['national_id'];

					  }else{
					  	$full_nid_number ='';
					  }
					  
					  
				}

				if(strlen($cl_result['national_id']) == 13 )
				{

					 $nid_13 = $cl_result['national_id'];

				}else if(strlen($cl_result['national_id']) == 10){
					$nid_13 = $cl_result['national_id'];
				}

			}

			/*update fi_subject_code*/
			/*$nid_number = $cl_result['national_id']; 
			$full_nid_number_for_floora = $full_nid_number;
			$customer_id =flora_fi_subject_code($nid_number);
			 
			if(!empty($customer_id))
			{
				  $fi_subject_code = $customer_id;
			}else if (empty($customer_id)){

				$customer_id =flora_fi_subject_code($full_nid_number_for_floora);

				if(!empty($customer_id))
				{
					$fi_subject_code =  $customer_id;
				}else{
					$fi_subject_code = $cl_result['client_id'];
				}	
				 

			}*/
			/*update fi_subject_code*/


			$card_fi_sub = $cl_result['client_id'];
			/*end  find floora client id from floora cbs*/







			$contracts_query = mysql_query("INSERT INTO `contracts_info`(`record_type`, `fi_code`, `branch_code`, `fi_subject_code`, `fi_contract_code`, `contract_type`, `contract_phase`, `contract_status`, `currency_code`, `currency_code_of_credit`, `starting_date_of_contract`, `request_date_of_the_contract`, `planned_end_date_of_the_contract`, `actual_end_date_of_the_contract`, `periodicity_of_payment`, `method_of_payment`, `monthly_instalment_amt`, `section_limit`, `exp_date_of_next_installment`, `remaining_amt`, `number_of_overdue_and_not_paid_installment`, `overdue_amt`, `date_of_last_charge`, `type_of_installment`, `amount_charged_in_the_month`, `flag_card_used_in_the_month`, `monthly_card_used_in_the_month`, `payment_delay_number`, `recovery_due`, `recovery_during_the_reporting_period`, `cumulative_recovery`, `date_of_law_suit`, `date_of_classification`, `no_of_times_rescheduled`, `economic_purpose_code`, `defaulter_flag`, `total_disburse_amt`, `outstanding_amt`, `flag_update`, `reporting_date`, `status`, `card_fi_sub`) VALUES ('$record_type', '$fi_code', '$br_code', '$fi_subject_code', '$fi_contract_code', '$contract_type', '$contract_phase', '$contract_status', '$currency_code', '$currency_code_of_credit', '$starting_date_of_contract', '$request_date_of_the_contract', '$planned_end_date_of_the_contract', '$actual_end_date_of_the_contract', '$periodicity_of_payment', '$method_of_payment', '$monthly_instalment_amt', '$section_limit', '$exp_date_of_next_installment', '$remaining_amt', '$number_of_overdue_and_not_paid_installment', '$overdue_amt', '$date_of_last_charge', '$type_of_installment', '$amount_charged_in_the_month', '$flag_card_used_in_the_month', '$monthly_card_used_in_the_month', '$payment_delay_number', '$recovery_due', '$recovery_during_the_reporting_period', '$cumulative_recovery', '$date_of_law_suit', '$date_of_classification', '$no_of_times_rescheduled', '$economic_purpose_code', '$defaulter_flag', '$total_disburse_amt', '$outstanding_amt', '$flag_update', '$reporting_date', '1', '$card_fi_sub')");


			if($contracts_query)
			{
				$contracts_insert=  $contracts_insert + 1;				
			}

		}

		
	


mysql_query("UPDATE cl_table set status='1' where year(reporting_date)='$report_year' and month(reporting_date)='$report_month' ");

if(($suject_insert && $contracts_insert))
{


	//history log for cib generate
	$generate_by = $_SESSION['login_id'];
	$generate_timestamp = date('Y-m-d H:i:s');
	 $log_insert= mysql_query("INSERT INTO cib_generate_history (cl_file, generate_by, generate_timestamp) values('$cl_file_name', '$generate_by', '$generate_timestamp')");
	 if($log_insert)
	 {
	 	
	 	echo "TOTAL SUBJECT $suject_insert AND DUPLICATE SUBJECT $duplicat_fi_subject_code".
	 		 " AND TOTAL $contracts_insert CONTRACT IS READY FOR CIB REPORT ";
		   

	 }

	
}	





}



}



	//end crate dat for cib







 ?>