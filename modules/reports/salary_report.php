<?php

 require_once('../../functions.php');

 $login_id = $_SESSION['nb_credentials']['user_id'];
 $login_type = $_SESSION['nb_credentials']['user_type'];

$employees = getAll('tbl_employees');


if(isset($_POST['submit'])){

     $date_from = $_POST['date_from'];
     $date_to = $_POST['date_to'];

     if($_POST['id'] == 0){
      
      $data = "SELECT * FROM tbl_employee_salary_payouts WHERE DATE(created_at) BETWEEN '$date_from' AND '$date_to' ORDER BY id DESC ";
     
     }else{

      $id = $_POST['id'];
      $data = "SELECT * FROM tbl_employee_salary_payouts WHERE DATE(created_at) BETWEEN '$date_from' AND '$date_to' AND id = '".$id."' ORDER BY id DESC ";

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
                           <h4 class="page-title">Salary Report</h4>
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

                                             <label for="id">Select Employee<span class="text-danger">*</span></label>

                                             <select name="id" parsley-trigger="change" required="" class="form-control select2" id="id">

                                                <option value="0">All</option>

                                                <?php if(isset($employees)){ ?>

                                                   <?php foreach($employees as $rs){ ?>

                                                      <option value="<?php echo $rs['employee_id']; ?>"><?php echo $rs['employee_name']; ?></option>

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

                                 <table id="salary_report" class="table table-striped table-bordered table-condensed table-hover">
                                    
                                    <thead>
                                        <th>Sr.</th>
                                        <th>Employee</th>
                                        <th>Year</th>
                                        <th>Month</th>
                                        <th>Salary</th>
                                        <th>Extra Allowances</th>      
                                    </thead>

                                   <tbody>
                                       
                                       <?php if(isset($data) && count($data) > 0){ ?>

                                          <?php $i=1; foreach($data as $rs){ ?>

                                          <tr>
                                             <<td><?php echo $i++; ?></td>
                                              <td><?php 
                                                  $employee_name = getOne('tbl_employees','employee_id',$rs['employee_id']);
                                                  echo $employee_name['employee_name'];
                                                 ?></td>
                                              <td><?php echo $rs['year']; ?></td>
                                              <td><?php echo $rs['month']; ?></td>
                                              <td><?php echo $rs['salary']; ?></td>
                                              <td><?php echo $rs['extra_allowances']; ?></td>
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
         $('#id').select2();

           $('#salary_report').DataTable( {
              dom: 'Bfrtip',
              buttons: [
                  'copy', 'csv', 'excel', 'pdf', 'print'
              ]
          } );
      
         
      </script>

   </body>
</html>
