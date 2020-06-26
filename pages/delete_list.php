<?php
		$list_id = $_GET['id'];

		//Instantiate Database object
		$database = new Database;

		$database->query('DELETE FROM lists WHERE id = :id');
		$database->bind(':id',$list_id);
		//Execute
		$database->execute();

		if($database->rowCount() > 0){
			header("Location:index.php?page=welcome&msg=listdeleted");
		}
	