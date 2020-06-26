<?php
	if($_POST['submit']){
		$task_id = $_GET['id'];
		$task_name = $_POST['task_name'];
		$task_body = $_POST['task_body'];
		$due_date = $_POST['due_date'];
		$list_id = $_POST['list_id'];
		$is_complete = $_POST['is_complete'];
		
		//Instantiate Database object
		$database = new Database;
		
		$database->query('UPDATE tasks SET task_name=:task_name,task_body=:task_body,due_date=:due_date,list_id=:list_id,is_complete=:is_complete WHERE id=:id');
		$database->bind(':task_name',$task_name);
		$database->bind(':task_body',$task_body);
		$database->bind(':due_date',$due_date);
		$database->bind(':list_id',$list_id);
		$database->bind(':id',$task_id);
		$database->bind(':is_complete',$is_complete);
		$database->execute();
		if($database->rowCount()){
			header("Location:index.php?page=list&id=".$list_id);
		}
	}
?>
<?php
//Instantiate Database object
$database = new Database;
//Query
$database->query('SELECT * FROM lists');
$rows = $database->resultset();
?>

<?php
$task_id = $_GET['id'];

//Instantiate Database object
$database = new Database;
//Query
$database->query('SELECT * FROM tasks WHERE id = :id');
$database->bind(':id',$task_id);
$row = $database->single();
?>

<h1>Edit Task</h1>
<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
	<label>Task Name</label><br />
	<input type="text" name="task_name" value="<?php echo $row['task_name']; ?>" /><br />
	
	<label>Task Body</label><br />
	<textarea rows="5" cols="50" name="task_body"><?php echo $row['task_body']; ?></textarea><br />
	<label>Due Date</label><br />
	<input type='date' name='due_date' value="<?php echo date($row['due_date']); ?>" /><br />
	<label>List</label><br />
	<select name="list_id">
		<option value ="0">--Select List--</option>
		<?php foreach($rows as $list) : ?>
			<option value ="<?php echo $list['id']; ?>" <?php if($list['id'] == $task_id){ echo 'selected';} ?>><?php echo $list['list_name']; ?></option>
		<?php endforeach; ?>
	</select>
	<br />
	Mark if Completed <input type="checkbox" name="is_complete" value="1" />
	<br />
	<br />
	<input type="submit" value="Update" name="submit" />
</form>