<?php

require_once('../../functions.php');

$login_id = $_SESSION['nb_credentials']['user_id'];
$login_type = $_SESSION['nb_credentials']['user_type'];

$vendors = getAll('tbl_vendors');
$customers = getAll('tbl_customer');

if(isset($_POST['submit'])){
     
     $type = $_POST['type'];
     $date_from = $_POST['date_from'];
     $date_to = $_POST['date_to'];

     if($type == '1'){
      
      // Vendor
      $vendor_id = $_POST['vendor_id'];
      
      if($vendor_id == ""){
      
        $data = "SELECT * FROM tbl_purchase_orders WHERE DATE(po_date) BETWEEN '$date_from' AND '$date_to' ";
      
      }else{

        $data = "SELECT * FROM tbl_purchase_orders WHERE vendor_id = '$vendor_id' AND DATE(po_date) BETWEEN '$date_from' AND '$date_to' ";
      }

      $report_type = '1';

     }else{
      // Customer
      $customer_id = $_POST['customer_id'];
      
      if($customer_id == ""){
      
        $data = "SELECT user_id as customer_id,invoice_number,invoice_id,invoice_date FROM tbl_orders ord INNER JOIN tbl_invoices inv ON ord.order_id = inv.order_id WHERE DATE(invoice_date) >= '$date_from' AND DATE(invoice_date) <= '$date_to' GROUP BY invoice_number ";
      
      }else{

        $data = "SELECT user_id as customer_id,invoice_number,invoice_id,invoice_date FROM tbl_orders ord INNER JOIN tbl_invoices inv ON ord.order_id = inv.order_id WHERE ord.customer_id = '$customer_id' AND DATE(invoice_date) BETWEEN '$date_from' AND '$date_to' ";
        
      }

      $report_type = '2';

     }

     $data = getRaw($data);

}

if(isset($_POST['reset'])){

  header('location:gst_report.php');
  
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
                           <h4 class="page-title">GST Report</h4>
                           <div class="clearfix"></div>
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-sm-12">
                        <div class="card-box">

                           <div class="row">

                              <form method="post">

                                <div class="col-md-3">
                                  
                                  <div class="form-group">
                                    
                                    <label for="">Type : </label>
                                    <select name="type" id="type" class="form-control select2">
                                      <option <?php if(isset($_POST['type']) && $_POST['type'] == '1'){ echo "selected"; } ?> value="1">Credit</option>
                                      <option <?php if(isset($_POST['type']) && $_POST['type'] == '2'){ echo "selected"; } ?> value="2">Debit</option>
                                    </select>

                                  </div>  

                                </div>

                                <div class="col-md-3 vendor-block">
                                  
                                  <div class="form-group">
                                    
                                    <label for="">Select Vendor : </label>
                                    <select name="vendor_id" id="vendor_id" class="form-control select2" >
                                      <option value="">All Vendors</option>
                                      <?php if(isset($vendors)){ ?>
                                        <?php foreach($vendors as $rs){ ?>
                                          <option <?php if(isset($_POST['vendor_id']) && $_POST['vendor_id'] == $rs['vendor_id']){ echo "selected"; } ?> value="<?php echo $rs['vendor_id']; ?>"><?php echo $rs['vendor_name']; ?></option>
                                        <?php } ?>
                                      <?php } ?>
                                    </select>

                                  </div>  

                                </div>

                                <div class="col-md-3 customer-block">
                                  
                                  <div class="form-group">
                                    
                                    <label for="">Select Customer : </label>
                                    <select name="customer_id" id="customer_id" class="form-control select2">
                                      <option value="">All Customer</option>
                                      <?php if(isset($customers)){ ?>
                                        <?php foreach($customers as $rs){ ?>
                                          <option <?php if(isset($_POST['customer_id']) && $_POST['customer_id'] == $rs['customer_id']){ echo "selected"; } ?> value="<?php echo $rs['customer_id']; ?>"><?php echo $rs['customer_name']; ?></option>
                                        <?php } ?>
                                      <?php } ?>
                                    </select>

                                  </div>  

                                </div>


                                <div class="col-md-3">
                                  <div class="form-group">
                                    <label for="">From : </label>
                                    <input type="date" class="form-control" name="date_from" id="date_from" <?php if(isset($_POST['date_from'])){ ?> value="<?php echo $_POST['date_from']; ?>" <?php }else{ ?> value="<?php echo date('Y-m-d'); ?>" <?php } ?> >
                                  </div>  
                                </div>

                                <div class="col-md-3">
                                  <div class="form-group">
                                    <label for="">To : </label>
                                    <input type="date" class="form-control" name="date_to" id="date_to" <?php if(isset($_POST['date_to'])){ ?> value="<?php echo $_POST['date_to']; ?>" <?php }else{ ?> value="<?php echo date('Y-m-d'); ?>" <?php } ?>>
                                  </div>  
                                </div>

                                 <div class="col-md-3">
                                    <br>
                                    <button type="submit" name="submit" class="btn btn-primary btn-md"><i class="fa fa-filter"></i> Filter</button>
                                    <button type="submit" name="reset" class="btn btn-default btn-md"><i class="fa fa-reset"></i> Reset</button>
                                 </div>


                              </form>

                           </div>

   
                           <div class="row" style="margin-top: 10px;">

                            <h5><?php if(isset($data)){ echo count($data)." Record(s) found"; 

                            } ?></h5>

                                <?php if($report_type == '1'){ ?>

                                 <table id="gst_report" class="table table-striped table-bordered table-condensed table-hover">
                                    
                                    <thead>
                                       <th class="text-center">Sr.</th>
                                       <th class="text-center">Vendor</th>
                                       <th class="text-center">GST No</th>
                                       <th class="text-center">P.O Date</th>
                                       <th class="text-center">P.O Number</th>
                                       <th class="text-center">INV No</th>
                                       <th class="text-center">Total Amount</th>
                                       <th class="text-center">CGST</th>
                                       <th class="text-center">SGST</th>
                                       <th class="text-center">IGST</th>
                                       
                                    </thead>

                                    <tbody>
                                       
                                       <?php if(isset($data) && count($data) > 0){ ?>

                                          <?php $i=1; 

                                          $total_sgst_cgst = 0;
                                          $total_igst = 0;
                                          
                                          foreach($data as $rs){ ?>

                                          <tr>
                                             
                                             <td class="text-center"><?php echo $i++; ?></td>
                                             <td class="text-center"><?php 
                                                  
                                                  $vendor_id = $rs['vendor_id'];  
                                                  $vendor_name = getOne('tbl_vendors','vendor_id',$rs['vendor_id']);
                                                  echo $vendor_name['vendor_name']; 
                                             
                                             ?></td>
                                              <td class="text-center"><?php 
                                                  
                                                  $vendor_id = $rs['vendor_id'];  
                                                  $vendor_name = getOne('tbl_vendors','vendor_id',$rs['vendor_id']);
                                                  echo $vendor_name['vendor_gst']; 
                                             
                                             ?></td>
                                           
                                             <td><?php echo $rs['po_date']; ?></td>
                                             <td><?php echo $rs['po_number']; ?></td>
                                              <td><?php echo $rs['invoice_number']; ?></td>


											<?php 

                                                  // $totalamt = "SELECT IFNULL(SUM(product_per_qty),0) as gst_amount1 FROM tbl_purchase_order_detail WHERE purchase_order_id = '".$rs['id']."' ";
                                                  // 	  $gst_amount1 = getRaw($gst_amount1);   
                                                  //     $cgst_amount1 = $gst_amount1[0]['gst_amount1'] *  $gst_amount1[0]['product_qty']; 
                                                  //     $total_sgst_cgst1 += $cgst_amount1;  

$count="SELECT count(*) as ordercount FROM tbl_purchase_order_detail WHERE purchase_order_id = '".$rs['id']."' ";
$count1 = getRaw($count);
// print_r($count1[0]['ordercount']);
 


$totalamt= "SELECT product_qty as  pqty FROM tbl_purchase_order_detail WHERE purchase_order_id = '".$rs['id']."' ";
$totalamt1= "SELECT product_per_qty as  perqty FROM tbl_purchase_order_detail WHERE purchase_order_id = '".$rs['id']."' ";
$totalamt2= "SELECT product_gst_amount as  gst FROM tbl_purchase_order_detail WHERE purchase_order_id = '".$rs['id']."' ";

$grandtotal = getRaw($totalamt);
$grandtotal1 = getRaw($totalamt1);
$grandtotal2 = getRaw($totalamt2);
// print_r($grandtotal);
// print_r($grandtotal1);
// exit;


$pqty = 0;
$perqty = 0;
$sub_total = 0;
 
 for($i=0;$i<$count1[0]['ordercount'];$i++)
  {
  $sub_total += $grandtotal[$i]['pqty'] * $grandtotal1[$i]['perqty'] + $grandtotal2[$i]['gst'];
  } 
 ?> 
  
 												

 												<td><?php echo round($sub_total); ?></td>








                                              <?php 

                                                  $gst_amount = "SELECT IFNULL(SUM(product_gst_amount),0) as gst_amount FROM tbl_purchase_order_detail WHERE purchase_order_id = '".$rs['id']."' ";
                                                  $gst_amount = getRaw($gst_amount);

                                                  $vendor_detail = getOne('tbl_vendors','vendor_id',$rs['vendor_id']); 

                                                  $cgst_amount = 0;
                                                  $sgst_amount = 0;
                                                  $igst_amount = 0;

                                                  if($vendor_detail['vendor_gst_type'] == '1'){

                                                      $cgst_amount = $gst_amount[0]['gst_amount'] / 2;
                                                      $sgst_amount = $gst_amount[0]['gst_amount'] / 2;

                                                      $total_sgst_cgst += $cgst_amount + $sgst_amount;

                                                  }else{
                                                      
                                                      $igst_amount = $gst_amount[0]['gst_amount'];
                                                      $total_igst += $igst_amount;

                                                  }

                                                  $total_gst_amount += $cgst_amount + $sgst_amount + $igst_amount;
                                              ?> 
                                             <td class="text-center"><?php echo $cgst_amount; ?></td>
                                             <td class="text-center"><?php echo $sgst_amount; ?></td>
                                             <td class="text-center"><?php echo $igst_amount; ?></td>

                                          </tr>
                                          
                                       <?php } ?>
                                       <?php } ?>

                                    </tbody>

                                    <tfoot>
                                      <tr>
                                        <td colspan="7" class="text-center lead"> </td>
                                        <td class="text-center" style="font-size: 17px;font-weight: bold;"><i class="fa fa-rupee"></i> <?php echo $total_sgst_cgst / 2; ?></td>
                                        <td class="text-center" style="font-size: 17px;font-weight: bold;"><i class="fa fa-rupee"></i> <?php echo $total_sgst_cgst / 2; ?></td>
                                        <td class="text-center" style="font-size: 17px;font-weight: bold;"><i class="fa fa-rupee"></i> <?php echo $total_igst; ?></td>
                                      </tr>
                                      <tr>
                                        <td colspan="7" class="text-center lead">TOTAL GST </td>
                                        <td colspan="4" class="text-center" style="font-size: 17px;font-weight: bold;"><i class="fa fa-rupee"></i> <?php echo $total_gst_amount; ?></td>
                                      </tr>
                                    </tfoot>

                                 </table>

                                <?php }else if($report_type == '2'){ ?>

                                  <table id="gst_report" class="table table-striped table-bordered table-condensed table-hover">
                                    
                                    <thead>
                                       <th class="text-center">Sr.</th>
                                       <th class="text-center">Customer</th>
                                       <th class="text-center">Invoice</th>
                                       <th class="text-center">Date</th>
                                       <th class="text-center">CGST</th>
                                       <th class="text-center">SGST</th>
                                       <th class="text-center">IGST</th>
                                    </thead>

                                    <tbody>
                                       
                                       <?php if(isset($data) && count($data) > 0){ ?>

                                          <?php $i=1; 

                                          $total_gst_amount = 0;
                                          
                                          foreach($data as $rs){ ?>

                                          <tr>
                                             
                                             <td class="text-center"><?php echo $i++; ?></td>
                                             <td class="text-center"><?php 
                                                  
                                                  $customer_id = $rs['customer_id'];  
                                                  $customer_name = getOne('tbl_customer','customer_id',$rs['customer_id']);
                                                  echo $customer_name['customer_name']; 
                                             
                                             ?></td>
                                             <td class="text-center"><?php echo $rs['invoice_number']; ?></td>
                                             <td class="text-center"><?php echo date('d-m-Y', strtotime($rs['invoice_date'])); ?></td>
                                             
                                              <?php 

                                                $invoice_detail = 'SELECT * FROM tbl_invoice_detail det INNER JOIN tbl_order_detail ord ON det.order_detail_id = ord.order_detail_id WHERE det.invoice_id = '.$rs['invoice_id'].' GROUP BY invoice_detail_id ';
                                                $invoice_detail = getRaw($invoice_detail);
                                                if(count($invoice_detail) > 0){

                                                    $invoice_gst_amount = 0;
                                                    foreach($invoice_detail as $rs){

                                                      $order_product_rate = $rs['order_product_rate'];
                                                      $order_product_discount = $rs['order_product_discount'];
                                                      $discount = $order_product_rate * $order_product_discount / 100;
                                                      $order_product_rate = $order_product_rate - $discount;
                                                      $order_product_rate = $order_product_rate * $rs['dispatch_quantity'];

                                                      $order_product_gst = getOne('tbl_product','product_id',$rs['order_product_id']);
                                                      $order_product_gst = $order_product_gst['product_gst']; 
                                                      $order_product_gst_amount = $order_product_rate * $order_product_gst / 100;

                                                      $invoice_gst_amount += $order_product_gst_amount;
                                                      
                                                      }


                                                }else{
                                                  
                                                  $invoice_gst_amount = 0;

                                                }
                                                
                                                 $gst_amount = getRaw($gst_amount);

                                                  $customer_detail = getOne('tbl_customer','customer_id',$rs['customer_id']); 

                                                  $cgst_amount = 0;
                                                  $sgst_amount = 0;
                                                  $igst_amount = 0;

                                                  if($customer_detail['customer_gst_type'] == '1'){

                                                      $cgst_amount = $invoice_gst_amount / 2;
                                                      $sgst_amount = $invoice_gst_amount / 2;

                                                      $total_sgst_cgst += $cgst_amount + $sgst_amount;

                                                  }else{
                                                      
                                                      $igst_amount = $invoice_gst_amount;
                                                      $total_igst += $igst_amount;

                                                  }

                                                  $total_gst_amount += $cgst_amount + $sgst_amount + $igst_amount;
                                                  // $total_invoice_gst_amount += $invoice_gst_amount;
                                              ?> 
                                             <td class="text-center"><?php echo $cgst_amount; ?></td>
                                             <td class="text-center"><?php echo $sgst_amount; ?></td>
                                             <td class="text-center"><?php echo $igst_amount; ?></td>

                                               
                                          </tr>
                                          
                                       <?php } ?>
                                       <?php } ?>

                                    </tbody>

                                    <tfoot>
                                        
                                        <tr>
                                          <td colspan="4" class="text-center lead"> </td>
                                          <td class="text-center" style="font-size: 17px;font-weight: bold;"><i class="fa fa-rupee"></i> <?php echo $total_sgst_cgst / 2; ?></td>
                                          <td class="text-center" style="font-size: 17px;font-weight: bold;"><i class="fa fa-rupee"></i> <?php echo $total_sgst_cgst / 2; ?></td>
                                          <td class="text-center" style="font-size: 17px;font-weight: bold;"><i class="fa fa-rupee"></i> <?php echo $total_igst; ?></td>
                                        </tr>
                                        <tr>
                                          <td colspan="4" class="text-center lead">TOTAL GST </td>
                                          <td colspan="3" class="text-center" style="font-size: 17px;font-weight: bold;"><i class="fa fa-rupee"></i> <?php echo $total_gst_amount; ?></td>
                                        </tr>
                                      </tfoot>
                                   </table>

                                <?php } ?>
                      
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
          
          $('#type').select2();
          $('#vendor_id').select2();
          $('#customer_id').select2();


           $('#gst_report').DataTable( {
              dom: 'Bfrtip',
              buttons: [
                  'copy', 'csv', 'excel', 'pdf', 'print'
              ]
          });

         if($('#type').val() == '2'){
              $('.customer-block').show();
              $('.vendor-block').hide();
            }else{
              $('.customer-block').hide();
              $('.vendor-block').show();
            }





          $('#type').on('change', function(){
              
              var type = $(this).val();

              if(type == '2'){
                $('.customer-block').show();
                $('.vendor-block').hide();
              }else{
                $('.customer-block').hide();
                $('.vendor-block').show();
              }

          });

      </script>
   </body>
</html>
