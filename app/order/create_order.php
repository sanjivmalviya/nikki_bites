<?php

   require_once('../../functions.php');

   $request = json_decode(trim(file_get_contents('php://input')));

   $data = [];
   if(isset($request->customer_id) && isset($request->order_detail)){

       $user_type = '4';
       $user_id = $request->customer_id;

       // create order id
       $next_id = 'SELECT AUTO_INCREMENT FROM information_schema.TABLES WHERE TABLE_SCHEMA = "'.DB.'" AND TABLE_NAME = "tbl_orders" ';
       $next_id = getRaw($next_id);
       $next_id = $next_id[0]['AUTO_INCREMENT'];
       $order_number = 'ORD/'.sprintf('%05d',($next_id));

       $form_data = array(
         'user_type' => $user_type,
         'user_id' => $user_id,
         'order_number' => $order_number
       );

       if(insert('tbl_orders',$form_data)){

        $last_id = last_id('tbl_orders','order_id');

        // 3 - SEND SMS TO ADMIN THAT YOU HAVE RECIEVED AN ORDER
        // $getCustomerDetails = getOne('tbl_customer','customer_id',$user_id);
        // $getAdminDetails = getOne('tbl_admins','admin_id',$getCustomerDetails['added_by']);
        // $admin_mobile = $getAdminDetails['admin_mobile'];
        // $customer_name = $getCustomerDetails['customer_name'];
        // $message = "You have a recieved an order from ".$customer_name.", Your Order Number is ".$order_number." ";
        // sendSMS($admin_mobile,$message);

        $i=0;
        foreach($request->order_detail as $rs){

            $form_data = array(
              'order_id' => $last_id,
              'order_product_id' => $rs->order_product_id,
              'order_product_quantity' => $rs->order_product_quantity,
              'order_product_discount' => $rs->order_product_discount,
              'order_product_rate' => $rs->order_product_rate
            );
            
            if(insert('tbl_order_detail',$form_data)){
              $insert = '1';
            }

            $i++;
            
        }

        if($insert == '1'){
        
          $status = 1;
          $message = "Order created successfully";
        
        }else{
            
          $status = 0;
          $message = "Something went wrong, please try again later";
        
        }

    }

   }else{

		$status = 0;
		$message = 'Invalid request !';

   }

   $json = array('status' => $status, 'message' => $message);
   echo json_encode($json);
