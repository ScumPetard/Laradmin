@extends('admin.layouts.base')

@section('title','无权访问')


@section('content')
    <div class="middle-box text-center animated fadeInDown">
        <h1><i class="fa fa-ban" aria-hidden="true"></i></h1>
        <h3 class="font-bold">无权访问</h3>

        <div class="error-desc">
            <a href="javascript:history.go(-1)" class="btn btn-primary m-t">返回</a>
        </div>
    </div>
@stop

