<?php

   require_once('../../functions.php');

   $login_id = $_SESSION['nb_credentials']['user_id'];

   if(isset($_POST['submit'])){

      $category_name = sanitize($_POST['category_name']);

      if(isExists('tbl_category','category_name',$category_name)){
         
             $error = "Category already exists";

      }else{
         
         $form_data = array(
           'category_name' => $category_name
         );

         if(insert('tbl_category',$form_data)){

             $success = "Category Added Successfully";

         }else{

             $error = "Failed to add Category, try again later";

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
                           <h4 class="page-title">Add Category</h4>
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
                                    
                                    <div class="category-block">
                                      <div class="row">
                                         <div class="col-md-6">
                                            <div class="form-group">
                                               <label for="category_name">Enter Category Name<span class="text-danger">*</span></label>
                                               <input type="text" name="category_name" id="category_name" required="" class="form-control">
                                            </div>
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
                                          
                                          <button type="submit" name="submit" id="submit" class="btn btn-primary btn-bordered waves-effect w-md waves-light m-b-5">Save</button>
                                       
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
          $('#category_name').focus();
      </script>

   </body>
</html>