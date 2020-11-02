<?php
    if(isset($_POST['btnupdate'])){
        session_start();
        include('../include/define.php');
        include('../include/db.php');

        $link_id=$_POST['link_id'];
        $title=$_POST['title'];
        $links=urlencode($_POST['links']);
        $update_date= date('Y-m-d H:i:s');
        $note=$_POST['note'];
        if(preg_match("/^[a-zA-Z\d\s]{3,30}$/",$title)){   //regex and update
          if(isset($_SESSION['id'])){
            $links=str_replace("'","\'",$links);
            $links=str_replace("\"","\"",$links);
 
            $sql="UPDATE ".TBL_LINK." SET updated_at='".$update_date."', title='".$title."', links='".$links."', note='".$note."' WHERE user_id=".$_SESSION['id']." and link_id=".$link_id."";
            if($result=$conn->query($sql)){
              header("location:../link_manage.php");      
            }
            else{
              echo '<script>alert("Error. User is not Created.");</script>';
              header("location:../link_manage.php");
            }  
          }  
        }
        else{
          echo "<script>alert('invalid data');</script>";
          header("location:../link_manage.php");
        }
    }
