<?php 
    include('../../db/dbconnect.php');
    //session_start();
include('error_check_subject.php');
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Card | CIB Subject Error </title>
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
        <link rel="stylesheet" type="text/css" href="../../../../css/jquery-ui.css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="skin-blue">
        <?php
            include("../../database.php");
        ?>
        <!-- header logo: style can be found in header.less -->
        <?php include("../../../../header.php");?>        
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
             <?php include("../../../../menu.php");?>
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>Subject  Error </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="#">CIB</a></li>
                        <li class="active">Error Report</li>
                    </ol>
                </section>

                <!-- style -->

                <!-- Main content -->
                <section class="content">
                  <!-- <img src="../../img/loader.gif" class="page_loader" alt="Page loader"> -->
                    <div class="row">
                       
                <!-- download previous file -->
                    
                    


                      <div class="col-xs-12">
                            <div class="box">
                                <div class="box-body table-responsive">
                                    <table id="example1" class="table table-bordered table-striped table-hover table-responsive userlistTable">
                                        <thead>
                                            <tr>
                                                <th>SL</th>
                                                <th>Erro Type </th>
                                                <th>Error Code </th>
                                                <th>Error Details </th>
                                                <th>Total Error</th>
                                                <th>Details</th>
                                               
                                            </tr>
                                        </thead>
                                        <tbody>
                                          <?php 

                                           /*$report_dt_array = explode('/', $_GET['reporting_date']);
                                            $month = $report_dt_array[1]-1;
                                            $year = $report_dt_array[2];*/

                                          $q= mysql_query("SELECT * from cib_error where id < 141 order by error_code asc");
                                         // print mysql_num_rows($query);
                                          $sl=1;
                                          while( $result = mysql_fetch_array($q))
                                          {
                                            $id = $result['id'];
                                            $error_type = $result['error_type'];
                                            $error_code = $result['error_code'];
                                            $error_description = $result['error_description'];
                                            $query = $result['query'];
                                            $condition   = $result['condition'];
                                           // $query1="SELECT * FROM subject_info WHERE $condition  and  month(reporting_date) = '$month' and year(reporting_date) = '$year' ";

                                          

                                            if(!empty($condition))
                                            {
                                             
                                              $q1=mysql_query($query);
                                              $count=mysql_num_rows($q1);
                                              if($count>0)
                                              {
                                            ?>
 
                                            <tr>
                                              <td><?php echo $sl++ ?></td>
                                              <td><?php echo $result['error_type'] ?></td>
                                              <td><?php echo $result['error_code'] ?></td>
                                              <td><?php echo $result['error_description'] ?></td>
                                              <td><?php echo $count ?></td>
                                               <td> <a href="#" class="btn btn-primary" title="" onclick="showDetails(<?php echo $id ?>)"> Details </a></td>
                                            </tr>

                                            <?php
                                              }
                                            }

                                          }

                                           ?>
                                         
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
        <!-- DATA TABES SCRIPT -->
        <script src="../../../../js/plugins/datatables-button/jquery.dataTables.js" type="text/javascript"></script>
        <script src="../../../../js/plugins/datatables-button/pdfmake-0.1.36/pdfmake.min.js" type="text/javascript"></script>
        <script src="../../../../js/plugins/datatables-button/pdfmake-0.1.36/vfs_fonts.js" type="text/javascript"></script>
        <script src="../../../../js/plugins/datatables-button/JSZip-2.5.0/jszip.min.js" type="text/javascript"></script>
        <script src="../../../../js/plugins/datatables-button/datatables.min.js" type="text/javascript"></script>
        <!-- AdminLTE App -->
        <script src="../../../../js/AdminLTE/app.js" type="text/javascript"></script>
        <script src="../../../../js/sweetalert.min.js"></script>
        <script src="../../../../js/jquery-ui.js"></script>
        <!-- <script type="text/javascript">$('.userlistTable').DataTable();</script> -->

      

   <script>

      $( function() {

        $("#report_date" ).datepicker({dateFormat: 'dd/mm/yy'});

      });

       $('.userlistTable').DataTable({

            dom: 'Blfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ],
            lengthMenu: [ [50, 100, 150, -1], [50, 100, 150, "All"] ],

       });

      function showDetails(id,rdt)
      {
        console.log(rdt)
        popupWindow =window.open("errorDetails.php?id="+id,'newWindow1',' top=100, width=1000, height=600, left=100, scrollbars=1, toolbar=no,resizable=false');
        
      }
  </script>
    </body>
</html>

<?php 




 ?>