<?php
namespace Ngocdiep\XuongOop\Commons;


class Model
{
    protected $conn;
    public function __construct(){
        //Thực hiện kết nối khi khởi tạo bất kì class nào liên quan đến model
    }
    public function __destruct(){
        $this->conn=null;
    }
}