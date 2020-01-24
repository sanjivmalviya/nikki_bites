<?php

 require_once('../../functions.php');

 $login_id = $_SESSION['nb_credentials']['user_id'];
 $login_type = $_SESSION['nb_credentials']['user_type'];

 $table_name = 'tbl_employees';
 $field_name = 'employee_id';

 $employee = getWhere('tbl_employees','employee_id',$_GET['id']);

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
   </head>
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
                           <h4 class="page-title">Employee Detail</h4>
                           <a href="view.php" class="btn btn-primary btn-sm pull-right m-b-10"><i class="fa fa-arrow-left"></i> Back</a>
                           <div class="clearfix"></div>

                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-sm-6">
                        <div class="card-box">
                           <div class="row">

                           		<table class="table table-striped table-bordered table-condensed table-hover" style="margin-top: 50px;">
                           			
                           			<tbody>
                                       <?php if(isset($employee)){ ?>
                                       <tr>
                                          <td>Name</td>
                                          <td><?php echo $employee[0]['employee_name']; ?> </td>
                                       </tr>
                                       <tr>
                                          <td>Employee Code</td>
                                          <td><?php echo $employee[0]['employee_code']; ?> </td>
                                       </tr>
                                       <tr>
                                          <td>Designation</td>
                                          <td><?php echo $employee[0]['employee_designation']; ?> </td>
                                       </tr>
                                       <tr>
                                          <td>HQ</td>
                                          <td><?php echo $employee[0]['employee_hq']; ?> </td>
                                       </tr>
                                       <tr>
                                          <td>Mobile</td>
                                          <td><?php echo $employee[0]['employee_mobile']; ?> </td>
                                       </tr>
                                       <tr>
                                          <td>D.O.J</td>
                                          <td><?php echo $employee[0]['employee_doj']; ?> </td>
                                       </tr>
                                       <tr>
                                          <td>D.O.B</td>
                                          <td><?php echo $employee[0]['employee_dob']; ?> </td>
                                       </tr>
                                       <tr>
                                          <td>PAN Number </td>
                                          <td><?php echo $employee[0]['employee_pan']; ?> </td>
                                       </tr>
                                       <?php if($employee[0]['employee_pan_file'] != ""){ ?>
                                       <tr>
                                          <td>PAN </td>
                                          <td><a href="<?php echo "../../uploads/pan/".$employee[0]['employee_pan_file']; ?>">View File</a></td>
                                       </tr>
                                       <?php } ?>
                                       <tr>
                                          <td>Email</td>
                                          <td><?php echo $employee[0]['employee_email']; ?> </td>
                                       </tr>
                                       <?php if($employee[0]['employee_aadhaar_file'] != ""){ ?>
                                       <tr>
                                          <td>Aadhaar</td>
                                          <td><a href="<?php echo "../../uploads/aadhaar/".$employee[0]['employee_aadhaar_file']; ?>">View File</a> </td>
                                       </tr>
                                       <?php } ?>
                                       <tr>
                                          <td>Aadhaar Number</td>
                                          <td><?php echo $employee[0]['employee_aadhaar_number']; ?> </td>
                                       </tr>
                                       <tr>
                                          <td>Password</td>
                                          <td><?php echo $employee[0]['employee_password']; ?> </td>
                                       </tr>
                                       <tr>
                                          <td>Nominee Name</td>
                                          <td><?php echo $employee[0]['employee_nominee_name']; ?> </td>
                                       </tr>
                                       <tr>
                                          <td>Nominee Relation</td>
                                          <td><?php echo $employee[0]['employee_nominee_relation']; ?> </td>
                                       </tr>
                                       <tr>
                                          <td>Spouse Name</td>
                                          <td><?php echo $employee[0]['employee_spouse_name']; ?> </td>
                                       </tr>
                                       <tr>
                                          <td>Reporting Manager</td>
                                          <td><?php echo $employee[0]['employee_reporting_manager_id']; ?> </td>
                                       </tr>
                                       <tr>
                                          <td>Department</td>
                                          <td><?php echo $employee[0]['employee_department_id']; ?> </td>
                                       </tr>
                                       <tr>
                                          <td>Bank Name</td>
                                          <td><?php echo $employee[0]['employee_bank_name']; ?> </td>
                                       </tr>
                                       <tr>
                                          <td>Bank IFSC</td>
                                          <td><?php echo $employee[0]['employee_bank_ifsc']; ?> </td>
                                       </tr>
                                       <tr>
                                          <td>Bank Branch</td>
                                          <td><?php echo $employee[0]['employee_bank_branch']; ?> </td>
                                       </tr>
                                       <tr>
                                          <td>Bank Number</td>
                                          <td><?php echo $employee[0]['employee_bank_number']; ?> </td>
                                       </tr>
                                       <tr>
                                          <td>Travel Rate(Per KM)</td>
                                          <td><?php echo $employee[0]['employee_travel_rate']; ?> </td>
                                       </tr>
                                       <tr>
                                          <td>Total Leaves</td>
                                          <td><?php echo $employee[0]['employee_total_leaves']; ?> </td>
                                       </tr>
                                       <tr>
                                          <td>Employee Grade</td>
                                          <td><?php echo $employee[0]['employee_grade']; ?> </td>
                                       </tr>
                                       <tr>
                                          <td>Current Salary</td>
                                          <td><?php echo $employee[0]['employee_salary']; ?> </td>
                                       </tr>
                                       <tr class="text-center">
                                          <td colspan="2"><b>Documents & Attachments</b></td>
                                       </tr>
                                       <?php 
                                          $documents = getOne('tbl_employees_documents','employee_id',$employee[0]['employee_id']);
                                          if(count($documents) > 0){
                                       ?>
                                       <tr>
                                          <td>Salary Document</td>
                                          <?php if($documents['salary_document'] != ""){ ?>
                                          <td><a href="<?php echo "../../uploads/employee/".$documents['salary_document']; ?>">View Document</a> </td>
                                          <?php }else{ ?>
                                          <td>N/A</td>
                                          <?php } ?>
                                       </tr>
                                       <tr>
                                          <td>Appointment Letter</td>
                                          <?php if($documents['appointment_letter'] != ""){ ?>
                                          <td><a href="<?php echo "../../uploads/employee/".$documents['appointment_letter']; ?>">View Document</a> </td>
                                          <?php }else{ ?>
                                          <td>N/A</td>
                                          <?php } ?>
                                       </tr>
                                       <tr>
                                          <td>Reliveing Letter</td>
                                          <?php if($documents['reliveing_letter'] != ""){ ?>
                                          <td><a href="<?php echo "../../uploads/employee/".$documents['reliveing_letter']; ?>">View Document</a> </td>
                                          <?php }else{ ?>
                                          <td>N/A</td>
                                          <?php } ?>
                                       </tr>
                                       <tr>
                                          <td>Experience Letter</td>
                                          <?php if($documents['experience_letter'] != ""){ ?>
                                          <td><a href="<?php echo "../../uploads/employee/".$documents['experience_letter']; ?>">View Document</a> </td>
                                          <?php }else{ ?>
                                          <td>N/A</td>
                                          <?php } ?>
                                       </tr>
                                       <tr>
                                          <td>Confirmation Letter</td>
                                          <?php if($documents['confirmation_letter'] != ""){ ?>
                                          <td><a href="<?php echo "../../uploads/employee/".$documents['confirmation_letter']; ?>">View Document</a> </td>
                                          <?php }else{ ?>
                                          <td>N/A</td>
                                          <?php } ?>
                                       </tr>
                                       <tr>
                                          <td>Promotion Letter</td>
                                          <?php if($documents['promotion_letter'] != ""){ ?>
                                          <td><a href="<?php echo "../../uploads/employee/".$documents['promotion_letter']; ?>">View Document</a> </td>
                                          <?php }else{ ?>
                                          <td>N/A</td>
                                          <?php } ?>
                                       </tr>
                                       <?php } ?>

                                       <?php } ?>

                           			</tbody>

                           		</table>

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
                                 </div>
                      
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
         
         $(function(){

            $('.danger').popover({ html : true});

         });

      </script>

   </body>
</html>