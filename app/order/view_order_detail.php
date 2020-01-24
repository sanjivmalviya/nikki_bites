<?php

   require_once('../../functions.php');

   $request = json_decode(trim(file_get_contents('php://input')));

   $data = [];
   if(isset($request->order_id)){

         $order_id = $request->order_id;
         $order_detail = getWhere('tbl_order_detail','order_id',$order_id);

   		if(count($order_detail) > 0){

            foreach($order_detail as $rs){

               $product = getOne('tbl_product','product_id',$rs['order_product_id']); 
               $dataset['product_name'] = $product['product_name'];
               
               $dataset['product_quantity'] = $rs['order_product_quantity'];

               $order_dispatch_qty = "SELECT IFNULL(SUM(dispatch_quantity),0) as dispatch_quantity FROM tbl_invoice_detail WHERE order_detail_id = '".$rs['order_detail_id']."' "; 
               $order_dispatch_qty = getRaw($order_dispatch_qty);
               $dataset['dispatch_quantity'] = $order_dispatch_qty[0]['dispatch_quantity'];

               $dataset['product_discount'] = $rs['order_product_discount'];
               $dataset['product_rate'] = $rs['order_product_rate'];
               $data[] = $dataset;

            }
   			
   			$status = 1;
   			$message = 'data found';

   		}else{

   			$status = 0;
   			$message = 'no data found';

   		}

   }else{

		$status = 0;
		$message = 'Invalid request !';

   }

   $json = array('status' => $status, 'message' => $message,'data'=>$data);
   echo json_encode($json);
