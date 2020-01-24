<?php

 require_once('../../functions.php');

 $login_id = $_SESSION['nb_credentials']['user_id'];
 $login_type = $_SESSION['nb_credentials']['user_type'];

 $date = date('d-m-Y');

 if(isset($_POST['submit'])){
   
      $date_from = date('d-m-Y', strtotime($_POST['date_from']));

      if(isset($_POST['date_to']) && $_POST['date_to'] != ""){
         
          $date_to = date('d-m-Y', strtotime($_POST['date_to']));
          $claim_details = "SELECT claim_group_id,employee_id,claim_request_date,SUM(travel_distance) as total_travel_distance,travel_rate,SUM(total_travel_rate) as total_travel_rate,claim_status,(SELECT employee_name FROM tbl_employees WHERE employee_id = employee_id ORDER BY employee_id ASC LIMIT 1) AS employee_name,COUNT(*) as total_trips FROM tbl_employee_travel_claims WHERE claim_request_date BETWEEN '".$date_from."' AND '".$date_to."' GROUP BY claim_group_id ORDER BY claim_status ASC ";

      }else{
      
          $claim_details = "SELECT claim_group_id,employee_id,claim_request_date,SUM(travel_distance) as total_travel_distance,travel_rate,SUM(total_travel_rate) as total_travel_rate,claim_status,(SELECT employee_name FROM tbl_employees WHERE employee_id = employee_id ORDER BY employee_id ASC LIMIT 1) AS employee_name,COUNT(*) as total_trips FROM tbl_employee_travel_claims WHERE claim_request_date = '".$date_from."' GROUP BY claim_group_id ORDER BY claim_status ASC ";

      }

 }else{

    $claim_details = "SELECT claim_group_id,employee_id,claim_request_date,SUM(travel_distance) as total_travel_distance,travel_rate,SUM(total_travel_rate) as total_travel_rate,claim_status,(SELECT employee_name FROM tbl_employees WHERE employee_id = employee_id ORDER BY employee_id ASC LIMIT 1) AS employee_name,COUNT(*) as total_trips FROM tbl_employee_travel_claims GROUP BY claim_group_id ORDER BY claim_status ASC ";

 }

 $claim_details = getRaw($claim_details);


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
                           <h4 class="page-title">Employee Tracks</h4>
                           <div class="clearfix"></div>
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-sm-12">
                        <div class="card-box">
                           <div class="row">

                              <form method="post">


                               <!--   <div class="col-md-4">

                                    <div class="form-group">

                                       <label for="id">Select Employee<span class="text-danger">*</span></label>

                                       <select name="id" parsley-trigger="change" required="" class="form-control select2" id="id">

                                          <option value="0">All</option>

                                          <?php if(isset($employees)){ ?>

                                             <?php foreach($employees as $rs){ ?>

                                                <option value="<?php echo $rs['employee_id']; ?>"><?php echo $rs['employee_name']; ?></option>

                                             <?php } ?>

                                          <?php } ?>

                                       </select>

                                    </div>

                                 </div> -->

                                <div class="col-md-3">
                                  
                                  <div class="form-group">
                                    
                                    <label for="">* From Date : </label>
                                    <input type="date" class="form-control" name="date_from" <?php if(isset($date_from)){ echo "value=".date('Y-m-d', strtotime($date_from))."";  }else{ echo "value=".date('Y-m-d', strtotime($date)).""; } ?> required>

                                  </div>  

                                </div>

                                <div class="col-md-3">
                                  
                                  <div class="form-group">
                                    
                                    <label for="">To Date : </label>
                                    <input type="date" class="form-control" name="date_to" <?php if(isset($date_to)){ echo "value=".date('Y-m-d', strtotime($date_to))."";  } ?>>

                                  </div>  

                                </div>



                                 <div class="col-md-3">
                                    <br>
                                    <button type="submit" name="submit" class="btn btn-primary btn-md"><i class="fa fa-filter"></i> Filter</button>
                                 </div>


                              </form>

                           </div>
                           
                           <div class="row">

                           		<table class="table table-striped table-bordered table-condensed table-hover" style="margin-top: 50px;">
                           			
                           			<thead>
                                       <tr>
                                       <th width="2%">Sr.</th>
                                       <th width="20%">Employee</th>
                                       <th width="5%">Claim Group Id</th>
                                       <th width="8%">Date</th>
                                       <th class="text-center" width="5%">Total Travelled</th>
                                       <th class="text-center" width="10%">Travel Rate</th>
                                       <th class="text-center" width="10%">Total Travel Rate</th>
                                       <th class="text-center" width="5%">Total Trips</th>
                                       <th class="text-center" width="10%">Claim Status</th>
                                       </tr>
                           			</thead>

                           			<tbody>
                           				
                           				<?php if(isset($claim_details) && count($claim_details) > 0){ ?>

                           					<?php $i=1; foreach($claim_details as $rs){ ?>

                           					<tr>
                                             <td><?php echo $i++; ?></td>
                                             <td><?php echo $rs['employee_name']; ?></td> 
                                             <td><?php echo $rs['claim_group_id']; ?></td>
                                             <td><?php echo $rs['claim_request_date']; ?></td>
                                             <td class="text-center"><?php echo $rs['total_travel_distance']; ?></td>
                                             <td class="text-center"><?php echo $rs['travel_rate']; ?></td>
                                             <td class="text-center"><?php echo "<i class='fa fa-rupee'></i> ".$rs['total_travel_rate']; ?></td>
                                             <td class="text-center"><a href='employee_tracking.php?claim_group_id=<?php echo $rs['claim_group_id']; ?>'><?php echo $rs['total_trips']; ?></a></td>
                                             <td class="text-center"><?php 
                                                   /*
                                                   claim status for app
                                                   --------------------
                                                   // [no use here] 0 - display button "no claim"
                                                   1 - show status "open" (claim requested by employee but not approved by admin)
                                                   2 - display button "accept claim"
                                                   3 - show status "closed"
                                                   */
                                                   if($rs['claim_status'] == 1){
                                                      // pending for admin approval
                                                   ?>
                                                      <button class="btn btn-success btn-xs claim-accept" id="<?php echo $rs['claim_group_id']; ?>">Accept Claim</button>
                                                   <?php
                                                   }else if($rs['claim_status'] == 2){
                                                      // open - pending for employee confirmation
                                                      echo '<span class="badge badge-pill badge-danger">Open</span>';

                                                   }else if($rs['claim_status'] == 3){
                                                      // closed or confirmed by employee
                                                      echo '<span class="badge badge-pill badge-success">Closed</span>';

                                                   }

                                             ?></td>
                           					</tr>
                           					<?php } ?>

                           				<?php }else{ ?>

                                          <tr>
                                             <td colspan="9" class="text-center">No Records Found</td>
                                          </tr>

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
         
         $('.claim-accept').on('click', function(){
               
            var claim_group_id = $(this).attr('id');
           
            if(confirm('are you sure ?')){
               
               $.ajax({

                     url : 'ajax/accept_group_claim_request.php',
                     type : 'POST',
                     dataType : 'json',
                     data : { claim_group_id : claim_group_id },
                     success : function(data){
                        // alert(data.msg);
                        console.log(data);
                     }

               });

            }
            

         });

      </script>

   </body>
</html>
