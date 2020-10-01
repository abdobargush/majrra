@extends('errors.layout')
@section('title')
  Bad request.
@endsection
@section('errorNumber', '400')

@section('description')
  @php
    $default_error_message = "Please <a href='javascript:history.back()''>go back</a> or return to <a href='".url('')."'>our homepage</a>.";
  @endphp
  {!! isset($exception) && config('app.debug') ? ($exception->getMessage()?$exception->getMessage():$default_error_message): $default_error_message !!}
@endsection