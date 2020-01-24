<?php

   require_once('../../functions.php');

   $request = json_decode(trim(file_get_contents('php://input')));

   $data = [];
   if(isset($request->customer_id)){

         $customer_id = $request->customer_id;

         $total_orders = count(getWhere('tbl_orders','user_id',$customer_id));
         $today_orders = "SELECT * FROM tbl_orders WHERE user_id = '$customer_id' AND DATE(created_at) = DATE(NOW())";
         $today_orders = count(getRaw($today_orders));


          $current_month_target = "SELECT IFNULL(target_amount,0) as target_amount FROM tbl_target WHERE target_year = ".date('Y')." AND target_month = ".date('m')." AND customer_id = ".$customer_id." ";
          $current_month_target = getRaw($current_month_target);
          $current_month_target = $current_month_target[0]['target_amount']; 
          if($current_month_target == ""){
              $current_month_target = 0;
          }else{
              $current_month_target = number_format($current_month_target,0);
          }

           $month_target_achieved = number_format(getInvoiceAchieveTotal($customer_id,date('Y'),date('m')),0);

           $totalReceivedAmount = "SELECT IFNULL(SUM(payment_amount),0) as total_amount FROM tbl_payments WHERE customer_id = '$customer_id' AND payment_status = '1'";
           $totalReceivedAmount = getRaw($totalReceivedAmount);
           $totalReceivedAmount = $totalReceivedAmount[0]['total_amount'];

           $totalOrderAmount = getInvoiceAchieveTotal($customer_id,'','',1); 
           if($totalOrderAmount == ''){
               $totalOrderAmount = 0;
           }

           $totalPendingAmount = $totalOrderAmount - $totalReceivedAmount;
           $totalPendingAmount = number_format($totalPendingAmount,0);

           $data = array(
            'today_orders' => $today_orders,
            'total_orders' => $total_orders,
            'current_month_target' => $current_month_target,
            'month_target_achieved' => $month_target_achieved,
            'totalPendingAmount' => $totalPendingAmount
           );

           $status = 1;
           $message = "data found";

   }else{

		$status = 0;
		$message = 'Invalid request !';

   }

   $json = array('status' => $status, 'message' => $message,'data'=>$data);
   echo json_encode($json);
