<?php

 require_once('../../functions.php');

 $login_id = $_SESSION['nb_credentials']['user_id'];
 $login_type = $_SESSION['nb_credentials']['user_type'];

 $table_name = 'tbl_vendors';
 $field_name = 'vendor_id';

 $vendor = getWhere('tbl_vendors','vendor_id',$_GET['id']);

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
   </head>
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
                  <div class="row">
                     <div class="col-xs-12">
                        <div class="page-title-box">
                           <h4 class="page-title">Vendor Detail</h4>
                           <a href="view.php" class="btn btn-primary btn-sm pull-right m-b-10"><i class="fa fa-arrow-left"></i> Back</a>
                           <div class="clearfix"></div>

                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-sm-6">
                        <div class="card-box">
                           <div class="row">

                           		<table class="table table-striped table-bordered table-condensed table-hover" style="margin-top: 50px;">
                           			
                           			<tbody>
                                       <?php if(isset($vendor)){ ?>
                                       <tr>
                                          <td>Name</td>
                                          <td><?php echo $vendor[0]['vendor_name']; ?> </td>
                                       </tr>
                                       <tr>
                                          <td>Vendor Code</td>
                                          <td><?php echo $vendor[0]['vendor_code']; ?> </td>
                                       </tr>
                                       <tr>
                                          <td>Contact Person</td>
                                          <td><?php echo $vendor[0]['contact_person']; ?> </td>
                                       </tr>
                                       <tr>
                                          <td>Address</td>
                                          <td><?php echo $vendor[0]['vendor_address']; ?> </td>
                                       </tr>
                                       <tr>
                                          <td>Pincode</td>
                                          <td><?php echo $vendor[0]['vendor_pincode']; ?> </td>
                                       </tr>
                                       <tr>
                                          <td>Email</td>
                                          <td><?php echo $vendor[0]['vendor_email']; ?> </td>
                                       </tr>
                                       <tr>
                                          <td>Landline Number</td>
                                          <td><?php echo $vendor[0]['vendor_landline']; ?> </td>
                                       </tr>
                                       <tr>
                                          <td>Mobile Number</td>
                                          <td><?php echo $vendor[0]['vendor_mobile']; ?> </td>
                                       </tr>
                                       <tr>
                                          <td>GST Number</td>
                                          <td><?php echo $vendor[0]['vendor_gst']; ?> </td>
                                       </tr>
                                       <tr>
                                          <td>GST Type</td>
                                          <td><?php echo $vendor[0]['vendor_gst_type']; ?> </td>
                                       </tr>
                                       <?php if($vendor[0]['vendor_gst_certificate'] != ""){ ?>
                                       <tr>
                                          <td>GST Certificate </td>
                                          <td><a href="<?php echo "../../uploads/gst/".$vendor[0]['vendor_gst_certificate']; ?>">View File</a></td>
                                       </tr>
                                       <?php } ?>
                                       <tr>
                                          <td>Mode of Payment</td>
                                          <td><?php echo $vendor[0]['vendor_mode_of_payment']; ?> </td>
                                       </tr>
                                       <tr>
                                          <td>PAN Number</td>
                                          <td><?php echo $vendor[0]['vendor_pan']; ?> </td>
                                       </tr>
                                       <?php if($vendor[0]['vendor_aadhaar'] != ""){ ?>
                                       <tr>
                                          <td>Aadhaar</td>
                                          <td><a href="<?php echo "../../uploads/aadhaar/".$vendor[0]['vendor_aadhaar']; ?>">View File</a> </td>
                                       </tr>
                                       <?php } ?>
                                       <tr>
                                          <td>Aadhaar Number</td>
                                          <td><?php echo $vendor[0]['vendor_aadhaar_number']; ?> </td>
                                       </tr>
                                       <?php if($vendor[0]['vendor_food_license_certificate'] != ""){ ?>
                                       <tr>
                                          <td>Food License Certificate</td>
                                          <td><a href="<?php echo "../../uploads/food_certificate/".$vendor[0]['vendor_food_license_certificate']; ?>">View File</a> </td>
                                       </tr>
                                       <?php } ?>
                                       <tr>
                                          <td>Credit Limit</td>
                                          <td><?php echo $vendor[0]['vendor_credit_limit']; ?> </td>
                                       </tr>
                                       <tr>
                                          <td>Credit Limit in Days</td>
                                          <td><?php echo $vendor[0]['vendor_credit_limit_days']; ?> </td>
                                       </tr>
                                       
                                       <?php } ?>

                           			</tbody>

                           		</table>

                                 <div class="row">
                                    <div class="col-md-12 p-t-30">
                                          <?php if(isset($success)){ ?>
                                             <div class="alert alert-success"><?php echo $success; ?></div>
                                          <?php }else if(isset($warning)){ ?>
                                             <div class="alert alert-warning"><?php echo $warning; ?></div>
                                          <?php }else if(isset($error)){ ?>
                                             <div class="alert alert-danger"><?php echo $error; ?></div>
                                          <?php } ?>
                                       </div>  
                                 </div>
                      
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