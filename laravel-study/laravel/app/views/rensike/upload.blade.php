@extends('hello._layouts.default')

@section('main')

 {{Form::open(array('url'=>'rensike/upload','files'=>true))}}

{{Form::file('mypic')}}
{{Form::submit('上传文件')}}

{{Form::close()}}

@stop