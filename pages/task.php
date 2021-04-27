<?php
$task_id = $_GET['id'];

//Instantiate Database object
$database = new Database;
//Query
$database->query('SELECT * FROM tasks WHERE id = :id');
$database->bind(':id',$task_id);
$row = $database->single();
echo '<div class="m-4">';
echo '<h1 class="text-primary font-weight-bold text-uppercase">'.$row['task_name'].'</h1>';
echo '<p>'.$row['task_body'].'</p>';
echo '<button type="button" class="btn  btn-primary"> Due date <span class="badge badge-warning">'.$row['due_date'].'</span></button>';
if($row['is_complete'] == 1){
	echo '<button type="button" class="btn ml-3 btn-primary"> Status';
	echo '<span class="badge badge-success ml-2">Complete</span>';
	echo '</button>';
} else {
	echo '<button type="button" class="btn ml-3 btn-primary"> Status';
	echo '<span class="badge badge-warning ml-2">Incomplete</span>';
	echo '</button>';
}
?>
<br />
<br />
<a class="btn btn-warning" href="?page=edit_task&id=<?php echo $row['id']; ?>">Edit Task</a>
</div>