<?php

namespace App\Controllers;
use Core\View\View;

use Codefii\Controllers\Controller;
use Codefii\Models\Users;
use Core\Entity\Auth;
use Core\Hash\Hash;
use Codefii\Checker\SessionChecker;
class HomeController extends Controller
{

    public function show()
    {

        // return $this->view('article/index', [
        //     'h' =>$this->route_params['post']]);
        //
        // View::render('article/index');
        // var_dump("kdkdk");

        // Response::redirect('home',301);
        // $user = new Users();

        // $result = $user->findById(1);

        // // var_dump($result);
        // $data =[
        //     'username'=>'king',
        //     'email'=>'righ@gmail.com',
        //     'salt'=>'dddkdkd',
        //     'password'=>'totos'
        // ];
        // // $user->username ='condom';
        //
        // $user->create($data);
        // $user->delete(['id'=>3]);
        // $user->username ='dick';
        // $user->email = 'py@mail.com';
        // $user->salt ='sksksksks';
        // $user->password ='dkdkdk';
        // $d = $user->query("SELECT * FROM users WHERE id= 2");
        // foreach($d as $k){
        //     echo $k->username;
        // }
        // $id = $user->find()->orderBy("id","DESC")->limit(6)->all();
        // foreach($id as $k){
        //     echo $k->username.'<br />';
        // }
        // $id = $user->relatedTo(
        //     ['username'=>'author'],'books',"LEFT JOIN"
        //     )
        //     // ->limit(3)
        //     ->all();
        // foreach($id as $k){
        //     if($k->,)
        // }
        // $d = $user->find()->withWhere(['email'=>'ekeminyd@gmail.com'])->all();
        // $id= $user->findBy(['email'=>'ekeminyd@gmail.com']);
        // var_dump($id);

        // echo $this->export->clean($id->username);
        // View::render('article/index',['data'=>$id->username]);

        // $data =['ojo','chide@gmail.com','kkdkdkd','ekemini'];
        // $user->create(['pddkdkorn','chide@gmail.com','kkdkdkd','ekemini']);
        // $n = new \Core\Hash\Hash();
        // $user->loginUsing(['email'=>'ekeminyd@gmail.com','password'=>'b@ttl3k0d3']);
        // if($user->isLoggedIn==TRUE){
        //     echo "keke";
        // }
        //
        // echo $this->route_params['id'];
        // echo $this->params['id'];
        //
        // $salt = Hash::salt(32);
        // $user->save(['username'=>'prince','email'=>'prince@gmail.com','salt'=>$salt,'password'=>Hash::make('prince',$salt)]);
        // return $this->view('Page/home');
        echo "cOdefii";

        echo $this->route_params['user'];
    }
}
