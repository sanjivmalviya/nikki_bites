<?php

   require_once('../../functions.php');

   $request = json_decode(trim(file_get_contents('php://input')));

   $data = null;
   if(isset($request->employee_id) && isset($request->latitude) && isset($request->longitude) && isset($request->trip_id)){
   		
         $employee_id = $request->employee_id;
         $trip_id = $request->trip_id;
         $latitude = $request->latitude;
         $longitude = $request->longitude;

         $get = 'SELECT * FROM tbl_employee_trip WHERE employee_id = "'.$employee_id.'" AND trip_id = "'.$trip_id.'" AND status = "0" ';
         $get = getRaw($get);
         
         if(count($get) > 0){

            $update = 'UPDATE tbl_employee_trip SET status = "1",end_latitude = '.$latitude.',end_longitude = '.$longitude.' WHERE employee_id = "'.$employee_id.'" AND trip_id = "'.$trip_id.'" ';
            
            if(query($update)){
   			   $status = 1;
   			   $message = 'trip ended successfully';

               // purpose : collect all stored co-ordinates including day_in,multiple trips and day_out to build distance matrix api
               // use of below api : to get distance in miles and travel time in mins for one source to multiple destinations seperated by |.
               
               $get_trip = 'SELECT * FROM tbl_employee_trip WHERE employee_id = "'.$employee_id.'" AND trip_id = "'.$trip_id.'" AND status = "1" ';
               $get_trip = getRaw($get_trip);
               
               $source_cordinates =  $get_trip[0]['start_latitude'].",".$get_trip[0]['start_longitude'];
               
               $get_trip_detail = 'SELECT * FROM tbl_employee_trip_detail WHERE employee_id = "'.$employee_id.'" AND trip_id = "'.$trip_id.'" ';
               $get_trip_detail = getRaw($get_trip_detail);

               $mid_cordinates = "";
               foreach($get_trip_detail as $rs){
                     $dataset[] = $rs['latitude'].",".$rs['longitude'];
               }
               array_unshift($dataset, $source_cordinates);

               $limit = count($dataset);
               $origin_cordinates = "";
               for($i=0;$i<$limit-1;$i++){
                  if($i==$limit-2){
                     $origin_cordinates .= $dataset[$i];
                  }else{
                     $origin_cordinates .= $dataset[$i]."|";
                  }
               }
               $destination_cordinates = "";
               for($i=1;$i<$limit;$i++){
                  if($i==$limit-1){
                     $destination_cordinates .= $dataset[$i];
                  }else{
                     $destination_cordinates .= $dataset[$i]."|";
                  }
               }

               $api_url = "https://maps.googleapis.com/maps/api/distancematrix/json?units=imperial&origins=".$origin_cordinates."&destinations=".$destination_cordinates."&key=AIzaSyA0siDlz7oiay5U2iLfyPRC7lavRnpcB9c";               
               $api_response = file_get_contents($api_url);

               $form_data = array(
                  'employee_id' => $employee_id,
                  'trip_id' => $trip_id,
                  'api_response' => $api_response
               );
               $saveApiResponse = insert('tbl_employee_trip_tracking',$form_data);

            }else{
               $status = 0;
               $message = 'failed to update status';
            }

   		}else{

   			$status = 0;
   			$message = 'invalid trip id or employee id';

   		}

   }else{

		$status = 0;
		$message = 'Invalid request !';

   }

   $data = array('status' => $status, 'message' => $message);
   echo json_encode($data);
