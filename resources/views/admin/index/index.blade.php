@extends('admin.layouts.base')

@section('title','首页')

@section('content')
    <div id="wrapper">
        @include('admin.layouts.navigation')
        <div id="page-wrapper" class="gray-bg dashbard-1">
            <div class="row border-bottom">
                <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
                    <div class="navbar-header"><a class="navbar-minimalize minimalize-styl-2 btn btn-info " href="#"><i class="fa fa-bars"></i> </a>
                        <form role="search" class="navbar-form-custom" >
                            <div class="form-group">
                                <input type="text" placeholder="Seach …" class="form-control" name="top-search" id="top-search">
                            </div>
                        </form>
                    </div>

                </nav>
            </div>
            <div class="row J_mainContent" id="content-main">
                <iframe id="J_iframe" width="100%" height="100%" src="index_v1.html?v=4.0" frameborder="0" data-id="index_v1.html" seamless></iframe>
            </div>
        </div>
    </div>
@stop