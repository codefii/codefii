<?php
namespace App\Controllers\Sys;
use App\Controllers\Controller;
use Codefii\View\View;
use Codefii\Mapper\Process\Office;
use Codefii\Mapper\ModelValidator\ModelValidator;
use Codefii\Http\Response;
class PostsController extends Controller {
  protected $table;
  public function index(){
      $office =new Office();
      $model = new ModelValidator();
      View::render("System/Admin/header/header",['fiidata'=>Office::Strict()]);
      View::render("System/Admin/office/viewposts",
      ['posts'=>$office->getPost($this->route_params='books'),'table'=>$this->route_params='books']);
      }

  public function deleteAction(){
    $model = new ModelValidator();
    $model->setModelTable($this->route_params['post'],$this->route_params['id']);
        Response::redirect('/admin/posts/'.$this->route_params['post']);
  }
}
