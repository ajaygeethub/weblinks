<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Weblinks | Create User</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php
    include("./config.php");
  ?>
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
            <h1>User Create</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="./index.php">Home</a></li>
              <li class="breadcrumb-item"><a href="./user_manage.php">User Manage</a></li>
              <li class="breadcrumb-item active">User Create</li>
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
                <h3 class="card-title"><b>User Details</b></h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" name="createuser" id="createuser" method="post" action="./phpsrc/user_create_db.php" enctype='multipart/form-data'>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                              <label for="Username">Username <span class="required">*</span></label>
                            <input type="text" name="uname" id="uname" class="form-control" placeholder="User Name">
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="Password">Password <span class="required">*</span></label>
                            <input type="password" name="password" id="password" class="form-control" placeholder="Password">
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="repassword">Confirm Password <span class="required">*</span></label>
                            <input type="password" name="repassword" id="repassword" class="form-control" placeholder="Retype password">
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="ProfileImage">Profile Image</label>
                            <input type="file" name="profileimg" id="profileimg" class="form-control">                    
                          </div>
                        </div>
                        <div class="card-footer">
                            <input type="submit" id="btncreate" name="btncreate" class="btn btn-primary" value="Create"/>
                            <a href=./user_manage.php><button type="button" class="btn btn-danger">Cancel</button></a>
                        </div>
                    </div>
                 </div>
                </form>
            </div>
                <!-- /.card-body -->

              <!-- /.form start -->
            </div>
            <!-- /.card -->
        </div>
    </div>
        <!-- /.row -->
    </section>
</div><!-- /.container-fluid -->
    <!-- /.content -->
</body>
</html>
<!--main containt-->
<!-- jQuery -->
<script src="./plugins/jquery/jquery.min.js"></script>
<!-- jquery-validation -->
<script src="./plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="./plugins/jquery-validation/additional-methods.min.js"></script>
<!-- Bootstrap 4 -->
<script src="./plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Toastr -->
<script src="./plugins/toastr/toastr.min.js"></script>
<!-- AdminLTE App -->
<script src="./dist/js/adminlte.min.js"></script>
    <!-- Reguler Expression -->
<script>
$(document).ready(function () {
  $.validator.setDefaults({
    submitHandler: function () {
      var data=$('#createuser').serialize();

      $.ajax({
        url:form.attr('action'),
        method:"post",
        data:data,
      });
    }
  });
  $('#createuser').validate({
    rules: {
      uname: {
        required: true,
        maxlength:11,
        remote:{
          url:"./phpsrc/check_username_db.php",
          method:"post",
          data:{
            uname:function(){
              return $("#uname").val();
            }
          }
        },
      },
      password: {
        required: true,
        minlength:5
      },
      repassword: {
        required: true,
        minlength:5,
        equalTo:"#password"
      },
      
    },
    messages: {
      uname: {
        required: "Please enter a username",
        remote:"This username is already taken",
      },
      password: {
        required: "Please provide a password",
      },
      repassword: {
        required: "Please provide a password",
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
