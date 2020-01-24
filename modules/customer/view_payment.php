<?php

 require_once('../../functions.php');

 $login_id = $_SESSION['nb_credentials']['user_id'];
 $login_type = $_SESSION['nb_credentials']['user_type'];

 $payments = getWhere('tbl_payments','customer_id',$login_id);

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
                           <h4 class="page-title">Your Payments</h4>
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
                                       <th>Date</th>
                                       <th>Amount</th>
                                       <th>Bank</th>
                                       <th>Mode</th>
                                       <th>UTR Number</th>
                                       <th width="15%" class="text-center">Attached Document</th>
                                       <th width="10%" class="text-center">Approval Status</th>
                                       <th width="5%" class="text-center">Actions</th>
                           			</thead>

                           			<tbody>
                           				
                           				<?php if(isset($payments) && count($payments) > 0){ ?>

                           					<?php $i=1; foreach($payments as $rs){ ?>

                           					<tr>
                                             <td><?php echo $i++; ?></td>
                                             <td><?php echo date('d-m-Y',strtotime($rs['payment_date'])); ?></td>
                                             <td><i class="fa fa-inr"></i> <?php echo $rs['payment_amount']; ?></td>
                                             <td><?php echo $rs['payment_bank']; ?></td>
                                             <td><?php echo $rs['payment_mode']; ?></td>
                                             <td><?php echo $rs['payment_utr_number']; ?></td>
                                             <td width="15%" class="text-center">
                                                <?php if($rs['payment_document'] != ''){ ?>
                                                <a href="../../uploads/payment/<?php echo $rs['payment_document']; ?>" class="btn btn-xs btn-primary">View Attachment</a>
                                                <?php }else{ echo "-"; } ?>
                                             </td>
                                             <td class="text-center">
                                                <?php if($rs['payment_status'] == '0'){ echo "<span class='text-warning'>Pending</span>"; ?>
                                                <?php }else{ echo "<span class='text-primary'>Approved</span>"; } ?>
                                             </td>
                                             <td width="5%" class="text-center"><a href=""><i class="fa fa-trash"></i></a></td>
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