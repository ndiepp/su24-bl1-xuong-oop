<?php
//web có các trang là
//trang chủ
//giới thiệu
//danh sách sản phẩm
//chi tiết sản phẩm
//liên hệ

//để định nghĩa được ,tạo controller trứoc
//khai bóa function tuong ứng
//bước cuối,định nghĩa đường dẫn

//HTTP method: get, post, put(path), delete, option, head

use Ngocdiep\XuongOop\Controllers\Client\AboutController;
use Ngocdiep\XuongOop\Controllers\Client\CartController;
use Ngocdiep\XuongOop\Controllers\Client\ContactController;
use Ngocdiep\XuongOop\Controllers\Client\HomeController;
use Ngocdiep\XuongOop\Controllers\Client\LoginController;
use Ngocdiep\XuongOop\Controllers\Client\OrderController;
use Ngocdiep\XuongOop\Controllers\Client\ProductController;




$router->get('/',                 HomeController::class . '@index');
$router->get('about',             AboutController::class . '@index');

$router->get('/contact',          ContactController::class . '@index');
$router->post('/contact/store',   ContactController::class . '@store');

$router->get('/products',         ProductController::class . '@index');
$router->get('/products/{id}',    ProductController::class . '@detail');

$router->get('/login',            LoginController::class . '@showFormLogin');
$router->post('/handle-login',    LoginController::class . '@login');
$router->get('/logout',           LoginController::class . '@logout');


$router->get('cart/add',         CartController::class . '@add');
$router->get('cart/quantityInc', CartController::class . '@quantityInc');
$router->get('cart/quantityDec', CartController::class . '@quantityDec');
$router->get('cart/remove',      CartController::class . '@remove');
$router->get('cart/detail',      CartController::class . '@detail');

$router->post('order/checkout',      OrderController::class . '@checkout');
