<?php

   require_once('../../functions.php');
   
   $request = json_decode(file_get_contents('php://input'));

   if(isset($request->username) && isset($request->password)){

   		$username = $request->username;
   		$password = $request->password;

   		$where = array('sales_person_email' => $username, 'sales_person_password' => $password);
   		$get = selectWhereMultiple('tbl_sales_person',$where);
         
   		$data = array();	

   		if(isset($get) && count($get) > 0 ){
   			
   		$data['sales_person_id'] = $get[0]['sales_person_id'];
			$data['added_by'] = $get[0]['added_by'];
			$data['sales_person_name'] = $get[0]['sales_person_name'];
			$data['sales_person_designation'] = $get[0]['sales_person_designation'];
			$data['sales_person_hq'] = $get[0]['sales_person_hq'];
			$data['sales_person_mobile'] = $get[0]['sales_person_mobile'];
			$data['sales_person_doj'] = $get[0]['sales_person_doj'];
			$data['sales_person_dob'] = $get[0]['sales_person_dob'];
			$data['sales_person_pan'] = $get[0]['sales_person_pan'];
			$data['sales_person_email'] = $get[0]['sales_person_email'];
			$data['sales_person_aadhaar'] = $get[0]['sales_person_aadhaar'];
			$data['sales_person_aadhaar_number'] = $get[0]['sales_person_aadhaar_number'];
			$data['sales_person_spouse_name'] = $get[0]['sales_person_spouse_name'];
			$data['sales_person_spouse_mobile'] = $get[0]['sales_person_spouse_mobile'];
			$data['created_at'] = $get[0]['created_at'];

   			$json = array('status' => 1 , 'message' => 'data found' , 'data' => $data);
          
   		}else{
   			
   			$json = array('status' => 0 , 'message' => 'No data found');

   		}

   
   }else{

		$json = array('status' => 0 , 'message' => 'invalid request');
   	
   }

   echo json_encode($json);

?>