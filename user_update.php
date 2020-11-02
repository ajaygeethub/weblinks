<?php
  include("./config.php");
  if(isset($_GET['user_id'])){ //onLoad Page Data
    $userid=$_GET['user_id'];
    $sql="SELECT user_id,username, profile_image, permission  FROM user_master WHERE user_id=$userid";
    $result=$conn->query($sql);
    $data=mysqli_fetch_array($result);  
    
    if($data['permission']==0){ //select permission radio btn
      $permission=0;
    }
    elseif($data['permission']==1){
      $permission=1;
    }
  }
  else{
    echo "<script>alert('Alert! Please select user.');</script>";
  }
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Weblinks | Update User</title>
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
            <h1>Update User Details</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="./index.php">Home</a></li>
              <li class="breadcrumb-item"><a href="./user_manage.php">User Manage</a></li>
              <li class="breadcrumb-item active">User Update</li>
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
                <h3 class="card-title">User <b><?php echo $data['username'];?></b></h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" action="./phpsrc/user_update_db.php" name="updateuser" id="updateuser" method="post" enctype='multipart/form-data'>
                <div class="card-body">
                    <div class="row">    
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="ProfileImage">Profile Image</label>
                                <input type="file" name="profileimgnew" class="form-control">
                                <input type="hidden" name="profileimgold" value=<?php echo $data['profile_image']; ?>>
                                <input type="hidden" name="user_id" value=<?php echo $data['user_id']; ?>>
                                
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="Gender">Permission</label><br>
                                <input type="Radio" name="permission" value="Admin" <?php if($permission==1) { echo "Checked"; } ?>> Admin
                                <input type="Radio" name="permission" value="Normal" <?php if($permission==0) { echo "Checked"; } ?>> Normal
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group col-md-3">
                                <img src="./files/profile/<?php echo $data['profile_image']; ?>" name="profileimg" width="150px" height="100px">
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" name="btnupdate" class="btn btn-primary">Submit</button>
                  <a href=./user_manage.php><button type="button" class="btn btn-danger">Cancel</button></a>
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
