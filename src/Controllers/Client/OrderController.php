<?php

namespace Ngocdiep\XuongOop\Controllers\Client;

use Ngocdiep\XuongOop\Commons\Controller;
use Ngocdiep\XuongOop\Models\Cart;
use Ngocdiep\XuongOop\Models\CartDetail;
use Ngocdiep\XuongOop\Models\Order;
use Ngocdiep\XuongOop\Models\OrderDetail;
use Ngocdiep\XuongOop\Models\User;

class OrderController extends Controller
{    

    public User $user;
    public Order $order;
    public OrderDetail $orderDetail;
    private Cart $cart;
    private CartDetail $cartDetail;
    public function __construct()
    {
        $this->user        = new User();
        $this->order       = new Order();
        $this->orderDetail = new OrderDetail();
        $this->cart        = new Cart();
        $this->cartDetail  = new CartDetail();
    }
    public function checkout(){
        //chưa đăng nhập thì phải tạo tài khoản
        $userID = $_SESSION['user']['id'] ?? null;
        if (! $userID) {
            $conn = $this->user->getConnection();
            $this->user ->insert([
                'name' => $_POST['user_name'],
                'user_email' => $_POST['user_email'],
                'password' => password_hash($_POST['user_email'],PASSWORD_DEFAULT),
                'type' => 'member',
                'is_active' => 0,
            ]);
            $userID =$conn->lastInsertId();
          
        }
        //thêm dữ liệu vào order và orderdetail

        $conn = $this->order->getConnection();
        $this->order ->insert([
            'user_id' => $userID,
            'user_name' => $_POST['user_name'],
            'user_email' => $_POST['user_email'],
            'user_phone' => $_POST['user_phone'],
            'user_address' => $_POST['user_address'],
        ]);
 
        $orderID = $conn->lastInsertId();

        $key = 'cart';
        if (isset($_SESSION['user'])) {
            $key .=  '-' . $_SESSION['user']['id'];
        }
        foreach ($_SESSION[$key] as $productID => $item) {
            $this->orderDetail->insert([
                'order_id' => $orderID,
                'product_id' => $productID,
                'quantity' => $item['quantity'],
                'price_regular' => $item['price_regular'],
                'price_sale' => $item['price_sale'],
            ]);
        }


        //xóa dữ liệu trong cart+cartDetail theo cartID - 

        //xóa dữ liệu trong session

        unset($_SESSION[$key]);
        if(isset($_SESSION['user'])){
            unset($_SESSION['cart_id']);
        }

        header('location: ' . url());
        exit();
    }
}
