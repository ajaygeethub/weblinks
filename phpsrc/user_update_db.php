<?php
if(isset($_POST['btnupdate'])){
    session_start();
    include('../include/define.php');
    include('../include/db.php');

    $user_id=$_POST['user_id'];
    $permission=$_POST['permission'];
    
    $profileimgnew=$_FILES['profileimgnew'];
    $profileimgold=$_POST['profileimgold'];
    $profile_name=$_POST['profileimgold'];
 
    $profile_location="../files/profile/";
    $profile_temp = $profileimgnew["tmp_name"];
        
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
        if($permission=='Admin'){       //for permission
            $permission=1;
        }
        else{
            $permission=0;    
        }


        if(isset($_SESSION['id'])){
            $sql="UPDATE ".TBL_USER." SET profile_image='".$profile_name."',permission=".$permission." WHERE user_id=".$user_id."";
            if($result=$conn->query($sql)){
                if($user_id==$_SESSION['id']){
                    $_SESSION['name']=$username;
                    $_SESSION['profile_location']=$profile_name;
                    
                    header("location:../user_manage.php");          
                }
                header("location:../user_manage.php");
            }
            else{
                echo '<script>alert("Error. Data is not inserted");</script>';
            }    
        }    
}
