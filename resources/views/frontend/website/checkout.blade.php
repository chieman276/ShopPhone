@extends('frontend.layouts.master')
@section('content')

<div class="shopper-informations">
    <div class="row">
        <div class="col-sm-3">
        </div>
        <div class="col-sm-6">
            <div class="shopper-info">
               <h3><b>Điền Thông Tin Đầy Đủ</b></h3> 
                <form action="{{ route('checkouts')}}" method="post">
                    @csrf
                    <input type="text" name="name" placeholder="Nhập tên">
                    <input type="date" name="birthday" placeholder="Ngày sinh">
                    <input type="text" name="email" placeholder="Email">
                    <input type="text" name="phone" placeholder="Số điện thoại">
                    <input type="password" name="password" placeholder="Mật khẩu">
                    <div class="row ">
                        <div class="col-lg-6">
                            <a class="btn btn-primary"  href="{{route('cart')}}">Trở về</a>
                        </div>
                        <div class="col-lg-6" >                    
                            <button class="btn btn-primary" style="float:right" onclick="return confirm('Bạn có muốn mua sản phẩm này không ?')">Mua Sản phẩm</button>                           
                        </div>
                    </div>
                </form>    
            </div>
        </div>					
    </div>
</div>
<br>
@endsection