<?php
    if(isset($_POST['btnchange'])){
        session_start();
        include('../include/define.php');
        include('../include/db.php');

        $userid=$_SESSION['id'];
        $oldpassword=$_POST['oldpassword'];
        $newpassword=$_POST['newpassword'];
        $repassword=$_POST['repassword'];

        $sql="SELECT password FROM ".TBL_USER." WHERE user_id='".$userid."'";     //get old password
        $result=$conn->query($sql);
        $data=mysqli_fetch_array($result);
    
        if($newpassword<>$repassword || $newpassword==""){  //check from input
            echo "<script>alert('Password is not match');</script>";
        }
        elseif($data['password']<>md5($oldpassword)){       //check from database
            echo "<script>alert('not match from database');</script>";
        }
        elseif($newpassword==$repassword){            
                $sql="UPDATE ".TBL_USER." SET password='".md5($newpassword)."' WHERE user_id=".$userid."";
                if($result=$conn->query($sql)){
                  header("location:../user_profile.php");      
                }
                else{
                  echo '<script>alert("Error. password not change.");</script>';
                  header("location:../user_profile.php");      
                }    
        }
    }
