<?php

require_once('../../functions.php');

$login_id = $_SESSION['nb_credentials']['user_id'];

$product_id = $_GET['product_id'];
$stock_history = "SELECT * FROM tbl_product_stock_history WHERE product_id = '$product_id' ";
$stock_history = getRaw($stock_history);

?>
<!DOCTYPE html>
<html>
   <?php require_once('../../include/headerscript.php'); ?>
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
                  <div class ="row">
                     <div class="col-xs-12">
                        <div class="page-title-box">
                           <h4 class="page-title">Stock History</h4>
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
                                       <th>Godown</th>
                                       <th>Product</th>
                                       <th>Stock Type</th>
                                       <th>Quantity</th>
                                       <th>Date</th>
                                    </thead>

                                    <tbody>
                                       
                                       <?php if(isset($stock_history) && count($stock_history) > 0){ ?>

                                          <?php $i=1; foreach($stock_history as $rs){ ?>

                                          <tr>
                                             <td><?php echo $i++; ?></td>       
                                             <td><?php 
                                                   
                                                   $godown_name = getOne('tbl_godown','godown_id',$rs['godown_id']);
                                                   if($login_id == $rs['godown_id']){
                                                      echo "<b class='text-primary'>".$godown_name['godown_name']."<b>"; 
                                                   }else{
                                                      echo $godown_name['godown_name']; 
                                                   }
                                               
                                             ?></td>                       
                                             <td><?php 
                                                
                                                   $product_name = getOne('tbl_product','product_id',$rs['product_id']);
                                                   echo $product_name['product_name']; 
                                               
                                             ?></td>                                    
                                             <td><?php if($rs['stock_type'] == 1){ echo "<span class='text-primary'> + Stock Added </span>"; }else{ echo "<span class='text-danger'> - Stock Removed </span>"; } ?></td>       
                                             <td><?php echo $rs['stock_quantity']; ?></td>       
                                             <td><?php echo $rs['created_at']; ?></td>       
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