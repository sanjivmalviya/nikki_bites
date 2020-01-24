<?php

   require_once('../../functions.php');

   $login_id = $_SESSION['nb_credentials']['user_id'];
   $login_user_type = $_SESSION['nb_credentials']['user_type'];

   $products = getAll('tbl_product');

   if(isset($_POST['submit'])){

    $next_id = 'SELECT AUTO_INCREMENT FROM information_schema.TABLES WHERE TABLE_SCHEMA = "'.DB.'" AND TABLE_NAME = "tbl_orders" ';
    $next_id = getRaw($next_id);
    $next_id = $next_id[0]['AUTO_INCREMENT'];
    $order_number = 'ORD/'.sprintf('%05d',($next_id));
    
    $added_freight = $_POST['added_freight'];
    $added_discount = $_POST['added_discount'];
    $round_off = $_POST['round_off'];

    $form_data = array(
      'user_type' => $login_user_type,
      'user_id' => $login_id,
      'order_number' => $order_number,
      'added_freight' => $added_freight,
      'added_discount' => $added_discount,
      'round_off' => $round_off,
      'order_approve_status' => '1'
    );

    if(insert('tbl_orders',$form_data)){

        $last_id = last_id('tbl_orders','order_id');

        $i=0;
        foreach($_POST['product_id'] as $product_id){

            $form_data = array(
              'order_id' => $last_id,
              'order_product_id' => $product_id,
              'order_product_quantity' => $_POST['product_quantity'][$i],
              'order_product_discount' => $_POST['product_discount'][$i],
              'order_product_rate' => $_POST['product_rate'][$i]
            );
            
            if(insert('tbl_order_detail',$form_data)){
              $insert = '1';
            }

            $i++;
            
        }

        if($insert == '1'){
          $success = "Order created successfully";
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

                           <h4 class="page-title">Create Order</h4>

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
                                         $customers = getWhere('tbl_customer','added_by',$login_id);

                                       ?>

                                       <div class="col-md-4">c

                                          <div class="form-group">

                                             <label for="user_id">Select Customer<span class="text-danger">*</span></label>

                                             <select name="user_id" parsley-trigger="change" class="form-control select2" id="user_id">

                                              <?php foreach($customers as $rs){ ?>

                                                <option <?php if(isset($edit_data['user_id']) && $edit_data['user_id'] == $rs['customer_id']){ echo "selected";  } ?> value="<?php echo $rs['customer_id']; ?>"><?php echo $rs['customer_name']; ?></option>

                                              <?php } ?>

                                             </select>


                                          </div>

                                       </div>

                                      <?php }else if($login_user_type == '4'){ // customer ?>
                                        
                                             <input type="hidden" name="user_id" id="user_id" value="<?php echo $login_id; ?>">

                                      <?php } ?>

                                      
                                      <div class="col-md-12">
                                        
                                        <table style="width: 100%;" class="table-responsive table-bordered table-condensed table-hover">
                                          
                                          <thead>
                                            
                                            <th width="2%">Sr.</th>
                                            <th width="25%">Product</th>
                                            <th width="12%">GST</th>
                                            <th width="12%">Rate</th>
                                            <th width="10%">Qty</th>
                                            <th width="12%">Discount</th>
                                            <th width="15%">Amount</th>
                                            <th width="5%" class="text-center">Close</th>

                                          </thead>

                                          <tbody class="product_row">

                                            <td>1</td>

                                            <td>
                                              <select name="product_id[]" id="product_id_0" class="form-control select-product" data-id="0" required="">
                                                <option value="">--Select Product--</option>
                                                <?php if(isset($products)){ ?>
                                                <?php foreach($products as $rs){ ?>
                                                  <option value="<?php echo $rs['product_id']; ?>"><?php echo $rs['product_name']; ?></option>
                                                <?php } ?>
                                                <?php } ?>
                                              </select>
                                            </td>
                                            <td>
                                              <input type="text" class="form-control gst" readonly name="product_gst[]" id="product_gst_0" data-id="0">
                                            </td>
                                            <td>
                                              <input type="text" class="form-control" readonly name="product_rate[]" id="product_rate_0" data-id="0">
                                            </td>
                                            <td>
                                              <input type="number" class="form-control quantity" name="product_quantity[]" id="product_quantity_0" data-id="0">
                                            </td>
                                            <td>
                                              <input type="texxt" class="form-control discount" name="product_discount[]" id="product_discount_0" data-id="0">
                                            </td>
                                            <td>
                                              <input type="number" class="form-control amount" name="product_amount[]" id="product_amount_0" readonly="" data-id="0">
                                            </td>
                                            <td class="text-center"><i class="fa fa-close"></i></td>
                                            
                                          </tbody>

                                          <tr>
                                            <td colspan="6" class="text-right">Sub Total : </td>
                                            <td colspan="2"><span id="grand_total">0</span></td>
                                          </tr>

                                          <tbody class="tfoot">
                                          </tbody>

                                          
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

                                          <tr><td colspan="6" class="text-right">Grand Total : </td><td colspan="2"><span id="final_total">0</span></td>

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

                                          <button type="button" name="calculate" id="calculate" class="btn btn-success btn-bordered waves-effect w-md waves-light m-b-5">Calculate GST</button>
                                          
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

          $.ajax({

            url : 'ajax/get_customer_gst_type.php',
            type : 'POST',
            dataType : 'json',
            data : { customer_id : customer_id },
            success : function(data){
                $('#customer_gst_type').val(data.gst_type);

            }

          });

          $(document).on('click','#calculate', function(){

                  var gst_type = $('#customer_gst_type').val();

                  $('.tfoot').html('');
          
                 // Calculate GST
                  var gst = [];
                  $(".gst").each(function(){
                      gst.push(parseFloat($(this).val()));
                  });

                  var product_gst_amount = [];
                  var i=0;
                  $(".amount").each(function(){
                      product_gst = gst[i];
                      product_amount = parseFloat($(this).val());
                      var temp = (product_amount * product_gst / 100);                      
                      product_gst_amount.push(temp);
                      i++;
                  });

                  
                  var gst_total = 0;
                  var i =0;
                  var html_gst = '';

                  if(gst_type=='1'){

                      product_gst_amount.forEach(function(val){
                        var cgst_sgst = parseFloat(gst[i]) / 2;
                        var cgst_sgst_val = parseFloat(val) / 2;
                        html_gst += '<tr><td colspan="6" class="text-right">CGST('+cgst_sgst+' %) :  </td><td colspan="2">'+cgst_sgst_val+'</td></tr>';
                        html_gst += '<tr><td colspan="6" class="text-right">CGST('+cgst_sgst+' %) :  </td><td colspan="2">'+cgst_sgst_val+'</td></tr>';
                        gst_total += parseFloat(val);
                        i++;
                      });

                  }else{

                    product_gst_amount.forEach(function(val){
                        html_gst += '<tr><td colspan="6" class="text-right">IGST('+gst[i]+' %) : </td><td colspan="2">'+val+'</td></tr>';
                        gst_total += parseFloat(val);
                        i++;
                    });


                }
                $('.tfoot').append(html_gst);

                // Calculate Grand Total
                var grand_total = 0;
                $(".amount").each(function(){
                    grand_total += parseFloat($(this).val());
                });

                var total = grand_total + gst_total;
                $('#total').text(total);
                $('#total_val').val(total);

          
          });

          $(document).on('input','#added_freight,#added_discount,#round_off', function(){

                var total = parseFloat($('#total_val').val());

                var final_total = 0;
                var added_freight = parseFloat($('#added_freight').val());
                var added_discount = parseFloat($('#added_discount').val());
                var round_off = parseFloat($('#round_off').val());

                added_discount = (total * added_discount) / 100;
                final_total = total + added_freight + added_discount + round_off;
                $('#final_total').text(final_total);

          });


          $(document).on('input','.quantity,.discount', function(){
              

                  var row_id = $(this).attr('data-id');
                  // var product_quantity = $(this).val();
                  var product_quantity = $('#product_quantity_'+row_id).val();
                  var product_rate = $('#product_rate_'+row_id).val();
                  var product_discount = $('#product_discount_'+row_id).val();

                  var amount = product_rate * product_quantity;
                  var product_discount = (amount * product_discount) / 100;
                  var amount = amount - product_discount;

                  $('#product_amount_'+row_id).val(amount);

                  // Calculate Grand Total
                  var grand_total = 0;
                  $(".amount").each(function(){
                      grand_total += parseFloat($(this).val());
                  });
                  $('#grand_total').text(grand_total);
          });

          $(document).on('change','.select-product', function(){

              var row_id = $(this).attr('data-id');
              var product_id = $(this).val();
              var customer_id = $('#user_id').val();

              $.ajax({

                url : 'ajax/get_product_details.php',
                type : 'POST',
                dataType : 'json',
                data : { product_id : product_id, customer_id : customer_id },
                success : function(data){

                  // console.log(row_id);
                  $('#product_discount_'+row_id).val(data.product_discount);
                  $('#product_rate_'+row_id).val(data.product_billing_rate);
                  $('#product_gst_'+row_id).val(data.product_gst);

                }

              });

          });

        var row_count = 1;          
        $('.btn-add-product').on('click', function(){

            row_count++;

            $('.product_row').append('<tr><td>'+row_count+'</td><td><select name="product_id[]" id="product_'+row_count+'" class="form-control select-product" data-id="'+row_count+'" required><option value="">--Select Product--</option><?php if(isset($products)){ ?><?php foreach($products as $product) { ?> <option value="<?php echo $product['product_id']; ?>"><?php echo $product['product_name']; ?></option><?php } ?><?php } ?></select></td><td><input type="text" class="form-control gst" readonly name="product_gst[]" id="product_gst_'+row_count+'" data-id="'+row_count+'"></td><td><input type="text" data-id="'+row_count+'" name="product_rate[]" id="product_rate_'+row_count+'" class="form-control product_rate_" readonly></td><td><input type="number" data-id="'+row_count+'" name="product_quantity[]" id="product_quantity_'+row_count+'" class="form-control quantity"></td><td><input type="text" data-id="'+row_count+'" name="product_discount[]" id="product_discount_'+row_count+'" class="form-control discount" ></td><td><input type="text" id="product_amount_'+row_count+'" class="form-control amount" readonly="" data-id="'+row_count+'"></td><td class="text-center"><i class="fa fa-close"></i></td></tr>');

        });

      </script>

   </body>

</html>
