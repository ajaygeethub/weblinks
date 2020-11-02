<?php
    session_start();
    include('../include/define.php');
    include('../include/db.php');

    $userid=$_SESSION['id'];
    $oldpassword=$_POST['oldpassword'];
    $sql="SELECT password FROM ".TBL_USER." WHERE user_id='".$userid."'";
    $result=$conn->query($sql);
    $data=mysqli_fetch_array($result);
    if($data['password']==md5($oldpassword)){ //(false) correct, (true) not correct
        echo "true";
    }
    else{
        echo "false";
    }
