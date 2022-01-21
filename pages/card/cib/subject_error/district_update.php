<?php include('../../database.php'); ?>

<?php 
$error_code = $_GET['error_code'];
$query = mysql_query("SELECT `query`,`condition` from cib_error where error_code= '$error_code'");
$data  = mysql_fetch_assoc($query);

$q =  $data['query'];
$con =  $data['condition'];
$error_query= mysql_query("SELECT fi_subject_code, parmanent_district from subject_info where $con ");
$count = 0;
while($result  = mysql_fetch_assoc($error_query))
{
	//subject district name
	 $sub_district = $result['parmanent_district'];
	 $fi_subject_code = $result['fi_subject_code'];
	
	 $dis_query = mysql_query("SELECT district_name from district_list   ");
	 while($dis_result = mysql_fetch_assoc($dis_query))
	 {	
	 	   $district_name =  $dis_result['district_name']; //original district name
	 	   similar_text($sub_district, $district_name, $parcent);

	 	  	if((!empty($district_name))  && ($parcent > 70))
	 	  	{

	 	  		$update = mysql_query(" UPDATE subject_info set parmanent_district='$district_name' where fi_subject_code = '$fi_subject_code' and parmanent_district= '$sub_district' ");
	 	  	    $count = $count + 1;
	 	  	  
	 	  	}else if( ($sub_district == 'CHITTAGONG') && ($district_name =='CHATTOGRAM')){

	 	  		$update = mysql_query(" UPDATE subject_info set parmanent_district='$district_name' where fi_subject_code = '$fi_subject_code' and parmanent_district= '$sub_district' ");
	 	  		  $count = $count + 1;
	 	  	}
	 	  
	 }



}




echo "<script> alert('$count District successfully updatetd '); window.location='cib_error_report.php' </script>";






 ?>
