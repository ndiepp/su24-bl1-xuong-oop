<?php
namespace Ngocdiep\XuongOop\Controllers\Admin;

use Ngocdiep\XuongOop\Commons\Controller;


class DashboardController extends Controller
{
    public function dashboard(){
        $this->renderViewAdmin(__FUNCTION__);
    }
}
