<?php
  include('./config.php');
  $sql="SELECT link_id, updated_at, title, links, note FROM ".TBL_LINK." WHERE  user_id=".$_SESSION['id']." and is_deleted=0 order by updated_at desc";
  $result=$conn->query($sql);
  $data=mysqli_fetch_array($result);
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>weblinks | Links Manage</title>
    <!-- Datatable -->

  <?php
    include_once('./include/header.php');
  ?>
</head>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Links</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="./index.php">Home</a></li>
                <li class='breadcrumb-item active'>Links</li>
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
                    <h3 class="card-title">Links</h3>
                  </div>
                  <div class="col-sm-2">
                    <button type="button" class="btn btn-block btn-primary" onclick="window.location.href='./link_create.php';">New</button>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="linktable">
                  <thead>
                  <tr>
                    <th>Sr No.</th>
                    <th>Date</th>
                    <th>Title</th> 
                    <th>Note</th>     
                    <th>Preview</th>
                    <th>Edit</th>
                    <th>Delete</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php
                    $count=1;
                    foreach($result as $data){
                      echo "<tr>
                              <td>".$count++."</td>
                              <td>".date('d-m-Y',strtotime($data['updated_at']))."</td>
                              <td>".$data['title']."</td>
                              <td>".$data['note']."</td>
                              <td><a href=./link_preview.php?link_id=".$data['link_id']." target='_black'>Preview</a></td>
                              <td><a href=./link_update.php?link_id=".$data['link_id'].">Edit</a></td>
                              <td><a class='btndelete' href=./phpsrc/link_delete_db.php?link_id=".$data['link_id'].">Delete</a></td>
                            </tr>";
                    }
                  ?>
                  </tbody>  
                </table>
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
<!-- theme DataTables
<script src="./plugins/datatables/jquery.dataTables.min.js"></script>
<script src="./plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="./plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="./plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script> -->
<!-- AdminLTE App -->
<script src="./dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="./dist/js/demo.js"></script>
<!-- datatable -->
 <script src="./js/DataTables/datatables.js"></script>

<!-- page script -->
</body>
</html>
<script>
$(document).ready(function(){

  $('#linktable').DataTable();  //DataTable

  $(".urlcopy").click(function(){  //click to copy
    $(".urlcopy").select();
      document.execCommand('copy');
  });
  
  $('.btndelete').click(function(e){  //confirmation on delete
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