<?php

require_once('../../functions.php');

if(isset($_REQUEST['payment_id']) && $_FILES['payment_document']['error'] == '0'){

	$payment_id = $_REQUEST['payment_id'];

	// FILE DATA 
    $name = $_FILES['payment_document']['name'];
    $allowed_extensions = array('jpg','jpeg','png','gif');
    $target_path = '../../uploads/payment/';
    $file_prefix = "IMG_";
    
    $uniqid = uniqid();
    $ext = explode(".", $name);
    $ext = end($ext);
    $filename = $file_prefix.$uniqid.".".$ext;    
    
    if(move_uploaded_file($_FILES['payment_document']['tmp_name'], $target_path.$filename)){
        $status = 1;
        $msg = "Document uploaded successfully";

        $save_filename = $target_path.$filename;

        $update = "UPDATE tbl_payments SET payment_document = '".$save_filename."' WHERE payment_id = '".$payment_id."' ";
        query($update);

    }else{
        $status = 0;
        $msg = "Failed to upload document, try again later";
    }

	$json = array('status'=>$status,'message'=>$msg);

}else{

	$json = array('status'=>0,'message'=>'invalid request');

}

echo json_encode($json);
