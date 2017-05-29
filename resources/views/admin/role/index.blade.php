@extends('admin.layouts.base')

@section('title','角色管理')

@section('content')
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-sm-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h2 class="inline">角色管理</h2>
                        <div class="pull-right">
                            <a class="btn btn-primary " href="{{ route('admin.role.create') }}"><i class="fa fa-plus"></i>&nbsp;添加</a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <table class="table table-striped table-bordered table-hover dataTables-example">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>名称</th>
                                <th>添加时间</th>
                                <th>最后编辑时间</th>
                                <th>操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($roles as $role)
                                <tr class="gradeX">
                                    <td>{{ $role->id }}</td>
                                    <td>{{ $role->name }}</td>
                                    <td>{{ $role->created_at }}</td>
                                    <td>{{ $role->updated_at }}</td>
                                    <td>
                                        <a href="{{ route('admin.role.edit',$role->id) }}" class="btn btn-success">
                                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i>&nbsp;编辑
                                        </a>
                                        <a href="{{ route('admin.role.destroy',$role->id) }}" class="btn btn-danger">
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
