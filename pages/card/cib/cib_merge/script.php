<?php

try {
    //To get only the name of the directory where script executed:
    //echo dirname(__FILE__);//F:\xampp7\htdocs\php\cib
    //echo basename(dirname(__FILE__));// cib
    //echo basename(__DIR__);// cib
    //echo basename(__FILE__);//script.php

    $root_path = $_SERVER['DOCUMENT_ROOT']; // F:/xampp7/htdocs
    $project_folder_name = 'php' . DIRECTORY_SEPARATOR . 'cib'; // it will be change
    $file_location = $root_path . DIRECTORY_SEPARATOR . $project_folder_name . DIRECTORY_SEPARATOR;

    #-------------------- START -:- Subject -------------------- #
    $file_sub_array1 = array();
    $file_sub_path1 = $file_location . 'subject1/077SJF.txt';
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

    $file_sub_array2 = array();
    $file_sub_path2 = $file_location . 'subject2/077SJF.txt';
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

    $generate_sub_file = $file_location . '077SJF.txt';
    file_put_contents($generate_sub_file, "");
    if ($sj1count > $sj2count) {
        file_put_contents($generate_sub_file, $sj1h, FILE_APPEND);
        for ($i = 0; $i < count($file_sub_array1); $i++) {
            file_put_contents($generate_sub_file, $file_sub_array1[$i], FILE_APPEND);
        }
        for ($j = 0; $j < count($file_sub_array2); $j++) {
            file_put_contents($generate_sub_file, $file_sub_array2[$j], FILE_APPEND);
        }
        //file_put_contents($generate_sub_file, $sj1f . PHP_EOL, FILE_APPEND);
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
        //file_put_contents($generate_sub_file, $sj2f . PHP_EOL, FILE_APPEND);
        $sj_footer_text = substr($sj2f, 0, 20);
        $sj_tot = ($sj1count + $sj2count);
        $sjfooter = str_pad($sj_tot, 7, "0", STR_PAD_LEFT);
        $sjfooter =  $sj_footer_text . $sjfooter;
        file_put_contents($generate_sub_file, $sjfooter, FILE_APPEND);
    }
    #-------------------- END -:- Subject --------------------#

    #-------------------- START -:- CONTACT --------------------#
    $file_con_array1 = array();
    $file_con_path1 = $file_location . 'contact1/077CNF.txt';
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


    $file_con_array2 = array();
    $file_con_path2 = $file_location . 'contact2/077CNF.txt';
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

    $generate_con_file = $file_location . '077CNF.txt';
    file_put_contents($generate_con_file, "");
    if ($ct1count > $ct2count) {
        file_put_contents($generate_con_file, $ct1h, FILE_APPEND);
        for ($i = 0; $i < count($file_con_array1); $i++) {
            file_put_contents($generate_con_file, $file_con_array1[$i], FILE_APPEND);
        }
        for ($j = 0; $j < count($file_con_array2); $j++) {
            file_put_contents($generate_con_file, $file_con_array2[$j], FILE_APPEND);
        }
        //file_put_contents($generate_con_file, $ct1f . PHP_EOL, FILE_APPEND);
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
        //file_put_contents($generate_con_file, $ct2f . PHP_EOL, FILE_APPEND);
        $sj_footer_text = substr($ct2f, 0, 20);
        $sj_tot = ($ct1count + $ct2count);
        $sjfooter = str_pad($sj_tot, 7, "0", STR_PAD_LEFT);
        $sjfooter =  $sj_footer_text . $sjfooter;
        file_put_contents($generate_con_file, $sjfooter, FILE_APPEND);
    }
    #-------------------- END -:- CONTACT --------------------#
    $dir = $file_location . 'cib_archive' . DIRECTORY_SEPARATOR;
    $zipname = 'BATCH_MARGE_FILE-' . date('YmdHis') . ".zip";
    $zip_dir = $dir . $zipname;
    $zip = new ZipArchive;
    $zip->open($zip_dir, ZipArchive::CREATE);
    $zip->addFile($generate_sub_file, '077SJF.txt');
    $zip->addFile($generate_con_file, '077CNF.txt');
    $zip->close();
    header('Content-Type: application/zip');
    header('Content-disposition: attachment; filename="' . basename($zip_dir) . '"');
    header('Content-Length: ' . filesize($zip_dir));
    readfile($zip_dir);
    unlink($dir . $zipname);
    echo 'Success.';
} catch (Exception $e) {
    echo 'Error : ' . $e->getMessage();
}
