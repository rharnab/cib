<?php
include('../../database.php');

function errorCheckContact($id=NULL,$reportingDate)
{
	//checking if ID is empty
	$errorArray=array();
	$error=array();
	if($id==NULL)//id not given
	{
		$reportingDate=date("Y-m-d",strtotime($reportingDate));
		$qIdCheck=mysql_query("SELECT *  FROM `contracts_info` WHERE `reporting_date` = '$reportingDate'");

		if(mysql_num_rows($qIdCheck) > 0)
		{

		while($d=mysql_fetch_array($qIdCheck))
		{
			$record_type = $d['record_type'];
			$fi_code = $d['fi_code'];
			$branch_code = $d['branch_code'];
			$fi_subject_code = $d['fi_subject_code'];
			$fi_contract_code = $d['fi_contract_code'];
			$contract_type = $d['contract_type'];
			$contract_phase = $d['contract_phase'];
			$contract_status = $d['contract_status'];
			$currency_code = $d['currency_code'];
			$currency_code_of_credit = $d['currency_code_of_credit'];
			$starting_date_of_contract = $d['starting_date_of_contract'];
			$request_date_of_the_contract = $d['request_date_of_the_contract'];
			$planned_end_date_of_the_contract = $d['planned_end_date_of_the_contract'];
			$actual_end_date_of_the_contract = $d['actual_end_date_of_the_contract'];
			$periodicity_of_payment = $d['periodicity_of_payment'];
			$method_of_payment = $d['method_of_payment'];
			$mnth_installment_amt = $d['monthly_instalment_amt'];
			$section_limit = $d['section_limit'];
			$exp_dt_next_installment = $d['exp_date_of_next_installment'];
			$remaining_amt = $d['remaining_amt'];
			$overdue_or_not_paid_installment = $d['number_of_overdue_and_not_paid_installment'];
			$overdue_amt = $d['overdue_amt'];
			$dt_of_last_chrg = $d['date_of_last_charge'];
			$type_of_installment = $d['type_of_installment'];
			$amt_chrg_month = $d['amount_charged_in_the_month'];
			$flag_card_month = $d['flag_card_used_in_the_month'];
			$monthly_used_card = $d['monthly_card_used_in_the_month'];
			$payment_delay_number = $d['payment_delay_number'];
			$recovery_due = $d['recovery_due'];
			$recovery_report_period = $d['recovery_during_the_reporting_period'];
			$comulative_recovery = $d['cumulative_recovery'];
			$dt_law_suit = $d['date_of_law_suit'];
			$dt_of_classification = $d['date_of_classification'];
			$rescheduled_number = $d['no_of_times_rescheduled'];
			$economic_purpose_code = $d['economic_purpose_code'];
			$defaulter_flag = $d['defaulter_flag'];
			$total_disburse_amt = $d['total_disburse_amt'];
			$outstanding_amt = $d['outstanding_amt'];
			$flag_update = $d['flag_update'];
			$id=$d['id'];
			$error=array();

			if($record_type !='')
			{
				if(strlen($record_type) == 1)
				{
					
				}else{
					array_push($error,array(
										'field'=>'record_type',
										'msg'=>"invalid Record Type Length",
										'status'=>1
									));
				}

			}else{
				array_push($error,array(
										'field'=>'record_type',
										'msg'=>"Record Type Can not be empty",
										'status'=>1
									));
			}


			if($fi_code !='')
			{
				if(strlen($fi_code) == 3)
				{
					 
				}else{
					 array_push($error,array(
										'field'=>'fi_code',
										'msg'=>"invalid FI Code Length",
										'status'=>1
									));
				}

			}else{
				array_push($error,array(
										'field'=>'fi_code',
										'msg'=>"FI Code Can not be empty",
										'status'=>1
									));
			}


			if($branch_code !='')
			{

				if(strlen($branch_code) == 4)
				{
					 
				}else{
					 array_push($error,array(
										'field'=>'branch_code',
										'msg'=>"invalid Branch Code Length",
										'status'=>1
									));
				}

			}else{
				array_push($error,array(
										'field'=>'branch_code',
										'msg'=>"Branch Code Can not be empty",
										'status'=>1
									));
			}


			if($fi_subject_code !='')
			{
				
				if(strlen($fi_subject_code) <= 16)
				{
					 
				}else{
					  array_push($error,array(
										'field'=>'fi_subject_code',
										'msg'=>"invalid FI Subject Code Length",
										'status'=>1
									));
				}

			}else{
				array_push($error,array(
										'field'=>'fi_subject_code',
										'msg'=>"FI Subject Code Can not be empty",
										'status'=>1
									));
			}
			

			if($fi_contract_code !='')
			{
				if(strlen($fi_contract_code) <= 16)
				{
					 
				}else{
					 array_push($error,array(
										'field'=>'fi_contract_code',
										'msg'=>"invalid FI Contract Code Length",
										'status'=>1
									));
				}

			}else{
				array_push($error,array(
										'field'=>'fi_contract_code',
										'msg'=>"FI Contract Code Can not be empty",
										'status'=>1
									));
			}
			

			if($contract_type !='')
			{
				if(strlen($contract_type) == 2)
				{
					 if($contract_type=='CR' or $contract_type=='CG')
					 {
					 	if($periodicity_of_payment !='')
						{
							if(strlen($periodicity_of_payment) == 1)
							{
								 
							}else{
								array_push($error,array(
										'field'=>'periodicity_of_payment',
										'msg'=>"invalid Periodicity of Payment Length",
										'status'=>1
									));
							}

						}else{
							array_push($error,array(
										'field'=>'periodicity_of_payment',
										'msg'=>"Periodicity of Payment Can not be empty",
										'status'=>1
									));
						}
					 }
				}else{
					 array_push($error,array(
										'field'=>'contract_type',
										'msg'=>"invalid Contract Type Length",
										'status'=>1
									));
				}

			}else{
				array_push($error,array(
										'field'=>'contract_type',
										'msg'=>"Contract Type Can not be empty",
										'status'=>1
									));
			}

			if($contract_phase !='')
			{

				if(strlen($contract_phase) == 2)
				{
					 	if($contract_phase=='LV' or $contract_phase=='TN' or $contract_phase=='TA' )
					 	{
					 			if($starting_date_of_contract !='')
								{
									//$st_contract = date('d-m-Y', strtotime($starting_date_of_contract));
									$st_contract_array  = explode("/",  $starting_date_of_contract);
									$starting_date_of_contract =  $st_contract_array[0].$st_contract_array[1].$st_contract_array[2];

									if(strlen($starting_date_of_contract) == 8)
									{
										 
									}else{
										array_push($error,array(
												'field'=>'starting_date_of_contract',
												'msg'=>"invalid Starting Date of Contract Length",
												'status'=>1
										));
									}

								}else{
									array_push($error,array(
												'field'=>'starting_date_of_contract',
												'msg'=>"Starting Date of Contract Can not be empty",
												'status'=>1
										));
								}
								if($planned_end_date_of_the_contract !='')
								{
									//$plan_contract = date('d-m-Y', strtotime($planned_end_date_of_the_contract));
									$pl_contract_array  = explode("/",  $planned_end_date_of_the_contract);
									$planned_end_date_of_the_contract =  $pl_contract_array[0].$pl_contract_array[1].$pl_contract_array[2];

									if(strlen($planned_end_date_of_the_contract) == 8)
									{
										 
									}else{
										array_push($error,array(
												'field'=>'planned_end_date_of_the_contract',
												'msg'=>"invalid Planned End Date of Contract Length",
												'status'=>1
										));
									}

								}else{
									array_push($error,array(
												'field'=>'planned_end_date_of_the_contract',
												'msg'=>"Planned End Date of Contract Can not be empty",
												'status'=>1
										));
								}
								if($actual_end_date_of_the_contract !='')
								{
									//$actual_contract = date('d-m-Y', strtotime($actual_end_date_of_the_contract));
									$actual_contract_array  = explode("/",  $actual_end_date_of_the_contract);
									$actual_end_date_of_the_contract =  $actual_contract_array[0].$actual_contract_array[1].$actual_contract_array[2];


									if(strlen($actual_end_date_of_the_contract) == 8)
									{
										 
									}else{
										 array_push($error,array(
												'field'=>'actual_end_date_of_the_contract',
												'msg'=>"invalid Actual End Date of Contract Length",
												'status'=>1
										));
									}

								}else{
									 array_push($error,array(
												'field'=>'actual_end_date_of_the_contract',
												'msg'=>"Actual End Date of Contract Can not be empty",
												'status'=>1
										));
								}
					 	}
					 	// if($contract_phase=='RQ' or $contract_phase=='RN' or $contract_phase=='RF')
					 	// {
					 	// 	if($remaining_amt !='')
							// {
								
							// 	if(strlen($remaining_amt) == 12)
							// 	{
							// 		   $remaining_amt;
							// 	}else{
							// 		   $remaining_amt = str_repeat("0", 12 - strlen($remaining_amt)).$remaining_amt;
							// 	}

							// }else{
							// 	$remaining_amt = str_repeat("0", 12);
							// }
					 	// }

				}else{
					  array_push($error,array(
												'field'=>'contract_phase',
												'msg'=>"invalid Contract Phase Length",
												'status'=>1
										));
				}

			}else{
				array_push($error,array(
												'field'=>'contract_phase',
												'msg'=>"Contract Phase Can not be empty",
												'status'=>1
										));
			}

			if($contract_status !='')
			{
				if(strlen($contract_status) == 1)
				{
					 
				}else{
					 array_push($error,array(
												'field'=>'contract_status',
												'msg'=>"invalid Contract Status Length",
												'status'=>1
										));
				}

			}else{
				array_push($error,array(
												'field'=>'contract_status',
												'msg'=>"Contract Status Can not be empty",
												'status'=>1
										));
			}

			if($currency_code !='')
			{
				if(strlen($currency_code) == 3)
				{
					 
				}else{
					  array_push($error,array(
												'field'=>'currency_code',
												'msg'=>"invalid Currency Code Length",
												'status'=>1
										));
				}

			}else{
				array_push($error,array(
												'field'=>'currency_code',
												'msg'=>"Currency Code Can not be empty",
												'status'=>1
										));
			}

			if($defaulter_flag !='')
			{

				if(strlen($defaulter_flag) == 1)
				{
					 
				}else{
					 array_push($error,array(
												'field'=>'defaulter_flag',
												'msg'=>"invalid Defaulter Flag Length",
												'status'=>1
										));
				}

			}else{
				 array_push($error,array(
												'field'=>'defaulter_flag',
												'msg'=>"Defaulter Flag Can not be empty",
												'status'=>1
										));
			}
			if($section_limit !='')
			{
				if(strlen($section_limit) <= 12)
				{
					
				}else{
					 array_push($error,array(
												'field'=>'section_limit',
												'msg'=>"invalid Section Limit Length",
												'status'=>1
										));
				}

			}else{
				array_push($error,array(
												'field'=>'section_limit',
												'msg'=>"Section Limit Can not be empty",
												'status'=>1
										));
			}
			if($outstanding_amt !='')
			{

				if(strlen($outstanding_amt) <= 12)
				{
					 
				}else{
					 array_push($error,array(
												'field'=>'outstanding_amt',
												'msg'=>"Invalid Total Outstanding Amount Length",
												'status'=>1
										));
				}

			}else{
				array_push($error,array(
												'field'=>'outstanding_amt',
												'msg'=>"Total Outstanding Amount Can not be empty",
												'status'=>1
										));
			}
			
			if($type_of_installment !='')
			{
				if(strlen($type_of_installment) == 1)
				{
					 
				}else{
					 array_push($error,array(
												'field'=>'type_of_installment',
												'msg'=>"Invalid Type of Installment Length",
												'status'=>1
										));
				}

			}else{
				array_push($error,array(
												'field'=>'type_of_installment',
												'msg'=>"Type of Installment Can not be empty",
												'status'=>1
										));
			}
			if(!empty($error))
			$errorArray[$id]=$error;
		}
	}
}
	else//id given
	{
		$qIdCheck=mysql_query("SELECT *  FROM `contracts_info` WHERE `id` = '$id'");
		if(mysql_num_rows($qIdCheck)>0)//data found
		{
			$d=mysql_fetch_array($qIdCheck);
			$record_type = $d['record_type'];
			$fi_code = $d['fi_code'];
			$branch_code = $d['branch_code'];
			$fi_subject_code = $d['fi_subject_code'];
			$fi_contract_code = $d['fi_contract_code'];
			$contract_type = $d['contract_type'];
			$contract_phase = $d['contract_phase'];
			$contract_status = $d['contract_status'];
			$currency_code = $d['currency_code'];
			$currency_code_of_credit = $d['currency_code_of_credit'];
			$starting_date_of_contract = $d['starting_date_of_contract'];
			$request_date_of_the_contract = $d['request_date_of_the_contract'];
			$planned_end_date_of_the_contract = $d['planned_end_date_of_the_contract'];
			$actual_end_date_of_the_contract = $d['actual_end_date_of_the_contract'];
			$periodicity_of_payment = $d['periodicity_of_payment'];
			$method_of_payment = $d['method_of_payment'];
			$mnth_installment_amt = $d['monthly_instalment_amt'];
			$section_limit = $d['section_limit'];
			$exp_dt_next_installment = $d['exp_date_of_next_installment'];
			$remaining_amt = $d['remaining_amt'];
			$overdue_or_not_paid_installment = $d['number_of_overdue_and_not_paid_installment'];
			$overdue_amt = $d['overdue_amt'];
			$dt_of_last_chrg = $d['date_of_last_charge'];
			$type_of_installment = $d['type_of_installment'];
			$amt_chrg_month = $d['amount_charged_in_the_month'];
			$flag_card_month = $d['flag_card_used_in_the_month'];
			$monthly_used_card = $d['monthly_card_used_in_the_month'];
			$payment_delay_number = $d['payment_delay_number'];
			$recovery_due = $d['recovery_due'];
			$recovery_report_period = $d['recovery_during_the_reporting_period'];
			$comulative_recovery = $d['cumulative_recovery'];
			$dt_law_suit = $d['date_of_law_suit'];
			$dt_of_classification = $d['date_of_classification'];
			$rescheduled_number = $d['no_of_times_rescheduled'];
			$economic_purpose_code = $d['economic_purpose_code'];
			$defaulter_flag = $d['defaulter_flag'];
			$total_disburse_amt = $d['total_disburse_amt'];
			$outstanding_amt = $d['outstanding_amt'];
			$flag_update = $d['flag_update'];
			


			if($record_type !='')
			{
				if(strlen($record_type) == 1)
				{
					
				}else{
					array_push($error,array(
										'field'=>'record_type',
										'msg'=>"invalid Record Type Length",
										'status'=>1
									));
				}

			}else{
				array_push($error,array(
										'field'=>'record_type',
										'msg'=>"Record Type Can not be empty",
										'status'=>1
									));
			}


			if($fi_code !='')
			{
				if(strlen($fi_code) == 3)
				{
					 
				}else{
					 array_push($error,array(
										'field'=>'fi_code',
										'msg'=>"invalid FI Code Length",
										'status'=>1
									));
				}

			}else{
				array_push($error,array(
										'field'=>'fi_code',
										'msg'=>"FI Code Can not be empty",
										'status'=>1
									));
			}


			if($branch_code !='')
			{

				if(strlen($branch_code) == 4)
				{
					 
				}else{
					 array_push($error,array(
										'field'=>'branch_code',
										'msg'=>"invalid Branch Code Length",
										'status'=>1
									));
				}

			}else{
				array_push($error,array(
										'field'=>'branch_code',
										'msg'=>"Branch Code Can not be empty",
										'status'=>1
									));
			}


			if($fi_subject_code !='')
			{
				
				if(strlen($fi_subject_code) <= 16)
				{
					 
				}else{
					  array_push($error,array(
										'field'=>'fi_subject_code',
										'msg'=>"invalid FI Subject Code Length",
										'status'=>1
									));
				}

			}else{
				array_push($error,array(
										'field'=>'fi_subject_code',
										'msg'=>"FI Subject Code Can not be empty",
										'status'=>1
									));
			}
			

			if($fi_contract_code !='')
			{
				if(strlen($fi_contract_code) <= 16)
				{
					 
				}else{
					 array_push($error,array(
										'field'=>'fi_contract_code',
										'msg'=>"invalid FI Contract Code Length",
										'status'=>1
									));
				}

			}else{
				array_push($error,array(
										'field'=>'fi_contract_code',
										'msg'=>"FI Contract Code Can not be empty",
										'status'=>1
									));
			}
			

			if($contract_type !='')
			{
				if(strlen($contract_type) == 2)
				{
					 if($contract_type=='CR' or $contract_type=='CG')
					 {
					 	if($periodicity_of_payment !='')
						{
							if(strlen($periodicity_of_payment) == 1)
							{
								 
							}else{
								array_push($error,array(
										'field'=>'periodicity_of_payment',
										'msg'=>"invalid Periodicity of Payment Length",
										'status'=>1
									));
							}

						}else{
							array_push($error,array(
										'field'=>'periodicity_of_payment',
										'msg'=>"Periodicity of Payment Can not be empty",
										'status'=>1
									));
						}
					 }
				}else{
					 array_push($error,array(
										'field'=>'contract_type',
										'msg'=>"invalid Contract Type Length",
										'status'=>1
									));
				}

			}else{
				array_push($error,array(
										'field'=>'contract_type',
										'msg'=>"Contract Type Can not be empty",
										'status'=>1
									));
			}

			if($contract_phase !='')
			{

				if(strlen($contract_phase) == 2)
				{
					 	if($contract_phase=='LV' or $contract_phase=='TN' or $contract_phase=='TA' )
					 	{
					 			if($starting_date_of_contract !='')
								{
									//$st_contract = date('d-m-Y', strtotime($starting_date_of_contract));
									$st_contract_array  = explode("/",  $starting_date_of_contract);
									$starting_date_of_contract =  $st_contract_array[0].$st_contract_array[1].$st_contract_array[2];

									if(strlen($starting_date_of_contract) == 8)
									{
										 
									}else{
										array_push($error,array(
												'field'=>'starting_date_of_contract',
												'msg'=>"invalid Starting Date of Contract Length",
												'status'=>1
										));
									}

								}else{
									array_push($error,array(
												'field'=>'starting_date_of_contract',
												'msg'=>"Starting Date of Contract Can not be empty",
												'status'=>1
										));
								}
								if($planned_end_date_of_the_contract !='')
								{
									//$plan_contract = date('d-m-Y', strtotime($planned_end_date_of_the_contract));
									$pl_contract_array  = explode("/",  $planned_end_date_of_the_contract);
									$planned_end_date_of_the_contract =  $pl_contract_array[0].$pl_contract_array[1].$pl_contract_array[2];

									if(strlen($planned_end_date_of_the_contract) == 8)
									{
										 
									}else{
										array_push($error,array(
												'field'=>'planned_end_date_of_the_contract',
												'msg'=>"invalid Planned End Date of Contract Length",
												'status'=>1
										));
									}

								}else{
									array_push($error,array(
												'field'=>'planned_end_date_of_the_contract',
												'msg'=>"Planned End Date of Contract Can not be empty",
												'status'=>1
										));
								}
								if($actual_end_date_of_the_contract !='')
								{
									//$actual_contract = date('d-m-Y', strtotime($actual_end_date_of_the_contract));
									$actual_contract_array  = explode("/",  $actual_end_date_of_the_contract);
									$actual_end_date_of_the_contract =  $actual_contract_array[0].$actual_contract_array[1].$actual_contract_array[2];


									if(strlen($actual_end_date_of_the_contract) == 8)
									{
										 
									}else{
										 array_push($error,array(
												'field'=>'actual_end_date_of_the_contract',
												'msg'=>"invalid Actual End Date of Contract Length",
												'status'=>1
										));
									}

								}else{
									 array_push($error,array(
												'field'=>'actual_end_date_of_the_contract',
												'msg'=>"Actual End Date of Contract Can not be empty",
												'status'=>1
										));
								}
					 	}
					 	// if($contract_phase=='RQ' or $contract_phase=='RN' or $contract_phase=='RF')
					 	// {
					 	// 	if($remaining_amt !='')
							// {
								
							// 	if(strlen($remaining_amt) == 12)
							// 	{
							// 		   $remaining_amt;
							// 	}else{
							// 		   $remaining_amt = str_repeat("0", 12 - strlen($remaining_amt)).$remaining_amt;
							// 	}

							// }else{
							// 	$remaining_amt = str_repeat("0", 12);
							// }
					 	// }

				}else{
					  array_push($error,array(
												'field'=>'contract_phase',
												'msg'=>"invalid Contract Phase Length",
												'status'=>1
										));
				}

			}else{
				array_push($error,array(
												'field'=>'contract_phase',
												'msg'=>"Contract Phase Can not be empty",
												'status'=>1
										));
			}

			if($contract_status !='')
			{
				if(strlen($contract_status) == 1)
				{
					 
				}else{
					 array_push($error,array(
												'field'=>'contract_status',
												'msg'=>"invalid Contract Status Length",
												'status'=>1
										));
				}

			}else{
				array_push($error,array(
												'field'=>'contract_status',
												'msg'=>"Contract Status Can not be empty",
												'status'=>1
										));
			}

			if($currency_code !='')
			{
				if(strlen($currency_code) == 3)
				{
					 
				}else{
					  array_push($error,array(
												'field'=>'currency_code',
												'msg'=>"invalid Currency Code Length",
												'status'=>1
										));
				}

			}else{
				array_push($error,array(
												'field'=>'currency_code',
												'msg'=>"Currency Code Can not be empty",
												'status'=>1
										));
			}

			if($defaulter_flag !='')
			{

				if(strlen($defaulter_flag) == 1)
				{
					 
				}else{
					 array_push($error,array(
												'field'=>'defaulter_flag',
												'msg'=>"invalid Defaulter Flag Length",
												'status'=>1
										));
				}

			}else{
				 array_push($error,array(
												'field'=>'defaulter_flag',
												'msg'=>"Defaulter Flag Can not be empty",
												'status'=>1
										));
			}
			if($section_limit !='')
			{
				if(strlen($section_limit) <= 12)
				{
					
				}else{
					 array_push($error,array(
												'field'=>'section_limit',
												'msg'=>"invalid Section Limit Length",
												'status'=>1
										));
				}

			}else{
				array_push($error,array(
												'field'=>'section_limit',
												'msg'=>"Section Limit Can not be empty",
												'status'=>1
										));
			}
			if($outstanding_amt !='')
			{

				if(strlen($outstanding_amt) <= 12)
				{
					 
				}else{
					 array_push($error,array(
												'field'=>'outstanding_amt',
												'msg'=>"Invalid Total Outstanding Amount Length",
												'status'=>1
										));
				}

			}else{
				array_push($error,array(
												'field'=>'outstanding_amt',
												'msg'=>"Total Outstanding Amount Can not be empty",
												'status'=>1
										));
			}
			
			if($type_of_installment !='')
			{
				if(strlen($type_of_installment) == 1)
				{
					 
				}else{
					 array_push($error,array(
												'field'=>'type_of_installment',
												'msg'=>"Invalid Type of Installment Length",
												'status'=>1
										));
				}

			}else{
				array_push($error,array(
												'field'=>'type_of_installment',
												'msg'=>"Type of Installment Can not be empty",
												'status'=>1
										));
			}
		}
		else//no data foudn
		{
			array_push($error,array(
								'field'=>1,
								'msg'=>"Entry Not Found in Database",
								'status'=>0
							));
			
		}
		if(!empty($error))
		$errorArray[$id]=$error;
	}
	if(!empty($errorArray))
		return $errorArray;
	else
		return 0;
}
/*print "<pre>";
$reportingDate='';*/
//print_r(errorCheckContact(NULL,'2021-05-31'));
/*print "<pre>";
$reportingDate='';*/
//$errorArray=errorCheckContact(NULL, $reportingDate);
//print_r(processErrorArray($errorArray));
function processErrorArray($errorArray)
{
	$newArrayField=array();
	$newArray=array();
	foreach ($errorArray as $key => $value) {
			
			$id=$key;
			
			foreach ($value as $key1 => $errorId) {
					
				if(empty($newArray[$errorId['field']]))
				{
					$newArray[$errorId['field']]=array();
					array_push($newArray[$errorId['field']], $id);
					
				}
				else
				{
					array_push($newArray[$errorId['field']], $id);
					
				}
			}
			// array_push($newArray[$errorId['field']], $total);	
	}
	return $newArray;
}
?>