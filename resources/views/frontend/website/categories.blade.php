@extends('frontend.layouts.master')

@section('content')

<div class="col-sm-12 padding-right">
    <div class="features_items"><!--features_items-->
        <h1 class="title text-center">Danh Sách Sản Phẩm</h1>
        @foreach ($products as $product)
        <div class="col-sm-4">
            <div class="product-image-wrapper">
                <div class="single-products">
                        <div class="productinfo text-center">
                            <img src="{{asset($product->image)}}" width="350px"height="450px" alt="" />
                            <h2 style="color: red">{{ number_format( $product->price) }} đ</h2>
                            <p>{{ $product->name}}</p>
                            <a href="{{ route('add.to.cart', $product->id) }}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm vào giỏ hàng</a>
                        </div>
                </div>
            </div>
        </div>   
        @endforeach     
    </div><!--features_items-->
    
</div>

@endsection