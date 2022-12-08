<?php include'db_connect.php' ?>
<div class="col-lg-12">
	<div class="card card-outline card-primary">
		<!-- <div class="card-header">
			<div class="card-tools">
				<a class="btn btn-block btn-sm btn-default btn-flat border-primary" href="./index.php?page=new_project"><i class="fa fa-plus"></i> Add New project</a>
			</div>
		</div> -->
		<div class="card-body">
			<table class="table tabe-hover table-condensed" id="list">
				<colgroup>
					<col width="5%">
					<col width="20%">
					<col width="20%">
					<col width="25%">
					<col width="15%">
					<col width="15%">
				</colgroup>
				<thead>
					<tr>
						<th class="text-center">#</th>
						<th>Project</th>
						<th>Task</th>
						<th>Description</th>
						<th>Deadline</th>
						<th>Task Status</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$i = 1;
					$where = " where assignee_id = " . $_SESSION["login_id"];
					$stat = array("Pending","In Progress","Done");
					$qry = $conn->query("SELECT t.*,p.name as pname FROM task_list t join project_list p on p.id = t.project_id $where order by t.task asc");
					while($row= $qry->fetch_assoc()):
						$trans = get_html_translation_table(HTML_ENTITIES,ENT_QUOTES);
						unset($trans["\""], $trans["<"], $trans[">"], $trans["<h2"]);
						$desc = strtr(html_entity_decode($row['description']),$trans);
						$desc=str_replace(array("<li>","</li>"), array("",", "), $desc);


					?>
					<tr>
						<td class="text-center"><?php echo $i++ ?></td>
						<td>
							<p><b><?php echo ucwords($row['pname']) ?></b></p>
						</td>
						<td>
							<p><b><?php echo ucwords($row['task']) ?></b></p>
						</td>
						<td>
							<p class="truncate"><?php echo strip_tags($desc) ?></p>
						</td>
						<td><b><?php echo date("M d, Y",strtotime($row['deadline'])) ?></b></td>

						<td>
							<?php
							  if($row['status'] == 1){
							  	echo "<span class='badge badge-secondary'>Pending</span>";
							  }elseif($row['status'] == 2){
							  	echo "<span class='badge badge-info'>In Progress</span>";
							  }elseif($row['status'] == 3){
							  	echo "<span class='badge badge-success'>Done</span>";
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
	})
</script>