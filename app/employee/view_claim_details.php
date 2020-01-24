<?php

   require_once('../../functions.php');

   $request = json_decode(trim(file_get_contents('php://input')));

   if(isset($request->tracking_id)){   

   $date = date('d-m-Y');

   $tracking_detail = getOne('tbl_employee_trip_tracking','tracking_id',$request->tracking_id);
   $tracking_detail = json_decode($tracking_detail['api_response'], true);

   if(isset($tracking_detail) && count($tracking_detail) > 0){ 

      $sr = 1;
      $total_distance = 0;
      $total_duration = 0;
      $total_location_count = count($tracking_detail['destination_addresses']);

      for($i=0;$i<$total_location_count;$i++){ 
         
         $dataset['origin_addresses'] = $tracking_detail['origin_addresses'][$i]; 
         $dataset['destination_addresses'] = $tracking_detail['destination_addresses'][$i];  
         $distance = $tracking_detail['rows'][$i]['elements'][$i]['distance']['value'] / 1000; // to convert meters to km
         $distance = number_format($distance,2);
         $total_distance += $distance;
         $dataset['distance'] = $distance." KM";
    
         $duration = $tracking_detail['rows'][$i]['elements'][$i]['duration']['value'];
         $total_duration += $duration;
         $dataset['total_duration'] = gmdate("H:i:s", $duration);
         $datavals['routes'][] = $dataset;   
      } 

      $datavals['total_duration'] = gmdate('H:i:s',$total_duration);
      $datavals['total_distance'] = $total_distance . "KM";
      $data = $datavals;
      
      $status = 1;
      $msg = "data found";

    }else{ 
       $status = 0;
       $msg = "no data found";

   } 

}else{

   $msg = "Invalid request";
   $status = 0;

} 

$data = array('status'=>$status,'msg'=>$msg,'data'=>$data);
echo json_encode($data);

?>
