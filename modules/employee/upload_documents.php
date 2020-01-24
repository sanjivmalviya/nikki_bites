
<?php

   require_once('../../functions.php');

   $login_id = $_SESSION['nb_credentials']['user_id'];

   $table_name = 'tbl_employees';

   $field_name = 'employee_id';    

   $employees = getAll('tbl_employees');
   
   if(isset($_POST['submit'])){

    // POST DATA
    $employee_id = $_POST['employee_id'];

    $upload_dir = '../../uploads/employee/';
    $extensions = array('jpg','jpeg','png');   

    // salary_document  
    // appointment_letter
    // reliveing_letter
    // experience_letter
    // confirmation_letter
    // promotion_letter

    $salary_document = array();
    $appointment_letter = array();
    $reliveing_letter = array();
    $experience_letter = array();
    $confirmation_letter = array();
    $promotion_letter = array();

    foreach ($_FILES['salary_document']["error"] as $key => $error) {

        if ($error == UPLOAD_ERR_OK) {  

            $tmp_name = $_FILES['salary_document']["tmp_name"][$key];
            $file_name = $_FILES['salary_document']["name"][$key];
            $extension = explode('.',$file_name);
            $file_extension = end($extension);

            if(in_array($file_extension, $extension)){
                
                $new_file_name = md5(uniqid()).".".$file_extension;             
                $destination = $upload_dir.$new_file_name;
                if(move_uploaded_file($tmp_name, $destination)){
                    $salary_document[] = $new_file_name;
                }
            }   

        }
    }

    if(count($salary_document) > 0){
        $salary_document = $salary_document[0];
        // if($sliders['salary_document'] != ""){
        //     unlink($upload_dir.$sliders['salary_document']);
        // }
    }else{
        $salary_document = "";
    }

  foreach ($_FILES['appointment_letter']["error"] as $key => $error) {

        if ($error == UPLOAD_ERR_OK) {  

            $tmp_name = $_FILES['appointment_letter']["tmp_name"][$key];
            $file_name = $_FILES['appointment_letter']["name"][$key];
            $extension = explode('.',$file_name);
            $file_extension = end($extension);

            if(in_array($file_extension, $extension)){
                
                $new_file_name = md5(uniqid()).".".$file_extension;             
                $destination = $upload_dir.$new_file_name;
                if(move_uploaded_file($tmp_name, $destination)){
                    $appointment_letter[] = $new_file_name;
                }
            }   

        }
    }

    if(count($appointment_letter) > 0){
        $appointment_letter = $appointment_letter[0];
        // if($sliders['appointment_letter'] != ""){
        //     unlink($upload_dir.$sliders['appointment_letter']);
        // }
    }else{
        $appointment_letter = "";
    }

    foreach ($_FILES['reliveing_letter']["error"] as $key => $error) {

        if ($error == UPLOAD_ERR_OK) {  

            $tmp_name = $_FILES['reliveing_letter']["tmp_name"][$key];
            $file_name = $_FILES['reliveing_letter']["name"][$key];
            $extension = explode('.',$file_name);
            $file_extension = end($extension);

            if(in_array($file_extension, $extension)){
                
                $new_file_name = md5(uniqid()).".".$file_extension;             
                $destination = $upload_dir.$new_file_name;
                if(move_uploaded_file($tmp_name, $destination)){
                    $reliveing_letter[] = $new_file_name;
                }
            }   

        }
    }

    if(count($reliveing_letter) > 0){
        $reliveing_letter = $reliveing_letter[0];
        // if($sliders['reliveing_letter'] != ""){
        //     unlink($upload_dir.$sliders['reliveing_letter']);
        // }
    }else{
        $reliveing_letter = "";
    }

    foreach ($_FILES['experience_letter']["error"] as $key => $error) {

        if ($error == UPLOAD_ERR_OK) {  

            $tmp_name = $_FILES['experience_letter']["tmp_name"][$key];
            $file_name = $_FILES['experience_letter']["name"][$key];
            $extension = explode('.',$file_name);
            $file_extension = end($extension);

            if(in_array($file_extension, $extension)){
                
                $new_file_name = md5(uniqid()).".".$file_extension;             
                $destination = $upload_dir.$new_file_name;
                if(move_uploaded_file($tmp_name, $destination)){
                    $experience_letter[] = $new_file_name;
                }
            }   

        }
    }

    if(count($experience_letter) > 0){
        $experience_letter = $experience_letter[0];
        // if($sliders['experience_letter'] != ""){
        //     unlink($upload_dir.$sliders['experience_letter']);
        // }
    }else{
        $experience_letter = "";
    }

    foreach ($_FILES['confirmation_letter']["error"] as $key => $error) {

        if ($error == UPLOAD_ERR_OK) {  

            $tmp_name = $_FILES['confirmation_letter']["tmp_name"][$key];
            $file_name = $_FILES['confirmation_letter']["name"][$key];
            $extension = explode('.',$file_name);
            $file_extension = end($extension);

            if(in_array($file_extension, $extension)){
                
                $new_file_name = md5(uniqid()).".".$file_extension;             
                $destination = $upload_dir.$new_file_name;
                if(move_uploaded_file($tmp_name, $destination)){
                    $confirmation_letter[] = $new_file_name;
                }
            }   

        }
    }

    if(count($confirmation_letter) > 0){
        $confirmation_letter = $confirmation_letter[0];
        // if($sliders['confirmation_letter'] != ""){
        //     unlink($upload_dir.$sliders['confirmation_letter']);
        // }
    }else{
        $confirmation_letter = "";
    }

    foreach ($_FILES['promotion_letter']["error"] as $key => $error) {

        if ($error == UPLOAD_ERR_OK) {  

            $tmp_name = $_FILES['promotion_letter']["tmp_name"][$key];
            $file_name = $_FILES['promotion_letter']["name"][$key];
            $extension = explode('.',$file_name);
            $file_extension = end($extension);

            if(in_array($file_extension, $extension)){
                
                $new_file_name = md5(uniqid()).".".$file_extension;             
                $destination = $upload_dir.$new_file_name;
                if(move_uploaded_file($tmp_name, $destination)){
                    $promotion_letter[] = $new_file_name;
                }
            }   

        }
    }

    if(count($promotion_letter) > 0){
        $promotion_letter = $promotion_letter[0];
        // if($sliders['promotion_letter'] != ""){
        //     unlink($upload_dir.$sliders['promotion_letter']);
        // }
    }else{
        $promotion_letter = "";
    }

     $form_data = array(
        'employee_id' => $employee_id,
        'salary_document' =>  $salary_document,
        'appointment_letter' =>  $appointment_letter,
        'reliveing_letter' =>  $reliveing_letter,
        'experience_letter' =>  $experience_letter,
        'confirmation_letter' =>  $confirmation_letter,
        'promotion_letter' =>  $promotion_letter
     );

    
    $employee = getOne('tbl_employees_documents','employee_id',$employee_id);

    if(count($employee) > 0){

        $error = "Document already uploaded, you need to update the documents instead of upload";

    }else{

      if(insert('tbl_employees_documents',$form_data)){
      
        $success = "Employee Added Successfully";
      
      }else{
      
        $error = "Failed to add Employee";
      
      }
      
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

  $employee_spouse_mobile = $_POST['employee_spouse_mobile'];

  $employee_aadhaar_number = $_POST['employee_aadhaar_number'];



   // FILE DATA 

   $name = $_FILES['employee_aadhaar'];

   $allowed_extensions = array('jpg','jpeg','png','gif','pdf');

   $target_path = ROOT."/uploads/aadhaar/";

   $file_prefix = "IMG_";

   $upload = file_upload($name,$allowed_extensions,$target_path,$file_prefix);

   

  if($_FILES['employee_aadhaar']['error'][0] == 0){



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

         'employee_spouse_mobile' => $_POST['employee_spouse_mobile'],

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

                                       <div class="clearfix"></div>
    
                                       <div class="col-md-4">

                                          <div class="form-group">

                                             <label class="control-label">Upload Salary Document</label>

                                             <input type="file" class="filestyle" data-buttonname="btn-default" name="salary_document[]" id="salary_document" >

                                          </div>

                                       </div>

                                       <div class="col-md-4">

                                          <div class="form-group">

                                             <label class="control-label">Upload Appointment Letter</label>

                                             <input type="file" class="filestyle" data-buttonname="btn-default" name="appointment_letter[]" id="appointment_letter" >

                                          </div>

                                       </div>

                                       <div class="col-md-4">

                                          <div class="form-group">

                                             <label class="control-label">Upload Reliveing Letter</label>

                                             <input type="file" class="filestyle" data-buttonname="btn-default" name="reliveing_letter[]" id="reliveing_letter" >

                                          </div>

                                       </div>

                                       <div class="col-md-4">

                                          <div class="form-group">

                                             <label class="control-label">Upload Experience Letter</label>

                                             <input type="file" class="filestyle" data-buttonname="btn-default" name="experience_letter[]" id="experience_letter" >

                                          </div>

                                       </div>

                                       <div class="col-md-4">

                                          <div class="form-group">

                                             <label class="control-label">Upload Confirmation Letter</label>

                                             <input type="file" class="filestyle" data-buttonname="btn-default" name="confirmation_letter[]" id="confirmation_letter" >

                                          </div>

                                       </div>

                                       <div class="col-md-4">

                                          <div class="form-group">

                                             <label class="control-label">Upload Promotion Letter</label>

                                             <input type="file" class="filestyle" data-buttonname="btn-default" name="promotion_letter[]" id="promotion_letter" >

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
  
  $('#employee_id').select2();
        


      </script>



   </body>

</html>
