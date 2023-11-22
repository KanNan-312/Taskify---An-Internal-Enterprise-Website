<?php
include 'db_connect.php';
// project id: $_GET['id']
$qry = $conn->query("SELECT * FROM project_list where id = ".$_GET['id'])->fetch_array();
foreach($qry as $k => $v){
	$$k = $v;
}
$user_ids = "";
$users = $conn->query("SELECT user_id FROM works_on where project_id = ".$_GET['id']);
while($row = $users->fetch_assoc()) {
	if(empty($user_ids))
		$user_ids .= $row['user_id'];
	else
		$user_ids .= ",{$row['user_id']}";
}
// echo $user_ids;
include 'new_project.php';
?>