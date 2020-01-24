
<?php

   require_once('../../functions.php');

   $login_id = $_SESSION['nb_credentials']['user_id'];
   $table_name = 'tbl_employees';
   $field_name = 'employee_id';    

   $employees = getAll('tbl_employees');
   
   if(isset($_POST['submit'])){

    $employee_id = $_POST['employee_id'];
    $employee_grade = $_POST['employee_grade'];
    $employee_salary = $_POST['employee_salary'];

    $update = "UPDATE tbl_employees SET employee_grade = '$employee_grade',employee_salary = '$employee_salary' WHERE employee_id = '$employee_id' ";
   
    if(query($update)){
    
      $success = "Employee Grade Updated Successfully";
    
    }else{
    
      $error = "Failed to Update Grade";
    
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

                           <h4 class="page-title">Assign Grade</h4>

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

                                             <label for="employee_id">Employee</label>

                                             <select name="employee_id" parsley-trigger="change" placeholder="" class="form-control select2" id="employee_id" value="<?php if(isset($edit_data['employee_id'])){ echo $edit_data['employee_id']; } ?>">
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

                                             <label for="employee_grade">Grade</label>

                                             <select name="employee_grade" parsley-trigger="change" placeholder="" class="form-control" id="employee_grade" value="<?php if(isset($edit_data['employee_grade'])){ echo $edit_data['employee_grade']; } ?>">
                                                <option value="">--Select Grade--</option>
                                                <option value="A">A</option>
                                                <option value="B">B</option>
                                                <option value="C">C</option>
                                                <option value="D">D</option>
                                                <option value="E">E</option>
                                                <option value="F">F</option>
                                                <option value="G">G</option>
                                                <option value="AVP">AVP</option>
                                                <option value="VP">VP</option>

                                             </select>

                                          </div>

                                       </div>

                                       <div class="col-md-4">

                                          <div class="form-group">

                                             <label for="employee_salary">Current Salary</label>

                                             <input type="number" name="employee_salary" parsley-trigger="change" placeholder="" class="form-control" id="employee_salary" value="<?php if(isset($edit_data['employee_salary'])){ echo $edit_data['employee_salary']; } ?>">
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


                                            <button type="submit" name="submit" id="submit" class="btn btn-primary btn-bordered waves-effect w-md waves-light m-b-5">Assign</button>

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
        $('#employee_grade').select2();

         $('.generatePassword').on('click', function(){



            var password = randomPassword();

            $('#employee_password').val(password);



         });



      </script>



   </body>

</html>
