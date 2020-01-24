<?php

   require_once('../../functions.php');

   $request = json_decode(trim(file_get_contents('php://input')));

   $data = null;

   if(isset($request->employee_id)){
         
         $date = date('d-m-Y');
         $employee_id = $request->employee_id;
         
         $get = 'SELECT * FROM tbl_employee_trip WHERE employee_id = "'.$employee_id.'" AND date = "'.$date.'" ';         
         $get = getRaw($get);
         
         if(count($get)>0){

            if($get[0]['status'] == '1'){
               $msg = "trip has finished";
            }else{
               $msg = "trip already running";
            }            
            $status = 1;
            $data = ['trip_id'=>$get[0]['trip_id']];

         }else{
            $status = 0;
            $msg = "trip is not running yet";
         }		

   }else{


		$status = 0;
		$message = 'Invalid request !';

   }

   $data = array('status' => $status, 'message' => $msg, 'data'=>$data);
   echo json_encode($data);
