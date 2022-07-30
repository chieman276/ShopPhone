@extends('backend.layouts.master')

@section('content')


<body>
    <div class="container">

        <div class="col-lg-6">
            <h1 class="text-center mt-5">Danh sách sản phẩm</h1>
        </div>
        <div class="col-lg-12 mt-3">
            <a href="{{route('products.create')}}" class="btn btn-primary">Thêm sản phẩm</a>
        </div>
        <br>
        @if (Session::has('success'))
        <div class="alert alert-success">{{session::get('success')}}</div>
        @endif
        @if (Session::has('error'))
        <div class="text text-danger">{{session::get('error')}}</div>
        @endif
        <br>
        <table class="table table-bordered mt-3">
            <thead>
                <tr class="text-center">
                    <th>#</th>
                    <th>Tên sản phẩm</th>
                    <th>hình ảnh</th>
                    <th>Giá sản phẩm</th>
                    <th>Danh mục sản phẩm</th>
                    <th>Chức năng</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                <tr class="text-center">
                    <td >{{ $product->id }}</td>
                    <td style="width: 120px" >{{ $product->name }} </td>
                    <td><img src="{{ asset($product->image) }}" style="width: 140px" > </td>
                    <td>{{ number_format ($product->price) }}</td>
                    <td>{{ $product->category->name }}</td>

                    <td>
                        {{-- <a href="{{ route('products.show',$product->id )}}" class="btn btn-primary">Xem</a> --}}
                        <a href="{{ route('products.edit',$product->id )}}" class="btn btn-warning">Sửa</a>
                        <form action="{{ route('products.destroy',$product->id )}}" style="display:inline" method="post">                          
                            @csrf
                            @method('delete')
                            <button class="btn btn-danger" onclick="return confirm('Xóa {{$product->name}} ?')">Xóa</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div style="float:right">
            {{ $products->links() }}
        </div>
    </div>
</body>
@endsection