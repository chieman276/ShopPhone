@extends('frontend.layouts.master')
@section('content')
<div class="row">
    <div class="col-lg-2"></div>
    <div class="col-lg-10">
        <div class="session-title">
            @if (Session::has('success'))
            </div>
            <div class="text text-success"><h3><b>{{session::get('success')}}</b></h3></div>
            @endif
            @if (Session::has('error'))
            <div class="text text-danger"><h3><b>{{session::get('error')}}</b></h3></div>
            @endif
        </div>
    </div>
</div>
<div class="container">
<table id="cart" class="table table-hover table-condensed">
    <thead>
        <tr>
            <th style="width:50%">Sản Phẩm</th>
            <th style="width:10%">Giá</th>
            <th style="width:8%">Số Lượng</th>
            <th style="width:22%" class="text-center">Tổng Tiền</th>
            <th style="width:10%"></th>
        </tr>
    </thead>
    <tbody id="product">
        @php $total = 0 @endphp
        @if(session('cart'))
            @foreach(session('cart') as $id => $details)
                @php $total += $details['price'] * $details['quantity'] @endphp
                <tr data-id="{{ $id }}">
                    <td data-th="Product">
                        <div class="row">
                            <div class="col-sm-3 hidden-xs"><img src="{{ asset( $details['image']) }}" width="100" height="100" class="img-responsive"/></div>
                            <div class="col-sm-9">
                                <h4 class="nomargin">{{ $details['name'] }}</h4>
                            </div>
                        </div>
                    </td>
                    <td data-th="Price">{{number_format( $details['price']) }} đ</td>
                    <td data-th="Quantity">
                        <input type="number" value="{{ $details['quantity'] }}" class="form-control quantity update-cart" />
                    </td>
                    <td data-th="Subtotal" class="text-center">{{number_format( $details['price'] * $details['quantity']) }} đ</td>
                    <td class="actions" data-th="">
                        <button class="btn btn-danger btn-sm remove-from-cart"><i class="fa fa-trash-o"></i></button>
                    </td>
                </tr>
            @endforeach
        @endif
    </tbody>
    <tfoot>
        <tr>
            <td colspan="5" class="text-right"><h3 style="color:red ;"><strong>Tổng số tiền:{{ number_format( $total)}} đ</strong></h3></td>
        </tr>
        <tr>
            <td colspan="5" >
                <a href="{{ route('website.product') }}" class="btn btn-warning"><i class="fa fa-angle"></i> Trở về</a>
                <a href="{{ route('checkout') }}"  class="btn btn-success" style="float: right;width:100px;height:35px"> Mua</a>
                
            </td>
        </tr>
    </tfoot>
</table>
</div>
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script type="text/javascript">
     $(document).ready(function () {
    $(".update-cart").change(function (e) {
        e.preventDefault();
  
        var ele = $(this);
  
        $.ajax({
            url: '{{ route('update.cart') }}',
            method: "patch",
            data: {
                _token: '{{ csrf_token() }}', 
                id: ele.parents("tr").attr("data-id"), 
                quantity: ele.parents("tr").find(".quantity").val()
            },
            success: function (response) {
               window.location.reload();
            }
        });
    });
  
    $(".remove-from-cart").click(function (e) {
        e.preventDefault();
  
        var ele = $(this);
  
        if(confirm("Bạn có chắc muốn xóa không ?")) {
            $.ajax({
                url: '{{ route('remove.from.cart') }}',
                method: "DELETE",
                data: {
                    _token: '{{ csrf_token() }}', 
                    id: ele.parents("tr").attr("data-id")
                },
                success: function (response) {
                    window.location.reload();
                }
            });
        }
    });

    $(".add-from-cart").click(function (e) {
        e.preventDefault();
        var product = $("#product").val();
        var ele = $(this);
  
        if(confirm("Bạn có chắc muốn mua sản phẩm không ?")) {
            $.ajax({
                url: '{{ route('remove.from.cart') }}',
                method: "DELETE",
                data: {
                    _token: '{{ csrf_token() }}', 
                    id: ele.parents("tr").attr("product")
                },
                success: function (response) {
                    window.location.reload();
                }
            });
        }
    });
});
</script>
