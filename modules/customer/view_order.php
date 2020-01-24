<?php

 require_once('../../functions.php');

 $login_id = $_SESSION['nb_credentials']['user_id'];
 $login_type = $_SESSION['nb_credentials']['user_type'];

 $orders = getRaw('SELECT * FROM tbl_orders WHERE user_type = "4" AND user_id = '.$login_id.' ');

 $godowns = getAll('tbl_godown');

 if(isset($_GET['order_id'])){

   if(delete('tbl_orders','order_id',$_GET['order_id'])){

      delete('tbl_invoices','order_id',$_GET['order_id']);
      delete('tbl_invoice_detail','order_id',$_GET['order_id']);

      $success = "Order Deleted Successfully";

   }else{

      $error = "Failed to delete order";

   }

 }

?>
<!DOCTYPE html>
<html>
   <head>
       <style>
         .popover{
            z-index: 99999 !important;
            max-width: 100% !important;
            width: 100% !important;
         }
      </style>
      <?php require_once('../../include/headerscript.php'); ?>
   </head>
   <body class="fixed-left">
      <!-- Begin page -->
      <div id="wrapper">
         <!-- Top Bar Start -->
         <?php require_once('../../include/topbar.php'); ?>
         <!-- Top Bar End -->
         <!-- ========== Left Sidebar Start ========== -->
         <?php require_once('../../include/sidebar.php'); ?>
         <!-- Left Sidebar End -->
         <!-- ============================================================== -->
         <!-- Start Page Content here -->
         <!-- ============================================================== -->
         <div class="content-page">
            <!-- Start content -->
            <div class="content">
               <div class="container">
                  <div class="row">
                     <div class="col-xs-12">
                        <div class="page-title-box">
                           <h4 class="page-title">Your Orders</h4>
                           <div class="clearfix"></div>
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-sm-12">
                        <div class="card-box">
                           <div class="row">

                           		<table class="table table-striped table-bordered table-condensed table-hover" style="margin-top: 50px;">
                           			
                           			<thead>
                                       <th>Sr.</th>
                                       <th>Order Number</th>
                                       <th class="text-center">Approval Status</th>
                                       <th class="text-center">Dispatch Status</th>
                                       <th class="text-center">Invoices</th>
                                       <th class="text-center">Created at</th>
                                       <th width="5%" class="text-center">Actions</th>
                           			</thead>

                           			<tbody>
                           				
                           				<?php if(isset($orders) && count($orders) > 0){ ?>

                           					<?php $i=1; foreach($orders as $rs){ ?>

                           					<tr>
                                             <td><?php echo $i++; ?></td>
                                             <td><?php echo $rs['order_number']; ?></td>
                                             <td class="text-center">
                                                <?php if($rs['order_approve_status'] == '0'){ echo "<span class='text-warning'>Pending</span>"; ?>
                                                <?php }else{ echo "<span class='text-primary'>Approved</span>"; } ?>
                                             </td>
                                             <td class="text-center">
                                                <?php 

                                                   if($rs['order_dispatch_status'] == '0'){

                                                      echo "<span class='text-danger'>Pending</span>";

                                                   }else if($rs['order_dispatch_status'] == '1'){
                                                      
                                                      echo "<span class='text-primary'>Dispatched</span>";
                                                      
                                                   }else if($rs['order_dispatch_status'] == '2'){
                                                         
                                                      echo "<span class='text-info'>Partially Dispatched</span>";
                                                   
                                                   }
                                                   
                                                ?>
                                             </td>
                                             <td class="text-center">
                                                <?php 
                                                   $total_invoices = getWhere('tbl_invoices','order_id',$rs['order_id']);
                                                   if(count($total_invoices) > 0){
                                                ?>
                                                   <a href="invoice.php?order_id=<?php echo $rs['order_id']; ?>" ><?php echo count($total_invoices); ?></a>
                                                <?php }else{ echo "-"; } ?>
                                             </td>
                                             <td class="text-center"><?php echo date('d-m-Y',strtotime($rs['created_at'])); ?></td>
                                             <td width="5%" class="text-center">
                                                <a href="order_detail.php?id=<?php echo $rs['order_id']; ?>"><i class="fa fa-eye"></i></a>
                                                <a onclick="return confirm('are you sure ?');" href="view_order.php?order_id=<?php echo $rs['order_id']; ?>"><i class="fa fa-trash"></i></a>
                                             </td>
                           					</tr>
                           					<?php } ?>

                           				<?php } ?>

                           			</tbody>

                           		</table>
                      
                           </div>
                        </div>
                     </div>
                  </div>
               </div>

               
               <!-- container -->
            </div>
            <!-- content -->
         </div>
         <!-- ============================================================== -->
         <!-- End of the page -->
         <!-- ============================================================== -->
      </div>
      <!-- END wrapper -->
      <!-- START Footerscript -->
      <?php require_once('../../include/footerscript.php'); ?>


   </body>
</html>
