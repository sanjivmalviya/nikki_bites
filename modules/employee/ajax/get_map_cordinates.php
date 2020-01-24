<?php 

  require_once('../../../functions.php');

  if(isset($_POST['trip_id']) && $_POST['trip_id'] != ""){

    $trip = getOne('tbl_employee_trip','trip_id',$_POST['trip_id']);
    $dataset[] = array('lat'=>$trip['start_latitude'],'lng'=>$trip['start_longitude']);

    $trip_details = getWhere('tbl_employee_trip_detail','trip_id',$_POST['trip_id']);
    foreach($trip_details as $rs){
      $dataset[] = array('lat'=>$rs['latitude'],'lng'=>$rs['longitude']);
    }

    // print_r($dataset);
    // exit;

    $cordinates = json_encode($dataset, JSON_NUMERIC_CHECK);

  }else{
    
    $cordinates = "no data found";

  }

  echo $cordinates;
  
?>