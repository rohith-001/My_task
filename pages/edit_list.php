<?php
	if($_POST['submit']){
		$list_id = $_GET['id'];
		$list_name = $_POST['list_name'];
		$list_body = $_POST['list_body'];
		
		//Instantiate Database object
		$database = new Database;
		
		$database->query('UPDATE lists SET list_name = :list_name,list_body = :list_body WHERE id = :id');
		$database->bind(':list_name',$list_name);
		$database->bind(':list_body',$list_body);
		$database->bind(':id',$list_id);
		$database->execute();
		if($database->rowCount()){
			header("Location:index.php?page=welcome");
		}
	}
?>

<?php
$list_id = $_GET['id'];

//Instantiate Database object
$database = new Database;
//Query
$database->query('SELECT * FROM lists WHERE id = :id');
$database->bind(':id',$list_id);
$row = $database->single();
?>

<h1>Edit List</h1>
<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
	<label>List Name</label><br />
	<input type="text" name="list_name" value="<?php echo $row['list_name']; ?>" /><br />
	
	<label>List Body</label><br />
	<textarea rows="5" cols="50" name="list_body"><?php echo $row['list_body']; ?></textarea><br />
	<input type="submit" value="Update" name="submit" />
</form>