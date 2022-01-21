<?php include("../database.php") ?>


<?php

$report_date = date('Y-m', strtotime($_POST['cib_date']));
$accounting_date=date('Y-m-t', strtotime($report_date." -1 month"));
$acc_dt_array = explode("-", $accounting_date);
$acc_year= $acc_dt_array[0];
$acc_month= $acc_dt_array[1];



$sql =mysql_query("SELECT * from contracts_info ci where year (reporting_date) ='$acc_year' and month (reporting_date)='$acc_month'");
$sl=1;
?>

    
    <table class="table table-bordered userlistTable" style="font-size: 12px">
              <thead style="background-color: #009688; color: white; text-transform: uppercase;">
                <tr>
                  <th>SL</th>
                  <th>RECORD TYPE</th>
                  <th>F.I. CODE</th>
                  <th>BRACNH CODE</th>
                  <th>FI. SUBJECT CODE</th>
                  <th>FI. CONTRACT CODE</th>
                  <th>CONTRACT TYPE</th>
                  <th>CONTRACT PHASE</th>
                  <th>CONTRACT STATUS</th>
                  <th>CURRENCY CODE</th>
                  <th>CURRENCY CODE OF CREDIT</th>
                  <th>STARTIG DATE OF THE CONTRACT</th>
                  <th>REQUEST DATE OF THE CONTRACT</th>
                  <th>PLANNED END DATE OF THE CONTRACT</th>
                  <th>ACTUAL END DATE OF THE CONTRACT</th>
                  <th>PAYMENT PERIODICITY</th>
                  <th>PAYMENT METHOD</th>
                  <th>MONTHLY INSTALMENT</th>
                  <th>SECTION LIMIT</th>
                  <th>EX. DATE OF NEXT INSTALLMENT</th>
                  <th>REMAINING AMOUNT</th>
                  <th>PAID INSTALMENTS</th>
                  <th>OVERDUE AMOUNT</th>
                  <th>LAST CHARGE DATE</th>
                  <th>INSTALLMENT TYPE</th>
                  <th>MONTHLY CHARGE AMT</th>
                  <th>MONTHLY FALG CARD USED</th>
                  <th>MONTHLY CARD USED</th>
                  <th>PAYMENT DELAY NUMBER</th>
                  <th>RECOVERY DUE</th>
                  <th>RECOVERY REPORTING PERIOD</th>
                  <th>COMULATIVE RECOVERY</th>
                  <th>LAW SUIT DATE</th>
                  <th>CLASSIFICATION DATE</th>
                  <th>RESCHEDULED NUMBER</th>
                  <th>ECONOMIC PURPOSE CODE</th>
                  <th>DEFAULTER FLAG</th>
                  <th>TOTAL DSBRS AMT </th>
                  <th>OUTSTANDING AMT</th>
                  <th>FLAG UPDATE</th>
                 
                </tr>
              </thead>
              <tbody >
              	<?php
              	$sl=1;
              	 while($data = mysql_fetch_array($sql))
					{
						

             		

					 ?>
		              	<tr>
				        	  <td><?php echo $sl++ ?></td>
			                  <td ><?php echo $data['record_type'] ?></td> 
			                  <td><?php echo $data['fi_code'] ?></td>
			                  <td><?php echo $data['branch_code'] ?></td>
			                  <td><?php echo $data['fi_subject_code'] ?></td>

			                  <td><?php echo $data['fi_contract_code'] ?></td>

			                  <td><?php echo $data['contract_type'] ?></td>

			                  <td><?php echo $data['contract_phase'] ?></td>

			                  <td><?php echo $data['contract_status'] ?></td>

			                  <td><?php echo $data['currency_code'] ?></td>

			                  <td><?php echo $data['currency_code_of_credit'] ?></td>

			                  <td><?php echo $data['starting_date_of_contract'] ?></td>

			                  <td><?php echo $data['request_date_of_the_contract'] ?></td>

			                  <td><?php echo $data['planned_end_date_of_the_contract'] ?></td>

			                  <td><?php echo $data['actual_end_date_of_the_contract'] ?></td>

			                  <td><?php echo $data['periodicity_of_payment'] ?></td>

	                          <td><?php echo $data['method_of_payment'] ?></td> 

	                          <td><?php echo $data['monthly_instalment_amt'] ?></td>

	                          <td><?php echo $data['section_limit'] ?></td>

	                          <td><?php echo $data['exp_date_of_next_installment'] ?></td>

	                          <td><?php echo $data['remaining_amt'] ?></td>

	                          <td><?php echo $data['number_of_overdue_and_not_paid_installment'] ?></td>

	                          <td><?php echo $data['overdue_amt'] ?></td>

	                          <td><?php echo $data['date_of_last_charge'] ?></td>

	                          <td><?php echo $data['type_of_installment'] ?></td>

	                          <td><?php echo $data['amount_charged_in_the_month'] ?></td>

	                          <td><?php echo $data['flag_card_used_in_the_month'] ?></td>

	                          <td><?php echo $data['monthly_card_used_in_the_month'] ?></td>

	                          <td><?php echo $data['payment_delay_number'] ?></td>

	                          <td><?php echo $data['recovery_due'] ?></td>

	                          <td><?php echo $data['recovery_during_the_reporting_period'] ?></td>

	                          <td><?php echo $data['cumulative_recovery'] ?></td>

	                          <td><?php echo $data['date_of_law_suit'] ?></td>

	                          <td><?php echo $data['date_of_classification'] ?></td>

	                          <td><?php echo $data['no_of_times_rescheduled'] ?></td> 

	                          <td><?php echo $data['economic_purpose_code'] ?></td>


	                          <td><?php echo $data['defaulter_flag'] ?></td>


	                          <td><?php echo $data['total_disburse_amt'] ?></td>

	                          <td><?php echo $data['outstanding_amt'] ?></td>

	                         <td><?php echo $data['flag_update'] ?></td>
					       
				       </tr>
		 			 <?php } ?>
                
                
               </tbody>
              </table>  

     <script type="text/javascript">
      $('.userlistTable').DataTable({

      });
   </script>
     <script src="../../../js/sweetalert.min.js"></script>


    





