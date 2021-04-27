<?php
	if($_POST['task_submit']){
		$task_name = $_POST['task_name'];
		$task_body = $_POST['task_body'];
		$due_date = $_POST['due_date'];
		$list_id = $_POST['list_id'];

		//Instantiate Database object
		$database = new Database;

		$database->query('INSERT INTO tasks (task_name,task_body,due_date,list_id) VALUES(:task_name,:task_body,:due_date,:list_id)');
		$database->bind(':task_name',$task_name);
		$database->bind(':task_body',$task_body);
		$database->bind(':due_date',$due_date);
		$database->bind(':list_id',$list_id);
		$database->execute();
		if($database->lastInsertId()){
			header("Location:index.php?page=list&id=".$list_id);
		}

	}

?>

<?php
//Instantiate Database object
$database = new Database;

//Get logged in user
$list_user = $_SESSION['username'];

//Query
$database->query('SELECT * FROM lists WHERE list_user = :list_user');
$database->bind(':list_user',$list_user);
$rows = $database->resultset();
?>

<form class="form-group m-5" action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
	<label class="text-primary h5 font-weight-bold">Task Name</label>
	<input class="form-control w-100" type="text" name="task_name" /><br />
	<label class="text-primary h5 font-weight-bold">Task Discription</label>
	<textarea class="form-control w-100" rows="5" cols="50" name="task_body"></textarea><br />
	<div class="form-row">
		<div class="col-md-6 mb-3">
			<label class="text-primary h5 font-weight-bold">Due Date</label>
			<input class="form-control w-100" type='date' name='due_date' />
		</div>
		<div class="col-md-6 mb-3">
			<?php if($_GET['listid']) : ?>
				<input class="form-control w-100" type="hidden" name="list_id" value="<?php echo $_GET['listid']; ?>" />
			<?php else : ?>
			<label class="text-primary h5 font-weight-bold">List</label>
			<select class="form-control w-100" name="list_id">
			<option value ="0">--Select List--</option>
				<?php foreach($rows as $list) : ?>
					<option value ="<?php echo $list['id']; ?>"><?php echo $list['list_name']; ?></option>
				<?php endforeach; ?>
			</select>
			<?php endif; ?>
		</div>
</div>
</br>
	<input class="btn btn-primary" type="submit" value="Create" name="task_submit" />
</form>