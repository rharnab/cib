<?php 
    include('../../db/dbconnect.php');
    //session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Card | CIB Error Reprot</title>
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
                    <h1>CIB Error Report</h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="#">CIB</a></li>
                        <li class="active">Error Report</li>
                    </ol>
                </section>

<!-- style -->
<style type="text/css">
  .page_loader{
    position: absolute;
    z-index: 1;
    left: 27%;
    width: 37%
  }
</style>
                <!-- style -->

                <!-- Main content -->
                <section class="content">
                  <!-- <img src="../../img/loader.gif" class="page_loader" alt="Page loader"> -->
                    <div class="row">
                        <div class="col-xs-6">
                            <div class="box">
                               <div class="box-header">
                                </div><!-- /.box-header -->

                              <div class="box-body">
                                  <!-- from -->
                                   <div class="tile-body">
                                      <form id="defaultForm" class="form-horizontal" name="info" action="error_detailsXl.php" method="post" enctype="multipart/form-data">
                                      

                                        <div class="form-group row">
                                        <label class="control-label col-md-3">Reporting Data</label>
                                        <div class="col-md-8">
                                          <input class="form-control" type="text"  name="report_date" placeholder="reporting  date" id="report_date">
                                        </div>
                                      </div>

                                      

                                     

                                      <div class="tile-footer">
	                                    <div class="row">
	                                      <div class="col-md-8 col-md-offset-3">
	                                        <button class="btn btn-primary" type="submit" name="download" id="submitbtn"><i class="fa fa-fw fa-lg fa-check-circle"></i>Download</button></div>
	                                      </div>
	                                    </div>
                                  </form>
                                  </div>

                                  <!-- from -->
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
        <script src="../../../../js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
        <!-- AdminLTE App -->
        <script src="../../../../js/AdminLTE/app.js" type="text/javascript"></script>
        <script src="../../../../js/sweetalert.min.js"></script>
        <script src="../../../../js/jquery-ui.js"></script>


      

   <script>

      $( function() {

        $("#report_date" ).datepicker({dateFormat: 'dd/mm/yy'});

      });


  </script>
    </body>
</html>