<?php 
include 'db_connect.php';
if(isset($_GET['id'])){
	$qry = $conn->query("SELECT * FROM task_list where id = ".$_GET['id'])->fetch_array();
	foreach($qry as $k => $v){
		$$k = $v;
	}
	$assignee = $conn->query("SELECT CONCAT(firstname, ' ', lastname) as `name` FROM users WHERE id='$assignee_id'");
	$assignee_name = $assignee->fetch_assoc()["name"];
}
?>
<div class="container-fluid">
	<dl>
		<dt><b class="border-bottom border-primary">Task name</b></dt>
		<dd><?php echo ucwords($task) ?></dd>
	</dl>
	<dl>
		<dt><b class="border-bottom border-primary">Assignee</b></dt>
		<dd><?php echo ucwords($assignee_name) ?></dd>
	</dl>
	<dl>
		<dt><b class="border-bottom border-primary">Status</b></dt>
		<dd>
			<?php 
        	if($status == 1){
		  		echo "<span class='badge badge-secondary'>Pending</span>";
        	}elseif($status == 2){
		  		echo "<span class='badge badge-primary'>In Progress</span>";
        	}elseif($status == 3){
		  		echo "<span class='badge badge-success'>Done</span>";
        	}
        	?>
		</dd>
	</dl>
	<dl>
		<dt><b class="border-bottom border-primary">Description</b></dt>
		<dd><?php echo $description; ?></dd>
	</dl>
</div>