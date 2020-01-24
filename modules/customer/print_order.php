<?php 
   require_once('../../functions.php');
   $order_id = $_GET['order_id'];

   $order = getOne('tbl_orders','order_id',$order_id);
   $order_details = getOne('tbl_order_detail','order_id',$order_id);

   $customer = getOne('tbl_customer','customer_id',$order['user_id']);

?>
<html>
 <head>
    
  <title>Order Print</title>

  <link rel="stylesheet" href="bootstrap.min.css">
  
  <!--  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script> -->

 <style type="text/css" media="screen">

  .address-details h3 {
       font-size: 20px;
    color: #0d8800;
    font-weight: 700;
  }

  .address-details h5 {
    font-size: 16px;
  }

  .address-details p {
    font-size: 14px;
    margin-bottom: 5px;
    } 

    .bg-pd {
      background: #f2f2f2;
    
    padding: 5px 13px !important;
    }

    .pd-com {
          padding: 5px 13px;
    }

   
 </style>

  </head>

  <body>

  	<section>

  		<div class="container">

  			<div class="row" style="align-items: center;">

  				<div class="col-sm-3">

  					<img src="logo.png" style="max-width: 100%; height: 150px;">

  			    </div>

  			    <div class="col-sm-9">

  			    	<div class="float-right text-right address-details">

  			    		<h3>Nikki Bites Food And Beverages Private Limited </h3>

  			    	    <h5>All kind of Namkeens & Snack Pellets </h5>

  			    	    <p> <strong> Office Address : </strong> 49 - first floor, Shital shopping center, 
                    <br>Dhanera, Banaskantha, Gujarat - 385310 </p>

                    <p> <strong> Email ID : </strong> info@nikkibites.com </p>

                    <p> <strong> Contact No : </strong> +91 98242 00203  </p>
  			    		
  			    	</div>

  			    </div>

  			</div>

  			<div class="row">

  				<div class="col-sm-12">

  					<div>

  						<table class="table table-bordered"> 

  							<tbody>

                  <tr> 

                    <td colspan="2">

                      <table style="width: 100%"> 

                        <tr>

                    <td style="width: 60%">

                      <h4> <strong> M/S : </strong> <?php echo $customer['customer_name']; ?> </h4>

                      <p> <strong> Address : </strong> Alkapuri , Vadodara 391001 </p>

                      <p> 
                             <strong> GSTN No : </strong> <?php echo $customer['customer_gst']; ?> 
                       </p> 

                       <p> <strong> Pan No : </strong> <?php echo $customer['customer_pan']; ?> </p>
                    </td>

                     <td style="">

                      <table class="address-details" style="width: 100%; " >
                        <tbody>
                          <tr>
                            <td class="bg-pd" style="border-bottom: transparent;">
                              <p> <strong> Order No : </strong>  <?php echo $order['order_number']; ?></p>

                                 <p> 
                                <span class="float-left">  <strong> Date : </strong> <?php echo date('d-m-Y', strtotime($order['created_at'])); ?> </span>
                                <span class="float-right">  <strong> <?php echo date('h:i', strtotime($order['created_at'])); ?> </strong> </span>
                              </p> 
                            </td>

                          </tr>

                          <tr> 


                          </tr>

                          <tr>
                            <td>
                              <p> <strong> Driver Name : </strong>  XYZ Name Here</p>
                              <p> <strong> Gate Pass : </strong>  8412 </p>

                               <p> <strong> Vehicle Number : </strong>  GJ06-xx-0000</p>
                            </td>

                          </tr>

                        

                        </tbody>
                      </table>

                     </td>

                  </tr>

                      </table>

                     </td>

                  </tr>

  								

  								<tr> 
  									<td colspan="2">

  										<table class="table" style="width: 100%">
  											<thead>
  												<tr>
  													<th rowspan="">Sr.No</th>
  													<th rowspan="">Product Name</th>
  													<th rowspan="">HSN/SAC <br> Code</th>
  													<th rowspan="">Qty</th>
  													<th rowspan="">Rate</th>
  													<th rowspan="">Taxble <br> Amount</th>
  													<th rowspan="">CGST (6%)</th>
  													<th rowspan="">SGST (6%)</th>
  													<th rowspan="">Net Amount</th>
  												</tr>
  											</thead>
  											<tbody>
  												<tr>
  													<td>1</td>
  													<td>Farali Chevado</td>
  													<td>2106</td>
  													<td>6</td>
  													<td>847</td>
  													<td>3388</td>
  													<td>203</td>
  													<td>203</td>
  													<td>3795</td>
  												</tr>
  												<tr>
  													<td>1</td>
  													<td>Farali Chevado</td>
  													<td>2106</td>
  													<td>6</td>
  													<td>847</td>
  													<td>3388</td>
  													<td>203</td>
  													<td>203</td>
  													<td>3795</td>
  												</tr>
  												
  											</tbody>

  											<tfooter>
  												<tr>
  													<th></th>
  													<th>Sub Total</th>
  													<th></th>
  													<th>12 </th>
  													<th></th>
  													<th>6776</th>
  													<th>406</th>
  													<th>406</th>
  													<th>7590</th>
  												</tr>
  											</tfooter>
  										</table>
  										
  									</td>
  								</tr>

                  <tr> 
                    <td colspan="2"> 

                      <table style="width: 100%"> 

                          <tr>
                    <td colspan="" style="    width: 60%;">

                      <p> <strong> Closing Balance : 7,590 </strong> </p>

                      <p> <strong> Total CGST : </strong> Four Hundred Six Rupees Only </p>

                      <p> <strong> Total SGST : </strong> Four Hundred Six Rupees Only </p>

                      <p> <strong> Bill Amount : </strong> Nine Thousand Five Hundred Ninety Rupees Only </p>

                     </td>

                     <td colspan="">

                      <table class="" style="width:100%">

                      <tr>
                        <td> 
                          <p style="margin-bottom: 10px;">
                            <span class="float-left"> Freight </span>
                            <span class="float-right"> 0.00 </span>
                           </p>

                           <p style="clear: both; margin-bottom: 20px">
                            <span class="float-left"> Discount </span>
                            <span class="float-right"> 0.00 </span>

                           </p>

                           <p style="clear: both; ">
                            <span class="float-left"> Round Off </span>
                            <span class="float-right"> 0.2300 </span>

                           </p>


                         </td>

                      </tr>

                    

                      <tr>
                        <td> 
                          <p style="font-weight: 600">
                            <span class="float-left"> Grand Total </span>
                            <span class="float-right"> 7590.23 </span>

                           </p>

                         </td>

                      </tr>

                      <tr>
                        <td> 
                          <p style="font-weight: 600;    margin-bottom: 5px;">
                            Total Payable on RCM Basis : No
                           </p>

                           <p style="font-weight: 600;    margin-bottom: 5px;">
                            E- WayNo : No
                           </p>

                         </td>

                      </tr>



                       </table>

                     </td>

                  </tr>

                  <tr> 

                    <td style="width: 60%"> 

                      <h4  style="font-size: 20px;font-weight: 700;">Our Bank Deatils </h4>

                      <p style="margin-bottom: 5px;">Hdfc Bank, Alkapuri Vadodara. | A/c No. : 120356422564 IFSC Code : HDFC0111 </p>
                      <p> SBI Bank, Alkapuri Vadodara. | A/c No. : 120356422564 IFSC Code : SBI0111</p>

                    </td>

                    <td> 
 
                      <p>Company GSTIN : 24AAAAAAA175 </p>
                      <p>Company PAN NO. : AAAAAAAA </p>

                    </td>

                  </tr>


                  <tr> 

                    <td> 

                      <h4 style="font-size: 20px;font-weight: 700;">Terms & Conditions</h4>

                      <p style="margin-bottom: 5px;">Our Responsibillity cease as goods leave our premise. </p>
                      <p style="margin-bottom: 5px;"> Subject to Vadodara Jurisdiction</p>
                      <p> E.&.O.E.</p>

                    </td>

                    <td class="text-center"> 
 
                      <p><strong>For, Nikki Bites Food And Beverages <br> Private Limiteds </strong> </p>
                      <p> <br><br> </p>

                      <p>(Authorised Signatory) </p>

                    </td>

                  </tr>


                      </table>

                    </td>


                  </tr>


  							

  								



  							</tbody>


  						</table>

  					</div>

  			    </div>

  			    

  			</div>

  		</div>

  	</section>
    
  </body>

</html>