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
			$production_date = $d['production_date'];
			$code_link = $d['code_link'];
			$branch_code = $d['branch_code'];
			$fi_subject_code = $d['fi_subject_code'];
			$title = $d['title'];
			$name = $d['name'];
			$fathers_title = $d['fathers_title'];
			$fathers_name = $d['fathers_name'];
			$mothers_title = $d['mothers_title'];
			$mothers_name = $d['mothers_name'];
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
			$parmanent_street = $d['parmanent_street'];
			$parmanent_postal_code = $d['parmanent_postal_code'];
			$parmanent_district = $d['parmanent_district'];
			$parmanent_country_code = $d['parmanent_country_code'];
			$additional_street = $d['additional_street'];
			$additional_postal_code = $d['additional_postal_code'];
			$additional_district = $d['additional_district'];
			$additional_country_code = $d['additional_country_code'];
			$business_address = $d['business_address'];
			$business_postal_code = $d['business_postal_code'];
			$business_district = $d['business_district'];
			$business_country_code = $d['business_country_code'];
			$id_type = $d['id_type'];
			$id_nr = $d['id_nr'];
			$id_issue_date = $d['id_issue_date'];
			$id_issue_country_code = $d['id_issue_country_code'];
			$phone_number = $d['phone_number'];
			$full_nid_number = $d['full_nid_number'];
			$id=$d['id'];
			$error=array();



			/*record type*/
			if($record_type !='')
			{
				if(strlen($record_type) == 1)
				{
					if(trim($record_type) == 'P')
					{

					}else{

						array_push($error,array(
								'field'=>'record_type',
								'msg'=>"Record Type Must be Personal",
								'status'=>1
							));
					}
					 
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
			/*record type*/

			/*Branch code*/
			if($branch_code !='')
			{
				if(strlen($branch_code) == 4)
				{
					if (!preg_match ("/^[0-9]*$/", $branch_code) ){  

					    array_push($error,array(
								'field'=>'branch_code',
								'msg'=>"Only number allowed",
								'status'=>1
							));  
					    
					}
					 
				}else{
					array_push($error,array(
								'field'=>'record_type',
								'msg'=>"invalid Branch Code  Length",
								'status'=>1
							));
					 
				}

			}
			/*Branch code*/
			

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
								'msg'=> getErrorDetails(402),
								'status'=>1
							));
			}

			if($title !='')
			{
				if(strlen($title) <= 20)
				{
					if($name == 'N/A')
					{

						array_push($error,array(
								'field'=>'title',
								'msg'=> getErrorDetails(425),
								'status'=>1
							));

					}
					
				}else{
					 array_push($error,array(
								'field'=>'title',
								'msg'=>getErrorDetails(427),
								'status'=>1
							));
				}

			}

			if($name !='')
			{
				if(strlen($name) <= 70)
				{
					if($name == 'N/A')
					{

						array_push($error,array(
								'field'=>'name',
								'msg'=> getErrorDetails(425),
								'status'=>1
							));

					}
					  
				}else{
					  array_push($error,array(
								'field'=>'name',
								'msg'=> getErrorDetails(427),
								'status'=>1
							));
				}

			}else{
				array_push($error,array(
								'field'=>'name',
								'msg'=> getErrorDetails(403),
								'status'=>1
							));
			}

			if($fathers_title !='')
			{
				if(strlen($fathers_title) == 20)
				{
					if($name == 'N/A')
					{

						array_push($error,array(
								'field'=>'fathers_title',
								'msg'=> getErrorDetails(425),
								'status'=>1
							));

					}
					
				}else{
					 array_push($error,array(
								'field'=>'fathers_title',
								'msg'=>getErrorDetails(427),
								'status'=>1
							));
				}

			}

			if($fathers_name !='')
			{
				if(strlen($fathers_name) <= 70)
				{
					if($name == 'N/A')
					{

						array_push($error,array(
								'field'=>'fathers_name',
								'msg'=> getErrorDetails(425),
								'status'=>1
							));

					}
					
				}else{
					  array_push($error,array(
								'field'=>'fathers_name',
								'msg'=>etErrorDetails(427),
								'status'=>1
							));
				}

			}else{
				array_push($error,array(
								'field'=>'fathers_name',
								'msg'=>getErrorDetails(404),
								'status'=>1
							));
			}

			if($mothers_title !='')
			{
				if(strlen($mothers_title) <= 20)
				{
					if($name == 'N/A')
					{

						array_push($error,array(
								'field'=>'mothers_title',
								'msg'=> getErrorDetails(425),
								'status'=>1
							));

					}
					
				}else{
					 array_push($error,array(
								'field'=>'mothers_title',
								'msg'=>getErrorDetails(427),
								'status'=>1
							));
				}

			}


			if($mothers_name !='')
			{
				if(strlen($mothers_name) <= 70)
				{
					if($name == 'N/A')
					{

						array_push($error,array(
								'field'=>'mothers_name',
								'msg'=> getErrorDetails(425),
								'status'=>1
							));

					}
					 
				}else{
					  array_push($error,array(
								'field'=>'mothers_name',
								'msg'=>getErrorDetails(427),
								'status'=>1
							));
				}

			}else{
				array_push($error,array(
								'field'=>'mothers_name',
								'msg'=>getErrorDetails(405),
								'status'=>1
							));
			}


			if($spouse_title !='')
			{
				if(strlen($spouse_title) <= 20)
				{

					if($name == 'N/A')
					{

						array_push($error,array(
								'field'=>'spouse_title',
								'msg'=> getErrorDetails(425),
								'status'=>1
							));

					}
					 
				}else{
					 array_push($error,array(
								'field'=>'spouse_title',
								'msg'=>getErrorDetails(427),
								'status'=>1
							));
				}

			}


			if($spouse !='')
			{
				if(strlen($spouse) <= 70)
				{

					if($name == 'N/A')
					{

						array_push($error,array(
								'field'=>'spouse',
								'msg'=> getErrorDetails(425),
								'status'=>1
							));

					}
					
				}else{
					  array_push($error,array(
								'field'=>'spouse',
								'msg'=>getErrorDetails(427),
								'status'=>1
							));
				}

			}


			if($sector_type !='')
			{
				if(strlen($sector_type) == 1)
				{

					if (!preg_match ("/^[0-9]*$/", $sector_type) ){  

					    array_push($error,array(
								'field'=>'sector_type',
								'msg'=>getErrorDetails(430),
								'status'=>1
							));  
					    
					}else{

						if( !($sector_type ==1 || $sector_type==9) ) 
						{

							array_push($error,array(
								'field'=>'sector_type',
								'msg'=>getErrorDetails(500),
								'status'=>1
							));

						}

					}
					 
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
								'msg'=>getErrorDetails(1004),
								'status'=>1
							));
			}



			if($sector_type !='')
			{


				if($sector_code !='')
				{
					if(strlen($sector_code) <= 6)
					{
						 if (!preg_match ("/^[0-9]*$/", $sector_code) ){  

						    array_push($error,array(
									'field'=>'sector_code',
									'msg'=>getErrorDetails(431),
									'status'=>1
								));  
						    
						}

					}

				}else{
					array_push($error,array(
								'field'=>'sector_code',
								'msg'=>getErrorDetails(1004),
								'status'=>1
							));
				}

			}
			




			if($gender !='')
			{
				if(strlen($gender) == 1)
				{

					if( !($gender == 'M' || $gender== 'F') ) 
						{

							array_push($error,array(
								'field'=>'gender',
								'msg'=>getErrorDetails(503),
								'status'=>1
							));

						}
					 
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



			if($dath_of_brth !='')
			{

				 //$brth_array = date('d-m-Y', strtotime($dath_of_brth));
				 $birth_dt = explode("/",  $dath_of_brth);
				 $dath_of_brth =  $birth_dt[0].$birth_dt[1].$birth_dt[2];

				if(strlen($dath_of_brth) == 8)
				{
					
				}else{

					 array_push($error,array(
								'field'=>'dath_of_brth',
								'msg'=>getErrorDetails(460),
								'status'=>1
							));
				}

			}else{
				array_push($error,array(
								'field'=>'dath_of_brth',
								'msg'=>getErrorDetails(459),
								'status'=>1
							));
			}



			if($country_of_birth !='')
			{
				if(strlen($country_of_birth) == 2)
				{
						if($country_of_birth !='BD')
						{

							array_push($error,array(
								'field'=>'country_of_birth',
								'msg'=>getErrorDetails(504),
								'status'=>1
							));
							
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
								'msg'=>getErrorDetails(406),
								'status'=>1
							));
			}



			/*if($place_of_birth !='')
			{
				if(strlen($place_of_birth) <= 20)
				{
					 
				}else{
					array_push($error,array(
						'field'=>'place_of_birth',
						'msg'=>"Invalid Place of Birth Length",
						'status'=>1
					));
				}

			}else{
				array_push($error,array(
					'field'=>'place_of_birth',
					'msg'=>"Place of Birth Can not be empty",
					'status'=>1
				));
			} */

			



			


			/*if($nid_number !='')
			{
				

				if(strlen($nid_number) = 13)
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

			}*/


			//====================================check=============================
			if($is_nid !='')
			{
				if(strlen($is_nid) == 1)
				{
						//Is nid number check
						if (!preg_match ("/^[0-9]*$/", $is_nid) ){  

						    array_push($error,array(
									'field'=>'nid_number',
									'msg'=>getErrorDetails(433),
									'status'=>1
								));  
						    
						}else{

							// 0 1 check

							if( !($is_nid == '0' || $is_nid== '1') ) 
							{

								array_push($error,array(
									'field'=>'nid_number',
									'msg'=>getErrorDetails(505),
									'status'=>1
								));

							}

						}


						

					 	if($nid_number !='')
						{
							if(strlen($nid_number) <= 17)
							{

								if (!preg_match ("/^[0-9]*$/", $nid_number) ){  

								    array_push($error,array(
											'field'=>'nid_number',
											'msg'=>getErrorDetails(432),
											'status'=>1
										));  
								    
								}

								 
							}else{
								 array_push($error,array(
											'field'=>'nid_number',
											'msg'=>"Invalid NID Number Length",
											'status'=>1
										));
							}

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
								'msg'=>getErrorDetails(433),
								'status'=>1
							));
			}

			

//====================================check=============================
			


			if($tin_number !='')
			{
				
				if(strlen($tin_number) == 12)
				{
					 
				}else{

					array_push($error,array(
						'field'=>'tin_number',
						'msg'=>"Invalid  tin Number",
						'status'=>1
					));

				}
				

			}

			if($parmanent_street !='')
			{
				if(strlen($parmanent_street) <= 100)
				{
					
				}else{
					array_push($error,array(
								'field'=>'parmanent_street',
								'msg'=>"Invalid Parmanet Street Length",
								'status'=>1
							));
				}

			}else{

				array_push($error,array(
								'field'=>'parmanent_street',
								'msg'=>getErrorDetails(407),
								'status'=>1
							));
			}



			if($parmanent_postal_code !='')
			{
				if(strlen($parmanent_postal_code) == 4)
				{
					 
				}else{
					 array_push($error,array(
								'field'=>'parmanent_postal_code',
								'msg'=>'Parmanent Postal code invalid Length',
								'status'=>1
							));
				}

			}


			if($parmanent_district !='')
			{
				if(strlen($parmanent_district) <= 20)
				{
					
				}else{
					array_push($error,array(
								'field'=>'parmanent_district',
								'msg'=>"Invalid Parmanet District Length",
								'status'=>1
							));
				}

			}else{
				array_push($error,array(
								'field'=>'parmanent_district',
								'msg'=>getErrorDetails(408),
								'status'=>1
							));
			}


			if($parmanent_country_code !='')
			{
				if(strlen($parmanent_country_code) == 2)
				{
					if($parmanent_country_code !='BD')
					{

						array_push($error,array(
								'field'=>'parmanent_country_code',
								'msg'=>"Parmanent County code not valid",
								'status'=>1
							));

					}
					 
				}else{
					 array_push($error,array(
								'field'=>'parmanent_country_code',
								'msg'=>"Invalid Parmanet Country Code Length",
								'status'=>1
							));
				}

			}else{
				array_push($error,array(
								'field'=>'parmanent_country_code',
								'msg'=>"Parmanet Country Code Can not be empty",
								'status'=>1
							));
			}



			// if($additional_street !='')
			// {
			// 	if(strlen($additional_street) == 100)
			// 	{
			// 		 $additional_street;
			// 	}else{
			// 		 $additional_street =  $additional_street.str_repeat(" ", 100 - strlen($additional_street));
			// 	}

			// }else{
			// 	$additional_street = str_repeat(" ", 100);
			// }


			// if($additional_postal_code !='')
			// {
			// 	if(strlen($additional_postal_code) == 4)
			// 	{
			// 		 $additional_postal_code;
			// 	}else{
			// 		 $additional_postal_code =  $additional_postal_code.str_repeat(" ", 4 - strlen($additional_postal_code));
			// 	}

			// }else{
			// 	$additional_postal_code = str_repeat(" ", 4);
			// }


			// if($additional_district !='')
			// {
			// 	if(strlen($additional_district) == 20)
			// 	{
			// 		 $additional_district;
			// 	}else{
			// 		 $additional_district =  $additional_district.str_repeat(" ", 20 - strlen($additional_district));
			// 	}

			// }else{
			// 	$additional_district = str_repeat(" ", 20);
			// }


			// if($additional_country_code !='')
			// {
			// 	if(strlen($additional_country_code) == 2)
			// 	{
			// 		 $additional_country_code;
			// 	}else{
			// 		 $additional_country_code =  $additional_country_code.str_repeat(" ", 2 - strlen($additional_country_code));
			// 	}

			// }else{
			// 	$additional_country_code = str_repeat(" ", 2);
			// }

			//new

			if($business_address !='')
			{
				if(strlen($business_address) <= 100)
				{
							if($business_district !='')
							{
								if(strlen($business_district) <= 20)
								{
									
								}else{
									  array_push($error,array(
												'field'=>'business_district',
												'msg'=>"Invalid Business District Length",
												'status'=>1
											));
								}

							}else{
								array_push($error,array(
												'field'=>'business_district',
												'msg'=>"Business District Can not be empty",
												'status'=>1
											));
							}


							if($business_country_code !='')
							{
								if(strlen($business_country_code) == 2)
								{
									 
								}else{
									array_push($error,array(
												'field'=>'business_country_code',
												'msg'=>"Invalid Business Country Code Length",
												'status'=>1
											));
								}

							}else{
								array_push($error,array(
												'field'=>'business_country_code',
												'msg'=>"Business Country Code Can not be Empty",
												'status'=>1
											));
							}
				}else{
					 // array_push($error,array(
						// 		'field'=>'business_address',
						// 		'msg'=>"Invalid Business Street Length",
						// 		'status'=>1
						// 	));
				}

			}else{
				// array_push($error,array(
				// 				'field'=>'business_address',
				// 				'msg'=>"Business Street Can not be empty",
				// 				'status'=>1
				// 			));
			}


			// if($business_postal_code !='')
			// {
			// 	if(strlen($business_postal_code) == 4)
			// 	{
			// 		 $business_postal_code;
			// 	}else{
			// 		 $business_postal_code =  $business_postal_code.str_repeat(" ", 4 - strlen($business_postal_code));
			// 	}

			// }else{
			// 	$business_postal_code = str_repeat(" ", 4);
			// }


			







			if($id_nr !='')
			{
				if(strlen($id_nr) <= 20)
				{
					 	
						if($id_type !='')
						{
							if(strlen($id_type) == 1)
							{

								if( !($id_type == '1' || $id_type== '2' || $id_type== '3') ) 
								{

									array_push($error,array(
										'field'=>'id_type',
										'msg'=>getErrorDetails(509),
										'status'=>1
									));

								}
								 
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

						if($id_issue_date !='')
						{
							 $id_issue_array = date('d-m-Y', strtotime($id_issue_date));
							 $issue_dt = explode("-",  $id_issue_array);
							 $id_issue_date =  $issue_dt[0].$issue_dt[1].$issue_dt[2];

							if(strlen($id_issue_date) == 8)
							{
								 
							}else{
								 array_push($error,array(
											'field'=>'id_issue_date',
											'msg'=>getErrorDetails(461),
											'status'=>1
										));
							}

						}else{
							array_push($error,array(
											'field'=>'id_issue_date',
											'msg'=>" ID Issue Date Can not be empty",
											'status'=>1
										));
						}

						
						

						if($id_issue_country_code !='')
						{
							if(strlen($id_issue_country_code) == 2)
							{
								 
							}else{
								 array_push($error,array(
											'field'=>'id_issue_country_code',
											'msg'=>"Invalid ID Issue Country Code Length",
											'status'=>1
										));
							}

						}else{
							array_push($error,array(
											'field'=>'id_issue_country_code',
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


			if($id_issue_date !='')
			{
				 $id_issue_array = date('d-m-Y', strtotime($id_issue_date));
				 $issue_dt = explode("-",  $id_issue_array);
				 $id_issue_date =  $issue_dt[0].$issue_dt[1].$issue_dt[2];

				if(strlen($id_issue_date) == 8)
				{
					 
				}else{
					 array_push($error,array(
								'field'=>'id_issue_date',
								'msg'=>getErrorDetails(461),
								'status'=>1
							));
				}

			}else{
				/*array_push($error,array(
								'field'=>'id_issue_date',
								'msg'=>" ID Issue Date Can not be empty",
								'status'=>1
							));*/
			}

			if($id_issue_country_code !='')
			{
				if(strlen($id_issue_country_code) == 2)
				{
					 
				}else{
					 array_push($error,array(
								'field'=>'id_issue_country_code',
								'msg'=>"Invalid ID Issue Country Code Length",
								'status'=>1
							));
				}

			}






			if($phone_number !='')
			{
				if(strlen($phone_number) <= 40)
				{
					 
				}else{

					array_push($error,array(
							'field'=>'phone_number',
							'msg'=>"Invalid phone number Length",
							'status'=>1
						));
				 
				}

			}

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
			$production_date = $d['production_date'];
			$code_link = $d['code_link'];
			$branch_code = $d['branch_code'];
			$fi_subject_code = $d['fi_subject_code'];
			$title = $d['title'];
			$name = $d['name'];
			$fathers_title = $d['fathers_title'];
			$fathers_name = $d['fathers_name'];
			$mothers_title = $d['mothers_title'];
			$mothers_name = $d['mothers_name'];
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
			$parmanent_street = $d['parmanent_street'];
			$parmanent_postal_code = $d['parmanent_postal_code'];
			$parmanent_district = $d['parmanent_district'];
			$parmanent_country_code = $d['parmanent_country_code'];
			$additional_street = $d['additional_street'];
			$additional_postal_code = $d['additional_postal_code'];
			$additional_district = $d['additional_district'];
			$additional_country_code = $d['additional_country_code'];
			$business_address = $d['business_address'];
			$business_postal_code = $d['business_postal_code'];
			$business_district = $d['business_district'];
			$business_country_code = $d['business_country_code'];
			$id_type = $d['id_type'];
			$id_nr = $d['id_nr'];
			$id_issue_date = $d['id_issue_date'];
			$id_issue_country_code = $d['id_issue_country_code'];
			$phone_number = $d['phone_number'];
			$full_nid_number = $d['full_nid_number'];



			/*record type*/
			if($record_type !='')
			{
				if(strlen($record_type) == 1)
				{
					if(trim($record_type) == 'P')
					{

					}else{

						array_push($error,array(
								'field'=>'record_type',
								'msg'=>"Record Type Must be Personal",
								'status'=>1
							));
					}
					 
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
			/*record type*/

			/*Branch code*/
			if($branch_code !='')
			{
				if(strlen($branch_code) == 4)
				{
					if (!preg_match ("/^[0-9]*$/", $branch_code) ){  

					    array_push($error,array(
								'field'=>'branch_code',
								'msg'=>"Only number allowed",
								'status'=>1
							));  
					    
					}
					 
				}else{
					array_push($error,array(
								'field'=>'record_type',
								'msg'=>"invalid Branch Code  Length",
								'status'=>1
							));
					 
				}

			}
			/*Branch code*/
			

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
								'msg'=> getErrorDetails(402),
								'status'=>1
							));
			}

			if($title !='')
			{
				if(strlen($title) <= 20)
				{
					if($name == 'N/A')
					{

						array_push($error,array(
								'field'=>'title',
								'msg'=> getErrorDetails(425),
								'status'=>1
							));

					}
					
				}else{
					 array_push($error,array(
								'field'=>'title',
								'msg'=>getErrorDetails(427),
								'status'=>1
							));
				}

			}

			if($name !='')
			{
				if(strlen($name) <= 70)
				{
					if($name == 'N/A')
					{

						array_push($error,array(
								'field'=>'name',
								'msg'=> getErrorDetails(425),
								'status'=>1
							));

					}
					  
				}else{
					  array_push($error,array(
								'field'=>'name',
								'msg'=> getErrorDetails(427),
								'status'=>1
							));
				}

			}else{
				array_push($error,array(
								'field'=>'name',
								'msg'=> getErrorDetails(403),
								'status'=>1
							));
			}

			if($fathers_title !='')
			{
				if(strlen($fathers_title) == 20)
				{
					if($name == 'N/A')
					{

						array_push($error,array(
								'field'=>'fathers_title',
								'msg'=> getErrorDetails(425),
								'status'=>1
							));

					}
					
				}else{
					 array_push($error,array(
								'field'=>'fathers_title',
								'msg'=>getErrorDetails(427),
								'status'=>1
							));
				}

			}

			if($fathers_name !='')
			{
				if(strlen($fathers_name) <= 70)
				{
					if($name == 'N/A')
					{

						array_push($error,array(
								'field'=>'fathers_name',
								'msg'=> getErrorDetails(425),
								'status'=>1
							));

					}
					
				}else{
					  array_push($error,array(
								'field'=>'fathers_name',
								'msg'=>etErrorDetails(427),
								'status'=>1
							));
				}

			}else{
				array_push($error,array(
								'field'=>'fathers_name',
								'msg'=>getErrorDetails(404),
								'status'=>1
							));
			}

			if($mothers_title !='')
			{
				if(strlen($mothers_title) <= 20)
				{
					if($name == 'N/A')
					{

						array_push($error,array(
								'field'=>'mothers_title',
								'msg'=> getErrorDetails(425),
								'status'=>1
							));

					}
					
				}else{
					 array_push($error,array(
								'field'=>'mothers_title',
								'msg'=>getErrorDetails(427),
								'status'=>1
							));
				}

			}


			if($mothers_name !='')
			{
				if(strlen($mothers_name) <= 70)
				{
					if($name == 'N/A')
					{

						array_push($error,array(
								'field'=>'mothers_name',
								'msg'=> getErrorDetails(425),
								'status'=>1
							));

					}
					 
				}else{
					  array_push($error,array(
								'field'=>'mothers_name',
								'msg'=>getErrorDetails(427),
								'status'=>1
							));
				}

			}else{
				array_push($error,array(
								'field'=>'mothers_name',
								'msg'=>getErrorDetails(405),
								'status'=>1
							));
			}


			if($spouse_title !='')
			{
				if(strlen($spouse_title) <= 20)
				{

					if($name == 'N/A')
					{

						array_push($error,array(
								'field'=>'spouse_title',
								'msg'=> getErrorDetails(425),
								'status'=>1
							));

					}
					 
				}else{
					 array_push($error,array(
								'field'=>'spouse_title',
								'msg'=>getErrorDetails(427),
								'status'=>1
							));
				}

			}


			if($spouse !='')
			{
				if(strlen($spouse) <= 70)
				{

					if($name == 'N/A')
					{

						array_push($error,array(
								'field'=>'spouse',
								'msg'=> getErrorDetails(425),
								'status'=>1
							));

					}
					
				}else{
					  array_push($error,array(
								'field'=>'spouse',
								'msg'=>getErrorDetails(427),
								'status'=>1
							));
				}

			}


			if($sector_type !='')
			{
				if(strlen($sector_type) == 1)
				{

					if (!preg_match ("/^[0-9]*$/", $sector_type) ){  

					    array_push($error,array(
								'field'=>'sector_type',
								'msg'=>getErrorDetails(430),
								'status'=>1
							));  
					    
					}else{

						if( !($sector_type ==1 || $sector_type==9) ) 
						{

							array_push($error,array(
								'field'=>'sector_type',
								'msg'=>getErrorDetails(500),
								'status'=>1
							));

						}

					}
					 
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
								'msg'=>getErrorDetails(1004),
								'status'=>1
							));
			}



			if($sector_type !='')
			{


				if($sector_code !='')
				{
					if(strlen($sector_code) <= 6)
					{
						 if (!preg_match ("/^[0-9]*$/", $sector_code) ){  

						    array_push($error,array(
									'field'=>'sector_code',
									'msg'=>getErrorDetails(431),
									'status'=>1
								));  
						    
						}

					}

				}else{
					array_push($error,array(
								'field'=>'sector_code',
								'msg'=>getErrorDetails(1004),
								'status'=>1
							));
				}

			}
			




			if($gender !='')
			{
				if(strlen($gender) == 1)
				{

					if( !($gender == 'M' || $gender== 'F') ) 
						{

							array_push($error,array(
								'field'=>'gender',
								'msg'=>getErrorDetails(503),
								'status'=>1
							));

						}
					 
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



			if($dath_of_brth !='')
			{

				 //$brth_array = date('d-m-Y', strtotime($dath_of_brth));
				 $birth_dt = explode("/",  $dath_of_brth);
				 $dath_of_brth =  $birth_dt[0].$birth_dt[1].$birth_dt[2];

				if(strlen($dath_of_brth) == 8)
				{
					
				}else{

					 array_push($error,array(
								'field'=>'dath_of_brth',
								'msg'=>getErrorDetails(460),
								'status'=>1
							));
				}

			}else{
				array_push($error,array(
								'field'=>'dath_of_brth',
								'msg'=>getErrorDetails(459),
								'status'=>1
							));
			}



			if($country_of_birth !='')
			{
				if(strlen($country_of_birth) == 2)
				{
						if($country_of_birth !='BD')
						{

							array_push($error,array(
								'field'=>'country_of_birth',
								'msg'=>getErrorDetails(504),
								'status'=>1
							));
							
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
								'msg'=>getErrorDetails(406),
								'status'=>1
							));
			}



			/*if($place_of_birth !='')
			{
				if(strlen($place_of_birth) <= 20)
				{
					 
				}else{
					array_push($error,array(
						'field'=>'place_of_birth',
						'msg'=>"Invalid Place of Birth Length",
						'status'=>1
					));
				}

			}else{
				array_push($error,array(
					'field'=>'place_of_birth',
					'msg'=>"Place of Birth Can not be empty",
					'status'=>1
				));
			} */

			



			


			/*if($nid_number !='')
			{
				

				if(strlen($nid_number) = 13)
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

			}*/


			//====================================check=============================
			if($is_nid !='')
			{
				if(strlen($is_nid) == 1)
				{
						//Is nid number check
						if (!preg_match ("/^[0-9]*$/", $is_nid) ){  

						    array_push($error,array(
									'field'=>'nid_number',
									'msg'=>getErrorDetails(433),
									'status'=>1
								));  
						    
						}else{

							// 0 1 check

							if( !($is_nid == '0' || $is_nid== '1') ) 
							{

								array_push($error,array(
									'field'=>'nid_number',
									'msg'=>getErrorDetails(505),
									'status'=>1
								));

							}

						}


						

					 	if($nid_number !='')
						{
							if(strlen($nid_number) <= 17)
							{

								if (!preg_match ("/^[0-9]*$/", $nid_number) ){  

								    array_push($error,array(
											'field'=>'nid_number',
											'msg'=>getErrorDetails(432),
											'status'=>1
										));  
								    
								}

								 
							}else{
								 array_push($error,array(
											'field'=>'nid_number',
											'msg'=>"Invalid NID Number Length",
											'status'=>1
										));
							}

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
								'msg'=>getErrorDetails(433),
								'status'=>1
							));
			}

			

//====================================check=============================
			


			if($tin_number !='')
			{
				
				if(strlen($tin_number) == 12)
				{
					 
				}else{

					array_push($error,array(
						'field'=>'tin_number',
						'msg'=>"Invalid  tin Number",
						'status'=>1
					));

				}
				

			}

			if($parmanent_street !='')
			{
				if(strlen($parmanent_street) <= 100)
				{
					
				}else{
					array_push($error,array(
								'field'=>'parmanent_street',
								'msg'=>"Invalid Parmanet Street Length",
								'status'=>1
							));
				}

			}else{

				array_push($error,array(
								'field'=>'parmanent_street',
								'msg'=>getErrorDetails(407),
								'status'=>1
							));
			}



			if($parmanent_postal_code !='')
			{
				if(strlen($parmanent_postal_code) == 4)
				{
					 
				}else{
					 array_push($error,array(
								'field'=>'parmanent_postal_code',
								'msg'=>'Parmanent Postal code invalid Length',
								'status'=>1
							));
				}

			}


			if($parmanent_district !='')
			{
				if(strlen($parmanent_district) <= 20)
				{
					
				}else{
					array_push($error,array(
								'field'=>'parmanent_district',
								'msg'=>"Invalid Parmanet District Length",
								'status'=>1
							));
				}

			}else{
				array_push($error,array(
								'field'=>'parmanent_district',
								'msg'=>getErrorDetails(408),
								'status'=>1
							));
			}


			if($parmanent_country_code !='')
			{
				if(strlen($parmanent_country_code) == 2)
				{
					if($parmanent_country_code !='BD')
					{

						array_push($error,array(
								'field'=>'parmanent_country_code',
								'msg'=>"Parmanent County code not valid",
								'status'=>1
							));

					}
					 
				}else{
					 array_push($error,array(
								'field'=>'parmanent_country_code',
								'msg'=>"Invalid Parmanet Country Code Length",
								'status'=>1
							));
				}

			}else{
				array_push($error,array(
								'field'=>'parmanent_country_code',
								'msg'=>"Parmanet Country Code Can not be empty",
								'status'=>1
							));
			}



			// if($additional_street !='')
			// {
			// 	if(strlen($additional_street) == 100)
			// 	{
			// 		 $additional_street;
			// 	}else{
			// 		 $additional_street =  $additional_street.str_repeat(" ", 100 - strlen($additional_street));
			// 	}

			// }else{
			// 	$additional_street = str_repeat(" ", 100);
			// }


			// if($additional_postal_code !='')
			// {
			// 	if(strlen($additional_postal_code) == 4)
			// 	{
			// 		 $additional_postal_code;
			// 	}else{
			// 		 $additional_postal_code =  $additional_postal_code.str_repeat(" ", 4 - strlen($additional_postal_code));
			// 	}

			// }else{
			// 	$additional_postal_code = str_repeat(" ", 4);
			// }


			// if($additional_district !='')
			// {
			// 	if(strlen($additional_district) == 20)
			// 	{
			// 		 $additional_district;
			// 	}else{
			// 		 $additional_district =  $additional_district.str_repeat(" ", 20 - strlen($additional_district));
			// 	}

			// }else{
			// 	$additional_district = str_repeat(" ", 20);
			// }


			// if($additional_country_code !='')
			// {
			// 	if(strlen($additional_country_code) == 2)
			// 	{
			// 		 $additional_country_code;
			// 	}else{
			// 		 $additional_country_code =  $additional_country_code.str_repeat(" ", 2 - strlen($additional_country_code));
			// 	}

			// }else{
			// 	$additional_country_code = str_repeat(" ", 2);
			// }

			//new

			if($business_address !='')
			{
				if(strlen($business_address) <= 100)
				{
							if($business_district !='')
							{
								if(strlen($business_district) <= 20)
								{
									
								}else{
									  array_push($error,array(
												'field'=>'business_district',
												'msg'=>"Invalid Business District Length",
												'status'=>1
											));
								}

							}else{
								array_push($error,array(
												'field'=>'business_district',
												'msg'=>"Business District Can not be empty",
												'status'=>1
											));
							}


							if($business_country_code !='')
							{
								if(strlen($business_country_code) == 2)
								{
									 
								}else{
									array_push($error,array(
												'field'=>'business_country_code',
												'msg'=>"Invalid Business Country Code Length",
												'status'=>1
											));
								}

							}else{
								array_push($error,array(
												'field'=>'business_country_code',
												'msg'=>"Business Country Code Can not be Empty",
												'status'=>1
											));
							}
				}else{
					 // array_push($error,array(
						// 		'field'=>'business_address',
						// 		'msg'=>"Invalid Business Street Length",
						// 		'status'=>1
						// 	));
				}

			}else{
				// array_push($error,array(
				// 				'field'=>'business_address',
				// 				'msg'=>"Business Street Can not be empty",
				// 				'status'=>1
				// 			));
			}


			// if($business_postal_code !='')
			// {
			// 	if(strlen($business_postal_code) == 4)
			// 	{
			// 		 $business_postal_code;
			// 	}else{
			// 		 $business_postal_code =  $business_postal_code.str_repeat(" ", 4 - strlen($business_postal_code));
			// 	}

			// }else{
			// 	$business_postal_code = str_repeat(" ", 4);
			// }


			







			if($id_nr !='')
			{
				if(strlen($id_nr) <= 20)
				{
					 	
						if($id_type !='')
						{
							if(strlen($id_type) == 1)
							{

								if( !($id_type == '1' || $id_type== '2' || $id_type== '3') ) 
								{

									array_push($error,array(
										'field'=>'id_type',
										'msg'=>getErrorDetails(509),
										'status'=>1
									));

								}
								 
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

						if($id_issue_date !='')
						{
							 $id_issue_array = date('d-m-Y', strtotime($id_issue_date));
							 $issue_dt = explode("-",  $id_issue_array);
							 $id_issue_date =  $issue_dt[0].$issue_dt[1].$issue_dt[2];

							if(strlen($id_issue_date) == 8)
							{
								 
							}else{
								 array_push($error,array(
											'field'=>'id_issue_date',
											'msg'=>getErrorDetails(461),
											'status'=>1
										));
							}

						}else{
							array_push($error,array(
											'field'=>'id_issue_date',
											'msg'=>" ID Issue Date Can not be empty",
											'status'=>1
										));
						}

						
						

						if($id_issue_country_code !='')
						{
							if(strlen($id_issue_country_code) == 2)
							{
								 
							}else{
								 array_push($error,array(
											'field'=>'id_issue_country_code',
											'msg'=>"Invalid ID Issue Country Code Length",
											'status'=>1
										));
							}

						}else{
							array_push($error,array(
											'field'=>'id_issue_country_code',
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


			if($id_issue_date !='')
			{
				 $id_issue_array = date('d-m-Y', strtotime($id_issue_date));
				 $issue_dt = explode("-",  $id_issue_array);
				 $id_issue_date =  $issue_dt[0].$issue_dt[1].$issue_dt[2];

				if(strlen($id_issue_date) == 8)
				{
					 
				}else{
					 array_push($error,array(
								'field'=>'id_issue_date',
								'msg'=>getErrorDetails(461),
								'status'=>1
							));
				}

			}else{
				
			}

			if($id_issue_country_code !='')
			{
				if(strlen($id_issue_country_code) == 2)
				{
					 
				}else{
					 array_push($error,array(
								'field'=>'id_issue_country_code',
								'msg'=>"Invalid ID Issue Country Code Length",
								'status'=>1
							));
				}

			}






			if($phone_number !='')
			{
				if(strlen($phone_number) <= 40)
				{
					 
				}else{

					array_push($error,array(
							'field'=>'phone_number',
							'msg'=>"Invalid phone number Length",
							'status'=>1
						));
				 
				}

			}


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
 //print "<pre>";
// $reportingDate='';
 //$errorArray=errorCheckSubject(NULL,'2021-05-31');
//print_r($errorArray);

function processErrorArray($errorArray)
{
	$newArrayField=array();
	$newArray=array();
	foreach ($errorArray as $key => $value) {
			
			$id=$key;
			foreach ($value as $key1 => $errorId) {
					
				if(empty($newArray[$errorId['field']]))
				{
					$newArray[$errorId['field']]=array();
					array_push($newArray[$errorId['field']], $id);
				}
				else
				{
					array_push($newArray[$errorId['field']], $id);
				}
			}	
	}
	return $newArray;
}


function getErrorDetails($error_code)
{
	$query =mysql_query("SELECT error_description from cib_error where error_code= '$error_code' ");
	$error_details = mysql_fetch_array($query);
	return $error_details['error_description'];
}

//echo getErrorDetails(1000);


?>