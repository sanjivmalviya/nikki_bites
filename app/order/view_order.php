<?php

   require_once('../../functions.php');

   $request = json_decode(trim(file_get_contents('php://input')));

   $data = [];
   if(isset($request->customer_id)){

         $customer_id = $request->customer_id;
   		$orders = getRaw('SELECT * FROM tbl_orders WHERE user_type = "4" AND user_id = '.$customer_id.' ');

   		if(count($orders) > 0){

            foreach($orders as $rs){

               // Total Order Amount

               $dataset['order_id'] = $rs['order_id'];
               $order_detail = getWhere('tbl_order_detail','order_id',$rs['order_id']);

               $order_amount = 0;
               $product_count = 0;
               if(isset($order_detail)){ 

                     foreach($order_detail as $val){

                        $product_count++;

                        $product_rate = $val['order_product_quantity'] * $val['order_product_rate'] - ($val['order_product_discount'] * $val['order_product_rate'] * $val['order_product_quantity'] / 100);
                         $order_amount += $product_rate; 

                     }
                     
               }
               $dataset['order_amount'] = $order_amount;
               $dataset['total_product_ordered'] = $product_count;

               $dataset['order_number'] = $rs['order_number'];
               if($rs['order_approve_status'] == '0'){ 
                  $dataset['order_approve_status'] = 'Pending'; 
                }else{ 
                  $dataset['order_approve_status'] = 'Approved'; 
               }
               if($rs['order_dispatch_status'] == '0'){ 
                  $dataset['order_dispatch_status'] = 'Pending'; 
                }else if($rs['order_dispatch_status'] == '0'){ 
                  $dataset['order_dispatch_status'] = 'Dispatched'; 
               }else if($rs['order_dispatch_status'] == '0'){
                  $dataset['order_dispatch_status'] = 'Partially Dispatched'; 
               }
               $total_invoices = getWhere('tbl_invoices','order_id',$rs['order_id']);
               $dataset['total_invoices'] = count($total_invoices);                
               $dataset['created_at'] = date('d-m-Y',strtotime($rs['created_at']));
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
