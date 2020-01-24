<?php
    
    require_once('../../functions.php');
    
    unset($_SESSION['nb_credentials']);
    header('location:../../modules/login/index.php');

?>