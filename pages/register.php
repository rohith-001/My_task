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

<h3>Register</h3>
<p>Please use the form below to register at our site</p>
<?php
if(!empty($errors)){
	echo "<ul>";
 	foreach($errors as $error){
		echo "<li class=\"error\">".$error."</li>";
	}
	echo "</ul>";
}
?>
 <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
 				<label>First Name: </label>
                <input type="text" name="first_name" value="<?php if($_POST['first_name'])echo $_POST['first_name'] ?>" /><br />
                <label>Last Name: </label>
                <input type="text" name="last_name" value="<?php if($_POST['first_name'])echo $_POST['last_name'] ?>" /><br />
 
                <label>Email: </label>
                <input type="text" name="email" value="<?php if($_POST['email'])echo $_POST['email'] ?>" /><br />
                <label>Username: </label>
                <input type="text" name="username" value="<?php if($_POST['username'])echo $_POST['username'] ?>" /><br />
                <label>Password: </label>
                <input type="password" name="password" value="<?php if($_POST['password'])echo $_POST['password'] ?>"/><br />
                 <label>Confirm Password: </label>
                <input type="password2" name="password2" value="<?php if($_POST['password2'])echo $_POST['password2'] ?>" /><br />
                <br />
                <input type="submit" value="Register" name="register_submit" />
             
          </form>