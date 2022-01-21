<?php include('../database.php'); ini_set('max_execution_time', 0); ?>
<?php include('cib_common.php'); ?>



<?php 
  $report_date = $_POST['cib_date'];
  $report_date= date('Y-m', strtotime($report_date."-1 month"));
 $date_array = explode('-', $report_date);
 $report_year = $date_array[0];
 $report_month = $date_array[1];

 



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

$mis_query = mysql_query("SELECT title, customer_name, dath_of_birth, fathers_name, mothers_name, sex, national_id, tin, mobile_no, reporting_date, client_id, file_name, resident_address, resident_city,resident_region,resident_country, branch_name,  card_no, card_status, contract,create_date, exp_date, caredit_limit_bdt , outstanding_bdt, total_outstanding_bdt , mp_due_bdt, reporting_date, deliquency,file_name, overdue_amt_bdt, caredit_limit_usd, outstanding_usd, overdue_amt_usd, mp_due_usd, caredit_limit_usd, total_outstanding_usd, personal_code from cl_table mt where year(reporting_date)='$report_year' and month(reporting_date)='$report_month' ");






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
			$is_nid = '1';
			$nid_13= $mis_result['national_id'];

			
			if(strlen($mis_result['national_id']) ==10 || strlen($mis_result['national_id']) == 13)
			{
				if($mis_result['dath_of_birth'] !='')
				{
					 $birth_array = explode("/", $mis_result['dath_of_birth']); 
					 $birth_year = $birth_array[2];
					 $full_nid_number = $birth_year.$mis_result['national_id'];
				}
				 
			}

		}else{

			$is_nid='0';
			$nid_13='';
			$full_nid_number='';
		}

	
		$id_type ='';
	    $id_nr = '';
		

		
		$reporting_date = $mis_result['reporting_date'];

		$record_type = 'P';
		$fi_code = '077';
		$acc_date = date('Y-m-t', strtotime($mis_result['reporting_date']));
		$production_date = '';
		$code_link = '';
		$branch_code = '0014';
		$card_fi_sub = $mis_result['client_id'];
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

		if($mis_result['national_id'] !='')
		{
			 $fi_subject_code = flora_fi_subject_code($nid_13);
			 if($fi_subject_code =='')
			 {
			 	//$fi_subject_code = $card_fi_sub;
			 	 $fi_subject_code = flora_fi_subject_code($full_nid_number);
			 	 if($fi_subject_code == '')
			 	 {
			 	 	$fi_subject_code = $card_fi_sub;
			 	 }
			 }

			
		}else{
			$fi_subject_code = $card_fi_sub;
		}
		

		/*end update fi_subject_code from floora cbs*/


		
		   $archive_sql= mysql_query("SELECT fi_subject_code from subject_info_archive where status ='1' and fi_subject_code = '$fi_subject_code'");
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
				
			}else{
				$duplicat_fi_subject_code = $duplicat_fi_subject_code +1;


				$card_fi_sub = $mis_result['client_id'];
				//$fi_subject_code = $mis_result['client_id'];
				mysql_query("INSERT INTO `subject_info`(`record_type`, `fi_code`, `acc_date`, `production_date`, `code_link`, `branch_code`, `fi_subject_code`, `title`, `name`, `fathers_title`, `fathers_name`, `mothers_title`, `mothers_name`, `spouse_title`, `spouse`, `sector_type`, `sector_code`, `gender`, `dath_of_brth`, `place_of_birth`, `country_of_birth`, `nid_number`, `is_nid`, `tin_number`, `parmanent_street`, `parmanent_postal_code`, `parmanent_district`, `parmanent_country_code`, `additional_street`, `additional_postal_code`, `additional_district`, `additional_country_code`, `id_type`, `id_nr`, `id_issue_date`, `id_issue_country_code`, `phone_number`, `full_nid_number`, `reporting_date`, `status`, `card_fi_sub`,`business_address`, `business_postal_code`, `business_district`, `business_country_code`) VALUES ('$record_type', '$fi_code', '$acc_date', '$production_date', '$code_link','$branch_code', '$fi_subject_code', '$title', '$name', '$fathers_title', '$fathers_name', '$mothers_title', '$mothers_name', '$spouse_title', '$spouse', '$sector_type', '$sector_code', '$gender', '$dath_of_brth', '$place_of_birth', '$country_of_birth', '$nid_13', '$is_nid', '$tin_number', '$parmanent_street', '$parmanent_postal_code', '$parmanent_district', '$parmanent_country_code', '$additional_street', '$additional_postal_code', '$additional_district', '$additional_country_code', '$id_type', '$id_nr', '$id_issue_date', '$id_issue_country_code', '$phone_number', '$full_nid_number', '$reporting_date', '5','$card_fi_sub', '$business_address', '$business_postal_code', '$business_district', '$business_country_code')");



			
			}

	


		
	
	
	
	
		    $contract_error = 0;
		
			//fetch branch code
			$name = $mis_result['branch_name'];

			$br_code ='0014';

			$record_type ='D';
			$fi_code='077';
			$card_fi_sub_cl = $mis_result['client_id'];
			$fi_contract_code = $mis_result['card_no'];

			//fetch_contract_type 
			//$contract_type = fetch_contract_type();
			$contract_type='CR';
			

			$fetch_phase_restlt = fetch_contract_phase($mis_result['card_status']);
			$contract_phase = $fetch_phase_restlt['value'];
			

			$deliquency = preg_replace('/[^0-9]/', '', $mis_result['deliquency']);

			if($deliquency==2)
			{
				$contract_status='M';

			}
			else if(($deliquency == 3) || ($deliquency == 4) || ($deliquency == 5) || ($deliquency == 6) || ($deliquency == 7) || ($deliquency == 8))
			{
				$contract_status='S';

			}
			else if(($deliquency == 9) || ($deliquency == 10) || ($deliquency == 11))
			{
				$contract_status='D';

			}
			else if($deliquency >= 12)
			{
				$contract_status='B';
			}
			else{
				$contract_status='';
			}


			/*defaulter_flag update depends on contract_status*/
			if($contract_status == 'B' || $contract_status == 'S')
			{
				$defaulter_flag='Y';
			}else{
				$defaulter_flag='N';
			}

			//$currency_code = fetch_currency_code();			
			$currency_code = 'BDT';
			$currency_code_of_credit = fetch_currency_code();
			$currency_code_of_credit = $currency_code_of_credit;	
			$starting_date_of_contract= $mis_result['create_date'];
			$request_date_of_the_contract = $mis_result['create_date'];
			$planned_end_date_of_the_contract = $mis_result['exp_date'];
			$actual_end_date_of_the_contract = '';
			$periodicity_of_payment = fetch_periodicity();
			$method_of_payment = fetch_payment();
			$monthly_instalment_amt = '000000000000';


			$section_limit = $mis_result['caredit_limit_bdt']; ###-- Credit limit --#######
			$exp_date_of_next_installment ='';
			$remaining_amt = str_replace(',', '', $mis_result['outstanding_bdt']);  ###--- out_standing_bdt ---- #####
			$number_of_overdue_and_not_paid_installment = '';
			$overdue_amt= str_replace(',', '', $mis_result['overdue_amt_bdt']);
			$date_of_last_charge = '';
			$type_of_installment='V';
			$amount_charged_in_the_month='';
			$flag_card_used_in_the_month='';
			$monthly_card_used_in_the_month='';
			$payment_delay_number='';
			$recovery_due = str_replace(',', '', $mis_result['mp_due_bdt']);
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
			//$defaulter_flag='N';
			$total_disburse_amt = str_replace(',', '', $mis_result['caredit_limit_bdt']);
			$outstanding_amt =  str_replace(',', '', $mis_result['total_outstanding_bdt']);
			$flag_update = '';
			$reporting_date = $mis_result['reporting_date'];



			/*for usd card*/
			$personal_code = trim($mis_result['personal_code']);

			if (strpos($personal_code, 'SUPPLY') !== false) {
			   $supply_true = true;
			}else{
				$supply_true= false;
			}

			//for supply contract
			/*if($supply_true == true)
			{

				$get_sup_result = getSuppleInfo($report_year, $report_month, $mis_result['national_id']);

				   
					$section_limit = $get_sup_result['section_limit']; ###-- Credit limit --#######
					$exp_date_of_next_installment ='';
					$remaining_amt = str_replace(',', '', $get_sup_result['remaining_amt']);  ###--- out_standing_bdt ---- #####
					$number_of_overdue_and_not_paid_installment = '';
					$overdue_amt= str_replace(',', '', $get_sup_result['overdue_amt']);
					$date_of_last_charge = '';
					$type_of_installment='V';
					$amount_charged_in_the_month='';
					$flag_card_used_in_the_month='';
					$monthly_card_used_in_the_month='';
					$payment_delay_number='';
					$recovery_due = str_replace(',', '', $get_sup_result['recovery_due']);
					$recovery_during_the_reporting_period ='';
					$total_disburse_amt = str_replace(',', '', $get_sup_result['total_disburse_amt']);
					$outstanding_amt =  str_replace(',', '', $get_sup_result['outstanding_amt']);
					$is_dollar = $get_sup_result['is_dollar'];


			}else{*/
				//for all contract usd 
				if($mis_result['caredit_limit_usd'] > 0)
				{
					$usd_rate = getRate();
					$section_limit = $mis_result['caredit_limit_usd'] * $usd_rate; ###-- Credit limit --#######
					$exp_date_of_next_installment ='';
					$remaining_amt = str_replace(',', '', $mis_result['outstanding_usd']) * $usd_rate;  ###--- out_standing_bdt ---- #####
					$number_of_overdue_and_not_paid_installment = '';
					$overdue_amt= str_replace(',', '', $mis_result['overdue_amt_usd']) * $usd_rate;
					$date_of_last_charge = '';
					$type_of_installment='V';
					$amount_charged_in_the_month='';
					$flag_card_used_in_the_month='';
					$monthly_card_used_in_the_month='';
					$payment_delay_number='';
					$recovery_due = str_replace(',', '', $mis_result['mp_due_usd']) * $usd_rate;
					$recovery_during_the_reporting_period ='';
					$total_disburse_amt = str_replace(',', '', $mis_result['caredit_limit_usd']) * $usd_rate;
					$outstanding_amt =  str_replace(',', '', $mis_result['total_outstanding_usd']) * $usd_rate;
					$is_dollar = 1;

				}else{
					$is_dollar=0;
				}

			//}

			/*end for usd card*/




			//file nale
			$cl_file_name = $mis_result['file_name'];


			$fi_subject_code_cl = $fi_subject_code;
			$card_fi_sub_cl = $card_fi_sub;
			/*update fi_subject_code*/

			/*end  find floora client id from floora cbs*/




			$contracts_query = mysql_query("INSERT INTO `contracts_info`(`record_type`, `fi_code`, `branch_code`, `fi_subject_code`, `fi_contract_code`, `contract_type`, `contract_phase`, `contract_status`, `currency_code`, `currency_code_of_credit`, `starting_date_of_contract`, `request_date_of_the_contract`, `planned_end_date_of_the_contract`, `actual_end_date_of_the_contract`, `periodicity_of_payment`, `method_of_payment`, `monthly_instalment_amt`, `section_limit`, `exp_date_of_next_installment`, `remaining_amt`, `number_of_overdue_and_not_paid_installment`, `overdue_amt`, `date_of_last_charge`, `type_of_installment`, `amount_charged_in_the_month`, `flag_card_used_in_the_month`, `monthly_card_used_in_the_month`, `payment_delay_number`, `recovery_due`, `recovery_during_the_reporting_period`, `cumulative_recovery`, `date_of_law_suit`, `date_of_classification`, `no_of_times_rescheduled`, `economic_purpose_code`, `defaulter_flag`, `total_disburse_amt`, `outstanding_amt`, `flag_update`, `reporting_date`, `status`, `card_fi_sub`,`is_dollar`) VALUES ('$record_type', '$fi_code', '$br_code', '$fi_subject_code_cl', '$fi_contract_code', '$contract_type', '$contract_phase', '$contract_status', '$currency_code', '$currency_code_of_credit', '$starting_date_of_contract', '$request_date_of_the_contract', '$planned_end_date_of_the_contract', '$actual_end_date_of_the_contract', '$periodicity_of_payment', '$method_of_payment', '$monthly_instalment_amt', '$section_limit', '$exp_date_of_next_installment', '$remaining_amt', '$number_of_overdue_and_not_paid_installment', '$overdue_amt', '$date_of_last_charge', '$type_of_installment', '$amount_charged_in_the_month', '$flag_card_used_in_the_month', '$monthly_card_used_in_the_month', '$payment_delay_number', '$recovery_due', '$recovery_during_the_reporting_period', '$cumulative_recovery', '$date_of_law_suit', '$date_of_classification', '$no_of_times_rescheduled', '$economic_purpose_code', '$defaulter_flag', '$total_disburse_amt', '$outstanding_amt', '$flag_update', '$reporting_date', '1', '$card_fi_sub_cl', '$is_dollar')");



			if($contracts_query)
			{
				$contracts_insert=  $contracts_insert + 1;				
			}

		

		
	
	}

			
}

//mysql_query("UPDATE cl_table set status='1' where year(reporting_date)='$report_year' and month(reporting_date)='$report_month' ");

################################## contract error update ##########################################
$q= mysql_query("SELECT query,  `condition`, error_code from cib_error where `condition` <> '' and id > 141  order by error_code asc  ");
 $sl=1;
 while( $result = mysql_fetch_array($q))
 {
 	$subject_query= mysql_query($result['query']);
 	if(mysql_num_rows($subject_query) > 0)
 	{	
 		$condition = $result['condition'];
 		$error_code = $result['error_code'];

 		 if($error_code == '606')
 		 {

 		 	$error_query =  $result['query'];
 		 	$contract_query = mysql_query("UPDATE  contracts_info set status='0' where fi_contract_code in (select fi_contract_code from (select clc.*,CASE     WHEN clc.month_no = 2 THEN 'M'     WHEN clc.month_no > 2 and clc.month_no < 9  THEN 'S'     WHEN clc.month_no > 8 and  clc.month_no < 12  THEN 'D'     WHEN clc.month_no > 11 THEN 'B'     ELSE '' END AS deliqu from (select * from ( select id, deliquency,card_no,findStringfromnumber(deliquency) as month_no from cl_table  order by id desc ) cl group by card_no ) clc  ) fcl  left join (select fi_contract_code,contract_status,fi_subject_code,card_fi_sub, status,id from contracts_info) ci on fcl.card_no = ci.fi_contract_code where fcl.deliqu != ci. contract_status)  and status='1' ");
 		 	
 		 }else{

 		 	 mysql_query(" UPDATE  contracts_info set status='0'  where $condition and status='1' ");
 		 }

 	}

 	
 } //while for contracts update 


################################## contract error update ##########################################

 ################################## subject error update ##########################################

 $q= mysql_query("SELECT query,  `condition` from cib_error where `condition` <> '' and id < 141  order by error_code asc  ");
 $sl=1;
 while( $result = mysql_fetch_array($q))
 {
 	
 	$subject_query= mysql_query($result['query']);
 	if(mysql_num_rows($subject_query) > 0)
 	{	

 		$condition = $result['condition'];
 		mysql_query("UPDATE  subject_info set status='0' where $condition  and status='1' ");
 	}
 	
 }

 ################################## subject error update ##########################################

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



	//end crate dat for cib







 ?>