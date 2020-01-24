<?php

 require_once('../../functions.php');

 $login_id = $_SESSION['nb_credentials']['user_id'];
 $login_type = $_SESSION['nb_credentials']['user_type'];

if(isset($_POST['submit'])){

     $date_from = $_POST['date_from'];
     $date_to = $_POST['date_to'];
      
     $data = "SELECT * FROM tbl_orders WHERE DATE(created_at) BETWEEN '$date_from' AND '$date_to' ";
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
                           <h4 class="page-title">Order Report</h4>
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
                                    
                                    <label for="">From Date : </label>
                                    <input type="date" class="form-control" name="date_from">

                                  </div>  

                                </div>

                                <div class="col-md-3">
                                  
                                  <div class="form-group">
                                    
                                    <label for="">To Date : </label>
                                    <input type="date" class="form-control" name="date_to">

                                  </div>  

                                </div>



                                 <div class="col-md-3">
                                    <br>
                                    <button type="submit" name="submit" class="btn btn-primary btn-md"><i class="fa fa-filter"></i> Filter</button>
                                 </div>


                              </form>

                           </div>

   
                           <div class="row" style="margin-top: 10px;">

                            <h5><?php if(isset($data)){ echo count($data)." Order(s) found"; } ?></h5>

                                 <table id="order_report" class="table table-striped table-bordered table-condensed table-hover">
                                    
                                    <thead>
                                       <th class="text-center">Sr.</th>
                                       <th class="text-center">Order Number</th>
                                       <th class="text-center">Customer</th>
                                       <th class="text-center">Godown</th>
                                       <th class="text-center">No. of Items</th>
                                       <th class="text-center">Ordered at</th>
                                    </thead>

                                    <tbody>
                                       
                                       <?php if(isset($data) && count($data) > 0){ ?>

                                          <?php $i=1; foreach($data as $rs){ ?>

                                          <tr>
                                             
                                             <td class="text-center"><?php echo $i++; ?></td>
                                             <td class="text-center"><?php echo $rs['order_number']; ?></td>
                                             <td class="text-center"><?php 
                                                  
                                                  $customer_name = getOne('tbl_customer','customer_id',$rs['user_id']);
                                                  echo $customer_name['customer_name']; 
                                             
                                             ?></td>
                                             <td class="text-center"><?php 
                                                  
                                                  $godown_name = getOne('tbl_godown','godown_id',$rs['user_id']);
                                                  echo $godown_name['godown_name']; 
                                             
                                             ?></td>
                                             <td class="text-center"><?php 
                                              
                                                echo count(getWhere('tbl_order_detail','order_id',$rs['order_id']));
                                             ?></td>
                                             <td class="text-center"><?php echo $rs['created_at']; ?></td>                                             
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

      <script>
        

           $('#order_report').DataTable( {
              dom: 'Bfrtip',
              buttons: [
                  'copy', 'csv', 'excel', 'pdf', 'print'
              ]
          } );

      </script>

   </body>
</html>
