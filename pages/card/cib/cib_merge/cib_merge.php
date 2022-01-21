<?php 
    include('../../db/dbconnect.php');
    //session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Card | Generate Cib </title>
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
        <link rel="stylesheet" type="text/css" href="../../../../css/select2.min.css">

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
                    <h1>Merge  Files </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="#">CIB Report</a></li>
                        <li class="active">Merge CIB Files</li>
                    </ol>
                </section>

<!-- style -->
<style type="text/css">
  .page_loader{
    position: absolute;
    z-index: 1;
    left: 27%;
    width: 37%;
  }
</style>
            <!-- style -->

                <!-- Main content -->
                <section class="content">
                  <img src="../../img/loader.gif" class="page_loader" alt="Page loader">
                    <div class="row">
                        <div class="col-xs-6">
                            <div class="box">
                               <div class="box-header">
                                </div><!-- /.box-header -->
                                <div class="box-body">
                                  <!-- from -->
                                   <div class="tile-body">
                                     <form id="submit-form" class="submit-form" method="POST" action="" enctype="multipart/form-data">

                                       <!-- start -:- Subject1 -->
                                      <div class="form-group row">
                                        <label class="col-md-12">CBS SUBJECT FILE</label>
                                        <div class="col-md-10">
                                           <input type="file" class="form-control cbs_sucject" name="txt_sub1" placeholder="CBS Sibjcect"/>
                                        </div>
                                      </div>
                                      <!-- start -:- Subject2 -->
                                      <div class="form-group row">
                                        <label class="col-md-12">CARD SUBJECT FILE</label>
                                        <div class="col-md-10">
                                           <input type="file" class="form-control card_subject" name="txt_sub2" placeholder="CARD Sibjcect"/>
                                        </div>
                                      </div>
                                      <!-- end -:- Subject2 -->

                                      <!-- start -:- Contact1 -->
                                      <div class="form-group row">
                                        <label class="col-md-12">CBS CONTRACT FILE</label>
                                        <div class="col-md-10">
                                           <input type="file" class="form-control cbs_contract" name="txt_con1" placeholder="CBS Contract"/>
                                        </div>
                                      </div>
                                     <!-- end -:- Contact1 -->

                                      <!-- start -:- Contact2 -->
                                      <div class="form-group row">
                                        <label class="col-md-12">CARD CONTRACT FILE</label>
                                        <div class="col-md-10">
                                           <input type="file" class="form-control card_contract" name="txt_con2" placeholder="CARD Contract"/>
                                        </div>
                                      </div>
                                     <!-- end -:- Contact2 -->

                                       <div class="tile-footer">
                                    <div class="row">
                                      <div class="col-md-2">
                                        <button class="btn btn-primary btn-upload-text" type="button"><i class="fa fa-fw fa-lg fa-check-circle"></i>Merge</button></div>

                                        <div class="col-md-2">
                                         <form class="download-form" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
                                          <input type="button" class="btn btn-info zip-download float-right" name="btn_create_zip" value="Create Zip" />
                                        </form>
                                      </div>

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
        <script src="../../../../js/select2.min.js"></script>


      <script>
      
    $('.page_loader').hide();
    $('.zip-download').hide();

    $(document).ready(function() {



        var formData = new FormData(document.querySelector('.submit-form'));
        $('.btn-upload-text').click(function(e) {
        var txt_sub1 = document.forms['submit-form'].elements['txt_sub1'].value;
        var txt_sub2 = document.forms['submit-form'].elements['txt_sub2'].value;
        var txt_con1 = document.forms['submit-form'].elements['txt_con1'].value;
        var txt_con2 = document.forms['submit-form'].elements['txt_con2'].value;
  
        if(txt_sub1 =='')
        {
          $('.cbs_sucject').css('border-color', 'red');
        }else{
           $('.cbs_sucject').css('border-color', 'transparent');
        }









        e.preventDefault();
        if(txt_sub1 != '' &&  txt_sub2 !='' && txt_con1 !='' && txt_con2 !='')
        {
          $('.btn-upload-text').prop('disabled', true);
          $('.page_loader').show();

          $.ajax({
          type: 'POST',
          url: "upload.php",
          data: formData,
          cache: false,
          processData: false,
          contentType: false,
          beforeSend: function() {

          },
          success: function(response) {
            if (response == true) {
              alert('Success ! File Uploaded Successfully.');
               $('.page_loader').hide();
               $('.zip-download').show();
               //location.reload();
              } else {
                alert(response);
              }
              console.log(response);
            },
              error: function(response) {
                alert('Error');
                console.log(response);
              },
              complete: function() {

              }
            }); // end -:- Ajax.

        }//end - blank value check
        else{
          alert('Please give all file');
        }
        
      }); // end -:- Data Pull Event.

      //zip file download
      $('.zip-download').on('click', function(){

       $.ajax({
          type: 'post',
          url:'merge_file_download.php',
          data:{},
          success:function(data)
          {
            alert(data);
          }

       })

      })//end zip file download


    }); // end -:- Document Ready Section.
      
    </script>
    </body>
</html>