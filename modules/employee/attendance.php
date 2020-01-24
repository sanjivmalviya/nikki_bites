
<?php

   require_once('../../functions.php');

   $login_id = $_SESSION['nb_credentials']['user_id'];

   $table_name = 'tbl_employees';

   $field_name = 'employee_id';    

   $date = date('d-m-Y');

   $employees = getRaw("SELECT * FROM tbl_employees WHERE status = '1' AND added_by = ".$login_id." ");
   
   $today_attendance = getRaw("SELECT * FROM tbl_employee_attendance WHERE `date` = '$date' ");

   if(isset($_POST['submit'])){


    $i=0;


    foreach($_POST['employee'] as $rs){


      if(isset($_POST['present_'.$rs])){
        $attendance = 'P';
      }else if(isset($_POST['absent_'.$rs])){
        $attendance = 'A';
      }else if(isset($_POST['leave_'.$rs])){
        $attendance = 'L';
      }

      $form_data = array(
        'date' => $date,
        'employee_id' => $rs,
        'attendance' => $attendance
      );

      if(insert('tbl_employee_attendance',$form_data)){
        $success = "Attendance Taken Successfully";
      }else{
        $error = "Something went wrong, please try again later ";
      }

      $i++;
      
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

                           <h4 class="page-title">Daily Attendance</h4>

                           <div class="clearfix"></div>
                           <h5>Date : <?php echo date('d M Y'); ?></h5>

                        </div>

                     </div>                   

                  </div>

                  <form method="POST">

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

                  <?php 

                    $today = date('d-m-Y');
                    $checkIfAttendanceTaken = "SELECT * FROM tbl_employee_attendance WHERE `date` = '".$today."' ";
                    if(count(getRaw($checkIfAttendanceTaken)) > 0){

                  ?>

                  <div class="alert alert-success"><i class="fa fa-check"></i> Attendance has been taken for today !</div>

                  <?php }else{ ?>

    
                    <table class="table table-striped table-bordered table-condensed table-hover">
                      <thead>
                        <tr>
                          <th width="70%">Employee</th>
                          <th class="text-center text-primary">Present</th>
                          <th class="text-center text-danger">Absent</th>
                          <th class="text-center text-muted">On Leave</th>
                        </tr>
                      </thead>

                      <tbody>
                        
                        <?php if(isset($employees)){ ?>
                          <?php foreach($employees as $rs){ ?>

                            <tr>
                              <td><?php 

                                $employee_name = getOne('tbl_employees','employee_id',$rs['employee_id']);
                                echo $employee_name = $employee_name['employee_name'];

                              ?></td>
                              <input type="hidden" name="employee[]" value="<?php echo $rs['employee_id']; ?>">
                              <td class="text-center"><input type="checkbox" value="1" name="present_<?php echo $rs['employee_id']; ?>"></td>
                              <td class="text-center"><input type="checkbox" value="1" name="absent_<?php echo $rs['employee_id']; ?>"></td>
                              <td class="text-center"><input type="checkbox" value="1" name="leave_<?php echo $rs['employee_id']; ?>"></td>
                            </tr>
                        

                          <?php } ?>
                        <?php } ?>

                      </tbody>
                    </table>
  
                    <div class="col-md-12 text-center">
                      <button type="submit" name="submit" class="btn btn-primary btn-md"><i class="fa fa-floppy-o"></i> Save Attendance</button>
                    </div>
                  </form>
                <?php } ?>

                <div class="col-md-6">

                <table class="table table-striped table-condensed table-bordered table-hover">

                  <thead>
                    <tr>
                      <td colspan="3" class="text-center">Today's Attendance</td>
                    </tr>
                    <tr>
                      <th width="5%">Sr</th>
                      <th width="80%">Employee</th>
                      <th class="text-center">Attendance</th>
                    </tr>
                  </thead>

                  <?php $i=1; $total_presents = 0; $total_absents = 0; $total_leaves = 0; if(isset($today_attendance)){ ?>
                  <tbody>
                      <?php foreach($today_attendance as $rs){ ?>
                    <tr>
                      <td><?php echo $i++; ?></td>
                      <td><?php 
                        $employee_name = getOne('tbl_employees','employee_id',$rs['employee_id']);
                        echo $employee_name = $employee_name['employee_name'];
                      ?></td>
                      <td class="text-center"><?php if($rs['attendance'] == 'P'){ 
                        $total_presents++;
                        echo "<span class='text-primary'><b>P</b></span>"; }else if($rs['attendance'] == 'A'){ $total_absents++; echo "<span class='text-danger'><b>A</b></span>"; }else if($rs['attendance'] == 'L'){ $total_leaves++; echo "<span class='text-muted'><b>L</b></span>"; }; ?></td>
                    </tr>
                    <?php } ?>

                  <tfoot>
                    <tr>
                      <td colspan="2" class="text-center text-primary">Total Presents</td>
                      <td class="text-center text-primary"><?php echo $total_presents;  ?></td>
                    </tr>
                    <tr>
                      <td colspan="2" class="text-center text-danger">Total Absents</td>
                      <td class="text-center text-danger"><?php echo $total_absents;  ?></td>
                    </tr>
                    <tr>
                      <td colspan="2" class="text-center text-muted">Total Leaves</td>
                      <td class="text-center text-muted"><?php echo $total_leaves;  ?></td>
                    </tr>
                  </tfoot>
                  
                  <?php } ?>
  
                  </tbody>
                  
                </table>

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

   </body>

</html>
