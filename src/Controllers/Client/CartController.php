<?php

namespace Ngocdiep\XuongOop\Controllers\Client;

use Ngocdiep\XuongOop\Commons\Controller;
use Ngocdiep\XuongOop\Commons\Helper;
use Ngocdiep\XuongOop\Models\Cart;
use Ngocdiep\XuongOop\Models\CartDetail;
use Ngocdiep\XuongOop\Models\Product;

class CartController extends Controller
{
    private Product $product;
    private Cart $cart;
    private CartDetail $cartDetail;

    public function __construct()
    {
        $this->product    = new Product();
        $this->cart       = new Cart();
        $this->cartDetail = new CartDetail();
    }
    public function add()
    { //thêm vào giỏ hàng
        //lấy thông tin sản phẩm theo id
        $conn = $this->cart->getConnection();
        $product = $this->product->findByID($_GET['productID']);
        //khởi tạo session cart
        //check n đang đăng nhập hay không

        $key = 'cart';
        if (isset($_SESSION['user'])) {
            $key .=  '-' . $_SESSION['user']['id'];
        }
        if (!isset($_SESSION[$key][$product['id']])) {
            $_SESSION[$key][$product['id']] = $product + ['quantity' => $_GET['quantity'] ?? 1];
        } else {
            $_SESSION[$key][$product['id']]['quantity'] += $_GET['quantity'];
        }

        //nếu mà nó đăng nhập thì mình phải lưu n vào trong csdl
        if (isset($_SESSION['user'])) {
            // $conn->beginTransaction();
            try {
                $cart = $this->cart->findByUserID($_SESSION['user']['id']);
                if (empty($cart)) {
                    $this->cart->insert([
                        'user_id' => $_SESSION['user']['id']
                    ]);
                }
                $cartID = $cart['id'] ?? $conn->lastInsertId();

                $_SESSION['cart_id'] = $cartID;

                $this->cartDetail->deleteByCartID($cartID);
                foreach ($_SESSION[$key] as $productID => $item) {
                    $this->cartDetail->insert([
                        'cart_id' => $cartID,
                        'product_id' => $productID,
                        'quantity' => $item['quantity']
                    ]);
                }
                //$conn->commit();
            } catch (\Throwable $th) {
                //$conn->rollBack();
            }
        }
        header('location: ' . url('cart/detail'));
        exit();
    }
    public function detail()
    { //chi tiết giỏ hàng
        $this->renderViewClient('cart');
    }
    public function quantityInc()
    { //tăng số lượng
        $key = 'cart';
        if (isset($_SESSION['user'])) {
            $key .=  '-' . $_SESSION['user']['id'];
        }
        $_SESSION[$key][$_GET['productID']]['quantity'] += 1;

        if (isset($_SESSION['user'])) {
            $this->cartDetail->updateByCartIDAndProductID(
                $_GET['cartID'],
                $_GET['productID'],
                $_SESSION[$key][$_GET['productID']]['quantity']
            );
        }
        header('location: ' . url('cart/detail'));
        exit();
    }

    public function quantityDec()
    { //giảm số lượng
        $key = 'cart';
        if (isset($_SESSION['user'])) {
            $key .=  '-' . $_SESSION['user']['id'];
        }
        if ($_SESSION[$key][$_GET['productID']]['quantity'] > 1) {
            $_SESSION[$key][$_GET['productID']]['quantity'] -= 1;
        }

        if (isset($_SESSION['user'])) {
            $this->cartDetail->updateByCartIDAndProductID(
                $_GET['cartID'],
                $_GET['productID'],
                $_SESSION[$key][$_GET['productID']]['quantity']
            );
        }
        header('location: ' . url('cart/detail'));
        exit();
    }
    public function remove()
    { //xóa item or trắng
        $key = 'cart';
        if (isset($_SESSION['user'])) {
            $key .=  '-' . $_SESSION['user']['id'];
        }
        unset($_SESSION[$key][$_GET['productID']]);
        if (isset($_SESSION['user'])) {
            $this->cartDetail->deleteByCartIDAndProductID($_GET['cartID'], $_GET['productID']);
        }

        header('location: ' . url('cart/detail'));
        exit();
    }
}
