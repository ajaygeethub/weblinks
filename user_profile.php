<?php
  include("./config.php");
  if(isset($_SESSION['id'])){ //onLoad Page Data
    $userid=$_SESSION['id'];
    $sql="SELECT user_id,username, profile_image  FROM user_master WHERE user_id=".$userid."";
    $result=$conn->query($sql);
    $data=mysqli_fetch_array($result);  
  }
  else{
    echo "<script>alert('Sorry! GO to login page.');</script>";
  }
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Weblinks | Profile</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="./plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="./plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="./dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition register-page">
<!--main containt-->

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>User Profile</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="./index.php">Home</a></li>
              <li class="breadcrumb-item active">User Profile</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Your Details</b></h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" name="userprofile" id="userprofile" method="post" action="./phpsrc/user_profile_db.php" enctype='multipart/form-data'>
                <div class="card-body">
                  <div class="form-group">
                    <label for="Username">Username </label>
                    <input type="text" name="uname" id="uname" class="form-control" value=<?php echo $data['username'];?> placeholder="User Name">
                    <span class="error_form" id="username_error_message"></span>
                  </div>
                  <div class="form-group">
                    <label for="ProfileImage">Profile Image</label>
                    <input type="file" name="profileimgnew" id="profileimgnew" class="form-control">  
                    <input type="hidden" name="profileimgold" value=<?php echo $data['profile_image']; ?>>                  
                  </div>   
                  <div class="form-group">
                    <img src="./files/profile/<?php echo $data['profile_image']; ?>" name="profileimg" width="150px" height="100px">
                  </div> 
                  <div class="form-group">
                    <a href=./change_password.php>Change Password</a>
                  </div> 
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <input type="submit" id="btnupdate" name="btnupdate" class="btn btn-primary" value="Update"/>
                  <a href=./index.php><button type="button" class="btn btn-danger">Cancel</button></a>
                </div>
              </form>
            </div>
            <!-- /.card -->
            </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
<!--main containt-->
<!-- jQuery -->
<script src="./plugins/jquery/jquery.min.js"></script>
<!-- jquery-validation -->
<script src="./plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="./plugins/jquery-validation/additional-methods.min.js"></script>
<!-- Bootstrap 4 -->
<script src="./plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="./dist/js/adminlte.min.js"></script>
</body>
</html>
<script>
$(document).ready(function(){
  $.validator.setDefaults({
    submitHandler: function () {
      var data=$('#userprofile').serialize();
      $.ajax({
        url:form.attr('action'),
        method:"post",
        data:data,
      }); 
    }
  });

  $('#userprofile').validate({
    rules: {
      uname: {
        required: true,
        maxlength:11,
        remote:{
          url:'./phpsrc/check_exist_username_db.php',
          method:'post',
          data:{
            uname:function(){
              return $("#uname").val();
            }
          }
        },
      },
    },
    messages: {
      uname: {
        required: "Please enter a username",
        remote: 'This username is already taken',
      },
    },
    errorElement: 'span',
    errorPlacement: function (error, element) {
      error.addClass('invalid-feedback');
      element.closest('.form-group').append(error);
    },
    highlight: function (element, errorClass, validClass) {
      $(element).addClass('is-invalid');
    },
    unhighlight: function (element, errorClass, validClass) {
      $(element).removeClass('is-invalid');
    }
  });
});
</script>