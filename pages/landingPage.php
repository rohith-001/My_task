<div class="d-flex flex-row w-100" style="height: 91.6vh; background:linear-gradient(90deg, #0f0c29 0%,#302b63 50%,#24243e 100% );">
<div class="mt-5 pt-4">
<img class="ml-5 mt-5 pt-5" width="60%" src="MyTask.svg" alt="landing"/>
<h2 class="ml-5 mt-3 text-light">Welcome To Our Website</h2>
      <p class="ml-5 text-light">MyTasks is a small but helpful application where you can create and manage tasks to make your life easier. 
Just register and login and you can start adding tasks.</p>
<?php
if($_SESSION['username']){
      echo '<a class="ml-5 text-dark btn btn-warning" style="" href="index.php?page=home">Get Start</a>';
} else{
      echo '<a class="ml-5 text-dark btn btn-warning" style="" href="index.php?page=register">Get Start</a>';
}
?>
</div>
<div class="d-flex">
      <img class="m-auto" width="60%" src="landing.png" alt="landing"/>
</div>
</div>