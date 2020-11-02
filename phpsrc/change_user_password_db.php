<?php
    if(isset($_POST['btnchange'])){
        session_start();
        include('../include/define.php');
        include('../include/db.php');

        $user_id=$_POST['user_id'];
        $password=$_POST['password'];
        $repassword=$_POST['repassword'];
        
        if($password<>$repassword || $password==""){
            echo "<script>alert('Password is not match');</script>";
        }
        elseif($password==$repassword){            
                $sql="UPDATE ".TBL_USER." SET password='".md5($password)."' WHERE user_id=".$user_id."";
                if($result=$conn->query($sql)){
                  header("location:../user_manage.php");      
                }
                else{
                  echo '<script>alert("Error. password not change.");</script>';
                  header("location:../user_manage.php");      
                }    
        }
    }
