<?php 
    
    include("../../database.php");

    require_once "../../../../Spreadsheet/Excel/Writer.php";
    require_once "../../phpExcelLib/Classes/PHPExcel/IOFactory.php";
    require_once "../../plugins/dompdf/vendor/autoload.php";


    $date_array = explode('/', $_GET['reporting_date']);
    $year = $date_array[2];
    $month = $date_array[1];

     $input_date = $year."-".$month."-"."01"; 

    $reporting_date =  date ('m-Y', strtotime($input_date."-1 month"));
    $report_dt_array = explode('-', $reporting_date);
    $month = $report_dt_array[0];
    $year = $report_dt_array[1];

    /*find latest number*/ 
    $num_query= mysql_query("SELECT count from contracts_info_archive where status ='1' or status ='2' and month(reporting_date) = '$month' and year(reporting_date) = '$year' order by entry_date desc limit 1");

    $num_result = mysql_fetch_array($num_query);
    if(empty($num_result))
    {
       echo "Sorry data not found for this month ".date('M-Y', strtotime($reporting_date));
       die;
    }else{

      $count = $num_result['count'];

    }
    /*end find latest number*/

    if(isset($_GET['reporting_date']) ){
       
        

        
     ############################################### subject information #####################################################

            $phpExcel = new PHPExcel();
            $phpExcel->setActiveSheetIndex(0);
            $phpExcel->getActiveSheet()->setTitle("Subjects");
            $currentDate = date('dmY');
            $currentTime = date('hisa');

           

         
            $filename    = "cib_report_for_".date('Ymdhsi')."_".$currentDate.$currentTime.'_' .".xlsx";

            $current_date  = date('F d,Y');

            $currentDate = date('dmY');
            $currentTime = date('hisa');

            $style = array(
                'alignment' => array(
                    'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
                )
            );

            $style_r = array(
                'alignment' => array(
                    'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
                )
            );

             $style_r = array(
                    'alignment' => array(
                        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                        )
                );

            


            ###############################################  header ##################################################################
            $phpExcel->getActiveSheet()->mergeCells('G1:H1');
            $phpExcel->getActiveSheet()->SetCellValue('G1', 'CIB  REPORT FOR '.date('M-Y', strtotime($input_date)));
            $phpExcel->getActiveSheet()->getStyle("O1")->applyFromArray($style_r);

             $phpExcel->getActiveSheet()->GetStyle("A1:O1")->getFont()->setBold(true);

            $phpExcel->getActiveSheet()->mergeCells('G2:H2');
            $phpExcel->getActiveSheet()->SetCellValue('G2', "Date: {$current_date}");
            $phpExcel->getActiveSheet()->getStyle("H2")->applyFromArray($style_r);

              
            $phpExcel->getActiveSheet()->SetCellValue("A4",'Sl No.');
            $phpExcel->getActiveSheet()->SetCellValue("B4",'Name');
            $phpExcel->getActiveSheet()->SetCellValue("C4",'FI Code');
            $phpExcel->getActiveSheet()->SetCellValue("D4",'FI Subject Code');
            $phpExcel->getActiveSheet()->SetCellValue("E4",'Father Name');
            $phpExcel->getActiveSheet()->SetCellValue("F4",'Mother Name');
            $phpExcel->getActiveSheet()->SetCellValue("G4",'Gender');
            $phpExcel->getActiveSheet()->SetCellValue("H4",'Date Of Birth');
            $phpExcel->getActiveSheet()->SetCellValue("I4",'Permanent Street');
            $phpExcel->getActiveSheet()->SetCellValue("J4",'Permanent District');
            $phpExcel->getActiveSheet()->SetCellValue("K4",'Permanent Country Code');
            $phpExcel->getActiveSheet()->SetCellValue("L4",'Phone Number');
            $phpExcel->getActiveSheet()->SetCellValue("M4",'NID Number');




            $phpExcel->getActiveSheet()->GetColumnDimension("A")->SetAutoSize(true);
            $phpExcel->getActiveSheet()->GetColumnDimension("B")->SetAutoSize(true);
            $phpExcel->getActiveSheet()->GetColumnDimension("C")->SetAutoSize(true);
            $phpExcel->getActiveSheet()->GetColumnDimension("D")->SetAutoSize(true);
            $phpExcel->getActiveSheet()->GetColumnDimension("E")->SetAutoSize(true);
            $phpExcel->getActiveSheet()->GetColumnDimension("F")->SetAutoSize(true);
            $phpExcel->getActiveSheet()->GetColumnDimension("G")->SetAutoSize(true);
            $phpExcel->getActiveSheet()->GetColumnDimension("H")->SetAutoSize(true);
            $phpExcel->getActiveSheet()->GetColumnDimension("I")->SetAutoSize(true);
            $phpExcel->getActiveSheet()->GetColumnDimension("J")->SetAutoSize(true);
            $phpExcel->getActiveSheet()->GetColumnDimension("K")->SetAutoSize(true);
            $phpExcel->getActiveSheet()->GetColumnDimension("L")->SetAutoSize(true);
            $phpExcel->getActiveSheet()->GetColumnDimension("M")->SetAutoSize(true);
            $phpExcel->getActiveSheet()->GetColumnDimension("N")->SetAutoSize(true);







            $phpExcel->getActiveSheet()->GetStyle("A4:O4")->getFont()->setBold(true);




            $phpExcel->getActiveSheet()->GetStyle("A4:O4")->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
            $phpExcel->getActiveSheet()->getDefaultStyle()->applyFromArray($style);

        #############################################  header##################################################################

              $subject_query =  mysql_query("SELECT *, record_type AS rec1 from subject_info_archive where fi_subject_code in (select fi_subject_code from contracts_info_archive where month(reporting_date)='$month' and year(reporting_date)='$year' group by fi_subject_code order by count desc ) and status ='1' and month(reporting_date)='$month' and year(reporting_date)='$year'  order by count desc   ");

             
            


              $j=5;
              $sl=1;
            while($subject_info = mysql_fetch_assoc($subject_query))
            {

              $phpExcel->getActiveSheet()->SetCellValueExplicit("A".$j, $sl++ ,PHPExcel_Cell_DataType::TYPE_STRING);
              $phpExcel->getActiveSheet()->SetCellValueExplicit("B".$j, $subject_info['name'],PHPExcel_Cell_DataType::TYPE_STRING);
              $phpExcel->getActiveSheet()->SetCellValueExplicit("C".$j, $subject_info['card_fi_sub'],PHPExcel_Cell_DataType::TYPE_STRING);
              $phpExcel->getActiveSheet()->SetCellValueExplicit("D".$j, $subject_info['fi_subject_code'] ,PHPExcel_Cell_DataType::TYPE_STRING);
              $phpExcel->getActiveSheet()->SetCellValueExplicit("E".$j,  $subject_info['fathers_name'] ,PHPExcel_Cell_DataType::TYPE_STRING);
              $phpExcel->getActiveSheet()->SetCellValueExplicit("F".$j,  $subject_info['mothers_name'],PHPExcel_Cell_DataType::TYPE_STRING);
              $phpExcel->getActiveSheet()->SetCellValueExplicit("G".$j, $subject_info['gender'] ,PHPExcel_Cell_DataType::TYPE_STRING);
              $phpExcel->getActiveSheet()->SetCellValueExplicit("H".$j,  $subject_info['dath_of_brth'] ,PHPExcel_Cell_DataType::TYPE_STRING);
              $phpExcel->getActiveSheet()->SetCellValueExplicit("I".$j, $subject_info['parmanent_street'] ,PHPExcel_Cell_DataType::TYPE_STRING);
              $phpExcel->getActiveSheet()->SetCellValueExplicit("J".$j, $subject_info['parmanent_district'] ,PHPExcel_Cell_DataType::TYPE_STRING);
              $phpExcel->getActiveSheet()->SetCellValueExplicit("K".$j, $subject_info['parmanent_country_code'],PHPExcel_Cell_DataType::TYPE_STRING);
              $phpExcel->getActiveSheet()->SetCellValueExplicit("L".$j, $subject_info['phone_number'] ,PHPExcel_Cell_DataType::TYPE_STRING);
              $phpExcel->getActiveSheet()->SetCellValueExplicit("M".$j, $subject_info['nid_number'] ,PHPExcel_Cell_DataType::TYPE_STRING);
            /*  $phpExcel->getActiveSheet()->SetCellValueExplicit("N".$j, $subject_info['exp_date_of_next_installment'] ,PHPExcel_Cell_DataType::TYPE_STRING);*/

            $j++;

            }
              


############################################### subject information #####################################################


       
    #################################################### Contracts ####################################################   

       /* $phpExcel = new PHPExcel();
        $phpExcel->setActiveSheetIndex(0);
        $phpExcel->getActiveSheet()->setTitle("Contracts");
        $currentDate = date('dmY');
        $currentTime = date('hisa');*/

            $phpExcel->createSheet();
            $phpExcel->setActiveSheetIndex(1);
            $phpExcel->getActiveSheet()->setTitle("Contracts");


       
        

        $phpExcel->getActiveSheet()->mergeCells('G1:H1');
        $phpExcel->getActiveSheet()->SetCellValue('G1', 'CIB  REPORT FOR '.date('M-Y', strtotime($input_date)));
        $phpExcel->getActiveSheet()->getStyle("O1")->applyFromArray($style_r);

         $phpExcel->getActiveSheet()->GetStyle("A1:O1")->getFont()->setBold(true);

        $phpExcel->getActiveSheet()->mergeCells('G2:H2');
        $phpExcel->getActiveSheet()->SetCellValue('G2', "Date: {$current_date}");
        $phpExcel->getActiveSheet()->getStyle("H2")->applyFromArray($style_r);

          
        $phpExcel->getActiveSheet()->SetCellValue("A4",'Sl No.');
        $phpExcel->getActiveSheet()->SetCellValue("B4",'FI Subject Code');
        $phpExcel->getActiveSheet()->SetCellValue("C4",'FI Contract Code');
        $phpExcel->getActiveSheet()->SetCellValue("D4",'Contract Phase');
        $phpExcel->getActiveSheet()->SetCellValue("E4",'Contract Status');
        $phpExcel->getActiveSheet()->SetCellValue("F4",'Currency Code');
        $phpExcel->getActiveSheet()->SetCellValue("G4",'Periodicity of Payment');
        $phpExcel->getActiveSheet()->SetCellValue("H4",'Method Of Payment');
        $phpExcel->getActiveSheet()->SetCellValue("I4",'Section Limit');
        $phpExcel->getActiveSheet()->SetCellValue("J4",'Expiration Date of Next Installment');
        $phpExcel->getActiveSheet()->SetCellValue("K4",'Remaining Amount');
        $phpExcel->getActiveSheet()->SetCellValue("L4",'Over Due Amount');
        $phpExcel->getActiveSheet()->SetCellValue("M4",'Total  Disburste Amount');
        $phpExcel->getActiveSheet()->SetCellValue("N4",'Outstanding Amount');
        
        

        $phpExcel->getActiveSheet()->GetColumnDimension("A")->SetAutoSize(true);
        $phpExcel->getActiveSheet()->GetColumnDimension("B")->SetAutoSize(true);
        $phpExcel->getActiveSheet()->GetColumnDimension("C")->SetAutoSize(true);
        $phpExcel->getActiveSheet()->GetColumnDimension("D")->SetAutoSize(true);
        $phpExcel->getActiveSheet()->GetColumnDimension("E")->SetAutoSize(true);
        $phpExcel->getActiveSheet()->GetColumnDimension("F")->SetAutoSize(true);
        $phpExcel->getActiveSheet()->GetColumnDimension("G")->SetAutoSize(true);
        $phpExcel->getActiveSheet()->GetColumnDimension("H")->SetAutoSize(true);
        $phpExcel->getActiveSheet()->GetColumnDimension("I")->SetAutoSize(true);
        $phpExcel->getActiveSheet()->GetColumnDimension("J")->SetAutoSize(true);
        $phpExcel->getActiveSheet()->GetColumnDimension("K")->SetAutoSize(true);
        $phpExcel->getActiveSheet()->GetColumnDimension("L")->SetAutoSize(true);
        $phpExcel->getActiveSheet()->GetColumnDimension("M")->SetAutoSize(true);
        $phpExcel->getActiveSheet()->GetColumnDimension("N")->SetAutoSize(true);
        $phpExcel->getActiveSheet()->GetColumnDimension("O")->SetAutoSize(true);
      
        



       
        $phpExcel->getActiveSheet()->GetStyle("A4:O4")->getFont()->setBold(true);
        

 

        $phpExcel->getActiveSheet()->GetStyle("A4:O4")->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
        $phpExcel->getActiveSheet()->getDefaultStyle()->applyFromArray($style);



//$contract_query =  mysql_query("SELECT * from contracts_info_archive cia where status ='1' and Year(cia.reporting_date)='$year' and month(cia.reporting_date)='$month' and count='$count' ");

$contract_query =  mysql_query(" SELECT *, record_type AS rec2 from contracts_info_archive where month(reporting_date)='$month' and year(reporting_date)='$year' and status ='1' and fi_subject_code in (select fi_subject_code from subject_info_archive where status ='1' or status ='2' group by fi_subject_code)  ");


  $i=5;
  $sl=1;
while($contracts_info = mysql_fetch_assoc($contract_query))

{

  $phpExcel->getActiveSheet()->SetCellValueExplicit("A".$i, $sl++ ,PHPExcel_Cell_DataType::TYPE_STRING);
  $phpExcel->getActiveSheet()->SetCellValueExplicit("B".$i, $contracts_info['fi_subject_code'],PHPExcel_Cell_DataType::TYPE_STRING);
  $phpExcel->getActiveSheet()->SetCellValueExplicit("C".$i, $contracts_info['fi_contract_code'],PHPExcel_Cell_DataType::TYPE_STRING);
  $phpExcel->getActiveSheet()->SetCellValueExplicit("D".$i, $contracts_info['contract_phase'] ,PHPExcel_Cell_DataType::TYPE_STRING);
  $phpExcel->getActiveSheet()->SetCellValueExplicit("E".$i,  $contracts_info['contract_status'] ,PHPExcel_Cell_DataType::TYPE_STRING);
  $phpExcel->getActiveSheet()->SetCellValueExplicit("F".$i,  $contracts_info['currency_code'],PHPExcel_Cell_DataType::TYPE_STRING);
  $phpExcel->getActiveSheet()->SetCellValueExplicit("G".$i,  $contracts_info['periodicity_of_payment'] ,PHPExcel_Cell_DataType::TYPE_STRING);
  $phpExcel->getActiveSheet()->SetCellValueExplicit("H".$i,  $contracts_info['method_of_payment'] ,PHPExcel_Cell_DataType::TYPE_STRING);
  $phpExcel->getActiveSheet()->SetCellValueExplicit("I".$i, $contracts_info['section_limit'] ,PHPExcel_Cell_DataType::TYPE_STRING);
  $phpExcel->getActiveSheet()->SetCellValueExplicit("J".$i, $contracts_info['exp_date_of_next_installment'],PHPExcel_Cell_DataType::TYPE_STRING);
  $phpExcel->getActiveSheet()->SetCellValueExplicit("K".$i, $contracts_info['remaining_amt'] ,PHPExcel_Cell_DataType::TYPE_STRING);
  $phpExcel->getActiveSheet()->SetCellValueExplicit("L".$i, $contracts_info['overdue_amt'] ,PHPExcel_Cell_DataType::TYPE_STRING);
  $phpExcel->getActiveSheet()->SetCellValueExplicit("M".$i, $contracts_info['total_disburse_amt'] ,PHPExcel_Cell_DataType::TYPE_STRING);
  $phpExcel->getActiveSheet()->SetCellValueExplicit("N".$i, $contracts_info['outstanding_amt'] ,PHPExcel_Cell_DataType::TYPE_STRING);
  /*$phpExcel->getActiveSheet()->SetCellValueExplicit("O".$i, $contracts_info['fi_contract_code'] ,PHPExcel_Cell_DataType::TYPE_STRING);*/
  $i++;

}

 #################################################### Contracts ####################################################  
 
           

       /* $t_row = $i;
        $phpExcel->getActiveSheet()->SetCellValueExplicit("D".$t_row, "Total Amount : ",PHPExcel_Cell_DataType::TYPE_STRING);
        $phpExcel->getActiveSheet()->SetCellValueExplicit("E".$t_row, number_format($total_paid, 2),PHPExcel_Cell_DataType::TYPE_STRING);*/
        // $phpExcel->getActiveSheet()->SetCellValueExplicit("F".$t_row, number_format($total_due, 2),PHPExcel_Cell_DataType::TYPE_STRING);
           


        
            
            
           
       
        
       


        $phpExcel->setActiveSheetIndex(0);
        
        // Redirect output to a client's web browser (Xlsx)
        $objWriter = PHPExcel_IOFactory::createWriter($phpExcel, 'Excel2007');
        ob_end_clean();
        // We'll be outputting an excel file
        header('Content-type: application/vnd.ms-excel');
        //header('Content-Disposition: attachment; filename="payroll.xlsx"');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        $objWriter->save('php://output');
        

        exit;



    }


?>
</body>
</html>
 
      

