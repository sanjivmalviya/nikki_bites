
<?php

   require_once('../../functions.php');

   $login_id = $_SESSION['nb_credentials']['user_id'];
   $table_name = 'tbl_employees';
   $field_name = 'employee_id';    

   $employees = getAll('tbl_employees');
   
   if(isset($_POST['submit'])){

    $employee_id = $_POST['employee_id'];
    $year = $_POST['year'];
    $leaves = $_POST['leaves'];

    $form_data = array(
      'employee_id' => $employee_id,
      'year' => $year,
      'leaves' => $leaves
    );

    $exists = getRaw("SELECT * FROM tbl_employee_total_leaves WHERE employee_id = '$employee_id' AND year = '$year' ");
    if(count($exists) > 0){
      
      $emp = getOne('tbl_employees','employee_id',$employee_id);
      $error = "Oops ! Leave already added to ".$emp['employee_name']." for ".$year;
    
    }else{

      if(insert('tbl_employee_total_leaves',$form_data)){
      
        $success = "Employee Leave Added";
      
      }else{
      
        $error = "Failed to add leave";
      
      }
      
    }

   }


    $leaves = getRaw('SELECT * FROM tbl_employee_total_leaves WHERE status = 1 ORDER BY id DESC');

    if(isset($_GET['delete_id'])){

        if(delete('tbl_employee_total_leaves','id',$_GET['delete_id'])){
        
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

                           <h4 class="page-title">Add Leaves for Employee</h4>

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


                                        <div class="col-md-6">

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


                                        <div class="col-md-6">

                                          <div class="form-group">

                                             <label for="year">Year</label>

                                             <select name="year" parsley-trigger="change" placeholder="" class="form-control" id="year" value="<?php if(isset($edit_data['year'])){ echo $edit_data['year']; } ?>">
                                                <option value="2019">2019</option>
                                                <option value="2020">2020</option>
                                                <option value="2021">2021</option>
                                             </select>

                                          </div>

                                       </div>

                                       <div class="col-md-6">

                                          <div class="form-group">

                                             <label for="leaves">Total Leaves</label>
                                             <input type="text" name="leaves" class="form-control" required="">

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

                     <div class="container">
                        
                        <table id="grant_leave_table" class="table table-striped table-condensed table-bordered table-hover">
                          <thead>
                            <tr>
                              <th>Sr.</th>
                              <th>Employee</th>
                              <th>Year</th>
                              <th>Leaves</th>
                              <th>Actions</th>
                            </tr>
                          </thead>

                          <tbody>
                            <?php if(isset($leaves)){ ?>
                              <?php $i=1; foreach($leaves as $rs){ ?>
                                <tr>
                                  <td><?php echo $i++; ?></td>
                                  <td><?php 

                                      $employee_name = getOne('tbl_employees','employee_id',$rs['employee_id']);
                                      echo $employee_name['employee_name'];

                                  ?></td>
                                  <td><?php echo $rs['year']; ?></td>
                                  <td><?php echo $rs['leaves']; ?></td>
                                  <td class="text-center">
                                    <a href="add_leave.php?delete_id=<?php echo $rs['id']; ?>" onclick=" return confirm('Are you sure ?'); "><i class="fa fa-trash"></i></a>
                                  </td>
                                </tr>
                              <?php } ?>
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


      
      <script>
  
        $('#employee_id').select2();
        $('#year').select2();

         $('.generatePassword').on('click', function(){



            var password = randomPassword();

            $('#employee_password').val(password);



         });



      </script>



   </body>

</html>
