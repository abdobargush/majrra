@extends('errors.layout')
@section('title')
  Request timeout.
@endsection
@section('errorNumber', '408')

@section('description')
  @php
    $default_error_message = "Please <a href='javascript:history.back()''>go back</a>, refresh the page and tru again.";

  @endphp
  {!! isset($exception)? ($exception->getMessage()?$exception->getMessage():$default_error_message): $default_error_message !!}
@endsection