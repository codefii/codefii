<?php
namespace App\Controllers\Component;
use Codefii\Controller\Component;
class EmailComponent extends Component{
    public function send_email($to){
        echo $to;
    }
}