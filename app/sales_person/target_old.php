
<?php

   require_once('../../functions.php');
   
   $request = json_decode(file_get_contents('php://input'));

   if(isset($request->sales_person_id)){

         $sales_person_id = $request->sales_person_id;

         $targets = "SELECT sales_person_id,sales_person_target_start_date,sales_person_target_end_date,sales_person_target_amount,status FROM tbl_sales_person_target WHERE sales_person_id = '$sales_person_id' ";
         $targets = getRaw($targets);

         if(isset($targets) && count($targets) > 0){ 
         
            $i=1; 

            foreach($targets as $rs){ 

                 $sales_person_name = getOne('tbl_sales_person','sales_person_id',$rs['sales_person_id']);
                 $data['sales_person_name'] =  $sales_person_name['sales_person_name'];
                 $data['sales_person_target_amount'] =  $rs['sales_person_target_amount'];
                
                   $start_date = date('Y-m-d', strtotime($rs['sales_person_target_start_date']));
                   $end_date = date('Y-m-d', strtotime($rs['sales_person_target_end_date']));

                   $created_at = date('d-m-Y', strtotime($rs[0]['created_at']));

                   $target_achieved = "SELECT sum(sales_person_order_amount) as target_achieved FROM tbl_sales_person_target_detail WHERE DATE(created_at) BETWEEN '$start_date' AND '$end_date' AND sales_person_id = '".$rs['sales_person_id']."'  ";
                   $target_achieved = getRaw($target_achieved);

                   if(isset($target_achieved[0]['target_achieved'])){
                      $target_achieved_amount = $target_achieved[0]['target_achieved'];  
                   }else{
                      $target_achieved_amount = 0;
                   }

                   $data['target_achieved_amount'] = $target_achieved_amount;
                   $data['start_date'] =  $start_date;
                   $data['end_date'] =  $end_date;

                   if($target_achieved_amount >= $rs['sales_person_target_amount']){  
                        $data['achieve_status'] = "Achieved";
                   }else{
                        $data['achieve_status'] = "Not Achieved";
                   }
                   
                   $today = date('Y-m-d', strtotime($timestamp));

                   if($today >= $start_date && $today <= $end_date){
                        $data['running_status'] = "Running";
                   }else if($start_date >= $today) {
                        $data['running_status'] = "Awaiting";
                   }else{
                        $data['running_status'] = "Closed";
                   }

                   $data2[] = $data;
            }

            $json = array('status'=>1,'message'=>'Data Found','data'=>$data2);

        }else{

         $json = array('status'=>0,'message'=>'No Data Found');
          
        }

   
   }else{
   
         $json = array('status'=>0,'message'=>'Invalid Request');

   }

   echo json_encode($json);
   