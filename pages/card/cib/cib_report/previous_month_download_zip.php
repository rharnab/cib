<?php include('../../database.php') ?>

<?php 
if(isset($_GET['reporting_date']))
{
	 $reporting_date  = $_GET['reporting_date'];
	 $query =mysql_query("SELECT * FROM cib_download_history ORDER BY id desc limit 1 ");
	 $data = mysql_fetch_assoc($query);
	
	 $file_name = "cib_archive_20210619103633.zip";
	 $file = "cib_archive/";

	 $full_path = "/cardMis/pages/card/cib/".$file.$file_name;
	 

	 

	 //download script

	    header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=' . basename($full_path));
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($file_name));
        readfile('"/cardMis/pages/card/cib/' . $full_path);

}


 ?>

<!--  <a class="btn btn-primary" href="/cardMis/pages/card/cib/<?php echo $file; ?>" download>Download</a>  -->