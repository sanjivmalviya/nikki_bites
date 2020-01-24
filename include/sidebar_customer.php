 <?php 

    require_once('../../functions.php'); 
    
    $sidebar_modules = getAllByOrder('tbl_modules','module_order','ASC');
    $sidebar_menus = getAllByOrder('tbl_menus','menu_order','ASC');
            
 ?>
 <!-- ========== Left Sidebar Start ========== -->
            <div class="left side-menu">
                <div class="sidebar-inner slimscrollleft">

                    <!--- Sidemenu -->
                    <div id="sidebar-menu">
                        <ul>
                           <li class="menu-title text-center">Customer</li>

                            <li>
                                <a href="../../modules/customer/dashboard.php" class="waves-effect"><i class="ti-dashboard"></i><span> Dashboard </span> </a>
                            </li>

                            <li>
                                <a href="../../modules/customer/target.php" class="waves-effect"><i class="mdi mdi-target"></i><span> My Sales Target </span> </a>
                            </li>

                            <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-stackoverflow"></i><span> Orders </span> <span class="menu-arrow"></span></a>
                                <ul class="list-unstyled">
                                    <li><a href="../../modules/customer/create_order.php"> Create Order </a></li>
                                    <li><a href="../../modules/customer/view_order.php"> View Orders </a></li>
                                </ul>
                            </li>

                            <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-currency-inr"></i><span> Payments </span> <span class="menu-arrow"></span></a>
                                <ul class="list-unstyled">
                                    <li><a href="../../modules/customer/add_payment.php"> Add Payment </a></li>
                                    <li><a href="../../modules/customer/view_payment.php"> View Payments </a></li>                          
                                </ul>
                            </li>

                        </ul>
                    </div>
                    <!-- Sidebar -->
                    <div class="clearfix"></div>

                   

                </div>
                <!-- Sidebar -left -->

            </div>
            <!-- Left Sidebar End -->