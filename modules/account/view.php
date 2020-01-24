<?php

 require_once('../../functions.php');

 $login_id = $_SESSION['nb_credentials']['user_id'];
 $login_type = $_SESSION['nb_credentials']['user_type'];

 $payments = getRaw('SELECT pay.payment_id,cust.customer_id,cust.customer_name,pay.payment_date,pay.payment_mode,pay.payment_amount,pay.payment_bank,pay.payment_utr_number,pay.payment_document,pay.payment_status,pay.payment_remark FROM tbl_payments pay INNER JOIN tbl_customer cust ON pay.customer_id = cust.customer_id WHERE cust.added_by = '.$login_id.' ');

if(isset($_GET['payment_id']) && $_GET['payment_id'] != ''){

   $update = "UPDATE tbl_payments SET payment_status = '1' WHERE payment_id = ".$_GET['payment_id']." ";

   $getCustomerPaymentDetail = 'SELECT cust.customer_mobile as mobile_number,pay.payment_amount as amount FROM tbl_customer cust INNER JOIN tbl_payments pay ON cust.customer_id = pay.customer_id WHERE pay.payment_id = '.$_GET['payment_id'].' ';
   $getCustomerPaymentDetail = getRaw($getCustomerPaymentDetail);
   $customer_mobile = $getCustomerPaymentDetail[0]['mobile_number'];
   $payment_amount = $getCustomerPaymentDetail[0]['amount'];
   $message = "Your Payment of ".$payment_amount." has been approved, Your Payment Id is ".$_GET['payment_id']." ";
   
   if(query($update)){

      // Send SMS to Distributer that his payment has been approved.
     sendSMS($customer_mobile,$message);
     $success = "Payment Approved";

   }else{
      
      $error = "Something went wrong, please try again later ";

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
                           <h4 class="page-title">Accoutings (Payouts)</h4>
                           <div class="clearfix"></div>
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-sm-12">
                        <div class="card-box">
                           <div class="row ">

                                  <div class="col-md-12 p-t-30">

                                          <?php if(isset($success)){ ?>

                                             <div class="alert alert-success"><?php echo $success; ?></div>

                                          <?php }else if(isset($warning)){ ?>

                                             <div class="alert alert-warning"><?php echo $warning; ?></div>

                                          <?php }else if(isset($error)){ ?>

                                             <div class="alert alert-danger"><?php echo $error; ?></div>

                                          <?php } ?>

                                       </div>      

                           		<table class="table table-striped table-bordered table-condensed table-hover" style="margin-top: 50px;">
                           			
                           			<thead>
                                       <th>Sr.</th>
                                       <th>Date</th>
                                       <th>Customer</th>
                                       <th>Mode</th>
                                       <th>Amount</th>
                                       <th>Bank</th>
                                       <th>UTR Number</th>
                                       <th>Attachment</th>
                                       <th>Payment Status</th>
                                       <th>Remarks</th>
                                       <th class="text-center">Action</th>
                           			</thead>

                           			<tbody>
                           				
                           				<?php if(isset($payments) && count($payments) > 0){ ?>

                           					<?php $i=1; foreach($payments as $rs){ ?>

                           					<tr>
                                             <td><?php echo $i++; ?></td>
                                             <td><?php echo date('d-m-Y', strtotime($rs['payment_date'])); ?></td>
                                             <td><?php echo $rs['customer_name']; ?> </td>
                                             <td><?php echo $rs['payment_mode']; ?></td>
                                             <td><?php echo $rs['payment_amount']; ?></td>
                                             <td><?php echo $rs['payment_bank']; ?></td>
                                             <td><?php echo $rs['payment_utr_number']; ?></td>
                                             <td><a href="../../uploads/payment/<?php echo $rs['payment_document']; ?>">View</a></td>
                                             <td><?php if($rs['payment_status'] == 1){ echo "<span class='text-primary'>Confirmed</span>"; }else { echo "<span class='text-danger'>Pending</span>";  } ; ?></td>
                                             <td><?php echo $rs['payment_remark']; ?></td>
                                             <td class="text-center">
                                                <?php if($rs['payment_status'] == 0){ ?> <a onclick="return confirm('Are you sure ?');" href="view.php?payment_id=<?php echo $rs['payment_id']; ?>" class="btn btn-primary btn-xs"> Approve</a> <?php }else{ ?> <a href="view.php?payment_id=<?php echo $rs['payment_id']; ?>" disabled class="btn btn-success btn-xs"><i class="fa fa-check"></i> Approved</a> <?php } ?>      
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

      <script>
         
         $(function(){

            $('.danger').popover({ html : true});

         });

      </script>

   </body>
</html>