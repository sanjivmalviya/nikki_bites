
<?php

   require_once('../../functions.php');

   $states = getAll('tbl_state');

   if(isset($_POST['submit'])){

     // POST DATA
     $admin_name = $_POST['admin_name'];
     $admin_email = $_POST['admin_email'];
     $admin_mobile = $_POST['admin_mobile'];
     $admin_state = $_POST['admin_state'];
     $admin_password = $_POST['admin_password'];

     $form_data = array(
         'admin_name' => $admin_name,
         'admin_email' => $admin_email,
         'admin_mobile' => $admin_mobile,
         'admin_state' => $admin_state,
         'admin_password' => $admin_password
     );
             
     if(insert('tbl_admins',$form_data)){
         $success = "Admin Added Successfully";
     }else{
         $error = "Failed to add admin, try again later";
     }

     // FILE DATA 
     // $name = $_FILES['admin_profile'];
     // $allowed_extensions = array('jpg','jpeg','png','gif');
     // $target_path = "../../uploads/admin/";
     // $file_prefix = "IMG_";
     // $upload = file_upload($name,$allowed_extensions,$target_path,$file_prefix);

     // if($upload['error'] == 1){
     
     //     $error = "Failed to Upload files, try again later";
     
     // }else{

     //     foreach($upload['files'] as $rs){

     //         $form_data = array(
     //           'admin_name' => $admin_name,
     //           'admin_email' => $admin_email,
     //           'admin_mobile' => $admin_mobile,
     //           'admin_state' => $admin_state,
     //           'admin_password' => $admin_password,
     //           'admin_profile' => substr($rs,6),
     //         );
             
     //         if(insert('tbl_admins',$form_data)){
     //             $success = "Admin Added Successfully";
     //         }else{
     //             $error = "Failed to add admin, try again later";
     //             unlink($rs);
     //         }

     //     }


     // }
      
   }

   if(isset($_GET['admin_id'])&& $_GET['admin_id'] != ''){

          $adminDetail = getOne('tbl_admins','admin_id',$_GET['admin_id']);

   }

   if(isset($_POST['update'])){

     // POST DATA
     $admin_name = $_POST['admin_name'];
     $admin_email = $_POST['admin_email'];
     $admin_mobile = $_POST['admin_mobile'];
     $admin_state = $_POST['admin_state'];
     $admin_password = $_POST['admin_password'];

     $update = "UPDATE tbl_admins SET ";
     if(isset($admin_password) && $admin_password != ""){
      $update .= " admin_password = '$admin_password' , "; 
     }
     $update .= " admin_name = '$admin_name' , "; 
     $update .= " admin_email = '$admin_email' , "; 
     $update .= " admin_mobile = '$admin_mobile' , "; 
     $update .= " admin_state = '$admin_state' "; 
     $update .= " WHERE admin_id = '".$_GET['admin_id']."' "; 

     if(query($update)){
         $success = "Admin Updated Successfully";
     }else{
         $error = "Failed to updated admin, try again later";
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
                           <h4 class="page-title"> <?php if(isset($adminDetail)){ echo "Update"; }else{ echo "Create"; } ?> an Admin</h4>
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
                                       <div class="col-md-6">
                                          <div class="form-group">
                                             <label for="userName">Name<span class="text-danger">*</span></label>
                                             <input type="text" name="admin_name" id="admin_name" parsley-trigger="change" required=""  class="form-control" value="<?php if(isset($adminDetail)){ echo $adminDetail['admin_name']; } ?>" >
                                          </div>
                                       </div>
                                       <div class="col-md-6">
                                          <div class="form-group">
                                             <label for="admin_email">Email<span class="text-danger">*</span></label>
                                             <input type="text" name="admin_email" id="admin_email" parsley-trigger="change" class="form-control" value="<?php if(isset($adminDetail)){ echo $adminDetail['admin_email']; } ?>">
                                          </div>
                                       </div>
                                       <div class="col-md-6">
                                          <div class="form-group">
                                             <label for="admin_mobile">Mobile<span class="text-danger">*</span></label>
                                             <input type="text" name="admin_mobile" id="admin_mobile" parsley-trigger="change" class="form-control" value="<?php if(isset($adminDetail)){ echo $adminDetail['admin_mobile']; } ?>">
                                          </div>
                                       </div>
                                       <div class="col-md-6">
                                          <div class="form-group">
                                             <label for="admin_state">State<span class="text-danger">*</span></label>
                                             <select type="text" name="admin_state" id="admin_state" parsley-trigger="change" class="form-control select2" >
    
                                             <?php if(isset($states) && count($states) > 0){ ?>

                                                <?php foreach($states as $rs){ ?>

                                                   <option <?php if($adminDetail['admin_state'] == $rs['state_id']){ echo "selected"; } ?> value="<?php echo $rs['state_id']; ?>"><?php echo $rs['state_name']; ?></option>

                                                <?php } ?>

                                             <?php } ?>
                                             </select>
                                          </div>
                                       </div>  
                                       <!-- <div class="col-md-6">
                                          <div class="form-group">
                                             <label for="admin_profile">Upload Profile Image<span class="text-danger">*</span></label>
                                             <input type="file" name="admin_profile[]" parsley-trigger="change" class="form-control" id="admin_profile">
                                          </div>
                                       </div> -->  
                                        <div class="col-md-6">
                                          <div class="form-group">
                                             <label for="admin_password">Password <span class="text-danger">*</span> <?php if(isset($adminDetail)){ echo "<span class='text-danger'>( leave it blank if you dont want to update the password ) </span>"; } ?></label>
                                             <input type="text" name="admin_password" parsley-trigger="change" class="form-control" id="admin_password" >
                                          </div>
                                          <input type="button" class="btn btn-default btn-sm generatePassword" value="Generate Password">
                                       </div>    

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
                                    <div class="row">
                                       <div class="col-md-12" align="left">

                                          <?php if(isset($adminDetail)){ ?>
                                          
                                          <button type="submit" name="update" class="btn btn-danger btn-bordered waves-effect w-md waves-light m-b-5">Update</button>
                                        
                                        <?php }else{ ?>
                                        
                                          <button type="submit" name="submit" class="btn btn-primary btn-bordered waves-effect w-md waves-light m-b-5">Submit</button>

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