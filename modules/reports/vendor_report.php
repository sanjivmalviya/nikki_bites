<?php

 require_once('../../functions.php');

 $login_id = $_SESSION['nb_credentials']['user_id'];
 $login_type = $_SESSION['nb_credentials']['user_type'];

 $vendors = getAll('tbl_vendors');


if(isset($_POST['submit'])){

     $date_from = $_POST['date_from'];
     $date_to = $_POST['date_to'];

     if($_POST['vendor_id'] == 0){
      
      $data = "SELECT * FROM tbl_vendors WHERE DATE(created_at) BETWEEN '$date_from' AND '$date_to' ORDER BY id DESC ";
     
     }else{

      $vendor_id = $_POST['vendor_id'];
      $data = "SELECT * FROM tbl_vendors WHERE DATE(created_at) BETWEEN '$date_from' AND '$date_to' AND vendor_id = '".$vendor_id."' ORDER BY id DESC ";

     }

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
                           <h4 class="page-title">Vendor Report</h4>
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

                                             <label for="vendor_id">Select Vendor<span class="text-danger">*</span></label>

                                             <select name="vendor_id" parsley-trigger="change" required="" class="form-control select2" id="vendor_id">

                                                <option value="0">All</option>

                                                <?php if(isset($vendors)){ ?>

                                                   <?php foreach($vendors as $rs){ ?>

                                                      <option value="<?php echo $rs['vendor_id']; ?>"><?php echo $rs['vendor_name']; ?></option>

                                                   <?php } ?>

                                                <?php } ?>

                                             </select>

                                          </div>

                                       </div>

                                <div class="col-md-3">
                                  
                                  <div class="form-group">
                                    
                                    <label for="">From Date : </label>
                                    <input type="date" class="form-control" name="date_from" value="<?php echo date('Y-m-d'); ?>">

                                  </div>  

                                </div>

                                <div class="col-md-3">
                                  
                                  <div class="form-group">
                                    
                                    <label for="">To Date : </label>
                                    <input type="date" class="form-control" name="date_to" value="<?php echo date('Y-m-d'); ?>">

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

                                 <table id="vendor_report" class="table table-striped table-bordered table-condensed table-hover">
                                    
                                    <thead>
                                       <th width="2%">Sr.</th>
                                       <th width="5%">Name</th>
                                       <th width="5%">Vendor Code</th>
                                       <th width="5%">Contact Person</th>
                                       <th width="5%">Email</th>
                                       <th width="5%">Mobile</th>
                                       <th width="5%">Credit Limit</th>
                                       <th width="5%">Credit Limit Days</th>
                                       <th width="10%">Address</th>          
                                    </thead>

                                   <tbody>
                                       
                                       <?php if(isset($data) && count($data) > 0){ ?>

                                          <?php $i=1; foreach($data as $rs){ ?>

                                          <tr>
                                             <td><?php echo $i++; ?></td>
                                             
                                             <td><?php echo $rs['vendor_name']; ?></td>
                                             <td><?php echo $rs['vendor_code']; ?></td>
                                              <td widtd="5%"><?php echo $rs['person_name']; ?></td>
                                              <td widtd="5%"><?php echo $rs['vendor_email']; ?></td>
                                              <td widtd="5%"><?php echo $rs['vendor_mobile']; ?></td>
                                              <td widtd="5%"><?php echo $rs['vendor_credit_limit']; ?></td>
                                              <td widtd="5%"><?php echo $rs['vendor_credit_limit_days']; ?></td>
                                              <td widtd="10%"><?php echo $rs['vendor_address']; ?></td>
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

      <script>
         $('#vendor_id').select2();

            $('#vendor_report').DataTable( {
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            } );
        
      </script>

   </body>
</html>
