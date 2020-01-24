<?php

 require_once('../../functions.php');

 $login_id = $_SESSION['nb_credentials']['user_id'];
 $login_type = $_SESSION['nb_credentials']['user_type'];

if(isset($_POST['submit'])){

     $year = $_POST['year'];
     $month = $_POST['month'];
      
     $data = "SELECT * FROM tbl_target WHERE target_year = '$year' AND target_month = '$month' ORDER BY target_id  DESC ";
     $data = getRaw($data);
          
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
                           <h4 class="page-title">Target Report</h4>
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
                                    
                                    <label for="">Year : </label>
                                    <select name="year" id="year" class="form-control select2">
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



                                 <div class="col-md-3">
                                    <br>
                                    <button type="submit" name="submit" class="btn btn-primary btn-md"><i class="fa fa-filter"></i> Filter</button>
                                 </div>


                              </form>

                           </div>

   
                           <div class="row" style="margin-top: 10px;">

                            <h5><?php if(isset($data)){ echo count($data)." Record(s) found"; } ?></h5>

                                 <table id="target_report" class="table table-striped table-bordered table-condensed table-hover">
                                    
                                    <thead>
                                       <th class="text-center">Sr.</th>
                                       <th class="text-center">Customer</th>
                                       <th class="text-center">Assigned</th>
                                       <th class="text-center">Achieved</th>
                                       <th class="text-center">Pending</th>
                                       <th class="text-center">Status</th>
                                    </thead>

                                    <tbody>
                                       
                                       <?php if(isset($data) && count($data) > 0){ ?>

                                          <?php $i=1; 

                                          $total_assigned_amount = 0;
                                          $total_achieved_amount = 0;
                                          $total_pending_amount = 0;
                                          
                                          foreach($data as $rs){ ?>

                                          <tr>
                                             
                                             <td class="text-center"><?php echo $i++; ?></td>
                                             <td class="text-center"><?php 
                                                  
                                                  $customer_id = $rs['customer_id'];  
                                                  $customer_name = getOne('tbl_customer','customer_id',$rs['customer_id']);
                                                  echo ucwords($customer_name['customer_name']); 
                                             
                                             ?></td>
                                                                                          
                                             <td class="text-center"><?php 
                                                echo $target_amount = $rs['target_amount']; 
                                                $total_assigned_amount += $target_amount;
                                             ?></td>
                                             <td class="text-center">
                                               <?php 
                                                  echo $achievedAmount = getInvoiceAchieveTotal($customer_id,$year,$month); 
                                                  $total_achieved_amount += $achievedAmount;
                                               ?>
                                             </td>
                                             <td class="text-center"> <?php 
                                                  echo $pending_amount = $rs['target_amount'] - $achievedAmount; 
                                                  $total_pending_amount += $pending_amount;
                                              ?> </td>
                                             <td class="text-center"> <?php if($achievedAmount < $rs['target_amount']){ echo "<span class='text-danger' >Pending</span>"; }else{ echo "<span class='text-primary' >Completed</span>"; } ?> </td>
                                             
                                          </tr>
                                          
                                       <?php } ?>
                                       <?php } ?>

                                    </tbody>

                                    <tfoot>
                                      <tr>
                                        <td colspan="2" class="text-center"><b>TOTAL </b> </td>
                                        <td class="text-center" style="font-size: 17px;font-weight: bold;"><i class="fa fa-rupee"></i> <?php echo $total_assigned_amount; ?></td>
                                        <td class="text-center" style="font-size: 17px;font-weight: bold;"><i class="fa fa-rupee"></i> <?php echo $total_achieved_amount; ?></td>
                                        <td class="text-center" style="font-size: 17px;font-weight: bold;"><i class="fa fa-rupee"></i> <?php echo $total_pending_amount; ?></td>
                                        <td></td>
                                      </tr>
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
          
          $('#year').select2();
          $('#month').select2();


           $('#target_report').DataTable( {
              dom: 'Bfrtip',
              buttons: [
                  'copy', 'csv', 'excel', 'pdf', 'print'
              ]
          } );

      </script>
   </body>
</html>
