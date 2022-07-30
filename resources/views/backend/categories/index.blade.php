@extends('backend.layouts.master')

@section('content')


<body>
    <div class="container">

        <div class="col-lg-6">
            <h1 class="text-center mt-5">Danh sách danh mục sản phẩm</h1>
        </div>
        <div class="col-lg-12 mt-3">
            <a href="{{route('categories.create')}}" class="btn btn-primary">Thêm danh mục</a>
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
                    <th>Tên</th>
                    <th>Chức năng</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                <tr class="text-center">
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->name }}</td>

                    <td>
                        {{-- <a href="{{ route('categories.show',$category->id )}}" class="btn btn-primary">Xem</a> --}}
                        <a href="{{ route('categories.edit',$category->id )}}" class="btn btn-warning">Sửa</a>
                        <form action="{{ route('categories.destroy',$category->id )}}" style="display:inline" method="post">

                            <button class="btn btn-danger" onclick="return confirm('Xóa {{$category->name}} ?')">Xóa</button>
                            @csrf
                            @method('delete')


                        </form>
                    </td>
                </tr>
                @endforeach

            </tbody>
        </table>
        <div style="float:right">
            {{ $categories->links() }}
        </div>
    </div>

</body>



@endsection