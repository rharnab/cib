<?php include("../../database.php") ?>


<?php

$report_date = date('Y-m', strtotime($_POST['cib_date']));
$accounting_date=date('Y-m-t', strtotime($report_date." -1 month"));
$acc_dt_array = explode("-", $accounting_date);
$acc_year= $acc_dt_array[0];
$acc_month= $acc_dt_array[1];


/*find latest number*/ 
  $num_query= mysql_query("SELECT count from subject_info_archive where month(reporting_date) = '$acc_month' and year(reporting_date) = '$acc_year' order by count desc limit 1");

  $num_result = mysql_fetch_array($num_query);
  if(empty($num_result))
  {
     echo "Sorry data not found for this month ".date('M-Y', strtotime($reporting_date));
     die;
  }else{

    $count = $num_result['count'];

  }
  /*end find latest number*/

$archive_num = $_POST['archive_num'];

if(!empty($archive_num))
{
  $archive_sql = "and count= '$archive_num' ";
}else{
  $archive_sql = " and count= '$count' ";
}


$sql =mysql_query("SELECT * from subject_info_archive si where year (reporting_date) ='$acc_year' and month (reporting_date)='$acc_month' $archive_sql ");
$sl=1;
?>

    
    <table class="table table-bordered userlistTable" style="font-size: 12px">
              <thead style="background-color: #009688; color: white; text-transform: uppercase;">
                <tr>
                  <th>sl</th>
                  <th>RECORD TYPE</th>
                  <th>F.I CODE</th>
                  <th>BRANCH CODE</th>
                  <th>F.I SUBJECT CODE</th>
                  <th>TITLE</th>
                  <th>NAME</th>
                  <th>FITHER'S TITLE</th>
                  <th>FITHER'S NAME</th>
                  <th>MOTHER'S TITLE</th>
                  <th>MOTHER'S NAME</th>
                  <th>SPOUSE'S TITLE</th>
                  <th>SPOUSE'S NAME</th>
                  <th>SECTOR TYPE</th>
                  <th>SECTOR CODE</th>
                  <th>GENDER</th>
                  <th>BIRTH DATH</th>
                  <th>PLACE OF BIRTH</th>
                  <th>COUNTRY OF BIRTH</th>
                  <th>NID NUMBER</th>
                  <th>IS NID</th>
                  <th>TIN</th>
                  <th>PAR. STREET</th>
                  <th>PAR. POSTAL CODE</th>
                  <th>PAR. DISTRICT</th>
                  <th>PAR. COUNTRY CODE</th>
                  <th>ADD. STREET</th>
                  <th>ADD. POSTAL CODE</th>
                  <th>ADD. DISTRICT</th>
                  <th>ADD. COUNTRY CODE</th>
                  <th>ID TYPE</th>
                  <th>ID NR</th>
                  <th>ID ISSUE DATE</th>
                   <th>ID ISSUE COUNTRY CODE</th>
                  <th>PHONE NUM.</th>
                  <th>FULL NID</th>
                  <th>Archive Month</th>
                  <th>Archive Number</th>
                  <th>Status</th>
                 
                </tr>
              </thead>
              <tbody >
                <?php
                $sl=1;
                 while($data = mysql_fetch_array($sql))
                {

                  $sts = $data['status'];
                  if($sts == '1')
                  {
                    $status = "Reported";
                  }else if($sts =='2')
                  {
                    $status = "Reported";
                  }else{
                    $status = "Not Reported";
                  }
                             
                 ?>    
                    <tr>                        
                        <td><?php echo $sl++ ?></td>
                        <td><?php echo $data['record_type'] ?></td> 
                        <td><?php echo $data['fi_code'] ?></td>
                        <td><?php echo $data['branch_code'] ?></td>
                        <td><?php echo $data['fi_subject_code'] ?></td>
                        <td><?php echo $data['title'] ?></td>
                        <td><?php echo $data['name'] ?></td>
                        <td><?php echo $data['fathers_title'] ?></td>
                        <td><?php echo $data['fathers_name'] ?></td>
                        <td><?php echo $data['mothers_title'] ?></td>
                        <td><?php echo $data['mothers_name'] ?></td>
                        <td><?php echo $data['spouse_title'] ?></td>
                        <td><?php echo $data['spouse'] ?></td>
                        <td><?php echo $data['sector_type'] ?></td>
                        <td><?php echo $data['sector_code'] ?></td>
                        <td><?php echo $data['gender'] ?></td>

                        <td><?php echo $data['dath_of_brth'] ?></td> 
                        <td><?php echo $data['place_of_birth'] ?></td>
                        <td><?php echo $data['country_of_birth'] ?></td>
                        <td><?php echo $data['nid_number'] ?></td>
                        <td><?php echo $data['is_nid'] ?></td>
                        <td><?php echo $data['tin_number'] ?></td>

                        <td><?php echo $data['parmanent_street'] ?></td>
                        <td><?php echo $data['parmanent_postal_code'] ?></td>
                        <td><?php echo $data['parmanent_district'] ?></td>
                        <td><?php echo $data['parmanent_country_code'] ?></td>
                        <td><?php echo $data['additional_street'] ?></td>
                        <td><?php echo $data['additional_postal_code'] ?></td>
                        <td><?php echo $data['additional_district'] ?></td>
                        <td><?php echo $data['additional_country_code'] ?></td>
                        <td><?php echo $data['id_type'] ?></td>
                        <td><?php echo $data['id_nr'] ?></td>
                        <td><?php echo $data['id_issue_date'] ?></td>
                        <td><?php echo $data['id_issue_country_code'] ?></td>
                        <td><?php echo $data['phone_number'] ?></td> 
                        <td><?php echo $data['full_nid_number'] ?></td>
                        <td><?php echo $data['archive_date'] ?></td>
                        <td><?php echo $data['count'] ?></td>
                        <td><?php echo $status ?></td>
                 
               </tr>
           <?php } ?>
                
                
               </tbody>
              </table>  

      <script src="../../../../js/sweetalert.min.js"></script>

      <script type="text/javascript">

       $('.userlistTable').DataTable({

            dom: 'Blfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ],
            lengthMenu: [ [50, 100, 150, -1], [50, 100, 150, "All"] ],

       });
    </script>


     


