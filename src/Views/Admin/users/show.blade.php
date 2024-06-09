<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sach User</title>
    <!-- Latest compiled and minified CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Latest compiled JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <h1>Chi tiet nguoi dung: {{$user['name']}}</h1>
    <table class="table table-striped">
    <thead>
      <tr>
        <th>Truong</th>
        <th>Gia tri</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($user as $field => $value)
      <tr>
        <td>{{$field}}</td>
        <td>{{$value}}</td>
        
      </tr>
      
      @endforeach
    </tbody>
  </table>
</body>
</html>