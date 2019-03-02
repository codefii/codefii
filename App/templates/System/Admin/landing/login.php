<div class="container">
  <div class="primary-login">
    <?php foreach($value as $validator){
      echo $validator."<br/>";
    }?>
    <form class="form-group" action="" method="post">
      <div class="form-group">
        <input type="text" class="cf-control" name="username" placeholder="Username">
      </div>
      <div class="form-group">
        <input type="password" class="cf-control" name="password" placeholder="Password">
      </div>
      <div class="form-group">
        <button type="submit" class="cfbtn cfbtn-primary"name="button">LOGIN</button>
      </div>
    </form>
  </div>
</div>
