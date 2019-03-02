<div class="main form-group">
<div class="container">

<div class="add-post-control">
<div class="row justify-content-center">

  <div class="col-md-8">
    <h2>Add Posts</h2>
    <br />
    <?php

        echo "<form method='post'>";
        foreach($cols as $key){
              echo"
              <input type='{$key}' name='{$key}' placeholder='{$key}' class='form-control'/><br />";
              }
        echo "<input type='submit' class='btn btn-primary'/></form>";

        ?>
  </div>
</div>

</div>


</div>
</div>
