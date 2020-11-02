<?php
  include("./config.php");
  if(isset($_GET['link_id'])){ //onLoad Page Data
    $link_id=$_GET['link_id'];
    $sql="SELECT created_date, updated_at, title, links, note FROM ".TBL_LINK." WHERE link_id=".$link_id." and user_id=".$_SESSION['id']."";
    $result=$conn->query($sql);
      
    if(isset($result)){
      $data=mysqli_fetch_array($result);
      $links_array=explode(PHP_EOL,urldecode($data['links']));
    }
    else{
      echo "<script>alert('Error, can't select');</script>";
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
  <title>Weblinks | Preview Link</title>
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
            <h1>Preview link Details</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="./index.php">Home</a></li>
              <li class="breadcrumb-item"><a href="./link_manage.php">Links</a></li>
              <li class="breadcrumb-item active">Preview</li>
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
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                          <table class='table'>
                            <thead>
                              <tr>
                                <th>Title</th>
                                <th>Created Date</th>
                                <th>Last update</th>
                                <th>Note</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <td><?php echo $data['title'];?><input type="hidden" name="link_id" id="link_id" class="form-control" value="<?php echo $data['link_id'];?>"></td>
                                <td><?php echo date('h:i:s A d/m/Y',strtotime($data['created_date']));?></td>
                                <td><?php echo date('h:i:s A d/m/Y',strtotime($data['updated_at']));?></td>
                                <td><?php echo $data['note'];?></td>
                              </tr>
                            </tbody>
                          </table>
                        
                        <?php  
                            echo "<label for='links' id='details'>Link</label>";
                            foreach($links_array as $link){
                            echo "<div class='col-md-12'>
                                    <div class='form-group'>
                                        <label for'urllabel' class='url_label' id='labelid' value=".$link.">".$link."</label>
                                    </div>
                                  </div>";
                            }
                        ?>
                    </div>
                </div>
            </div>
            <!-- /.card -->
            </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    <!-- /.content -->
  </div>
</section>

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
  $('.url_label').click(function(){
    $(".url_label").select();
    document.execCommand('copy');
  })
  
  // $('.').on('click','#btncopy',function(){
  //   var url=$(this).closest('#details').find('#hdetails').val()
  //   alert(url);
    // $(".url_label").val();
    // document.execCommand('copy');
  // })
});
</script>