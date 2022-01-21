<?php
echo true;die;



if (empty($_FILES["txt_sub1"]["name"])) {
    echo 'Error ! Subject 1 File Should Not Be Empty.' . PHP_EOL;
    die();
}
/*if ($_FILES["txt_sub1"]["name"] != '077SJF.txt') {
    echo 'Error ! Wrond File Selected For Subject, Please Select 077SJF.txt (File Name).' . PHP_EOL;
    die();
}*/
if (empty($_FILES["txt_sub2"]["name"])) {
    echo 'Error ! Subject 2 File Should Not Be Empty.' . PHP_EOL;
    die();
}
/*if ($_FILES["txt_sub2"]["name"] != '077SJF.txt') {
    echo 'Error ! Wrond File Selected For Subject, Please Select 077SJF.txt (File Name).' . PHP_EOL;
    die();
}*/
if (empty($_FILES["txt_con1"]["name"])) {
    echo 'Error ! Conract 1 File Should Not Be Empty.' . PHP_EOL;
    die();
}
/*if ($_FILES["txt_con1"]["name"] != '077CNF.txt') {
    echo 'Error ! Wrond File Selected For Contact, Please Select 077CNF.txt (File Name).' . PHP_EOL;
    die();
}*/
if (empty($_FILES["txt_con2"]["name"])) {
    echo 'Error ! Conract 2 File Should Not Be Empty.' . PHP_EOL;
    die();
}
/*if ($_FILES["txt_con2"]["name"] != '077CNF.txt') {
    echo 'Error ! Wrond File Selected For Contact, Please Select 077CNF.txt (File Name).' . PHP_EOL;
    die();
}*/

$root_path = $_SERVER['DOCUMENT_ROOT'];
$project_folder_name = 'cib'; // it will be change
$project_location = $root_path . DIRECTORY_SEPARATOR . $project_folder_name . DIRECTORY_SEPARATOR;
if (!file_exists($project_location . 'uploads')) {
    mkdir($project_location . 'uploads');
}
$project_upload_location = $project_location . 'uploads' . DIRECTORY_SEPARATOR;
$upload_subject_location = $project_upload_location . 'subject-uploads';
$upload_contact_location = $project_upload_location . 'contact-uploads';
if (!file_exists($upload_subject_location)) {
    mkdir($upload_subject_location);
}
if (!file_exists($upload_contact_location)) {
    mkdir($upload_contact_location);
}

$subFileTargetDir = $upload_subject_location . DIRECTORY_SEPARATOR;
$conFileTargetDir =  $upload_contact_location . DIRECTORY_SEPARATOR;
$ref = date('dMYHis');

# Subject 1 File Upload.
$sub1FileBaseName = $ref . '-1-' . basename($_FILES["txt_sub1"]["name"]);
$sub1FileExtention = pathinfo($sub1FileBaseName, PATHINFO_EXTENSION);
$sub1FileUploadName = $sub1FileBaseName;
$sub1TargetFile = $subFileTargetDir . $sub1FileUploadName;
$sub1Uploaded = move_uploaded_file($_FILES["txt_sub1"]["tmp_name"], $sub1TargetFile);
if (!$sub1Uploaded) {
    echo 'Error ! Failed To Upload Subject 1 Text File.' . PHP_EOL;
    die();
}

# Subject 2 File Upload.
$sub2FileBaseName = $ref . '-2-' . basename($_FILES["txt_sub2"]["name"]);
$sub2FileExtention = pathinfo($sub2FileBaseName, PATHINFO_EXTENSION);
$sub2FileUploadName = $sub2FileBaseName;
$sub2TargetFile = $subFileTargetDir . $sub2FileUploadName;
$sub2Uploaded = move_uploaded_file($_FILES["txt_sub2"]["tmp_name"], $sub2TargetFile);
if (!$sub2Uploaded) {
    echo 'Error ! Failed To Upload Subject 2 Text File.' . PHP_EOL;
    die();
}

# Contact 1 File Upload.
$con1FileBaseName = $ref . '-1-' . basename($_FILES["txt_con1"]["name"]);
$con1FileExtention = pathinfo($con1FileBaseName, PATHINFO_EXTENSION);
$con1FileUploadName = $con1FileBaseName;
$con1TargetFile = $conFileTargetDir . $con1FileUploadName;
$con1Uploaded = move_uploaded_file($_FILES["txt_con1"]["tmp_name"], $con1TargetFile);
if (!$con1Uploaded) {
    echo 'Error ! Failed To Upload Contact 1 Text File.' . PHP_EOL;
    die();
}

# Contact 2 File Upload.
$con2FileBaseName = $ref . '-2-' . basename($_FILES["txt_con2"]["name"]);
$con2FileExtention = pathinfo($con2FileBaseName, PATHINFO_EXTENSION);
$con2FileUploadName = $con2FileBaseName;
$con2TargetFile = $conFileTargetDir . $con2FileUploadName;
$con2Uploaded = move_uploaded_file($_FILES["txt_con2"]["tmp_name"], $con2TargetFile);
if (!$con2Uploaded) {
    echo 'Error ! Failed To Upload Contact 2 Text File.' . PHP_EOL;
    die();
}

# Subject 1 Data Store.
$file_sub_array1 = array();
$file_sub_path1 = $sub1TargetFile;
$sj1 = fopen($file_sub_path1, 'r');
while ($line = fgets($sj1)) {
    array_push($file_sub_array1, $line);
}
fclose($sj1);
$sj1len = count($file_sub_array1);
$sj1h = $file_sub_array1[0];
$sj1f = $file_sub_array1[count($file_sub_array1) - 1];
$sj1count = substr($sj1f, 20, strlen($sj1f));
$sj1count = intval($sj1count);
$file_sub_array1 = array_slice($file_sub_array1, 1, (count($file_sub_array1) - 2), false);
// echo '<pre>';
// print_r($file_sub_array1);

# Subject 2 Data Store.
$file_sub_array2 = array();
$file_sub_path2 = $sub2TargetFile;
$sj2 = fopen($file_sub_path2, 'r');
while ($line = fgets($sj2)) {
    array_push($file_sub_array2, $line);
}
fclose($sj2);
$sj2len = count($file_sub_array2);
$sj2h = $file_sub_array2[0];
$sj2f = $file_sub_array2[count($file_sub_array2) - 1];
$sj2count = substr($sj2f, 20, strlen($sj2f));
$sj2count = intval($sj2count);
$file_sub_array2 = array_slice($file_sub_array2, 1, (count($file_sub_array2) - 2), false);
// echo '<pre>';
// print_r($file_sub_array2);

# Contact 1 Data Store.
$file_con_array1 = array();
$file_con_path1 = $con1TargetFile;
$ct1 = fopen($file_con_path1, 'r');
while ($line = fgets($ct1)) {
    array_push($file_con_array1, $line);
}
fclose($ct1);
$ct1len = count($file_con_array1);
$ct1h = $file_con_array1[0];
$ct1f = $file_con_array1[count($file_con_array1) - 1];
$ct1count = substr($ct1f, 20, strlen($ct1f));
$ct1count = intval($ct1count);
$file_con_array1 = array_slice($file_con_array1, 1, (count($file_con_array1) - 2), false);
// echo '<pre>';
// print_r($file_con_array1);

# Contact 2 Data Store.
$file_con_array2 = array();
$file_con_path2 = $con2TargetFile;
$ct2 = fopen($file_con_path2, 'r');
while ($line = fgets($ct2)) {
    array_push($file_con_array2, $line);
}
fclose($ct2);
$ct2len = count($file_con_array2);
$ct2h = $file_con_array2[0];
$ct2f = $file_con_array2[count($file_con_array2) - 1];
$ct2count = substr($ct2f, 20, strlen($ct2f));
$ct2count = intval($ct2count);
$file_con_array2 = array_slice($file_con_array2, 1, (count($file_con_array2) - 2), false);
// echo '<pre>';
// print_r($file_con_array1);

# Subject Data Marge
$generate_sub_file = $subFileTargetDir . $ref . '-' . '077SJF[Marge].txt';
file_put_contents($generate_sub_file, "");
if ($sj1count > $sj2count) {
    file_put_contents($generate_sub_file, $sj1h, FILE_APPEND);
    for ($i = 0; $i < count($file_sub_array1); $i++) {
        file_put_contents($generate_sub_file, $file_sub_array1[$i], FILE_APPEND);
    }
    for ($j = 0; $j < count($file_sub_array2); $j++) {
        file_put_contents($generate_sub_file, $file_sub_array2[$j], FILE_APPEND);
    }
    $sj_footer_text = substr($sj1f, 0, 20);
    $sj_tot = ($sj1count + $sj2count);
    $sjfooter = str_pad($sj_tot, 7, "0", STR_PAD_LEFT);
    $sjfooter =  $sj_footer_text . $sjfooter;
    file_put_contents($generate_sub_file, $sjfooter, FILE_APPEND);
} else {
    file_put_contents($generate_sub_file, $sj2h, FILE_APPEND);
    for ($i = 0; $i < count($file_sub_array2); $i++) {
        file_put_contents($generate_sub_file, $file_sub_array2[$i], FILE_APPEND);
    }
    for ($j = 0; $j < count($file_sub_array1); $j++) {
        file_put_contents($generate_sub_file, $file_sub_array1[$j], FILE_APPEND);
    }
    $sj_footer_text = substr($sj2f, 0, 20);
    $sj_tot = ($sj1count + $sj2count);
    $sjfooter = str_pad($sj_tot, 7, "0", STR_PAD_LEFT);
    $sjfooter =  $sj_footer_text . $sjfooter;
    file_put_contents($generate_sub_file, $sjfooter, FILE_APPEND);
}
$marge_subject_location = $project_upload_location . 'subject-marge';
if (!file_exists($marge_subject_location)) {
    mkdir($marge_subject_location);
}
$subMargeFilePath = $marge_subject_location . DIRECTORY_SEPARATOR . '077SJF.txt';
if (!copy($generate_sub_file, $subMargeFilePath)) {
    echo 'Error ! Subject Marge File Failed To Move For Zip.' . PHP_EOL;
}

# Contact Data Marge
$generate_con_file = $conFileTargetDir . $ref . '-' . '077CNF[Marge].txt';
file_put_contents($generate_con_file, "");
if ($ct1count > $ct2count) {
    file_put_contents($generate_con_file, $ct1h, FILE_APPEND);
    for ($i = 0; $i < count($file_con_array1); $i++) {
        file_put_contents($generate_con_file, $file_con_array1[$i], FILE_APPEND);
    }
    for ($j = 0; $j < count($file_con_array2); $j++) {
        file_put_contents($generate_con_file, $file_con_array2[$j], FILE_APPEND);
    }
    $sj_footer_text = substr($ct1f, 0, 20);
    $sj_tot = ($ct1count + $ct2count);
    $sjfooter = str_pad($sj_tot, 7, "0", STR_PAD_LEFT);
    $sjfooter =  $sj_footer_text . $sjfooter;
    file_put_contents($generate_con_file, $sjfooter, FILE_APPEND);
} else {
    file_put_contents($generate_con_file, $ct2h, FILE_APPEND);
    for ($i = 0; $i < count($file_con_array2); $i++) {
        file_put_contents($generate_con_file, $file_con_array2[$i], FILE_APPEND);
    }
    for ($j = 0; $j < count($file_con_array1); $j++) {
        file_put_contents($generate_con_file, $file_con_array1[$j], FILE_APPEND);
    }
    $sj_footer_text = substr($ct2f, 0, 20);
    $sj_tot = ($ct1count + $ct2count);
    $sjfooter = str_pad($sj_tot, 7, "0", STR_PAD_LEFT);
    $sjfooter =  $sj_footer_text . $sjfooter;
    file_put_contents($generate_con_file, $sjfooter, FILE_APPEND);
}
$marge_contact_location = $project_upload_location . 'contact-marge';
if (!file_exists($marge_contact_location)) {
    mkdir($marge_contact_location);
}
$conMargeFilePath = $marge_contact_location . DIRECTORY_SEPARATOR . '077CNF.txt';
if (!copy($generate_con_file, $conMargeFilePath)) {
    echo 'Error ! Contact Marge File Failed To Move For Zip.' . PHP_EOL;
}
echo true;
