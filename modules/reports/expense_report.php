<?php

 require_once('../../functions.php');

 $login_id = $_SESSION['nb_credentials']['user_id'];
 $login_type = $_SESSION['nb_credentials']['user_type'];

$expense_master = getAll('tbl_expense_master');


if(isset($_POST['submit'])){

     $date_from = $_POST['date_from'];
     $date_to = $_POST['date_to'];

     if($_POST['expense_category_id'] == 0){
      
      $data = "SELECT * FROM tbl_expenses WHERE DATE(date) BETWEEN '$date_from' AND '$date_to' ORDER BY id DESC ";
     
     }else{

      $expense_category_id = $_POST['expense_category_id'];
      $data = "SELECT * FROM tbl_expenses WHERE DATE(date) BETWEEN '$date_from' AND '$date_to' AND expense_id = '".$expense_category_id."' ORDER BY id DESC ";

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
                           <h4 class="page-title">Expense Report</h4>
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

                                             <label for="expense_category_id">Expense Type<span class="text-danger">*</span></label>

                                             <select name="expense_category_id" parsley-trigger="change" required="" class="form-control select2" id="expense_category_id">

                                                <option value="0">All</option>

                                                <?php if(isset($expense_master)){ ?>

                                                   <?php foreach($expense_master as $rs){ ?>

                                                      <option value="<?php echo $rs['expense_id']; ?>"><?php echo $rs['expense_name']; ?></option>

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

                            <h5><?php if(isset($data)){ echo count($data)." Expense(s) found"; } ?></h5>

                                 <table id="expense_report" class="table table-striped table-bordered table-condensed table-hover">
                                    
                                    <thead>
                                       <th>Sr.</th>
                                       <th class="text-center">Date</th>
                                       <th class="text-center">Expense Type</th>
                                       <th class="text-center">Amount</th>
                                       <th class="text-center">Payment Mode</th>
                                       <th class="text-center">Attachment</th>           
                                       <th class="text-center">Transaction Id</th>           
                                       <th class="text-center">Cheque Number</th>           
                                       <th class="text-center">Bank Name</th>           
                                       <th>Remark</th>           
                                    </thead>

                                   <tbody>
                                       
                                       <?php if(isset($data) && count($data) > 0){ ?>

                                          <?php $i=1; foreach($data as $rs){ ?>

                                          <tr>
                                             <td><?php echo $i++; ?></td>
                                             <td class="text-center"><?php echo $rs['date']; ?></td>
                                             <td>
                                                <?php 
                                                   $expense_name = getOne('tbl_expense_master','expense_id',$rs['expense_id']);
                                                   echo $expense_name['expense_name'];
                                                ?> 
                                             </td>
                                             <td class="text-center"><?php echo $rs['amount']; ?></td>
                                             <td class="text-center"><?php if($rs['payment_mode'] == '1'){ echo "Cash"; }else if($rs['payment_mode'] == '2'){ echo "Online"; }else { echo "Cheque"; }  ?></td>
                                             <?php if($rs['attachment'] != ""){ ?>
                                                <td class="text-center"><a href="<?php echo "../../uploads/expenses/".$rs['attachment']; ?>">View</a></td>
                                             <?php }else{ ?>
                                                <td class="text-center">-</td>
                                             <?php } ?>
                                             <td class="text-center"><?php echo $rs['transaction_id']; ?></td>
                                             <td class="text-center"><?php echo $rs['cheque_number']; ?></td>
                                             <td class="text-center"><?php echo $rs['bank_name']; ?></td>
                                             <td><?php echo $rs['remark']; ?></td>
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
         $('#expense_category_id').select2();


           $('#expense_report').DataTable( {
              dom: 'Bfrtip',
              buttons: [
                  'copy', 'csv', 'excel', 'pdf', 'print'
              ]
          } );
         
      </script>

   </body>
</html>
