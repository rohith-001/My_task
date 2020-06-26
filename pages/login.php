<div style="margin:0 0 10px 10px;">
            <h3>Login Form</h3>
              <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
              <?php if(!$_SESSION['logged_in']) : ?>
                <?php foreach($login_msg as $msg) : ?>
                    <?php echo $msg.'<br />'; ?>
                <?php endforeach; ?>
                  <label>Username: </label><br/>
                  <input type="text" name="username" /><br/>
                  <label>Password: </label><br />
                  <input type="password" name="password" /><br/>
                  <br />
                  <input type="submit" value="Login" name="login_submit" />      
                <?php else: ?>
                  <input type="submit" value="Logout" name="logout_submit" />
                <?php endif; ?>
                </form>
</div>