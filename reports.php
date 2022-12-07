<?php include 'db_connect.php' ?>
 <div class="col-md-12">
  <div class="card card-outline card-primary">
    <div class="card-header">
      <b>Project Progress</b>
      <div class="card-tools">
        <button class="btn btn-sm btn-primary" id="print"><i class="fa fa-print"></i> Print</button>
      </div>
    </div>
    <div class="card-body p-0">
      <div class="table-responsive" id="printable">
        <table class="table m-0 table-bordered">
          <colgroup>
            <col width="5%">
            <col width="30%">
            <col width="15%">
            <col width="15%">
            <col width="25%">
            <col width="10%">
          </colgroup>
          <thead>
            <th>#</th>
            <th>Project</th>
            <th>Task</th>
            <th>Completed Task</th>
            <th>Progress</th>
            <th>Status</th>
          </thead>
          <tbody>
          <?php
          $i = 1;
          // boss can view report of all the projects, project manager can only view the assigned projects
          $where = "";
          if($_SESSION['login_type'] == 2)
            $where = " where manager_id = '{$_SESSION['login_id']}' ";

          $qry = $conn->query("SELECT * FROM project_list $where order by name asc");

          while($row= $qry->fetch_assoc()):
            // progress: the number of tasks completed over the total number of tasks
            $tprog = $conn->query("SELECT * FROM task_list where project_id = {$row['id']}")->num_rows;
            $cprog = $conn->query("SELECT * FROM task_list where project_id = {$row['id']} and status = 3")->num_rows;
            $prog = $tprog > 0 ? ($cprog/$tprog) * 100 : 0;
            ?>
            <tr>
                <td>
                    <?php echo $i++ ?>
                </td>
                <td>
                    <a>
                        <?php echo ucwords($row['name']) ?>
                    </a>
                    <br>
                    <small>
                        Due: <?php echo date("Y-m-d",strtotime($row['end_date'])) ?>
                    </small>
                </td>
                <td class="text-center">
                  <?php echo number_format($tprog) ?>
                </td>
                <td class="text-center">
                  <?php echo number_format($cprog) ?>
                </td>

                <td class="project_progress">
                    <div class="progress progress-sm">
                        <div class="progress-bar bg-green" role="progressbar" aria-valuenow="57" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $prog ?>%">
                        </div>
                    </div>
                    <small>
                        <?php echo $prog ?>% Complete
                    </small>
                </td>
                <td class="project-state">
                    <?php
                      if($row['status'] == 1){
                        echo "<span class='badge badge-secondary'>Pending</span>";
                      }elseif($row['status'] == 2){
                        echo "<span class='badge badge-primary'>In Progress</span>";
                      }elseif($row['status'] == 3){
                        echo "<span class='badge badge-primary'>Done</span>";
                      }
                    ?>
                </td>
            </tr>
          <?php endwhile; ?>
          </tbody>  
        </table>
      </div>
    </div>
  </div>
  </div>
<script>
	$('#print').click(function(){
		start_load()
		var _h = $('head').clone()
		var _p = $('#printable').clone()
		var _d = "<p class='text-center'><b>Project Progress Report as of (<?php echo date("F d, Y") ?>)</b></p>"
		_p.prepend(_d)
		_p.prepend(_h)
		var nw = window.open("","","width=900,height=600")
		nw.document.write(_p.html())
		nw.document.close()
		nw.print()
		setTimeout(function(){
			nw.close()
			end_load()
		},750)
	})
</script>