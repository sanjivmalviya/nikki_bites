<?php

 require_once('../../functions.php');

 $login_id = $_SESSION['nb_credentials']['user_id'];
 $login_type = $_SESSION['nb_credentials']['user_type'];

 $targets = getRaw('SELECT * FROM tbl_target ORDER BY target_id DESC');


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
                           <h4 class="page-title">Assigned Targets</h4>
                           <div class="clearfix"></div>
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-sm-12">
                        <div class="card-box">
                           <div class="row">

                                 <table class="table table-striped table-bordered table-condensed table-hover" style="margin-top: 50px;">
                                    
                                    <thead>
                                      <th>Sr</th>
                                      <th>Year</th>
                                      <th>Month</th>
                                      <th>Amount</th>
                                      <th>Customer</th>
                                      <th>Assigned at</th>
                                      <th class="text-right">Actions</th>
                                    </thead>

                                    <tbody>
                                       
                                       <?php if(isset($targets) && count($targets) > 0){ ?>

                                          <?php $i=1; foreach($targets as $rs){ ?>

                                          <tr id="tr_<?php echo $i; ?>">
                                              <td><?php echo $i; ?></td>
                                              <td><?php echo $rs['target_year']; ?></td>
                                              <td><?php 

                                                  if($rs['target_month'] == '01'){

                                                    echo "January";

                                                  }else if($rs['target_month'] == '02'){

                                                    echo "February";

                                                  }else if($rs['target_month'] == '03'){

                                                    echo "March";

                                                  }else if($rs['target_month'] == '04'){

                                                    echo "April";

                                                  }else if($rs['target_month'] == '05'){

                                                    echo "May";

                                                  }else if($rs['target_month'] == '06'){

                                                    echo "June";

                                                  }else if($rs['target_month'] == '07'){

                                                    echo "July";

                                                  }else if($rs['target_month'] == '08'){

                                                    echo "August";

                                                  }else if($rs['target_month'] == '09'){

                                                    echo "September";

                                                  }else if($rs['target_month'] == '10'){

                                                    echo "October";

                                                  }else if($rs['target_month'] == '11'){

                                                    echo "November";

                                                  }else if($rs['target_month'] == '12'){

                                                    echo "December";

                                                  }

                                              ?></td>
                                              
                                              <td><?php echo $rs['target_amount']; ?></td>
                                              <td><?php                                              
                                                   $customer_name = getOne('tbl_customer','customer_id',$rs['customer_id']);
                                                   echo $customer_name =  $customer_name['customer_name']; 
                                              ?></td>
                                              <td><?php echo $rs['created_at']; ?></td>
                                              <td>
                                                 <?php
                                                     $delete_id = $rs['target_id'];  
                                                     $delete_array = array(
                                                     'column' => array('target_id'),
                                                     'table' => array('tbl_target')
                                                     );
                                                     $delete_info = json_encode($delete_array);
                                                   ?>  
                                                     <a href="javascript:;" data-delete-id="<?php echo $delete_id; ?>" 
                                                        data-delete-info='<?php echo $delete_info; ?>' 
                                                        data-tr-id="<?php echo $i; ?>" 
                                                        class="btn btn-danger btn-xs delete-record">
                                                     <i class="fa fa-trash"></i></a>
                                              </td>
                                          </tr>
                                          <?php $i++; } ?>

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
         
         $('.delete-record').on('click', function () {

           var tr_id = $(this).attr('data-tr-id');
           var delete_id = $(this).attr('data-delete-id');
           var delete_info = $(this).attr('data-delete-info');

           if(confirm(" Are You Sure ?")){

             $.ajax({
               type: "POST",
               url: "../../ajax/delete.php",
               data: { delete_id : delete_id, delete_info : delete_info},
               dataType: "JSON",
               success: function (resp) {

                 // console.log(resp);
                 if(resp.status == '1'){
                   $('#tr_'+tr_id).fadeOut(800);
                 }else{
                   alert('Something Went Wrong');
                 }

               }
             });

           }

         });

      </script>

   </body>
</html>
