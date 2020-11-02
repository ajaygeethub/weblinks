<?php
    session_start();
    include('../include/define.php');
    include('../include/db.php');
        
    $user_id=$_GET['user_id'];
                
    if(isset($_SESSION['id'])){
        $sql="UPDATE user_master SET is_deleted=1 WHERE user_id=$user_id";
        if($result=$conn->query($sql)){
            header("location:../user_manage.php");      
        }
        else{
            echo '<script>alert("Error. User is not deleted");</script>';
        }    
    }
