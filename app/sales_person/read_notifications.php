
<?php

  require_once('../../functions.php');
  $request = json_decode(file_get_contents('php://input'));
  
  if(isset($request->sales_person_id)){

    $sales_person_id = $request->sales_person_id;

    $update = "UPDATE tbl_notifications SET notification_status = '1' WHERE notification_receiver_user_type = '4' AND notification_receiver_user_id = '$sales_person_id'  ";
    if(query($update)){

    	$json = array('status'=>1,'message'=>'Marked all as read');

    }else{

    	$json = array('status'=>0,'message'=>'Failed to mark Read');

    }
  
  }else{

    $json = array('status'=>0,'message'=>'Invalid Request');

  }

 echo json_encode($json);
   