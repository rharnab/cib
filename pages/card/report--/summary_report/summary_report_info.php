<?php require_once('../../../../login-authentication.php');?>
<?php 
    include('../../db/dbconnect.php');
   //session_start();
?>
<?php
 include("../../database.php");
?>


<?php 
    $frm = $_GET['frm'];
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
        <!-- DATA TABLES -->
        <link href="../../../../css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="../../../../css/AdminLTE.css" rel="stylesheet" type="text/css" />
        <!-- Coustom StyleSheet -->
        <link rel="stylesheet" href="../../../../css/style.css">
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
                    <h1>Summary Report</h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="#">CIB</a></li>
                        <li class="active">Summary Report</li>
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
                                                <th>Column Name</th>
                                                <th>Value </th>
                                                <th>Report Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                           
                                          

                                           <tr>

                                                <th>1</th>
                                                <th> This Month Card CLose  </th>
                                                <td>
                                                    
                                                     <?php

                                                       $summary_query_card_close = mysql_query(" SELECT count(id) total_close_card, reporting_date from contracts_info where fi_contract_code in  (select card_no from card_close where status = 1) and status = 1   ");


                                                       $sl=1;

                                                      $summary_data_card_close = mysql_fetch_array($summary_query_card_close);

                                                      echo $summary_data_card_close['total_close_card'];

                                                       ?>


                                                </td>
                                                <td><?php  echo $summary_data_card_close['reporting_date']; ?></td>
                                                
                                            </tr>


                                            <tr>
                                                <th>2</th>
                                                <th> Total Card  Close Pending  </th>
                                                <td>
                                                    
                                                     <?php

                                                       $summary_query = mysql_query(" SELECT count(id) as total_close_card  from card_close where status=0 ");


                                                       $sl=1;

                                                      $summary_data= mysql_fetch_array($summary_query);

                                                      echo $summary_data['total_close_card'];

                                                       ?>


                                                </td>
                                                <td></td>
                                                
                                            </tr>
                                           
                                            
                                            <tr>
                                                <th>3</th>
                                                <th>Correct Subject</th>
                                                <td> 
                                                  <?php

                                                       $summary_query_correct_sub = mysql_query(" SELECT count(id) as total_correct_sub, reporting_date FROM `subject_info` where status='1'  ");


                                                       $sl=1;

                                                      $summary_data_correct_sub= mysql_fetch_array($summary_query_correct_sub);

                                                      echo $summary_data_correct_sub['total_correct_sub'];

                                                       ?></td>
                                                <td><?php  echo $summary_data_correct_sub['reporting_date']; ?></td>
                                            </tr>



                                              <tr>
                                                <th>4</th>
                                                <th>Error Subject</th>
                                                <td> <?php

                                                       $summary_query_error_sub = mysql_query(" SELECT count(id) as total_correct_sub, reporting_date FROM `subject_info` where status='0'  ");


                                                       $sl=1;

                                                      $summary_data_error_sub= mysql_fetch_array($summary_query_error_sub);

                                                      echo $summary_data_error_sub['total_correct_sub'];

                                                       ?></td>
                                                <td><?php  echo $summary_data_error_sub['reporting_date']; ?></td>
                                            </tr>

                                            <tr>
                                                <th>5</th>
                                                <th>Reported Subject</th>
                                                <td> <?php

                                                       $summary_query_error_sub = mysql_query(" SELECT count(id) as total_correct_sub, reporting_date FROM `subject_info` where status='2'  ");


                                                       $sl=1;

                                                      $summary_data_error_sub= mysql_fetch_array($summary_query_error_sub);

                                                      echo $summary_data_error_sub['total_correct_sub'];

                                                       ?></td>
                                                <td><?php  echo $summary_data_error_sub['reporting_date']; ?></td>
                                            </tr>



                                            <tr>
                                              <th>6 </th>
                                                <th>Correct Contract</th>
                                                 <td> <?php

                                                       $summary_query_error_con = mysql_query(" SELECT count(id) as error_contact_count, reporting_date from contracts_info where status='1' ");


                                                       $sl=1;

                                                      $summary_data_error_con= mysql_fetch_array($summary_query_error_con);

                                                      echo $summary_data_error_con['error_contact_count'];

                                                       ?></td>

                                                       
                                                <td><?php  echo $summary_data_error_con['reporting_date']; ?></td>
                                            </tr>


                                              <tr>
                                                 <th> 7 </th>
                                                 <th>Error Contract</th>
                                                 <td> <?php

                                                       $summary_query_error_con = mysql_query(" SELECT count(id) as error_contact_count, reporting_date from contracts_info where status='0' ");


                                                       $sl=1;

                                                      $summary_data_error_con= mysql_fetch_array($summary_query_error_con);

                                                      echo $summary_data_error_con['error_contact_count'];

                                                       ?></td>

                                                       
                                                <td><?php  echo $summary_data_error_con['reporting_date']; ?></td>
                                            </tr>


                                                
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
                        "bInfo": true
                        

                   });
            });
        </script>
    </body>
</html>