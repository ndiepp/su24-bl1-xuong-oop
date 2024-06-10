<?php
namespace Ngocdiep\XuongOop\Controllers\Client;
use Ngocdiep\XuongOop\Commons\Controller;
use Ngocdiep\XuongOop\Commons\Helper;
use Ngocdiep\XuongOop\Models\Product;


class HomeController extends Controller
{
    private Product $product;
    
    public function __construct()
    {
        $this->product = new Product();
    }
    public  function index(){
        $name ='DIỆP';
        $products = $this->product->all();
        $this->renderViewClient('home',[
            'name' =>$name,
            'products' =>$products
        ]);
        
    }
}