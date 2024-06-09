@extends('layouts.master')

@section('title')
    Danh sach User
@endsection
@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="white_card card_height_100 mb_30">
                <div class="white_card_header">
                    <div class="box_header m-0">
                        <div class="main-title">
                            <h1 class="m-0">Danh sách User</h1>
                        </div>
                    </div>
                </div>
                <div class="white_card_body">
                    <a class="btn btn-primary" href="{{ url('admin/users/create') }}">Them moi</a>

                    @if (isset($_SESSION['status']) && $_SESSION['status'])
                        <div class="alert alert-success">
                            {{ $_SESSION['msg'] }}
                        </div>
                        @php
                            unset($_SESSION['status']);
                            unset($_SESSION['msg']);
                        @endphp
                    @endif

                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>IMAGE</th>
                                    <th>NAME</th>
                                    <th>EMAIL</th>
                                    <th>CREATE AT</th>
                                    <th>UPDATE AT</th>
                                    <th>ACTION</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td><?= $user['id'] ?></td>
                                        <td>
                                            <img src="{{ asset($user['avatar']) }}" alt="" width="100px">
                                        </td>
                                        <td><?= $user['name'] ?></td>
                                        <td><?= $user['email'] ?></td>
                                        <td><?= $user['created_at'] ?></td>
                                        <td><?= $user['update_at'] ?></td>
                                        <td>
                                            <a class="btn btn-info"
                                                href="{{ url('admin/users/' . $user['id'] . '/show') }}">Xem</a>
                                            <a class="btn btn-warning"
                                                href="{{ url('admin/users/' . $user['id'] . '/edit') }}">Sua</a>
                                            <a class="btn btn-danger"
                                                href="{{ url('admin/users/' . $user['id'] . '/delete') }}"
                                                onclick="return confirm('ban co chac chan muon xoa khong?')">Xoa</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
