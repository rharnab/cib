<?php
	include_once("../db/dbconnect.php");
	include('../database.php');
	//session_start();
	$user_id = $_SESSION['login_id'];
	$branch_id = $_SESSION['branch_id'];
	$currentDate = date('Y-m-d h:i:s'); // current date //
	$accNumber  = '';
	$noc        = '';
	$card_action = '';

	if(isset($_POST['data'])){
		$accNumber = mysql_real_escape_string($_POST['data']);
	}
	if(isset($_POST['noc'])){
		$noc = mysql_real_escape_string($_POST['noc']);
	}
	
	if(isset($_POST['card_action'])){
		$card_action = mysql_real_escape_string($_POST['card_action']);
	}

	// get data from flora api //
	/*$file_get_contents = file_get_contents("http://172.19.11.1/CBS_API/account_info?acc=$accNumber");
	$api_data = json_decode($file_get_contents,true); */// creating array //

	$api_data ='';
	if(!empty($api_data)){
		echo "<p class='alert alert-warning'>Please enter valid account number!</p>";
	}else{
		/*$debit_insert = $conn->prepare("INSERT INTO debit_card_api SET accountno=?,customerid=?,accounttype=?,actypecode=?,accountname=?,accstatus=?,accnameoncard=?,accopendate=?,accfather=?,nationalid=?,accphone=?,accotheremail=?,accotherphone=?,accaddress=?,accdateofbirth=?,accsex=?,bal_tk=?,entry_by_id=?,requestDate=?");*/

		$substr = substr('1234567899874',4,3); // get  account type code //

		$debit_insert = mysql_query("INSERT INTO debit_card_api (accountno, customerid, accounttype, actypecode, accountname, accstatus, accnameoncard, accopendate, accfather, nationalid, accphone, accotheremail, accotherphone, accaddress, accdateofbirth,accsex, bal_tk, entry_by_id, requestDate, card_status, status) VALUES ('1234567899874', '455475', '123', '$substr', 'ramjan', 'Active', '454', '2021-07-15', 'father house', '1234567891234', '01879555887', 'rharnab@gmail.com', '018935554547', 'dhaka', '2021-07-15', 'Male', '12021.00','1000', '2021-07-15', '$card_action', '0')");


		if($debit_insert)
		{
			mysql_query("INSERT INTO card_action (accont_no, request_type, request_by_br, request_date_br, request_branch, card_no, card_on_name) values('1234567899874', '$card_action', '$user_id', '$currentDate', '$branch_id', '', '$noc') ");

			
		}

		

		/*$debit_insert->bindParam(1,$api_data['accountno']);
		$debit_insert->bindParam(2,$api_data['customer']);
		$debit_insert->bindParam(3,$api_data['glhead']);
		$debit_insert->bindParam(4,$substr);
		$debit_insert->bindParam(5,$api_data['acname']);
		$debit_insert->bindParam(6,$api_data['status']);
		$debit_insert->bindParam(7,$noc);
		$debit_insert->bindParam(8,$api_data['opend']);
		$debit_insert->bindParam(9,$api_data['father_hus']);
		$debit_insert->bindParam(10,$api_data['National_id']);
		$debit_insert->bindParam(11,$api_data['pre_mobilno']);
		$debit_insert->bindParam(12,$otherEmail);
		$debit_insert->bindParam(13,$otherPhone);
		$debit_insert->bindParam(14,$api_data['sub_head_addr']);
		$debit_insert->bindParam(15,$api_data['dob']);
		$debit_insert->bindParam(16,$api_data['sex']);
		$debit_insert->bindParam(17,$api_data['bal_tk']);
		$debit_insert->bindParam(18,$user_id);
		$debit_insert->bindParam(19,$currentDate);*/


	/*	$stmt = $dbh->prepare("INSERT INTO REGISTRY (name, value) VALUES (:name, :value)");
$stmt->bindParam(':name', $name);
$stmt->bindParam(':value', $value);*/

		if($debit_insert){
			echo "<p class='alert alert-success'>You has been successfully created request!</p>";
		}else{
			echo "<p class='alert alert-danger'>System error occurred!</p>";
		}
	}
?>