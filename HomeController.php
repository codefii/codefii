<?php
namespace App\Controllers;
use App\Controllers\Controller;
use Codefii\View\View;
use Codefii\Http\Request;
use Codefii\Http\Redirect;
use App\Models\Books;
use Codefii\Session\Token;
class HomeController extends Controller{
	public function index(){
		$token = Token::generate();
		// if(Request::isPost()){
			// if(Token::check(Request::get('token'))){
			// 	echo "dddddd";
			// }
		// }
		// $config = include($_SERVER['DOCUMENT_ROOT']."/config/session.php");
	
		
			// echo $name;
		// var_dump($this->route_params['post']);
		// if(Request::isPost()){
			// $books = new Books();
			// $books->createArray([Request::getPostData()]);
			// if($books->isSaved()){
				// var_dump(Redirect::with('ekemini')->get());					
			// }
			// var_dump($name);
		// echo $this->route_params['post'];
		// }
		// $this->session->set('key','prdddddd');

	
		// return $this->view('pages/home',['title'=>'prrince','k'=>'piipii']);
	return $this->view('pages/home',['title'=>'Home','token'=>$token]);
		
	}

	public function about(){
		// if(Request::isPost()){
			// $books = new Books();
			// $books->createArray([Request::getPostData()]);
			// if($books->isSaved()){
				// var_dump(Redirect::with('ekemini')->get());					
			// }
			
		// }
		
			
		return $this->view('pages/about',['prince'=>'kelewke','title'=>'ekemini']);

	}
}
