<?php
    session_start();
    include('../include/define.php');
    include('../include/db.php');
        
    $link_id=$_GET['link_id'];
                
    if(isset($_SESSION['id'])){
        $sql="UPDATE ".TBL_LINK." SET is_deleted=1 WHERE link_id=$link_id";
        if($result=$conn->query($sql)){
            header("location:../link_manage.php");      
        }
        else{
            echo '<script>alert("Error. Data is not deleted");</script>';
            header("location:../link_manage.php");
        }    
    }
