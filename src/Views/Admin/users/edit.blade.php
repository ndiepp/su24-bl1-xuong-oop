<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cap nhat nguoi dung: {{$user['name']}}</title>
    <!-- Latest compiled and minified CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Latest compiled JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <h1>Cap nhat nguoi dung: {{$user['name']}}</h1>
    @if (!empty($_SESSION['errors']))
        <div class="alert alert-warning">
            <ul>
                @foreach ($_SESSION['errors'] as $error)
                    <li>{{$error}}</li>
                @endforeach 
            </ul>
            @php
                unset($_SESSION['errors']);
            @endphp
        </div>
    @endif
    <form action="{{ url("admin/users/{$user['id']}/update") }}" enctype="multipart/form-data" method="POST">
        <div class="mb-3 mt-3">
            <label for="name" class="form-label">Name:</label>
            <input type="text" class="form-control" id="name" placeholder="Enter name" value="{{$user['name']}}" name="name">
        </div>
        <div class="mb-3 mt-3">
            <label for="email" class="form-label">Email:</label>
            <input type="email" class="form-control" id="email" placeholder="Enter email" value="{{$user['email']}}"  name="email">
        </div>
        <div class="mb-3 mt-3">
            <label for="avatar" class="form-label">Avatar:</label>
            <input type="file" class="form-control" id="avatar" placeholder="Enter avatar" name="avatar">
            <img src="{{asset($user['avatar'])}}" alt="" width="100px">
        </div>
        <div class="mb-3 mt-3">
            <label for="password" class="form-label">Password:</label>
            <input type="text" class="form-control" id="password" placeholder="Enter password" name="password">
        </div>
        
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</body>
</html>