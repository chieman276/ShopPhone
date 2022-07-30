@extends('backend.layouts.master')

@section('content')

<div class="container">
    <h1 class="text-center mt-3">Thêm Khách hàng </h1>
    <form method="post" action="{{route('customers.store')}}">
        @csrf
        <div class="form-group">
            <label>Tên danh mục</label>
            <input type="text" name="name" class="form-control" placeholder="Nhập tên khách hàng">

            @if ($errors->any())
            <p style="color:red">{{ $errors->first('name') }}</p>
            @endif
        </div>
        <div class="form-group">
            <label>Ngày sinh</label>
            <input type="date" name="birthday" class="form-control" placeholder="Nhập ngày sinh">

            @if ($errors->any())
            <p style="color:red">{{ $errors->first('birthday') }}</p>
            @endif
        </div>
        <div class="form-group">
            <label>Số điện thoại</label>
            <input type="text" name="phone" class="form-control" placeholder="Nhập số điện thoại"

            @if ($errors->any())
            <p style="color:red">{{ $errors->first('phone') }}</p>
            @endif
        </div>
        <div class="form-group">
            <label>Email</label>
            <input type="text" name="email" class="form-control" placeholder="Nhập email">

            @if ($errors->any())
            <p style="color:red">{{ $errors->first('email') }}</p>
            @endif
        </div>
        <div class="form-group">
            <label>Mật khẩu</label>
            <input type="text" name="password" class="form-control" placeholder="Nhập mật khẩu">

            @if ($errors->any())
            <p style="color:red">{{ $errors->first('password') }}</p>
            @endif
        </div>
        <button class="btn btn-primary">Thêm</button>
        <button class="btn btn-secondary" onclick="window.history.go(-1); return false;">Hủy</button>
</div>
</form>
</div>

@endsection