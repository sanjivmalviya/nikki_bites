<?php

require_once('../../functions.php');

$login_id = $_SESSION['nb_credentials']['user_id'];
$login_type = $_SESSION['nb_credentials']['user_type'];

$targets = getRaw('SELECT * FROM tbl_target WHERE customer_id = '.$login_id.' ORDER BY target_id DESC');

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
                                    <th class="text-center">Year</th>
                                    <th class="text-center">Month</th>
                                    <th class="text-center">Assigned</th>
                                    <th class="text-center">Achieved</th>
                                    <th class="text-center">Pending</th>
                                    <th class="text-center">Assigned at</th>
                                  </thead>

                                  <tbody>
                                     
                                     <?php if(isset($targets) && count($targets) > 0){ ?>

                                        <?php $i=1; foreach($targets as $rs){ ?>

                                        <tr id="tr_<?php echo $i; ?>">
                                            <td><?php echo $i; ?></td>
                                            <td class="text-center"><?php echo $rs['target_year']; ?></td>
                                            <td class="text-center"><?php    
                                                if($rs['target_month'] == "01"){
                                                  echo "January";
                                                }else if($rs['target_month'] == "02"){
                                                  echo "February";
                                                }else if($rs['target_month'] == "03"){
                                                  echo "March";
                                                }else if($rs['target_month'] == "04"){
                                                  echo "April";
                                                }else if($rs['target_month'] == "05"){
                                                  echo "May";
                                                }else if($rs['target_month'] == "06"){
                                                  echo "June";
                                                }else if($rs['target_month'] == "07"){
                                                  echo "July";
                                                }else if($rs['target_month'] == "08"){
                                                  echo "August";
                                                }else if($rs['target_month'] == "09"){
                                                  echo "September";
                                                }else if($rs['target_month'] == "10"){
                                                  echo "October";
                                                }else if($rs['target_month'] == "11"){
                                                  echo "November";
                                                }else if($rs['target_month'] == "12"){
                                                  echo "December";
                                                } 
                                            ?></td>
                                            <td class="text-center"><?php echo $targetAmount = $rs['target_amount']; ?></td>
                                            <td class="text-center"><?php echo $achievedTotal = getInvoiceAchieveTotal($login_id,$rs['target_year'],$rs['target_month']); ?></td>
                                            <td class="text-center"><?php echo $pendingTotal = $targetAmount - $achievedTotal; ?></td>
                                            <td class="text-center"><?php echo $rs['created_at']; ?></td>
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
