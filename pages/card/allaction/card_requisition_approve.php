<?php 
    include_once('../db/dbconnect.php');
    include_once('../functions/functions.php');

    $approve_id  = $_SESSION['id'];
    $approveDate = date('Y-m-d');
    $status      = '';
    $acc_num     = "";

    if(isset($_POST['accno'])){
    	$acc_num = trim(mysql_real_escape_string($_POST['accno']));
    }
    if(isset($_POST['status'])){
        $status = trim(mysql_real_escape_string($_POST['status']));
    }

echo $status;
   


    	  // update debit card api approve_date //
		    $update_aprrove = $conn->prepare("UPDATE debit_card_api SET status=? WHERE accountno=?");
		    $update_aprrove->bindParam(1,$status);
		    $update_aprrove->bindParam(2,$acc_num);
		    if($update_aprrove->execute()){
		        //send_mobile_sms($message,$phone);
		        echo "<p class='alert alert-success'>Approve has been success!</p>";
		    }else{
		        echo "<p class='alert alert-warning'>Approve has been failed!</p>";
		    }

    

    
   
    

  

?>