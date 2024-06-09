<?php
//crud bao gồm: danh sách,thêm ,sửa,xem ,xóa
//User :

//GET   ->   USER/INDEX   ->INDEX       ->danh sách
//GET   ->   USER/CREATE  ->CREATE      ->hiển thị form thêm mới
//POST  ->   USER/STORE   ->STORE       ->lưu dữ liệu từ form thêm mói vào db
//GET   ->   USER/ID      ->SHOW ($id)       -> xem chi tiết
//GET   ->   USER/ID/EDIT ->EDIT ($id)       -> hiển thị form cập nhâpj
//POST  ->   USER/ID      ->UPDATE ($id)     -> lưu dữ liệu từ form CẬP NHẬP vào db
//GET   ->   USER/ID      ->DELETE ($id)     ->XÓA bản ghi trong db

use Ngocdiep\XuongOop\Controllers\Admin\UserController;
use Ngocdiep\XuongOop\Controllers\Admin\DashboardController;

$router->before('GET|POST', '/admin/*.*', function() {
    if (!isset($_SESSION['user'])) {
        header('location: ' . url('login'));
        exit();
    }
});

$router->mount('/admin',function () use($router){
    $router->get('/',              DashboardController::class . '@dashboard');
    //CRUD USER
    $router->mount('/users',function () use($router){
        $router->get('/',              UserController::class . '@index');
        $router->get('/create',        UserController::class . '@create');
        $router->post('/store',        UserController::class . '@store');
        $router->get('/{id}/show',     UserController::class . '@show');
        $router->get('/{id}/edit',     UserController::class . '@edit');
        $router->post('/{id}/update',         UserController::class . '@update');
        $router->get('/{id}/delete',   UserController::class . '@delete');
        });
}); 
