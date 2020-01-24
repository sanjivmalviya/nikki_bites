<?php

 require_once('../../functions.php'); 

 $login_id = $_SESSION['nb_credentials']['user_id'];
 $login_type = $_SESSION['nb_credentials']['user_type'];


 if($login_type == 3){

   $admin_id = getOne('tbl_customer','customer_id',$login_id);
   $admin_id = $admin_id['added_by'];

 }else{
 
   $admin_id = $login_id;
 
 }

 $products = getRaw("SELECT * FROM tbl_product WHERE added_by = '".$admin_id."' ORDER BY product_id DESC");

 $table_name = 'tbl_product';

 $field_name = 'product_id';


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

                           <h4 class="page-title">Products</h4>

                           <div class="clearfix"></div>

                        </div>

                     </div>

                  </div>

                  <div class="row">

                     <div class="col-sm-12">

                        <div class="card-box">

                           <div class="row">



                                 <table id="products" class="table table-striped table-bordered table-condensed table-hover" style="margin-top: 50px;">

                                    

                                    <thead>

                                       <th>Sr.</th>

                                       <th>Category</th>

                                       <th>Product Name</th>
                                       
                                       <th>Current Stock</th>

                                       <th>Packaging</th>

                                       <th>Billing Rate</th>

                                       <th>GST</th>

                                       <th>HSN Code</th>

                                       <th>Batch Number</th>

                                       <th>Discount</th>

                                       <th>Unit</th>

                                       <?php if($login_type != 3){ ?>

                                       <th class="text-right">Actions</th>

                                       <?php } ?>

                                    </thead>



                                    <tbody>

                                       

                                       <?php if(isset($products) && count($products) > 0){ ?>



                                          <?php $i=1; foreach($products as $rs){ ?>



                                          <tr>

                                             <td><?php echo $i++; ?></td>

                                             <td><?php 

                                             

                                              $category_name = getOne('tbl_category','category_id',$rs['category_id']); 

                                              echo $category_name = $category_name['category_name'];



                                             ?></td>                                    

                                             <td><?php echo $rs['product_name']; ?></td>
                                             <td class="text-center">
                                                <a href="stock_history.php?product_id=<?php echo $rs['product_id']; ?>"><?php echo $rs['product_stock']; ?></a>
                                             </td>

                                             <td>

                                                <?php 

                                                   $packing_name = getOne('tbl_packing','packing_id',$rs['product_packaging']);

                                                   echo $packing_name['packing_name']; 

                                                ?>                                                   

                                             </td>                                    

                                             <td><?php echo $rs['product_billing_rate']; ?></td>                                    

                                             <td><?php echo $rs['product_gst']; ?></td>

                                             <td><?php echo $rs['product_hsn_code']; ?></td>                                    

                                             <td><?php echo $rs['product_batch_number']; ?></td>                                    

                                             <td>

                                                <?php 
                                                if($rs['product_discount'] == '0' || $rs['product_discount'] == ''){

                                                   echo "<span class='text-muted'><i>No Discount</i></span>";
                                                
                                                }else{
                                                   echo "<span class='text-primary'>".$rs['product_discount']."</span>";
                                                }
                                                ?>
                                                
                                             </td>                                    

                                             <td>

                                                <?php 

                                                   $unit_name = getOne('tbl_unit','unit_id',$rs['product_unit']);

                                                   echo $unit_name['unit_name']; 

                                                ?>                                                   

                                             </td>

                                             <?php if($login_type != 3){ ?>
                                             <td>

                                                <a href="add.php?edit_id=<?php echo $rs['product_id']; ?>"><i class="fa fa-pencil"></i></a>

                                                <a href="view.php?delete_id=<?php echo $rs['product_id']; ?>" onclick=" return confirm('Are you sure ?'); "><i class="fa fa-trash"></i></a>

                                             </td>
  
                                          <?php } ?>

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
