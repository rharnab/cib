<?php 
    
    include("../../database.php");
    include('error_check_contact.php');
    include("error_check_subject.php");

    require_once "../../../../Spreadsheet/Excel/Writer.php";
    require_once "../../phpExcelLib/Classes/PHPExcel/IOFactory.php";
    require_once "../../plugins/dompdf/vendor/autoload.php";


    if(isset($_POST['report_date']) ){
       
        $date_array = explode('/', $_POST['report_date']);
        $year = $date_array[2];
        $month = $date_array[1];

        $input_date = $year."-".$month."-"."01"; 

        $reporting_date =  date ('m-Y', strtotime($input_date."-1 month"));
        $report_dt_array = explode('-', $reporting_date);
        $month = $report_dt_array[0];
        $year = $report_dt_array[1];



        /*subject error*/
          function getErrorforsubject($id)

          {
           
            if(!empty($error_msg_array))
            {
              $error_msg_array = array();
            }

            $error = errorCheckSubject($id, NULL);
            if(!empty($error))
            {

              $error_msg_array = array();
              for($i=0; $i < count($error[$id]); $i++)
              {
                  //print_r($error[73659][$i]);
                  $msg =  $error[$id][$i]['msg'];
                  array_push($error_msg_array, $msg);

              }

              return   $messages = implode(',', $error_msg_array);

            }else{

              return  $error='';
            }

          }

      /*end subject error*/


      /*contract error*/
          function getErrorforconntract($id)

          {
           
            if(!empty($error_msg_array))
            {
              $error_msg_array = array();
            }

            $error = errorCheckContact($id, NULL);
            if(!empty($error))
            {

              $error_msg_array = array();
              for($i=0; $i < count($error[$id]); $i++)
              {
                  //print_r($error[73659][$i]);
                  $msg =  $error[$id][$i]['msg'];
                  array_push($error_msg_array, $msg);

              }

              return   $messages = implode(',', $error_msg_array);

            }else{

              return  $error='';
            }

          }

      /*end contract error*/
        
        
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
            $phpExcel->getActiveSheet()->SetCellValue("B4",'Record type');
            $phpExcel->getActiveSheet()->SetCellValue("C4",'FI Code');
            $phpExcel->getActiveSheet()->SetCellValue("D4",'Branch code');
            $phpExcel->getActiveSheet()->SetCellValue("E4",'F.I Subject code');
            $phpExcel->getActiveSheet()->SetCellValue("F4",'Title');
            $phpExcel->getActiveSheet()->SetCellValue("G4",'Name');
            $phpExcel->getActiveSheet()->SetCellValue("H4",'Father Title');
            $phpExcel->getActiveSheet()->SetCellValue("I4",'Father Name');
            $phpExcel->getActiveSheet()->SetCellValue("J4",'Mother Title');
            $phpExcel->getActiveSheet()->SetCellValue("K4",'Mother Name');
            $phpExcel->getActiveSheet()->SetCellValue("L4",'Spouse title');
            $phpExcel->getActiveSheet()->SetCellValue("M4",'Spouse Name');
            $phpExcel->getActiveSheet()->SetCellValue("N4",'Sector type');
            $phpExcel->getActiveSheet()->SetCellValue("N4",'Sector Code');
            $phpExcel->getActiveSheet()->SetCellValue("N4",'Gender');
            $phpExcel->getActiveSheet()->SetCellValue("N4",'Birth date');
            $phpExcel->getActiveSheet()->SetCellValue("N4",'Place of birth');
            $phpExcel->getActiveSheet()->SetCellValue("N4",'Country of Birth');




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

             ###############################################  header ##################################################################

              $subject_query =  mysql_query("SELECT * from subject_info si where year(si.reporting_date) = '$year' and month(si.reporting_date) = '$month' ");

              

              $j=5;
              $sl=1;
            while($subject_info = mysql_fetch_assoc($subject_query))
            {


               $errors = getErrorforsubject($subject_info['id']);




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
              $phpExcel->getActiveSheet()->SetCellValueExplicit("N".$j, $errors ,PHPExcel_Cell_DataType::TYPE_STRING);
           

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
        $phpExcel->getActiveSheet()->SetCellValue("O4",'Remarks');
        
        

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



$contract_query =  mysql_query("SELECT * from contracts_info ci  where year(ci.reporting_date) = '$year' and month(ci.reporting_date) = '$month'");


  $i=5;
  $sl=1;
while($contracts_info = mysql_fetch_assoc($contract_query))

{

  $errors = getErrorforconntract($contracts_info['id']);

  //echo $errors."<br>";

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
  $phpExcel->getActiveSheet()->SetCellValueExplicit("O".$i, $errors ,PHPExcel_Cell_DataType::TYPE_STRING);
  $i++;

}

 #################################################### Contracts ####################################################  
 
           

      
           


        
            
            
           
       
        
       


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
 
      

