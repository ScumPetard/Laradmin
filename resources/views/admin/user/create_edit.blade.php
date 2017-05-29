@extends('admin.layouts.base')

@section('title','用户管理')

@section('css')
    <style>
        .img-circle {
            cursor: pointer;
        }
    </style>
@stop

@section('content')
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-sm-6 col-lg-offset-3">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h3>{{ isset($user) ? '编辑' : '创建' }}用户</h3>
                    </div>
                    <div class="ibox-content">
                        <div class="row">
                            <div class="col-sm-12">
                                @if(isset($user))
                                    <form role="form" action="{{ route('admin.user.edit',$user->id) }}" method="post" id="validateForm" enctype="multipart/form-data">
                                @else
                                    <form role="form" action="{{ route('admin.user.create') }}" method="post" id="validateForm" enctype="multipart/form-data">
                                @endif
                                        {!! csrf_field() !!}
                                        <div class="form-group">
                                            <label>用户名称</label>
                                            <input type="text" name="name" value="{{ isset($user) ? $user->name : '' }}"  class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="email" name="email" value="{{ isset($user) ? $user->email : '' }}"  class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>密码</label>
                                            <input type="text" name="password" value=""  class="form-control" {{ isset($user) ? '' : 'required' }}>
                                            <p class="help-block">{{ isset($user) ? lang('Please do not change the password') : '' }}</p>
                                        </div>
                                        <div class="form-group">
                                            <label class="block">头像</label>
                                            <img id="preview" src="{{ isset($user) ? $user->avatar : '/resource/admin/images/avatar.jpg' }}" width="150" class="img-circle" onclick="$('input[name=avatar]').click();">
                                            <input type="file" onchange="previewImage(this)" name="avatar" value="" class="hidden">
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <label class="block">所属角色</label>
                                                @forelse($roles as $role)
                                                    <div class="col-md-3">
                                                        <div class="checkbox i-checks inline">
                                                            <label>
                                                                <input
                                                                        name="roles[]"
                                                                        type="checkbox"
                                                                        value="{{ $role->id }}"
                                                                @if(isset($user))
                                                                    {{ $user->hasRole($role) ? 'checked' : '' }}
                                                                        @endif
                                                                >
                                                                <i></i> {{ $role->name }}
                                                            </label>
                                                        </div>
                                                    </div>
                                                @empty
                                                    <div class="alert alert-danger">
                                                        {{ lang('Empty role') }}
                                                    </div>
                                                @endforelse
                                            </div>

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
                name: {required: true, minlength: 3},
                email: {required:true,minlength: 3}

            }
        });
        function previewImage(file) {
            var MAXWIDTH = 150;
            var MAXHEIGHT = 150;
            if (file.files && file.files[0]) {
                var img = document.getElementById('preview');
                img.onload = function () {
                    var rect = getZoomParam(MAXWIDTH, MAXHEIGHT, img.offsetWidth, img.offsetHeight);
                    img.width = rect.width;
                    img.height = rect.height;
                }
                var reader = new FileReader();
                reader.onload = function (evt) {
                    img.src = evt.target.result;
                }
                reader.readAsDataURL(file.files[0]);
            } else {
                file.select();
                var src = document.selection.createRange().text;
                var img = document.getElementById('preview');
                img.filters.item('DXImageTransform.Microsoft.AlphaImageLoader').src = src;
            }
        }
        function getZoomParam(maxWidth, maxHeight, width, height) {
            var param = { top: 0, left: 0, width: width, height: height };
            if (width > maxWidth || height > maxHeight) {
                rateWidth = width / maxWidth;
                rateHeight = height / maxHeight;
                if (rateWidth > rateHeight) {
                    param.width = maxWidth;
                    param.height = Math.round(height / rateWidth);
                } else {
                    param.width = Math.round(width / rateHeight);
                    param.height = maxHeight;
                }
            }
            param.left = Math.round((maxWidth - param.width) / 2);
            param.top = Math.round((maxHeight - param.height) / 2);
            return param;
        }
    </script>
@stop