@extends('hello._layouts.default')

@section('main')

<div>{{$message or "你还没登录呢"}}</div>
{{Form::open(array('url'=>'user/signin'))}}

{{Form::label('邮箱')}}
{{Form::text('email',null,array('placeholder'=>'请输入邮箱'))}}

{{Form::label('密码')}}
{{Form::password('mypwd')}}

{{Form::submit('登录')}}

{{Form::close()}}

@stop