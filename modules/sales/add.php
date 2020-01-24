<?php

   require_once('../../functions.php');

   $login_id = $_SESSION['nb_credentials']['user_id'];

   $table_name = 'tbl_sales_person';

   $field_name = 'sales_person_id';

    

   if(isset($_POST['submit'])){



    // POST DATA

    $sales_person_name = $_POST['sales_person_name'];

    $sales_person_mobile = $_POST['sales_person_mobile'];

    $sales_person_hq = $_POST['sales_person_hq'];

    $sales_person_designation = $_POST['sales_person_designation'];

    $sales_person_pan = $_POST['sales_person_pan'];

    $sales_person_doj = $_POST['sales_person_doj'];

    $sales_person_dob = $_POST['sales_person_dob'];

    $sales_person_email = $_POST['sales_person_email'];

    $sales_person_password = $_POST['sales_person_password'];

    $sales_person_spouse_name = $_POST['sales_person_spouse_name'];

    $sales_person_spouse_mobile = $_POST['sales_person_spouse_mobile'];

    $sales_person_aadhaar_number = $_POST['sales_person_aadhaar_number'];



     // FILE DATA 

     $name = $_FILES['sales_person_aadhaar'];

     $allowed_extensions = array('jpg','jpeg','png','gif','pdf');

     $target_path = "../../uploads/aadhaar/";

     $file_prefix = "IMG_";

     $upload = file_upload($name,$allowed_extensions,$target_path,$file_prefix);

     

     if($upload['error'] == 1){

      

         $error = "Failed to Upload files, try again later";

     

     }else{



        if(isset($upload['files']) && $upload['files'] != ""){

          

          foreach($upload['files'] as $rs){



             $form_data = array(

               'added_by' => $login_id,

               'sales_person_name' => $sales_person_name,

               'sales_person_designation' => $sales_person_designation,

               'sales_person_hq' => $sales_person_hq,

               'sales_person_mobile' => $sales_person_mobile,

               'sales_person_doj' => $sales_person_doj,

               'sales_person_dob' => $sales_person_dob,

               'sales_person_pan' => $sales_person_pan,

               'sales_person_email' => $sales_person_email,

               'sales_person_aadhaar' => substr($rs,6),

               'sales_person_aadhaar_number' => $sales_person_aadhaar_number,

               'sales_person_password' => $sales_person_password,

               'sales_person_spouse_name' => $sales_person_spouse_name,

               'sales_person_spouse_mobile' => $sales_person_spouse_mobile,

             );



             

             if(insert('tbl_sales_person',$form_data)){

                 $success = "Sales Person Added Successfully";

             }else{

                 $error = "Failed to add Sales Person, try again later";

                 unlink($rs);

             }



          }



        }else{



          // if image not uploaded

          $form_data = array(

               'added_by' => $login_id,

               'sales_person_name' => $sales_person_name,

               'sales_person_designation' => $sales_person_designation,

               'sales_person_hq' => $sales_person_hq,

               'sales_person_mobile' => $sales_person_mobile,

               'sales_person_doj' => $sales_person_doj,

               'sales_person_dob' => $sales_person_dob,

               'sales_person_pan' => $sales_person_pan,

               'sales_person_email' => $sales_person_email,

               'sales_person_aadhaar_number' => $sales_person_aadhaar_number,

               'sales_person_password' => $sales_person_password,

               'sales_person_spouse_name' => $sales_person_spouse_name,

               'sales_person_spouse_mobile' => $sales_person_spouse_mobile,

             );



             

             if(insert('tbl_sales_person',$form_data)){

                 $success = "Sales Person Added Successfully";

             }else{

                 $error = "Failed to add Sales Person, try again later";

             }



        }



     }

      

   }



   if(isset($_GET['edit_id'])){



         $edit_data = getOne($table_name,$field_name,$_GET['edit_id']);         

         $edit_data = array(

           'added_by' => $login_id,

           'sales_person_name' => $edit_data['sales_person_name'],

           'sales_person_designation' => $edit_data['sales_person_designation'],

           'sales_person_hq' => $edit_data['sales_person_hq'],

           'sales_person_mobile' => $edit_data['sales_person_mobile'],

           'sales_person_doj' => $edit_data['sales_person_doj'],

           'sales_person_dob' => $edit_data['sales_person_dob'],

           'sales_person_pan' => $edit_data['sales_person_pan'],

           'sales_person_email' => $edit_data['sales_person_email'],

           'sales_person_aadhaar' => substr($rs,6),

           'sales_person_aadhaar_number' => $edit_data['sales_person_aadhaar_number'],

           'sales_person_password' => $edit_data['sales_person_password'],

           'sales_person_spouse_name' => $edit_data['sales_person_spouse_name'],

           'sales_person_spouse_mobile' => $edit_data['sales_person_spouse_mobile']

         );



   }



  if(isset($_POST['update'])){



    // POST DATA

    $sales_person_name = $_POST['sales_person_name'];

    $sales_person_mobile = $_POST['sales_person_mobile'];

    $sales_person_hq = $_POST['sales_person_hq'];

    $sales_person_designation = $_POST['sales_person_designation'];

    $sales_person_pan = $_POST['sales_person_pan'];

    $sales_person_doj = $_POST['sales_person_doj'];

    $sales_person_dob = $_POST['sales_person_dob'];

    $sales_person_email = $_POST['sales_person_email'];

    $sales_person_password = $_POST['sales_person_password'];

    $sales_person_spouse_name = $_POST['sales_person_spouse_name'];

    $sales_person_spouse_mobile = $_POST['sales_person_spouse_mobile'];

    $sales_person_aadhaar_number = $_POST['sales_person_aadhaar_number'];



     // FILE DATA 

     $name = $_FILES['sales_person_aadhaar'];

     $allowed_extensions = array('jpg','jpeg','png','gif','pdf');

     $target_path = "../../uploads/aadhaar/";

     $file_prefix = "IMG_";

     $upload = file_upload($name,$allowed_extensions,$target_path,$file_prefix);

     

    if($_FILES['sales_person_aadhaar']['error'][0] == 0){



     if($upload['error'] == 1){

      

         $error = "Failed to Upload files, try again later";

     

     }else{

     

         foreach($upload['files'] as $rs){


             $form_data = array(

               'added_by' => $login_id,

               'sales_person_name' => $_POST['sales_person_name'],

               'sales_person_designation' => $_POST['sales_person_designation'],

               'sales_person_hq' => $_POST['sales_person_hq'],

               'sales_person_mobile' => $_POST['sales_person_mobile'],

               'sales_person_doj' => $_POST['sales_person_doj'],

               'sales_person_dob' => $_POST['sales_person_dob'],

               'sales_person_pan' => $_POST['sales_person_pan'],

               'sales_person_email' => $_POST['sales_person_email'],

               'sales_person_aadhaar' => substr($rs,6),

               'sales_person_aadhaar_number' => $_POST['sales_person_aadhaar_number'],

               'sales_person_password' => $_POST['sales_person_password'],

               'sales_person_spouse_name' => $_POST['sales_person_spouse_name'],

               'sales_person_spouse_mobile' => $_POST['sales_person_spouse_mobile'],

             );



             // clear old resource

             $old_sales_person_aadhar = getOne($table_name,$field_name,$_GET['edit_id']);

             $old_sales_person_aadhar['sales_person_aadhaar'];

             unlink("../../".$old_sales_person_aadhar['sales_person_aadhaar']);



             if(update($table_name,$field_name,$_GET['edit_id'],$form_data)){

                   $success = "Sales Person Updated Successfully";

               }else{

                   $error = "Failed to update Sales Person, try again later";

                   unlink($rs);

               }



         }



     }



     }else{



          $form_data = array(

           'added_by' => $login_id,

           'sales_person_name' => $_POST['sales_person_name'],

           'sales_person_designation' => $_POST['sales_person_designation'],

           'sales_person_hq' => $_POST['sales_person_hq'],

           'sales_person_mobile' => $_POST['sales_person_mobile'],

           'sales_person_doj' => $_POST['sales_person_doj'],

           'sales_person_dob' => $_POST['sales_person_dob'],

           'sales_person_pan' => $_POST['sales_person_pan'],

           'sales_person_email' => $_POST['sales_person_email'],

           'sales_person_aadhaar_number' => $_POST['sales_person_aadhaar_number'],

           'sales_person_password' => $_POST['sales_person_password'],

           'sales_person_spouse_name' => $_POST['sales_person_spouse_name'],

           'sales_person_spouse_mobile' => $_POST['sales_person_spouse_mobile'],

         );



         if(update($table_name,$field_name,$_GET['edit_id'],$form_data)){

             $success = "Sales Person Updated Successfully";

         }else{

             $error = "Failed to update Sales Person, try again later";

         }



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

                           <h4 class="page-title">Add Sales Person</h4>

                           <div class="clearfix"></div>

                        </div>

                     </div>                   

                  </div>

                  <div class="row">   

                     

                     <div class="col-sm-12">

                        <div class="card-box">

                           <div class="row">

                              <form method="post" class="form-horizontal" role="form" enctype="multipart/form-data">

                                 <div class="col-md-12">

                                    <div class="row">

                                       <div class="col-md-4">

                                          <div class="form-group">

                                             <label for="sales_person_name">Name<span class="text-danger">*</span></label>

                                             <input type="text" name="sales_person_name" parsley-trigger="change" required="" placeholder="" class="form-control" id="sales_person_name" value="<?php if(isset($edit_data['sales_person_name'])){ echo $edit_data['sales_person_name']; } ?>">

                                          </div>

                                       </div>

                                       <div class="col-md-4">

                                          <div class="form-group">

                                             <label for="sales_person_mobile">Mobile<span class="text-danger">*</span></label>

                                             <input type="number" name="sales_person_mobile" parsley-trigger="change" required="" placeholder="" class="form-control" id="sales_person_mobile" value="<?php if(isset($edit_data['sales_person_mobile'])){ echo $edit_data['sales_person_mobile']; } ?>">

                                          </div>

                                       </div>

                                       <div class="col-md-4">

                                          <div class="form-group">

                                             <label for="sales_person_hq">HQ</label>

                                             <input type="text" name="sales_person_hq" parsley-trigger="change" placeholder="" class="form-control" id="sales_person_hq" value="<?php if(isset($edit_data['sales_person_hq'])){ echo $edit_data['sales_person_hq']; } ?>">

                                          </div>

                                       </div>

                                       <div class="col-md-4">

                                          <div class="form-group">

                                             <label for="sales_person_designation">Designation</label>

                                             <input type="text" name="sales_person_designation" parsley-trigger="change" placeholder="" class="form-control" id="sales_person_designation" value="<?php if(isset($edit_data['sales_person_designation'])){ echo $edit_data['sales_person_designation']; } ?>">

                                          </div>

                                       </div>

                                       <div class="col-md-4">

                                          <div class="form-group">

                                             <label>DOJ <span class="text-danger">*</span></label>

                                             <div class="input-group">

                                                <input type="date" required="" class="form-control" placeholder="mm/dd/yyyy" id="sales_person_doj" value="<?php if(isset($edit_data['sales_person_doj'])){ echo date('Y-m-d',strtotime($edit_data['sales_person_doj'])); } ?>" name="sales_person_doj" >

                                                <span class="input-group-addon bg-custom b-0"><i class="mdi mdi-calendar text-white"></i></span>

                                             </div>

                                          </div>

                                       </div>

                                       <div class="col-md-4">

                                          <div class="form-group">

                                             <label>DOB <span class="text-danger">*</span></label>

                                             <div class="input-group">

                                                <input type="date" required="" class="form-control" placeholder="mm/dd/yyyy" name="sales_person_dob" id="sales_person_dob" value="<?php if(isset($edit_data['sales_person_dob'])){ echo date('Y-m-d',strtotime($edit_data['sales_person_dob'])); } ?>" >

                                                <span class="input-group-addon bg-custom b-0"><i class="mdi mdi-calendar text-white"></i></span>

                                             </div>

                                          </div>

                                       </div>

                                       <div class="col-md-4">

                                          <div class="form-group">

                                             <label for="sales_person_pan">Pan</label>

                                             <input type="text" name="sales_person_pan" parsley-trigger="change" placeholder="" class="form-control" id="sales_person_pan" value="<?php if(isset($edit_data['sales_person_pan'])){ echo $edit_data['sales_person_pan']; } ?>">

                                          </div>

                                       </div>

                                       <div class="col-md-4">

                                          <div class="form-group">

                                             <label for="sales_person_email">Email<span class="text-danger">*</span></label>

                                             <input type="email" name="sales_person_email" parsley-trigger="change" required="" placeholder="" class="form-control" id="sales_person_email" value="<?php if(isset($edit_data['sales_person_email'])){ echo $edit_data['sales_person_email']; } ?>">

                                          </div>

                                       </div>

                                        <div class="col-md-4">

                                          <div class="form-group">

                                             <label for="sales_person_password">Password<span class="text-danger">*</span></label>

                                             <input type="text" name="sales_person_password" parsley-trigger="change" required="" placeholder="" class="form-control" id="sales_person_password" value="<?php if(isset($edit_data['sales_person_password'])){ echo $edit_data['sales_person_password']; } ?>">

                                          </div>

                                       </div>



                                       



                                       <div class="col-md-4">

                                          <div class="form-group">

                                             <label for="sales_person_spouse_name">Spouse Name</label>

                                             <input type="text" name="sales_person_spouse_name" parsley-trigger="change" placeholder="" class="form-control" id="sales_person_spouse_name" value="<?php if(isset($edit_data['sales_person_spouse_name'])){ echo $edit_data['sales_person_spouse_name']; } ?>">

                                          </div>

                                       </div>

                                       <div class="col-md-4">

                                          <div class="form-group">

                                             <label for="sales_person_spouse_mobile">Spouse Mo. No</label>

                                             <input type="number" name="sales_person_spouse_mobile" parsley-trigger="change" placeholder="" class="form-control" id="sales_person_spouse_mobile" value="<?php if(isset($edit_data['sales_person_spouse_mobile'])){ echo $edit_data['sales_person_spouse_mobile']; } ?>">

                                          </div>

                                       </div>



                                       <div class="col-md-4">

                                          <div class="form-group">

                                             <label class="control-label">Adhar Upload</label>

                                             <input type="file" class="filestyle" data-buttonname="btn-default" name="sales_person_aadhaar[]" id="sales_person_aadhaar" >

                                          </div>

                                       </div>

                                       <div class="col-md-4">

                                          <div class="form-group">

                                             <label for="sales_person_aadhaar_number">Adhar No</label>

                                             <input type="text" parsley-trigger="change" placeholder="" class="form-control" name="sales_person_aadhaar_number" id="sales_person_aadhaar_number" value="<?php if(isset($edit_data['sales_person_aadhaar_number'])){ echo $edit_data['sales_person_aadhaar_number']; } ?>">

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

            $('#admin_password').val(password);



         });



      </script>



   </body>

</html>
