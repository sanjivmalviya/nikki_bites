
<?php

   require_once('../../functions.php');

   $login_id = $_SESSION['nb_credentials']['user_id'];
    
   if(isset($_POST['submit'])){
   
       $form_data = array(
         'added_by' => $login_id, // admin id 
         'department_name' => $_POST['department_name']
      );
       
      if(insert('tbl_departments',$form_data)){
         $success = "Department Added Successfully";
      }else{
         $error = "Failed to add Department, try again later";
      }
      
   }

   $table_name = 'tbl_departments';
   $field_name = 'department_id';

   if(isset($_GET['edit_id'])){

         $edit_data = getOne($table_name,$field_name,$_GET['edit_id']);         
         $edit_data = array(
           'added_by' => $login_id,
           'department_name' => $edit_data['department_name']
         );

   }

  if(isset($_POST['update'])){

    // POST DATA
 
      $form_data = array(
        'added_by' => $login_id,
        'department_name' => $_POST['department_name']
      );

       if(update($table_name,$field_name,$_GET['edit_id'],$form_data)){
           $success = "Department Updated Successfully";
       }else{
           $error = "Failed to update department, try again later";
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
                           <h4 class="page-title">Add department</h4>
                           <div class="clearfix"></div>
                        </div>
                     </div>                   
                  </div>
                  <div class="row">   
                     
                     <div class="col-sm-12">
                        <div class="card-box">
                           <div class="row">
                              <form method="post" class="form-horizontal" role="form">
                                 <div class="col-md-12">
                           
                                    <div class="row">
                                       
                                       <div class="col-md-4">
                                          <div class="form-group">
                                             <label for="department_name">Department Name<span class="text-danger">*</span></label>
                                             <input type="text" name="department_name" parsley-trigger="change" required=""  class="form-control" id="department_name" value="<?php if(isset($edit_data['department_name'])){ echo $edit_data['department_name']; } ?>">
                                          </div>
                                       </div>
                                       
                                      
                                    </div>
                                    <div class="row">
                                       <div class="col-md-12" align="left">

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