<?php 
include 'db_connect.php';
// task id: $_GET['id], editing task
if(isset($_GET['id'])){
	$qry = $conn->query("SELECT * FROM task_list where id = ".$_GET['id'])->fetch_array();
	foreach($qry as $k => $v){
		$$k = $v;
	}
}
?>
<div class="container-fluid">
	<form action="" id="manage-task">
		<input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>">
		<input type="hidden" name="project_id" value="<?php echo isset($_GET['pid']) ? $_GET['pid'] : '' ?>">
		<!-- Task name -->
		<div class="form-group">
			<label for="">Task</label>
			<input required type="text" class="form-control form-control-sm" name="task" value="<?php echo isset($task) ? $task : '' ?>" required>
		</div>
		<!-- Description -->
		<div class="form-group">
			<label for="">Description</label>
			<textarea name="description" id="" cols="30" rows="10" class="form-control"><?php echo isset($description) ? $description : '' ?></textarea>
		</div>
		<!-- Deadline -->
		<div class="form-group">
			<label for="" class="form-label">Deadline</label>
			<input required type="date" class="form-control form-control-sm" autocomplete="off" name="deadline" value="<?php echo isset($deadline) ? date("Y-m-d",strtotime($deadline)) : '' ?>">
		</div>
		<!-- Status -->
		<div class="form-group">
			<label for="">Status</label>
			<select required name="status" id="status" class="custom-select custom-select-sm">
				<option value="1" <?php echo isset($status) && $status == 1 ? 'selected' : '' ?>>Pending</option>
				<option value="2" <?php echo isset($status) && $status == 2 ? 'selected' : '' ?>>In Progress</option>
				<option value="3" <?php echo isset($status) && $status == 3 ? 'selected' : '' ?>>Done</option>
			</select>
		</div>
		<!-- Assignee -->
		<div class="form-group">
			<label for="" class="form-label">Person in charge</label>
			<select required class="form-control form-control-sm select2" name="assignee_id">
				<option></option>
				<?php
				$pid = $_GET["pid"];
				// name of manager
				$manager = $conn -> query("SELECT u.id as manager_id, concat(firstname,' ',lastname) as name from users u JOIN project_list pl
				ON u.id = pl.manager_id WHERE pl.id = $pid") -> fetch_assoc();
				$manager_id = $manager["manager_id"];
				$manager_name = ucwords($manager["name"]);
				echo "<option value='$manager_id'>$manager_name</option>";
				// name of employee
				$employees = $conn->query("SELECT users.id ,concat(firstname,' ',lastname) as name FROM users JOIN works_on ON users.id = works_on.user_id
				where works_on.project_id = $pid order by concat(firstname,' ',lastname) asc ");
				while($row= $employees->fetch_assoc()):
				?>
				<option value="<?php echo $row['id'] ?>" <?php echo (isset($assignee_id) && $row['id'] == $assignee_id)? 'selected' : '' ?>>
					<?php echo ucwords($row['name']) ?>
				</option>
				<?php endwhile; ?>
			</select>
		</div>
	</form>
</div>

<script>
	$('#manage-task').submit(function(e){
		e.preventDefault()
		start_load()
		$.ajax({
			url:'ajax.php?action=save_task',
		data: new FormData($(this)[0]),
			cache: false,
			contentType: false,
			processData: false,
			method: 'POST',
			type: 'POST',
		success:function(resp){
			if(resp == 1){
				alert_toast('Data successfully saved',"success");
				setTimeout(function(){
					location.reload()
				},1000)
			}
		}
		})
	})
</script>