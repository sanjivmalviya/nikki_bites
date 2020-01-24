<?php

require_once('../../functions.php');
$login_id = $_SESSION['nb_credentials']['user_id'];

$godowns = getAll('tbl_godown');
$order_id = $_GET['id'];

if(isset($_POST['assign'])){

  $godown_id = $_POST['godown_id'];
  $update = "UPDATE tbl_orders SET godown_id = '$godown_id' WHERE order_id = '$order_id' ";


   if(query($update)){

     // 5 - SEND SMS TO GODOWN
     $getGodownDetails = getOne('tbl_godown','godown_id',$godown_id);
     $getOrderDetails = getOne('tbl_orders','order_id',$order_id);
     $godown_mobile = $getGodownDetails['godown_person_mobile'];
     $message = "You have a new order to dispatch, Your Order Number is #".$getOrderDetails['order_number']." ";
     sendSMS($godown_mobile,$message);

     $success = "Godown Assigned";

   }else{

      $error = "Something went wrong, Try again later";

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
                 <!--  <div class ="row">
                     <div class="col-xs-4 col-xs-offset-4 text-center">
                        <div class="page-title-box text-center">
                           <h4 class="page-title"> Assigning to Godown</h4>
                           <div class="clearfix"></div>
                        </div>
                     </div>
                  </div> -->
                  <div class="row">
                     <div class="col-sm-12 ">
                           <div class="row">

                              <div class="col-md-12">

                                 <form method="post">  
                                   
                                    <div class="row">

                                    <div class="col-md-4">
                                 
                                    <div class="form-group">
                                       <label for="">Select Godown</label>
                                       <select name="godown_id" id="godown_id" class="form-control select2">
                                          
                                          <?php if(isset($godowns)){ ?>
                                             <?php foreach($godowns as $rs){ ?>

                                                <option value="<?php echo $rs['godown_id']; ?>"><?php echo $rs['godown_name']; ?></option>

                                             <?php } ?>
                                          <?php } ?>

                                       </select>

                                    </div>
                                    </div>

                                       <div class="col-md-12 p-t-30">

                                          <?php if(isset($success)){ ?>

                                             <div class="alert alert-success"><?php echo $success; ?></div>

                                          <?php }else if(isset($warning)){ ?>

                                             <div class="alert alert-warning"><?php echo $warning; ?></div>

                                          <?php }else if(isset($error)){ ?>

                                             <div class="alert alert-danger"><?php echo $error; ?></div>

                                          <?php } ?>

                                       </div>       
                                    <div class="col-md-2">

                                       <input type="submit" name="assign" class="btn btn-primary btn-sm" value="Assign Order" style="height: 35px;">
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
        
        $('#godown_id').select2();

      </script>


   </body>
</html>