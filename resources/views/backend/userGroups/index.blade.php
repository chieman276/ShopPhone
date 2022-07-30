@extends('backend.layouts.master')

@section('content')


<body>
    <div class="container">

        <div class="col-lg-6">
            <h1 class="text-center mt-5">Chức Vụ</h1>
        </div>
        <div class="col-lg-12 mt-3">
            <a href="{{route('userGroups.create')}}" class="btn btn-primary">Thêm</a>
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
                @foreach ($userGroups as $userGroup)
                <tr class="text-center">
                    <td>{{ $userGroup->id }}</td>
                    <td>{{ $userGroup->name }}</td>

                    <td>
                        {{-- <a href="{{ route('userGroups.show',$userGroup->id )}}" class="btn btn-primary">Xem</a> --}}
                        <a href="{{ route('userGroups.edit',$userGroup->id )}}" class="btn btn-warning">Sửa</a>
                        <form action="{{ route('userGroups.destroy',$userGroup->id )}}" style="display:inline" method="post">

                            <button class="btn btn-danger" onclick="return confirm('Xóa {{$userGroup->name}} ?')">Xóa</button>
                            @csrf
                            @method('delete')


                        </form>
                    </td>
                </tr>
                @endforeach

            </tbody>
        </table>
        <div style="float:right">
            {{ $userGroups->links() }}
        </div>
    </div>

</body>



@endsection