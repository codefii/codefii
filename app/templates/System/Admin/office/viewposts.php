<div class="main form-group">
      <div class="container">
            <div class="viewer">
                  <div class="row justify-content-center">
                        <div class="col-md-12 col-lg-12">
                              <h2>All Posts</h2>
                              <br />
                              <table style="width:100%;">
                              <tr>
                              <?php
                              if(empty($posts)){
                              echo"<h1>Table is empty please Add some data</h1>";
                              }else{
                                    foreach(array_keys((array)$posts[0]) as $value){
                                          echo"<th>$value</th>";
                                    }


                               ?>
                               <th>
                                     Delete
                               </th>
                              </tr>
                              <tr><?php
                                          foreach($posts as $val){
                                                echo "<tr>";
                                                foreach(array_keys((array)$posts[0]) as $d){
                                                      echo
                                                      "<td>".$val->$d."</td>";
                                                      // echo "";

                                                }

                                                    echo"<td> <a href='{$table}/$val->id'>Delete</a></td>";

                                                echo "</tr>";
                                          }
                                    }
                                     ?>


                              </tr>
                              </table>
                        </div>
                  </div>
            </div>
      </div>
</div>
