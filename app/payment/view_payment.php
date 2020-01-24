<?php

   require_once('../../functions.php');

   $request = json_decode(trim(file_get_contents('php://input')));

   $data = [];
   if(isset($request->customer_id)){

         $customer_id = $request->customer_id;
         $payments = getWhere('tbl_payments','customer_id',$customer_id);

   		if(count($payments) > 0){

            foreach($payments as $rs){

               $dataset['payment_date'] = date('d-m-Y',strtotime($rs['payment_date']));
               $dataset['payment_amount'] = $rs['payment_amount'];
               $dataset['payment_bank'] = $rs['payment_bank'];
               $dataset['payment_mode'] = $rs['payment_mode'];
               $dataset['payment_utr_number'] = $rs['payment_utr_number'];
               
               if($rs['payment_status'] == '0'){ 
                  $dataset['payment_status'] = 'Pending';
               }else{ 
                  $dataset['payment_status'] = 'Approved';
               }
               
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
