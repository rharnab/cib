<?php require_once('../../../../login-authentication.php');?>
<?php 
    include('../../db/dbconnect.php');
   //session_start();
?>
<?php
 include("../../database.php");
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
        <link rel="stylesheet" type="text/css" href="../../../../css/jquery-ui.css">
         <link rel="stylesheet" type="text/css" href="../../../../css/select2.min.css">

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
                    <h1>Regular Error Free Report</h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="#">Report</a></li>
                        <li class="active">Regular Error Free</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-4">
                            <div class="box">
                                <div class="box-body">

                                     <div class="tile-body">
                                      <form id="defaultForm" class="form-horizontal" name="info" action="contract_info.php" method="GET" enctype="multipart/form-data" target="_blank">
                                     
                                      	 <label class="control-label" > Select Month</label>
	                                      <div class="form-group" style="margin-top: 10px;">
	                                        <div class="col-md-10">
	                                          <input type="month" id="frm" name="frm" class="form-control" placeholder="Start Date">
	                                        </div>
	                                      </div>

	                                       
                                       <div class="tile-footer">
	                                    <div class="row">
	                                      <div class="col-md-8 col-md-offset-3">
	                                        <button class="btn btn-primary" type="submit" id="submitbtn" target="_blank"><i class="fa fa-fw fa-lg fa-check-circle"></i>Generate</button></div>
	                                      </div>
	                                    </div>
                                  </form>
                                  </div>
                                    
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
        <script src="../../../../js/jquery-ui.js"></script>
        <script src="../../../../js/select2.min.js"></script>

        <script type="text/javascript">
            $(function() {

                $(document).ready(function() {

			        $('#rpt_sts').select2();

			        
			    });
            });


            function generateReport()
		    {
		     

		      popupwindow = window.open("/CIB/pages/card/report/contract_monthly_report/contract_monthly_report_info.php?month_year="+document.info.frm.value+, 'newWindow', 'top=200, width=800, height=500, left=500, scrollbars=1, toolbar=no, resizable=false');
		    
		    }
        </script>
    </body>
</html>