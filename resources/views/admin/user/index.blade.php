@extends('admin.layouts.base')

@section('title','用户管理')

    @section('css')
        <style>
            .img-circle {  width:50px;height: 50px;}
        </style>
    @stop

@section('content')
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-sm-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h2 class="inline">用户管理</h2>
                        <div class="pull-right">
                            <a class="btn btn-primary " href="{{ route('admin.user.create') }}"><i class="fa fa-plus"></i>&nbsp;添加</a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <table class="table table-striped table-bordered table-hover dataTables-example">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>头像</th>
                                <th>名称</th>
                                <th>Email</th>
                                <th>添加时间</th>
                                <th>最后编辑时间</th>
                                <th>操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr class="gradeX">
                                    <td>{{ $user->id }}</td>
                                    <td><img src="{{ $user->avatar }}" class="img-circle"></td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->created_at }}</td>
                                    <td>{{ $user->updated_at }}</td>
                                    <td>
                                        <a href="{{ route('admin.user.edit',$user->id) }}" class="btn btn-success">
                                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i>&nbsp;编辑
                                        </a>
                                        <a href="{{ route('admin.user.destroy',$user->id) }}" class="btn btn-danger">
                                            <i class="fa fa-times-circle" aria-hidden="true"></i>&nbsp;删除
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')
    @include('admin.comments.datatable')
@stop
