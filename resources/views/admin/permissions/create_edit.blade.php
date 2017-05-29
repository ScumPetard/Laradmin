@extends('admin.layouts.base')

@section('title','权限管理')

@section('content')
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-sm-4 col-lg-offset-4">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h3>{{ isset($permission) ? '编辑' : '创建' }}权限</h3>
                    </div>
                    <div class="ibox-content">
                        <div class="row">
                            <div class="col-sm-12">
                                @if(isset($permission))
                                    <form role="form" action="{{ route('admin.permission.edit',$permission->id) }}" method="post" id="validateForm">
                                @else
                                    <form role="form" action="{{ route('admin.permission.create') }}" method="post" id="validateForm">
                                @endif
                                        {!! csrf_field() !!}
                                        <div class="form-group">
                                            <label>权限名称</label>
                                            <input type="name" name="name" value="{{ isset($permission) ? $permission->name : '' }}"  class="form-control">
                                        </div>
                                        <div>
                                            <button class="btn btn-sm btn-success m-t-n-xs" type="submit">提交</button>
                                            <a class="btn btn-sm btn-default m-t-n-xs" href="javascript:history.go(-1)">取消</a>
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
    <script>
        $("#validateForm").validate({
            rules: {
                name: {required: true, minlength: 3}
            }
        });
    </script>
@stop