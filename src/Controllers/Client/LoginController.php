<?php
namespace Ngocdiep\XuongOop\Controllers\Client;
use Ngocdiep\XuongOop\Commons\Controller;
use Ngocdiep\XuongOop\Commons\Helper;
use Ngocdiep\XuongOop\Models\User;

class LoginController extends Controller
{
    private User $user;
    public function __construct(){
        $this->user = new User();
    }
    public  function showFormLogin(){

        auth_check();
       
        $this->renderViewClient('login');  
    }
    public  function login(){

        
        auth_check();


        try {
            $user= $this->user->findByEmail($_POST['email']);

            if(empty($user)){
                throw new \Exception('không tồn tại email: '.$_POST['email']);
            }

            $flag = password_verify($_POST['password'],$user['password'] );
            if($flag){

                $_SESSION['user'] = $user;
                header('location: ' .url('admin/') );
                exit;
            }
            throw new \Exception('Password không đúng');
        } catch (\Throwable $th) {
            $_SESSION['error'] = $th->getMessage();
            header('location: ' .url('login') );
                exit;
        }
    }
    public function logout(){
        unset($_SESSION['user']);

        header('location: ' .url() );
        exit;
    }
}