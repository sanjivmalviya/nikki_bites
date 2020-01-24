<?php 

	require('../../../functions.php');
	
	$customer_id = $_POST['customer_id'];

	$customer = getOne('tbl_customer','customer_id',$customer_id);
	
	$json = array(
		'gst_type' => $customer['customer_gst_type']
	);

	echo json_encode($json);

?>
