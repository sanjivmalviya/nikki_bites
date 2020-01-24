<?php

 require_once('../../functions.php');

 $login_id = $_SESSION['nb_credentials']['user_id'];
 $login_type = $_SESSION['nb_credentials']['user_type'];

 $table_name = 'tbl_employee_trip_tracking';
 $field_name = 'trip_tracking_id';
 $date = date('d-m-Y');

 if(isset($_GET['tracking_id'])){

   $tracking_id = $_GET['tracking_id'];
   $tracking_detail = getOne('tbl_employee_trip_tracking','tracking_id',$tracking_id);
   $trip_id = $tracking_detail['trip_id'];
   $tracking_detail = json_decode($tracking_detail['api_response'], true);

   $distance_duration = array();
   foreach ($tracking_detail['rows'] as $rs) {
      $distance_duration = $rs['elements'];
   }


    $cordinates = "";
    $trip = getOne('tbl_employee_trip','trip_id',$trip_id);
    $dataset[] = array('lat'=>$trip['start_latitude'],'long'=>$trip['end_latitude']);

    $trip_details = getWhere('tbl_employee_trip_detail','trip_id',$trip_id);
    foreach($trip_details as $rs){
      $dataset[] = array("lat"=>$rs['latitude'],"lng"=>$rs['longitude']);
    }

    $cordinates = json_encode($dataset, JSON_NUMERIC_CHECK);
    
 }


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
                           <h4 class="page-title">Employee Track Details</h4>
                           <div class="clearfix"></div>
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-sm-12">
                        <div class="card-box">
                           
                           <div class="row">

                                 <div class="col-md-12 text-right">

                                    <!-- <form action="employee_tracking_map.php" method="POST">
                                       <input type="hidden" name="cordinates" value="<?php echo urlencode($cordinates); ?>">
                                    </form> -->
                                       <a href="employee_tracking_map.php?trip_id=<?php echo $trip_id; ?>" type="submit" class="btn btn-default btn-sm"><i class="fa fa-map"></i> Track on Map</a>

                                    
                                 </div>  

                           		<table class="table table-bordered table-condensed table-hover" style="margin-top: 50px;">
                           			
                           			<thead>
                                       <tr>
                                       <th width="3%">Sr.</th>
                                       <th width="32%">From</th>
                                       <th width="32%">To</th>
                                       <th width="10%" >Distance (in KM)</th>
                                       <th width="10%">Duration</th>
                                       </tr>
                           			</thead>

                           			<tbody>
                           				
                           				<?php if(isset($tracking_detail) && count($tracking_detail) > 0){ ?>

                           					<?php  

                                          $sr = 1;
                                          $total_distance = 0;
                                          $total_duration = 0;
                                          $total_location_count = count($tracking_detail['destination_addresses']);

                                          for($i=0;$i<$total_location_count;$i++){ ?>

                           					<tr>
                                             <td><?php echo $sr++; ?></td>
                                             <td><?php echo '<i class="fa fa-map-marker" style="font-size:20px;" aria-hidden="true"></i> '.$tracking_detail['origin_addresses'][$i]; ?></td>
                                             <td><?php echo '<i class="fa fa-map-marker" style="font-size:20px;" aria-hidden="true"></i> '.$tracking_detail['destination_addresses'][$i]; ?></td>
                                             <td><?php

                                                   $distance = $tracking_detail['rows'][$i]['elements'][$i]['distance']['value'] / 1000; // to convert meters to km
                                                   $distance = number_format($distance,2);
                                                   $total_distance += $distance;
                                                   echo $distance." KM";

                                                   // $distance_data = explode(" ", $distance_duration[$j]['distance']['text']);
                                                  
                                             ?></td>
                                             <td>
                                                <?php 
                                                   $duration = $tracking_detail['rows'][$i]['elements'][$i]['duration']['value'];
                                                   $total_duration += $duration;
                                                   echo gmdate("H:i:s", $duration);
                                                ?>
                                             </td>
                           					</tr>
                           					<?php } ?>

                                          <tr>
                                             <td style="font-size: 17px;" colspan="3" class="text-center"><h5>TOTAL TRAVELLED</h5></td>
                                             <td style="font-size: 17px;"><?php echo $total_distance . "KM"; ?></td>
                                             <td style="font-size: 17px;"><?php echo gmdate('H:i:s',$total_duration); ?></td>
                                          </tr>

                           				<?php }else{ ?>

                                          <tr>
                                             <td colspan="8" class="text-center">No Records Found</td>
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
         
         $(function(){

            $('.danger').popover({ html : true});

         });

      </script>

   </body>
</html>
