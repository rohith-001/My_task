<?php 
  session_start();

  include 'config.php'; 
  include 'Class/database.php'; 
    
//creat a database objcect
$database = new Database;

//set timezone
// date_default_timezone_get('America/New_York');
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
<!-- <link href="Css/bootstrap.css" rel="stylesheet"> -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
<link href="Css/custom.css" rel="stylesheet">
<!-- <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script> -->
</head>
<body>
    <?php 
        if($_GET['page'] == 'register' || $_GET['page'] == 'login'){
          }else{
            include 'pages/nav.php';
          }
    ?>
          <div class="span9">
          <?php
              if($_GET['page'] == 'register'){
                include 'pages/register.php';
              } elseif($_GET['page'] == 'list'){
                include 'pages/list.php';
              }elseif($_GET['page'] == 'home'){
                include 'pages/welcome.php';
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
              } elseif($_GET['page'] == 'welcome' || $_GET['page'] == ""){
                include 'pages/welcome.php';
              } 
          ?>
          </div><!--/span-->
		</div><!--/row-->

    </div><!--/.fluid-container-->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
</body>
</html>