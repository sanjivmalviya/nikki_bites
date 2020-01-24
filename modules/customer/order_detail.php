<?php

 require_once('../../functions.php');

 $login_id = $_SESSION['nb_credentials']['user_id'];
 $login_type = $_SESSION['nb_credentials']['user_type'];

 $order_id = $_GET['id'];
 $order_detail = getWhere('tbl_order_detail','order_id',$order_id);

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
                           <h4 class="page-title">Order Detail</h4>
                           <a href="view_order.php" class="pull-right btn btn-xs btn-primary" style="margin-bottom: 10px;">Back</a>
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
                                       <th>Product</th>
                                       <th class="text-center">Ordered Qty</th>
                                       <th class="text-center">Dispatched Qty</th>
                                       <th class="text-center">Discount</th>
                                       <th class="text-center">Rate</th>
                                       <!-- <th width="5%" class="text-center">Actions</th> -->
                           			</thead>

                           			<tbody>
                           				
                           				<?php if(isset($order_detail) && count($order_detail) > 0){ ?>

                           					<?php $i=1; foreach($order_detail as $rs){ ?>

                           					<tr>
                                             <td><?php echo $i++; ?></td>
                                             <td class="text-center">
                                                <?php 

                                                   $product = getOne('tbl_product','product_id',$rs['order_product_id']); 
                                                   echo $product['product_name'];
                                                   ?>
                                                   
                                                </td>
                                             <td class="text-center"><?php echo $rs['order_product_quantity']; ?></td>
                                             <td class="text-center"><?php 
                                                
                                                $order_dispatch_qty = "SELECT IFNULL(SUM(dispatch_quantity),0) as dispatch_quantity FROM tbl_invoice_detail WHERE order_detail_id = '".$rs['order_detail_id']."' "; 
                                                $order_dispatch_qty = getRaw($order_dispatch_qty);
                                                echo $order_dispatch_qty[0]['dispatch_quantity'];
                                             
                                             ?></td>
                                             <td class="text-center"><?php echo $rs['order_product_discount']; ?></td>
                                             <td class="text-center"><?php echo $rs['order_product_rate']; ?></td>
                                             <!-- <td width="5%" class="text-center"><a href=""><i class="fa fa-trash"></i></a></td> -->
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
