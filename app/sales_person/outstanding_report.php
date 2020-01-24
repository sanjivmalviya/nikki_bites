<?php

 require_once('../../functions.php');
   
 $request = json_decode(file_get_contents('php://input'));

 if(isset($request->sales_person_id)){

     $sales_person_id = $request->sales_person_id;

     if(isset($request->customer_id) && $request->customer_id != ""){

       $customer_id = $request->customer_id;
        
       $total_sales = "SELECT COALESCE(SUM(det.sales_person_order_amount),0) as total_sales,ord.customer_id FROM tbl_sales_person_target_detail det INNER JOIN tbl_orders ord ON ord.order_id = det.sales_person_order_id AND ord.customer_id = '$customer_id' AND ord.sales_person_id = '$sales_person_id' ";
       
     }else{ 

         $total_sales = "SELECT COALESCE(SUM(det.sales_person_order_amount),0) as total_sales,ord.customer_id FROM tbl_sales_person_target_detail det INNER JOIN tbl_orders ord ON ord.order_id = det.sales_person_order_id WHERE ord.sales_person_id = '$sales_person_id' GROUP BY ord.customer_id ";
         
     }

     $total_sales = getRaw($total_sales);

     if(isset($total_sales)){

        foreach($total_sales as $rs){

          $dataset['customer_id'] = $rs['customer_id'];
          $dataset['total_sales'] = $rs['total_sales'];
          
          $total_received_amount = "SELECT COALESCE(SUM(accounting_amount),0) as total_received_amount FROM tbl_accounting WHERE accounting_party_id = '".$rs['customer_id']."' ";
          $total_received_amount = getRaw($total_received_amount);
          $total_received_amount = $total_received_amount[0]['total_received_amount'];
          $dataset['total_received_amount'] = $total_received_amount;
          $dataset['total_pending_amount'] =$dataset['total_sales'] - $dataset['total_received_amount'];          
          $dataset['total_pending_amount'] = $dataset['total_pending_amount'];          
          $data[] = $dataset;
        }
       
     }

     if(isset($data)){

        $json = array('status'=>1,'message'=>'data found','data'=>$data);

     }else{

        $json = array('status'=>0,'message'=>'no data found');
     
     }

}else{

  $json = array('status'=>0,'message'=>'Invalid Request');  

}  

echo json_encode($json);

?>