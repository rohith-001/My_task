<?php 
$list_id = $_GET['id'];

//database init
$database = new Database;

$database->query("SELECT * FROM lists WHERE id=:id");
$database->bind(":id",$list_id);
$row = $database->single();
// echo '<div style="background:linear-gradient(90deg, #0f0c29 0%,#302b63 50%,#24243e 100% );">';
echo '<div class="m-4">';
echo '<h1 class="text-primary font-weight-bold text-uppercase">'.$row['list_name'].'</h1>';
echo '<p>'.$row['list_body'].'</p>';
echo '<a class="border btn btn-primary" href="?page=edit_list&id='.$row['id'].'">Edit List</a>';
echo '<a class="border btn ml-3 text-primary border-primary" href="?page=delete_list&id='.$row['id'].'">Delete List</a>';

//database init
$database = new Database;

$database->query("SELECT * FROM tasks WHERE list_id=:list_id AND is_complete=:is_complete");
$database->bind(":list_id",$list_id);
$database->bind(":is_complete",0);
$rows = $database->resultset();

echo '<h3 class="pt-5 text-primary">Tasks</h3>';
if($rows){
echo '<ul class="list-group list-group-horizontal">';
foreach($rows as $task){
	echo '<li class="list-group-item mr-3 mb-3 border rounded" style="background:linear-gradient(90deg, #f7971e 0%,#ffd200 100% );"><a class="nav-link text-dark" href="?page=task&id='.$task['id'].'">'.$task['task_name'].'</a></li>';
	echo '<div class="m-3 fixed-bottom alert alert-primary" role="alert">
	To Add Another Task
	<button class="btn btn-primary mx-2"><a class="nav-link text-light" href="index.php?page=new_task">Add Task</a></button>
	</div>';
}
echo '</ul>';
} else {
	echo '<div class="m-3 fixed-bottom alert alert-primary" role="alert">
	Your list is empty
	<button class="btn btn-primary mx-2"><a class="nav-link text-light" href="index.php?page=new_task">Add Task</a></button>
	</div>';
}
echo '</div>';
// echo '</div>';