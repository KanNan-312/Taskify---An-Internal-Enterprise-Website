<?php include('db_connect.php') ?>

<!-- Info boxes -->
 <div class="col-12">
  <div class="card">
    <div class="card-body">
      Welcome <span class="fw-bolder"><?php echo $_SESSION['login_name'] ?>!</span>
    </div>
  </div>
</div>
<hr>
<?php 

  $where = " WHERE 1=1";
  if($_SESSION['login_type'] == 2){
    $where = " WHERE manager_id = {$_SESSION['login_id']} ";
  }elseif($_SESSION['login_type'] == 3){
    $where = " JOIN works_on ON works_on.project_id = project_list.id WHERE works_on.user_id = {$_SESSION['login_id']} ";
  }

  $where2 = "";
  if($_SESSION['login_type'] == 2){
    $where2 = " where p.manager_id = '{$_SESSION['login_id']}' ";
  }elseif($_SESSION['login_type'] == 3){
    $where2 = " where concat('[',REPLACE(p.user_ids,',','],['),']') LIKE '%[{$_SESSION['login_id']}]%' ";
  }
  ?>

<!-- Show dashboard information -->
<div class="row">

  <div class="col col-12 col-md-4">
    <div class="small-box bg-light shadow-sm border">
      <div class="inner">
        <h3 class="fs-1"><?php echo $conn->query("SELECT * FROM project_list $where")->num_rows; ?></h3>
        <p>Total Projects</p>
      </div>
      <div class="icon">
          <i class="fa fa-layer-group"></i>
      </div>
    </div>
  </div>

  <div class="col col-12 col-md-4">
    <div class="small-box bg-light shadow-sm border">
      <div class="inner">
        <h3 class="fs-1"><?php echo $conn->query("SELECT * FROM project_list $where AND status=2")->num_rows; ?></h3>
        <p>In Progress</p>
      </div>
      <div class="icon">
          <i class="fa fa-layer-group"></i>
      </div>
    </div>
  </div>

  <div class="col col-12 col-md-4">
    <div class="small-box bg-light shadow-sm border">
      <div class="inner">
        <h3 class="fs-1"><?php echo $conn->query("SELECT * FROM project_list $where AND status=3")->num_rows; ?></h3>
        <p>Done</p>
      </div>
      <div class="icon">
          <i class="fa fa-layer-group"></i>
      </div>
    </div>
  </div>  
  <!-- <div class="col col-12 col-md-4">
    <div class="small-box bg-light shadow-sm border">
      <div class="inner">
        <h3><?php 
        // echo $conn->query("SELECT t.*,p.name as pname,p.start_date,p.status as pstatus, p.end_date,p.id as pid FROM task_list t inner join project_list p on p.id = t.project_id $where2")->num_rows; 
        ?></h3>
        <p>Total Tasks</p>
      </div>
      <div class="icon">
        <i class="fa fa-tasks"></i>
      </div>
    </div>
  </div> -->
 

</div>
