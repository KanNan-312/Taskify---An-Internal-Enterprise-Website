<?php include'db_connect.php' ?>
<div class="col-lg-12">
	<div class="card card-outline card-primary">
		<div class="card-header">
            <?php if($_SESSION['login_type'] != 3): ?>
			<div class="card-tools">
				<a class="btn btn-block btn-sm btn-default btn-flat border-primary" href="./index.php?page=new_project"><i class="fa fa-plus"></i> Add New project</a>
			</div>
            <?php endif; ?>
		</div>
		<div class="card-body">
			<table class="table tabe-hover table-condensed" id="list">
				<colgroup>
					<col width="5%">
					<col width="35%">
					<col width="15%">
					<col width="15%">
					<col width="15%">
					<col width="15%">
				</colgroup>
				<thead>
					<tr>
						<th class="text-center">#</th>
						<th>Project</th>
						<th>Date Started</th>
						<th>Due Date</th>
						<th>Status</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$i = 1;
					$stat = array("Pending","In Progress","Done");
					$where = "";
					if($_SESSION['login_type'] == 2){
						$where = " where manager_id = '{$_SESSION['login_id']}' ";
					}elseif($_SESSION['login_type'] == 3){
						$where = " join works_on on id = project_id where user_id = {$_SESSION['login_id']} ";
					}
					$qry = $conn->query("SELECT * FROM project_list $where order by name asc");
					while($row= $qry->fetch_assoc()):
						$trans = get_html_translation_table(HTML_ENTITIES,ENT_QUOTES);
						unset($trans["\""], $trans["<"], $trans[">"], $trans["<h2"]);
						$desc = strtr(html_entity_decode($row['description']),$trans);
						$desc=str_replace(array("<li>","</li>"), array("",", "), $desc);

					 	// $tprog = $conn->query("SELECT * FROM task_list where project_id = {$row['id']}")->num_rows;
						// $cprog = $conn->query("SELECT * FROM task_list where project_id = {$row['id']} and status = 3")->num_rows;
						// $prog = $tprog > 0 ? ($cprog/$tprog) * 100 : 0;

						// $prog = $prog > 0 ?  number_format($prog,2) : $prog;
						// $prod = $conn->query("SELECT * FROM user_productivity where project_id = {$row['id']}")->num_rows;

						// if($row['status'] == 0 && strtotime(date('Y-m-d')) >= strtotime($row['start_date'])):
						// 	if($prod  > 0  || $cprog > 0)
						// 		$row['status'] = 2;
						// 	else
						// 		$row['status'] = 1;
						// elseif($row['status'] == 0 && strtotime(date('Y-m-d')) > strtotime($row['end_date'])):
						// $row['status'] = 4;
						// endif;
					?>
					<tr>
						<!-- Project id -->
						<th class="text-center"><?php echo $i++ ?></th>
						<!-- Project name and description -->
						<td>
							<p><b><?php echo ucwords($row['name']) ?></b></p>
							<p class="truncate"><?php echo strip_tags($desc) ?></p>
						</td>
						<!-- Start and end date columns -->
						<td><b><?php echo date("M d, Y",strtotime($row['start_date'])) ?></b></td>
						<td><b><?php echo date("M d, Y",strtotime($row['end_date'])) ?></b></td>
						<!-- Status column -->
						<td class="">
							<?php
							  if($row['status'] == 1){
							  	echo "<span class='badge badge-secondary'>Pending</span>";
							  }elseif($row['status'] == 2){
							  	echo "<span class='badge badge-primary'>In Progress</span>";
							  }elseif($row['status'] == 3){
							  	echo "<span class='badge badge-success'>Done</span>";
							  }
							?>
						</td>
						<!-- Action column -->
						<td class="">
							<button type="button" class="btn btn-default btn-sm btn-flat border-info wave-effect text-info dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="true">
								Action
							</button>
							<div class="dropdown-menu" style="">
								<a class="dropdown-item view_project" href="./index.php?page=view_project&id=<?php echo $row['id'] ?>" data-id="<?php echo $row['id'] ?>">View</a>
								<div class="dropdown-divider"></div>
								<?php if($_SESSION['login_type'] != 3): ?>
								<a class="dropdown-item" href="./index.php?page=edit_project&id=<?php echo $row['id'] ?>">Edit</a>
								<div class="dropdown-divider"></div>
								<a class="dropdown-item delete_project" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>">Delete</a>
						<?php endif; ?>
							</div>
						</td>
					</tr>	
				<?php endwhile; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<style>
	table p{
		margin: unset !important;
	}
	table td{
		vertical-align: middle !important
	}
</style>
<script>
	$(document).ready(function(){
		$('#list').dataTable()
	
	$('.delete_project').click(function(){
		confirmModal("Are you sure to delete this project?","delete_project",[$(this).attr('data-id')])
	})
	})
	function delete_project($id){
		start_load()
		$.ajax({
			url:'ajax.php?action=delete_project',
			method:'POST',
			data:{id:$id},
			success:function(resp){
				if(resp==1){
					alert_toast("Data successfully deleted",'success')
					setTimeout(function(){
						location.reload()
					},1500)

				}
			}
		})
	}
</script>