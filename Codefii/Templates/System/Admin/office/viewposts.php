<div class="main form-group">
<div class="container">

        <h2>Posts</h2>
      </div>



      <?php
      // foreach($posts as $post){
                  $keys = array_keys((array)$posts[0]);
                  $values = array_values($posts);
                  foreach($posts as $value){
                        foreach($keys as $key){
                              echo "<table><tr>
                              <th>".$key."</th></tr>"."<tr>
                                    <td>
                                    ".$value->$key."
                                    </td>
                                    </tr></table>";
                        }
                  }
      ?>


</div>
</div>
