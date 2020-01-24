<?php 
    
   require_once('../../functions.php'); 

   $admin_id = $_SESSION['nb_credentials']['user_id'];

   $total_orders = count(getAll("SELECT * FROM tbl_orders ord INNER JOIN tbl_customer cust ON ord.user_id = cust.customer_id WHERE cust.added_by = ".$admin_id." "));
    
   // $total_distributers = count(getWhere('tbl_customer','status','1'));
   $total_distributers = 'SELECT * FROM tbl_customer WHERE status = "1" AND added_by = '.$admin_id.' ';
   $total_distributers = count(getRaw($total_distributers)); 
    
   $total_invoices = getRaw("SELECT IFNULL(COUNT(*),0) as total_invoices FROM tbl_orders ord INNER JOIN tbl_customer cust ON ord.user_id = cust.customer_id INNER JOIN tbl_invoices inv ON inv.order_id = ord.order_id WHERE cust.added_by = ".$admin_id." AND ord.order_dispatch_status = '0' ");
   $total_invoices = $total_invoices[0]['total_invoices'];

   $total_employees = count(getRaw('SELECT * FROM tbl_employees WHERE status = "1" AND added_by = "'.$admin_id.'" '));

   $total_pending_orders = count(getRaw("SELECT * FROM tbl_orders ord INNER JOIN tbl_customer cust ON ord.user_id = cust.customer_id WHERE cust.added_by = ".$admin_id." order_dispatch_status = '0' "));
   $total_partial_orders = count(getRaw("SELECT * FROM tbl_orders ord INNER JOIN tbl_customer cust ON ord.user_id = cust.customer_id WHERE cust.added_by = ".$admin_id." order_dispatch_status = '1' "));
   $total_dispatched_orders = count(getRaw("SELECT * FROM tbl_orders ord INNER JOIN tbl_customer cust ON ord.user_id = cust.customer_id WHERE cust.added_by = ".$admin_id." order_dispatch_status = '2' "));
   
   $today_orders = " ";
   $today_orders = count(getRaw($today_orders));

   $today_invoices = "SELECT * FROM tbl_invoices WHERE DATE(created_at) = DATE(NOW())";
   $today_invoices = count(getRaw($today_invoices));


?>

<!DOCTYPE html>
<html>

<?php require_once('../../include/headerscript.php'); ?>

<style>
      /* FontAwesome for working BootSnippet :> */

@import url('https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
#team {
    background: #eee !important;
}

.btn-primary:hover,
.btn-primary:focus {
    background-color: #108d6f;
    border-color: #108d6f;
    box-shadow: none;
    outline: none;
}

.btn-primary {
    color: #fff;
    background-color: #007b5e;
    border-color: #007b5e;
}

section {
    padding: 20px 0;
}

section .section-title {
    text-align: center;
    color: #007b5e;
    margin-bottom: 50px;
    text-transform: uppercase;
}

#team .card {
    border: none;
    background: #ffffff;
}

.image-flip:hover .backside,
.image-flip.hover .backside {
    -webkit-transform: rotateY(0deg);
    -moz-transform: rotateY(0deg);
    -o-transform: rotateY(0deg);
    -ms-transform: rotateY(0deg);
    transform: rotateY(0deg);
    border-radius: .25rem;
    width: 100%;
}

.image-flip:hover .frontside,
.image-flip.hover .frontside {
    -webkit-transform: rotateY(180deg);
    -moz-transform: rotateY(180deg);
    -o-transform: rotateY(180deg);
    transform: rotateY(180deg);
}

.mainflip {
    -webkit-transition: 1s;
    -webkit-transform-style: preserve-3d;
    -ms-transition: 1s;
    -moz-transition: 1s;
    -moz-transform: perspective(1000px);
    -moz-transform-style: preserve-3d;
    -ms-transform-style: preserve-3d;
    transition: 1s;
    transform-style: preserve-3d;
    position: relative;
}

.frontside {
    position: relative;
    -webkit-transform: rotateY(0deg);
    -ms-transform: rotateY(0deg);
    z-index: 2;
    margin-bottom: 30px;
}

.backside {
    position: absolute;
    top: 0;
    left: 0;
    background: white;
    -webkit-transform: rotateY(-180deg);
    -moz-transform: rotateY(-180deg);
    -o-transform: rotateY(-180deg);
    -ms-transform: rotateY(-180deg);
    transform: rotateY(-180deg);
    -webkit-box-shadow: 5px 7px 9px -4px rgb(158, 158, 158);
    -moz-box-shadow: 5px 7px 9px -4px rgb(158, 158, 158);
    box-shadow: 5px 7px 9px -4px rgb(158, 158, 158);
    width: 100%;
}

.frontside,
.backside {
    -webkit-backface-visibility: hidden;
    -moz-backface-visibility: hidden;
    -ms-backface-visibility: hidden;
    backface-visibility: hidden;
    -webkit-transition: 1s;
    -webkit-transform-style: preserve-3d;
    -moz-transition: 1s;
    -moz-transform-style: preserve-3d;
    -o-transition: 1s;
    -o-transform-style: preserve-3d;
    -ms-transition: 1s;
    -ms-transform-style: preserve-3d;
    transition: 1s;
    transform-style: preserve-3d;
}

.frontside .card,
.backside .card {
    min-height: 312px;
    padding: 10px;
    height: 360px;   
    border: 1px solid rgba(0,0,0,0.1) !important;
    box-shadow: 2px 4px #888888;
    border-radius: 5px;
}

.backside .card a {
    font-size: 18px;
    color: #007b5e !important;
}

.frontside .card .card-title,
.backside .card .card-title {
    /*color: #007b5e !important;*/
}

.frontside .card .card-body img {
    width: 120px;
    height: 120px;
    border-radius: 50%;
}
.card-counter{
    box-shadow: 2px 2px 10px #DADADA;
    margin: 5px;
    padding: 20px 10px;
    background-color: #fff;
    height: 100px;
    border-radius: 5px;
    transition: .3s linear all;
  }

  .card-counter:hover{
    box-shadow: 4px 4px 20px #DADADA;
    transition: .3s linear all;
  }

  .card-counter.primary{
    background-color: #007bff;
    color: #FFF;
  }

  .card-counter.danger{
    background-color: #ef5350;
    color: #FFF;
  }  

  .card-counter.success{
    background-color: #66bb6a;
    color: #FFF;
  }  

  .card-counter.info{
    background-color: #26c6da;
    color: #FFF;
  }  

  .card-counter i{
    font-size: 5em;
    opacity: 0.2;
  }

  .card-counter .count-numbers{
    position: absolute;
    right: 35px;
    top: 20px;
    font-size: 32px;
    display: block;
  }

  .card-counter .count-name{
    position: absolute;
    right: 35px;
    top: 65px;
    font-style: italic;
    text-transform: capitalize;
    opacity: 0.5;
    display: block;
    font-size: 18px;
  }
   </style>
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
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="content-page">
                <!-- Start content -->
                <div class="content">
                    <div class="container">
                        <div class="row">
              <div class="col-xs-12">
                <div class="page-title-box">
                                    <h4 class="page-title">Dashboard</h4>
                                    
                                    <div class="clearfix"></div>
                                </div>
              </div>
            </div>
                        <!-- end row -->

                     <div class="row">

                      <div class="container">
                         <div class="row">

                        <div class="col-md-3">
                          <div class="card-counter primary">
                            <i class="fa fa-circle-o-notch"></i>
                            <span class="count-numbers"><?php echo $total_distributers; ?></span>
                            <span class="count-name"><b>Total Distributers</b></span>
                          </div>
                        </div>

                        <div class="col-md-3">
                          <div class="card-counter primary">
                            <i class="fa fa-circle-o-notch"></i>
                            <span class="count-numbers"><?php echo $today_orders; ?></span>
                            <span class="count-name"><b>Today's Orders</b></span>
                          </div>
                        </div>

                        <div class="col-md-3">
                          <div class="card-counter primary">
                            <i class="fa fa-circle-o-notch"></i>
                            <span class="count-numbers"><?php echo $today_invoices; ?></span>
                            <span class="count-name"><b>Today's Invoices</b></spanx>
                          </div>
                        </div>

                        <div class="col-md-3">
                          <div class="card-counter primary">
                            <i class="fa fa-circle-o-notch"></i>
                            <span class="count-numbers"><?php echo $total_orders; ?></span>
                            <span class="count-name"><b>Total Orders</b></span>
                          </div>
                        </div>


                         <div class="col-md-3">
                          <div class="card-counter primary">
                            <i class="fa fa-circle-o-notch"></i>
                            <span class="count-numbers"><?php echo $total_pending_orders; ?></span>
                            <span class="count-name"><b>Total Pending Orders</b></span>
                          </div>
                        </div>

                        <div class="col-md-3">
                          <div class="card-counter primary">
                            <i class="fa fa-circle-o-notch"></i>
                            <span class="count-numbers"><?php echo $total_partial_orders; ?></span>
                            <span class="count-name"><b>Total Partial Order</b></span>
                          </div>
                        </div>

                        <div class="col-md-3">
                          <div class="card-counter primary">
                            <i class="fa fa-circle-o-notch"></i>
                            <span class="count-numbers"><?php echo $total_dispatched_orders; ?></span>
                            <span class="count-name"><b>Total Dispatched Orders</b></span>
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="card-counter primary">
                            <i class="fa fa-circle-o-notch"></i>
                            <span class="count-numbers"><?php echo $total_invoices; ?></span>
                            <span class="count-name"><b>Total Invoices</b></spanx>
                          </div>
                        </div>

                        <div class="col-md-3">
                          <div class="card-counter primary">
                            <i class="fa fa-circle-o-notch"></i>
                            <span class="count-numbers"><?php echo $total_employees; ?></span>
                            <span class="count-name"><b>Total Employees</b></span>
                          </div>
                        </div>

                      </div>
                    </div>

                     

                       


                    </div> <!-- container -->
                </div> <!-- content -->
            </div>


            <!-- ============================================================== -->
            <!-- End Right content here -->
            <!-- ============================================================== -->


           

        </div>
        <!-- END wrapper -->
        <!-- START Footerscript -->
        <?php require_once('../../include/footerscript.php'); ?>

    </body>
</html>