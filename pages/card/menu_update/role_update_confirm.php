<?php 
	include("../../../database_2.php");
 ?>

 <?php 
	$role_id = $_POST['role_name'];
	$menus = $_POST['menu_name'];
    $success=0;
	$error=0;
	$user=$_SESSION['mt_valid_usr'];
	$_SESSION['mt_valid_usr'];




	   
		
			
				$role_check1=mysql_query("select sl from  role_table where sl='$role_id'");
				$d=mysql_fetch_array($role_check1);
				$role_sl=$d['sl'];
				foreach ($menus as $key => $value) {
					//print $value."<br>";
					$q=mysql_query("select * from menu_table where sl='$value'");
					$data=mysql_fetch_array($q);
					$status = $data['status'];
					$role=$data['role'];
					$role_array=explode(',', $role);
					$check=0;
					foreach($role_array as $i=>$role_s)
					{
						if($role_s==$role_sl)
							$check++;
					}
					if($check==0)
						$insert_role=$role.','.$role_sl;
					else
						$insert_role=$role;
					$parent_id=$data['parent'];// sub menu sl
					//print "<br>".$value;
					//print "<br>".$insert_role;

					
					$z=mysql_query("update menu_table set role='$insert_role' where sl='$value'"); // adding role sl to sub sub menu
					
					if($z)
					{
						//print $insert_role.'<br>';
						//print $data['menu_name']."<br>";
						$success++;
					}
					else
						$error++;
						//print "<br>Failed";
					$q_sub_menu=mysql_query("select * from menu_table where sl='$parent_id'");
					$data1=mysql_fetch_array($q_sub_menu);
					$role1=$data1['role'];
					$role_array1=explode(',', $role1);
					$check1=0;
					foreach($role_array1 as $i1=>$role_s1)
					{
						if($role_s1==$role_sl)
							$check1++;
					}
					if($check1==0)
						$insert_role1=$role1.','.$role_sl;
					else
						$insert_role1=$role1;
					$parent_id1=$data1['parent']; //menu sl
					//print "<br>".$insert_role1;
					$z1=mysql_query("update menu_table set role='$insert_role1' where sl='$parent_id'"); // adding role sl to  sub menu
					if($z1)
					{
						//print $insert_role1.'<br>';
						$success++;
						//print $data1['menu_name']."<br>";
					}
					else
						$error++;
						//print "<br>Failed";
					$menu=mysql_query("select * from menu_table where sl='$parent_id1'");
					$data11=mysql_fetch_array($menu);
					$role11=$data11['role'];
					$role_array11=explode(',', $role11);
					$check11=0;
					foreach($role_array11 as $i11=>$role_s11)
					{
						if($role_s11==$role_sl)
							$check11++;
					}
					if($check11==0)
						$insert_role11=$role11.','.$role_sl;
					else
						$insert_role11=$role11;
					$parent_id11=$data11['parent'];
					//print "<br>Menu:".$insert_role11;
					$z1=mysql_query("update menu_table set role='$insert_role11' where sl='$parent_id1'"); // adding role sl to sub sub menu
					if($z1)
					{
						$success++;
						//print $insert_role1.'<br>';
						//print $data1['menu_name']."<br>";
					}
					else
						$error++;
						//print "<br>Failed";

					if($parent_id11==0)
						{
							$xss="this is a test";
						}//print "This is the main menu<br>";
					else
						{
							$menu1=mysql_query("select * from menu_table where sl='$parent_id11'");
							$data111=mysql_fetch_array($menu1);
							$role111=$data111['role'];
							$role_array111=explode(',', $role111);
							$check111=0;
							foreach($role_array111 as $i111=>$role_s111)
							{
								if($role_s111==$role_sl)
									$check111++;
							}
							if($check111==0)
								$insert_role111=$role111.','.$role_sl;
							else
								$insert_role111=$role111;
							$parent_id111=$data111['parent'];
							//print "<br>".$insert_role111;
							$z11=mysql_query("update menu_table set role='$insert_role111' where sl='$parent_id11'"); // adding role sl to sub sub menu
							if($z11)
							{
								$success++;
								//print $insert_role111.'<br>';
								//print $data111['menu_name']."<br>";
							}
							else
								$error++;
								//print "<br>Failed";
						}
				}	
		
		if($success>0 and $error==0)
		{

			echo "<script>alert('Menu Update successfully')</script>";
			//echo "<script>window.location='../../../index.php#ajax/userSecurity/menuAdd.php'</script>";
		}






  ?>