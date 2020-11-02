<?php
if(isset($_POST['btnupdate'])){
    session_start();
    include('../include/define.php');
    include('../include/db.php');

    $user_id=$_SESSION['id'];
    $username=$_POST['uname'];   

    $profileimgnew=$_FILES['profileimgnew'];
    $profileimgold=$_POST['profileimgold'];
    $profile_name=$_POST['profileimgold'];
    
    $profile_location="../files/profile/";
    $profile_temp = $profileimgnew["tmp_name"];


    if(preg_match("/^[a-zA-Z0-9]{1,11}$/",$username)){      //regex and update        
        if(!empty($profileimgnew["name"])){     //for profile upload
            $profile_name=time().basename($profileimgnew["name"]);
            if(move_uploaded_file($profile_temp, $profile_location.$profile_name)){
                if($profileimgold<>"default.png"){
                    unlink("../files/profile/$profileimgold");
                }
            }
            else{
                echo "<script>alert('Error. Profile image not uploded !!');</script>";
            }  
        }

        if(isset($_SESSION['id'])){
            $sql="UPDATE ".TBL_USER." SET username='".$username."',profile_image='".$profile_name."' WHERE user_id=".$user_id."";
            echo $sql;  
            if($result=$conn->query($sql)){
                $_SESSION['username']=$username;
                $_SESSION['profile_location']=$profile_name;
                header("location:../index.php");      
            }
            else{
                echo '<script>alert("Error. Data is not inserted");</script>';
                header("location:../index.php"); 
            }    
        }    
    }
    else{
        echo "<script>alert('invalid data');</script>";
        header("location:../index.php");
    }
}
