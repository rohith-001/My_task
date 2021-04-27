<nav class="navbar navbar-expand-lg" style="background:linear-gradient(90deg, #0f0c29 0%,#302b63 50%,#24243e 100% );">
    <a class="brand px-2" href="#">
        <img src="MyTask.svg" width="100" height="40" class="d-inline-block align-top" alt="">
    </a>
    
  <div class="collapse navbar-collapse" id="navbarText">
    <ul class="navbar-nav ml-auto">
        <li class="nav-item mx-2" class="nav-item active"><a class="nav-link text-light" href="index.php?page=home">Home</a></li>  
            <li class="nav-item mx-2"><a class="nav-link text-light" href="index.php?page=new_list">Add List</a></li>
            <li class="nav-item mx-2"><a class="nav-link text-light" href="index.php?page=new_task">Add Task</a></li>
        <li class="nav-item mx-2">
          <a class="nav-link text-light btn btn-primary text-light" href="index.php?page=login">
            <?php 
              if($_SESSION['username']){
                echo "Log out";
                } else{echo "Log in";}
              ?>
          </a>
        </li>
        <?php 
              if($_SESSION['username']){} else{
                  echo '<li class="nav-item mx-2 mx-2"><a class="nav-link text-light rounded border border-primary" href="index.php?page=register">Register</a></li>';}
              ?>
     </ul>
          <?php if($_SESSION['logged_in']){
            echo '<span class="navbar-text mx-2 px-2 rounded border border-warning text-warning">';
              echo "Hello, ".$_SESSION['username'];
              echo '</span>';
            }
          ?>
  </div>
</nav>
 