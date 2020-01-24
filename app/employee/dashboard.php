<?php

   require_once('../../functions.php');

   $request = json_decode(trim(file_get_contents('php://input')));

   $data = [];
   if(isset($request->employee_id)){

         $employee_id = $request->employee_id;

         // total grant leaves counter 
         $grant_leave_counter = getWhere('tbl_employee_grant_leaves','employee_id',$employee_id);
         $total_grant_leaves = 0;
         if(count($grant_leave_counter) > 0){
            foreach($grant_leave_counter as $rs){
               $total_grant_leaves += $rs['total_days']; 
            }
         }

         // total leaves this year
         $total_leave_counter = 'SELECT leaves as total_leaves FROM tbl_employee_total_leaves WHERE employee_id = "'.$employee_id.'" AND year = "'.date('Y').'" ';
         $total_leave_counter = getRaw($total_leave_counter);

         $total_leaves = 0;
         if(count($total_leave_counter) > 0){
            foreach($total_leave_counter as $rs){
               $total_leaves = $rs['total_leaves']; 
            }
         }

			$status = 1;
			$message = 'data found';
         $data = array('total_grant_leaves'=>$total_grant_leaves,'current_year_total_leaves_'=>$total_leaves);

   }else{

		$status = 0;
		$message = 'Invalid request !';

   }

   $json = array('status' => $status, 'message' => $message,'data'=>$data);
   echo json_encode($json);
