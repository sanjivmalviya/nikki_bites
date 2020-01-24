
<?php

   require_once('../../functions.php');

   $login_id = $_SESSION['nb_credentials']['user_id'];

  if($_SESSION['nb_credentials']['user_type'] == 2){

      $customers = getWhere('tbl_customer','added_by',$login_id);

   }else{

      $customers = getAll('tbl_customer');
    
   }
   
   // $customers = "SELECT * FROM tbl_customer sales INNER JOIN tbl_admins admin ON admin.admin_id = sales.added_by ";
   // $customers = getRaw($customers);

   if(isset($_POST['submit'])){

        $form_data = array(
          'target_year' => $_POST['target_year'],
          'target_month' => $_POST['target_month'],
          'target_amount' => $_POST['target_amount'],
          'customer_id' => $_POST['customer_id'],
          'added_by' => $login_id
        );

        if(insert('tbl_target',$form_data)){
           $success = "Target Assigned Successfully";
        }else{
          $error = "Failed to assign Target, try again later";
        }
      
    }

   $target_months = getAll('tbl_target_months');

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
                           <h4 class="page-title">Assigning Target to Customer</h4>
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
                                       <div class="col-md-6">
                                          <div class="form-group">
                                             <label for="customer_id">Choose Customer<span class="text-danger">*</span></label>
                                             <select name="customer_id" id="customer_id" class="form-control select2">
                                                <?php if(isset($customers) && count($customers) > 0){ ?>

                                                  <?php foreach($customers as $rs){ ?>

                                                      <option value="<?php echo $rs['customer_id']; ?>"><?php echo $rs['customer_name']; ?></option>

                                                  <?php } ?>
                                                <?php } ?>
                                             </select>
                                          </div>
                                       </div>
<!--                                        <div class="col-md-4">
                                          <div class="form-group">
                                             <label for="target_type">Choose Target Type<span class="text-danger">*</span></label>
                                             <select name="target_type" id="target_type" class="form-control select2">
                                                <option value="1">Monthly</option>
                                                <option value="2">Annually</option>
                                             </select>
                                          </div>
                                       </div>

 -->                                        <div class="col-md-6">
                                          <div class="form-group">
                                             <label for="target_year">Choose Year<span class="text-danger">*</span></label>
                                             <select name="target_year" id="target_year" class="form-control select2">
                                                <option value="2019">2019</option>
                                                <option value="2020">2020</option>
                                                <option value="2021">2021</option>
                                             </select>
                                          </div>
                                       </div>

                                       <div class="col-md-6">
                                          <div class="form-group">
                                             <label for="target_month">Choose Month<span class="text-danger">*</span></label>
                                             <select name="target_month" id="target_month" class="form-control select2">
                                              <?php if(isset($target_months) && count($target_months) > 0){ ?>

                                                  <?php foreach($target_months as $rs){ ?>

                                                      <option value="<?php echo $rs['month_id']; ?>"><?php echo $rs['month_name']; ?></option>

                                                  <?php } ?>
                                                <?php } ?>
                                             </select>
                                          </div>
                                       </div>            
                                     
                                        <div class="col-md-6">
                                          <div class="form-group">
                                             <label for="target_amount">Target Amount<span class="text-danger">*</span></label>
                                             <input name="target_amount" class="form-control" >
                                          </div>
                                       </div>
                                    </div>

                                    <div class="col-md-12 flag_target_achieved" style="display: none;">
                                      <label for="flag_target_achieved">
                                      <input type="checkbox" name="flag_target_achieved" id="flag_target_achieved"> Enter Previous Achieved Target 
                                      </label>
                                    </div>

                                    <div class="col-md-12 target_achieved_block m-t-10" style="display: none;">                                       
                                        <div class="form-group">
                                           <label for="target_category_achieved">Target Achieved Amount<span class="text-danger">*</span></label>
                                           <input name="target_category_achieved"  class="form-control" >
                                        </div>

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
                                
                                    <div class="col-md-12">
                                      
                                          <button name="submit" type="submit" class="btn btn-primary btn-bordered waves-effect w-md waves-light m-b-5">Assign</button>
                                       
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
        
        $('#customer_id').select2();
        $('#target_year').select2();
        $('#target_month').select2();

      </script>

   </body>
</html>
