<?php 
include("../database.php");
ini_set('max_execution_time', '0'); // for infinite time of execution 
 ?>

<?php 
$total_update = 0;
$total_insert = 0;

$query  =mysql_query("SELECT client_id, card_no, account_no,closing_date from card_close where status<> '2'  ");
if(mysql_num_rows($query))
{
	while($result  = mysql_fetch_assoc($query))
	{
		$client_id= $result['client_id'];
		$card_no= $result['card_no'];
		$account_no= $result['account_no'];
		$closing_date= date('d/m/Y', strtotime($result['closing_date']));


		$contracts_query =mysql_query("SELECT fi_contract_code, card_fi_sub from contracts_info where fi_contract_code= '$card_no' and card_fi_sub='$client_id' ");
		if(mysql_num_rows($contracts_query) > 0)
		{
			$con_info  = mysql_fetch_assoc($contracts_query);
			$contract_phase = 'TM';
			$actual_end_date_of_the_contract= $closing_date;
			$remaining_amt =0;
			$recovery_due =0;
			$monthly_instalment_amt =0;

			$update = mysql_query("UPDATE contracts_info set contract_phase='$contract_phase', actual_end_date_of_the_contract='$actual_end_date_of_the_contract', remaining_amt='$remaining_amt', recovery_due='$recovery_due', monthly_instalment_amt='$monthly_instalment_amt', status='1' where fi_contract_code= '$card_no' and card_fi_sub='$client_id' ");

			
			if($update)
			{
				mysql_query("UPDATE card_close set status='1'  where card_no= '$card_no' and client_id='$client_id' and status='0' ");
				$total_update= $total_update +1;


			}else{
				
			}
		}else{

			$contracts_arc_query =mysql_query("SELECT fi_contract_code, card_fi_sub, fi_subject_code from contracts_info_archive where fi_contract_code= '$card_no' and card_fi_sub='$client_id' ");

			if(mysql_num_rows($contracts_arc_query) > 0)
			{
				$contract_phase = 'TM';
				$actual_end_date_of_the_contract= $closing_date;
				$remaining_amt =0;
				$recovery_due =0;
				$monthly_instalment_amt =0;
				$arc_result = mysql_fetch_assoc($contracts_arc_query);
				$fi_subject_code = $arc_result['fi_subject_code'];
				$card_fi_sub = $arc_result['card_fi_sub'];

				$sub_column = "record_type, fi_code, acc_date, production_date, code_link, branch_code, fi_subject_code, card_fi_sub, title, name, fathers_title, fathers_name, mothers_title, mothers_name, spouse_title, spouse, sector_type, sector_code, gender, dath_of_brth, place_of_birth, country_of_birth, nid_number, is_nid, tin_number, parmanent_street, parmanent_postal_code, parmanent_district, parmanent_country_code, additional_street, additional_postal_code, additional_district, additional_country_code, business_address, business_postal_code, business_district, business_country_code, id_type, id_nr, id_issue_date, id_issue_country_code, phone_number, full_nid_number, reporting_date, status";

			   $subject_sql = "INSERT INTO subject_info ($sub_column)  SELECT $sub_column from subject_info_archive where fi_subject_code= '$fi_subject_code' and card_fi_sub='$card_fi_sub' and status ='1'  order by id desc limit 1";

				$subject_insert= mysql_query($subject_sql);
				
	


				if($subject_insert)
				{
					$contract_column = "record_type, fi_code, branch_code, card_fi_sub, fi_subject_code, fi_contract_code, contract_type, contract_phase, contract_status, currency_code, currency_code_of_credit, starting_date_of_contract, request_date_of_the_contract, planned_end_date_of_the_contract, actual_end_date_of_the_contract, periodicity_of_payment, method_of_payment, monthly_instalment_amt, section_limit, exp_date_of_next_installment, remaining_amt, number_of_overdue_and_not_paid_installment, overdue_amt, date_of_last_charge, type_of_installment, amount_charged_in_the_month, flag_card_used_in_the_month, monthly_card_used_in_the_month, payment_delay_number, recovery_due, recovery_during_the_reporting_period, cumulative_recovery, date_of_law_suit, date_of_classification, no_of_times_rescheduled, economic_purpose_code, defaulter_flag, total_disburse_amt, outstanding_amt, flag_update, reporting_date, status";

					 $contract_slq  = "INSERT INTO contracts_info ($contract_column)  SELECT $contract_column from contracts_info_archive where fi_contract_code= '$card_no' and card_fi_sub='$client_id'  order by id desc limit 1 ";

					$contract_insert= mysql_query($contract_slq);

					
				
					if($contract_insert)
					{

						$date_query = mysql_query("SELECT reporting_date from subject_info order by id asc limit 1 ");
						$date_result = mysql_fetch_assoc($date_query);
						$reporting_date = $date_result['reporting_date'];

						$insert = mysql_query("UPDATE contracts_info set contract_phase='$contract_phase', actual_end_date_of_the_contract='$actual_end_date_of_the_contract', remaining_amt='$remaining_amt', recovery_due='$recovery_due', monthly_instalment_amt='$monthly_instalment_amt', reporting_date='$reporting_date', status='1' where fi_contract_code= '$card_no' and card_fi_sub='$client_id' ");


						//subject reporting date update
						mysql_query("UPDATE subject_info set reporting_date='$reporting_date', status='1'  where card_fi_sub='$client_id' ");



						if($insert)
						{
							mysql_query("UPDATE card_close set status='1'  where card_no= '$card_no' and client_id='$client_id' and status='0' ");

							$total_insert= $total_insert +1;
						}

					}
					

					
				}

			}

		}
	}

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
}


echo $total_update." Update  and ".$total_insert."new insert";

  ?>