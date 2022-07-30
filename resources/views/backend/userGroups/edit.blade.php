@extends('backend.layouts.master')

@section('content')

<div class="container">
    <h1 class="text-center mt-3">Sửa Nhóm</h1>
    <form method="post" action="{{route('userGroups.update',$userGroup->id)}}">
        @csrf
        @method('PUT')
        <div class="container">
            <div class="row">
                <div class="col-lg-3"></div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label>Tên nhóm</label>
                        <input type="text" id="name" name="name" value="{{ $userGroup->name}}" class="form-control">
                        <label id="name-error" class="error" for="name" style="display: none;color:red">Vui lòng nhập
                            tên nhóm</label>
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-check form-switch">Quyền hạn
                        <input style="margin-left: 0.5em;" type="checkbox" id="checkAll" class="form-check-input"
                            value="Quyền hạn">
                    </label>
                    <div class="row">
                        @foreach ($group_names as $group_name => $roles)
                        <div class="list-group list-group-flush list-group-bordered col-lg-4">
                            <div class="list-group-header" style="color:rgb(50, 219, 101) ;">
                                <h5> {{ __($group_name) }}</h5>
                            </div>
                            @foreach ($roles as $role)
                            <div class="list-group-item d-flex justify-content-between align-items-center">
                                <span>{{ __($role['name']) }}</span>
                                <!-- .switcher-control -->
                                <label class="form-check form-switch">
                                    <input type="checkbox" @checked( in_array($role['id'],$userRoles) ) name="roles[]"
                                        class="checkItem form-check-input" value="{{ $role['id'] }}">
                                    <span class="switcher-indicator"></span>
                                </label>
                                <!-- /.switcher-control -->
                            </div>
                            @endforeach
                        </div>
                        @endforeach
                    </div>
                </div>
                <button style="float: right" class="submit btn btn-primary">Sửa</button>
                <a href="{{ route('userGroups.index')}}" class="btn btn-secondary">Trở về</a>
            </div>
        </div>
        <div class="col-lg-3"></div>
</div>
</form>
</div>
<script>
        $('#checkAll').click(function () {
        $(':checkbox.checkItem').prop('checked', this.checked);
    });
</script>
@endsection

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