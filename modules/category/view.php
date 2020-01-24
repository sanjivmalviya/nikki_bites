<?php

   require_once('../../functions.php');

 $login_id = $_SESSION['nb_credentials']['user_id'];
 $categories = getAll('tbl_category');

 if(isset($_GET['delete_category'])){

   if(delete('tbl_category','category_id',$_GET['delete_category'])){
      $success = "Record Deleted Successfully";
   }else{
      $error = "Failed to Delete Record";
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
                     <div class="col-xs-12">
                        <div class="page-title-box">
                           <h4 class="page-title">Categories</h4>
                           <div class="clearfix"></div>
                        </div>
                     </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-12">
                        <div class="card-box">
                           <div class="row">

                            <!-- <h5>Categories</h5> -->

                                 <table class="table table-striped table-bordered table-condensed table-hover" style="margin-top: 50px;">
                                    
                                    <thead>
                                       <th width="5%">Sr.</th>
                                       <th>Category</th>
                                       <th width="5%" class="text-right">Actions</th>
                                    </thead>

                                    <tbody>
                                       
                                       <?php if(isset($categories) && count($categories) > 0){ ?>

                                          <?php $i=1; foreach($categories as $rs){  ?>

                                          <tr>
                                             <td><?php echo $i++; ?></td>
                                             <td><?php echo $rs['category_name']; ?></td>
                                             <td class="text-center">
                                                <!-- <a href="add.php?edit_id=<?php echo $rs['sub_category_id']; ?>"><i class="fa fa-pencil"></i></a> -->
                                                <a href="view.php?delete_category=<?php echo $rs['category_id']; ?>" onclick=" return confirm('Are you sure ?'); "><i class="fa fa-trash"></i></a>
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