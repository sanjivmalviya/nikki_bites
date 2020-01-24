
<?php

   require_once('../functions.php');

   $request = json_decode(trim(file_get_contents('php://input')));

   $data = [];

   if(isset($request->usertype) && isset($request->username) && isset($request->password)){
         
         $usertype = $request->usertype;
         $username = $request->username;
         $password = $request->password;

         // usertype = 1 = employee
         // usertype = 2 = customer

         if($usertype == 1){

            // $get = getOne('tbl_sales_person','sales_person_email',$username);
            // if(isset($get) && count($get) > 0){
            //    $data = $get;
            //    $status = 1;
            //    $message = 'data found';
            // }else{
            //    $status = 0;
            //    $message = 'no data found';
            // }
            
            $get = getRaw('SELECT * FROM tbl_employees WHERE employee_email = "'.$username.'" AND employee_password = "'.$password.'" AND employee_app_access = "1" ');
            if(isset($get) && count($get) > 0){
               $data = $get;
               $status = 1;
               $message = 'data found';
            }else{
               $status = 0;
               $message = 'no data found';
            }

         }else if($usertype == 2){

            $get = getOne('tbl_customer','customer_email',$username);
            $get = getRaw('SELECT * FROM tbl_customer WHERE customer_email = "'.$username.'" AND customer_password = "'.$password.'" ');
            if(isset($get) && count($get) > 0){
               $data = $get;
               $status = 1;
               $message = 'data found';
            }else{
               $status = 0;
               $message = 'no data found';
            }


         }else{
            $status = 0;
            $message = 'invalid usertype';
         }


   }else{


      $status = 0;
      $message = 'Invalid request !';

   }
   
   if($usertype == 1){
        $json = array('status' => $status, 'message' => $message,'employeeData'=>$data);
   echo json_encode($json);
   } else {
        $json = array('status' => $status, 'message' => $message,'customerData'=>$data);
   echo json_encode($json);
   }

  

