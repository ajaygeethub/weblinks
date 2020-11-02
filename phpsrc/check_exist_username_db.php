<?php
    session_start();
    include('../include/define.php');
    include('../include/db.php');

    $username=$_POST['uname'];
    $sql="SELECT username FROM ".TBL_USER." WHERE username='".$username."' AND user_id !='".$_SESSION['id']."'";
    $result=$conn->query($sql);
    $data=mysqli_fetch_array($result);
    if(mysqli_num_rows($result)>0){ //(false) user chhe, (true) user nathi
        if($data['username']<>$_SESSION['username']){
            echo "false";
        }
    }
    else{
        echo "true";
    }
