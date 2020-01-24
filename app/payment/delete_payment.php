<?php

   require_once('../../functions.php');

   $request = json_decode(trim(file_get_contents('php://input')));

   $data = [];
   if(isset($request->payment_id)){

         $payment_id = $request->payment_id;

         if(delete('tbl_payments','payment_id',$payment_id)){

            $status = 1;
            $message = "Payment Deleted Successfully";

         }else{

            $status = 0;
            $message = "Failed to delete payment";

         }

   }else{

		$status = 0;
		$message = 'Invalid request !';

   }

   $json = array('status' => $status, 'message' => $message);
   echo json_encode($json);
