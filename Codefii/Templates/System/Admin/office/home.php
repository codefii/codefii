<div class="main form-group">
<div class="container">
    <div class="fiia-sidebar">
      <div class="fiia-menu">
        <h2>Menus</h2>
      </div>

      <?php foreach($data as $infor=>$key){
      echo "<div class='lists'>{$key}
      <a href='admin/posts/{$key}'>(View)</a>
      <a href='admin/addposts/{$infor}'>(add)</a>
      </div><span class='space'></span>";
      }?>


    </div>
  <h2></h2>
</div>
</div>
