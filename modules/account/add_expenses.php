

<?php



   require_once('../../functions.php');



   $login_id = $_SESSION['nb_credentials']['user_id'];



   $expense_master = getAll('tbl_expense_master');
   $expenses = getRaw('SELECT * FROM tbl_expenses WHERE added_by = "'.$login_id.'" ');


   $customers = getWhere('tbl_customer','added_by',$login_id);



   if(isset($_POST['submit'])){

          $upload_dir = '../../uploads/expenses/';
          $extensions = array('jpg','jpeg','png','pdf','doc');   
          
          $attachment = array();
          foreach ($_FILES['attachment']["error"] as $key => $error) {

              if ($error == UPLOAD_ERR_OK) {  

                  $tmp_name = $_FILES['attachment']["tmp_name"][$key];
                  $file_name = $_FILES['attachment']["name"][$key];
                  $extension = explode('.',$file_name);
                  $file_extension = end($extension);

                  if(in_array($file_extension, $extension)){
                      
                      $new_file_name = md5(uniqid()).".".$file_extension;             
                      $destination = $upload_dir.$new_file_name;
                      if(move_uploaded_file($tmp_name, $destination)){
                         $attachment[] = $new_file_name;
                      }
                  }   

              }
          }

          if(count($attachment) > 0){
              $attachment = $attachment[0];
          }else{
              $attachment = "";
          }

         if(!isset($_POST['transaction_id'])){
            $_POST['transaction_id'] = "";
         }
         if(!isset($_POST['cheque_number'])){
            $_POST['cheque_number'] = "";
         }
         if(!isset($_POST['bank_name'])){
            $_POST['bank_name'] = "";
         }


	   	$form_data = array(	

      		'added_by' => $login_id,

   			'expense_id' => $_POST['expense_id'],
            
            'date' => $_POST['date'],

            'amount' => $_POST['amount'],
   			
            'payment_mode' => $_POST['payment_mode'],

            'attachment' => $attachment,

            'transaction_id' => $_POST['transaction_id'],
            
            'cheque_number' => $_POST['cheque_number'],
            
            'bank_name' => $_POST['bank_name'],
   			
            'remark' => $_POST['remark']
	   	
         );

	    if(insert('tbl_expenses',$form_data)){              

			$success = "Expense Addded Successfully";

	     }else{

	        $error = "Something went wrong, please try again later ";

	 	}		   		


   }


 if(isset($_GET['delete_id'])){
         
   if(delete('tbl_expenses','id',$_GET['delete_id'])){
      $success = "Record Deleted Successfully";
      header('location:add_expenses.php');

   }else{
      $error = "Failed to Delete Record";
   }

 }

?>



<!DOCTYPE html>

<html>

   <?php require_once('../../include/headerscript.php'); ?>

   <body class="fixed-left">

      <!-- Begin page -->

      <div id="wrapper">

         <!-- Top Bar Start -->

         <?php require_once('../../include/topbar.php'); ?>

         <!-- Top Bar End -->

         <!-- ========== Left Sidebar Start ========== -->

         <?php require_once('../../include/sidebar.php'); ?>

         <!-- Left Sidebar End -->

         <!-- ============================================================== -->

         <!-- Start Page Content here -->

         <!-- ============================================================== -->

         <div class="content-page">

            <!-- Start content -->

            <div class="content">

               <div class="container">

                   <div class="row">

                     <div class="col-md-6">

                        <div class="page-title-box">

                           <h4 class="page-title">Add Accounting</h4>

                           <div class="clearfix"></div>

                        </div>

                     </div>                   

                  </div>

                  <div class="row">   

                     

                     <div class="col-sm-12">

                        <div class="card-box">

                           <div class="row">



                               <form method="post" class="form-horizontal" enctype="multipart/form-data">

                                 <div class="col-md-12">



                                    <div class="row">



                                    	<div class="col-md-4">

                                          <div class="form-group">

                                             <label for="date">Date<span class="text-danger">*</span></label>

                                             <input type="date" name="date" parsley-trigger="change" required="" placeholder="" class="form-control" id="date" value="<?php echo date('Y-m-d'); ?>">

                                          </div>

                                       </div>



                                       <div class="col-md-4">

                                          <div class="form-group">

                                             <label for="expense_id">Expense Type<span class="text-danger">*</span></label>

                                             <select name="expense_id" parsley-trigger="change" required="" class="form-control select2" id="expense_id">

                                             	<?php if(isset($expense_master)){ ?>

                                                   <?php foreach($expense_master as $rs){ ?>

                                                      <option value="<?php echo $rs['expense_id']; ?>"><?php echo $rs['expense_name']; ?></option>

                                                   <?php } ?>

                                                <?php } ?>

                                             </select>

                                          </div>

                                       </div>




                                       <div class="col-md-4">

                                          <div class="form-group">

                                             <label for="amount">Amount<span class="text-danger">*</span></label>

                                             <input type="text" name="amount" parsley-trigger="change" required="" class="form-control select2" id="amount">

                                          </div>

                                       </div>


                                       <div class="col-md-4">

                                          <div class="form-group">

                                             <label for="payment_mode">Payment Mode<span class="text-danger">*</span></label>

                                             <select name="payment_mode" parsley-trigger="change" required="" class="form-control select2" id="payment_mode">
                                                <option value="1">Cash</option>
                                                <option value="2">Online</option>
                                                <option value="3">Cheque</option>
                                             </select>

                                          </div>

                                       </div>

                                       <div class="col-md-4" id="transaction_id_block" style="display: none;">

                                          <div class="form-group">

                                             <label for="transaction_id">Transaction Id</label>

                                             <input type="text" name="transaction_id" parsley-trigger="change" class="form-control select2" id="transaction_id">

                                          </div>

                                       </div>

                                       <div class="col-md-4" id="cheque_number_block" style="display: none;">

                                          <div class="form-group">

                                             <label for="cheque_number">Cheque Number</label>

                                             <input type="text" name="cheque_number" parsley-trigger="change" class="form-control select2" id="cheque_number">

                                          </div>

                                       </div>

                                       <div class="col-md-4" id="bank_name_block" style="display: none;">

                                          <div class="form-group">

                                             <label for="bank_name">Bank Name</label>

                                             <input type="text" name="bank_name" parsley-trigger="change" class="form-control select2" id="bank_name">

                                          </div>

                                       </div>


                                       <div class="col-md-4">

                                          <div class="form-group">

                                             <label class="control-label">Upload Attachment</label>

                                             <input type="file" class="filestyle" data-buttonname="btn-default" name="attachment[]" id="attachment" >

                                       </div>

                                       </div>
                                       <div class="col-md-12">

                                          <div class="form-group">

                                             <label for="remark">Remark</label>

                                             <textarea name="remark" parsley-trigger="change" class="form-control select2" id="remark"></textarea>

                                          </div>

                                       </div>





                                    </div>





                                    <div class="row">

                                       <div class="col-md-12 p-t-30">

                                          <?php if(isset($success)){ ?>

                                             <div class="alert alert-success"><?php echo $success; ?></div>

                                          <?php }else if(isset($warning)){ ?>

                                             <div class="alert alert-warning"><?php echo $warning; ?></div>

                                          <?php }else if(isset($error)){ ?>

                                             <div class="alert alert-danger"><?php echo $error; ?></div>

                                          <?php } ?>

                                       </div>      



                                       <div class="col-md-12" align="left">

                                          <button type="submit" name="submit" id="submit" class="btn btn-primary btn-bordered waves-effect w-md waves-light m-b-5">Submit</button>

                                       </div>

                                    </div>

                                 </div>

                              </form>

                           </div>

                        </div>

                     </div>

                

                  </div>

                  <div class="row">
                     <div class="col-sm-12">
                        <div class="card-box">
                           <div class="row">
                              <h4>All Expenses</h4>

                                 <table id="expenses" class="table table-striped table-bordered table-condensed table-hover" style="margin-top: 50px;">
                                    
                                    <thead>
                                       <th>Sr.</th>
                                       <th class="text-center">Date</th>
                                       <th class="text-center">Expense Type</th>
                                       <th class="text-center">Amount</th>
                                       <th class="text-center">Payment Mode</th>
                                       <th class="text-center">Attachment</th>           
                                       <th class="text-center">Transaction Id</th>           
                                       <th class="text-center">Cheque Number</th>           
                                       <th class="text-center">Bank Name</th>           
                                       <th>Remark</th>           
                                       <th class="text-center">Actions</th>
                                    </thead>

                                    <tbody>
                                       
                                       <?php if(isset($expenses) && count($expenses) > 0){ ?>

                                          <?php $i=1; foreach($expenses as $rs){ ?>

                                          <tr>
                                             <td><?php echo $i++; ?></td>
                                             <td class="text-center"><?php echo $rs['date']; ?></td>
                                             <td>
                                                <?php 
                                                   $expense_name = getOne('tbl_expense_master','expense_id',$rs['expense_id']);
                                                   echo $expense_name['expense_name'];
                                                ?> 
                                             </td>
                                             <td class="text-center"><?php echo $rs['amount']; ?></td>
                                             <td class="text-center"><?php if($rs['payment_mode'] == '1'){ echo "Cash"; }else if($rs['payment_mode'] == '2'){ echo "Online"; }else { echo "Cheque"; }  ?></td>
                                             <?php if($rs['attachment'] != ""){ ?>
                                                <td class="text-center"><a href="<?php echo "../../uploads/expenses/".$rs['attachment']; ?>">View</a></td>
                                             <?php }else{ ?>
                                                <td class="text-center">-</td>
                                             <?php } ?>
                                             <td class="text-center"><?php echo $rs['transaction_id']; ?></td>
                                             <td class="text-center"><?php echo $rs['cheque_number']; ?></td>
                                             <td class="text-center"><?php echo $rs['bank_name']; ?></td>
                                             <td><?php echo $rs['remark']; ?></td>
                                             <td class="text-center">
                                                <a href="add_expenses.php?delete_id=<?php echo $rs['id']; ?>" onclick=" return confirm('Are you sure ?'); "><i class="fa fa-trash"></i></a>
                                             </td>
                                          </tr>
                                          <?php } ?>

                                       <?php } ?>

                                    </tbody>

                                 </table>

                                 <div class="row">
                                    <div class="col-md-12 p-t-30">
                                          <?php if(isset($success)){ ?>
                                             <div class="alert alert-success"><?php echo $success; ?></div>
                                          <?php }else if(isset($warning)){ ?>
                                             <div class="alert alert-warning"><?php echo $warning; ?></div>
                                          <?php }else if(isset($error)){ ?>
                                             <div class="alert alert-danger"><?php echo $error; ?></div>
                                          <?php } ?>
                                       </div>  
                                 </div>
                      
                           </div>
                        </div>
                     </div>
                  </div>

 

               </div>

               <!-- container -->

            </div>

            <!-- content -->

         </div>

         <!-- ============================================================== -->

         <!-- End of the page -->

         <!-- ============================================================== -->

      </div>

      <!-- END wrapper -->

      <!-- START Footerscript -->

      <?php require_once('../../include/footerscript.php'); ?>

      <script>
         $('#expense_id').select2();
         $('#payment_mode').select2();

         $('#expenses').DataTable();
         
         $('#payment_mode').on('change', function(){
            
            var payment_mode = $(this).val();
            
            if(payment_mode == '2'){
               $('#transaction_id_block').show();
            }else{
               $('#transaction_id_block').hide();
            }

            if(payment_mode == '3'){
               $('#cheque_number_block').show();
               $('#bank_name_block').show();
            }else{
               $('#cheque_number_block').hide();
               $('#bank_name_block').hide();
            }

         });


      </script>



   </body>

</html>
