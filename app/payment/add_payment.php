<?php

   require_once('../../functions.php');

   $request = json_decode(trim(file_get_contents('php://input')));

   $data = [];
   $last_payment_id = '';
   if(isset($request->payment_date) 
      && isset($request->customer_id)
      && isset($request->payment_mode)
      && isset($request->payment_amount)
   ){

      $form_data = array(  

      'customer_id' => $request->customer_id,

      'payment_date' => $request->payment_date,

      'payment_mode' => $request->payment_mode,

      'payment_amount' => $request->payment_amount,
      
      'payment_bank' => $request->payment_bank,

      'payment_utr_number' => $request->payment_utr_number,
      
      'payment_remark' => $request->payment_remark

      );


      if(insert('tbl_payments',$form_data)){              

        // 2 - SEND SMS TO ADMIN THAT YOU HAVE RECIEVED A PAYMENT REQUEST
        // $getCustomerDetails = getOne('tbl_customer','customer_id',$login_id);
        // $getAdminDetails = getOne('tbl_admins','admin_id',$getCustomerDetails['added_by']);
        // $admin_mobile = $getAdminDetails['admin_mobile'];
        // $customer_name = $getCustomerDetails['customer_name'];
        // $message = "You have a payment approval request of ".$_POST['payment_amount']." from ".$customer_name." ";
        // sendSMS($admin_mobile,$message);


          $last_payment_id = last_id('tbl_payments','payment_id'); 
       
          $status = 1;
          $message = "Thanks, Your Payment Request has Sent to Admin for Approval ";
        
        }else{
            
          $status = 0;
          $message = "Something went wrong, please try again later";
        
        }

   }else{

		$status = 0;
		$message = 'Invalid request !';

   }

   $json = array('status' => $status, 'message' => $message,'payment_id'=>$last_payment_id);
   echo json_encode($json);
