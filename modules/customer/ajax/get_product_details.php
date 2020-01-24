<?php 

	require('../../../functions.php');
	
	$product_id = $_POST['product_id'];
	$customer_id = $_POST['customer_id'];

	$customer = getOne('tbl_customer','customer_id',$customer_id);
	$product = getOne('tbl_product','product_id',$product_id);

	$json = array(
		'product_gst' => $product['product_gst'],
		'product_billing_rate' => $product['product_billing_rate'],
		'product_discount' => $product['product_discount'],
		'gst_type' => $customer['customer_gst_type']
	);

	echo json_encode($json);

?>
