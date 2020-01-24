<?php

   require_once('../../functions.php');

   $login_id = $_SESSION['nb_credentials']['user_id'];

   $packings = getAll('tbl_packing');

   $customers = getWhere('tbl_customer','added_by',$login_id);

   if(isset($_POST['submit'])){

         $upload_dir = '../../uploads/payment/';
         $extensions = array('jpg','jpeg','png','pdf','doc');   
         
         $payment_document = array();
         foreach ($_FILES['payment_document']["error"] as $key => $error) {

             if ($error == UPLOAD_ERR_OK) {  

                 $tmp_name = $_FILES['payment_document']["tmp_name"][$key];
                 $file_name = $_FILES['payment_document']["name"][$key];
                 $extension = explode('.',$file_name);
                 $file_extension = end($extension);

                 if(in_array($file_extension, $extension)){
                     
                     $new_file_name = md5(uniqid()).".".$file_extension;             
                     $destination = $upload_dir.$new_file_name;
                     if(move_uploaded_file($tmp_name, $destination)){
                         $payment_document[] = $new_file_name;
                     }
                 }   

             }
         }

         if(count($payment_document) > 0){
             $payment_document = $payment_document[0];
             // if($sliders['gst_file'] != ""){
             //     unlink($upload_dir.$sliders['gst_file']);
             // }
         }else{
             $payment_document = "";
         }



	   	$form_data = array(	

   		'customer_id' => $login_id,

   		'payment_date' => $_POST['payment_date'],

			'payment_mode' => $_POST['payment_mode'],

			'payment_amount' => $_POST['payment_amount'],
			
      'payment_bank' => $_POST['payment_bank'],

 			'payment_utr_number' => $_POST['payment_utr_number'],
      
      'payment_document' => $payment_document,

      'payment_remark' => $_POST['payment_remark']

	   	);

      
      if(insert('tbl_payments',$form_data)){              

      // 2 - SEND SMS TO ADMIN THAT YOU HAVE RECIEVED A PAYMENT REQUEST
      $getCustomerDetails = getOne('tbl_customer','customer_id',$login_id);
      $getAdminDetails = getOne('tbl_admins','admin_id',$getCustomerDetails['added_by']);
      $admin_mobile = $getAdminDetails['admin_mobile'];
      $customer_name = $getCustomerDetails['customer_name'];
      $message = "You have a payment approval request of ".$_POST['payment_amount']." from ".$customer_name." ";
      sendSMS($admin_mobile,$message);

			$success = "Thanks, Your Payment Request has Sent to Admin for Approval ";

	     }else{

	        $error = "Failed to Add payment";

	 	}		   		



   }



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

                   <div class="row">

                     <div class="col-md-6">

                        <div class="page-title-box">

                           <h4 class="page-title">Add Payment</h4>

                           <div class="clearfix"></div>

                        </div>

                     </div>                   

                  </div>

                  <div class="row">   

                     

                     <div class="col-sm-12">

                        <div class="card-box">

                           <div class="row">



                               <form method="post" class="form-horizontal" enctype="multipart/form-data">

                                 <div class="col-md-12">



                                    <div class="row">



                                    	<div class="col-md-4">

                                          <div class="form-group">

                                             <label for="payment_date">Date<span class="text-danger">*</span></label>

                                             <input type="date" name="payment_date" parsley-trigger="change" required="" placeholder="" class="form-control" id="payment_date" value="<?php echo date('Y-m-d'); ?>">

                                          </div>

                                       </div>



                                       <div class="col-md-4">

                                          <div class="form-group">

                                             <label for="payment_mode">Payment Mode<span class="text-danger">*</span></label>

                                             <select name="payment_mode" parsley-trigger="change" required="" class="form-control select2" id="payment_mode">

                                             	<option value="">--Select Payment Mode--</option>
                                                <option value="NEFT">NEFT</option>
                                                <option value="RTGS">RTGS</option>
                                                <option value="IMPS">IMPS</option>
                                             	<!-- <option value="2">Credit Note</option> -->
                                                
                                             </select>

                                          </div>

                                       </div>


                                       <div class="col-md-4">

                                          <div class="form-group">

                                             <label for="payment_amount">Amount<span class="text-danger">*</span></label>

                                             <input type="number" name="payment_amount" parsley-trigger="change" required="" class="form-control select2" id="payment_amount">

                                          </div>

                                       </div>



                                       <div class="col-md-4">

                                          <div class="form-group">

                                             <label for="payment_bank">Bank Name</label>

                                             <input type="text" name="payment_bank" parsley-trigger="change" class="form-control select2" id="payment_bank">

                                          </div>

                                       </div>



                                       <div class="col-md-4">

                                          <div class="form-group">

                                             <label for="payment_utr_number">UTR Number</label>

                                             <input type="text" name="payment_utr_number" parsley-trigger="change" class="form-control select2" id="payment_utr_number">

                                          </div>

                                       </div>

                                       <div class="col-md-4">

                                          <div class="form-group">

                                             <label class="control-label">Upload Document</label>

                                             <input type="file" class="filestyle"  name="payment_document[]" id="payment_document" value="<?php if(isset($edit_data['payment_document'])){ echo $edit_data['payment_document']; } ?>">

                                          </div>

                                       </div>

                                       <div class="col-md-4">

                                          <div class="form-group">

                                             <label for="payment_remark">Remarks</label>

                                             <textarea name="payment_remark" parsley-trigger="change" class="form-control select2" id="payment_remark"></textarea>

                                          </div>

                                       </div>




                                    </div>





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



                                       <div class="col-md-12" align="left">

                                          <button type="submit" name="submit" id="submit" class="btn btn-primary btn-bordered waves-effect w-md waves-light m-b-5">Submit</button>

                                       </div>

                                    </div>

                                 </div>

                              </form>

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
