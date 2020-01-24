<?php
  
   require_once('../../functions.php');

   $login_id = $_SESSION['nb_credentials']['user_id'];

   $table_name = 'tbl_customer';
   $field_name = 'customer_id';

   if(isset($_POST['submit'])){
    
      $next_id = 'SELECT AUTO_INCREMENT FROM information_schema.TABLES WHERE TABLE_SCHEMA = "'.DB.'" AND TABLE_NAME = "tbl_customer" ';
      $next_id = getRaw($next_id);
      $next_id = $next_id[0]['AUTO_INCREMENT'];
      $customer_code = 'ND/'.sprintf('%05d',($next_id));

      $customer_name = $_POST['customer_name'];
      $contact_person_name = $_POST['contact_person_name'];
      $customer_address = $_POST['customer_address'];
      $customer_pincode = $_POST['customer_pincode'];
      $customer_email = $_POST['customer_email'];
      $customer_password = $_POST['customer_password'];
      $customer_landline = $_POST['customer_landline'];
      $customer_mobile = $_POST['customer_mobile'];
      $customer_gst = $_POST['customer_gst'];
      $customer_gst_type = $_POST['customer_gst_type'];

      $upload_dir = '../../uploads/gst/';
      $extensions = array('jpg','jpeg','png','pdf','doc');   
      
      $customer_gst_certificate = array();
      foreach ($_FILES['customer_gst_certificate']["error"] as $key => $error) {

          if ($error == UPLOAD_ERR_OK) {  

              $tmp_name = $_FILES['customer_gst_certificate']["tmp_name"][$key];
              $file_name = $_FILES['customer_gst_certificate']["name"][$key];
              $extension = explode('.',$file_name);
              $file_extension = end($extension);

              if(in_array($file_extension, $extension)){
                  
                  $new_file_name = md5(uniqid()).".".$file_extension;             
                  $destination = $upload_dir.$new_file_name;
                  if(move_uploaded_file($tmp_name, $destination)){
                      $customer_gst_certificate[] = $new_file_name;
                  }
              }   

          }
      }

      if(count($customer_gst_certificate) > 0){
          $customer_gst_certificate = $customer_gst_certificate[0];
          // if($sliders['gst_file'] != ""){
          //     unlink($upload_dir.$sliders['gst_file']);
          // }
      }else{
          $customer_gst_certificate = "";
      }

      $customer_mode_of_payment = $_POST['customer_mode_of_payment'];
      $customer_pan = $_POST['customer_pan'];
      $customer_aadhaar = $_POST['customer_aadhaar'];
      $upload_dir = '../../uploads/aadhaar/';
      $extensions = array('jpg','jpeg','png','pdf','doc');   
      
      $customer_aadhaar = array();
      foreach ($_FILES['customer_aadhaar']["error"] as $key => $error) {

          if ($error == UPLOAD_ERR_OK) {  

              $tmp_name = $_FILES['customer_aadhaar']["tmp_name"][$key];
              $file_name = $_FILES['customer_aadhaar']["name"][$key];
              $extension = explode('.',$file_name);
              $file_extension = end($extension);

              if(in_array($file_extension, $extension)){
                  
                  $new_file_name = md5(uniqid()).".".$file_extension;             
                  $destination = $upload_dir.$new_file_name;
                  if(move_uploaded_file($tmp_name, $destination)){
                      $customer_aadhaar[] = $new_file_name;
                  }
              }   

          }
      }

      if(count($customer_aadhaar) > 0){
          $customer_aadhaar = $customer_aadhaar[0];
          // if($sliders['gst_file'] != ""){
          //     unlink($upload_dir.$sliders['gst_file']);
          // }
      }else{
          $customer_aadhaar = "";
      }
      $customer_aadhaar_number = $_POST['customer_aadhaar_number'];
      
      $upload_dir = '../../uploads/food_certificate/';
      $extensions = array('jpg','jpeg','png','pdf','doc');   
      $customer_food_license_certificate = array();
      foreach ($_FILES['customer_food_license_certificate']["error"] as $key => $error) {

          if ($error == UPLOAD_ERR_OK) {  

              $tmp_name = $_FILES['customer_food_license_certificate']["tmp_name"][$key];
              $file_name = $_FILES['customer_food_license_certificate']["name"][$key];
              $extension = explode('.',$file_name);
              $file_extension = end($extension);

              if(in_array($file_extension, $extension)){
                  
                  $new_file_name = md5(uniqid()).".".$file_extension;             
                  $destination = $upload_dir.$new_file_name;
                  if(move_uploaded_file($tmp_name, $destination)){
                      $customer_food_license_certificate[] = $new_file_name;
                  }
              }   

          }
      }

      if(count($customer_food_license_certificate) > 0){
          $customer_food_license_certificate = $customer_food_license_certificate[0];
          // if($sliders['gst_file'] != ""){
          //     unlink($upload_dir.$sliders['gst_file']);
          // }
      }else{
          $customer_food_license_certificate = "";
      }
      $customer_credit_limit = $_POST['customer_credit_limit'];
      $customer_credit_limit_days = $_POST['customer_credit_limit_days'];
      $customer_security_deposit = $_POST['customer_security_deposit'];
      $customer_bank_name = $_POST['customer_bank_name'];
      $customer_payment_type = $_POST['customer_payment_type'];
      $customer_cheque_number = $_POST['customer_cheque_number'];
      $customer_additional_details = $_POST['customer_additional_details'];

      $form_data = array(
        'added_by' => $login_id,
        'customer_name' => $customer_name,
        'customer_code' => $customer_code,
        'contact_person_name' => $contact_person_name,
        'customer_address' => $customer_address,
        'customer_pincode' => $customer_pincode,
        'customer_email' => $customer_email,
        'customer_password' => $customer_password,
        'customer_landline' => $customer_landline,
        'customer_mobile' => $customer_mobile,
        'customer_gst' => $customer_gst,
        'customer_gst_type' => $customer_gst_type,
        'customer_gst_certificate' => $customer_gst_certificate,
        'customer_mode_of_payment' => $customer_mode_of_payment,
        'customer_pan' => $customer_pan,
        'customer_aadhaar' => $customer_aadhaar,
        'customer_aadhaar_number' => $customer_aadhaar_number,
        'customer_food_license_certificate' => $customer_food_license_certificate,
        'customer_credit_limit' => $customer_credit_limit,
        'customer_credit_limit_days' => $customer_credit_limit_days,
        'customer_security_deposit' => $customer_security_deposit,
        'customer_bank_name' => $customer_bank_name,
        'customer_payment_type' => $customer_payment_type,
        'customer_cheque_number' => $customer_cheque_number,
        'customer_additional_details' => $customer_additional_details
      );


     if(insert('tbl_customer',$form_data)){
      
        // 6 - SEND SMS TO ADMIN THAT YOU HAVE RECIEVED A PAYMENT REQUEST
        $message = "Your account has been created as Distributer/Customer, Your account username is : ".$customer_email." and password is : ".$customer_password." ";
        sendSMS($customer_mobile,$message);
        
        $success = "Customer Added Successfully";

     }else{

         $error = "Failed to add Customer, try again later";
         // unlink($rs);

     }

  }      

   if(isset($_GET['edit_id'])){

         $edit_data = getOne($table_name,$field_name,$_GET['edit_id']);

         $edit_data = array(
              'customer_name' => $edit_data['customer_name'],
              'customer_code' => $edit_data['customer_code'],
              'contact_person_name' => $edit_data['contact_person_name'],
              'customer_address' => $edit_data['customer_address'],
              'customer_pincode' => $edit_data['customer_pincode'],
              'customer_email' => $edit_data['customer_email'],
              'customer_password' => $edit_data['customer_password'],
              'customer_landline' => $edit_data['customer_landline'],
              'customer_mobile' => $edit_data['customer_mobile'],
              'customer_gst' => $edit_data['customer_gst'],
              'customer_gst_type' => $edit_data['customer_gst_type'],
              'customer_gst_certificate' => $edit_data['customer_gst_certificate'],
              'customer_mode_of_payment' => $edit_data['customer_mode_of_payment'],
              'customer_pan' => $edit_data['customer_pan'],
              'customer_aadhaar' => $edit_data['customer_aadhaar'],
              'customer_aadhaar_number' => $edit_data['customer_aadhaar_number'],
              'customer_food_license_certificate' => $edit_data['customer_food_license_certificate'],
              'customer_credit_limit' => $edit_data['customer_credit_limit'],
              'customer_credit_limit_days' => $edit_data['customer_credit_limit_days'],
              'customer_security_deposit' => $edit_data['customer_security_deposit'],
              'customer_bank_name' => $edit_data['customer_bank_name'],
              'customer_payment_type' => $edit_data['customer_payment_type'],
              'customer_cheque_number' => $edit_data['customer_cheque_number'],
              'customer_additional_details' => $edit_data['customer_additional_details']
          );

   }

   if(isset($_POST['update'])){

     $customer_aadhaar_file = "";

     if($_FILES['customer_aadhaar']['error'][0] == 0){

       // FILE DATA 
       $file = $_FILES['customer_aadhaar'];    
       $allowed_extensions = array('jpg','jpeg','png','gif');
       $target_path = "../../uploads/aadhaar/";
       $file_prefix = "IMG_";
       $upload = file_upload($file,$allowed_extensions,$target_path,$file_prefix);
      
       if($upload['error'] == 1){

             $error = "Failed to Upload files, try again later";

       }else{

           foreach($upload['files'] as $rs){

                $customer_aadhaar_file = $rs;

           }

       }

     }

     $customer_gst_certificate = ""; 
     if($_FILES['customer_gst_certificate']['error'][0] == 0){

       // FILE DATA 
       $file = $_FILES['customer_gst_certificate'];    
       $allowed_extensions = array('jpg','jpeg','png','gif');
       $target_path = "../../uploads/gst_certificate/";
       $file_prefix = "IMG_";
       $upload = file_upload($file,$allowed_extensions,$target_path,$file_prefix);
      
       if($upload['error'] == 1){

             $error = "Failed to Upload files, try again later";

       }else{

           foreach($upload['files'] as $rs){

                $customer_gst_certificate = $rs;

           }

       }

     }  

     $customer_food_license_certificate = "";
     if($_FILES['customer_food_license_certificate']['error'][0] == 0){

       // FILE DATA 
       $file = $_FILES['customer_food_license_certificate'];    
       $allowed_extensions = array('jpg','jpeg','png','gif');
       $target_path = "../../uploads/food_license/";
       $file_prefix = "IMG_";
       $upload = file_upload($file,$allowed_extensions,$target_path,$file_prefix);
      
       if($upload['error'] == 1){

             $error = "Failed to Upload files, try again later";

       }else{

           foreach($upload['files'] as $rs){

                $customer_food_license_certificate = $rs;

           }

       }

     }


     $form_data = array(
        'added_by' => $login_id, // current admin id 
        'customer_name' => $_POST['customer_name'],
        'customer_code' => $_POST['customer_code'],
        'contact_person_name' => $_POST['contact_person_name'],
        'customer_address' => $_POST['customer_address'],
        'customer_pincode' => $_POST['customer_pincode'],
        'customer_email' => $_POST['customer_email'],
        'customer_password' => $_POST['customer_password'],
        'customer_landline' => $_POST['customer_landline'],
        'customer_mobile' => $_POST['customer_mobile'],
        'customer_gst' => $_POST['customer_gst'],
        'customer_gst_type' => $_POST['customer_gst_type'],
        // 'customer_gst_certificate' => $customer_gst_certificate,
        'customer_mode_of_payment' => $_POST['customer_mode_of_payment'],
        'customer_pan' => $_POST['customer_pan'],
        // 'customer_aadhaar' => $customer_aadhaar_file,
        'customer_aadhaar_number' => $_POST['customer_aadhaar_number'],
        // 'customer_food_license_certificate' => $customer_food_license_certificate,
        'customer_credit_limit' => $_POST['customer_credit_limit'],
        'customer_credit_limit_days' => $_POST['customer_credit_limit_days'],
        'customer_security_deposit' => $_POST['customer_security_deposit'],
        'customer_bank_name' => $_POST['customer_bank_name'],
        'customer_payment_type' => $_POST['customer_payment_type'],
        'customer_cheque_number' => $_POST['customer_cheque_number'],
        'customer_additional_details' => $_POST['customer_additional_details'],
      );

      if( isset($customer_aadhaar_file) && $customer_aadhaar_file != ""){
        $form_data['customer_aadhaar'] = $customer_aadhaar_file;
      }
      if( isset($customer_gst_certificate) && $customer_gst_certificate != ""){
        $form_data['customer_gst_certificate'] = $customer_gst_certificate;
      }
      if( isset($customer_food_license_certificate) && $customer_food_license_certificate != ""){
        $form_data['customer_food_license_certificate'] = $customer_food_license_certificate;
      }


       // clear old resource
       // $old_customer_aadhar = getOne('tbl_customer','customer_id',$_GET['edit_id']);
       // unlink($old_customer_aadhar['customer_aadhaar']);
       // unlink($old_customer_aadhar['customer_aadhaar']);

       if(update('tbl_customer',$field_name,$_GET['edit_id'],$form_data)){

          $success = "Customer Updated Successfully";
          echo '<script type="text/javascript">' . "\n";
          echo 'window.location="../../modules/customer/view.php";';
          echo '</script>';

       }else{

           $error = "Failed to update Customer, try again later";
           unlink($rs);

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

                           <h4 class="page-title">Add Customer</h4>

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

                                             <label for="customer_name">Customer Name (Party)<span class="text-danger">*</span></label>

                                             <input type="text" name="customer_name" parsley-trigger="change" required="" placeholder="" class="form-control" id="customer_name" value="<?php if(isset($edit_data['customer_name'])){ echo $edit_data['customer_name']; } ?>" >

                                          </div>

                                       </div>

                                       <div class="col-md-4">

                                          <div class="form-group">

                                             <label for="contact_person_name">Contact Person Name</label>

                                             <input type="text" name="contact_person_name" parsley-trigger="change"placeholder="" class="form-control" id="contact_person_name" value="<?php if(isset($edit_data['contact_person_name'])){ echo $edit_data['contact_person_name']; } ?>">

                                          </div>

                                       </div>


                                       <div class="col-md-4">

                                          <div class="form-group">

                                             <label for="customer_address">Address</label>

                                             <input type="text" name="customer_address" parsley-trigger="change"  placeholder="" class="form-control" id="customer_addres" value="<?php if(isset($edit_data['customer_address'])){ echo $edit_data['customer_address']; } ?>">

                                          </div>

                                       </div>

                               

                                       <div class="col-md-4">

                                          <div class="form-group">

                                             <label for="customer_pincode">Pin code</label>

                                             <input type="number" name="customer_pincode" parsley-trigger="change"  placeholder="" class="form-control" id="customer_pincode" value="<?php if(isset($edit_data['customer_pincode'])){ echo $edit_data['customer_pincode']; } ?>">

                                          </div>

                                       </div>

                                       <div class="col-md-4">

                                          <div class="form-group">

                                             <label for="customer_email">Email <span class="text-danger">*</span></label>

                                             <input type="email" required="" name="customer_email" parsley-trigger="change"  placeholder="" class="form-control" id="customer_email" value="<?php if(isset($edit_data['customer_email'])){ echo $edit_data['customer_email']; } ?>">

                                          </div>

                                       </div>

                                     <div class="col-md-4">

                                          <div class="form-group">

                                             <label for="customer_password">Password<?php if(isset($edit_data['customer_password'])){ echo '<span class="text-danger">*</span> '; } ?>&nbsp;<input type="button" class="btn btn-default btn-xs pull-right generatePassword" value="Generate"></label>

                                             <input type="text" name="customer_password" parsley-trigger="change" <?php if(!isset($edit_data)){ echo "required"; } ?> placeholder="" class="form-control" id="customer_password" value="<?php if(isset($edit_data['customer_password'])){ echo $edit_data['customer_password']; } ?>">

                                          </div>

                                       </div>


                                       <div class="col-md-4">

                                          <div class="form-group">

                                             <label for="customer_landline">Landline Number </label>

                                             <input type="number" name="customer_landline" parsley-trigger="change"placeholder="" class="form-control" id="customer_landline" value="<?php if(isset($edit_data['customer_landline'])){ echo $edit_data['customer_landline']; } ?>">

                                          </div>

                                       </div>

                                       <div class="col-md-4">

                                          <div class="form-group">

                                             <label for="customer_mobile">Mobile <span class="text-danger">*</span></label>

                                             <input type="number" name="customer_mobile" parsley-trigger="change" required="" placeholder="" class="form-control" id="customer_mobile" value="<?php if(isset($edit_data['customer_mobile'])){ echo $edit_data['customer_mobile']; } ?>">

                                          </div>

                                       </div>

                                       <div class="col-md-4">

                                          <div class="form-group">

                                             <label for="customer_gst">Gst No<span class="text-danger">*</span></label>

                                             <input type="text" name="customer_gst" parsley-trigger="change"  placeholder="" class="form-control" id="customer_gst" value="<?php if(isset($edit_data['customer_gst'])){ echo $edit_data['customer_gst']; } ?>">

                                          </div>

                                       </div>

                                       <div class="col-md-4">

                                          <div class="form-group">

                                             <label for="customer_gst_type">Gst Type<span class="text-danger">*</span></label>

                                             <select name="customer_gst_type" parsley-trigger="change"  class="form-control select2" id="customer_gst_type">

                                                <option <?php if(isset($edit_data['customer_gst_type']) && $edit_data['customer_gst_type'] == "1"){ echo "selected";  } ?> value="1">CGST/SGST</option>

                                                <option <?php if(isset($edit_data['customer_gst_type']) && $edit_data['customer_gst_type'] == "2"){ echo "selected";  } ?> value="2">IGST</option>

                                             </select>

                                          </div>

                                       </div>


                                        <div class="col-md-4">

                                          <div class="form-group">

                                             <label class="control-label">Upload GST Certificate</label>

                                             <input type="file" class="filestyle"  name="customer_gst_certificate[]" id="customer_gst_certificate" value="<?php if(isset($edit_data['customer_gst_certificate'])){ echo $edit_data['customer_gst_certificate']; } ?>">

                                          </div>

                                       </div>

                                       <div class="col-md-4">

                                          <div class="form-group">

                                             <label for="customer_mode_of_payment">Mode of Payment</label>

                                             <input name="customer_mode_of_payment" id="customer_mode_of_payment" parsley-trigger="change" class="form-control" value="<?php if(isset($edit_data['customer_gst'])){ echo $edit_data['customer_mode_of_payment']; } ?>">

                                          </div>

                                       </div>

                                       <div class="clearfix"></div>

                                       <div class="col-md-4">

                                          <div class="form-group">

                                             <label for="customer_pan">Pan Number</label>

                                             <input type="text" name="customer_pan" parsley-trigger="change" placeholder="" class="form-control" id="customer_pan" value="<?php if(isset($edit_data['customer_pan'])){ echo $edit_data['customer_pan']; } ?>">

                                          </div>

                                       </div>

                                    
                                        <div class="col-md-4">

                                          <div class="form-group">

                                             <label class="control-label">Upload Aadhaar</label>

                                             <input type="file" class="filestyle"  name="customer_aadhaar[]" id="customer_aadhaar" value="<?php if(isset($edit_data['customer_aadhaar'])){ echo $edit_data['customer_aadhaar']; } ?>">

                                          </div>

                                       </div>

                                       <div class="col-md-4">

                                          <div class="form-group">

                                             <label for="customer_aadhaar_number">Aadhaar Number<span class="text-danger">*</span></label>

                                             <input type="text" name="customer_aadhaar_number" parsley-trigger="change" required="" placeholder="" class="form-control" id="customer_aadhaar_number" value="<?php if(isset($edit_data['customer_aadhaar_number'])){ echo $edit_data['customer_aadhaar_number']; } ?>">

                                          </div>

                                       </div>
                                       <div class="clearfix"></div>



                                        <div class="col-md-4">

                                          <div class="form-group">

                                             <label class="control-label">Upload Food License Certificate </label>

                                             <input type="file" class="filestyle"  name="customer_food_license_certificate[]" id="customer_food_license_certificate" value="<?php if(isset($edit_data['customer_food_license_certificate'])){ echo $edit_data['customer_food_license_certificate']; } ?>">

                                          </div>

                                       </div>

                               

                                       <div class="col-md-4">

                                          <div class="form-group">

                                             <label for="customer_credit_limit">Credit Limit</label>

                                             <input type="number" name="customer_credit_limit" parsley-trigger="change" placeholder="" class="form-control" id="customer_credit_limit" value="<?php if(isset($edit_data['customer_credit_limit'])){ echo $edit_data['customer_credit_limit']; } ?>">

                                          </div>

                                       </div>



                                       <div class="col-md-4">

                                          <div class="form-group">

                                             <label for="customer_credit_limit_days">Credit Limit in Days</label>

                                             <input type="number" name="customer_credit_limit_days" parsley-trigger="change" placeholder="" class="form-control" id="customer_credit_limit_days" value="<?php if(isset($edit_data['customer_credit_limit_days'])){ echo $edit_data['customer_credit_limit_days']; } ?>">

                                          </div>

                                       </div>

                                       <div class="clearfix"></div>

                                       <div class="col-md-4">

                                          <div class="form-group">

                                             <label for="customer_security_deposit">Security Deposit</label>

                                             <input type="text" name="customer_security_deposit" parsley-trigger="change" placeholder="" class="form-control" id="customer_security_deposit" value="<?php if(isset($edit_data['customer_security_deposit'])){ echo $edit_data['customer_security_deposit']; } ?>">

                                          </div>

                                       </div>

                                       <div class="col-md-4">

                                          <div class="form-group">

                                             <label for="customer_bank_name">Bank Name</label>

                                             <input type="text" name="customer_bank_name" parsley-trigger="change" placeholder="" class="form-control" id="customer_bank_name" value="<?php if(isset($edit_data['customer_bank_name'])){ echo $edit_data['customer_bank_name']; } ?>">

                                          </div>

                                       </div>

                                        <div class="col-md-4">

                                          <div class="form-group">

                                             <label for="customer_payment_type">Payment Type</label>

                                             <input type="text" name="customer_payment_type" parsley-trigger="change" placeholder="" class="form-control" id="customer_payment_type" value="<?php if(isset($edit_data['customer_payment_type'])){ echo $edit_data['customer_payment_type']; } ?>">

                                          </div>

                                       </div>

                                        <div class="col-md-4">

                                          <div class="form-group">

                                             <label for="customer_cheque_number">DD/Cheque Number</label>

                                             <input type="text" name="customer_cheque_number" parsley-trigger="change" placeholder="" class="form-control" id="customer_cheque_number" value="<?php if(isset($edit_data['customer_cheque_number'])){ echo $edit_data['customer_cheque_number']; } ?>">

                                          </div>

                                       </div>

                                        <div class="col-md-4">

                                          <div class="form-group">

                                             <label for="customer_additional_details">Additional Details</label>

                                             <input type="text" name="customer_additional_details" parsley-trigger="change" placeholder="" class="form-control" id="customer_additional_details" value="<?php if(isset($edit_data['customer_additional_details'])){ echo $edit_data['customer_additional_details']; } ?>">

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



                                       <div class="col-md-12" align="right">

                                          <?php if(isset($edit_data)){ ?>                                             

                                            <button type="submit" name="update" id="update" class="btn btn-danger btn-bordered waves-effect w-md waves-light m-b-5">Update</button>

                                         <?php }else{ ?>

                                            <button type="submit" name="submit" id="submit" class="btn btn-primary btn-bordered waves-effect w-md waves-light m-b-5">Submit</button>

                                         <?php } ?>

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



    
      <script>

         

         $('.generatePassword').on('click', function(){



            var password = randomPassword();

            $('#customer_password').val(password);



         });



      </script>




   </body>

</html>
