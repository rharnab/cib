<?php  include("database.php");
    include_once('db/dbconnect.php');
    include_once('functions/functions.php');
    include('common_script.php'); ?> 


<?php 
$status = $_POST['status'];
$account_array_list = $_POST['account_array_list'];
$accounts = implode(',', str_replace(' ','' , $account_array_list));

    
    //session_start();
    $approve_id  = $_SESSION['login_id'];
    $approveDate = date('Y-m-d');
    $batch_num   = mt_rand(111111,999999);



    $select_batch = $conn->prepare("SELECT * FROM debit_card_api WHERE approve_by_id=? AND approve_date=?");
    $select_batch->bindParam(1,$approve_id);
    $select_batch->bindParam(2,$approveDate);
    $select_batch->execute();
    $rowData = $select_batch->fetch(PDO::FETCH_ASSOC);

    $fb_num = '';

    if($rowData['batch_num'] == ''){
        $fb_num = $batch_num;
    }else{
        $fb_num = $rowData['batch_num'];
    }
   
    

    // update debit card api approve_date //
    if($_SESSION['branch_id'] =='1')
    {
 
        

       $update_aprrove =  mysql_query("UPDATE debit_card_api set card_status='$status', approve_by_id='$approve_id', approve_date='$approveDate', batch_num='$fb_num', status='2' where accountno in ($accounts) ");

     if($update_aprrove)
      {

        foreach($account_array_list as $account)
        {

           sendSMS($account);
        }

      }
       	
   
    }else{

    	$update_aprrove= mysql_query("UPDATE debit_card_api set status='1' where accountno in ($accounts) ");

        if($update_aprrove)
          {

            foreach($account_array_list as $account)
            {

               sendSMS($account);
            }

          }
     
    }

    
    
    if($update_aprrove){
        //send_mobile_sms($message,$phone);
        echo "Approve has been success!";
    }else{
        echo "Approve has been failed!";
    }




 ?>