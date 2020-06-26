<?php 
  session_start();

  include 'config.php'; 
  include 'Class/database.php'; 
    
//creat a database objcect
$database = new Database;

//set timezone
date_default_timezone_get('America/New_York');
?>

<?php
//LOG IN
if ($_POST['login_submit']){
    //assign the form field value to the variable
    $username = $_POST['username'];
    $password = $_POST['password'];
    $enc_password = md5($password);

    //cheacking process
    $database->query("SELECT username FROM users WHERE username=:username AND password=:password");
    $database->bind(":username",$username);
    $database->bind(":password",$enc_password);
    $rows = $database->resultset();
    $count = count($rows);

    if ($count >0){
        session_start();
    //assign session variables
        $_SESSION['username'] = $username;
        $_SESSION['password'] = $password;
        $_SESSION['logged_in'] = 1;
        
        header("Location:index.php?page=welcome");
    }
    else{
        $login_msg[] = "Sorry,that login does not work";
    }
}

//LOG OUT
if ($_POST['logout_submit']){
    if(isset($_SESSION['username'])){
        unset($_SESSION['username']);
    }
    if(isset($_SESSION['password'])){
        unset($_SESSION['password']);
    }
    if(isset($_SESSION['logged_in'])){
        unset($_SESSION['logged_in']);
    }
    session_destroy();
}
?>
<!DOCTYPE html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<a href="index.php"><title>myTasks Application</title></a>
<link href="Css/bootstrap.css" rel="stylesheet">
<link href="Css/custom.css" rel="stylesheet">
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
</head>
<body>

    <div class="navbar navbar-inverse navbar-fixed-top">
        <div class="navbar-inner">
          <div class="container-fluid">
            <a class="brand" href="#">MY TASK</a>
            <div class="nav-collapse collapse">
              <p class="navbar-text pull-right">
              <?php if($_SESSION['logged_in']){
                  echo "Hello, ".$_SESSION['username'];
                }
              ?>
              </p>
              <ul class="nav float-left">
                <li><a href="index.php?page=welcome">Home</a></li>  
                    <li><a href="index.php?page=new_list">Add List</a></li>
                    <li><a href="index.php?page=new_task">Add Task</a></li>
              </ul>
              <ul class="nav navbar-nav" style="float:right;">
                <li><a href="index.php?page=login"><?php if($_SESSION['username']){echo "Log out";} else{echo "Login";}?></a></li>
                <li><a href="http://localhost/php/hello/">Register</a></li>
             </ul>
            </div><!--/.nav-collapse -->
          </div>
        </div>
      </div>
      
 
          <div class="span9">
          <?php
              if($_GET['msg'] == 'listdeleted'){
                echo '<p class="msg">Your list has been deleted</p>';
              }
              if($_GET['page'] == 'register' || $_GET['page'] == ""){
                include 'pages/register.php';
              } elseif($_GET['page'] == 'list'){
                include 'pages/list.php';
              } elseif($_GET['page'] == 'task'){
                include 'pages/task.php';
              } elseif($_GET['page'] == 'new_task'){
                include 'pages/new_task.php';
              } elseif($_GET['page'] == 'new_list'){
                include 'pages/new_list.php';
              } elseif($_GET['page'] == 'edit_task'){
                include 'pages/edit_task.php';
              } elseif($_GET['page'] == 'edit_list'){
                include 'pages/edit_list.php';
              } elseif($_GET['page'] == 'login'){
                include 'pages/login.php';
              } elseif($_GET['page'] == 'delete_list'){
                include 'pages/delete_list.php';
              } elseif($_GET['page'] == 'welcome'){
                include 'pages/welcome.php';
              } 
          ?>
          </div><!--/span-->
		</div><!--/row-->
      <hr>

      <footer>

      </footer>
    </div><!--/.fluid-container-->
  
</body>
</html>