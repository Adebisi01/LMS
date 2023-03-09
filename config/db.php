<?php 
error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING ^ E_DEPRECATED);
         $db_name = 'binalgist_LMS';
        $db_host = 'localhost';
        $db_user = 'binalgist';
        $db_pass = 't0Uf;Nm)p@_+';
        
    $conn = mysqli_connect($db_host , $db_user , $db_pass, $db_name );
    
    if($conn){
        session_start();
        $current_date = date('Y-m-d');
        
            $current_date_time = date('Y-m-d h:i:s A');
        $mailhost = 'binalgist.com.ng';
        $mailuser = '_mainaccount@binalgist.com.ng';
        $mailpassword = 't0Uf;Nm)p@_+';
    }