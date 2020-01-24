<?php

 require_once('../../functions.php');

 $login_id = $_SESSION['nb_credentials']['user_id'];
 $login_type = $_SESSION['nb_credentials']['user_type'];

 $table_name = 'tbl_employee_trip_tracking';
 $field_name = 'trip_tracking_id';
 $date = date('d-m-Y');

 if(isset($_POST['submit'])){
        
      $date_from = date('d-m-Y', strtotime($_POST['date_from']));

      if(isset($_POST['date_to']) && $_POST['date_to'] != ""){
         
          $date_to = date('d-m-Y', strtotime($_POST['date_to']));
          $trip_details = "SELECT employee_id,`date`,trip_id,(SELECT employee_name FROM tbl_employees WHERE employee_id = et.employee_id) AS employee_name FROM tbl_employee_trip et WHERE `date` BETWEEN '".$date_from."' AND '".$date_to."' ORDER BY created_at ";

      }else{
      
         $trip_details = "SELECT employee_id,`date`,trip_id,(SELECT employee_name FROM tbl_employees WHERE employee_id = et.employee_id) AS employee_name FROM tbl_employee_trip et WHERE `date` = '".$date_from."' ORDER BY created_at ";

      }
      
 }else if(isset($_GET['claim_group_id'])){

   $trip_details = "SELECT et.employee_id,et.date,et.trip_id,(SELECT employee_name FROM tbl_employees WHERE employee_id = et.employee_id) AS employee_name FROM tbl_employee_trip et INNER JOIN tbl_employee_travel_claims ec ON ec.trip_id = et.trip_id WHERE ec.claim_group_id = '".$_GET['claim_group_id']."' ORDER BY et.trip_id ASC ";
   
 }else{

    $trip_details = "SELECT employee_id,`date`,trip_id,(SELECT employee_name FROM tbl_employees WHERE employee_id = et.employee_id) AS employee_name FROM tbl_employee_trip et WHERE `date` = '".$date."' ORDER BY created_at ";

 }

 $trip_details = getRaw($trip_details);

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
                                    <a href="employee_tracking.php" class="btn btn-default btn-md"><i class="fa fa-filter"></i> Reset</a>
                                 </div>

                              </form>

                           </div>
                           
                           <div class="row">

                           		<table class="table table-striped table-bordered table-condensed table-hover" style="margin-top: 50px;">
                           			
                           			<thead>
                                       <tr>
                                       <th width="2%">Sr.</th>
                                       <th width="10%">Employee</th>
                                       <th width="5%">Trip Id</th>
                                       <th width="8%">Date</th>
                                       <th width="20%">Start Location</th>
                                       <th width="20%">End Location</th>
                                       <th width="5%">Total Travelled (in KM)</th>
                                       <th width="10%">Travel Rate</th>
                                       <th width="10%">Total Travel Rate</th>
                                       <th width="10%">Claim Status</th>
                           				<th width="8%" class="text-center">Actions</th>
                                       </tr>
                           			</thead>

                           			<tbody>
                           				
                           				<?php if(isset($trip_details) && count($trip_details) > 0){ ?>

                           					<?php $i=1; foreach($trip_details as $rs){ ?>

                           					<tr>
                                             <td><?php echo $i++; ?></td>
                                             <td><?php echo $rs['employee_name']; ?></td> 
                                             <td><?php echo $rs['trip_id']; ?></td>
                                             <td><?php echo $rs['date']; ?></td>
                                             <?php 
                                            
                                                $start_location = "-";
                                                $end_location = "-";
                                                $api_calls = "-";

                                                $api_response = "SELECT * FROM tbl_employee_trip_tracking WHERE trip_id = '".$rs['trip_id']."' ";
                                                $api_response = getRaw($api_response);
                                                $tracking_id = $api_response[0]['tracking_id'];

                                                $total_miles = 0;
                                                $total_km = 0;
                                                $$total_location_count = 0;
                                                if(isset($api_response)){
                                                
                                                   $api_response =json_decode($api_response[0]['api_response'],true);
                                                   $start_location = $api_response['origin_addresses'][0]; 
                                                   $end_location = end($api_response['destination_addresses']);

                                                   $total_distance = 0;
                                                   $total_location_count = count($api_response['destination_addresses']);

                                                   for($i=0;$i<$total_location_count;$i++){ 

                                                      $distance = $api_response['rows'][$i]['elements'][$i]['distance']['value'] / 1000; // to convert meters to km
                                                      $distance = number_format($distance,2);
                                                      $total_distance += $distance;

                                                   }

                                                }
                                             ?>
                                             
                                             <td><?php echo $start_location; ?></td>
                                             <td><?php echo $end_location; ?></td>
                                             <td><?php if($total_distance > 0){ echo number_format($total_distance,2); }else{  echo "-"; } ?></td>
                                             <td>
                                                <?php 

                                                   $employee = getOne('tbl_employees','employee_id',$rs['employee_id']);
                                                   echo $employee_travel_rate = $employee['employee_travel_rate'];
                                                ?>
                                             </td>
                                             <td> <?php echo "<i class='fa fa-rupee'></i> ".$total_travel_rate = $total_distance * $employee_travel_rate; ?> </td>
                                             <td><?php 
                                                      $employee_travel_claims = getOne('tbl_employee_travel_claims','trip_id',$rs['trip_id']);
                                                      if(isset($employee_travel_claims)){
                                                         /*
                                                         claim status for app
                                                         --------------------
                                                         0 - display button "no claim"
                                                         1 - show status "open" (claim requested by employee but not approved by admin)
                                                         2 - display button "accept claim"
                                                         3 - show status "closed"
                                                         */
                                                         if($employee_travel_claims['claim_status'] == 1){
                                                            // pending for admin approval
                                                         ?>
                                                            <button class="btn btn-success btn-xs claim-accept" id="<?php echo $employee_travel_claims['claim_id']; ?>">Accept Claim</button>
                                                         <?php
                                                         }else if($employee_travel_claims['claim_status'] == 2){
                                                            // open - pending for employee confirmation
                                                            echo '<span class="badge badge-pill badge-danger">Open</span>';

                                                         }else if($employee_travel_claims['claim_status'] == 3){
                                                            // closed or confirmed by employee
                                                            echo '<span class="badge badge-pill badge-success">Closed</span>';

                                                         }
                                                      }else{
                                                         echo '<span class="badge badge-pill badge-dark">No Claim</span>';
                                                      }
                                             ?></td>
                                             <td class="text-center"><a class='btn btn-xs btn-primary'  
                                             title="More details about employee" href='employee_tracking_route.php?tracking_id=<?php echo $tracking_id; ?>'  <?php if(!isset($api_response)){ echo "disabled"; } ?> >View Route</a>
                                             </td>
                           					</tr>
                           					<?php } ?>

                           				<?php }else{ ?>

                                          <tr>
                                             <td colspan="11" class="text-center">No Records Found</td>
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
               
            var claim_id = $(this).attr('id');

            if(confirm('are you sure ?')){
               
               $.ajax({

                     url : 'ajax/accept_claim_request.php',
                     type : 'POST',
                     dataType : 'json',
                     data : { claim_id : claim_id },
                     success : function(data){
                        alert(data.msg);
                        // console.log(data);
                     }

               });

            }
            

         });

      </script>

   </body>
</html>
