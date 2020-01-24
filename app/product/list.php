<?php
 require_once('../../functions.php');
$products = getAll('tbl_product');
$request = json_decode(file_get_contents('php://input'));
$products = "SELECT * FROM tbl_product";

$products = getRaw($products);
if(count($products) > 0){
      
      foreach($products as $rs){
      
      $data[] = $rs;
      }
      $json = array('status' => 1 , 'message' => 'data found' , 'data' => $data);

}else{
   
      $json = array('status' => 0 , 'message' => 'No data found');

}
echo json_encode($json);
?>
