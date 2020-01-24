<?php
      
   // ReadMe : You have to put this api on automation where it will be called automatically based on a time given.  

   require_once('../../functions.php');

   $request = json_decode(trim(file_get_contents('php://input')));

   $data = null;
   if(isset($request->trip_id) && isset($request->latitude) && isset($request->longitude)){

         $check = "SELECT * FROM tbl_employee_trip WHERE trip_id = '".$request->trip_id."' AND status = '0' ";
         
         if(count(getRaw($check)) > 0){
            
            $date = date('d-m-Y'); 
            $employee_id = getOne('tbl_employee_trip','trip_id',$request->trip_id);
            $employee_id = $employee_id['employee_id'];

            $form_data = array(
               'trip_id' => $request->trip_id,
      			'employee_id' => $employee_id,
      			'latitude' => $request->latitude,
      			'longitude' => $request->longitude,
               'date' => date('d-m-Y')
      		);

      		if(insert('tbl_employee_trip_detail',$form_data)){

               $last_id = last_id('tbl_employee_trip_detail','detail_id');
      			
      			$status = 1;
      			$message = 'trip added successfully';
               $data = ['trip_detail_id'=>$last_id];

      		}else{

      			$status = 0;
      			$message = 'Failed to add trip, please try again later';

      		}

         }else{

            $status = 0;
            $message = 'sorry, trip has already ended or even not started yet';

         }
   		
   }else{

		$status = 0;
		$message = 'Invalid request !';

   }

   $data = array('status' => $status, 'message' => $message, 'data'=>$data);
   echo json_encode($data);
