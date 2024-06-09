<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <!-- Latest compiled and minified CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <div class="container">
        <div class="row">
            <h1 class="mt-5">Welcome {{ $name }} to my website</h1>
            <nav>
                @if (!isset($_SESSION['user']))
                <a class="btn btn-primary" href="{{ url('login') }}">Login</a>
                @endif
                @if (isset($_SESSION['user']))
                    <a class="btn btn-primary" href="{{ url('logout') }}">Logout</a>
                @endif
            </nav>
        </div>
    </div>
</body>

</html>
