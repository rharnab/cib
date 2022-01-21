<?php include('../database.php'); ?>

<?php 

//fetch branch code
function  fetch_brach_code($name)
{
	$br_query = mysql_query("select br_name, br_code from branch b where br_name ='$name'");
	$br_result =mysql_fetch_array($br_query);
	return $br_result;

}

//fetch contracts_phase
function  fetch_contract_phase($status)
{
	if($status =='Restricted')
	{
		$st = 'Refused';
	}
	else if($status =='Closed')
	{
		$st = 'Terminated';
	}
	else if($status =='Closed')
	{
		$st = 'Terminated';
	}else{
		$st = 'Living';
	}
	$phase_query = mysql_query("select value, description from contract_phases cp  where description='$st'");
	$phase_result =mysql_fetch_array($phase_query);
	return $phase_result;

}

//fetch from sectorlis

function fetch_sector_list()
{
	$sector_list = mysql_query("SELECT code from sector_list where name='Service Holders (Salaried Person)' ");
	$sector_result = mysql_fetch_array($sector_list);
	return $sector_result['code'];
}

//fetch from contract type

function fetch_contract_type()
{
	$contract_query = mysql_query("SELECT value from contract_types where description ='Credit Card (Revolving)' ");
	$contract_result = mysql_fetch_array($contract_query);
	return $contract_result['value'];
}

function fetch_currency_code()
{
	$currency_sql= mysql_query("SELECT currency_code_id from currency_codes where value ='BDT' ");
	$currency_result = mysql_fetch_array($currency_sql);
	return $currency_result['currency_code_id'];
}

function fetch_periodicity()
{
	$periodicity_sql= mysql_query("SELECT value from periodicity where description ='monthly instalments-30 days' ");
	$periodicity_result = mysql_fetch_array($periodicity_sql);
	return $periodicity_result['value'];
}

function fetch_payment()
{
	$payment_sql= mysql_query("SELECT value from payment_method where description ='Cash' ");
	$payment_result = mysql_fetch_array($payment_sql);
	return $payment_result['value'];
}


function flora_fi_subject_code($nid_number)
{
	file_put_contents("12.txt", 'http://172.19.11.143/FLORA_API/customer_nid_check.php?nid_number='.$nid_number."\n", FILE_APPEND);
		$nid_number = trim($nid_number);
	    $curl = curl_init();
	    //2693622287854
		curl_setopt_array($curl, array(
		  CURLOPT_URL => 'http://172.19.11.143/FLORA_API/customer_nid_check.php?nid_number='.$nid_number,
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => '',
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => 'GET',
		));

		$response = curl_exec($curl);
		
		//echo $response;
		curl_close($curl);
		//echo "<pre>";
		$account_info = json_decode($response, true);
		
		//print_r($account_info);
		// file_put_contents('nid.txt', 'http://172.19.11.143/FLORA_API/customer_nid_check.php?nid_number='.$nid_number."fi=".$account_info->customer_id.PHP_EOL, FILE_APPEND);
		if($account_info['is_error'] === false)
		{	
			$customer_id = $account_info['customer_id'];		
			
			return  $customer_id = trim($account_info['customer_id']);

		}else{
			
			return $customer_id = '';
		}


	   
		 
}


function getRate()
{
	return $rate = 80.50;

}

function getSuppleInfo($year, $month, $nid_number)
{
	 $query = mysql_query(" SELECT  national_id, tin, mobile_no, reporting_date, client_id, card_no, card_status, contract,create_date, exp_date, caredit_limit_bdt , outstanding_bdt, total_outstanding_bdt , mp_due_bdt, reporting_date, deliquency,file_name, overdue_amt_bdt, caredit_limit_usd, outstanding_usd, overdue_amt_usd, mp_due_usd, caredit_limit_usd, total_outstanding_usd from cl_table mt where year(reporting_date)='$year' and month(reporting_date)='$month' and national_id='$nid_number'  order by id asc limit 1 ");


	    $supple_result = mysql_fetch_assoc($query);


	    if($supple_result !='' )
	    {
	    	if($supple_result['caredit_limit_usd'] > 0)
		    {
		    	

		    	$usd_rate = getRate();
				$section_limit = $supple_result['caredit_limit_usd'] * $usd_rate; ###-- Credit limit --#######
				$remaining_amt = str_replace(',', '', $supple_result['outstanding_usd']) * $usd_rate;  ###--- out_standing_bdt ---- #####
				$overdue_amt= str_replace(',', '', $supple_result['overdue_amt_usd']) * $usd_rate;
				$recovery_due = str_replace(',', '', $supple_result['mp_due_usd']) * $usd_rate;
				$total_disburse_amt = str_replace(',', '', $supple_result['caredit_limit_usd']) * $usd_rate;
				$outstanding_amt =  str_replace(',', '', $supple_result['total_outstanding_usd']) * $usd_rate;
				$is_dollar = 1;

				$response = array('section_limit'=>$section_limit, 'remaining_amt'=>$remaining_amt, 'overdue_amt'=>$overdue_amt, 'recovery_due'=> $recovery_due, 'total_disburse_amt'=>$total_disburse_amt, 'outstanding_amt'=>$outstanding_amt, 'is_dollar' => $is_dollar);


				

				return $response;

		    }else{

		    	$section_limit = $supple_result['caredit_limit_bdt']; ###-- Credit limit --#######
				$remaining_amt = str_replace(',', '', $supple_result['outstanding_bdt']);  ###--- out_standing_bdt ----
				$overdue_amt= str_replace(',', '', $supple_result['overdue_amt_bdt']);
				$recovery_due = str_replace(',', '', $supple_result['mp_due_bdt']);
				$recovery_during_the_reporting_period ='';
				$total_disburse_amt = str_replace(',', '', $supple_result['caredit_limit_bdt']);
				$outstanding_amt =  str_replace(',', '', $supple_result['total_outstanding_bdt']);
				$is_dollar = 0;

				$response = array('section_limit'=>$section_limit, 'remaining_amt'=>$remaining_amt, 'overdue_amt'=>$overdue_amt, 'recovery_due'=> $recovery_due, 'total_disburse_amt'=>$total_disburse_amt, 'outstanding_amt'=>$outstanding_amt, 'is_dollar' => $is_dollar);

				

				return $response;

		    }
	    }else{
	    	return "Data not found";
	    }
	    

	   


}




 ?>