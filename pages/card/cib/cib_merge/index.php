<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $btn_create_zip = $_POST['btn_create_zip'];
  if (isset($_POST['btn_create_zip'])) {
    $root_path = $_SERVER['DOCUMENT_ROOT'];
    $project_folder_name = 'cib'; // it will be change
    $project_location = $root_path . DIRECTORY_SEPARATOR . $project_folder_name . DIRECTORY_SEPARATOR;
    $project_upload_location = $project_location . 'uploads' . DIRECTORY_SEPARATOR;

    $marge_subject_location = $project_upload_location . 'subject-marge';
    $subMargeFilePath = $marge_subject_location . DIRECTORY_SEPARATOR . '077SJF.txt';
    if (!file_exists($subMargeFilePath)) {
      echo '<script>alert("Error ! Subject Marge File Not Exist, Please Upload Again.")</script>';
      header("Refresh:0");
      die();
    }
    $marge_contact_location = $project_upload_location . 'contact-marge';
    $conMargeFilePath = $marge_contact_location . DIRECTORY_SEPARATOR . '077CNF.txt';
    if (!file_exists($conMargeFilePath)) {
      echo '<script>alert("Error ! Contact Marge File Not Exist, Please Upload Again.")</script>';
      header("Refresh:0");
      die();
    }

    $zipFolder = 'cib_archive';
    $zip_location =  $project_upload_location . $zipFolder;
    if (!file_exists($zip_location)) {
      mkdir($zip_location);
    }

    $dir = $project_upload_location . $zipFolder  . DIRECTORY_SEPARATOR;
    $zipname = 'BATCH_MARGE_FILE-' . date('YmdHis') . ".zip";
    $zip_dir = $dir . $zipname;
    $zip = new ZipArchive;
    $zip->open($zip_dir, ZipArchive::CREATE);
    $zip->addFile($subMargeFilePath, '077SJF.txt');
    $zip->addFile($conMargeFilePath, '077CNF.txt');
    $zip->close();
    header('Content-Type: application/zip');
    header('Content-disposition: attachment; filename="' . basename($zip_dir) . '"');
    header('Content-Length: ' . filesize($zip_dir));
    readfile($zip_dir);

    unlink($subMargeFilePath);
    unlink($conMargeFilePath);
    unlink($dir . $zipname);
  }
}
?>


<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <!-- Bootstrap CSS -->
  <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <title>Hello, world!</title>
</head>

<body>
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <form class="download-form" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
          <input type="submit" class="btn btn-info float-right" name="btn_create_zip" value="Create Zip" />
        </form>
      </div>
      <div class="col-lg-12">
        <form class="submit-form" method="POST" action="" enctype="multipart/form-data">
          <div class="row">
            <!-- start -:- Subject1 -->
            <div class="col-lg-3">
              <div class="form-group">
                <label>Subject File 1</label>
                <input type="file" class="form-control-file" name="txt_sub1" />
              </div>
            </div>
            <!-- end -:- Subject1 -->
            <!-- start -:- Subject2 -->
            <div class="col-lg-3">
              <div class="form-group">
                <label>Subject File 2</label>
                <input type="file" class="form-control-file" name="txt_sub2" />
              </div>
            </div>
            <!-- end -:- Subject2 -->
            <!-- start -:- Contact1 -->
            <div class="col-lg-3">
              <div class="form-group">
                <label>Contact File 1</label>
                <input type="file" class="form-control-file" name="txt_con1" />
              </div>
            </div>
            <!-- end -:- Contact1 -->
            <!-- start -:- Contact2 -->
            <div class="col-lg-3">
              <div class="form-group">
                <label>Contact File 2</label>
                <input type="file" class="form-control-file" name="txt_con2" />
              </div>
            </div>
            <!-- end -:- Contact2 -->
          </div>
          <button type="button" class="btn btn-primary btn-upload-text">Process</button>
        </form>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript -->
  <script src="assets/jquery/jquery.min.js"></script>
  <script src="assets/bootstrap/js/bootstrap.min.js"></script>
  <script type="text/javascript">
    $(document).ready(function() {
      $('.btn-upload-text').click(function(e) {
        e.preventDefault();
        var formData = new FormData(document.querySelector('.submit-form'));
        //var upload_bill_file = $(this).closest('form').find('input[name=upload_bill_file]').val();
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
              location.reload();
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
      }); // end -:- Data Pull Event.
    }); // end -:- Document Ready Section.
  </script>
</body>

</html>