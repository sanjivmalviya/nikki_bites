<?php 

   require_once('../../functions.php');
   $invoice_id = $_GET['invoice_id'];

   $invoice = getOne('tbl_invoices','invoice_id',$invoice_id);
   $invoice_details = getWhere('tbl_invoice_detail','invoice_id',$invoice['invoice_id']);
   $order = getOne('tbl_orders','order_id',$invoice['order_id']);
   $order_details = getOne('tbl_order_detail','order_id',$invoice['order_id']);
   $customer = getOne('tbl_customer','customer_id',$order['user_id']);
  
   $owner = getRaw('SELECT * FROM tbl_owner ORDER BY owner_id DESC LIMIT 1');

?>
<html>
 <head>
    
  <title>Tax Invoice</title>

  <link rel="stylesheet" href="bootstrap.min.css">
  
  <!--  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script> -->

 <style type="text/css" media="screen">

  .address-details h3 {
       font-size: 20px;
    color: #0d8800;
    font-weight: 700;
  }

  .address-details h5 {
    font-size: 16px;
  }

  .address-details p {
    font-size: 14px;
    margin-bottom: 5px;
    } 

    .bg-pd {
      background: #f2f2f2;
    
    padding: 5px 13px !important;
    }

    .pd-com {
          padding: 5px 13px;
    }

   
 </style>

  </head>

  <body>

    <section>

      <div class="container">

        <div class="row" style="align-items: center;">
          
          <div class="col-sm-12 text-center table-bordered mt-1"><h4 class="text-muted"> TAX INVOICE </h4></div>

          <div class="col-sm-3">

            <img src="logo.png" style="max-width: 100%; height: 150px;">

            </div>

            <div class="col-sm-9">

              <div class="float-right text-right address-details">

                <h3>Nikki Bites Food And Beverages Private Limited </h3>

                  <h5>All kind of Namkeens & Snack Pellets </h5>

                  <p> <strong> Office Address : </strong> G-1/2, Shivkrupa Ware House, Dhanera Tharad road 
                    <br>Dhanera, Banaskantha, Gujarat - 385310 </p>

                    <p> <strong> Email ID : </strong> info@nikkibites.com </p>

                    <p> <strong> Contact No : </strong> +91 98242 00203  </p>
                
              </div>

            </div>

        </div>

        <div class="row">

          <div class="col-sm-12">

            <div>

              <table class="table table-bordered"> 

                <tbody>

                  <tr> 

                    <td colspan="2">

                      <table style="width: 100%"> 

                        <tr>

                    <td style="width: 60%">

                      <h4> <strong> M/S : </strong> <?php echo $customer['customer_name']; ?> </h4>

                      <p> <strong> Address : </strong> <?php echo $customer['customer_address']; ?> </p>

                      <p> 
                             <strong> GSTN No : </strong> <?php echo $customer['customer_gst']; ?> 
                       </p> 

                       <p> <strong> Pan No : </strong> <?php echo $customer['customer_pan']; ?> </p>
                    </td>

                     <td style="">

                      <table class="address-details" style="width: 100%; " >
                        <tbody>
                          <tr>
                            <td class="bg-pd" style="border-bottom: transparent;">
                              <p> <strong> Invoice No : </strong>  <?php echo $invoice['invoice_number']; ?></p>

                                 <p> 
                                <span class="float-left">  <strong> Date : </strong> <?php echo date('d-m-Y', strtotime($invoice['created_at'])); ?> </span>
                                <span class="float-right">  <strong> <?php echo date('h:i', strtotime($invoice['created_at'])); ?> </strong> </span>
                              </p> 
                            </td>

                          </tr>

                          <tr> 


                          </tr>

                          <tr>
                            <td>
                              <p> <strong> Driver Name : </strong>  <?php echo $invoice['invoice_driver_name']; ?></p>
                              <p> <strong> Gate Pass : </strong>  <?php echo $invoice['invoice_gate_pass_number']; ?> </p>

                               <p> <strong> Vehicle Number : </strong>  <?php echo $invoice['invoice_vehicle_number']; ?></p>
                            </td>

                          </tr>

                        

                        </tbody>
                      </table>

                     </td>

                  </tr>

                      </table>

                     </td>

                  </tr>

                  

                  <tr> 
                    <td colspan="2">

                      <table class="table" style="width: 100%">
                        <thead>
                          <tr>
                            <th rowspan="">Sr.No</th>
                            <th rowspan="">Product Name</th>
                            <th rowspan="">HSN/SAC <br> Code</th>
                            <th rowspan="">Qty</th>
                            <th rowspan="">Rate</th>
                            <th rowspan="">Discount</th>
                            <th rowspan="">Taxble <br> Amount</th>
                            <?php if($customer['customer_gst_type']  == '1'){ ?>
                              <th rowspan="">CGST</th>
                              <th rowspan="">SGST</th>
                            <?php }else{ ?>
                              <th rowspan="">IGST</th>
                            <?php } ?>
                            <th rowspan="">Net Amount</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php $i=1; 

                            $total_quantity = 0;
                            $total_taxable_amount = 0;
                            $total_gst_amount = 0;
                            $total_net_amount = 0;

                            foreach($invoice_details as $rs){ 

                            $order_detail = getOne('tbl_order_detail','order_detail_id',$rs['order_detail_id']);
                            $product = getOne('tbl_product','product_id',$order_detail['order_product_id']);
                            

                          ?>
                          <tr>
                            <td><?php echo $i++; ?></td>
                            <td><?php echo $product['product_name']; ?></td>
                            <td><?php echo $product['product_hsn_code']; ?></td>
                            <td><?php echo $rs['dispatch_quantity']; $total_quantity += $rs['dispatch_quantity'];  ?></td>
                            <td><?php echo $order_detail['order_product_rate']; ?></td>
                            <td><?php echo $order_detail['order_product_discount']; ?></td>
                            <td><?php 
                                    
                                  $taxable_amount = $rs['dispatch_quantity'] * $order_detail['order_product_rate']; 
                                  $order_product_discount = $taxable_amount * $order_detail['order_product_discount'] / 100 ; 
                                    $taxable_amount = $taxable_amount - $order_product_discount;
                                    $total_taxable_amount += $taxable_amount;  
                                    echo $taxable_amount; 
    
                            ?></td>
                              <?php if($customer['customer_gst_type']  == '1'){ ?>
                            <td><?php echo $product['product_gst'] / 2; ?></td>
                            <td><?php echo $product['product_gst'] / 2; ?></td>
                            <?php }else{ ?>
                            <td><?php 
                              echo $product['product_gst']; 
                            ?>
                            </td>
                            <?php } ?>
                              <?php
                                // Calculate GST amount 
                                $gst_amount = $taxable_amount * $product['product_gst'] / 100;
                                $total_gst_amount += $gst_amount; 
                                $net_amount = $taxable_amount + $gst_amount;
                                $total_net_amount += $net_amount;
                              ?>
                          <td><?php echo number_format($net_amount,2); ?></td>
                          </tr>
                          <?php } ?>
  <!--                         <tr>
                            <td>1</td>
                            <td>Farali Chevado</td>
                            <td>2106</td>
                            <td>6</td>
                            <td>847</td>
                            <td>3388</td>
                            <td>203</td>
                            <td>203</td>
                            <td>3795</td>
                          </tr>
   -->                        
                        </tbody>

                        <tfooter>
                          <tr>
                            <th></th>
                            <th>Sub Total</th>
                            <th></th>
                            <th><?php echo $total_quantity; ?></th>
                            <th></th>
                            <th></th>
                            <th><?php echo $total_taxable_amount; ?></th>
                            <?php if($customer['customer_gst_type']  == '1'){ ?>
                            <th><?php echo $total_gst_amount / 2; ?></th>
                            <th><?php echo $total_gst_amount / 2; ?></th>
                            <?php }else{ ?>
                            <th><?php echo $total_gst_amount; ?></th>
                            <?php } ?>
                            <input type="hidden" id="total_gst_amount" value="<?php echo $total_gst_amount; ?>">
                            <th><?php echo number_format($total_net_amount,2); ?></th>
                          </tr>
                        </tfooter>
                      </table>
                      
                    </td>
                  </tr>

                  <tr> 
                    <td colspan="2"> 

                      <table style="width: 100%"> 

                          <tr>
                    <td colspan="" style="    width: 60%;">

                      <p> <strong> Closing Balance : <?php echo number_format($total_net_amount,2); ?> </strong> </p>

                      <?php if($customer['customer_gst_type']  == '1'){ ?>
                      <p> <strong> Total CGST : </strong> <span id="total_cgst_amount_in_words"></span> </p>
                      <p> <strong> Total SGST : </strong> <span id="total_sgst_amount_in_words"></span> </p>
                      <?php }else{ ?>
                      <p> <strong> Total IGST : </strong> <span id="total_igst_amount_in_words"></span> </p>
                      <?php } ?>

                      <?php 

                        $added_discount = $total_net_amount * $invoice['added_discount'] / 100;
                        $grand_total = $total_net_amount - $added_discount + $invoice['added_freight'];
                        $grand_total = round($grand_total);

                      ?>
                      <input type="hidden" id="total_bill_amount" value="<?php echo $grand_total; ?>">
                      
                      <p> <strong> Bill Amount : </strong> <span id="total_bill_amount_in_words"></span> </p>

                     </td>



                     <td colspan="">

                      <table class="" style="width:100%">


                      <tr>
                        <td> 
                          <p style="margin-bottom: 10px;">
                            <span class="float-left"> Freight </span>
                            <span class="float-right"> <?php echo $invoice['added_freight']; ?> </span>
                           </p>

                           <p style="clear: both; margin-bottom: 20px">
                            <span class="float-left"> Discount </span>
                            <span class="float-right"> <?php echo $invoice['added_discount']; ?> </span>

                           </p>
<!-- 
                           <p style="clear: both; ">
                            <span class="float-left"> Round Off </span>
                            <span class="float-right"> <?php echo $invoice['round_off']; ?> </span>

                           </p> -->


                         </td>

                      </tr>

                    

                      <tr>
                        <td> 
                          <p style="font-weight: 600">
                            <span class="float-left"> Grand Total </span>
                            <span class="float-right"> <?php echo $grand_total.".00"; ?> </span>

                           </p>

                         </td>

                      </tr>

                      <tr>
                        <td> 
                          <p style="font-weight: 600;    margin-bottom: 5px;">
                            Total Payable on RCM Basis : No
                           </p>

                           <p style="font-weight: 600;    margin-bottom: 5px;">
                            E- WayNo : No
                           </p>

                         </td>

                      </tr>



                       </table>

                     </td>

                  </tr>

                  <tr> 

                    <td style="width: 60%"> 

                      <h4  style="font-size: 20px;font-weight: 700;">Our Bank Deatils </h4>

                      <p style="margin-bottom: 5px;"><?php echo $owner[0]['owner_bank_name']; ?>. | A/c No. : <?php echo $owner[0]['owner_bank_account_number']; ?> IFSC Code : <?php echo $owner[0]['owner_bank_ifsc']; ?> </p>
                      <!-- <p> SBI Bank, Alkapuri Vadodara. | A/c No. : 120356422564 IFSC Code : SBI0111</p> -->

                    </td>

                    <td> 
 
                      <p>Company GSTIN : <?php echo $owner[0]['owner_gst']; ?> </p>
                      <p>Company PAN NO. : <?php echo $owner[0]['owner_company_pan_number']; ?> </p>

                    </td>

                  </tr>


                  <tr> 

                    <td> 

                      <h4 style="font-size: 20px;font-weight: 700;">Terms & Conditions</h4>

                      <p style="margin-bottom: 5px;">Our Responsibillity cease as goods leave our premise. </p>
                      <p style="margin-bottom: 5px;"> Subject to Dhanera Jurisdiction</p>
                      <p> E.&.O.E.</p>

                    </td>

                    <td class="text-center"> 
 
                      <p><strong>For, Nikki Bites Food And Beverages <br> Private Limiteds </strong> </p>
                      <p> <br><br> </p>

                      <p>(Authorised Signatory) </p>

                    </td>

                  </tr>


                      </table>

                    </td>


                  </tr>


                

                  



                </tbody>


              </table>

            </div>

            </div>

            

        </div>

      </div>

    </section>

    <script
  src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
  integrity="sha256-pasqAKBDmFT4eHoN2ndd6lN370kFiGUFyTiUHWhU7k8="
  crossorigin="anonymous"></script>
    
  </body>

  <script type="text/javascript">

    function convertNumberToWords(amount) {
                var words = new Array();
                words[0] = '';
                words[1] = 'One';
                words[2] = 'Two';
                words[3] = 'Three';
                words[4] = 'Four';
                words[5] = 'Five';
                words[6] = 'Six';
                words[7] = 'Seven';
                words[8] = 'Eight';
                words[9] = 'Nine';
                words[10] = 'Ten';
                words[11] = 'Eleven';
                words[12] = 'Twelve';
                words[13] = 'Thirteen';
                words[14] = 'Fourteen';
                words[15] = 'Fifteen';
                words[16] = 'Sixteen';
                words[17] = 'Seventeen';
                words[18] = 'Eighteen';
                words[19] = 'Nineteen';
                words[20] = 'Twenty';
                words[30] = 'Thirty';
                words[40] = 'Forty';
                words[50] = 'Fifty';
                words[60] = 'Sixty';
                words[70] = 'Seventy';
                words[80] = 'Eighty';
                words[90] = 'Ninety';

                amount = amount.toString();
                var atemp = amount.split(".");
                var number = atemp[0].split(",").join("");
                var n_length = number.length;
                var words_string = "";
                if (n_length <= 9) {
                    var n_array = new Array(0, 0, 0, 0, 0, 0, 0, 0, 0);
                    var received_n_array = new Array();
                    for (var i = 0; i < n_length; i++) {
                        received_n_array[i] = number.substr(i, 1);
                    }
                    for (var i = 9 - n_length, j = 0; i < 9; i++, j++) {
                        n_array[i] = received_n_array[j];
                    }
                    for (var i = 0, j = 1; i < 9; i++, j++) {
                        if (i == 0 || i == 2 || i == 4 || i == 7) {
                            if (n_array[i] == 1) {
                                n_array[j] = 10 + parseInt(n_array[j]);
                                n_array[i] = 0;
                            }
                        }
                    }
                    value = "";
                    for (var i = 0; i < 9; i++) {
                        if (i == 0 || i == 2 || i == 4 || i == 7) {
                            value = n_array[i] * 10;
                        } else {
                            value = n_array[i];
                        }
                        if (value != 0) {
                            words_string += words[value] + " ";
                        }
                        if ((i == 1 && value != 0) || (i == 0 && value != 0 && n_array[i + 1] == 0)) {
                            words_string += "Crores ";
                        }
                        if ((i == 3 && value != 0) || (i == 2 && value != 0 && n_array[i + 1] == 0)) {
                            words_string += "Lakhs ";
                        }
                        if ((i == 5 && value != 0) || (i == 4 && value != 0 && n_array[i + 1] == 0)) {
                            words_string += "Thousand ";
                        }
                        if (i == 6 && value != 0 && (n_array[i + 1] != 0 && n_array[i + 2] != 0)) {
                            words_string += "Hundred and ";
                        } else if (i == 6 && value != 0) {
                            words_string += "Hundred ";
                        }
                    }
                    words_string = words_string.split("  ").join(" ");
                }
                return words_string;
         }
    
    var total_igst_amount = $('#total_gst_amount').val();
    var total_cgst_sgst_amount = parseFloat($('#total_gst_amount').val()) / 2;
    $('#total_cgst_amount_in_words').html(convertNumberToWords(total_cgst_sgst_amount)).append('Rupees Only');
    $('#total_sgst_amount_in_words').html(convertNumberToWords(total_cgst_sgst_amount)).append('Rupees Only');
    $('#total_igst_amount_in_words').html(convertNumberToWords(total_igst_amount)).append('Rupees Only');
    var total_bill_amount = $('#total_bill_amount').val();
    $('#total_bill_amount_in_words').html(convertNumberToWords(total_bill_amount)).append('Rupees Only');
        
  </script>

</html>
