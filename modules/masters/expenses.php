
<?php

   require_once('../../functions.php');

   $login_id = $_SESSION['nb_credentials']['user_id'];

   $expenses = getAll('tbl_expense_master');

   $table_name = 'tbl_expense_master';
   $field_name = 'expense_id';

   if(isset($_POST['submit'])){

      $expense_name = $_POST['expense_name'];

   	$form_data = array(	
   	'expense_name' => $expense_name			
   	);

      if(isExists('tbl_expense_master','expense_name',$expense_name)){

   			$error = "Oops ! Name already exists, try a different one";

      }else{
   
         if(insert('tbl_expense_master',$form_data)){              
   			$success = "expense Addded Successfully";
         }else{
            $error = "Failed to Add expense";
   		}		   		
         
      }

   }

   if(isset($_GET['edit_id'])){

         $edit_data = getOne($table_name,$field_name,$_GET['edit_id']);
         $expense_name = $edit_data['expense_name'];

   }

   if(isset($_POST['update'])){

      $form_data = array('expense_name'=>sanitize($_POST['expense_name']));
      if(update($table_name,$field_name,$_GET['edit_id'],$form_data)){
         $success = "Data Updated Successfully";
      }else{
         $error = "Failed to Update Data";
      }

   }

   if(isset($_GET['delete_id'])){
         
      if(delete($table_name,$field_name,$_GET['delete_id'])){
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
                     <div class="col-md-6">
                        <div class="page-title-box">
                           <h4 class="page-title">Expense Categories</h4>
                           <div class="clearfix"></div>
                        </div>
                     </div>                   
                  </div>
                  <div class="row">
                     
                     <div class="col-sm-12">
                        <div class="card-box">
                           <div class="row">

                               <form method="post" class="form-horizontal">
                                 <div class="col-md-12">

                                    <div class="row">

                                    	<div class="col-md-4">
                                          <div class="form-group">
                                             <label for="expense_name">Expense Name<span class="text-danger">*</span></label>
                                             <input type="text" name="expense_name" parsley-trigger="change" required="" placeholder="" class="form-control" id="expense_name"  value="<?php if(isset($expense_name)){ echo $expense_name; } ?>">
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

                  <div class="row">
                     <div class="col-md-6">
                     <table class="table table-striped table-condensed table-bordered">
                        <thead>
                           <th>Name</th>
                           <th class="text-right">Actions</th>
                        </thead>


                        <tbody>
                           <?php if(isset($expenses)){ ?>
                              <?php foreach($expenses as $rs){ ?>

                                 <tr>
                                    <td><?php echo $rs['expense_name']; ?></td>
                                    <td class="text-right">
                                        <a href="expenses.php?edit_id=<?php echo $rs['expense_id']; ?>"><i class="fa fa-pencil"></i></a>
                                       <a href="expenses.php?delete_id=<?php echo $rs['expense_id']; ?>" onclick=" return confirm('Are you sure ?'); "><i class="fa fa-trash"></i></a>
                                    </td>
                                 </tr>
                                                     
                              <?php } ?>
                           <?php } ?>
                        </tbody>
                     </table>
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