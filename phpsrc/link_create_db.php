<?php
if(isset($_POST['btncreatelink'])){
        session_start();
        include('../include/define.php');
        include('../include/db.php');

        $title=$_POST['title'];
        $links=urlencode($_POST['links']);
        $currunt_date=date("Y-m-d H:i:s");
        $update_date=$currunt_date;
        $note=$_POST['note'];

        if(preg_match("/^[a-zA-Z\s\d]{3,30}$/",$title)){   //regex and insert
          $links=str_replace("'","\'",$links);
          $links=str_replace("\"","\"",$links);

          $sql="INSERT INTO ".TBL_LINK."(user_id, created_date,updated_at, title, links, note) VALUES (".$_SESSION['id'].",'".$currunt_date."','".$update_date."','".$title."','".$links."','".$note."')";    
          echo $sql;          
          if($result=$conn->query($sql)){
                header("location:../link_manage.php");      
              }
              else{
                echo '<script>alert("Error. User is not Created.");</script>';
                header("location:../link_manage.php");
              }
        }
        else{
          echo "<script>alert('invalid data');</script>";
          header("location:../link_manage.php");
        }
}