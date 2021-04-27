<?php if($_POST['register_submit']){
		$first_name = $_POST['first_name'];
		$last_name = $_POST['last_name'];
		$email = $_POST['email'];
		$username = $_POST['username'];
		$password = $_POST['password'];
		$password2 = $_POST['password2'];
		$errors = array();

		//Check passwords match
		if($password != $password2){
			$errors[] = "Your passwords do not match";
		} 
		//Check first name
		if(empty($first_name)){
			$errors[] = "First Name is Required";
		} 
		//Check email
		if(empty($email)){
			$errors[] = "Email is Required";
		} 
		//Check username
		if(empty($username)){
			$errors[] = "Username is Required";
		} 
		//Match passwords
		if(empty($password)){
			$errors[] = "Password is Required";
		} 


		//Instantiate Database object
		$database = new Database;

		/* Check to see if username has been used */

		//Query
		$database->query('SELECT username FROM users WHERE username = :username');
		$database->bind(':username', $username);  
		//Execute
		$database->execute();
		if($database->rowCount() > 0){
			$errors[] = "Sorry, that username is taken";
		}

		/* Check to see if email has been used */

		//Query
		$database->query('SELECT email FROM users WHERE email = :email');
		$database->bind(':email', $email);  
		//Execute
		$database->execute();
		if($database->rowCount() > 0){
			$errors[] = "Sorry, that email is taken";
		}

		//If there are no errors, proceed with registration
		if(empty($errors)){
			//Encrypt Password
			$enc_password = md5($password);

			//Query
			$database->query('INSERT INTO users (first_name,last_name,email,username,password)
			              VALUES(:first_name,:last_name,:email,:username,:password)');
			//Bind Values
			$database->bind(':first_name', $first_name);  
			$database->bind(':last_name', $last_name);   
			$database->bind(':email', $email);  
			$database->bind(':username', $username);  
			$database->bind(':password', $enc_password);  

			//Execute
			$database->execute();

			//If row was inserted
			if($database->lastInsertId()){
				header("Location:index.php?page=login");
			} else {
				echo '<p class="error">Sorry, something went wrong. Contact the site admin</p>';
			}
		}
}
?>
<div class="d-flex flex-row">
<div class="w-50 pt-3 px-4 mt-4" style="height: 100vh;">
<h3 class="text-primary font-weight-bold">Register</h3>
	<p>Please use the form below to register at our site</p>	
	<form class="form-group" action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
<div class="form-row">
    <div class="col-md-6 mb-3">
		<label>First Name: </label>
		<input type="text" class="form-control" name="first_name" value="<?php if($_POST['first_name'])echo $_POST['first_name'] ?>" /><br />
	</div>
	<div class="col-md-6 mb-3">
		<label>Last Name: </label>
		<input type="text" class="form-control" name="last_name" value="<?php if($_POST['first_name'])echo $_POST['last_name'] ?>" /><br />
	</div>
</div>
<div class="form-row">
<div class="col-md-6">
		<label>Username: </label>
		<input type="text" class="form-control" name="username" value="<?php if($_POST['username'])echo $_POST['username'] ?>" /><br />
	</div>
    <div class="col-md-6 mb-3">
		<label>Email: </label>
		<input type="text" class="form-control" name="email" value="<?php if($_POST['email'])echo $_POST['email'] ?>" /><br />
	</div>
</div>
<div class="form-row">
    <div class="col-md-6">
		<label>Password: </label>
		<input type="password" class="form-control" name="password" value="<?php if($_POST['password'])echo $_POST['password'] ?>"/><br />
	</div>
    <div class="col-md-6">
		<label>Confirm Password: </label>
		<input type="password2" class="form-control" name="password2" value="<?php if($_POST['password2'])echo $_POST['password2'] ?>" /><br />
	</div>
</div>
                <input type="submit" class="btn btn-primary" value="Register" name="register_submit" />
             
          </form>
		  <?php
if(!empty($errors)){
	echo "<div class='alert alert-primary' role='alert'>";
 	foreach($errors as $error){
		echo "<p class=\"$error\">".$error."</p>";
	}
	echo "</div>";
}	
?>
</div>
<div class="w-50">
<img class="img-fluid" style='height: 110%; width: 100%; object-fit: content' src="register.jpg" />
</div>
</div>