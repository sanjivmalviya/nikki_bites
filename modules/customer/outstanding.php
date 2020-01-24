<?php

 require_once('../../functions.php');

 $login_id = $_SESSION['nb_credentials']['user_id'];
 $login_type = $_SESSION['nb_credentials']['user_type'];
 
 $customers = "SELECT * FROM tbl_customer WHERE added_by = '$login_id' ";
 $customers = getRaw($customers);

 if(isset($_POST['submit'])){

   $year = $_POST['year'];
   $month = $_POST['month'];

   if(isset($_POST['customer_id'])){  

      $customer_id = $_POST['customer_id'];

      $condition = "WHERE ";
      if(isset($year) && $year != ""){
         $condition .= " target_year = '$year' AND ";
      }
      if(isset($year) && $month != ""){
         $condition .= " target_month = '$month' AND ";
      }
      $condition .= " customer_id = '$customer_id' ";

      $data = "SELECT * FROM tbl_target ".$condition." ORDER BY target_id  DESC ";
      
   }else{
      
      $condition = "WHERE ";
      if(isset($year) && $year != ""){
         $condition .= " target_year = '$year' AND ";
      }
      if(isset($year) && $month != ""){
         $condition .= " target_month = '$month' AND ";
      }
   
      $data = "SELECT * FROM tbl_target ".$condition." ORDER BY target_id DESC GROUP BY customer_id ";
   
   }

 }else{


   $data = "SELECT * FROM tbl_target GROUP BY customer_id ORDER BY target_id DESC  ";

 }

$data = getRaw($data);   

?>

<!DOCTYPE html>
<html>
   <head>
       <style>
         .popover{
            z-index: 99999 !important;
            max-width: 100% !important;
            width: 100% !important;
         }
      </style>
      <?php require_once('../../include/headerscript.php'); ?>
   </head>
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
                           <h4 class="page-title">Customer Outstandings</h4>
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
                                  
                                  <div class="form-group">
                                    
                                    <label for="">Select Customer : </label>
                                    <select name="customer_id" id="customer_id" class="form-control select2">
                                      <!-- <option value="">All</option> -->
                                      <?php if(isset($customers)){ ?>
                                       <?php foreach($customers as $rs){ ?>
                                         <option value="<?php echo $rs['customer_id']; ?>"><?php echo $rs['customer_name']; ?></option>
                                      <?php } ?>
                                      <?php } ?>
                                    </select>

                                  </div>  

                                </div>
                                 
                                 
                                <div class="col-md-4">
                                  
                                  <div class="form-group">
                                    
                                    <label for="">Year : </label>
                                    <select name="year" id="year" class="form-control select2">
                                      <option value="">--Select Year--</option>
                                      <option value="2019">2019</option>
                                      <option value="2020">2020</option>
                                      <option value="2021">2021</option>
                                    </select>

                                  </div>  

                                </div>

                               <div class="col-md-3">
                                  
                                  <div class="form-group">
                                    
                                    <label for="">Month : </label>
                                    <select name="month" id="month" class="form-control select2">
                                      <option value="">--Select Month--</option>
                                      <option value="01">01 - January</option>
                                      <option value="02">02 - February</option>
                                      <option value="03">03 - March</option>
                                      <option value="04">04 - April</option>
                                      <option value="05">05 - May</option>
                                      <option value="06">06 - June</option>
                                      <option value="07">07 - July</option>
                                      <option value="08">08 - August</option>
                                      <option value="09">09 - September</option>
                                      <option value="10">10 - October</option>
                                      <option value="11">11 - November</option>
                                      <option value="12">12 - December</option>
                                    </select>

                                  </div>  

                                </div>

                                 <div class="col-md-4">
                                    <br>
                                    <button type="submit" class="btn btn-primary btn-md" name="submit"><i class="fa fa-filter"></i>  Filter</button>
                                 </div>

                              </form>

                                 



                           </div>
                           
                           <div class="row" style="margin-top: 10px;">
                              <div class="col-md-12">                                 
                                 <?php if(isset($start_date) && isset($end_date)){ ?>
                                 <h4 class="text-muted">Records between <span class="text-primary"><?php echo date('d-m-Y',strtotime($start_date)); ?></span> AND <span class="text-primary"><?php echo date('d-m-Y', strtotime($end_date)); ?></span></h4>
                                 <?php }else{ ?>
                                    <h4 class="text-muted">All Records</h4>
                                 <?php } ?>
                              </div>
                           </div>

                           <div class="row">

                           		<table class="table table-striped table-bordered table-condensed table-hover">
                           			
                           			 <thead>
                                       <th class="text-center">Sr.</th>
                                       <th class="text-center">Customer</th>
                                       <th class="text-center">Recieve Total</th>
                                       <th class="text-center">Order Total</th>
                                       <th class="text-center">Outstanding</th>
                                    </thead>

                                    <tbody>
                                       
                                       <?php if(isset($data) && count($data) > 0){ ?>

                                          <?php $i=1; 

                                          $total_recieve_amount = 0;
                                          $total_order_amount = 0;
                                          $total_outstanding = 0;
                                          
                                          foreach($data as $rs){ ?>

                                          <tr>
                                             
                                             <td class="text-center"><?php echo $i++; ?></td>
                                             <td class="text-center"><?php 
                                                  
                                                  $customer_id = $rs['customer_id'];  
                                                  $customer_name = getOne('tbl_customer','customer_id',$rs['customer_id']);
                                                  echo $customer_name['customer_name']; 
                                             
                                             ?></td>
                                             <td class="text-center">

                                                <?php 

                                                   $recieveTotal = "SELECT IFNULL(SUM(payment_amount),0) as total_amount FROM tbl_payments WHERE customer_id = '$customer_id' AND payment_status = '1' AND MONTH(created_at) = '".$rs['target_month']."' AND YEAR(created_at) = '".$rs['target_year']."' ";
                                                   $recieveTotal = getRaw($recieveTotal);
                                                   echo $recieveTotal = $recieveTotal[0]['total_amount'];
                                                   $total_recieve_amount += $recieveTotal;
                                                   
                                                ?>
                                                
                                             </td>
                                             <td class="text-center">
                                               <?php 
                                                  $orderAmount = getInvoiceAchieveTotal($customer_id,$rs['target_year'],$rs['target_month']); 
                                                  echo $total_order_amount += $orderAmount;
                                               ?>
                                             </td>
                                             <td class="text-center">
                                                <?php 
                                                   
                                                   echo $outstandingAmount = $recieveTotal - $orderAmount; 
                                                   $total_outstanding += $outstandingAmount; 
                                                ?></td>
                                             
                                          </tr>
                                          
                                       <?php } ?>
                                       <?php } ?>

                                    </tbody>

                                    <tfoot>
                                       <td colspan="2" class="lead text-center"><b>TOTAL</b></td>
                                       <td class="lead text-center"><?php echo $total_recieve_amount; ?></td>
                                       <td class="lead text-center"><?php echo $total_order_amount; ?></td>
                                       <td class="lead text-center"><?php echo $total_outstanding; ?></td>
                                    </tfoot>

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

      <script>


          $('#customer_id').select2();
          $('#year').select2();
          $('#month').select2();

         
         $(function(){

            $('.danger').popover({ html : true});

         });

      </script>

   </body>
</html>