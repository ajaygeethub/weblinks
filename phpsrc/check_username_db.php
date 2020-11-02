<?php
    session_start();
    include('../include/define.php');
    include('../include/db.php');

    $username=$_POST['uname'];
    $sql="SELECT username FROM ".TBL_USER." WHERE username='".$username."'";
    $result=$conn->query($sql);
    if(mysqli_num_rows($result)){
        echo "false";
    }
    else{
        echo "true";
    }
