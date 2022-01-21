<?php include("../database.php") ?>

<?php 
$report_date = date('Y-m', strtotime($_POST['cib_date']));
$accounting_date=date('Y-m-t', strtotime($report_date." -1 month"));
$acc_dt_array = explode("-", $accounting_date);
$acc_year= $acc_dt_array[0];
$acc_month= $acc_dt_array[1];

$sql =mysql_query("SELECT * from contracts_info_archive  where year (reporting_date) ='$acc_year' and month (reporting_date)='$acc_month' ORDER BY entry_date desc limit 1 ");

$result =mysql_fetch_array($sql);

if(!empty($result))
{

	echo $result['count'];

}else{

	echo 0;

}









 ?>