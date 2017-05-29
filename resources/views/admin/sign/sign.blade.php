@extends('admin.layouts.base')

@section('title','登录')

@section('content')
    <div class="middle-box text-center loginscreen  animated bounceInUp">
        <div>
            <div>
                <h1 class="logo-name">L</h1>
            </div>
            <h3>{{ lang('Admin welcome') }}</h3>
            <form class="m-t" role="form" action="{{ route('admin.sign') }}" method="post" id="validateForm">
                <div class="form-group">
                    <input type="email" name="email" class="form-control" placeholder="Email">
                </div>
                <div class="form-group">
                    <input type="password" name="password" class="form-control" placeholder="Password">
                </div>
                <button type="submit" class="btn btn-primary block full-width m-b">登&nbsp;录</button>
                {{ csrf_field() }}
                <p class="text-muted text-center">
                    <a href="https://github.com/ScumPetard"><i class="fa fa-github" aria-hidden="true"></i>
                        ScumPetard</a>
                </p>
            </form>
        </div>
    </div>
@stop

@section('js')
    @include('admin.comments.validate')
    <script>
        $("#validateForm").validate({
            rules: {
                email: {required: true, email: true, maxlength: 20,},
                password: {required: true, minlength: 3, maxlength: 20}
            }
        });
    </script>
@stop