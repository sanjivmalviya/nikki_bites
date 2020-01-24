<?php 
	
	 require_once('../../../functions.php');

	 $claim_group_id = $_POST['claim_group_id'];

	 $update = "UPDATE tbl_employee_travel_claims SET claim_status = '2',claim_open_date = '".date('d-m-Y')."' WHERE claim_group_id = '".$claim_group_id."' AND claim_status = '1' ";
	 
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