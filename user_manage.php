<?php
  include('./config.php');
  $sql="select user_id,username,profile_image,permission from ".TBL_USER." where (is_deleted=0) and (permission=1) and (user_id=".$_SESSION['id'].")";
  $result=$conn->query($sql);
  if(mysqli_num_rows($result)>0){
    $sql="select user_id,username,profile_image from ".TBL_USER." where is_deleted=0";
    $result=$conn->query($sql);
  }
  else{
    echo "<script>alert('Sorry. you have not permission.');</script>";
    exit();
  }
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Weblinks | User Manage</title>
  <?php
    include_once('./include/header.php');
  ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>User Manage</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="./index.php">Home</a></li>
                <li class='breadcrumb-item active'>Users Manage</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <div class="row">
                  <div class="col-sm-10">
                    <h3 class="card-title">Users list</h3>
                  </div>
                  <div class="col-sm-2">
                    <button type="button" class="btn btn-block btn-primary" onclick="window.location.href='./user_create.php';">Create User</button>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="row">
                  <div class="col-sm-12">
                    <table id="usertable">
                      <thead>
                      <tr>
                        <th>Sr No.</th>
                        <th>Username</th>
                        <th>Profile Image</th>
                        <th>Edit</th>
                        <th>Delete</th>
                        <th>Password</th> 
                      </tr>
                      </thead>
                      <tbody>
                      <?php
                        $count=1;
                        foreach($result as $data){
                          if($data['user_id']==1){  //for ajay
                            echo "<tr>
                            <td>".$count++."</td>
                            <td>".$data['username']."</td>
                            <td><img src=./files/profile/".$data['profile_image']." name=docimg width=80px height=40px></td>
                            <td></td>
                            <td></td>                         
                            <td></td> 
                          </tr>";
                          }
                          elseif($data['user_id']<>1){            
                            if($data['user_id']==$_SESSION['id']){  //unvisible for self user
                              echo "<tr>
                              <td>".$count++."</td>
                              <td>".$data['username']."</td>
                              <td><img src=./files/profile/".$data['profile_image']." name=docimg width=80px height=40px></td>
                              <td>
                              </td>
                              <td>
                              </td>
                              <td>
                              </td>                              
                              </tr>";  
                            }
                            else{                                   //visible all user
                              echo "<tr>
                              <td>".$count++."</td>
                              <td>".$data['username']."</td>
                              <td><img src=./files/profile/".$data['profile_image']." name=docimg width=80px height=40px></td>
                              <td>
                                <a href='./user_update.php?user_id=".$data['user_id']."'><i class='fas fa-edit usermanageedit'></i></a>                    
                              </td>
                              <td>
                                <a class='btndelete' href='./phpsrc/user_delete_db.php?user_id=".$data['user_id']."'><i class='fas fa-trash usermanagedelete'></i></a>                    
                              </td>                              
                              <td>
                                <a href='./change_user_password.php?user_id=".$data['user_id']."'><i class='fas fa-key usermanagepassword'></i></a>                    
                              </td>                              
                              </tr>"; 
                            }
                          }
                        }
                      ?>
                      </tbody>  
                    </table>
                  </div>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="./plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="./plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables -->
<script src="./plugins/datatables/jquery.dataTables.min.js"></script>
<script src="./plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="./plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="./plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<!-- AdminLTE App -->
<script src="./dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="./dist/js/demo.js"></script>
<!-- page script -->
<!-- datatable -->
<script src="./js/DataTables/datatables.js"></script>

</body>
</html>
<script>
$(document).ready(function(){
  $("#usertable").DataTable();  //DataTable

  $('.btndelete').click(function(e){  //confirmatin on delete
    if(!confirm('Are you sure?')){
      e.preventDefault();
      return false;
    }
    else{
      return true;
    }
  });
});
</script>