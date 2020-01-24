<?php

require_once('../../functions.php');

$login_id = $_SESSION['nb_credentials']['user_id'];

if(isset($_POST['submit'])){

   $start_date = date('Y-m-d', strtotime($_POST['start_date']));
   $end_date = date('Y-m-d', strtotime($_POST['end_date']));
   
   $purchase_orders = "SELECT * FROM tbl_purchase_orders WHERE admin_id = '$login_id' AND created_at BETWEEN '$start_date' AND '$end_date'  ";
   
}else{
   
   $purchase_orders = "SELECT * FROM tbl_purchase_orders WHERE admin_id = '$login_id' ";
   
}

$purchase_orders = getRaw($purchase_orders);


$table_name = 'tbl_purchase_orders';
$field_name = 'id';

if(isset($_GET['delete_id'])){
      
if(delete($table_name,$field_name,$_GET['delete_id'])){
   $success = "Record Deleted Successfully";
   header('location:view_purchase_order.php');
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
                  <div class ="row">
                     <div class="col-xs-12">
                        <div class="page-title-box">
                           <h4 class="page-title">View Purchase Orders</h4>
                           <div class="clearfix"></div>
                        </div>
                     </div>
                  </div>
                  <div class="row">

                   
                     
                     <div class="col-sm-12">
                        <div class="card-box">



                           <div class="row">


                                 <form method="post">            
                                    <div class="col-md-4">
                                                   
                                          <input type="date" class="form-control" name="start_date">

                                    </div>

                                    <div class="col-md-4">
                                                   
                                          <input type="date" class="form-control" name="end_date">

                                    </div>

                                    <div class="col-md-4">
                                                   
                                       <button type="submit" name="submit" class="btn btn-primary"><i class="fa fa-filter"></i> Filter</button>

                                    </div>
                                 </form>

                                 <div class="col-md-12" style="margin-top: 20px;">
                                    <?php if(isset($start_date) && isset($end_date)){ echo "Order(s) between <i class='text-primary'>".$start_date."</i> AND <i class='text-primary'>".$end_date."</i>"; }else{ echo "All Orders"; } ?><h4></h4>
                                 </div>
                           
                                 <table class="table table-striped table-bordered table-condensed table-hover" style="margin-top: 50px;">
                                    
                                    <thead>
                                       <th>Sr.</th>
                                       <th>Vendor</th>
                                       <th>P.O. Date</th>
                                       <th>P.O. Number</th>
                                       <th>Invoice Number</th>
                                       <th>Dispatch Through</th>
                                       <th>Dispatch By</th>
                                       <th>Transport By</th>                                       
                                       <th>Vehicle Number</th>
                                       <th>Remarks</th>
                                       <th>Created at</th>
                                       <th>Actions</th>
                                    </thead>
   
                                    <tbody>
                                       
                                       <?php if(isset($purchase_orders) && count($purchase_orders) > 0){ ?>

                                          <?php $i=1; foreach($purchase_orders as $rs){ ?>

                                          <tr>
                                             <td><?php echo $i++; ?></td>    
                                             <td>

                                                <?php

                                                   $vendor_name = getOne('tbl_vendors','vendor_id',$rs['vendor_id']);
                                                   echo $vendor_name['vendor_name'];

                                                ?>

                                             </td>
                                             <td><?php echo $rs['po_date']; ?></td>   
                                             <td><?php echo $rs['po_number']; ?></td>   
                                             <td><?php echo $rs['invoice_number']; ?></td>   
                                             <td><?php echo $rs['dispatch_through']; ?></td>   
                                             <td><?php echo $rs['dispatch_by']; ?></td>   
                                             <td><?php echo $rs['transport_by']; ?></td>   
                                             <td><?php echo $rs['vehicle_number']; ?></td>   
                                             <td><?php echo $rs['remarks']; ?></td>   
                                             <td><?php echo $rs['created_at']; ?></td>   
                                             <td class="text-center">
                                                
                                                <!-- <a href="detail.php?order_id=<?php echo $rs['order_id']; ?>" class="text-primary"><i class="fa fa-eye" style="font-size: 20px;"></i></a>  -->
                                                <!-- <a href="edit.php?order_id=<?php echo $rs['order_id']; ?>" class="text-success"><i class="fa fa-pencil" style="font-size: 20px;"></i></a>  -->

                                                <a href="view_purchase_order.php?delete_id=<?php echo $rs['id']; ?>" class="text-danger"><i class="fa fa-trash" style="font-size: 20px;"></i></a>
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