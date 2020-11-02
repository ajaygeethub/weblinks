<?php

    if(isset($_POST['btncreate'])){
        session_start();
        include('../include/define.php');
        include('../include/db.php');

        $username=$_POST['uname'];
        $password=$_POST['password'];
        $repassword=$_POST['repassword'];
        $profileimg=$_FILES['profileimg'];
        
        if($password<>$repassword || $password==""){
            echo "<script>alert('Password is not match');</script>";
        }
        elseif($password==$repassword){
            if(preg_match("/^[a-zA-Z0-9]{1,11}$/",$username)){      //regex and insert
                $profile_location="../files/profile/";
                $doc_location="../files/document/";    
                $profile_temp  = $profileimg["tmp_name"];
                $doc_temp  = $docimg["tmp_name"];
                
                if(empty($profileimg["name"])){   //for profile upload
                    $profile_name="default.png";
                }
                elseif(!empty($profileimg["name"])){ 
                    $profile_name=time().basename($profileimg["name"]);
                    if(!move_uploaded_file($profile_temp, $profile_location.$profile_name)){
                    echo "<script>alert('error, Profile image in not uploded');</script>";
                    }    
                }

            

                $sql="INSERT INTO ".TBL_USER."(username, password, profile_image, permission, is_deleted) VALUES ('".$username."','".md5($password)."','".$profile_name."',0,0)";
                if($result=$conn->query($sql)){
                  header("location:../user_manage.php");      
                }
                else{
                  echo '<script>alert("Error. User is not Created.");</script>';
                  header("location:../user_manage.php");      
                }    
            }
            else{
                echo "<script>alert('invalid data');</script>";
                header("location:../user_manage.php");
            }
        }
    }
