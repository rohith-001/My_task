<div class="d-flex flex-row">
<div class="w-50 p-5 d-flex" style='height: 100vh;'>
<div style="margin: 150px auto;">
<?php 
if(!$_SESSION['logged_in']){
  echo '<h3 class="text-primary font-weight-bold">Login</h3>';
}else{
  echo '<h3 class="text-primary font-weight-bold">Come Back Soon</h3> </br> <P>Are You Sure? You Want To Log Out?</p>';
} ?>
              <form class="form-group" action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
              <?php if(!$_SESSION['logged_in']) : ?>
                <?php foreach($login_msg as $msg) : ?>
                    <?php echo $msg.'<br />'; ?>
                <?php endforeach; ?>
                  <label class="mt-3">Username: </label><br/>
                  <input class="form-control" type="text" name="username" /><br/>
                  <label>Password: </label><br />
                  <input class="form-control" type="password" name="password" /><br/>
                  <br />
                  <input class="btn btn-primary" type="submit" value="Login" name="login_submit" />      
                <?php else: ?>
                  <input type="submit" class="btn btn-primary" value="Log out" name="logout_submit" />
                <?php endif; ?>
                </form>
</div>
</div>
<div class="w-50">
<img class="img-fluid" style='height: 100%; width: 100%; object-fit: content' src="register.jpg" />
</div>
</div>