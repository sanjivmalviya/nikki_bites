<?php

   require_once('../../functions.php');

   $request = json_decode(trim(file_get_contents('php://input')));

   $data = null;

   if(isset($request->employee_id) && isset($request->trip_id) && count($request->trip_id) > 0){     

        $duplicate = 0;
        $last_id = last_id('tbl_employee_travel_claims','claim_group_id') + 1;

        foreach($request->trip_id as $trip_id){

          $check = "SELECT * FROM tbl_employee_travel_claims WHERE trip_id = '".$trip_id."' AND employee_id = '".$request->employee_id."' ";        
          $check = getRaw($check);

          if(isset($check) && count($check) > 0){
              
              $duplicate++; 
          
          }else{


            $api_response = "SELECT * FROM tbl_employee_trip_tracking WHERE trip_id = '".$trip_id."' AND employee_id = '".$request->employee_id."' ";
            $api_response = getRaw($api_response);
            $tracking_id = $api_response[0]['tracking_id'];

            $total_miles = 0;
            $total_km = 0;
            $$total_location_count = 0;
            if(isset($api_response)){
            
               $api_response =json_decode($api_response[0]['api_response'],true);

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

               // assigning new claim group id

              
               
               $form_data = array(
                'trip_id' => $trip_id,
                'employee_id' => $request->employee_id,
                'claim_request_date' => date('d-m-Y'),
                'travel_distance' => $dataset['total_travelled_distance'],
                'travel_rate' => $dataset['travel_rate'],
                'total_travel_rate' => $dataset['total_travel_rate'],
                'claim_group_id' => $last_id
               );

               if(insert('tbl_employee_travel_claims',$form_data)){
             
                  $status = 1;
                  $msg = "Request sent successfully";
             
               }else{
             
                  $status = 0;
                  $msg = "failed to send claim request";
             
               }


          }

      }

      if(count($request->trip_id) == $duplicate){
        $status = 0;
        $msg = "request already sent";
      }


   }else{


		$status = 0;
		$msg = 'Invalid request !';

   }

   $data = array('status' => $status, 'message' => $msg);
   echo json_encode($data);