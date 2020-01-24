<?php

   require_once('../../functions.php');

   $request = json_decode(trim(file_get_contents('php://input')));

   $data = null;

   if(isset($request->employee_id)){         

       $date = date('d-m-Y');

       if(isset($request->date_from)){
            
            $date_from = date('d-m-Y', strtotime($request->date_from));
           
            if(isset($request->date_to) && $request->date_to != ""){
               
                $date_to = date('d-m-Y', strtotime($request->date_to));
                $trip_details = "SELECT `date`,trip_id FROM tbl_employee_trip et WHERE employee_id = '".$request->employee_id."' AND status = '1' AND `date` BETWEEN '".$date_from."' AND '".$date_to."' ORDER BY created_at ";

            }else{
            
               $trip_details = "SELECT `date`,trip_id FROM tbl_employee_trip et WHERE employee_id = '".$request->employee_id."' AND status = '1' AND `date` = '".$date_from."' ORDER BY created_at ";

            }

            $trip_details = getRaw($trip_details);
            
       }else{

          $trip_details = "SELECT `date`,trip_id FROM tbl_employee_trip et WHERE `date` = '".$date."' AND status = '1' AND et.employee_id = '".$request->employee_id."' ORDER BY created_at ";
          $trip_details = getRaw($trip_details);

       }

       if(isset($trip_details) && count($trip_details) > 0){ 

         $i=1; 
         foreach($trip_details as $rs){ 

            // $dataset['employee_name'] = $rs['employee_name']; 
            $dataset['trip_id'] = $rs['trip_id']; 
            $dataset['date'] = $rs['date']; 
           
            $start_location = "-";
            $end_location = "-";
            $api_calls = "-";

            $api_response = "SELECT * FROM tbl_employee_trip_tracking WHERE trip_id = '".$rs['trip_id']."' ";
            $api_response = getRaw($api_response);
            $tracking_id = $api_response[0]['tracking_id'];
            $dataset['tracking_id'] = $tracking_id;

            $total_miles = 0;
            $total_km = 0;
            $$total_location_count = 0;
            if(isset($api_response)){
            
               $api_response =json_decode($api_response[0]['api_response'],true);
               $dataset['start_location'] = $api_response['origin_addresses'][0]; 
               $dataset['end_location'] = end($api_response['destination_addresses']);

               $total_travelled_distance = 0;
               $total_location_count = count($api_response['destination_addresses']);

               for($i=0;$i<$total_location_count;$i++){ 

                  $distance = $api_response['rows'][$i]['elements'][$i]['distance']['value'] / 1000; // to convert meters to km
                  $distance = number_format($distance,2);
                  $total_travelled_distance += $distance;
                  $dataset['total_travelled_distance'] = (string)$total_travelled_distance." KM";

               }

               }

               // calculate amount to be paid based on total distance travelled by employee
               $employee = getOne('tbl_employees','employee_id',$request->employee_id); 
               $dataset['travel_rate'] = $employee['employee_travel_rate'];
               $total_travel_rate = $total_travelled_distance * $dataset['travel_rate'];
               $dataset['total_travel_rate'] = (string)number_format($total_travel_rate,2);

               // get claim details from employee_travel_claims
               $employee_travel_claims = getOne('tbl_employee_travel_claims','trip_id',$rs['trip_id']);
               if(isset($employee_travel_claims)){
                  /*
                  claim status for app
                  --------------------
                  0 - display button "claim now"
                  1 - show status "open" (claim requested by employee but not approved by admin)
                  2 - display button "accept claim"
                  3 - show status "closed"
                  */
                  $dataset['claim_status'] = (string)$employee_travel_claims['claim_status'];
               }else{
                  $dataset['claim_status'] = "0";
               }
               
               $data[] = $dataset;
            
            }

         }

         if(isset($data) && count($data) > 0){
            $status = 1;
            $msg = "data found";
         }else{
            $status = 0;
            $msg = "no data found";
         }

   }else{ 

		$status = 0;
		$msg = 'Invalid request !';

   }

   $data = array('status' => $status, 'message' => $msg, 'data'=>$data);
   echo json_encode($data);