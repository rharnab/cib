<?php include("../../database.php"); ?>
<?php 


	$report_date = date('Y-m', strtotime($_POST['cib_date']));
	$accounting_date=date('Y-m-t', strtotime($report_date." -1 month"));
	$acc_dt_array = explode("-", $accounting_date);
	$acc_year= $acc_dt_array[0];
	$acc_month= $acc_dt_array[1];

	$sql =mysql_query("SELECT * from subject_info_archive si where year (reporting_date) ='$acc_year' and month (reporting_date)='$acc_month' group by count order by count asc ");
	?>

		  <select name="archive_num" class="form-control" id="archive_num">

          <option value="">Select Archive number</option>
          <?php
          	if(mysql_num_rows($sql) > 0)
          	{
          		while($result = mysql_fetch_assoc($sql))
          		{
          			?>


          			 <option value="<?php echo $result['count'] ?>"><?php echo $result['count'] ?></option>

          			<?php
          		}
          	}


           ?>
        
          
        </select>


	<?php




 ?>