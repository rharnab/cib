<?php
    include_once("pages/card/db/dbconnect.php");
    include_once("pages/card/functions/functions.php");
    include('pages/card/database.php');
    $select_role = $conn->prepare("SELECT * FROM role");
    $select_role->execute();
    $data = '';
    while($rowData = $select_role->fetch(PDO::FETCH_ASSOC)){
        $data.="
            <li>$rowData[role_name]</li>
        ";
    }
?>


<aside class="left-side sidebar-offcanvas">                
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <style>
            .dropdown-menu > li > a:hover {
                background: transparent;
                color: black
            }
        </style>
      
        
        <ul class="sidebar-menu">
       

            <li class="active">
                <a href="/cib/dashboard.php">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span> 
                </a>
            </li>
            <!-- Utility Setup -->
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-table"></i> <span>Parameter SETUP</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="/cib/pages/card/create_branch.php"><i class="fa fa-angle-double-right"></i>Create New Branch</a></li>
                    <li><a href="/cib/pages/card/all_br_view.php"><i class="fa fa-angle-double-right"></i>View All Branch</a></li>

                    <!-- ramjan utitlity set up -->
                    <!-- for contract phase -->
                     <li  class="active dropdown"><a class="dropdown-toggle" data-toggle="dropdown"  href="/cib/pages/card/peramiter/contract_phase/create_contract_phase.php"><i class="fa fa-angle-double-right"></i>Contract Phase <b class="caret pull-right" style="margin-top: 10px;  margin-right: 8px;"></b></a>
                        <ul class="dropdown-menu" style="background-color: gainsboro; width: 100%;">
                            <li class="dropdown dropdown-submenu">
                                <a href="/cib/pages/card/peramiter/contract_phase/create_contract_phase.php" class="dropdown-toggle">&nbsp;&nbsp;
                                     <i class="fa fa-circle-o" aria-hidden="true"></i> Create Contract Phase
                                 </a>
                            </li>

                             <li class="dropdown dropdown-submenu">
                                <a href="/cib/pages/card/peramiter/contract_phase/all_contract_phase.php" class="dropdown-toggle">&nbsp;&nbsp;
                                     <i class="fa fa-circle-o" aria-hidden="true"></i> All Contract Phase
                                 </a>
                            </li> 
                        </ul>
                     </li>
                      <!-- for contract phase -->

                    <!-- for contract type -->
                     <li  class="active dropdown"><a class="dropdown-toggle" data-toggle="dropdown"  href="/cib/pages/card/peramiter/contract_type/create_contract_type.php"><i class="fa fa-angle-double-right"></i>Contract type <b class="caret pull-right" style="margin-top: 10px;  margin-right: 8px;"></b> </a>
                        <ul class="dropdown-menu" style="background-color: gainsboro; width: 100%;">
                            <li class="dropdown dropdown-submenu">
                                <a href="/cib/pages/card/peramiter/contract_type/create_contract_type.php" class="dropdown-toggle">&nbsp;&nbsp;
                                     <i class="fa fa-circle-o" aria-hidden="true"></i> Create Contract Type
                                 </a>
                            </li>

                             <li class="dropdown dropdown-submenu">
                                <a href="/cib/pages/card/peramiter/contract_type/all_contract_type.php" class="dropdown-toggle">&nbsp;&nbsp;
                                     <i class="fa fa-circle-o" aria-hidden="true"></i> All Contract Type
                                 </a>
                            </li> 
                        </ul>
                     </li>
                      <!-- for contract type -->


                      <!-- for currency code -->
                     <li  class="active dropdown"><a class="dropdown-toggle" data-toggle="dropdown"  href="/cib/pages/card/peramiter/currency_code/create_currency_code.php"><i class="fa fa-angle-double-right"></i>Currency  <b class="caret pull-right" style="margin-top: 10px;  margin-right: 8px;"></b> </a>
                        <ul class="dropdown-menu" style="background-color: gainsboro; width: 100%;">
                            <li class="dropdown dropdown-submenu">
                                <a href="/cib/pages/card/peramiter/currency_code/create_currency_code.php" class="dropdown-toggle">&nbsp;&nbsp;
                                     <i class="fa fa-circle-o" aria-hidden="true"></i> Create Currency
                                 </a>
                            </li>

                             <li class="dropdown dropdown-submenu">
                                <a href="/cib/pages/card/peramiter/currency_code/all_currency_code.php" class="dropdown-toggle">&nbsp;&nbsp;
                                     <i class="fa fa-circle-o" aria-hidden="true"></i> All Currency
                                 </a>
                            </li> 
                        </ul>
                     </li>
                      <!-- for currency code -->


                       <!-- for periodicity -->
                     <li  class="active dropdown"><a class="dropdown-toggle" data-toggle="dropdown"  href="/cib/pages/card/peramiter/periodicity/create_currency_code.php"><i class="fa fa-angle-double-right"></i>Periodicity  <b class="caret pull-right" style="margin-top: 10px;  margin-right: 8px;"></b> </a>
                        <ul class="dropdown-menu" style="background-color: gainsboro; width: 100%;">
                            <li class="dropdown dropdown-submenu">
                                <a href="/cib/pages/card/peramiter/periodicity/create_periodicity.php" class="dropdown-toggle">&nbsp;&nbsp;
                                     <i class="fa fa-circle-o" aria-hidden="true"></i> Create Periodicity
                                 </a>
                            </li>

                             <li class="dropdown dropdown-submenu">
                                <a href="/cib/pages/card/peramiter/periodicity/all_periodicity.php" class="dropdown-toggle">&nbsp;&nbsp;
                                     <i class="fa fa-circle-o" aria-hidden="true"></i> All Periodicity
                                 </a>
                            </li> 
                        </ul>
                     </li>
                      <!-- for payment method  -->

                         <!-- for periodicity -->
                     <li  class="active dropdown"><a class="dropdown-toggle" data-toggle="dropdown"  href="/cib/pages/card/peramiter/payment_method/create_payment_method.php"><i class="fa fa-angle-double-right"></i>Payment Method  <b class="caret pull-right" style="margin-top: 10px;  margin-right: 8px;"></b> </a>
                        <ul class="dropdown-menu" style="background-color: gainsboro; width: 100%;">
                            <li class="dropdown dropdown-submenu">
                                <a href="/cib/pages/card/peramiter/payment_method/create_payment_method.php" class="dropdown-toggle">&nbsp;&nbsp;
                                     <i class="fa fa-circle-o" aria-hidden="true"></i> Create Payment Method
                                 </a>
                            </li>

                             <li class="dropdown dropdown-submenu">
                                <a href="/cib/pages/card/peramiter/payment_method/all_payment_method.php" class="dropdown-toggle">&nbsp;&nbsp;
                                     <i class="fa fa-circle-o" aria-hidden="true"></i> All Payment Method
                                 </a>
                            </li> 
                        </ul>
                     </li>
                      <!-- for payment method code -->

                    <!-- ramjan utitlity set up -->


                </ul>                            
            </li>

           
            
            <!-- Role -->
            <!-- <li class="treeview">
                <a href="#">
                    <i class="fa fa-table"></i><span>ROLE MANAGE</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li class="active"><a href="/cib/pages/card/role_manage/role.php"><i class="fa fa-angle-double-right"></i>User Roles</a></li>
                    <li class="active"><a href="/cib/pages/card/menu_update/role_update.php"><i class="fa fa-angle-double-right"></i>Permission</a></li>
                </ul>                            
            </li> -->
            <!-- /Role-->




              <!-- CIB -->
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-table"></i><span>CIB REPORT</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                     <li class="dropdown dropdown-submenu">
                        <a href="/cib/pages/card/cib/import_contracts.php" class="dropdown-toggle">&nbsp;&nbsp;
                             <i class="fa fa-angle-double-right"></i> Import CL File
                         </a>
                    </li> 
                     <li class="dropdown dropdown-submenu">
                        <a href="/cib/pages/card/cib/generate_cib.php" class="dropdown-toggle">&nbsp;&nbsp;
                            <i class="fa fa-angle-double-right"></i> Generate CIB
                         </a>
                    </li>

                     <li class="dropdown dropdown-submenu">
                        <a href="/cib/pages/card/cib/download_cib.php" class="dropdown-toggle">&nbsp;&nbsp;
                            <i class="fa fa-angle-double-right"></i> Download CIB
                         </a>
                    </li> 

                    <li class="dropdown dropdown-submenu">
                        <a href="/cib/pages/card/cib/modify_subject.php" class="dropdown-toggle">&nbsp;&nbsp;
                             <i class="fa fa-angle-double-right"></i> Show Subject Data
                         </a>
                    </li>

                     <li class="dropdown dropdown-submenu">
                        <a href="/cib/pages/card/cib/modify_contract.php" class="dropdown-toggle">&nbsp;&nbsp;
                             <i class="fa fa-angle-double-right"></i> Show Contracts Data
                         </a>
                    </li> 

                     <li class="dropdown dropdown-submenu">
                        <a href="/cib/pages/card/cib/subject_error/cib_error_report.php" class="dropdown-toggle">&nbsp;&nbsp;
                            <i class="fa fa-angle-double-right"></i>  Subject Error
                         </a>
                    </li>
                   

                      <li class="dropdown dropdown-submenu">
                        <a href="/cib/pages/card/cib/data_archive/show_subject_archive.php" class="dropdown-toggle">&nbsp;&nbsp;
                            <i class="fa fa-angle-double-right"></i>  Archive Subject Info
                         </a>
                    </li>

                     <li class="dropdown dropdown-submenu">
                        <a href="/cib/pages/card/cib/data_archive/show_contract_archive.php" class="dropdown-toggle">&nbsp;&nbsp;
                            <i class="fa fa-angle-double-right"></i>  Archive Contract Info
                         </a>
                    </li>

                     <li class="dropdown dropdown-submenu">
                        <a href="/cib/pages/card/cib/cib_merge/cib_merge.php" class="dropdown-toggle">&nbsp;&nbsp;
                            <i class="fa fa-angle-double-right"></i>  Merge CIB File
                         </a>
                    </li>


                     <li class="dropdown dropdown-submenu">
                        <a href="/cib/pages/card/cib/cib_report/previous_month.php" class="dropdown-toggle">&nbsp;&nbsp;
                            <i class="fa fa-angle-double-right"></i>  Previous CIB  Report
                         </a>
                    </li> 
                </ul>                            
            </li>
            <!-- /CIB-->
            


           
            
           
           
            </li>
            <!-- / Operation -->
            <!-- ------------------------------------------------- Ramjan --------------------------------------------------------------->
        

            <!-- ------------------------------------------------- Ramjan --------------------------------------------------------------->
            
            <!-- Admin Panel -->
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-table"></i> <span>ADMIN PANEL</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                   
                    <li class="active"><a href="/cib/pages/card/new_user_create.php"><i class="fa fa-angle-double-right"></i> Create new user</a></li>
                    <li class="active"><a href=/cib/pages/card/existing_user_list.php><i class="fa fa-angle-double-right"></i> Existing User List</a></li>
                    
                </ul>                            
            </li>
            <!-- / Admin Panel -->
            </ul>
    </section>
    <!-- /.sidebar -->
</aside