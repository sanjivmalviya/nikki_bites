<?php
require_once('../../functions.php');
$login_id = $_SESSION['nb_credentials']['user_id'];

$products = getAll('tbl_product');

if(isset($_POST['submit'])){

   if($_POST['stock_type'] == '1'){
      
      $update = "UPDATE tbl_product SET product_stock = product_stock + '".$_POST['stock_quantity']."' WHERE product_id = '".$_POST['product_id']."' ";

   }else{
      
      $update = "UPDATE tbl_product SET product_stock = product_stock - '".$_POST['stock_quantity']."' WHERE product_id = '".$_POST['product_id']."' ";

   }

   if(query($update)){
   
      $form_data = array(
         'product_id' => $_POST['product_id'],
         'stock_type' => $_POST['stock_type'],
         'stock_quantity' => $_POST['stock_quantity'],
         'godown_id' => $login_id
      );
      insert('tbl_product_stock_history',$form_data);
      $success = "Stock Updated";

   }else{
      $error = "Something went wrong, Try again later";

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
                 <!--  <div class ="row">
                     <div class="col-xs-4 col-xs-offset-4 text-center">
                        <div class="page-title-box text-center">
                           <h4 class="page-title"> Assigning to Godown</h4>
                           <div class="clearfix"></div>
                        </div>
                     </div>
                  </div> -->
                  <div class="row">
                     <div class="col-sm-12 ">
                           <div class="row">

                              <div class="col-md-12">

                                 <form method="post">  
                                   
                                    <div class="row">

                                    <div class="col-md-4">
                                 
                                    <div class="form-group">
                                       
                                       <select name="product_id" class="form-control select2" required="">
                                          <option value="">--Select Product--</option>
                                          <?php if(isset($products)){ ?>
                                             <?php foreach($products as $rs){ ?>

                                                <option value="<?php echo $rs['product_id']; ?>"><?php echo $rs['product_name']; ?></option>

                                             <?php } ?>
                                          <?php } ?>

                                       </select>

                                    </div>
                                    </div>

                                    <div class="clearfix"></div>

                                   <div class="col-md-4">
                                    
                                       <div class="form-group">
                                          
                                          <input type="text" class="form-control" name="stock_quantity" placeholder="Enter Quantity">
                                          
                                       </div>
                                    </div>
                                    <div class="clearfix"></div>


                                    <div class="col-md-4">
                                 
                                    <div class="form-group">
                                       
                                       <select name="stock_type" class="form-control select2">
                                          
                                          <option value="1">Add Stock (+)</option>
                                          <option value="2">Remove Stock (-)</option>

                                       </select>

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
                                    <div class="col-md-2">
         


                                       <input type="submit" name="submit" class="btn btn-primary btn-sm" value="Submit" style="height: 35px;">
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