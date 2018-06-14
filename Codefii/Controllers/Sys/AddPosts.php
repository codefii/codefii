<?php
namespace Codefii\Controllers\Sys;
use Network\Controller\Controller;
use Network\View\View;
use Network\Mapper\Process\Office;
use Network\Mapper\ModelValidator\ModelValidator;
use Network\Request\Request;
class AddPosts extends Controller {
  public function index(){
      $office =new Office();
      $model = new ModelValidator();
      View::render("System/Admin/header/header",['AdminSession'=>$office->validator()]);
      View::render("System/Admin/office/addposts",['columns'=>$model->getColumns(),'posts'=>$office->getPost($this->route_params['post'])]);
      if(Request::exists()){
        $b = Request::getParam($_POST);
        foreach($b as $o){
          echo"<script>alert('$o')</script>";
        }
      }
  }
}
