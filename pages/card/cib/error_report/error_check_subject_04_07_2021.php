<?php
include('../../database.php');

function errorCheckSubject($id=NULL,$reportingDate)
{
	//checking if ID is empty
	$errorArray=array();
	$error=array();
	if($id==NULL)//id not given
	{
		$reportingDate=date("Y-m-d",strtotime($reportingDate));
		$qIdCheck=mysql_query("SELECT *  FROM `subject_info` WHERE `reporting_date` = '$reportingDate'");
		while($d=mysql_fetch_array($qIdCheck))
		{
			$record_type = $d['record_type'];
			$fi_code = $d['fi_code'];
			$acc_date = $d['acc_date'];
			$pro_date = $d['production_date'];
			$code_link = $d['code_link'];
			$branch_code = $d['branch_code'];
			$fi_subject_code = $d['fi_subject_code'];
			$title = $d['title'];
			$name = $d['name'];
			$father_title = $d['fathers_title'];
			$fathers_name = $d['fathers_name'];
			$mother_title = $d['mothers_title'];
			$mother_name = $d['mothers_name'];
			$spouse_title = $d['spouse_title'];
			$spouse = $d['spouse'];
			$sector_type = $d['sector_type'];
			$sector_code = $d['sector_code'];
			$gender = $d['gender'];
			$dath_of_brth = $d['dath_of_brth'];
			$place_of_birth = $d['place_of_birth'];
			$country_of_birth = $d['country_of_birth'];
			$nid_number = $d['nid_number'];
			$is_nid = $d['is_nid'];
			$tin_number = $d['tin_number'];
			$par_street = $d['parmanent_street'];
			$par_postal_code = $d['parmanent_postal_code'];
			$par_district = $d['parmanent_district'];
			$par_country_code = $d['parmanent_country_code'];
			$addi_street = $d['additional_street'];
			$addi_postal_code = $d['additional_postal_code'];
			$addi_district = $d['additional_district'];
			$addi_country_code = $d['additional_country_code'];
			$busi_street = $d['business_address'];
			$busi_postal_code = $d['business_postal_code'];
			$busi_district = $d['business_district'];
			$busi_country_code = $d['business_country_code'];
			$id_type = $d['id_type'];
			$id_nr = $d['id_nr'];
			$id_issue_dt = $d['id_issue_date'];
			$id_issue_cntry_code = $d['id_issue_country_code'];
			$phone_number = $d['phone_number'];
			$full_nid_number = $d['full_nid_number'];
			$id=$d['id'];
			$error=array();

			if($record_type !='')
			{
				if(strlen($record_type) == 1)
				{
					 
				}else{
					array_push($error,array(
								'field'=>'record_type',
								'msg'=>"invalid Record Type Length",
								'status'=>1
							));
					 
				}

			}else{
				array_push($error,array(
								'field'=>'record_type',
								'msg'=>"Record Type Can not be empty",
								'status'=>1
							));
			}
			

			if($fi_code !='')
			{
				if(strlen($fi_code) == 3)
				{
					
				}else{
					array_push($error,array(
								'field'=>'fi_code',
								'msg'=>"Invalid FI Code Length",
								'status'=>1
							));
				}

			}else{
				array_push($error,array(
								'field'=>'fi_code',
								'msg'=>"FI Code Can not be empty",
								'status'=>1
							));
				}
			

			

			// if($branch_code !='')
			// {
			// 	if(strlen($branch_code) == 4)
			// 	{
					
			// 	}else{
			// 		array_push($error,array(
			// 					'field'=>'branch_code',
			// 					'msg'=>"Invalid Branch Code Length",
			// 					'status'=>1
			// 				));
			// 	}

			// }else{
			// 	array_push($error,array(
			// 					'field'=>'branch_code',
			// 					'msg'=>"Branch Code Can not be empty",
			// 					'status'=>1
			// 				));
			// }


			if($fi_subject_code !='')
			{
				if(strlen($fi_subject_code) <= 16)
				{
					 
				}else{
					 array_push($error,array(
								'field'=>'fi_subject_code',
								'msg'=>"Invalid FI Subject Code Length",
								'status'=>1
							));
				}

			}else{
				array_push($error,array(
								'field'=>'fi_subject_code',
								'msg'=>" FI Subject Code Can not be Empty",
								'status'=>1
							));
			}

			// if($title !='')
			// {
			// 	if(strlen($title) == 20)
			// 	{
					
			// 	}else{
			// 		 array_push($error,array(
			// 					'field'=>'title',
			// 					'msg'=>"Invalid Title Length",
			// 					'status'=>1
			// 				));
			// 	}

			// }else{
			// 	 array_push($error,array(
			// 					'field'=>'title',
			// 					'msg'=>"Title Can not be empty",
			// 					'status'=>1
			// 				));
			// }

			if($name !='')
			{
				if(strlen($name) <= 70)
				{
					  
				}else{
					  array_push($error,array(
								'field'=>'name',
								'msg'=>"Invalid Name Length",
								'status'=>1
							));
				}

			}else{
				array_push($error,array(
								'field'=>'name',
								'msg'=>"Name cant not be empty",
								'status'=>1
							));
			}

			// if($father_title !='')
			// {
			// 	if(strlen($father_title) == 20)
			// 	{
					
			// 	}else{
			// 		 array_push($error,array(
			// 					'field'=>'father_title',
			// 					'msg'=>"Invalid Father's Title Length",
			// 					'status'=>1
			// 				));
			// 	}

			// }else{
			// 	array_push($error,array(
			// 					'field'=>'father_title',
			// 					'msg'=>" Father's Title Can not be empty",
			// 					'status'=>1
			// 				));
			// }

			if($fathers_name !='')
			{
				if(strlen($fathers_name) <= 70)
				{
					
				}else{
					  array_push($error,array(
								'field'=>'fathers_name',
								'msg'=>"Invalid Father's Name Length",
								'status'=>1
							));
				}

			}else{
				array_push($error,array(
								'field'=>'fathers_name',
								'msg'=>" Father's Name Can not be empty",
								'status'=>1
							));
			}

			// if($mother_title !='')
			// {
			// 	if(strlen($mother_title) == 20)
			// 	{
					
			// 	}else{
			// 		 array_push($error,array(
			// 					'field'=>'mother_title',
			// 					'msg'=>"Invalid Mother's Title Length",
			// 					'status'=>1
			// 				));
			// 	}

			// }else{
			// 	array_push($error,array(
			// 					'field'=>'mother_title',
			// 					'msg'=>"Mother's Title Can not be empty",
			// 					'status'=>1
			// 				));
			// }


			if($mother_name !='')
			{
				if(strlen($mother_name) <= 70)
				{
					 
				}else{
					  array_push($error,array(
								'field'=>'mother_name',
								'msg'=>"Invalid Mother's Name Length",
								'status'=>1
							));
				}

			}else{
				array_push($error,array(
								'field'=>'mother_name',
								'msg'=>"Mother's Name Can not be empty",
								'status'=>1
							));
			}


			// if($spouse_title !='')
			// {
			// 	if(strlen($spouse_title) == 20)
			// 	{
					 
			// 	}else{
			// 		 array_push($error,array(
			// 					'field'=>'spouse_title',
			// 					'msg'=>"Invalid Spouse's Title Length",
			// 					'status'=>1
			// 				));
			// 	}

			// }else{
			// 	array_push($error,array(
			// 					'field'=>'spouse_title',
			// 					'msg'=>"Spouse's Title Can not be empty",
			// 					'status'=>1
			// 				));
			// }


			// if($spouse !='')
			// {
			// 	if(strlen($spouse) == 70)
			// 	{
					
			// 	}else{
			// 		  array_push($error,array(
			// 					'field'=>'spouse',
			// 					'msg'=>"Invalid Spouse  Length",
			// 					'status'=>1
			// 				));
			// 	}

			// }else{
			// 	array_push($error,array(
			// 					'field'=>'spouse',
			// 					'msg'=>"Spouse Can not be empty",
			// 					'status'=>1
			// 				));
			// }


			if($sector_type !='')
			{
				if(strlen($sector_type) == 1)
				{
					 
				}else{
					  array_push($error,array(
								'field'=>'sector_type',
								'msg'=>"Invalid Sector Type Length",
								'status'=>1
							));
				}

			}else{
				array_push($error,array(
								'field'=>'sector_type',
								'msg'=>"Sector Type Can not be empty",
								'status'=>1
							));
			}

			// if($sector_code !='')
			// {
			// 	if(strlen($sector_code) == 6)
			// 	{
			// 		 $sector_code;
			// 	}else{
			// 		 $sector_code = $sector_code.str_repeat(" ", 6 - strlen($sector_code));
			// 	}

			// }else{
			// 	$sector_code = str_repeat(" ", 6);
			// }


			if($gender !='')
			{
				if(strlen($gender) == 1)
				{
					 
				}else{
					array_push($error,array(
								'field'=>'gender',
								'msg'=>"Invalid Gender Length",
								'status'=>1
							));
				}

			}else{
				array_push($error,array(
								'field'=>'gender',
								'msg'=>"Gender Can not be empty",
								'status'=>1
							));
			}



			// if($dath_of_brth !='')
			// {

			// 	 //$brth_array = date('d-m-Y', strtotime($dath_of_brth));
			// 	 $birth_dt = explode("/",  $dath_of_brth);
			// 	 $dath_of_brth =  $birth_dt[0].$birth_dt[1].$birth_dt[2];

			// 	if(strlen($dath_of_brth) == 8)
			// 	{
			// 		 $dath_of_brth;
			// 	}else{
			// 		 $dath_of_brth =  $dath_of_brth.str_repeat(" ", 8 - strlen($dath_of_brth));
			// 	}

			// }else{
			// 	$dath_of_brth = str_repeat("0", 8);
			// }

			if($country_of_birth !='')
			{
				if(strlen($country_of_birth) == 2)
				{
						if(strtolower($country_of_birth)=='bd')
						{
							// if($place_of_birth !='')
							// {
							// 	if(strlen($place_of_birth) <= 20)
							// 	{
									 
							// 	}else{
							// 		array_push($error,array(
							// 					'field'=>'place_of_birth',
							// 					'msg'=>"Invalid Place of Birth Length",
							// 					'status'=>1
							// 				));
							// 	}

							// }else{
							// 	array_push($error,array(
							// 					'field'=>'place_of_birth',
							// 					'msg'=>"Place of Birth Can not be empty",
							// 					'status'=>1
							// 				));
							// } 
						}
				}else{
					 array_push($error,array(
								'field'=>'country_of_birth',
								'msg'=>"Invalid Country of Birth Length",
								'status'=>1
							));
				}

			}else{
				array_push($error,array(
								'field'=>'country_of_birth',
								'msg'=>"Country of Birth Can not be empty",
								'status'=>1
							));
			}

			



			


			/*if($nid_number !='')
			{
				

				if(strlen($nid_number) == 13)
				{
					 $nid_number;
				}
				else if(strlen($nid_number) >  13)
				{
					 $nid_number = substr($nid_number, strlen($nid_number) - 13);
				}

				else{
					 $nid_number =  $nid_number.str_repeat(" ", 13 - strlen($nid_number));
				}

			}else{
				$nid_number = str_repeat(" ", 13);
			}*/
			//====================================check=============================
			if($is_nid !='')
			{
				if(strlen($is_nid) == 1)
				{
					 	if($nid_number !='')
						{
							if(strlen($nid_number) <= 17)
							{
								 
							}else{
								 array_push($error,array(
											'field'=>'nid_number',
											'msg'=>"Invalid NID Number Length",
											'status'=>1
										));
							}

						}else{
							array_push($error,array(
											'field'=>'nid_number',
											'msg'=>"NID Number can not be empty",
											'status'=>1
										));
						}
				}else{
					 array_push($error,array(
								'field'=>'is_nid',
								'msg'=>"Invalid Is NID Length",
								'status'=>1
							));
				}

			}else{
				array_push($error,array(
								'field'=>'is_nid',
								'msg'=>"Is NID Can not be empty",
								'status'=>1
							));
			}

			

//====================================check=============================
			


			// if($tin_number !='')
			// {
				
			// 	if(strlen($tin_number) == 12)
			// 	{
			// 		 $tin_number;
			// 	}
			// 	else if(strlen($tin_number) > 12 ){
			// 		$tin_number = substr($tin_number, strlen($tin_number) - 12);
			// 	}
			// 	else{
			// 		 $tin_number =  $tin_number.str_repeat(" ", 12 - strlen($tin_number));
			// 	}

			// }else{
			// 	$tin_number = str_repeat(" ", 12);
			// }


			if($par_street !='')
			{
				if(strlen($par_street) <= 100)
				{
					
				}
				else if(strlen($par_street) > 100 ){
					array_push($error,array(
								'field'=>'par_street',
								'msg'=>"Invalid Parmanet Street Length",
								'status'=>1
							));
				}

				else{
					array_push($error,array(
								'field'=>'par_street',
								'msg'=>"Invalid Parmanet Street Length",
								'status'=>1
							));
				}

			}else{
				array_push($error,array(
								'field'=>'par_street',
								'msg'=>"Invalid Parmanet Street Length",
								'status'=>1
							));
			}



			// if($par_postal_code !='')
			// {
			// 	if(strlen($par_postal_code) == 4)
			// 	{
			// 		 $par_postal_code;
			// 	}else{
			// 		 $par_postal_code =  $par_postal_code.str_repeat(" ", 4 - strlen($par_postal_code));
			// 	}

			// }else{
			// 	$par_postal_code = str_repeat(" ", 4);
			// }


			if($par_district !='')
			{
				if(strlen($par_district) <= 20)
				{
					
				}else{
					array_push($error,array(
								'field'=>'par_district',
								'msg'=>"Invalid Parmanet District Length",
								'status'=>1
							));
				}

			}else{
				array_push($error,array(
								'field'=>'par_district',
								'msg'=>"Parmanet District Can not be empty",
								'status'=>1
							));
			}


			if($par_country_code !='')
			{
				if(strlen($par_country_code) == 2)
				{
					 
				}else{
					 array_push($error,array(
								'field'=>'par_country_code',
								'msg'=>"Invalid Parmanet Country Code Length",
								'status'=>1
							));
				}

			}else{
				array_push($error,array(
								'field'=>'par_country_code',
								'msg'=>"Parmanet Country Code Can not be empty",
								'status'=>1
							));
			}



			// if($addi_street !='')
			// {
			// 	if(strlen($addi_street) == 100)
			// 	{
			// 		 $addi_street;
			// 	}else{
			// 		 $addi_street =  $addi_street.str_repeat(" ", 100 - strlen($addi_street));
			// 	}

			// }else{
			// 	$addi_street = str_repeat(" ", 100);
			// }


			// if($addi_postal_code !='')
			// {
			// 	if(strlen($addi_postal_code) == 4)
			// 	{
			// 		 $addi_postal_code;
			// 	}else{
			// 		 $addi_postal_code =  $addi_postal_code.str_repeat(" ", 4 - strlen($addi_postal_code));
			// 	}

			// }else{
			// 	$addi_postal_code = str_repeat(" ", 4);
			// }


			// if($addi_district !='')
			// {
			// 	if(strlen($addi_district) == 20)
			// 	{
			// 		 $addi_district;
			// 	}else{
			// 		 $addi_district =  $addi_district.str_repeat(" ", 20 - strlen($addi_district));
			// 	}

			// }else{
			// 	$addi_district = str_repeat(" ", 20);
			// }


			// if($addi_country_code !='')
			// {
			// 	if(strlen($addi_country_code) == 2)
			// 	{
			// 		 $addi_country_code;
			// 	}else{
			// 		 $addi_country_code =  $addi_country_code.str_repeat(" ", 2 - strlen($addi_country_code));
			// 	}

			// }else{
			// 	$addi_country_code = str_repeat(" ", 2);
			// }

			//new

			if($busi_street !='')
			{
				if(strlen($busi_street) <= 100)
				{
							if($busi_district !='')
							{
								if(strlen($busi_district) <= 20)
								{
									
								}else{
									  array_push($error,array(
												'field'=>'busi_district',
												'msg'=>"Invalid Business District Length",
												'status'=>1
											));
								}

							}else{
								array_push($error,array(
												'field'=>'busi_district',
												'msg'=>"Business District Can not be empty",
												'status'=>1
											));
							}


							if($busi_country_code !='')
							{
								if(strlen($busi_country_code) == 2)
								{
									 
								}else{
									array_push($error,array(
												'field'=>'busi_country_code',
												'msg'=>"Invalid Business Country Code Length",
												'status'=>1
											));
								}

							}else{
								array_push($error,array(
												'field'=>'busi_country_code',
												'msg'=>"Business Country Code Can not be Empty",
												'status'=>1
											));
							}
				}else{
					 // array_push($error,array(
						// 		'field'=>'busi_street',
						// 		'msg'=>"Invalid Business Street Length",
						// 		'status'=>1
						// 	));
				}

			}else{
				// array_push($error,array(
				// 				'field'=>'busi_street',
				// 				'msg'=>"Business Street Can not be empty",
				// 				'status'=>1
				// 			));
			}


			// if($busi_postal_code !='')
			// {
			// 	if(strlen($busi_postal_code) == 4)
			// 	{
			// 		 $busi_postal_code;
			// 	}else{
			// 		 $busi_postal_code =  $busi_postal_code.str_repeat(" ", 4 - strlen($busi_postal_code));
			// 	}

			// }else{
			// 	$busi_postal_code = str_repeat(" ", 4);
			// }


			







			if($id_nr !='')
			{
				if(strlen($id_nr) <= 20)
				{
					 	
						if($id_type !='')
						{
							if(strlen($id_type) == 1)
							{
								 
							}else{
								array_push($error,array(
											'field'=>'id_type',
											'msg'=>"Invalid ID Type Length",
											'status'=>1
										));
							}

						}else{
							array_push($error,array(
											'field'=>'id_type',
											'msg'=>" ID Type Can not be empty",
											'status'=>1
										));
						}

						if($id_issue_dt !='')
						{
							 $id_issue_array = date('d-m-Y', strtotime($id_issue_dt));
							 $issue_dt = explode("-",  $id_issue_array);
							 $id_issue_dt =  $issue_dt[0].$issue_dt[1].$issue_dt[2];

							if(strlen($id_issue_dt) == 8)
							{
								 
							}else{
								 array_push($error,array(
											'field'=>'id_issue_dt',
											'msg'=>"Invalid ID Issue Date Length",
											'status'=>1
										));
							}

						}else{
							array_push($error,array(
											'field'=>'id_issue_dt',
											'msg'=>" ID Issue Date Can not be empty",
											'status'=>1
										));
						}

						
						

						if($id_issue_cntry_code !='')
						{
							if(strlen($id_issue_cntry_code) == 2)
							{
								 
							}else{
								 array_push($error,array(
											'field'=>'id_issue_cntry_code',
											'msg'=>"Invalid ID Issue Country Code Length",
											'status'=>1
										));
							}

						}else{
							array_push($error,array(
											'field'=>'id_issue_cntry_code',
											'msg'=>"ID Issue Country Code Can not be empty",
											'status'=>1
										));
						}

				}else{
					array_push($error,array(
								'field'=>'id_nr',
								'msg'=>"Invalid ID No Length",
								'status'=>1
							));
				}

			}else{
				// array_push($error,array(
				// 				'field'=>'id_nr',
				// 				'msg'=>"ID No Can not be empty",
				// 				'status'=>1
				// 			));
			}






			// if($phone_number !='')
			// {
			// 	if(strlen($phone_number) == 20)
			// 	{
			// 		 $phone_number;
			// 	}else{
			// 		 $phone_number =  $phone_number.str_repeat(" ", 20 - strlen($phone_number));
			// 	}

			// }else{
			// 	$phone_number = str_repeat(" ", 20);
			// }



			// if($full_nid_number !='')
			// {
				
			// 	if(strlen($full_nid_number) == 17)
			// 	{
			// 		 $full_nid_number;
			// 	}
			// 	else if(strlen($full_nid_number) > 17)
			// 	{
			// 		$full_nid_number = substr($full_nid_number, strlen($full_nid_number) - 17);
			// 	}
			// 	else{
			// 		 $full_nid_number =  $full_nid_number.str_repeat(" ", 17 - strlen($full_nid_number));
			// 	}

			// }else{
			// 	 $full_nid_number = str_repeat(" ", 17);
			// }
			if(!empty($error))
			$errorArray[$id]=$error;
		}
	}
	else//id given
	{
		$qIdCheck=mysql_query("SELECT *  FROM `subject_info` WHERE `id` = '$id'");
		if(mysql_num_rows($qIdCheck)>0)//data found
		{
			$d=mysql_fetch_array($qIdCheck);
			$record_type = $d['record_type'];
			$fi_code = $d['fi_code'];
			$acc_date = $d['acc_date'];
			$pro_date = $d['production_date'];
			$code_link = $d['code_link'];
			$branch_code = $d['branch_code'];
			$fi_subject_code = $d['fi_subject_code'];
			$title = $d['title'];
			$name = $d['name'];
			$father_title = $d['fathers_title'];
			$fathers_name = $d['fathers_name'];
			$mother_title = $d['mothers_title'];
			$mother_name = $d['mothers_name'];
			$spouse_title = $d['spouse_title'];
			$spouse = $d['spouse'];
			$sector_type = $d['sector_type'];
			$sector_code = $d['sector_code'];
			$gender = $d['gender'];
			$dath_of_brth = $d['dath_of_brth'];
			$place_of_birth = $d['place_of_birth'];
			$country_of_birth = $d['country_of_birth'];
			$nid_number = $d['nid_number'];
			$is_nid = $d['is_nid'];
			$tin_number = $d['tin_number'];
			$par_street = $d['parmanent_street'];
			$par_postal_code = $d['parmanent_postal_code'];
			$par_district = $d['parmanent_district'];
			$par_country_code = $d['parmanent_country_code'];
			$addi_street = $d['additional_street'];
			$addi_postal_code = $d['additional_postal_code'];
			$addi_district = $d['additional_district'];
			$addi_country_code = $d['additional_country_code'];
			$busi_street = $d['business_address'];
			$busi_postal_code = $d['business_postal_code'];
			$busi_district = $d['business_district'];
			$busi_country_code = $d['business_country_code'];
			$id_type = $d['id_type'];
			$id_nr = $d['id_nr'];
			$id_issue_dt = $d['id_issue_date'];
			$id_issue_cntry_code = $d['id_issue_country_code'];
			$phone_number = $d['phone_number'];
			$full_nid_number = $d['full_nid_number'];



			if($record_type !='')
			{
				if(strlen($record_type) == 1)
				{
					 
				}else{
					array_push($error,array(
								'field'=>'record_type',
								'msg'=>"invalid Record Type Length",
								'status'=>1
							));
					 
				}

			}else{
				array_push($error,array(
								'field'=>'record_type',
								'msg'=>"Record Type Can not be empty",
								'status'=>1
							));
			}
			

			if($fi_code !='')
			{
				if(strlen($fi_code) == 3)
				{
					
				}else{
					array_push($error,array(
								'field'=>'fi_code',
								'msg'=>"Invalid FI Code Length",
								'status'=>1
							));
				}

			}else{
				array_push($error,array(
								'field'=>'fi_code',
								'msg'=>"FI Code Can not be empty",
								'status'=>1
							));
				}
			

			

			// if($branch_code !='')
			// {
			// 	if(strlen($branch_code) == 4)
			// 	{
					
			// 	}else{
			// 		array_push($error,array(
			// 					'field'=>'branch_code',
			// 					'msg'=>"Invalid Branch Code Length",
			// 					'status'=>1
			// 				));
			// 	}

			// }else{
			// 	array_push($error,array(
			// 					'field'=>'branch_code',
			// 					'msg'=>"Branch Code Can not be empty",
			// 					'status'=>1
			// 				));
			// }


			if($fi_subject_code !='')
			{
				if(strlen($fi_subject_code) <= 16)
				{
					 
				}else{
					 array_push($error,array(
								'field'=>'fi_subject_code',
								'msg'=>"Invalid FI Subject Code Length",
								'status'=>1
							));
				}

			}else{
				array_push($error,array(
								'field'=>'fi_subject_code',
								'msg'=>" FI Subject Code Can not be Empty",
								'status'=>1
							));
			}

			// if($title !='')
			// {
			// 	if(strlen($title) == 20)
			// 	{
					
			// 	}else{
			// 		 array_push($error,array(
			// 					'field'=>'title',
			// 					'msg'=>"Invalid Title Length",
			// 					'status'=>1
			// 				));
			// 	}

			// }else{
			// 	 array_push($error,array(
			// 					'field'=>'title',
			// 					'msg'=>"Title Can not be empty",
			// 					'status'=>1
			// 				));
			// }

			if($name !='')
			{
				if(strlen($name) <= 70)
				{
					  
				}else{
					  array_push($error,array(
								'field'=>'name',
								'msg'=>"Invalid Name Length",
								'status'=>1
							));
				}

			}else{
				array_push($error,array(
								'field'=>'name',
								'msg'=>"Name cant not be empty",
								'status'=>1
							));
			}

			// if($father_title !='')
			// {
			// 	if(strlen($father_title) == 20)
			// 	{
					
			// 	}else{
			// 		 array_push($error,array(
			// 					'field'=>'father_title',
			// 					'msg'=>"Invalid Father's Title Length",
			// 					'status'=>1
			// 				));
			// 	}

			// }else{
			// 	array_push($error,array(
			// 					'field'=>'father_title',
			// 					'msg'=>" Father's Title Can not be empty",
			// 					'status'=>1
			// 				));
			// }

			if($fathers_name !='')
			{
				if(strlen($fathers_name) <= 70)
				{
					
				}else{
					  array_push($error,array(
								'field'=>'fathers_name',
								'msg'=>"Invalid Father's Name Length",
								'status'=>1
							));
				}

			}else{
				array_push($error,array(
								'field'=>'fathers_name',
								'msg'=>" Father's Name Can not be empty",
								'status'=>1
							));
			}

			// if($mother_title !='')
			// {
			// 	if(strlen($mother_title) == 20)
			// 	{
					
			// 	}else{
			// 		 array_push($error,array(
			// 					'field'=>'mother_title',
			// 					'msg'=>"Invalid Mother's Title Length",
			// 					'status'=>1
			// 				));
			// 	}

			// }else{
			// 	array_push($error,array(
			// 					'field'=>'mother_title',
			// 					'msg'=>"Mother's Title Can not be empty",
			// 					'status'=>1
			// 				));
			// }


			if($mother_name !='')
			{
				if(strlen($mother_name) <= 70)
				{
					 
				}else{
					  array_push($error,array(
								'field'=>'mother_name',
								'msg'=>"Invalid Mother's Name Length",
								'status'=>1
							));
				}

			}else{
				array_push($error,array(
								'field'=>'mother_name',
								'msg'=>"Mother's Name Can not be empty",
								'status'=>1
							));
			}


			// if($spouse_title !='')
			// {
			// 	if(strlen($spouse_title) == 20)
			// 	{
					 
			// 	}else{
			// 		 array_push($error,array(
			// 					'field'=>'spouse_title',
			// 					'msg'=>"Invalid Spouse's Title Length",
			// 					'status'=>1
			// 				));
			// 	}

			// }else{
			// 	array_push($error,array(
			// 					'field'=>'spouse_title',
			// 					'msg'=>"Spouse's Title Can not be empty",
			// 					'status'=>1
			// 				));
			// }


			// if($spouse !='')
			// {
			// 	if(strlen($spouse) == 70)
			// 	{
					
			// 	}else{
			// 		  array_push($error,array(
			// 					'field'=>'spouse',
			// 					'msg'=>"Invalid Spouse  Length",
			// 					'status'=>1
			// 				));
			// 	}

			// }else{
			// 	array_push($error,array(
			// 					'field'=>'spouse',
			// 					'msg'=>"Spouse Can not be empty",
			// 					'status'=>1
			// 				));
			// }


			if($sector_type !='')
			{
				if(strlen($sector_type) == 1)
				{
					 
				}else{
					  array_push($error,array(
								'field'=>'sector_type',
								'msg'=>"Invalid Sector Type Length",
								'status'=>1
							));
				}

			}else{
				array_push($error,array(
								'field'=>'sector_type',
								'msg'=>"Sector Type Can not be empty",
								'status'=>1
							));
			}

			// if($sector_code !='')
			// {
			// 	if(strlen($sector_code) == 6)
			// 	{
			// 		 $sector_code;
			// 	}else{
			// 		 $sector_code = $sector_code.str_repeat(" ", 6 - strlen($sector_code));
			// 	}

			// }else{
			// 	$sector_code = str_repeat(" ", 6);
			// }


			if($gender !='')
			{
				if(strlen($gender) == 1)
				{
					 
				}else{
					array_push($error,array(
								'field'=>'gender',
								'msg'=>"Invalid Gender Length",
								'status'=>1
							));
				}

			}else{
				array_push($error,array(
								'field'=>'gender',
								'msg'=>"Gender Can not be empty",
								'status'=>1
							));
			}



			// if($dath_of_brth !='')
			// {

			// 	 //$brth_array = date('d-m-Y', strtotime($dath_of_brth));
			// 	 $birth_dt = explode("/",  $dath_of_brth);
			// 	 $dath_of_brth =  $birth_dt[0].$birth_dt[1].$birth_dt[2];

			// 	if(strlen($dath_of_brth) == 8)
			// 	{
			// 		 $dath_of_brth;
			// 	}else{
			// 		 $dath_of_brth =  $dath_of_brth.str_repeat(" ", 8 - strlen($dath_of_brth));
			// 	}

			// }else{
			// 	$dath_of_brth = str_repeat("0", 8);
			// }

			if($country_of_birth !='')
			{
				if(strlen($country_of_birth) == 2)
				{
						if(strtolower($country_of_birth)=='bd')
						{
							// if($place_of_birth !='')
							// {
							// 	if(strlen($place_of_birth) <= 20)
							// 	{
									 
							// 	}else{
							// 		array_push($error,array(
							// 					'field'=>'place_of_birth',
							// 					'msg'=>"Invalid Place of Birth Length",
							// 					'status'=>1
							// 				));
							// 	}

							// }else{
							// 	array_push($error,array(
							// 					'field'=>'place_of_birth',
							// 					'msg'=>"Place of Birth Can not be empty",
							// 					'status'=>1
							// 				));
							// } 
						}
				}else{
					 array_push($error,array(
								'field'=>'country_of_birth',
								'msg'=>"Invalid Country of Birth Length",
								'status'=>1
							));
				}

			}else{
				array_push($error,array(
								'field'=>'country_of_birth',
								'msg'=>"Country of Birth Can not be empty",
								'status'=>1
							));
			}

			



			


			/*if($nid_number !='')
			{
				

				if(strlen($nid_number) == 13)
				{
					 $nid_number;
				}
				else if(strlen($nid_number) >  13)
				{
					 $nid_number = substr($nid_number, strlen($nid_number) - 13);
				}

				else{
					 $nid_number =  $nid_number.str_repeat(" ", 13 - strlen($nid_number));
				}

			}else{
				$nid_number = str_repeat(" ", 13);
			}*/
			//====================================check=============================
			if($is_nid !='')
			{
				if(strlen($is_nid) == 1)
				{
					 	if($nid_number !='')
						{
							if(strlen($nid_number) <= 17)
							{
								 
							}else{
								 array_push($error,array(
											'field'=>'nid_number',
											'msg'=>"Invalid NID Number Length",
											'status'=>1
										));
							}

						}else{
							array_push($error,array(
											'field'=>'nid_number',
											'msg'=>"NID Number can not be empty",
											'status'=>1
										));
						}
				}else{
					 array_push($error,array(
								'field'=>'is_nid',
								'msg'=>"Invalid Is NID Length",
								'status'=>1
							));
				}

			}else{
				array_push($error,array(
								'field'=>'is_nid',
								'msg'=>"Is NID Can not be empty",
								'status'=>1
							));
			}

			

//====================================check=============================
			


			// if($tin_number !='')
			// {
				
			// 	if(strlen($tin_number) == 12)
			// 	{
			// 		 $tin_number;
			// 	}
			// 	else if(strlen($tin_number) > 12 ){
			// 		$tin_number = substr($tin_number, strlen($tin_number) - 12);
			// 	}
			// 	else{
			// 		 $tin_number =  $tin_number.str_repeat(" ", 12 - strlen($tin_number));
			// 	}

			// }else{
			// 	$tin_number = str_repeat(" ", 12);
			// }


			if($par_street !='')
			{
				if(strlen($par_street) <= 100)
				{
					
				}
				else if(strlen($par_street) > 100 ){
					array_push($error,array(
								'field'=>'par_street',
								'msg'=>"Invalid Parmanet Street Length",
								'status'=>1
							));
				}

				else{
					array_push($error,array(
								'field'=>'par_street',
								'msg'=>"Invalid Parmanet Street Length",
								'status'=>1
							));
				}

			}else{
				array_push($error,array(
								'field'=>'par_street',
								'msg'=>"Invalid Parmanet Street Length",
								'status'=>1
							));
			}



			// if($par_postal_code !='')
			// {
			// 	if(strlen($par_postal_code) == 4)
			// 	{
			// 		 $par_postal_code;
			// 	}else{
			// 		 $par_postal_code =  $par_postal_code.str_repeat(" ", 4 - strlen($par_postal_code));
			// 	}

			// }else{
			// 	$par_postal_code = str_repeat(" ", 4);
			// }


			if($par_district !='')
			{
				if(strlen($par_district) <= 20)
				{
					
				}else{
					array_push($error,array(
								'field'=>'par_district',
								'msg'=>"Invalid Parmanet District Length",
								'status'=>1
							));
				}

			}else{
				array_push($error,array(
								'field'=>'par_district',
								'msg'=>"Parmanet District Can not be empty",
								'status'=>1
							));
			}


			if($par_country_code !='')
			{
				if(strlen($par_country_code) == 2)
				{
					 
				}else{
					 array_push($error,array(
								'field'=>'par_country_code',
								'msg'=>"Invalid Parmanet Country Code Length",
								'status'=>1
							));
				}

			}else{
				array_push($error,array(
								'field'=>'par_country_code',
								'msg'=>"Parmanet Country Code Can not be empty",
								'status'=>1
							));
			}



			// if($addi_street !='')
			// {
			// 	if(strlen($addi_street) == 100)
			// 	{
			// 		 $addi_street;
			// 	}else{
			// 		 $addi_street =  $addi_street.str_repeat(" ", 100 - strlen($addi_street));
			// 	}

			// }else{
			// 	$addi_street = str_repeat(" ", 100);
			// }


			// if($addi_postal_code !='')
			// {
			// 	if(strlen($addi_postal_code) == 4)
			// 	{
			// 		 $addi_postal_code;
			// 	}else{
			// 		 $addi_postal_code =  $addi_postal_code.str_repeat(" ", 4 - strlen($addi_postal_code));
			// 	}

			// }else{
			// 	$addi_postal_code = str_repeat(" ", 4);
			// }


			// if($addi_district !='')
			// {
			// 	if(strlen($addi_district) == 20)
			// 	{
			// 		 $addi_district;
			// 	}else{
			// 		 $addi_district =  $addi_district.str_repeat(" ", 20 - strlen($addi_district));
			// 	}

			// }else{
			// 	$addi_district = str_repeat(" ", 20);
			// }


			// if($addi_country_code !='')
			// {
			// 	if(strlen($addi_country_code) == 2)
			// 	{
			// 		 $addi_country_code;
			// 	}else{
			// 		 $addi_country_code =  $addi_country_code.str_repeat(" ", 2 - strlen($addi_country_code));
			// 	}

			// }else{
			// 	$addi_country_code = str_repeat(" ", 2);
			// }

			//new

			if($busi_street !='')
			{
				if(strlen($busi_street) <= 100)
				{
							if($busi_district !='')
							{
								if(strlen($busi_district) <= 20)
								{
									
								}else{
									  array_push($error,array(
												'field'=>'busi_district',
												'msg'=>"Invalid Business District Length",
												'status'=>1
											));
								}

							}else{
								array_push($error,array(
												'field'=>'busi_district',
												'msg'=>"Business District Can not be empty",
												'status'=>1
											));
							}


							if($busi_country_code !='')
							{
								if(strlen($busi_country_code) == 2)
								{
									 
								}else{
									array_push($error,array(
												'field'=>'busi_country_code',
												'msg'=>"Invalid Business Country Code Length",
												'status'=>1
											));
								}

							}else{
								array_push($error,array(
												'field'=>'busi_country_code',
												'msg'=>"Business Country Code Can not be Empty",
												'status'=>1
											));
							}
				}else{
					 // array_push($error,array(
						// 		'field'=>'busi_street',
						// 		'msg'=>"Invalid Business Street Length",
						// 		'status'=>1
						// 	));
				}

			}else{
				// array_push($error,array(
				// 				'field'=>'busi_street',
				// 				'msg'=>"Business Street Can not be empty",
				// 				'status'=>1
				// 			));
			}


			// if($busi_postal_code !='')
			// {
			// 	if(strlen($busi_postal_code) == 4)
			// 	{
			// 		 $busi_postal_code;
			// 	}else{
			// 		 $busi_postal_code =  $busi_postal_code.str_repeat(" ", 4 - strlen($busi_postal_code));
			// 	}

			// }else{
			// 	$busi_postal_code = str_repeat(" ", 4);
			// }


			







			if($id_nr !='')
			{
				if(strlen($id_nr) <= 20)
				{
					 	
						if($id_type !='')
						{
							if(strlen($id_type) == 1)
							{
								 
							}else{
								array_push($error,array(
											'field'=>'id_type',
											'msg'=>"Invalid ID Type Length",
											'status'=>1
										));
							}

						}else{
							array_push($error,array(
											'field'=>'id_type',
											'msg'=>" ID Type Can not be empty",
											'status'=>1
										));
						}

						if($id_issue_dt !='')
						{
							 $id_issue_array = date('d-m-Y', strtotime($id_issue_dt));
							 $issue_dt = explode("-",  $id_issue_array);
							 $id_issue_dt =  $issue_dt[0].$issue_dt[1].$issue_dt[2];

							if(strlen($id_issue_dt) == 8)
							{
								 
							}else{
								 array_push($error,array(
											'field'=>'id_issue_dt',
											'msg'=>"Invalid ID Issue Date Length",
											'status'=>1
										));
							}

						}else{
							array_push($error,array(
											'field'=>'id_issue_dt',
											'msg'=>" ID Issue Date Can not be empty",
											'status'=>1
										));
						}

						
						

						if($id_issue_cntry_code !='')
						{
							if(strlen($id_issue_cntry_code) == 2)
							{
								 
							}else{
								 array_push($error,array(
											'field'=>'id_issue_cntry_code',
											'msg'=>"Invalid ID Issue Country Code Length",
											'status'=>1
										));
							}

						}else{
							array_push($error,array(
											'field'=>'id_issue_cntry_code',
											'msg'=>"ID Issue Country Code Can not be empty",
											'status'=>1
										));
						}

				}else{
					array_push($error,array(
								'field'=>'id_nr',
								'msg'=>"Invalid ID No Length",
								'status'=>1
							));
				}

			}else{
				// array_push($error,array(
				// 				'field'=>'id_nr',
				// 				'msg'=>"ID No Can not be empty",
				// 				'status'=>1
				// 			));
			}






			// if($phone_number !='')
			// {
			// 	if(strlen($phone_number) == 20)
			// 	{
			// 		 $phone_number;
			// 	}else{
			// 		 $phone_number =  $phone_number.str_repeat(" ", 20 - strlen($phone_number));
			// 	}

			// }else{
			// 	$phone_number = str_repeat(" ", 20);
			// }



			// if($full_nid_number !='')
			// {
				
			// 	if(strlen($full_nid_number) == 17)
			// 	{
			// 		 $full_nid_number;
			// 	}
			// 	else if(strlen($full_nid_number) > 17)
			// 	{
			// 		$full_nid_number = substr($full_nid_number, strlen($full_nid_number) - 17);
			// 	}
			// 	else{
			// 		 $full_nid_number =  $full_nid_number.str_repeat(" ", 17 - strlen($full_nid_number));
			// 	}

			// }else{
			// 	 $full_nid_number = str_repeat(" ", 17);
			// }
		}
		else//no data foudn
		{
			array_push($error,array(
								'field'=>1,
								'msg'=>"Entry Not Found in Database",
								'status'=>0
							));
			
		}
		if(!empty($error))
		$errorArray[$id]=$error;
	}
	if(!empty($errorArray))
		return $errorArray;
	else
		return 0;
}
/*print "<pre>";
$reportingDate='';
print_r(errorCheckSubject(NULL,'2021-03-31'));*/

?>