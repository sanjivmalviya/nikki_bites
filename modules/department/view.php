<?php

require_once('../../functions.php');

 $login_id = $_SESSION['nb_credentials']['user_id'];

 if($_SESSION['nb_credentials']['user_type'] == 1){   
   $departments = getAll('tbl_departments');
 }else{
   $departments = getWhere('tbl_departments','added_by',$login_id);
 }

$table_name = 'tbl_departments';
$field_name = 'department_id';

if(isset($_GET['delete_id'])){
      
if(delete($table_name,$field_name,$_GET['delete_id'])){
   $success = "Record Deleted Successfully";
   header('location:view.php');
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
                           <h4 class="page-title">Departments</h4>
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
                                       <?php if($_SESSION['nb_credentials']['user_type'] == 1){ ?>
                                       <th>Added By</th>
                                       <?php } ?>
                                       <th>Department Name</th>
                                       <th class="text-right">Actions</th>
                                    </thead>

                                    <tbody>
                                       
                                       <?php if(isset($departments) && count($departments) > 0){ ?>

                                          <?php $i=1; foreach($departments as $rs){ ?>

                                          <tr>
                                             <td><?php echo $i++; ?></td>
                                             <?php if($_SESSION['nb_credentials']['user_type'] == 1){ ?>
                                             <td><?php 
                                              $added_by = getOne('tbl_admins','admin_id',$rs['added_by']); 
                                              echo $added_by['admin_name'];
                                             ?></td>
                                             <?php } ?>                  
                                             <td><?php echo $rs['department_name']; ?></td>
                                             
                                             <td class="text-center">
                                                <a href="add.php?edit_id=<?php echo $rs['department_id']; ?>"><i class="fa fa-pencil"></i></a>
                                                <a href="view.php?delete_id=<?php echo $rs['department_id']; ?>" onclick=" return confirm('Are you sure ?'); "><i class="fa fa-trash"></i></a>
                                             </td>
                                          </tr>
                                          <?php } ?>

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