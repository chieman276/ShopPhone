@extends('frontend.layouts.master')

@section('content')

<div class="container" id="exampleModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-7">
                        <div>
                            <img src="{{asset($showProduct->image)}}" height="350px" width="350px" alt="#">
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <div class="quickview-content">
                            <h2>{{$showProduct->name}}</h2>
                            <h3 style="color: red;">{{number_format($showProduct->price)}} đ</h3>
                            <div class="quickview-peragraph">
                                <b>{{$showProduct->description}}</b>
                            </div>
                        </div>
                        <a href="{{ route('add.to.cart', $showProduct->id) }}" style="margin-top:15px"
                            class="btn btn-info"><i class="fa fa-shopping-cart"></i>Thêm vào giỏ
                            hàng</a>
                        <button class="btn btn-primary" onclick="window.history.go(-1); return false;">Hủy</button>
                    </div>
                </div>
                <hr>
                <div class="dropdown">
                    <button class="btn btn-success dropdown-toggle" type="button" data-toggle="dropdown"><b>Bình
                            Luận:</b>
                        <span class="caret"></span></button>
                    <ul style="border: 10px solid #ccc;" class="dropdown-menu">
                        
                        @foreach($commentAll as $comment)
                        <li><b class="text-center"> Người Bí Ẩn :</b>{{$comment->content}} </li><br>
                        @endforeach
                    </ul>
                </div>
                <form method="post" action="{{ route('comments.store')}}">
                    @csrf
                    <div class="form-group">
                        <textarea class="form-control" type="text" name="content"></textarea>
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-success" value="Gửi" />
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection