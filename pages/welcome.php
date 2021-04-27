<?php
if($_SESSION['logged_in']){
//Instantiate Database object

$database = new Database;

//Get logged in user
$list_user = $_SESSION['username'];

//Query
$database->query('SELECT * FROM lists WHERE list_user=:list_user');
$database->bind(':list_user',$list_user);
$rows = $database->resultset();

if($rows){

echo '<ul class="list-group list-group-horizontal">';
foreach($rows as $list){
	echo '<li class="list-group-item m-3 border rounded" style="background:linear-gradient(90deg, #f7971e 0%,#ffd200 100% );"><a class="text-dark nav-link" href="?page=list&id='.$list['id'].'">'.$list['list_name'].'</a></li>';
	echo '<div class="m-3 fixed-bottom alert alert-primary" role="alert">
	To Add Another List
	<button class="btn btn-primary mx-2"><a class="nav-link text-light" href="index.php?page=new_list">Add List</a></button>
	</div>';
}
	echo '</ul>';

} else {
	echo '<div class="m-3 fixed-bottom alert alert-primary" role="alert">
	Your list is empty! Please Add Some List
	<button class="btn btn-primary mx-2"><a class="nav-link text-light" href="index.php?page=new_list">Add List</a></button>
	</div>';
}	
} else {
	include 'landingPage.php';
}
?>