<?php
namespace Ngocdiep\XuongOop\Controllers\Client;
use Ngocdiep\XuongOop\Commons\Controller;
use Ngocdiep\XuongOop\Commons\Helper;
use Ngocdiep\XuongOop\Models\User;

class HomeController extends Controller
{
    public  function index(){
        //echo __CLASS__ . '@' . __FUNCTION__;
        // $user = new User();
        // Helper::debug($user);

        $name ='DIỆP';
        $this->renderViewClient('home',[
            'name' =>$name
        ]);
        
    }
}