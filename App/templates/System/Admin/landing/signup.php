<div class="container">
  <div class="primary-login">
    <form class="form-group" action="" method="post">
      <?php
      if(empty($signupError)){

      }else{
        echo $signuperror;
      }
        foreach ($error as $err){
          echo $err."<br />";
        }

      ?>
      <div class="form-group">
        <input type="text" class="cf-control" name="full_name" placeholder="Full Name">
      </div>
      <div class="form-group">
        <input type="text" class="cf-control" name="email" placeholder="E-mail">
      </div>
      <div class="form-group">
        <input type="password" class="cf-control" name="password" placeholder="Password">
      </div>
      <div class="form-group">
        <input type="password" class="cf-control" name="confirm_password" placeholder="Confirm Password">
      </div>
      <div class="form-group">
        <button type="submit" class="cfbtn cfbtn-primary"name="button">SIGN UP</button>
      </div>
    </form>
  </div>
</div>
