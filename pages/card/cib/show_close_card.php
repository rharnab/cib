<?php require_once('../../../login-authentication.php');?>
<?php 
    include('../db/dbconnect.php');
   //session_start();
?>
<?php
 include("../database.php");
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>CIB </title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- bootstrap 3.0.2 -->
        <link href="../../../css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="../../../css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="../../../css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!-- DATA TABLES -->
        <link href="../../../css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="../../../css/AdminLTE.css" rel="stylesheet" type="text/css" />
        <!-- Coustom StyleSheet -->
        <link rel="stylesheet" href="../../../css/style.css">
          <link href="../../../css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />

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
        <?php include("../../../header.php");?>        
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
             <?php include("../../../menu.php");?>
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>All Close Card</h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="#">CIB Report</a></li>
                        <li class="active">all Close Card</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <img src="../img/loader.gif" class="page_loader" alt="Page loader">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
                                <div class="box-body table-responsive">

                                    
                                    <button id="process_close" style="float: right;" type="button" class="btn btn-primary" > Process Card Close </button>
                                    <table id="example" class="table table-bordered table-striped table-hover table-responsive">
                                        <thead>
                                            <tr>
                                                <th>SL</th>
                                                <th>Customer Name</th>
                                                <th>Client ID</th>
                                                <th>Card No</th>
                                                <th>Account No</th>
                                                <th>Closing Date</th>
                                                <th style=" width: 20%">address</th>
                                                <th>Mobile</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            $sl =1;
                                          $query  = mysql_query("SELECT * from card_close");
                                          if(mysql_num_rows($query) > 0)
                                          {
                                            while($result = mysql_fetch_assoc($query))
                                            {

                                                ?>

                                                <tr>
                                                    <td>  <?php echo $sl++; ?> </td>
                                                    <td><?php echo $result['customer_name'] ?></td>
                                                    <td><?php echo $result['client_id'] ?></td>
                                                    <td><?php echo $result['card_no'] ?></td>
                                                    <td><?php echo $result['account_no'] ?></td>
                                                    <td><?php echo $result['closing_date'] ?></td>
                                                    <td style=" width: 20%"><?php echo $result['address'] ?></td>
                                                    <td><?php echo $result['mobile'] ?></td>
                                                    <td><?php echo ($result['status']==0)? 'Not Report': 'Reported' ?></td>
                                                </tr>
                                                <?php

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
       <script src="../../../js/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="../../../js/bootstrap.min.js" type="text/javascript"></script>
        <!-- DATA TABES SCRIPT -->
        <script src="../../../js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
        <script src="../../../js/plugins/datatables-button/datatables.min.js" type="text/javascript"></script>
        <!-- AdminLTE App -->
        <script src="../../../js/AdminLTE/app.js" type="text/javascript"></script>
        <script src="../../../js/sweetalert.min.js"></script>

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


            $('#process_close').click(function(){

                 swal({
                  title: "DO YOU WANT PROCESS THIS  ?? ",
                  icon: "success",
                  buttons: true,
                  dangerMode: true,
                })
                 .then((y)=>{

                    
                    $('.page_loader').show();
                    $.ajax({
                        url:'process_close_card.php',
                        type:'POST',
                        data:{},
                        success:function(data)
                        {
                            $('.page_loader').hide();
                            swal(data);
                            
                            //location.reload();
                            console.log(data);
                        }

                    });

                    

                 });

            });

        </script>
    </body>
</html>