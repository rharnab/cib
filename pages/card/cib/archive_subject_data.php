<?php include("../database.php") ?>

<?php 
$archive_count = $_POST['archive_count'];
$report_date = date('Y-m', strtotime($_POST['cib_date']));
$accounting_date=date('Y-m-t', strtotime($report_date." -1 month"));
$acc_dt_array = explode("-", $accounting_date);
$acc_year= $acc_dt_array[0];
$acc_month= $acc_dt_array[1];
$num = 0;

$sql =mysql_query("SELECT * from subject_info  where year (reporting_date) ='$acc_year' and month (reporting_date)='$acc_month'");

while($data= mysql_fetch_array($sql))
{

					$record_type = $data['record_type'];
					$fi_code = $data['fi_code'];
					$acc_date = $data['acc_date'];
					$production_date = $data['production_date'];
					$code_link =$data['code_link'];
					$branch_code =$data['branch_code'];
					$fi_subject_code=$data['fi_subject_code'];
					$card_fi_sub=$data['card_fi_sub'];
					$title =mysql_real_escape_string($data['title']);  
					$name =mysql_real_escape_string($data['name']); 
					$fathers_title=mysql_real_escape_string($data['fathers_title']); 
					$fathers_name =mysql_real_escape_string($data['fathers_name']); 
					$mothers_title=mysql_real_escape_string($data['mothers_title']); 
					$mothers_name=mysql_real_escape_string($data['mothers_name']); 
					$spouse_title =mysql_real_escape_string($data['spouse_title']); 
					$spouse=mysql_real_escape_string($data['spouse']); 
					$sector_type=$data['sector_type']; 
					$sector_code=$data['sector_code']; 
					$gender=$data['gender']; 
					$dath_of_brth =$data['dath_of_brth']; 
					$place_of_birth =mysql_real_escape_string($data['place_of_birth']); 
					$country_of_birth=$data['country_of_birth']; 
					$nid_number =$data['nid_number']; 
					$is_nid =$data['is_nid']; 
					$tin_number =$data['tin_number']; 
					$parmanent_street =mysql_real_escape_string($data['parmanent_street']); 
					$parmanent_postal_code =$data['parmanent_postal_code']; 
					$parmanent_district =mysql_real_escape_string($data['parmanent_district']); 
					$parmanent_country_code= $data['parmanent_country_code'];
					$additional_street =mysql_real_escape_string($data['additional_street']);
					$additional_postal_code =$data['additional_postal_code'];
					$additional_district =mysql_real_escape_string($data['additional_district']);
					$additional_country_code =$data['additional_country_code'];
					$business_address =mysql_real_escape_string($data['business_address']);
					$business_postal_code =$data['business_postal_code'];
					$business_district =mysql_real_escape_string($data['business_district']);
					$business_country_code =$data['business_country_code'];
					$id_type =$data['id_type'];
					$id_nr =$data['id_nr'];
					$id_issue_date = $data['id_issue_date'];
					$id_issue_country_code =$data['id_issue_country_code']; 
					$phone_number =$data['phone_number'];  
					$full_nid_number =$data['full_nid_number'];
					$reporting_date =$data['reporting_date'];
					$status =$data['status'];

					$archive_date = date("M-Y", strtotime($reporting_date));
					$count = $archive_count + 1;
					$entry_date = date('Y-m-d h:i:s');


	$insert= mysql_query("INSERT INTO subject_info_archive(record_type, fi_code, acc_date,production_date, code_link, branch_code, fi_subject_code,card_fi_sub, title, name, fathers_title, fathers_name, mothers_title, mothers_name, spouse_title, spouse, sector_type, sector_code,gender, dath_of_brth, place_of_birth, country_of_birth, nid_number, is_nid, tin_number, parmanent_street, parmanent_postal_code, parmanent_district, parmanent_country_code,additional_street, additional_postal_code,additional_district, additional_country_code, business_address, business_postal_code, business_district, business_country_code, id_type, id_nr, id_issue_date, id_issue_country_code, phone_number, full_nid_number, reporting_date, status, archive_date, count, entry_date) VALUES ('$record_type','$fi_code', '$acc_date','$production_date','$code_link','$branch_code','$fi_subject_code','$card_fi_sub','$title','$name','$fathers_title','$fathers_name','$mothers_title','$mothers_name','$spouse_title','$spouse','$sector_type','$sector_code','$gender','$dath_of_brth','$place_of_birth','$country_of_birth','$nid_number','$is_nid','$tin_number','$parmanent_street','$parmanent_postal_code','$parmanent_district','$parmanent_country_code','$additional_street','$additional_postal_code','$additional_district','$additional_country_code','$business_address','$business_postal_code','$business_district','$business_country_code','$id_type','$id_nr','$id_issue_date', '$id_issue_country_code','$phone_number','$full_nid_number','$reporting_date', '$status', '$archive_date', '$count','$entry_date') ");

	if($insert)
	{
		$num = $num + 1;
	}


	


					
}

echo "ALL SUBJECT HAS BEEN SUCCESSULLY MOVE TO ARCHIVE ";









 ?>