<?php

   require_once('../../functions.php');

   $login_id = $_SESSION['nb_credentials']['user_id'];
   $login_user_type = $_SESSION['nb_credentials']['user_type'];

   $products = getAll('tbl_product');

    $next_id = 'SELECT AUTO_INCREMENT FROM information_schema.TABLES WHERE TABLE_SCHEMA = "'.DB.'" AND TABLE_NAME = "tbl_purchase_orders" ';
    $next_id = getRaw($next_id);
    $next_id = $next_id[0]['AUTO_INCREMENT'];
    $po_number = 'PO/'.sprintf('%05d',($next_id));

   if(isset($_POST['submit'])){

    
    $form_data = array(
        'admin_id' => $login_id,      
        'vendor_id' => $_POST['vendor_id'],      
        'po_date' => $_POST['po_date'],      
        'po_number' => $po_number,      
        'invoice_number' => $_POST['invoice_number'],      
        'dispatch_through' => $_POST['dispatch_through'],      
        'dispatch_by' => $_POST['dispatch_by'],      
        'transport_by' => $_POST['transport_by'],      
        'vehicle_number' => $_POST['vehicle_number'],      
        'remarks' => $_POST['remarks'],      
    );

    if(insert('tbl_purchase_orders',$form_data)){

        $last_id = last_id('tbl_purchase_orders','id');

        $i=0;
        foreach($_POST['product_name'] as $product_name){

           $product_gst_amount = 0;
           $product_gst_amount = $_POST['product_qty'][$i] * $_POST['product_per_qty'][$i] ;
           $product_discount_amount = $product_gst_amount * $_POST['product_discount'][$i] / 100;
           $product_gst_amount = $product_gst_amount - $product_discount_amount;
           $product_gst_amount = $product_gst_amount * $_POST['product_gst'][$i] / 100;

            $form_data = array(
              'purchase_order_id' => $last_id,
              'product_name' => $product_name,
              'product_hsn' => $_POST['product_hsn'][$i],
              'product_qty' => $_POST['product_qty'][$i],
              'product_per_qty' => $_POST['product_per_qty'][$i],
              'product_discount' => $_POST['product_discount'][$i],
              'product_gst' => $_POST['product_gst'][$i],
              'product_gst_amount' => $product_gst_amount
            );
            
            if(insert('tbl_purchase_order_detail',$form_data)){
              $insert = '1';
            }

            $i++;
            
        }

        if($insert == '1'){
          $success = "Purchase Order created successfully";
        }else{
          $error = "Something went wrong, please try again later";
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

                           <h4 class="page-title">Create Purchase Order</h4>

                           <div class="clearfix"></div>

                        </div>

                     </div>                   

                  </div>

                  <div class="row">   

                     

                     <div class="col-sm-12">

                        <div class="card-box">

                           <div class="row">

                               <form method="post" class="form-horizontal" enctype="multipart/form-data">

                                 <div class="col-md-12">

                                    <div class="row">

                                       <?php 
                                       
                                         if($login_user_type == '2'){

                                         // admin
                                         $vendors = getWhere('tbl_vendors','added_by',$login_id);

                                       ?>

                                       <div class="col-md-4">

                                          <div class="form-group">

                                             <label for="vendor_id">Select Vendor<span class="text-danger">*</span></label>

                                             <select name="vendor_id" parsley-trigger="change" class="form-control select2" id="vendor_id">

                                              <?php foreach($vendors as $rs){ ?>

                                                <option value="<?php echo $rs['vendor_id']; ?>"><?php echo $rs['vendor_name']; ?></option>

                                              <?php } ?>

                                             </select>


                                          </div>

                                       </div>

                                       <!-- <div class="clearfix"></div> -->

                                       <div class="col-md-4">

                                          <div class="form-group">

                                             <label for="po_date">Order Date <span class="text-danger">*</span></label>

                                               <input type="date" class="form-control" name="po_date" id="po_date" value="<?php echo date('Y-m-d'); ?>">

                                          </div>

                                       </div>

                                       <div class="col-md-4">

                                          <div class="form-group">

                                             <label for="po_number">Purchase Order Number <span class="text-danger">*</span></label>

                                               <input type="text" class="form-control" name="po_number" id="po_number" value="<?php echo $po_number; ?>" readonly>

                                          </div>

                                       </div>

                                       <div class="col-md-4">

                                          <div class="form-group">

                                             <label for="invoice_number">Invoice Number</label>

                                               <input type="text" class="form-control" name="invoice_number" id="invoice_number">

                                          </div>

                                       </div>

                                       <div class="col-md-4">

                                          <div class="form-group">

                                             <label for="dispatch_through">Dispatch Through</label>

                                               <input type="text" class="form-control" name="dispatch_through" id="dispatch_through">

                                          </div>

                                       </div>

                                       <div class="col-md-4">

                                          <div class="form-group">

                                             <label for="dispatch_by">Dispatch By</label>

                                               <input type="text" class="form-control" name="dispatch_by" id="dispatch_by">

                                          </div>

                                       </div>

                                       <div class="col-md-4">

                                          <div class="form-group">

                                             <label for="transport_by">Transport By</label>

                                               <input type="text" class="form-control" name="transport_by" id="transport_by">

                                          </div>

                                       </div>

                                       <div class="col-md-4">

                                          <div class="form-group">

                                             <label for="vehicle_number">Vehicle Number</label>

                                               <input type="text" class="form-control" name="vehicle_number" id="vehicle_number">

                                          </div>

                                       </div>

                                       <div class="col-md-4">

                                          <div class="form-group">

                                             <label for="remarks">Remarks</label>

                                               <textarea class="form-control" name="remarks" id="remarks"></textarea>

                                          </div>

                                       </div>

                                       

                                      <?php }else if($login_user_type == '4'){ // customer ?>
                                        
                                             <input type="hidden" name="user_id" id="user_id" value="<?php echo $login_id; ?>">

                                      <?php } ?>

                                      
                                      <div class="col-md-12">
                                        
                                        <table style="width: 100%;" class="table-responsive table-bordered table-condensed table-hover">
                                          
                                          <thead>
                                            
                                            <th width="2%">Sr.</th>
                                            <th width="25%">Product Name</th>
                                            <th width="12%">HSN Code</th>
                                            <th width="12%">QTY</th>
                                            <th width="10%">Price Per QTY</th>
                                            <th width="12%">Discount</th>
                                            <th width="10%">GST</th>
                                            <th width="10%" class="text-center">Total</th>
                                            <th class="text-center">X</th>

                                          </thead>

                                          <tbody class="product_row">

                                            <td>1</td>

                                            <td>
                                              <input type="text" class="form-control product_name"  name="product_name[]" id="product_name_0" data-id="0">
                                            </td>
                                            <td>
                                              <input type="text" class="form-control product_hsn"  name="product_hsn[]" id="product_hsn_0" data-id="0">
                                            </td>
                                            <td>
                                              <input type="text" class="form-control product_qty"  name="product_qty[]" id="product_qty_0" data-id="0">
                                            </td>
                                            <td>
                                              <input type="text" class="form-control product_per_qty" name="product_per_qty[]" id="product_per_qty_0" data-id="0">
                                            </td>
                                            <td>
                                              <input type="text" class="form-control product_discount" name="product_discount[]" id="product_discount_0" data-id="0">
                                            </td>
                                            <td>
                                              <input type="text" class="form-control product_gst" name="product_gst[]" id="product_gst_0" data-id="0">
                                            </td>
                                            <td>
                                              <input type="text" class="form-control product_total" readonly="" id="product_total_0" data-id="0" name="product_total[]">
                                            </td>
                                            <td class="text-center" width="2%"><i class="fa fa-close"></i></td>
                                          </tbody>

                                          <tr>
                                            <td colspan="7" class="text-right">Total : </td>
                                            <td colspan="2"><span id="grand_total">0</span></td>
                                          </tr>

                                          <tbody class="tfoot">
                                          </tbody>

                                          <!-- 
                                          <tr><td colspan="6" class="text-right">Total (Including GST) : </td><td colspan="2"><span id="total">0</span> <input type="hidden" id="total_val"></td>
  
                                          <tr>
                                            <td colspan="6" class="text-right">Freight : </td>
                                            <td colspan="2"><input type="text" name="added_freight" id="added_freight" value="0"></td>
                                          </tr>
                                          <tr>
                                            <td colspan="6" class="text-right">Discount (%) : </td>
                                            <td colspan="2"><input type="text" name="added_discount" id="added_discount" value="0"></td>
                                          </tr>
                                          <tr>
                                            <td colspan="6" class="text-right">Round Off : </td>
                                            <td colspan="2"><input type="text" name="round_off" id="round_off" value="0"></td>
                                          </tr>

                                          <tr><td colspan="6" class="text-right">Grand Total : </td><td colspan="2"><span id="final_total">0</span></td> -->

                                        </table>

                                      </div>

                                      <div class="col-md-12 text-right m-t-10">
                                        <input type="button" class="btn btn-info btn-add-product" value="+ Add Row">
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

                                       <div class="col-md-12" align="center">

                                          <input type="hidden" id="customer_gst_type" name="customer_gst_type">

                                          
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
          
          var customer_id = $('#user_id').val();
          $('#vendor_id').select2();

          $.ajax({

            url : 'ajax/get_customer_gst_type.php',
            type : 'POST',
            dataType : 'json',
            data : { customer_id : customer_id },
            success : function(data){
                $('#customer_gst_type').val(data.gst_type);

            }

          });

          $(document).on('input','.product_qty,.product_per_qty,.product_discount,.product_gst', function(){
              

                  var row_id = $(this).attr('data-id');
                  
                  // var product_quantity = $(this).val();
                  var product_quantity = $('#product_qty_'+row_id).val();
                  var product_per_qty = $('#product_per_qty_'+row_id).val();
                  var product_discount = $('#product_discount_'+row_id).val();
                  var product_gst = $('#product_gst_'+row_id).val();

                  var amount = product_per_qty * product_quantity;
                  var product_discount = (amount * product_discount) / 100;
                  var amount = amount - product_discount;
                  var product_gst = (amount * product_gst) / 100;
                  var amount = amount + product_gst;

                  $('#product_total_'+row_id).val(amount);

                  // Calculate Grand Total
                  var grand_total = 0;
                  $(".product_total").each(function(){
                      grand_total += parseFloat($(this).val());
                  });
                  $('#grand_total').text(grand_total);
          });

        var row_count = 1;          

        $('.btn-add-product').on('click', function(){

            row_count++;

            $('.product_row').append('<tr id="tr_'+row_count+'"><td>'+row_count+'</td><td><input type="text" class="form-control product_name"  name="product_name[]" id="product_name_'+row_count+'" data-id="'+row_count+'"></td><td><input type="text" class="form-control product_hsn"  name="product_hsn[]" id="product_hsn_'+row_count+'" data-id="'+row_count+'"></td><td><input type="text" class="form-control product_qty"  name="product_qty[]" id="product_qty_'+row_count+'" data-id="'+row_count+'"></td><td><input type="text" class="form-control product_per_qty" name="product_per_qty[]" id="product_per_qty_'+row_count+'" data-id="'+row_count+'"></td><td><input type="text" class="form-control product_discount" name="product_discount[]" id="product_discount_'+row_count+'" data-id="'+row_count+'"></td><td><input type="text" class="form-control product_gst" name="product_gst[]" id="product_gst_'+row_count+'" data-id="'+row_count+'"></td><td><input type="text" class="form-control product_total" readonly="" id="product_total_'+row_count+'" data-id="'+row_count+'" name="product_total[]"></td><td class="text-center"><i class="fa fa-close close" data-id="'+row_count+'"></i></td></tr>');

        });

        $(document).on('click','.close', function(){

            var id = $(this).attr('data-id');
            $('#tr_'+id).remove();

            // Calculate Grand Total
            var grand_total = 0;
            $(".product_total").each(function(){
                grand_total += parseFloat($(this).val());
            });
            $('#grand_total').text(grand_total);


        });

      </script>

   </body>

</html>
