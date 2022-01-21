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
                    <h1>Subject Monthly Report (<?php echo $frm; ?>)</h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="#">CIB</a></li>
                        <li class="active">Subject Monthly Report</li>
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

                                              <th>sl</th>
                                              <th>RECORD TYPE</th>
                                              <th>F.I CODE</th>
                                              <th>BRANCH CODE</th>
                                              <th>F.I SUBJECT CODE</th>
                                              <th>TITLE</th>
                                              <th>NAME</th>
                                              <th>FITHER'S TITLE</th>
                                              <th>FITHER'S NAME</th>
                                              <th>MOTHER'S TITLE</th>
                                              <th>MOTHER'S NAME</th>
                                              <th>SPOUSE'S TITLE</th>
                                              <th>SPOUSE'S NAME</th>
                                              <th>SECTOR TYPE</th>
                                              <th>SECTOR CODE</th>
                                              <th>GENDER</th>
                                              <th>BIRTH DATH</th>
                                              <th>PLACE OF BIRTH</th>
                                              <th>COUNTRY OF BIRTH</th>
                                              <th>NID NUMBER</th>
                                              <th>IS NID</th>
                                              <th>TIN</th>
                                              <th>PAR. STREET</th>
                                              <th>PAR. POSTAL CODE</th>
                                              <th>PAR. DISTRICT</th>
                                              <th>PAR. COUNTRY CODE</th>
                                              <th>ADD. STREET</th>
                                              <th>ADD. POSTAL CODE</th>
                                              <th>ADD. DISTRICT</th>
                                              <th>ADD. COUNTRY CODE</th>
                                              <th>ID TYPE</th>
                                              <th>ID NR</th>
                                              <th>ID ISSUE DATE</th>
                                               <th>ID ISSUE COUNTRY CODE</th>
                                              <th>PHONE NUM.</th>
                                              <th>FULL NID</th>
                                         
                                        </tr>
                                        </thead>
                                        <tbody>
                                           
                                          
                                                <?php

            $sql =mysql_query("SELECT *, record_type AS rec2 from subject_info_archive where month(reporting_date)='$month' and year(reporting_date)='$year' and status ='1' and fi_subject_code in (select fi_subject_code from subject_info_archive where status ='1' or status ='2' group by fi_subject_code)");


                $sl=1;
                 while($data = mysql_fetch_array($sql))
                    {
                        

                    

                     ?>
                     
                        <tr>                        
                            <td><?php echo $sl++ ?></td>
                            <td><?php echo $data['record_type'] ?></td> 
                            <td><?php echo $data['fi_code'] ?></td>
                            <td><?php echo $data['branch_code'] ?></td>
                            <td><?php echo $data['fi_subject_code'] ?></td>
                            <td><?php echo $data['title'] ?></td>
                            <td><?php echo $data['name'] ?></td>
                            <td><?php echo $data['fathers_title'] ?></td>
                            <td><?php echo $data['fathers_name'] ?></td>
                            <td><?php echo $data['mothers_title'] ?></td>
                            <td><?php echo $data['mothers_name'] ?></td>
                            <td><?php echo $data['spouse_title'] ?></td>
                            <td><?php echo $data['spouse'] ?></td>
                            <td><?php echo $data['sector_type'] ?></td>
                            <td><?php echo $data['sector_code'] ?></td>
                            <td><?php echo $data['gender'] ?></td>

                            <td><?php echo $data['dath_of_brth'] ?></td> 
                            <td><?php echo $data['place_of_birth'] ?></td>
                            <td><?php echo $data['country_of_birth'] ?></td>
                            <td><?php echo $data['nid_number'] ?></td>
                            <td><?php echo $data['is_nid'] ?></td>
                            <td><?php echo $data['tin_number'] ?></td>

                            <td><?php echo $data['parmanent_street'] ?></td>
                            <td><?php echo $data['parmanent_postal_code'] ?></td>
                            <td><?php echo $data['parmanent_district'] ?></td>
                            <td><?php echo $data['parmanent_country_code'] ?></td>
                            <td><?php echo $data['additional_street'] ?></td>
                            <td><?php echo $data['additional_postal_code'] ?></td>
                            <td><?php echo $data['additional_district'] ?></td>
                            <td><?php echo $data['additional_country_code'] ?></td>
                            <td><?php echo $data['id_type'] ?></td>
                            <td><?php echo $data['id_nr'] ?></td>
                            <td><?php echo $data['id_issue_date'] ?></td>
                            <td><?php echo $data['id_issue_country_code'] ?></td>
                            <td><?php echo $data['phone_number'] ?></td> 
                            <td><?php echo $data['full_nid_number'] ?></td>
                 
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