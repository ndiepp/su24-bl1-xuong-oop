<?php
namespace Ngocdiep\XuongOop\Commons;
use eftec\bladeone\BladeOne;

class Controller
{
    protected function renderViewClient($view,$data = []){
        $templadePath = __DIR__ . '/../Views/Client';
        $compiledPath = __DIR__ . '/../Views/Compiles';
        $blade = new BladeOne($templadePath,$compiledPath);

        echo $blade->run($view,$data);
    }
    protected function renderViewAdmin($view,$data = []){
        $templadePath = __DIR__ . '/../Views/Admin';
        $compiledPath = __DIR__ . '/../Views/Compiles';
        $blade = new BladeOne($templadePath,$compiledPath);

        echo $blade->run($view,$data);
    }
}