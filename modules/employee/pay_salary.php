
<?php

   require_once('../../functions.php');

   $login_id = $_SESSION['nb_credentials']['user_id'];
   $table_name = 'tbl_employees';
   $field_name = 'employee_id';    

   $employees = getAll('tbl_employees');
   
   if(isset($_POST['submit'])){

    $employee_id = $_POST['employee_id'];
    $year = $_POST['year'];
    $month = $_POST['month'];
    $salary = $_POST['salary'];
    $extra_allowances = $_POST['extra_allowances'];

    $form_data = array(
      'employee_id' => $employee_id,
      'year' => $year,
      'month' => $month,
      'salary' => $salary,
      'extra_allowances' => $extra_allowances
    );
   
    if(insert('tbl_employee_salary_payouts',$form_data)){
    
      $success = "Employee Salary Paid Successfully";
    
    }else{
    
      $error = "Failed to Paid Salary";
    
    }


   }

    $salaries = getRaw('SELECT * FROM tbl_employee_salary_payouts WHERE status = 1 ORDER BY id DESC');

    if(isset($_GET['delete_id'])){

        if(delete('tbl_employee_salary_payouts','id',$_GET['delete_id'])){
        
          $success = "Record Deleted Successfully";
        
        }else{
        
          $error = "Failed to delete record, something went wrong ";
        
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

                           <h4 class="page-title">Pay Salary</h4>

                           <div class="clearfix"></div>

                        </div>

                     </div>                   

                  </div>

                  <div class="row">   

                     

                     <div class="col-sm-12">

                        <div class="card-box">

                           <div class="row">

                              <form method="post" class="form-horizontal" role="form" enctype="multipart/form-data">

                                 <div class="col-md-12">

                                    <div class="row">


                                        <div class="col-md-4">

                                          <div class="form-group">

                                             <label for="employee_id">Employee <span class="text-danger">*</span></label>

                                             <select name="employee_id" parsley-trigger="change" placeholder="" class="form-control select2" id="employee_id" value="<?php if(isset($edit_data['employee_id'])){ echo $edit_data['employee_id']; } ?>" required>
                                              <option value="">--Select Employee--</option>
                                              <?php if(isset($employees)){ ?>
                                                  <?php foreach($employees as $rs){ ?>

                                                    <option <?php if(isset($edit_data['employee_id']) && $edit_data['employee_id'] == $rs['employee_id']){ echo "selected"; } ?> value="<?php echo $rs['employee_id'] ?>"><?php echo $rs['employee_name'] ?></option>

                                                  <?php } ?>
                                              <?php } ?>
                                             </select>

                                          </div>

                                       </div>


                                        <div class="col-md-4">

                                          <div class="form-group">

                                             <label for="year">Year <span class="text-danger">*</span></label>

                                             <select name="year" parsley-trigger="change" placeholder="" class="form-control" id="year" value="<?php if(isset($edit_data['year'])){ echo $edit_data['year']; } ?>" required>
                                                <option value="2019">2019</option>
                                                <option value="2020">2020</option>
                                                <option value="2021">2021</option>
                                             </select>

                                          </div>

                                       </div>

                                       <div class="col-md-4">

                                          <div class="form-group">

                                             <label for="month">Month <span class="text-danger">*</span></label>

                                             <select name="month" parsley-trigger="change" placeholder="" class="form-control" id="month" value="<?php if(isset($edit_data['month'])){ echo $edit_data['month']; } ?>" required>
                                                <option value="1">01 - January</option>
                                                <option value="2">02 - February</option>
                                                <option value="3">03 - March</option>
                                                <option value="4">04 - April</option>
                                                <option value="5">05 - May</option>
                                                <option value="6">06 - June</option>
                                                <option value="7">07 - July</option>
                                                <option value="8">08 - August</option>
                                                <option value="9">09 - September</option>
                                                <option value="10">10 - October</option>
                                                <option value="11">11 - November</option>
                                                <option value="12">12 - December</option>
                                             </select>

                                          </div>

                                       </div>

                                       <div class="col-md-4">

                                          <div class="form-group">

                                             <label for="salary">Salary <span class="text-danger">*</span></label>

                                             <input type="number" name="salary" parsley-trigger="change" placeholder="" class="form-control" id="salary" value="<?php if(isset($edit_data['salary'])){ echo $edit_data['salary']; } ?>" required>
                                          </div>

                                       </div>

                                       <div class="col-md-4">

                                          <div class="form-group">

                                             <label for="extra_allowances">Extra Allowances</label>

                                             <input type="number" name="extra_allowances" parsley-trigger="change" placeholder="" class="form-control" id="extra_allowances" value="<?php if(isset($edit_data['extra_allowances'])){ echo $edit_data['extra_allowances']; } ?>">
                                          </div>

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

                                       

                                       <div class="col-md-12" align="left">


                                            <button type="submit" name="submit" id="submit" class="btn btn-primary btn-bordered waves-effect w-md waves-light m-b-5">Pay Now</button>

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

                 <div class="container">
                        
                        <table id="salary_table" class="table table-striped table-condensed table-bordered table-hover">
                          <thead>
                            <tr>
                              <th>Sr.</th>
                              <th>Employee</th>
                              <th>Year</th>
                              <th>Month</th>
                              <th>Salary</th>
                              <th>Extra Allowances</th>
                              <th>Actions</th>
                            </tr>
                          </thead>

                          <tbody>
                            <?php if(isset($salaries)){ ?>
                              <?php $i=1; foreach($salaries as $rs){ ?>
                                <tr>
                                  <td><?php echo $i++; ?></td>
                                  <td><?php 
                                      $employee_name = getOne('tbl_employees','employee_id',$rs['employee_id']);
                                      echo $employee_name['employee_name'];
                                     ?></td>
                                  <td><?php echo $rs['year']; ?></td>
                                  <td><?php echo $rs['month']; ?></td>
                                  <td><?php echo $rs['salary']; ?></td>
                                  <td><?php echo $rs['extra_allowances']; ?></td>
                                  <td class="text-center">
                                    <a href="pay_salary.php?delete_id=<?php echo $rs['id']; ?>" onclick=" return confirm('Are you sure ?'); "><i class="fa fa-trash"></i></a>
                                  </td>
                                </tr>
                              <?php } ?>
                            <?php } ?>
                          </tbody>
                        </table>                
      

                    </div>


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
  
        $('#employee_id').select2();
        $('#year').select2();
        $('#month').select2();


        $('#salary_table').DataTable();


         $('.generatePassword').on('click', function(){



            var password = randomPassword();

            $('#employee_password').val(password);



         });



      </script>



   </body>

</html>
