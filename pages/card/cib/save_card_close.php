<?php 
ini_set('max_execution_time', '0'); // for infinite time of execution 
include("../database.php");
date_default_timezone_set('Asia/dhaka');

if(isset($_FILES['input_file']))
{ 

	$file_name = $_FILES['input_file']['name'];
	$ext = explode(".", $file_name);
	$total_inssert  = 0;
	$entry_by = $_SESSION['login_id'];
    $tag = $_POST['tag'];
    $today = date('Y-m-d h:i:s');


	if($ext[1] =='TXT' or $ext[1] =='txt')
	{
		$fp = fopen($_FILES['input_file']['tmp_name'],'r');
		if ($fp) {
             $data = explode("\n", fread($fp, filesize($_FILES['input_file']['tmp_name'])));

             //echo  "<pre>";
             //print_r($data);

            foreach($data as $key=>$val)
            {
            	if($key > 12)
            	{
            		//echo "<pre>";
            	
            		$data_value =explode('|', $val);

            		if(isset($data_value[2]))
            		{
            			$card_no = trim(str_replace(' ', '', $data_value[2])); //remove card no
            			if( !empty($card_no)  && $card_no != 'CARDNO' )
            			{

            				//print_r($data_value);
            				$client_id = trim($data_value[1]);
            				$card_no = trim($card_no);
            				$customer_name = trim($data_value[3]);
            				$account_no = trim($data_value[4]);
            				$closing_date_val = trim($data_value[5]);

                           $closing_date_array  =explode('/', $closing_date_val);
                           $closing_date = $closing_date_array[2]."-".$closing_date_array[1]."-".$closing_date_array[0];

            				$card_status = trim($data_value[6]);
            				$address = mysql_real_escape_string($data_value[7]);
            				$phone = trim($data_value[8]);
            				$mobile = trim($data_value[9]);

            				$phone= mysql_real_escape_string(trim(str_replace("(", "", str_replace(")", "", substr($phone, 4))))); 
							 $mobile=mysql_real_escape_string(trim(str_replace("(", "", str_replace(")", "", substr($mobile, 4)))));

                             $duplicate = mysql_query("SELECT card_no from card_close where card_no= '$card_no' and account_no='$account_no' ");

                             //echo "SELECT card_no from card_close where card_no= '$card_no' and account_no='$account_no' ";
                            if( mysql_num_rows($duplicate) == 0 )
                            {
                                $insert = mysql_query("INSERT INTO card_close (client_id, card_no, customer_name, account_no, closing_date, address, phone, card_status, entry_by, entry_date, file_name, tag, mobile, status) values ('$client_id', '$card_no', '$customer_name', '$account_no', '$closing_date', '$address', '$phone', '$card_status', '$entry_by', '$today', '$file_name', '$tag', '$mobile', '0') ");

                                 
                                 if($insert)
                                 {
                                    $total_inssert = $total_inssert + 1;
                                 }
                            }



							 

            			}
            			
            		}
            		


            	}
            	
            }
          } 
	}

    echo $total_inssert." Close card insert successful ";
}





 ?>