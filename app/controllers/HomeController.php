<?php
namespace App\Controllers;
use App\Controllers\Controller;
use Codefii\Http\{
    Redirect,
    Request
};
use App\Controllers\Component\EmailComponent;
use Codefii\Mail\Mailer;
use App\Models\Books;
use App\Models\Admin;
use Codefii\Session\Session;
use Codefii\View\View;
use Codefii\Session\Token;

/** 
 * main controller 
 * 
*/
class HomeController extends Controller {
public $components = array("Email");

    public function index(){
        // echo $name;
        $admin = new Admin();
        $books = new Books();

        //1st method 
        // $bookId = $books->findBy(['id'=>2]);
        // $adminDetails = $admin->findBy(['username'=>$bookId->author]);
        $datas = $admin->select()
        ->belongsTo('books','username','author')
        ->leftJoin()
        ->withWhere(['admin_id'=>3])
        ->all();
        foreach($datas as $data){
            // echo $data->bookname;
        }
        // $allData = $books->findAll();
        //find by id 
        
        // echo $bookId->bookname;
        // $books->update(['id'=>1,'bookname'=>'php for complete beginners']);
        // $books->delete(['id'=>1]);

        // foreach($allData as $data){
        //     echo $data->bookname."<br>";
        // }
    //     $books->removeAll();
    //     $books->reset();
        // $books->create(['phd dddp','php tutorial','prince']);
       if(Request::exists()){
           $name = Request::get('name');
        //    $books->save([]);
        // $books->create([]);
        //    if(Token::check(Request::get('token'))){
               $books->createArray([$_POST]);
        //    }
       }
        // return View::render('pages.home',['title'=>'form','token'=>Token::generate()]);
        return View::render('pages.home',function(){
            return array('title'=>'hello world','name'=>'princes');
        });
        // $session = new Session();
        // $session->set('b','prince darlingotn');

    //     $component = new EmailComponent();
    //  echo $this->session->get('b');
        // $book->save($new);
    //    $component = new EmailComponent();
    //    $component->email ="prince";
    //    $component->age ="21";
    //    $component->email ="ekeminyd@gmail.com";
    //    var_dump($component);
    //   $this->Email->send_email("ekemini");
        // if(Request::is('post')){
        //     echo "HHRHHRR";
        // }
        
        // if(Request::is('post')){
        //     // echo "DSDSD";
        //     // echo Request::getInput('name');
        //     echo json_encode(Request::allField());
        // }
       
//  return $this->view(
//             'pages/home',['prince'=>'kelewke','title'=>'ekemini']);
        // return $this->view([
        //     'pages/home',
        //     "base1"
        // ],['prince'=>'kelewke','title'=>'ekemini']);
    }
    public function about(){
    
        // if(isset($_GET['id'])=='about'){
        //     Redirect::back();
        // }
        return $this->view('pages/about',['prince'=>'kelewke','title'=>'ekemini']);
    }
    public function store(){
        return Redirect::back();
    }
}