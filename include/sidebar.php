 <?php 

    require_once('../../functions.php'); 

    if($_SESSION["nb_credentials"]['user_type'] == '1'){

            require_once('sidebar_super_admin.php');

    }else if($_SESSION["nb_credentials"]['user_type'] == '2'){

            require_once('sidebar_admin.php');

    }else if($_SESSION["nb_credentials"]['user_type'] == '3'){

            require_once('sidebar_godown.php');

    }else if($_SESSION["nb_credentials"]['user_type'] == '4'){

            require_once('sidebar_customer.php');

    } 

?>