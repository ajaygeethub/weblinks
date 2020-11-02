<?php
  include("./config.php");
  if(isset($_GET['link_id'])){ //onLoad Page Data
    $link_id=$_GET['link_id'];
    $sql="SELECT link_id, user_id, updated_at, title, links, note FROM ".TBL_LINK." WHERE link_id=".$link_id."";
    
    $result=$conn->query($sql);
    if(isset($result)){
      $data=mysqli_fetch_array($result); 
    }
    else{
      echo "<script>alert('Error, can't select');</script>";
      exit();
    }
  }
  else{
    echo "<script>alert('Alert! Please select user.');</script>";
    exit();
  }
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Weblinks | Update Link</title>
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
            <h1>Update link Details</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="./index.php">Home</a></li>
              <li class="breadcrumb-item"><a href="./link_manage.php">Links</a></li>
              <li class="breadcrumb-item active">Link Update</li>
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
                <h3 class="card-title">Title <b><?php echo $data['title'];?></b></h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" action="./phpsrc/link_update_db.php" name="updatelink" id="updatelink" method="post" enctype='multipart/form-data'>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                              <label for="title">Title <span class="required">*</span></label>
                              <input type="text" name="title" id="title" class="form-control" value="<?php echo $data['title'];?>" placeholder="Title">
                              <input type="hidden" name="link_id" id="link_id" class="form-control" value="<?php echo $data['link_id'];?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                              <label for="date">Last updated</label>
                              <input type="text" name="currunt_date" id="currunt_date" class="form-control" value=<?php echo date('d-m-Y--h:i:A',strtotime($data['updated_at']));?> disabled=disabled>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                              <label for="links">Link <span class="required">*</span></label>
                              <textarea type="text" name="links" id="links" class="form-control" placeholder="links" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; padding: 10px;"><?php echo urldecode($data['links']);?></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                              <label for="Username">Note</label>
                              <textarea type="text" name="note" id="note" class="form-control" placeholder="Note" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; padding: 10px;"><?php echo $data['note'];?></textarea>
                            </div>
                        </div>
                        <div class="card-footer">
                          <button type="submit" name="btnupdate" class="btn btn-primary">Submit</button>
                          <a href=./link_manage.php><button type="button" class="btn btn-danger">Cancel</button></a>
                        </div>
                    </div>
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
      var data=$("#updatelink").serialize();
      
      $.ajax({
        url: form.attr("action"),
        type:"post",
        data:data,
      });
    }
  });

  $('#updatelink').validate({
    rules: {
      title: {
        required: true,
        minlength:3,
        maxlength:30,
      },
      links: {
        required:true,
        minlength:3
      },
    },
    messages: {
      title: {
        required: "Please give some title",
        minlength: "At least 3 character",
        maxlength: "Maximum 30 characters",
      },
      links:{
        required :"Please enter links",
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