<?php

   require_once('../../functions.php');

   $login_id = $_SESSION['nb_credentials']['user_id'];

   $table_name = 'tbl_employees';

   $field_name = 'employee_id';    

   $reporting_managers = getAll('tbl_employees');
   $departments = getAll('tbl_departments');

   if(isset($_POST['submit'])){

    $next_id = 'SELECT AUTO_INCREMENT FROM information_schema.TABLES WHERE TABLE_SCHEMA = "'.DB.'" AND TABLE_NAME = "tbl_employees" ';
    $next_id = getRaw($next_id);
    $next_id = $next_id[0]['AUTO_INCREMENT'];
    $employee_code = 'NE/'.sprintf('%05d',($next_id));
   
    // POST DATA
    $employee_name = $_POST['employee_name'];
    $employee_designation = $_POST['employee_designation'];
    $employee_hq = $_POST['employee_hq'];
    $employee_mobile = $_POST['employee_mobile'];
    $employee_doj = $_POST['employee_doj'];
    $employee_dob = $_POST['employee_dob'];
    $employee_pan = $_POST['employee_pan'];
    $employee_email = $_POST['employee_email'];
    $employee_travel_rate = $_POST['employee_travel_rate'];

    if(isset($_POST['employee_app_access'])){
      $employee_app_access = 1;
    }else{
      $employee_app_access = 0;
    }

    $upload_dir = '../../uploads/aadhaar/';
    $extensions = array('jpg','jpeg','png');   
    
    $aadhaar_file = array();
    foreach ($_FILES['employee_aadhaar_file']["error"] as $key => $error) {

        if ($error == UPLOAD_ERR_OK) {  

            $tmp_name = $_FILES['employee_aadhaar_file']["tmp_name"][$key];
            $file_name = $_FILES['employee_aadhaar_file']["name"][$key];
            $extension = explode('.',$file_name);
            $file_extension = end($extension);

            if(in_array($file_extension, $extension)){
                
                $new_file_name = md5(uniqid()).".".$file_extension;             
                $destination = $upload_dir.$new_file_name;
                if(move_uploaded_file($tmp_name, $destination)){
                    $aadhaar_file[] = $new_file_name;
                }
            }   

        }
    }

    if(count($aadhaar_file) > 0){
        $aadhaar_file = $aadhaar_file[0];
        // if($sliders['aadhaar_file'] != ""){
        //     unlink($upload_dir.$sliders['aadhaar_file']);
        // }
    }else{
        $aadhaar_file = "";
    }

    $employee_aadhaar_file = $aadhaar_file;
    $employee_aadhaar_number = $_POST['employee_aadhaar_number'];

    $employee_password = $_POST['employee_password'];
    $employee_nominee_name = $_POST['employee_nominee_name'];
    $employee_nominee_relation = $_POST['employee_nominee_relation'];
    $employee_spouse_name = $_POST['employee_spouse_name'];

    $upload_dir = '../../uploads/pan/';
    $extensions = array('jpg','jpeg','png');   
    
    $employee_pan_file = array();
    foreach ($_FILES['employee_pan_file']["error"] as $key => $error) {

        if ($error == UPLOAD_ERR_OK) {  

            $tmp_name = $_FILES['employee_pan_file']["tmp_name"][$key];
            $file_name = $_FILES['employee_pan_file']["name"][$key];
            $extension = explode('.',$file_name);
            $file_extension = end($extension);

            if(in_array($file_extension, $extension)){
                
                $new_file_name = md5(uniqid()).".".$file_extension;             
                $destination = $upload_dir.$new_file_name;
                if(move_uploaded_file($tmp_name, $destination)){
                   $employee_pan_file[] = $new_file_name;
                }
            }   

        }
    }

    if(count($employee_pan_file) > 0){
        $employee_pan_file = $employee_pan_file[0];
        // if($sliders['pan_file'] != ""){
        //     unlink($upload_dir.$sliders['pan_file']);
        // }
    }else{
        $employee_pan_file = "";
    }


    $employee_reporting_manager_id = $_POST['employee_reporting_manager_id'];
    $employee_department_id = $_POST['employee_department_id'];
    $employee_bank_name = $_POST['employee_bank_name'];
    $employee_bank_ifsc = $_POST['employee_bank_ifsc'];
    $employee_bank_branch = $_POST['employee_bank_branch'];
    $employee_bank_number = $_POST['employee_bank_number'];
    $employee_total_leaves = $_POST['employee_total_leaves'];     

    $form_data = array(
        'added_by' => $login_id,
        'employee_name' =>  $employee_name,
        'employee_code' =>  $employee_code,
        'employee_designation' =>  $employee_designation,
        'employee_hq' =>  $employee_hq,
        'employee_mobile' =>  $employee_mobile,
        'employee_doj' =>  $employee_doj,
        'employee_dob' =>  $employee_dob,
        'employee_pan' =>  $employee_pan,
        'employee_pan_file' =>  $employee_pan_file,
        'employee_email' =>  $employee_email,
        'employee_aadhaar_file' =>  $employee_aadhaar_file,
        'employee_aadhaar_number' =>  $employee_aadhaar_number,
        'employee_password' =>  $employee_password,
        'employee_nominee_name' =>  $employee_nominee_name,
        'employee_nominee_relation' =>  $employee_nominee_relation,
        'employee_spouse_name' =>  $employee_spouse_name,
        'employee_reporting_manager_id' =>  $employee_reporting_manager_id,
        'employee_department_id' =>  $employee_department_id,
        'employee_bank_name' =>  $employee_bank_name,
        'employee_bank_ifsc' =>  $employee_bank_ifsc,
        'employee_bank_branch' =>  $employee_bank_branch,
        'employee_bank_number' =>  $employee_bank_number,
        'employee_total_leaves' =>  $employee_total_leaves,
        'employee_app_access' =>  $employee_app_access,
        'employee_travel_rate' =>  $employee_travel_rate
     );

    if(insert('tbl_employees',$form_data)){
    
      $success = "Employee Added Successfully";
    
    }else{
    
      $error = "Failed to add Employee";
    
    }


   }



   if(isset($_GET['edit_id'])){

         $edit_data = getOne($table_name,$field_name,$_GET['edit_id']);         

         $edit_data = array(
            'added_by' => $login_id,
            'employee_name' => $edit_data['employee_name'],
            'employee_designation' => $edit_data['employee_designation'],
            'employee_hq' => $edit_data['employee_hq'],
            'employee_mobile' => $edit_data['employee_mobile'],
            'employee_doj' => $edit_data['employee_doj'],
            'employee_dob' => $edit_data['employee_dob'],
            'employee_pan' => $edit_data['employee_pan'],
            'employee_email' => $edit_data['employee_email'],
            'aadhaar_file' => $edit_data['aadhaar_file'],
            'employee_aadhaar_file' => $edit_data['employee_aadhaar_file'],
            'employee_aadhaar_number' => $edit_data['employee_aadhaar_number'],
            'employee_password' => $edit_data['employee_password'],
            'employee_nominee_name' => $edit_data['employee_nominee_name'],
            'employee_nominee_relation' => $edit_data['employee_nominee_relation'],
            'employee_spouse_name' => $edit_data['employee_spouse_name'],
            'employee_reporting_manager_id' => $edit_data['employee_reporting_manager_id'],
            'employee_department_id' => $edit_data['employee_department_id'],
            'employee_bank_name' => $edit_data['employee_bank_name'],
            'employee_bank_ifsc' => $edit_data['employee_bank_ifsc'],
            'employee_bank_branch' => $edit_data['employee_bank_branch'],
            'employee_bank_number' => $edit_data['employee_bank_number'],
            'employee_total_leaves' => $edit_data['employee_total_leaves'],
            'employee_app_access' => $edit_data['employee_app_access'],
            'employee_travel_rate' => $edit_data['employee_travel_rate']
         );

   }



  if(isset($_POST['update'])){



    // POST DATA

    $employee_name = $_POST['employee_name'];

    $employee_mobile = $_POST['employee_mobile'];

    $employee_hq = $_POST['employee_hq'];

    $employee_designation = $_POST['employee_designation'];

    $employee_pan = $_POST['employee_pan'];

    $employee_doj = $_POST['employee_doj'];

    $employee_dob = $_POST['employee_dob'];

    $employee_email = $_POST['employee_email'];

    $employee_password = $_POST['employee_password'];

    $employee_spouse_name = $_POST['employee_spouse_name'];

    // $employee_spouse_mobile = $_POST['employee_spouse_mobile'];

    $employee_aadhaar_number = $_POST['employee_aadhaar_number'];


    if(isset($_POST['employee_app_access'])){
      $employee_app_access = 1;
    }else{
      $employee_app_access = 0;
    }


     // FILE DATA 

     $name = $_FILES['employee_aadhaar_file'];

     $allowed_extensions = array('jpg','jpeg','png','gif','pdf');

     $target_path = "../../uploads/aadhaar/";

     $file_prefix = "IMG_";

     $upload = file_upload($name,$allowed_extensions,$target_path,$file_prefix);
     

    if($_FILES['employee_aadhaar_file']['error'][0] == 0){


     if($upload['error'] == 1){

         $error = "Failed to Upload files, try again later";

     }else{

         foreach($upload['files'] as $rs){

             $form_data = array(

               'added_by' => $login_id,

               'employee_name' => $_POST['employee_name'],

               'employee_designation' => $_POST['employee_designation'],

               'employee_hq' => $_POST['employee_hq'],

               'employee_mobile' => $_POST['employee_mobile'],

               'employee_doj' => $_POST['employee_doj'],

               'employee_dob' => $_POST['employee_dob'],

               'employee_pan' => $_POST['employee_pan'],

               'employee_email' => $_POST['employee_email'],

               'employee_aadhaar' => substr($rs,6),

               'employee_aadhaar_number' => $_POST['employee_aadhaar_number'],

               'employee_password' => $_POST['employee_password'],

               'employee_spouse_name' => $_POST['employee_spouse_name'],

               'employee_spouse_mobile' => $_POST['employee_spouse_mobile'],

               'employee_app_access' => $employee_app_access,
               'employee_travel_rate' => $_POST['employee_travel_rate']

             );


             // clear old resource

             $old_employee_aadhaar = getOne($table_name,$field_name,$_GET['edit_id']);

             $old_employee_aadhaar['employee_aadhaar'];

             unlink("../../".$old_employee_aadhaar['employee_aadhaar']);


             if(update($table_name,$field_name,$_GET['edit_id'],$form_data)){

                   $success = "Employee Updated Successfully";

               }else{

                   $error = "Failed to update Employee, try again later";

                   unlink($rs);

               }



         }



     }

     }else{


          $form_data = array(

           'added_by' => $login_id,

           'employee_name' => $_POST['employee_name'],

           'employee_designation' => $_POST['employee_designation'],

           'employee_hq' => $_POST['employee_hq'],

           'employee_mobile' => $_POST['employee_mobile'],

           'employee_doj' => $_POST['employee_doj'],

           'employee_dob' => $_POST['employee_dob'],

           'employee_pan' => $_POST['employee_pan'],

           'employee_email' => $_POST['employee_email'],

           'employee_aadhaar_number' => $_POST['employee_aadhaar_number'],

           'employee_password' => $_POST['employee_password'],

           'employee_spouse_name' => $_POST['employee_spouse_name'],

           // 'employee_spouse_mobile' => $_POST['employee_spouse_mobile'],
           
           'employee_app_access' => $employee_app_access,
           'employee_travel_rate' => $_POST['employee_travel_rate'],

         );


         if(update($table_name,$field_name,$_GET['edit_id'],$form_data)){

             $success = "Employee Updated Successfully";

         }else{

             $error = "Failed to update Employee, try again later";

         }



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

                           <h4 class="page-title">Add Employee</h4>

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

                                       <div class="col-md-12">
                                        <h5>Employee Details : </h5>
                                       </div>

                                       <div class="col-md-4">

                                          <div class="form-group">

                                             <label for="employee_name">Name<span class="text-danger">*</span></label>

                                             <input type="text" name="employee_name" parsley-trigger="change" required="" placeholder="" class="form-control" id="employee_name" value="<?php if(isset($edit_data['employee_name'])){ echo $edit_data['employee_name']; } ?>">

                                          </div>

                                       </div>

                                       <div class="col-md-4">

                                          <div class="form-group">

                                             <label for="employee_mobile">Mobile<span class="text-danger">*</span></label>

                                             <input type="number" name="employee_mobile" parsley-trigger="change" required="" placeholder="" class="form-control" id="employee_mobile" value="<?php if(isset($edit_data['employee_mobile'])){ echo $edit_data['employee_mobile']; } ?>">

                                          </div>

                                       </div>

                                       <div class="col-md-4">

                                          <div class="form-group">

                                             <label for="employee_hq">HQ</label>

                                             <input type="text" name="employee_hq" parsley-trigger="change" placeholder="" class="form-control" id="employee_hq" value="<?php if(isset($edit_data['employee_hq'])){ echo $edit_data['employee_hq']; } ?>">

                                          </div>

                                       </div>

                                       <div class="col-md-4">

                                          <div class="form-group">

                                             <label for="employee_designation">Designation</label>

                                             <input type="text" name="employee_designation" parsley-trigger="change" placeholder="" class="form-control" id="employee_designation" value="<?php if(isset($edit_data['employee_designation'])){ echo $edit_data['employee_designation']; } ?>">

                                          </div>

                                       </div>

                                       <div class="col-md-4">

                                          <div class="form-group">

                                             <label>DOJ <span class="text-danger">*</span></label>

                                             <div class="input-group">

                                                <input type="date" required="" class="form-control" placeholder="mm/dd/yyyy" id="employee_doj" value="<?php if(isset($edit_data['employee_doj'])){ echo date('Y-m-d',strtotime($edit_data['employee_doj'])); } ?>" name="employee_doj" >

                                                <span class="input-group-addon bg-custom b-0"><i class="mdi mdi-calendar text-white"></i></span>

                                             </div>

                                          </div>

                                       </div>

                                       <div class="col-md-4">

                                          <div class="form-group">

                                             <label>DOB <span class="text-danger">*</span></label>

                                             <div class="input-group">

                                                <input type="date" required="" class="form-control" placeholder="mm/dd/yyyy" name="employee_dob" id="employee_dob" value="<?php if(isset($edit_data['employee_dob'])){ echo date('Y-m-d',strtotime($edit_data['employee_dob'])); } ?>" >

                                                <span class="input-group-addon bg-custom b-0"><i class="mdi mdi-calendar text-white"></i></span>

                                             </div>

                                          </div>

                                       </div>

                                       <div class="col-md-4">

                                          <div class="form-group">

                                             <label for="employee_email">Email<span class="text-danger">*</span></label>

                                             <input type="email" name="employee_email" parsley-trigger="change" required="" placeholder="" class="form-control" id="employee_email" value="<?php if(isset($edit_data['employee_email'])){ echo $edit_data['employee_email']; } ?>">

                                          </div>

                                       </div>

                                        <div class="col-md-4">

                                          <div class="form-group">

                                             <label for="employee_password">Password<span class="text-danger">*</span> &nbsp;<input type="button" class="btn btn-default btn-xs pull-right generatePassword" value="Generate"></label>

                                             <input type="text" name="employee_password" parsley-trigger="change" required="" placeholder="" class="form-control" id="employee_password" value="<?php if(isset($edit_data['employee_password'])){ echo $edit_data['employee_password']; } ?>">

                                          </div>

                                       </div>


                                        <div class="col-md-4">

                                          <div class="form-group">

                                             <label for="employee_nominee_name">Nominee Name</label>

                                             <input type="text" name="employee_nominee_name" parsley-trigger="change" placeholder="" class="form-control" id="employee_nominee_name" value="<?php if(isset($edit_data['employee_nominee_name'])){ echo $edit_data['employee_nominee_name']; } ?>">

                                          </div>

                                       </div>

                                                                              <div class="clearfix"> </div>


                                       <div class="col-md-4">

                                          <div class="form-group">

                                             <label for="employee_nominee_relation">Nominee Relation</label>

                                             <input type="text" name="employee_nominee_relation" parsley-trigger="change" placeholder="" class="form-control" id="employee_nominee_relation" value="<?php if(isset($edit_data['employee_nominee_relation'])){ echo $edit_data['employee_nominee_relation']; } ?>">

                                          </div>

                                       </div>


                                       <div class="col-md-4">

                                          <div class="form-group">

                                             <label for="employee_spouse_name">Spouse Name</label>

                                             <input type="text" name="employee_spouse_name" parsley-trigger="change" placeholder="" class="form-control" id="employee_spouse_name" value="<?php if(isset($edit_data['employee_spouse_name'])){ echo $edit_data['employee_spouse_name']; } ?>">

                                          </div>

                                       </div>



                                        <div class="col-md-4">

                                          <div class="form-group">

                                             <label for="employee_reporting_manager_id">Reporting Manager</label>

                                             <select name="employee_reporting_manager_id" parsley-trigger="change" placeholder="" class="form-control" id="employee_reporting_manager_id" value="<?php if(isset($edit_data['employee_reporting_manager_id'])){ echo $edit_data['employee_reporting_manager_id']; } ?>">
                                              <option value="">--Select Reporting Manager--</option>
                                              <?php if(isset($reporting_managers)){ ?>
                                                  <?php foreach($reporting_managers as $rs){ ?>

                                                    <option <?php if(isset($edit_data['employee_reporting_manager_id']) && $edit_data['employee_reporting_manager_id'] == $rs['employee_id']){ echo "selected"; } ?> value="<?php echo $rs['employee_id'] ?>"><?php echo $rs['employee_name'] ?></option>

                                                  <?php } ?>
                                              <?php } ?>
                                             </select>

                                          </div>

                                       </div>

                                       <div class="col-md-4">

                                          <div class="form-group">

                                             <label for="employee_department_id">Department <span class="text-danger">*</span></label>

                                             <select name="employee_department_id" parsley-trigger="change" placeholder="" class="form-control" id="employee_department_id" value="<?php if(isset($edit_data['employee_department_id'])){ echo $edit_data['employee_department_id']; } ?>" required="">
                                              <option value="">--Select Department--</option>
                                              <?php if(isset($departments)){ ?>
                                                  <?php foreach($departments as $rs){ ?>

                                                    <option <?php if(isset($edit_data['employee_department_id']) && $edit_data['employee_department_id'] == $rs['department_id']){ echo "selected"; } ?> value="<?php echo $rs['department_id'] ?>"><?php echo $rs['department_name'] ?></option>

                                                  <?php } ?>
                                              <?php } ?>
                                             </select>

                                          </div>

                                       </div>
                                       


                                       <div class="col-md-4">

                                          <div class="form-group">

                                             <label for="employee_aadhaar_number">Adhar Number</label>

                                             <input type="text" parsley-trigger="change" placeholder="" class="form-control" name="employee_aadhaar_number" id="employee_aadhaar_number" value="<?php if(isset($edit_data['employee_aadhaar_number'])){ echo $edit_data['employee_aadhaar_number']; } ?>">

                                          </div>

                                       </div>


                                       <div class="col-md-4">

                                          <div class="form-group">

                                             <label class="control-label">Upload Aadhaar</label>

                                             <input type="file" class="filestyle" data-buttonname="btn-default" name="employee_aadhaar_file[]" id="employee_aadhaar_file" >

                                          </div>

                                       </div>


                                       <div class="col-md-4">

                                          <div class="form-group">

                                             <label for="employee_pan">PAN Number</label>

                                             <input type="text" parsley-trigger="change" placeholder="" class="form-control" name="employee_pan" id="employee_pan" value="<?php if(isset($edit_data['employee_pan'])){ echo $edit_data['employee_pan']; } ?>">

                                          </div>

                                       </div>

                                       <div class="col-md-4">

                                          <div class="form-group">

                                             <label class="control-label">Upload PAN</label>

                                             <input type="file" class="filestyle" data-buttonname="btn-default" name="employee_pan_file[]" id="employee_pan_file" >

                                          </div>

                                       </div>

                                        <div class="col-md-4">

                                          <div class="form-group">

                                             <label for="employee_total_leaves">Employee Total Leaves</label>

                                             <input type="number" parsley-trigger="change" placeholder="" class="form-control" name="employee_total_leaves" id="employee_total_leaves" value="<?php if(isset($edit_data['employee_total_leaves'])){ echo $edit_data['employee_total_leaves']; } ?>">

                                          </div>

                                       </div>


                                       <div class="clearfix"> </div>
                                       <div class="col-md-12">
                                        <h5>Bank Details : </h5>
                                       </div>
                                       <div class="col-md-4">

                                          <div class="form-group">

                                             <label for="employee_bank_name">Bank Name</label>

                                             <input type="text" parsley-trigger="change" placeholder="" class="form-control" name="employee_bank_name" id="employee_bank_name" value="<?php if(isset($edit_data['employee_bank_name'])){ echo $edit_data['employee_bank_name']; } ?>">

                                          </div>

                                       </div>

                                       <div class="col-md-4">

                                          <div class="form-group">

                                             <label for="employee_bank_ifsc">Bank IFSC</label>

                                             <input type="text" parsley-trigger="change" placeholder="" class="form-control" name="employee_bank_ifsc" id="employee_bank_ifsc" value="<?php if(isset($edit_data['employee_bank_ifsc'])){ echo $edit_data['employee_bank_ifsc']; } ?>">

                                          </div>

                                       </div>


                                       <div class="col-md-4">

                                          <div class="form-group">

                                             <label for="employee_bank_branch">Bank Branch</label>

                                             <input type="text" parsley-trigger="change" placeholder="" class="form-control" name="employee_bank_branch" id="employee_bank_branch" value="<?php if(isset($edit_data['employee_bank_branch'])){ echo $edit_data['employee_bank_branch']; } ?>">

                                          </div>

                                       </div>

                                       <div class="col-md-4">

                                          <div class="form-group">

                                             <label for="employee_bank_number">Bank Number</label>

                                             <input type="number" parsley-trigger="change" placeholder="" class="form-control" name="employee_bank_number" id="employee_bank_number" value="<?php if(isset($edit_data['employee_bank_number'])){ echo $edit_data['employee_bank_number']; } ?>">

                                          </div>

                                       </div>

                                       
                                        <div class="col-md-4">

                                          <div class="form-group">

                                             <label for="employee_travel_rate">Travel Rate (Per KM)</label>

                                             <input type="number" parsley-trigger="change" placeholder="" class="form-control" name="employee_travel_rate" id="employee_travel_rate" value="<?php if(isset($edit_data['employee_travel_rate'])){ echo $edit_data['employee_travel_rate']; } ?>" required>

                                          </div>

                                       </div>
                                       <div class="clearfix"> </div>    

                                       <div class="col-md-4 p-t-30">
                                         
                                          <div class="checkbox-control">
                                        
                                             <input type="checkbox" name="employee_app_access" id="employee_app_access" <?php if($edit_data['employee_app_access'] == '1'){ echo "checked"; } ?>> <label for="employee_app_access">Allow App Access</label>
                                       
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

                                       

                                       <div class="col-md-12" align="right">

                                          <?php if(isset($edit_data)){ ?>                                             

                                            <button type="submit" name="update" id="update" class="btn btn-danger btn-bordered waves-effect w-md waves-light m-b-5">Update</button>

                                         <?php }else{ ?>

                                            <button type="submit" name="submit" id="submit" class="btn btn-primary btn-bordered waves-effect w-md waves-light m-b-5">Submit</button>

                                         <?php } ?>

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

         

         $('.generatePassword').on('click', function(){



            var password = randomPassword();

            $('#employee_password').val(password);



         });



      </script>



   </body>

</html>
