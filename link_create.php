<?php
  include("./config.php");
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Weblinks | Create Link</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
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
            <h1>Link Create</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="./index.php">Home</a></li>
              <li class="breadcrumb-item"><a href="./link_manage.php">Links</a></li>
              <li class="breadcrumb-item active">Link Create</li>
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
                <h3 class="card-title"><b>Link Details</b></h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
                    
              <form role="form" name="createlink" id="createlink" method="post" action="./phpsrc/link_create_db.php">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="title">Title <span class="required">*</span></label>
                                <input type="text" name="title" id="title" class="form-control" placeholder="Link title">
                            </div>
                            <div class="form-group">
                                <label for="links">Link <span class='required'>*</span></label>
                                <textarea class="form-control" id="links" name="links" placeholder="Place some text here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; padding: 10px;"></textarea>
                            </div>
                        </div>
                      <div class="col-md-6">
                            <div class="form-group">
                                <label for="note">Note</label>
                                <textarea class="form-control" id="note" name="note" placeholder="Place some note here" style="width: 100%; height: 285px; font-size: 14px; line-height: 18px; padding: 10px;"></textarea>
                            </div>
                        </div>
                        </div>
                        <div class="col-md-6">
                        </div>
                    </div>
                </div>
                    <div class="card-footer">
                        <input type="submit" id="btncreatelink" name="btncreatelink" class="btn btn-primary" value="Create" >
                        <a href=./link_manage.php><button type="button" class="btn btn-danger">Cancel</button></a>
                    </div>
                 <!-- /.card-body -->
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
    submitHandler: function(){
      var data=$("#createlink").serialize();
      
      $.ajax({
        url: form.attr("action"),
        type:"post",
        data:data,
      });
    }
  });

  $('#createlink').validate({
    rules: {
      title: {
        required: true,
        minlength:3,
        maxlength:30,
      },
      links: {
        required:true,
        minlength:3,
      },
    },
    messages: {
      title: {
        required: "Please give some title",
        minlength: "At least 3 character",
        maxlength: "Maximum 30 characters",
      },
      links:{
        required :"Please enter your links",
        minlength: "At least 3 character",  
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