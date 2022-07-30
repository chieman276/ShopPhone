@extends('backend.layouts.master')

@section('content')

<div class="container">
    <h1 class="text-center mt-3">Thêm Khách hàng </h1>
    <form method="post" action="{{route('customers.update',$customer->id)}}">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label>Tên danh mục</label>
            <input type="text" name="name" class="form-control" value="{{ $customer->name }}" placeholder="Nhập tên khách hàng">

            @if ($errors->any())
            <p style="color:red">{{ $errors->first('name') }}</p>
            @endif
        </div>
        <div class="form-group">
            <label>Ngày sinh</label>
            <input type="date" name="birthday" class="form-control" value="{{ $customer->birthday }}" placeholder="Nhập ngày sinh">

            @if ($errors->any())
            <p style="color:red">{{ $errors->first('birthday') }}</p>
            @endif
        </div>
        <div class="form-group">
            <label>Số điện thoại</label>
            <input type="text" name="phone" class="form-control" value="{{ $customer->phone }}" placeholder="Nhập số điện thoại"

            @if ($errors->any())
            <p style="color:red">{{ $errors->first('phone') }}</p>
            @endif
        </div>
        <div class="form-group">
            <label>Email</label>
            <input type="text" name="email" class="form-control" value="{{ $customer->email }}" placeholder="Nhập email">

            @if ($errors->any())
            <p style="color:red">{{ $errors->first('email') }}</p>
            @endif
        </div>
        <div class="form-group">
            <label>Mật khẩu</label>
            <input type="text" name="password" class="form-control" value="{{ $customer->password }}" placeholder="Nhập mật khẩu">

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