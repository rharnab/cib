<?php include("../../database.php");
include('error_check_subject.php'); ?>


 <?php 

 $id = $_GET['id'];

 $error_query= mysql_query("SELECT * from cib_error where id='$id' ");
 $error_result = mysql_fetch_array($error_query);
 $error_type  =$error_result['error_type'];
 $error_code    =$error_result['error_code'];
 $condition  =$error_result['condition'];
 $error_description  =$error_result['error_description'];
 $error_field  = trim($error_result['error_field']);

 if($error_field !='')
 {

  $filds = explode(',', $error_field);

 }else{
    $filds ='';
 }

 
 /*echo "<pre>";
 print_r($filds);*/
  ?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Card | CIB <?php echo $error_description; ?> Error Reprot</title>
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
        <?php //include("../../../../header.php");?>        
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
             <?php //include("../../../../menu.php");?>
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side" style="margin-left: 0px !important;">                
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>Subject  Error [<?php echo $error_code ?>] </h1>
                    <h1>Error Details [<?php echo $error_description ?>] </h1>
                    <!-- <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="#">CIB</a></li>
                        <li class="active">Error Report</li>
                    </ol> -->

                     <?php 
                    if($error_code == 526)
                    {
                      ?>

                       <div class="breadcrumb">
                        <a class="btn btn-success" href="district_update.php?error_code=<?php echo $error_code ?> " >Update</a>
                       </div>


                      <?php
                    }

                     ?>
                </section>

                <!-- style -->

                <!-- Main content -->
                <section class="content">
                  <!-- <img src="../../img/loader.gif" class="page_loader" alt="Page loader"> -->
                    <div class="row">
                       <div class="col-xs-12">
                            <div class="box">
                                <div class="box-body table-responsive">

                                <?php


                                 $query1="SELECT * FROM subject_info WHERE $condition";

                                $sql =mysql_query($query1);
                                $sl=1;
                                ?>

                          
                                <div class="table-responsive" style="overflow-x: auto">
                                  <table class="table table-bordered userlistTable" style="font-size: 12px">
                                        <thead style="background-color: #009688; color: white; text-transform: uppercase;">
                                          <tr>
                                            <th>sl</th>
                                            <th>F.I SUBJECT CODE</th>
                                            <th>NAME</th>
                                            <th>Fater Name</th>
                                            <th>Mother Name</th>
                                            <th>Tin Number</th>
                                            <?php 
                                            if($filds !='')
                                            {

                                                foreach ($filds as $key => $value) {
                                                  ?>
                                                  <th><?php echo 'Edit '.$value ?></th>

                                                  <?php
                                                 }

                                            }
                                              

                                             ?>
                                           
                                          <th>Option</th>
                                            
                                          </tr>
                                        </thead>
                                        <tbody>

                                          <?php 

                                          $sl=1;
                                          while( $result = mysql_fetch_array($sql))
                                          {

                                             $fi_subject_code = $result['fi_subject_code'];
                                             $name = $result['name'];
                                             $fathers_name = $result['fathers_name'];
                                             $mothers_name = $result['mothers_name'];
                                             $tin_number = $result['tin_number'];
                                             $id= $result['id'];
                                            
                                            ?>

                                            <tr>
                                              
                                              <td><?php  echo $sl++ ?></td>
                                              <td><?php  echo $fi_subject_code ?></td>
                                              <td><?php  echo $name ?></td>
                                              <td><?php  echo $fathers_name ?></td>
                                              <td><?php  echo $mothers_name ?></td>
                                              <td><?php  echo $tin_number ?></td>

                                              <?php 
                                              if($filds !='')
                                              {

                                                foreach ($filds as $key => $value) {
                                                    
                                                    $colum_name = $value;
                                                     $column_value = $result[$value];
                                                     ?>

                                                       <td  data-column_name="<?php echo ($colum_name)? $colum_name: ''  ?>" data-id="<?php echo $result['id'] ?>" class="inline_text_edit" contenteditable ><?php echo  ($column_value)? $column_value:''  ?></td>


                                                     <?php

                                                  }

                                              }
                                              


                                               ?>
                                             <?php 

                                              if($result['status']== '0')
                                              {

                                                ?>

                                                <td><button class="btn btn-danger stop_reporting" onclick="statusUpdate(id,'1')"  id="<?php echo $result['id'] ?>">Stop Reporting</button></td>

                                                <?php

                                              }else{
                                                ?>

                                                 <td><button class="btn btn-success stop_reporting"  onclick="statusUpdate(id,'0')" id="<?php echo $result['id'] ?>">Reporting</button></td>

                                                <?php

                                              }

                                              ?>
                                             
                                            </tr>

                                            <?php
                                          }

                                           ?>
                                          
                                          
                                         </tbody>
                                    </table> 
                                   <input type="hidden" name="error_code" value="<?php echo $error_code ?>" id="error_code">
                                 </div> <!-- table-responsive -->
                                    
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
        <script src="../../../js/sweetalert.min.js"></script>


        <script>
      $(document).ready(function() {



         $('.userlistTable').DataTable({

            dom: 'Blfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ],
            lengthMenu: [ [50, 100, 150, -1], [50, 100, 150, "All"] ],

       });

       $(document).on('keypress', '.inline_text_edit', function(e) {
            
             var keycode = (e.keyCode ? e.keyCode : e.which);
         if (keycode == '13') {
           var id = $(this).data("id");
            var column_name = $(this).data("column_name");
            var column_value = $(this).text();
            inlineTableEdit(column_name, column_value, id);
            $(this).attr('contenteditable', false);
            $(this).focus();
            $(this).attr('contenteditable', true);
            e.stopPropagation();
            return false;
         }
           
            
        }); // end Inline Table Edit blur.
   
}); // end document ready








      function inlineTableEdit(c_name, c_value, c_id) {
    
    
        var column_name = c_name;
        var column_value = c_value;
        var id = c_id;



        if (column_value != '' || column_value=='') {
            
                swal({
                title: "Are You Sure For Update ? ",
                icon: "warning",
                buttons: true,
                dangerMode: true,
              })
              .then((willDelete) => {
                if (willDelete) {

                  $.ajax({
                    url: "subject_edit_save.php",
                    method: "POST",
                    data: {
                        column_name: column_name,
                        column_value: column_value,
                        id: id
                        
                    },
                    beforeSend: function() {
                     
                    },
                    success: function(response) {
                        if (response == true) {
                            
                            // swal('Success ! Information Update Succefuly.');
                            //console.log(response);
                            location.reload();
                           
                            
                           
                            //location.reload();
                        } else {
                           
                            console.log(response);
                        }

                    },
                    error: function(response) {
                        console.log(response);
                    }
                });
                  
                } else {
                  
                }
              });



        } else {
            swal('Field should not be empty !');
            location.reload();
        }
   
} // end inlineTableEdit() method.

  /*function statusUpdate(status, id)
  {

     if(status !='')
     {
       $.ajax({
            type:'post',
            url:'subject_data_update.php',
            data: {status, id},
            success:function(data)
            {
             if(data ==1)
             {
                location.reload();
             }else{
              swal(data)
             }
            }

       });
     }
  }*/


//script for reprot stop

function statusUpdate(id, status)
{

  var error_code = $('#error_code').val()
  if(id !='')
  {

      $.ajax({
        type:'post',
        url:'stop_reporting.php',
        data:{id, error_code, status},
        success:function(data)
        {
             if(data ==1)
             {
                location.reload();
             }else{
              swal(data)
             }
        }

      });

  }

  

}


/*$('.stop_reporting').click(function(){


});
*/


</script>

    </body>

    </html>


