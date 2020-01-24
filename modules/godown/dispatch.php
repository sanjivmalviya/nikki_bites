<?php



require_once('../../functions.php');

$login_id = $_SESSION['nb_credentials']['user_id'];


$order_id = $_GET['order_id'];

// $order = getOne('tbl_orders','order_id',$order_id);
// $order = "SELECT * FROM  WHERE order_id = '".$order_id."' ";
$order = getOne('tbl_orders','order_id',$order_id);

$order_time = date('h:i:s', strtotime($order['created_at']));
$order_date = date('Y-m-d', strtotime($order['created_at']));
$order_number = $order['order_number'];
$transport_by = $order['transport_by'];
$sales_person = getOne('tbl_sales_person','sales_person_id',$order['sales_person_id']);
$sales_person_name = $sales_person['sales_person_name'];

// $orders = "SELECT * FROM tbl_order_detail WHERE order_id = '$order_id' AND godown_id = '$godown_id' ";

// $orders = getRaw($orders);



if(isset($_POST['submit'])){



  // generate invoice number
     
   $previous_invoice_number = "SELECT invoice_number FROM tbl_invoices ORDER BY invoice_id DESC LIMIT 1";
  

   if($rs = getRaw($previous_invoice_number)){

      $previous_invoice_number = $rs[0]['invoice_number'];

      $invoice_number = substr($previous_invoice_number,3)+1;

      $invoice_number = "INV".$invoice_number;

   }else{

      $invoice_number = "INV1";

   }

   $form_data = array(

      'order_id' => $order_id,

      'invoice_number' => $invoice_number,

      'invoice_date' => $_POST['invoice_date'],

      'invoice_delivery_note' => $_POST['invoice_delivery_note'],

      // 'invoice_terms_of_payment' => $_POST['invoice_terms_of_payment'],

      'invoice_supplier_reference' => $_POST['invoice_supplier_reference'],

      'invoice_other_reference' => $_POST['invoice_other_reference'],

      'invoice_buyer_order_number' => $_POST['invoice_buyer_order_number'],

      'invoice_buyer_order_date' => $_POST['invoice_buyer_order_date'],

      'invoice_dispatch_document_number' => $_POST['invoice_dispatch_document_number'],

      'invoice_delivery_note_date' => $_POST['invoice_delivery_note_date'],

      'invoice_dispatch_through' => $_POST['invoice_dispatch_through'],

      'invoice_dispatch_destination' => $_POST['invoice_dispatch_destination'],

      'transport_by' => $_POST['transport_by'],

      'added_freight' => $_POST['added_freight'],

      'added_discount' => $_POST['added_discount'],

      // 'round_off' => $_POST['round_off'],

      'invoice_driver_name' => $_POST['invoice_driver_name'],

      'invoice_gate_pass_number' => $_POST['invoice_gate_pass_number'],

      'invoice_vehicle_number' => $_POST['invoice_vehicle_number'],

      'invoice_driver_contact_number' => $_POST['invoice_driver_contact_number']

   );


   if(insert('tbl_invoices',$form_data)){

      $last_id = last_id('tbl_invoices','invoice_id');
      $i=0;

     // 4 - SEND SMS TO ADMIN THAT YOU HAVE RECIEVED AN ORDER
     $getGodownDetails = getOne('tbl_godown','godown_id',$login_id);
     $getAdminDetails = getOne('tbl_admins','admin_id',$getGodownDetails['added_by']);
     $admin_mobile = $getAdminDetails['admin_mobile'];
     $getOrderDetails = getOne('tbl_orders','order_id',$order_id);
     $message = "New Invoice created as #".$invoice_number." for Order Number #".$getOrderDetails['order_number']." ";
     sendSMS($admin_mobile,$message);


      foreach($_POST['quantity'] as $rs){

            $order_detail_id = $_POST['order_detail_ids'][$i];
            $order_product_id = $_POST['order_product_ids'][$i];       

            if($rs > 0){
            
                $addInvoiceDetail = "INSERT INTO tbl_invoice_detail(invoice_id,order_id,order_detail_id,dispatch_quantity) VALUES('$last_id','$order_id','".$order_detail_id."','".$rs."')";
                
               // $updateOrderStoc = "UPDATE tbl_order_detail SET order_dispatch_quantity = order_dispatch_quantity + ".$rs." WHERE order_detail_id = '".$order_detail_id."' ";
            
               $updateProductStock = "UPDATE tbl_product SET product_stock = product_stock - ".$rs." WHERE product_id = '".$order_product_id."' ";

               $form_data = array(
                  'product_id' => $order_product_id,
                  'stock_type' => '2',
                  'stock_quantity' => $rs,
                  'godown_id' => $login_id
               ); 
               
               insert('tbl_product_stock_history',$form_data);
               query($addInvoiceDetail);
               query($updateProductStock);

               // if(query($insert)){

               //    $success = "Order Dispatched";

               //    // $updated_qty = getOne('tbl_order_detail','order_detail_id',$order_detail_id);                 

               //    // if($updated_qty['order_product_quantity'] == $updated_qty['order_dispatch_quantity']){

               //    //    $update_qty = "UPDATE tbl_orders SET order_dispatch_status = '2' WHERE order_id = '".$order_id."' ";

               //    // }else{

               //    //    $update_qty = "UPDATE tbl_orders SET order_dispatch_status = '1' WHERE order_id = '".$order_id."' ";

               //    // }

               //    // echo $update_qty;
               //    // exit;

               //    // query($update_qty);



               // }else{

               //    $error = "Something went wrong, try again later";            

               // }


               

            }
         $i++;



      }
      


      $required_quantity = "SELECT SUM(order_product_quantity) as required_quantity FROM tbl_order_detail WHERE order_id = '$order_id' "; 
      $required_quantity = getRaw($required_quantity);
      $required_quantity = $required_quantity[0]['required_quantity'];

      $dispatched_quantity = "SELECT SUM(dispatch_quantity) as dispatched_quantity FROM tbl_invoice_detail WHERE order_id = '$order_id' "; 
      $dispatched_quantity = getRaw($dispatched_quantity);
      $dispatched_quantity = $dispatched_quantity[0]['dispatched_quantity'];
   
      if($required_quantity == $dispatched_quantity){

         // fully disaptched
         $update_order = "UPDATE tbl_orders SET order_dispatch_status = '1' WHERE order_id = '$order_id' ";
         query($update_order);
         $success = "Dispatched";

      }else{

         // partially disaptched
         $update_order = "UPDATE tbl_orders SET order_dispatch_status = '2' WHERE order_id = '$order_id' ";
         query($update_order);
         $error = "Partially Dispatched";

      }

   }else{

      $error = "Failed to Process, try again later";

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

                           <h4 class="page-title">Order Dispatching</h4>

                           <div class="clearfix"></div>

                        </div>

                     </div>

                  </div>

                  <div class="row">

                     <div class="col-sm-12">

                        <div class="card-box">

                           <a href="../../modules/godown/orders.php" class="btn btn-sm btn-default"><i class="fa fa-angle-left" style="font-size: 20px;"></i></a>

                           <form method="post">
                          
                           <div class="row" style="margin-top: 20px;">                              

                              <div class="col-md-6 form-group">
                                 <label for="">Invoice Date</label>
                                 <input type="date" class=" form-control" name="invoice_date" placeholder="invoice date" style="padding:10px;" value="<?php echo date('Y-m-d'); ?>">
                              </div>

                              <div class="col-md-6 form-group">
                                 <label for="">Delivery Note</label>
                                 <input type="text" class="form-control" name="invoice_delivery_note" placeholder="delivery note">

                              </div>

                              <div class="col-md-6 form-group">
                                 <label for="">Supplier Reference</label>
                                 <input type="text" class="form-control" name="invoice_supplier_reference" placeholder="supplier reference" value="<?php echo $sales_person_name; ?>">
                              </div>

                              <div class="col-md-6 form-group">
                                 <label for="">Other Reference</label>
                                 <input type="text" class="form-control" name="invoice_other_reference" placeholder="other reference" value="<?php echo $order_time; ?>">
                              </div>

                              <div class="col-md-6 form-group">
                                 <label for="">Buyer Order Number</label>
                                 <input type="text" class="form-control" name="invoice_buyer_order_number" placeholder="buyer order number" value="<?php echo $order_number; ?>">
                              </div>

                              <div class="col-md-6 form-group">
                                 <label for="">Buyer Order Date</label>
                                 <input type="date" class="form-control " name="invoice_buyer_order_date" placeholder="buyer order date" value="<?php echo $order_date; ?>">
                              </div>

                              <div class="col-md-6 form-group">
                                 <label for="">Dispatch Document Number</label>
                                 <input type="text" class="form-control" name="invoice_dispatch_document_number" placeholder="dispatch document number">
                              </div>

                              <div class="col-md-6 form-group">
                                 <label for="">Delivery Note Date</label>
                                 <input type="date" class="form-control " name="invoice_delivery_note_date" placeholder="delivery note date">
                              </div>

                              <div class="col-md-6 form-group">
                                 <label for="">Dispatch Through</label>
                                 <input type="text" class="form-control" name="invoice_dispatch_through" placeholder="dispatch through">
                              </div>

                              <div class="col-md-6 form-group">
                                 <label for="">Dispatch Destination</label>
                                 <input type="text" class="form-control" name="invoice_dispatch_destination" placeholder="dispatch destination">
                              </div>

                              <div class="col-md-6 form-group">
                                 <label for="">Transport By</label>
                                 <input type="text" class="form-control" name="transport_by" placeholder="transport by" value="<?php echo $transport_by; ?>">
                              </div>

                              <div class="col-md-6 form-group">
                                 <label for="">Driver Name</label>
                                 <input type="text" class="form-control" name="invoice_driver_name" placeholder="invoice driver name" value="<?php echo $invoice_driver_name; ?>">
                              </div>

                              <div class="col-md-6 form-group">
                                 <label for="">Gate Pass Number</label>
                                 <input type="text" class="form-control" name="invoice_gate_pass_number" placeholder="invoice gate pass number" value="<?php echo $invoice_gate_pass_number; ?>">
                              </div>

                              <div class="col-md-6 form-group">
                                 <label for="">Vehicle Number</label>
                                 <input type="text" class="form-control" name="invoice_vehicle_number" placeholder="invoice vehicle number" value="<?php echo $invoice_vehicle_number; ?>">
                              </div>

                              <div class="col-md-6 form-group">
                                 <label for="">Driver Contact Number</label>
                                 <input type="text" class="form-control" name="invoice_driver_contact_number" placeholder="invoice driver contact number" value="<?php echo $invoice_driver_contact_number; ?>">
                              </div>

                           </div>
                       

                           <div class="row">

                                 <table class="table table-striped table-bordered table-condensed table-hover" style="margin-top: 50px;">                                    

                                    <thead>

                                       <th>Sr.</th>

                                       <th>Product</th>

                                       <th class="text-center">Required Quantity</th>

                                       <th class="text-center">Dispatched Quantity</th>

                                       <th class="text-center">Enter Quantity</th>

                                       <th class="text-center">Status</th>

                                    </thead>


                                    <tbody>
                                       
                                       <?php  

                                          $order_details = getWhere('tbl_order_detail','order_id',$order_id);

                                          if(isset($order_details) && count($order_details) > 0){ 

                                              $i=1; foreach($order_details as $rs){ 

                                                $dispatched_quantity = getOne('tbl_invoice_detail','order_detail_id',$rs['order_detail_id']);

                                                $dispatched_quantity = "SELECT IFNULL(SUM(disp.dispatch_quantity),0) AS dispatched_quantity FROM tbl_invoice_detail disp WHERE order_id = '".$rs['order_id']."' AND order_detail_id = '".$rs['order_detail_id']."' ";

                                                $dispatched_quantity = getRaw($dispatched_quantity);

                                                $dispatched_quantity = $dispatched_quantity[0]['dispatched_quantity'];

                                          ?>

                                           <tr class="<?php if($rs['order_product_quantity'] == $dispatched_quantity){ echo "text-muted"; } ?>">

                                             <td><?php echo $i++; ?></td>

                                             <td width="30%"><?php 

                                                $product_name = getOne('tbl_product','product_id',$rs['order_product_id']);

                                                echo $product_name['product_name']; 

                                                echo "<p><small><i> Last Dispatched : ". date('d-M-Y h:i',strtotime($rs['dispatched_at']))."</i></small></p>";

                                             ?>

                                             <input type="hidden" name="order_product_ids[]" value="<?php echo $rs['order_product_id']; ?>">

                                             </td>                                    

                                             <td class="text-center"><?php echo $rs['order_product_quantity']; ?></td>

                                             <td class="text-center"><?php if($dispatched_quantity == ""){ echo '0'; }else { echo $dispatched_quantity; } ?></td>
 
                                             <td class="text-center"> <?php 

                                             $product_remaining_stock = getOne('tbl_product','product_id',$rs['order_product_id']);
                                                $product_remaining_stock = $product_remaining_stock['product_stock'];

                                             $remaining_quantity = $rs['order_product_quantity'] - $dispatched_quantity; 

                                             if($remaining_quantity <= $product_remaining_stock){
                                                $quantity_threshold = $remaining_quantity;
                                             }else{
                                                $quantity_threshold = $product_remaining_stock;
                                             }

                                             if($dispatched_quantity == $rs['order_product_quantity']){ ?> <input readonly="" type="number" name="quantity[]" class="form-control" value="0"> <?php }else{ ?> <input type="number" name="quantity[]" class="form-control" max="<?php echo $quantity_threshold; ?>" placeholder="Threshold Value: <?php echo $quantity_threshold; ?>"> <?php } ?> </td>


                                             <?php if($rs['order_product_quantity'] != $dispatched_quantity){ ?>

                                                <td width="20%" class="text-center">

                                                <h5 class="text-primary">Pending</h5>

                                                </td>



                                          <?php }else{ ?>

                                             <td width="20%" class="text-center">

                                                <h5 class="text-primary">Dispatched</h5>

                                             </td>



                                          <?php } ?>

                                          <input type="hidden" name="order_detail_ids[]" value="<?php echo $rs['order_detail_id']; ?>">

                                          </tr>

                                          <?php $i++; } ?>



                                       <?php } ?>



                                    </tbody>



                                 </table>

                                 <div class="col-md-12">
                                    
                                    <div class="col-md-4">
                                       <input type="number" class="form-control" name="added_freight" id="added_freight" placeholder="freight amount">
                                    </div>
                                    <div class="col-md-4">
                                       <input type="number" class="form-control" name="added_discount" id="added_discount" placeholder="discount in %">
                                    </div>
                                    <!-- <div class="col-md-4">
                                       <input type="number" class="form-control" name="round_off" id="round_off" placeholder="round off">
                                    </div> -->
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



                                 <div class="col-md-12 text-center">

                                       <button type="submit" name="submit" class="btn btn-primary btn-sm"><i class="fa fa-truck"></i> Dispatch</button>

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

         

         $('.datepicker').datepicker();



      </script>



   </body>

</html>
