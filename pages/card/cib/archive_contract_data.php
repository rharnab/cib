<?php include("../database.php") ?>

<?php 
$archive_count = $_POST['archive_count'];
$report_date = date('Y-m', strtotime($_POST['cib_date']));
$accounting_date=date('Y-m-t', strtotime($report_date." -1 month"));
$acc_dt_array = explode("-", $accounting_date);
$acc_year= $acc_dt_array[0];
$acc_month= $acc_dt_array[1];
$num = 0;

$sql =mysql_query("SELECT * from contracts_info  where year (reporting_date) ='$acc_year' and month (reporting_date)='$acc_month'");

while($data= mysql_fetch_array($sql))
{


	 $record_type = $data['record_type'];
	 $fi_code = $data['fi_code'];
	 $branch_code = $data['branch_code'];
	 $card_fi_sub = $data['card_fi_sub'];
	 $fi_subject_code = $data['fi_subject_code'];
	 $fi_contract_code = $data['fi_contract_code'];
	 $contract_type = $data['contract_type'];
	 $contract_phase = $data['contract_phase'];
	 $contract_status = $data['contract_status'];
	 $currency_code = $data['currency_code'];
	 $currency_code_of_credit = $data['currency_code_of_credit'];
	 $starting_date_of_contract = $data['starting_date_of_contract'];
	 $request_date_of_the_contract = $data['request_date_of_the_contract'];
	 $planned_end_date_of_the_contract = $data['planned_end_date_of_the_contract'];
	 $actual_end_date_of_the_contract = $data['actual_end_date_of_the_contract'];
	 $periodicity_of_payment = $data['periodicity_of_payment'];
	 $method_of_payment = $data['method_of_payment'];
	 $monthly_instalment_amt = $data['monthly_instalment_amt'];
	 $section_limit = $data['section_limit'];
	 $exp_date_of_next_installment = $data['exp_date_of_next_installment'];
	 $remaining_amt = $data['remaining_amt'];
	 $number_of_overdue_and_not_paid_installment = $data['number_of_overdue_and_not_paid_installment'];
	 $overdue_amt = $data['overdue_amt'];
	 $date_of_last_charge = $data['date_of_last_charge'];
	 $type_of_installment = $data['type_of_installment'];
	 $amount_charged_in_the_month = $data['amount_charged_in_the_month'];
	 $flag_card_used_in_the_month = $data['flag_card_used_in_the_month'];
	 $monthly_card_used_in_the_month = $data['monthly_card_used_in_the_month'];
	 $payment_delay_number = $data['payment_delay_number'];
	 $recovery_due = $data['recovery_due'];
	 $recovery_during_the_reporting_period = $data['recovery_during_the_reporting_period'];
	 $cumulative_recovery = $data['cumulative_recovery'];
	 $date_of_law_suit = $data['date_of_law_suit'];
	 $date_of_classification = $data['date_of_classification'];
	 $no_of_times_rescheduled = $data['no_of_times_rescheduled'];
	 $economic_purpose_code = $data['economic_purpose_code'];
	 $defaulter_flag = $data['defaulter_flag'];
	 $total_disburse_amt = $data['total_disburse_amt'];
	 $outstanding_amt = $data['outstanding_amt'];
	 $flag_update = $data['flag_update'];
	 $reporting_date = $data['reporting_date'];
	 $status = $data['status'];
	 
	 $archive_date = date("M-Y", strtotime($reporting_date));
	 $count = $archive_count + 1;
	 $entry_date = date('Y-m-d h:i:s');



	 $insert= mysql_query("INSERT INTO contracts_info_archive(record_type, fi_code, branch_code, card_fi_sub, fi_subject_code, fi_contract_code, contract_type, contract_phase, contract_status, currency_code, currency_code_of_credit, starting_date_of_contract, request_date_of_the_contract, planned_end_date_of_the_contract, actual_end_date_of_the_contract, periodicity_of_payment, method_of_payment, monthly_instalment_amt, section_limit, exp_date_of_next_installment, remaining_amt, number_of_overdue_and_not_paid_installment, overdue_amt, date_of_last_charge, type_of_installment, amount_charged_in_the_month, flag_card_used_in_the_month, monthly_card_used_in_the_month, payment_delay_number, recovery_due, recovery_during_the_reporting_period, cumulative_recovery, date_of_law_suit, date_of_classification, no_of_times_rescheduled, economic_purpose_code, defaulter_flag, total_disburse_amt, outstanding_amt, flag_update, reporting_date, status, archive_date, count, entry_date) VALUES ('$record_type','$fi_code','$branch_code','$card_fi_sub','$fi_subject_code','$fi_contract_code','$contract_type','$contract_phase','$contract_status','$currency_code','$currency_code_of_credit','$starting_date_of_contract','$request_date_of_the_contract','$planned_end_date_of_the_contract','$actual_end_date_of_the_contract','$periodicity_of_payment','$method_of_payment','$monthly_instalment_amt','$section_limit','$exp_date_of_next_installment','$remaining_amt','$number_of_overdue_and_not_paid_installment','$overdue_amt','$date_of_last_charge','$type_of_installment','$amount_charged_in_the_month','$flag_card_used_in_the_month','$monthly_card_used_in_the_month','$payment_delay_number','$recovery_due','$recovery_during_the_reporting_period','$cumulative_recovery','$date_of_law_suit','$date_of_classification','$no_of_times_rescheduled','$economic_purpose_code','$defaulter_flag','$total_disburse_amt','$outstanding_amt','$flag_update','$reporting_date','$status','$archive_date','$count','$entry_date') ");
					

	if($insert)
	{
		$num = $num + 1;
	}

					
}

mysql_query("UPDATE   card_close set status='2'  where status='1' and   card_no  in ( SELECT fi_contract_code from contracts_info where status ='1' and fi_subject_code in (select fi_subject_code from subject_info where status ='1' or status ='2' group by fi_subject_code)) ");

echo "ALL CONTRACT HAS BEEN SUCCESSULLY MOVED TO  ARCHIVE ";









 ?>