<?php

   require_once('../../functions.php');

   $request = json_decode(trim(file_get_contents('php://input')));

   $data = [];
   if(isset($request->order_id)){

         $order_id = $request->order_id;

         if(delete('tbl_orders','order_id',$order_id)){

            delete('tbl_order_detail','order_id',$order_id);
            delete('tbl_invoices','order_id',$order_id);
            delete('tbl_invoice_detail','order_id',$order_id);

            $status = 1;
            $message = "Order Deleted Successfully";

         }else{

            $status = 0;
            $message = "Failed to delete order";

         }

   }else{

		$status = 0;
		$message = 'Invalid request !';

   }

   $json = array('status' => $status, 'message' => $message);
   echo json_encode($json);
