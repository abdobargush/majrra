@extends('errors.layout')
@section('title')
  It's not you, it's me.
@endsection
@section('errorNumber', '503')

@section('description')
  @php
    $default_error_message = "The server is overloaded or down for maintenance. Please try again later.";
  @endphp
  {!! isset($exception)? ($exception->getMessage()?$exception->getMessage():$default_error_message): $default_error_message !!}
@endsection
