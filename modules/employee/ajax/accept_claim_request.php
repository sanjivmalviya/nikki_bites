<?php 
	
	 require_once('../../../functions.php');

	 $claim_id = $_POST['claim_id'];
	 // print_r($clim)

	 $update = "UPDATE tbl_employee_travel_claims SET claim_status = '2',claim_open_date = '".date('d-m-Y')."' WHERE claim_id = '".$claim_id."' AND claim_status = '1' ";
	 
	 if(query($update)){
	 	$status = 1;
	 	$msg = "Claim accepted successfully";
	 }else{
	 	$status = 0;
	 	$msg = "failed to accept claim";
	 }

	 $data = array('status'=>$status,'msg'=>$msg);
	 echo json_encode($data);

?>