@extends('admin.layouts.base')

@section('title','权限管理')

@section('css')
    <link href="https://cdn.bootcss.com/iCheck/1.0.2/skins/all.css" rel="stylesheet">
@stop

@section('content')
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-sm-10 col-lg-offset-1">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h3>{{ isset($role) ? '编辑' : '创建' }}角色</h3>
                    </div>
                    <div class="ibox-content">
                        <div class="row">
                            <div class="col-sm-12">
                                @if(isset($role))
                                    <form role="form" action="{{ route('admin.role.edit',$role->id) }}" method="post" id="validateForm">
                                @else
                                    <form role="form" action="{{ route('admin.role.create') }}" method="post" id="validateForm">
                                @endif
                                                {!! csrf_field() !!}
                                                <div class="form-group">
                                                    <label>角色名称</label>
                                                    <input type="name" name="name"
                                                           value="{{ isset($role) ? $role->name : '' }}"
                                                           class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label class="block">拥有权限</label>
                                                    @forelse($permissions as $permission)
                                                        <div class="col-md-3">
                                                            <div class="checkbox i-checks inline">
                                                                <label>
                                                                    <input
                                                                            name="permissions[]"
                                                                            type="checkbox"
                                                                            value="{{ $permission->id }}"
                                                                            @if(isset($role))
                                                                                {{ $role->hasPermissionTo($permission) ? 'checked' : '' }}
                                                                            @endif
                                                                        >
                                                                    <i></i> {{ $permission->name }}
                                                                </label>
                                                            </div>
                                                        </div>
                                                    @empty
                                                        <div class="alert alert-danger">
                                                            {{ lang('Empty permission') }}
                                                        </div>
                                                    @endforelse
                                                </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                            <div class="form-group" style="margin-top: 25px;">
                                                <button class="btn btn-sm btn-success m-t-n-xs" type="submit">提交
                                                </button>
                                                <a class="btn btn-sm btn-default m-t-n-xs"
                                                   href="javascript:history.go(-1)">取消</a>
                                            </div>
                                            </div>
                                        </div>

                                            </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')
    @include('admin.comments.validate')
    <script src="https://cdn.bootcss.com/iCheck/1.0.2/icheck.min.js"></script>
    <script>
        $("#validateForm").validate({rules: {name: {required: true, minlength: 3}}});
        $(document).ready(function () {
            $('.i-checks').iCheck({checkboxClass: 'icheckbox_square-blue', radioClass: 'iradio_square-blue',});
        });
    </script>
@stop