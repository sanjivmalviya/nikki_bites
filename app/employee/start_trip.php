<?php

   require_once('../../functions.php');

   $request = json_decode(trim(file_get_contents('php://input')));

   $data = null;
   if(isset($request->employee_id) && isset($request->latitude) && isset($request->longitude)){
   	   
         $date = date('d-m-Y'); 
         $check = "SELECT * FROM tbl_employee_trip WHERE employee_id = '".$request->employee_id."' AND date = '".$date."' ";
         
         if(count(getRaw($check)) > 0){

               $status = 0;
               $message = 'trip already started';

         }else{

            $form_data = array(
      			'employee_id' => $request->employee_id,
      			'start_latitude' => $request->latitude,
               'start_longitude' => $request->longitude,
      			'date' => date('d-m-Y'),
      			'status' => "0"
      		);

      		if(insert('tbl_employee_trip',$form_data)){

               $last_id = last_id('tbl_employee_trip','trip_id');
      			
      			$status = 1;
      			$message = 'trip started successfully';
               $data = ['trip_id'=>$last_id];

      		}else{

      			$status = 0;
      			$message = 'Failed to start trip, please try again later';


      		}
            
         }



   }else{


		$status = 0;
		$message = 'Invalid request !';

   }

   $data = array('status' => $status, 'message' => $message, 'data'=>$data);
   echo json_encode($data);
