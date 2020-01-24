<?php
require_once('../../functions.php');
 
$target_months = getAll('tbl_target_months'); 
$request = json_decode(file_get_contents('php://input'));

if(isset($request->sales_person_id) && isset($request->year) && isset($request->month)){

   $sales_person_id = $request->sales_person_id; 
   $target_year = $request->year; 
   $target_month = $request->month; 
      
   $scroreboard = "SELECT SUM(target_category_amount) as target_amount,sales_person_id,target_year FROM tbl_target WHERE sales_person_id = '$sales_person_id' AND YEAR(created_at) = '$target_year' AND  MONTH(created_at) = '$target_month' GROUP BY target_year,target_month DESC";
   $scroreboard = getRaw($scroreboard);
   
   if(isset($scroreboard)){

      foreach($scroreboard as $rs){

         $year = $rs['target_year'];

         $sales_person_id = $rs['sales_person_id'];
         $total_orders = "SELECT COALESCE(COUNT(*),0) as total_order FROM tbl_orders WHERE sales_person_id = '$sales_person_id' AND YEAR(updated_at) = $target_year AND MONTH(updated_at) = $target_month";
         $total_orders = getRaw($total_orders);
         $total_orders = $total_orders[0]['total_order'];

         $total_order_amount = "SELECT COALESCE(SUM(sales_person_order_amount),0) as total_order_amount FROM tbl_sales_person_target_detail WHERE sales_person_id = '$sales_person_id' AND YEAR(created_at) = $target_year AND MONTH(created_at) = $target_month ";
         $total_order_amount = getRaw($total_order_amount);
         $total_order_amount = $total_order_amount[0]['total_order_amount'];

         $sales_person_name = getOne('tbl_sales_person','sales_person_id',$sales_person_id);
         $rs['sales_person_name'] = $sales_person_name['sales_person_name'];
         $rs['total_orders'] = $total_orders ;
         $rs['total_order_amount'] = number_format($total_order_amount,2);
         $rs['total_outstanding'] = $rs['target_amount'] - $total_order_amount;
         $rs['total_outstanding'] = number_format($rs['total_outstanding'],2);
         if($total_order_amount >= $rs['target_amount']){
            $rs['target_status'] = "Achieved";
            $rs['total_outstanding'] = substr($rs['total_outstanding'],1);
         }else{
            $rs['target_status'] = "Not Achieved";
         }

         if($total_order_amount == 0){
            $rs['percentage'] = 0;
         }else{
            // $percentage = number_format((1 - $total_order_amount / $rs['target_amount'] ) * 100,0);
            // $rs['percentage'] = substr($percentage,1);
            $percentage = ($total_order_amount / $rs['target_amount']) * 100;
            $rs['percentage'] = number_format($percentage,2);                    
         }
         $data[] = $rs;

      }
   }     
   
   if(isset($data)){
      
      function compare($a, $b)
      {
         return ($data['percentage']< $data['percentage']);
      }
      usort($data, "compare");
         
      $json = array('status'=>1,'message'=>"data found",'data'=>$data);


   }else{

      $json = array('status'=>0,'message'=>"no data found");
   }
   
 }else{
   
   $json = array('status'=>0,'message'=>"Invalid Request");
   
 }

 echo json_encode($json);