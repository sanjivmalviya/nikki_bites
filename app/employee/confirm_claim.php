<?php

   require_once('../../functions.php');

   $request = json_decode(trim(file_get_contents('php://input')));

   $data = null;

   if(isset($request->employee_id) && isset($request->trip_id) && count($request->trip_id) > 0){     
     
      foreach($request->trip_id as $trip_id){

         $update = "UPDATE tbl_employee_travel_claims SET claim_status = '3',claim_close_date = '".date('d-m-Y')."' WHERE trip_id = '".$trip_id."' AND employee_id = '".$request->employee_id."' AND claim_status = '2' ";
   
         if(query($update)){
      
            $status = 1;
            $msg = "Claim confirmed successfully";
      
         }else{
         
            $status = 0;
            $msg = "failed to confirm claim";
         
         }

     }

   }else{

    $status = 0;
    $msg = 'Invalid request !';

   }

   $data = array('status' => $status, 'message' => $msg);
   echo json_encode($data);