@extends('backend.layouts.master')

@section('content')

<div class="container">
    <h1 class="text-center mt-3">Thêm danh mục </h1>
    <form method="post" action="{{route('categories.store')}}">
        @csrf
        <div class="container">
            <div class="row">
                <div class="col-lg-3"></div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label>Tên danh mục</label>
                        <input type="text" id="name" name="name" class="form-control">
                        <label id="name-error" class="error" for="name" style="display: none;color:red">Vui lòng nhập
                            tên danh mục</label>
                        <!-- {{-- @if ($errors->any())
                        <p style="color:red">{{ $errors->first('name') }}</p>
                        @endif --}} -->
                    </div>
                    <button style="float: right" class="submit btn btn-primary">Thêm</button>
                    <a href="{{ route('categories.index')}}" class="btn btn-secondary">Trở về</a>                </div>
                <div class="col-lg-3"></div>
            </div>
        </div>

</div>
</form>
</div>

<script>
    $(document).ready(function () {
        $('.submit').click(function () {
            var can_submit = true;
            var name = $('#name').val();
            if (name == '') {
                $('#name-error').show();
                can_submit = false;
            } else {
                $('#name-error').hide();

            }
            if (can_submit == false) {
                return false;
            }
        });
    });
</script>
@endsection
