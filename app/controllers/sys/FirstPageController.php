<?php
namespace App\Controllers\Sys;
use App\Controllers\Controller;
use Codefii\View\View;
class FirstPageController extends Controller {
    public function welcome(){
        View::render('System/Admin/landing/ready',
        ['title'=>'Welcome to Codefii!']);

    }
}