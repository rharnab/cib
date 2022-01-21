<?php require_once('../../../../login-authentication.php');?>
<?php 
    include('../../db/dbconnect.php');
   //session_start();
?>
<?php
 include("../../database.php");
?>


<?php 

$frm = date('Y-m-t', strtotime($_GET['frm']." -1 month"));

$dt_array = explode("-", $frm);
$year= $dt_array[0];
$month= $dt_array[1];
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>CIB </title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- bootstrap 3.0.2 -->
        <link href="../../../../css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="../../../../css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="../../../../css/ionicons.min.css" rel="stylesheet" type="text/css" />
        
        <!-- Theme style -->
        <link href="../../../../css/AdminLTE.css" rel="stylesheet" type="text/css" />

        <!-- DATA TABLES -->
        <link href="../../../../css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />

        



        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="skin-blue">
        <!-- style -->
<style type="text/css">
  .page_loader{
    position: absolute;
    z-index: 1;
    left: 27%;
    width: 37%
  }

  .paginate_button.active .page-link {

  background-color: grey !important;
  border: 1px solid red !important;
}
</style>
          
        
        <!-- header logo: style can be found in header.less -->
        <?php include("../../../../header.php");?>        
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
             <?php include("../../../../menu.php");?>
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>Contract Error  Report (<?php echo date('m-Y', strtotime($_GET['frm'])); ?>) </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="#">Report</a></li>
                        <li class="active">Contract Error  Report</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <img src="../img/loader.gif" class="page_loader" alt="Page loader">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
                                <div class="box-body table-responsive">

                                    
                                   
                                    <table id="example" class="table table-bordered table-striped table-hover table-responsive">
                                        <thead>
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
                                        <tbody>
                                           
                                          
                                                <?php

            $sql =mysql_query(" SELECT * from contracts_info where status='0' " );



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
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>
                    </div>

               

                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->


        <!-- jQuery 2.0.2 -->
       <script src="../../../../js/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="../../../../js/bootstrap.min.js" type="text/javascript"></script>
        <!-- DATA TABES SCRIPT -->
        <script src="../../../../js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
        <script src="../../../../js/plugins/datatables-button/datatables.min.js" type="text/javascript"></script>
        <!-- AdminLTE App -->
        <script src="../../../../js/AdminLTE/app.js" type="text/javascript"></script>
        <script src="../../../../js/sweetalert.min.js"></script>

        <script type="text/javascript">
            $(function() {

                $('.page_loader').hide();

                $('#example').DataTable({

                        dom: 'Blfrtip',
                        buttons: [
                            'copy', 'excel', 'pdf'
                        ],


                        lengthMenu: [ [50, 100, 150, -1], [50, 100, 150, "All"] ],

                        "bPaginate": true,
                        "bLengthChange": false,
                        "bFilter": false,
                        "bSort": true,
                        "bInfo": true,
                        scrollX: true
                        

                   });
            });
        </script>
    </body>
</html>