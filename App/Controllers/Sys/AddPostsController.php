<?php
namespace App\Controllers\Sys;
use App\Controllers\Controller;
use Codefii\View\View;
use Codefii\Mapper\Process\Office;
use Codefii\Mapper\ModelValidator\ModelValidator;
use Codefii\Http\Request;
use Codefii\Location\Redirect;
use Codefii\Middleware\SessionChecker;

class AddPostsController extends Controller {
  public function index(){
    /**
     * [$fii_Office  description]
     * @var Office
     * gets the instance of Office class
     */
      $fii_Office =new Office();
      /**
       * [$fii_validator description]
       * @var ModelValidator
       * this validates every model created by users
       */
      $fii_validator = new ModelValidator();
      /**
       * [$fii_validator->getModel description]
       * @var [type]
       * Upon every route_params that matches a model in the App
       * it automatically stores it
       */
      $fii_validator->getModel($this->route_params['addpost']);
      /**
       * [View description]
       * @var [type]
       */
      Office::AuthorisedUser();
      View::render("System/Admin/header/header",['value'=>Office::getSessionName()]);
      View::render("System/Admin/office/addposts",
      ['columns'=>$fii_validator->returnModel(),'cols'=>$fii_validator->getColumns()]);
      /******************************************************
       * *********************       ************************
       *
       *
       * @var [type]
       */


      if(Request::exists()){
        $controller = $this->getNamespace().$this->route_params['addpost'];
        $controller_object = new $controller($this->route_params['addpost']);
        $controller_object->createArray([$_POST]);
      }
  }
  /**
   * [getNamespace description]
   * @return [type] [description]
   */
  protected function getNamespace()
  {
    $namespace = 'Codefii\Models\\';
    return $namespace;
  }
}
