<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  echo "ok";die;
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
