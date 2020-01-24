<?php

   require_once('../../functions.php');

   $request = json_decode(trim(file_get_contents('php://input')));

   $data = [];
   if(isset($request->customer_id)){

         $customer_id = $request->customer_id;
   		$targets = getRaw('SELECT * FROM tbl_target WHERE customer_id = '.$customer_id.' ORDER BY target_id DESC');

   		if(count($targets) > 0){

            foreach($targets as $rs){

               $dataset['customer_id'] = $rs['customer_id'];
               $dataset['year'] = $rs['target_year'];
               $dataset['month'] = $rs['target_month'];
               $dataset['target_amount'] = $rs['target_amount'];
               $dataset['target_achieved'] = getInvoiceAchieveTotal($rs['customer_id'],$rs['target_year'],$rs['target_month']);
               $dataset['outstanding'] = $dataset['target_amount'] - $dataset['target_achieved'];
               
               if($dataset['target_achieved'] < $dataset['target_amount']){ 
                  $dataset['target_status'] = "Pending"; 
               }else{ 
                  $dataset['target_status'] = "Completed"; 
               }
               $dataset['percentage'] = $dataset['target_achieved'] / $dataset['target_amount'] * 100;

               // get total orders
               $total_orders = "SELECT IFNULL(COUNT(*),0) as total_orders FROM tbl_orders WHERE user_type = '4' AND user_id = '".$dataset['customer_id']."' AND YEAR(created_at) = '".$dataset['year']."' AND MONTH(created_at) = '".$dataset['month']."' ";
               $total_orders = getRaw($total_orders);
               $dataset['total_orders'] = $total_orders[0]['total_orders'];
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
