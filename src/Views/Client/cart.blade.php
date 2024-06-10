<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home</title>

    <!-- Latest compiled and minified CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</head>

<body>
    <div class="container">
        <div class="row">
            <h1 class="mt-5">Welcome {{ $name }} to my website!</h1>

            <nav>
                @if (!isset($_SESSION['user']))
                    <a class="btn btn-primary" href="{{ url('login') }}">Login</a>
                @endif

                @if (isset($_SESSION['user']))
                    <a class="btn btn-primary" href="{{ url('logout') }}">Logout</a>
                @endif
            </nav>

        </div>

        <div class="row">
            @if (!empty($_SESSION['cart']) || !empty($_SESSION['cart-' . $_SESSION['user']['id']]))
                <div class="col-md-8 mb-2 mt-2">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Tên sản phẩm</th>
                                <th>Ảnh</th>
                                <th>Số lượng</th>
                                <th>Giá tiền</th>
                                <th>Thành tiền</th>
                                <th>Xóa</th>
                            </tr>
                        </thead>
                        <tbody>

                            @php
                                $cart = $_SESSION['cart'] ?? $_SESSION['cart-' . $_SESSION['user']['id']];
                            @endphp
                            @foreach ($cart as $item)
                                <tr>
                                    <td>{{ $item['name'] }}</td>
                                    <td>
                                        <img src="{{ asset($item['img_thumbnail']) }}" width="100px" alt="">
                                    </td>
                                    <td>
                                        @php
                                            $url = url('cart/quantityDec') . '?productID=' . $item['id'];

                                            if (isset($_SESSION['user'])) {
                                                $url .= '&cartID=' . $_SESSION['cart_id'];
                                            }
                                        @endphp
                                        <a class="btn btn-danger" href="{{ $url }}">Giảm</a>
                                        {{ $item['quantity'] }}
                                        @php
                                            $url = url('cart/quantityInc') . '?productID=' . $item['id'];

                                            if (isset($_SESSION['user'])) {
                                                $url .= '&cartID=' . $_SESSION['cart_id'];
                                            }
                                        @endphp
                                        <a class="btn btn-primary" href="{{ $url }}">Tăng</a>
                                    </td>
                                    <td>
                                        {{ $item['price_sale'] ?: $item['price_regular'] }}
                                    </td>
                                    <td>
                                        {{ $item['quantity'] * ($item['price_sale'] ?: $item['price_regular']) }}
                                    </td>
                                    <td>
                                        @php
                                            $url = url('cart/remove') . '?productID=' . $item['id'];

                                            if (isset($_SESSION['user'])) {
                                                $url .= '&cartID=' . $_SESSION['cart_id'];
                                            }
                                        @endphp
                                        <a onclick="return confirm('Có chắn không?')"
                                            href="{{ $url }}">Xóa</a>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>


                <div class="col-md-4 mb-2 mt-2">
                    <form action="{{ url('order/checkout')}}" method="POST">
                        <div class="mb-3 mt-3">
                            <label for="name" class="form-label">Name:</label>
                            <input type="text" class="form-control" id="name" value="{{ $_SESSION['user']['name'] ?? null}}" placeholder="Enter name"
                                name="user_name">
                        </div>
                        <div class="mb-3 mt-3">
                            <label for="email" class="form-label">Email:</label>
                            <input type="email" class="form-control" id="email" value="{{ $_SESSION['user']['email'] ?? null}}" placeholder="Enter email"
                                name="user_email">
                        </div>
                        <div class="mb-3 mt-3">
                            <label for="phone" class="form-label">Phone:</label>
                            <input type="text" class="form-control" id="phone" value="{{ $_SESSION['user']['phone'] ?? null}}" placeholder="Enter phone"
                                name="user_phone">
                        </div>
                        <div class="mb-3 mt-3">
                            <label for="address" class="form-label">Address:</label>
                            <input type="text" class="form-control" id="address" value="{{ $_SESSION['user']['address'] ?? null}}" placeholder="Enter address"
                                name="user_address">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            @endif
        </div>
    </div>
</body>

</html>
